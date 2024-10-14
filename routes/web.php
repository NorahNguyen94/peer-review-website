<?php

use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\AssignStudentController;
use App\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Models\Course;
use App\Models\User;
use App\Models\Assessment;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PeerReviewController;
use App\Models\Feedback;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// -- This route gets courses that student is enrolling OR teacher is teaching  --
Route::get('/', function () {

    if (session()->has('role')) {
        $user = User::where('sNumber', session('sNumber'))->first();
        $courses = $user->courses()->get();
        return view('course-list')->with('courses', $courses);
    } else {
        return view('layouts.login');
    }

});

// -- This route works with assessments in the Detail Page --
Route::resource('{courseCode}/assessments', AssessmentController::class);

// -- This route works with peer views of the assessment in the Assessment Detail Page --
Route::resource('courses/{courseCode}/assessments/{assessmentID}/peerReview', PeerReviewController::class);

// -- This route shows the details of course's page --
Route::get('detail', function () {
    return view('detailPage');
});


// -- This route shows reviews that were made by the student and reviews that the student received
Route::get('{courseCode}/assessments/{assessmentID}/review-list/{sNumber}', function ($courseCode, $assessmentID, $sNumber) {
    $user = User::where('sNumber', $sNumber)->first();
    $assessment = Assessment::find($assessmentID);

    // get reviews that the student has been made
    $reviews = $user->peer_reviews_by_reviewer()->where('assessmentID', $assessmentID)->get();

    // get reviews that the student received
    $receivedReviews = $user->peer_reviews_by_reviewee()->where('assessmentID', $assessmentID)->get();

    $userWithScore = $user->assessments()->where('assessmentID', $assessment->id)->first();

    return view('review-list')->with('reviews', $reviews)->with('receivedReviews', $receivedReviews)->with('user', $user)->with('assessment', $assessment)->with('scoreUser', $userWithScore)->with('courseCode', $courseCode);
});


// -- This route saves the score of the student for a specific assessment --
Route::post('{courseCode}/assessments/{assessmentID}/review-list/{sNumber}', function ($courseCode, $assessmentID, $sNumber) {

    $user = User::where('sNumber', $sNumber)->first();
    $assessment = Assessment::find($assessmentID);

    $validate = request()->validate([
        'score' => "required|integer|max: $assessment->maxScore"
    ]);

    $score = $validate['score'];

    // attach score value
    if ($user->assessments()->where('assessmentID', $assessment->id)->exists()) {
        // Update the existing score
        $user->assessments()->updateExistingPivot($assessmentID, ['score' => $score]);
    } else {
        // Attach a new score if no existing record
        $user->assessments()->attach($assessmentID, ['score' => $score]);
    }

    return redirect()->route('peerReview.index', ['courseCode' => $courseCode, 'assessmentID' => $assessmentID])->with('message', 'Mark assigned successfully.');
});

// -- This route handles enrolling student to a course --
Route::post('{courseCode}/enroll/{sNumber}', function ($courseCode, $sNumber) {
    $course = Course::where('courseCode', $courseCode)->first();

    if ($course) {

        // Check if the user is already enrolled
        if ($course->users()->where('users.sNumber', $sNumber)->exists()) {
            return redirect()->back()->with('message', 'Error! Student is already enrolled in this course.');
        }

        // Attach the student to the course
        $course->users()->attach($sNumber);

        return redirect()->route('assessments.index', ['courseCode' => $courseCode])->with('message', 'Student enrolled successfully.');
    }

    return redirect()->back()->with('error', 'Course not found.');
});

// This route saves feedback that reviewee did for the reviewer
Route::post('saveFeedback/{reviewerID}', function ($reviewerID) {
    $rating = request('rating');
    Feedback::create([
        'sNumber' => $reviewerID,
        'rating' => $rating,
        'feedback' => ''
    ]);

    return redirect()->back()->with('message', 'Thank you for giving your feedback!');
});

// This route shows top reviewers
Route::get('top-reviewers', function () {
    $topReviewers = User::select('users.sNumber', 'users.name')
        ->withAvg('feedbacks', 'rating') 
        ->whereHas('feedbacks')           
        ->orderByDesc('feedbacks_avg_rating') 
        ->take(5)                       
        ->get();
    return view('topReviewer')->with('topReviewers', $topReviewers);
});

// This route assigns student randomly for an assessment
Route::post('/assignStudent/{assessmentID}', [AssignStudentController::class, 'assignStudent']);

// This route adds a course via uploading a file
Route::post('/addCourse', [CourseController::class, 'upload']);

// -- This route shows the login page --
Route::get('/login', function () {
    return view('layouts.login');
})->name('login');

// -- This route shows the register page --
Route::get('/register', function () {
    return view('layouts.register');
});

// -- This route handles user login and registration --
Route::post('/register', [LoginController::class, 'register']);
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout']);