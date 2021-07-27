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

        
        // try {
        //     StudentCourse::factory()
        //         ->times(10000)
        //         ->create();
        // } catch (\Throwable $e) {
        //     // throw $e;
        //     report($e);
        // }

        $counter = 0;

        for ($i = 0; $i < 250000; $i++) {
            try {
                $counter++;
                if ($counter == 500) {
                    sleep(3);
                    $counter = 0;
                }
                $random = rand(1, Student::count());
                // $random =  Student::all()->random()->id;

                print_r($i . " " . $random . "\n");
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
