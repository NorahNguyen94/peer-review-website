<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Assessment;
use App\Models\PeerReview;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class PeerReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($courseCode, $assessmentID)
    {
        // Check if user is a student or a teacher to direct to the apropriate page
        if (session('role') == 'student') {
            $course = Course::where('courseCode', $courseCode)->first();
            $assessment = Assessment::find($assessmentID);

            // to show the list of students in the course
            $students = $course->users()->where('role', 'student')->where('name', '!=', session('name'))->get();
            $user = User::where('sNumber', session('sNumber'))->first();

            // get reviews that the student has been made
            $reviews = $user->peer_reviews_by_reviewer()->where('assessmentID', $assessmentID)->get();

            // Get the reviewee IDs from the submitted reviews
            $reviewedIDs = $reviews->pluck('revieweeID')->toArray();

            // get reviews that the student received
            $receivedReviews = $user->peer_reviews_by_reviewee()->where('assessmentID', $assessmentID)->get();

            // number of peer reviews made
            $count_of_reviews = count($reviews);

            if ($assessment->type == 'teacher-assign') {
                $user = User::where('sNumber', session('sNumber'))->first(); // get current user

                $userGroupInfo = DB::table('assessment_group')
                    ->where('assessmentID', $assessmentID)
                    ->where('users.sNumber', session('sNumber'))
                    ->join('users', 'assessment_group.sNumber', '=', 'users.sNumber')
                    ->select('assessment_group.groupID')
                    ->orderBy('groupID')
                    ->get()->first();

                $groupID = $userGroupInfo->groupID; // take the group id of current user

                // get the group of current user
                $groupMembers = DB::table('assessment_group')
                    ->where('assessmentID', $assessmentID)
                    ->where('groupID', $groupID)
                    ->where('users.sNumber', '!=', session('sNumber'))
                    ->join('users', 'assessment_group.sNumber', '=', 'users.sNumber')
                    ->select('users.name', 'users.sNumber', 'assessment_group.groupID')
                    ->orderBy('groupID')
                    ->get();

                if (!$groupMembers) {
                    $groupMembers = collect(); // If no group found, return an empty collection
                }

                // check if the member was reviewed or not
                foreach ($groupMembers as $member) {
                    $member->hasReviewed = in_array($member->sNumber, $reviewedIDs);
                }
                return view('AssessmentDetailPageStudent')->with('course', $course)->with('assessment', $assessment)->with('students', $students)->with('reviews', $reviews)->with('count', $count_of_reviews)->with('receivedReviews', $receivedReviews)->with('groupMembers', $groupMembers);
            } else {
                return view('AssessmentDetailPageStudent')->with('course', $course)->with('assessment', $assessment)->with('students', $students)->with('reviews', $reviews)->with('count', $count_of_reviews)->with('receivedReviews', $receivedReviews);
            }
        } else {
            $course = Course::where('courseCode', $courseCode)->first();
            $assessment = Assessment::find($assessmentID);
            $enrolledStudents = $course->users()->where('role', '!=', 'teacher')->paginate(10);

            // loop the enrolled students to count the number of reviews made and received
            foreach ($enrolledStudents as $student) {
                // Number of reviews submitted by the student
                $student['submittedReviewsCount'] = $student->peer_reviews_by_reviewer()->where('assessmentID', $assessment->id)->count();

                // Number of reviews received by the student
                $student['receivedReviewsCount'] = $student->peer_reviews_by_reviewee()->where('assessmentID', $assessment->id)->count();

                // Score of each student. If no score assigned, NA is displayed
                $student['score'] = $student->assessments()->where('assessmentID', $assessment->id)->first()->pivot->score ?? 'N/A';
            }

            $groups = DB::table('assessment_group')
                ->where('assessmentID', $assessmentID)
                ->join('users', 'assessment_group.sNumber', '=', 'users.sNumber')
                ->select('users.name', 'users.sNumber', 'assessment_group.groupID')
                ->orderBy('groupID')
                ->get();
            return view('AssessmentDetailPageTeacher')->with('course', $course)->with('assessment', $assessment)->with('enrolledStudents', $enrolledStudents)->with('groups', $groups);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($courseCode, $assessmentID, Request $request)
    {
        $validate = $request->validate([
            'revieweeID' => 'required',
            'reviewText' => [
                    'required',
                    function ($attribute, $value, $fail) {
                        if (str_word_count($value) < 5) {
                            $fail('The review text must contain at least 5 words.');
                        }
                    },
                ],
        ]);

        // Check if the reviewee was reviewed already or not
        $reviews = PeerReview::where('reviewerID', session('sNumber'))->where('revieweeID', $request->revieweeID)->where('assessmentID', $assessmentID)->get();
        $count = count($reviews);

        // if reviewer made reviews already, go back with error message
        if ($count == 1) {
            return redirect()->back()->with('message', 'Error! You have made review for this reviewee already.');
        }

        $validate['reviewerID'] = session('sNumber');
        $validate['assessmentID'] = $assessmentID;
        PeerReview::create($validate);

        return redirect()->back()->with('message', 'Peer review submitted successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
