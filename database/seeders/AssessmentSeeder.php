<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AssessmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('assessments')->insert([
            'title' => 'Week 1 Peer Review',
            'instruction' => "Review your peer's work by observing your peer's presentation during the workshop and ask them questions.",
            'numberOfReview' => '3',
            'dueDateTime' => '2024-10-10 23:59:59',
            'maxScore' => 10,
            'type' => 'student-selected',
            'courseCode' => '2810ICT',
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);
        DB::table('assessments')->insert([
            'title' => 'Week 2 Peer Review',
            'instruction' => "Review your peer's work by observing your peer's presentation during the workshop and ask them questions.",
            'numberOfReview' => '4',
            'dueDateTime' => '2024-11-10 23:59:59',
            'maxScore' => 10,
            'type' => 'teacher-assign',
            'courseCode' => '2810ICT',
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);
        DB::table('assessments')->insert([
            'title' => 'Week 3 Peer Review',
            'instruction' => "Review your peer's work by observing your peer's presentation during the workshop and ask them questions.",
            'numberOfReview' => '3',
            'dueDateTime' => '2024-09-09 23:59:59',
            'maxScore' => 10,
            'type' => 'student-selected',
            'courseCode' => '2810ICT',
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);
        DB::table('assessments')->insert([
            'title' => 'Week 4 Peer Review',
            'instruction' => "Review your peer's work by observing your peer's presentation during the workshop and ask them questions.",
            'numberOfReview' => '4',
            'dueDateTime' => '2024-10-04 23:59:59',
            'maxScore' => 10,
            'type' => 'teacher-assign',
            'courseCode' => '2810ICT',
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);
        DB::table('assessments')->insert([
            'title' => 'Week 1 Peer Review',
            'instruction' => "Review your peer's work by observing your peer's presentation during the workshop and ask them questions.",
            'numberOfReview' => '3',
            'dueDateTime' => '2024-10-10 23:59:59',
            'maxScore' => 10,
            'type' => 'student-selected',
            'courseCode' => '3032ICT',
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);
        DB::table('assessments')->insert([
            'title' => 'Week 2 Peer Review',
            'instruction' => "Review your peer's work by observing your peer's presentation during the workshop and ask them questions.",
            'numberOfReview' => '3',
            'dueDateTime' => '2024-10-10 23:59:59',
            'maxScore' => 10,
            'type' => 'teacher-assign',
            'courseCode' => '3032ICT',
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);
        DB::table('assessments')->insert([
            'title' => 'Week 3 Peer Review',
            'instruction' => "Review your peer's work by observing your peer's presentation during the workshop and ask them questions.",
            'numberOfReview' => '3',
            'dueDateTime' => '2024-10-10 23:59:59',
            'maxScore' => 10,
            'type' => 'student-selected',
            'courseCode' => '3032ICT',
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);
        DB::table('assessments')->insert([
            'title' => 'Week 4 Peer Review',
            'instruction' => "Review your peer's work by observing your peer's presentation during the workshop and ask them questions.",
            'numberOfReview' => '3',
            'dueDateTime' => '2024-10-10 23:59:59',
            'maxScore' => 10,
            'type' => 'student-selected',
            'courseCode' => '3032ICT',
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);
        DB::table('assessments')->insert([
            'title' => 'Week 1 Peer Review',
            'instruction' => "Review your peer's work by observing your peer's presentation during the workshop and ask them questions.",
            'numberOfReview' => '3',
            'dueDateTime' => '2024-10-10 23:59:59',
            'maxScore' => 10,
            'type' => 'teacher-assign',
            'courseCode' => '2703ICT',
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);
        DB::table('assessments')->insert([
            'title' => 'Week 2 Peer Review',
            'instruction' => "Review your peer's work by observing your peer's presentation during the workshop and ask them questions.",
            'numberOfReview' => '3',
            'dueDateTime' => '2024-10-10 23:59:59',
            'maxScore' => 10,
            'type' => 'student-selected',
            'courseCode' => '2703ICT',
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);
        DB::table('assessments')->insert([
            'title' => 'Week 3 Peer Review',
            'instruction' => "Review your peer's work by observing your peer's presentation during the workshop and ask them questions.",
            'numberOfReview' => '3',
            'dueDateTime' => '2024-10-10 23:59:59',
            'maxScore' => 10,
            'type' => 'student-selected',
            'courseCode' => '2703ICT',
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);
        DB::table('assessments')->insert([
            'title' => 'Week 1 Peer Review',
            'instruction' => "Review your peer's work by observing your peer's presentation during the workshop and ask them questions.",
            'numberOfReview' => '2',
            'dueDateTime' => '2024-10-10 23:59:59',
            'maxScore' => 10,
            'type' => 'student-selected',
            'courseCode' => '1621ICT',
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);
        DB::table('assessments')->insert([
            'title' => 'Week 2 Peer Review',
            'instruction' => "Review your peer's work by observing your peer's presentation during the workshop and ask them questions.",
            'numberOfReview' => '1',
            'dueDateTime' => '2024-10-10 23:59:59',
            'maxScore' => 10,
            'type' => 'student-selected',
            'courseCode' => '1621ICT',
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);
        DB::table('assessments')->insert([
            'title' => 'Week 3 Peer Review',
            'instruction' => "Review your peer's work by observing your peer's presentation during the workshop and ask them questions.",
            'numberOfReview' => '3',
            'dueDateTime' => '2024-10-10 23:59:59',
            'maxScore' => 10,
            'type' => 'teacher-assign',
            'courseCode' => '1621ICT',
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);
    }
}
