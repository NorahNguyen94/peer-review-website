<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Course;
use App\Models\User;

class CourseController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'courseFile' => 'required|mimes:txt',
        ]);

        $path = $request->file('courseFile')->getRealPath();
        $file = fopen($path, 'r');

        // Initialize variables
        $courseCode = '';
        $courseName = '';
        $teachers = [];
        $assessments = [];
        $students = [];

        while (!feof($file)) {
            $line = fgets($file);

            switch (true) {
                case str_contains($line, 'CourseCode:'):
                    $courseCode = trim(explode(':', $line)[1]);
                    break;

                case str_contains($line, 'CourseName:'):
                    $courseName = trim(explode(':', $line)[1]);
                    break;

                case str_contains($line, 'Teachers:'):
                    $teachers = array_map('trim', explode(',', trim(explode(':', $line)[1])));
                    break;

                case str_contains($line, 'Assessments:'):
                    $assessments = array_map('trim', explode(',', trim(explode(':', $line)[1])));
                    break;

                case str_contains($line, 'Students:'):
                    $students = array_map('trim', explode(',', trim(explode(':', $line)[1])));
                    break;
            }
        }

        // dd($courseCode, $courseName, $teachers, $assessments, $students);

        // Check if the course already exists
        if (Course::where('courseCode', $courseCode)->exists()) {
            return redirect()->back()->with('message', "Course with code $courseCode already exists.");
        }

        // Check valid teachers nput
        foreach ($teachers as $teacher) {
            $teacherUser = User::where('sNumber', $teacher)->where('role', 'teacher')->first();
            if (!$teacherUser) {
                return redirect()->back()->with('message', "Invalid teacher sNumber: $teacher.");
            }
        }

        // Create the course
        Course::create([
            'courseCode' => $courseCode,
            'courseName' => $courseName,
        ]);

        $course = Course::where('courseCode', $courseCode)->first();

        // Attach teachers to the course
        foreach ($teachers as $teacher) {
            $teacher_user = User::where('sNumber', $teacher)->where('role', 'teacher')->first();
            $teacher_user->courses()->attach($course->courseCode);
        }

        // Create assessments for the course
        foreach ($assessments as $assessment) {
            Assessment::create([
                'title' => $assessment,
                'instruction' => "Here is the instruction",
                'numberOfReview' => '1',
                'dueDateTime' => \Carbon\Carbon::now(),
                'maxScore' => 10,
                'type' => 'student-selected',
                'courseCode' => $courseCode,
                'updated_at' => DB::raw('CURRENT_TIMESTAMP')
            ]);
        }

        // Enroll students for the course
        foreach ($students as $student) {
            $student_user = User::where('sNumber', $student)->where('role', 'student')->first();

            // if the user is registered to the system
            if ($student_user) {
                $student_user->courses()->attach($course->courseCode);
            } else { // the student have yet register the system
                $student_user = User::create([
                    'sNumber' => $student,
                    'name' => '',
                    'email' => 'name@gmail.com',
                    'role' => 'student',
                    'password' => bcrypt('12345678'),
                ]);

                // Enroll the new student in the course
                $student_user->courses()->attach($course->courseCode);
            }
        }

        // Close the file
        fclose($file);

        return redirect()->back()->with('message', 'Course and data uploaded successfully.');
    }
}
