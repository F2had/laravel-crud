<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\Course;
use App\Models\StudentCourse;
use Illuminate\Database\Seeder;
use PhpParser\Node\Stmt\TryCatch;

class StudentCourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        try {
            StudentCourse::factory()
                ->times(10000)
                ->create();
        } catch (\Throwable $e) {
            // throw $e;
            report($e);
        }
    }
}
