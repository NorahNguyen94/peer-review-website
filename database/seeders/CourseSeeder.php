<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('courses')->insert([
            'courseCode' => '3032ICT',
            'courseName' => 'Big Data Management',
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);
        DB::table('courses')->insert([
            'courseCode' => '2703ICT',
            'courseName' => 'Web Application Development',
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);
        DB::table('courses')->insert([
            'courseCode' => '1007ICT',
            'courseName' => 'Computer System and Network',
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);
        DB::table('courses')->insert([
            'courseCode' => '1701ICT',
            'courseName' => 'Creative Coding',
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);
        DB::table('courses')->insert([
            'courseCode' => '1811ICT',
            'courseName' => 'Programming Principles',
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);
        DB::table('courses')->insert([
            'courseCode' => '2810ICT',
            'courseName' => 'Software Technologies',
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);
        DB::table('courses')->insert([
            'courseCode' => '1621ICT',
            'courseName' => 'Web Technologies',
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);
        DB::table('courses')->insert([
            'courseCode' => '2808ICT',
            'courseName' => 'Secure Development Operations',
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);
    }
}
