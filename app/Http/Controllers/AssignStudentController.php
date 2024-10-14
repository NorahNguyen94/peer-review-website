<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AssignStudentController extends Controller
{
    public function assignStudent($assessmentID)
    {
        $numberOfStudentInGroup = request('numberOfStudent');

        $assessment = Assessment::find($assessmentID);
        $students = $assessment->course->users()->where('role', 'student')->get();
        $students = $students->shuffle(); // shuffle the student list to assign random students to groups

        // start the group id from 1, when the number of student hits the number of students in the group, increase the group id
        $group_id = 1;
        $studentCount = 0;

        foreach ($students as $student) {
            // assign student to a group
            $assessment->groups()->attach($student->sNumber, ['groupID' => $group_id]);

            $studentCount++; // increase the counter for students

            if ($studentCount >= $numberOfStudentInGroup) {
                $group_id++;
                $studentCount = 0;
            }
        }

        return redirect()->back()->with('message', 'Students assigned to peer review groups.');
    }
}
