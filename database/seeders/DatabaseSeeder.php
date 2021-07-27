<?php

namespace Database\Seeders;

use App\Models\Grade;
use App\Models\Lesson;
use App\Models\Mark;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('grades')->truncate();
        DB::table('teachers')->truncate();
        DB::table('lessons')->truncate();
        DB::table('students')->truncate();
        DB::table('marks')->truncate();
        DB::table('users')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        Grade::factory(5)->create();
        Teacher::factory(5)->create();
        Lesson::factory(4)->create();
        Student::factory(10)->create();
        Mark::factory(20)->create();

        User::factory(3)->state(new Sequence(
            [
                'name' => 'Nicolas',
                'email' => 'nicolas@gmail.com',
            ],
            [
                'name' => 'Alexis',
                'email' => 'alexis@gmail.com',
            ],
            [
                'name' => 'Karine',
                'email' => 'karine@gmail.com',
            ],
        ))->create();
    }
}
