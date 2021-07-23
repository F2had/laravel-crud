<?php

namespace Database\Seeders;

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

        StudentCourse::factory()
            ->count(10000)
            ->create();
        // try {

        // } catch (\Throwable $th) {
        //     //throw $th;
        //     print_r($th);
        // }
    }
}
