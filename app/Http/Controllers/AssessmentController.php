<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Assessment;
use App\Models\User;

class AssessmentController extends Controller
{
    /**
     * Display a listing of the assessments.
     */
    public function index($courseCode)
    {
        if (session('role') == 'student') {
            $course = Course::where('courseCode', $courseCode)->first();
            $assessments = $course->assessments()->get();
            $teachers = $course->users()->where('role', 'teacher')->get();
            // dd($teachers);
            return view('courseDetailPageStudent')->with('assessments', $assessments)->with('course', $course)->with('teachers', $teachers);
        } else {
            $course = Course::where('courseCode', $courseCode)->first();
            $assessments = $course->assessments()->get();
            $assessment = $assessments->first();
            $students = User::where('role', 'student')->get();
            $enrolledStudents = $course->users()->where('role', '!=', 'teacher')->paginate(10);
            return view('courseDetailPageTeacher')->with('assessments', $assessments)->with('course', $course)->with('assessment', $assessment)->with('students', $students)->with('enrolledStudents', $enrolledStudents);
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
    public function store($courseCode, Request $request)
    {
        $validate = $request->validate([
            'title' => 'required|max:20',
            'instruction' => 'required|string',
            'numberOfReview' => 'required|integer|min:1',
            'maxScore' => 'required|integer|between:1,100',
            'dueDateTime' => 'required|date',
            'type' => 'required|in:student-selected,teacher-assign',
        ]);

        $validate['courseCode'] = $courseCode;

        Assessment::create($validate);

        return redirect()->back()->with('message', 'Assessment addedd successfully!');
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
    public function edit($courseCode, string $id)
    {
        $course = Course::where('courseCode', $courseCode)->first();
        $assessments = $course->assessments()->get();
        $assessment = Assessment::find($id);
        $students = User::where('role', 'student')->get();
        $enrolledStudents = $course->users()->where('role', '!=', 'teacher')->paginate(10);;
        return view('courseDetailPageTeacher')->with('assessments', $assessments)->with('course', $course)->with('assessment', $assessment)->with('edit', 'Edit')->with('enrolledStudents', $enrolledStudents)->with('students', $students);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($courseCode, Request $request, string $id)
    {
        $validate = $request->validate([
            'title' => 'required|max:20',
            'instruction' => 'required|string',
            'numberOfReview' => 'required|integer|min:1',
            'maxScore' => 'required|integer|between:1,100',
            'dueDateTime' => 'required|date',
            'type' => 'required|in:student-selected,teacher-assign',
        ]);
        $validate['courseCode'] = $courseCode;

        // Check if there is any reviews in the assessment yet
        // $a = Course::where('courseCode', $courseCode)->first();
        $assessment = Assessment::find($id);
        $count = $assessment->reviews()->count();

        if ($count > 0) {
            return redirect()->route('assessments.index', ['courseCode' => $courseCode])->with('message', 'Sorry! You cannot edit this assessment because there has been submissions for it.');
        }

        $assessment->update($validate);
        return redirect()->route('assessments.index', ['courseCode' => $courseCode])->with('message', 'Assessment updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
