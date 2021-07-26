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

        ini_set('memory_limit', '2048M');
        // try {
        //     StudentCourse::factory()
        //         ->times(10000)
        //         ->create();
        // } catch (\Throwable $e) {
        //     // throw $e;
        //     report($e);
        // }

        for ($i = 0; $i < 30000; $i++) {
            try {
                sleep(1);
                $random = rand(1, Student::count());
                // $random =  Student::all()->random()->id;
               
                print_r($i ." " .$random ."\n");
                StudentCourse::create([
                    'student_id' => $random,
                    'course_id' => Course::all()->random()->id
                ]);
            } catch (\Throwable $e) {
                report($e);
            }
        }
    }
}
