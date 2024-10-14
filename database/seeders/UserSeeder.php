<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Course;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'sNumber' => 's211101',
            'name' => 'Alieen',
            'email' => 'aileen@gmail.com',
            'role' => 'teacher',
            'password' => bcrypt('12345678'),
        ]);
        DB::table('users')->insert([
            'sNumber' => 's000001',
            'name' => 'Fred',
            'email' => 'fred@gmail.com',
            'role' => 'teacher',
            'password' => bcrypt('12345678'),
        ]);
        DB::table('users')->insert([
            'sNumber' => 's000002',
            'name' => 'Dylan',
            'email' => 'dylan@gmail.com',
            'role' => 'teacher',
            'password' => bcrypt('12345678'),
        ]);
        DB::table('users')->insert([
            'sNumber' => 's000003',
            'name' => 'Gary',
            'email' => 'gary@gmail.com',
            'role' => 'teacher',
            'password' => bcrypt('12345678'),
        ]);
        DB::table('users')->insert([
            'sNumber' => 's000004',
            'name' => 'Chris',
            'email' => 'chris@gmail.com',
            'role' => 'teacher',
            'password' => bcrypt('12345678'),
        ]);

        $users = User::factory()->count(50)->create();
        $courseCodes = Course::pluck('courseCode')->toArray();

        foreach ($users as $user) {
            $user->courses()->attach($courseCodes[random_int(0, count($courseCodes) - 1)]);
        }
    }
}
