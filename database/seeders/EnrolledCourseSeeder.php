<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EnrolledCourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('enrolled_courses')->insert([
            'sNumber' => 's000001',
            'courseCode' => '3032ICT',
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);
        DB::table('enrolled_courses')->insert([
            'sNumber' => 's000002',
            'courseCode' => '2703ICT',
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);
        DB::table('enrolled_courses')->insert([
            'sNumber' => 's000003',
            'courseCode' => '1007ICT',
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);
        DB::table('enrolled_courses')->insert([
            'sNumber' => 's000004',
            'courseCode' => '1701ICT',
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);
        DB::table('enrolled_courses')->insert([
            'sNumber' => 's211101',
            'courseCode' => '1811ICT',
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);
        DB::table('enrolled_courses')->insert([
            'sNumber' => 's000001',
            'courseCode' => '2810ICT',
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);
        DB::table('enrolled_courses')->insert([
            'sNumber' => 's000002',
            'courseCode' => '1621ICT',
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);
        DB::table('enrolled_courses')->insert([
            'sNumber' => 's000003',
            'courseCode' => '2808ICT',
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);
        
    }
}
