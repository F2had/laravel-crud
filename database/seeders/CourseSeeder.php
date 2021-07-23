<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departments = [
            'Information Systems',
            'Software Engineering',
            'Artificial Intelligence',
            'Computer System and Network',
            'Multimedia',
            'Data Science',
        ];

        $courses = [
            'Programming Fundamentals',
            'Programming 1',
            'Programming 2',
            'Computer Systems',
            'Databases 1',
            'Communications and Networking',
            'Calculus',
            'Web Programming 1',
            'Operating Systems 1',
            'Software Engineering 1',
            'Comparative Programming Languages',
            'Data Structures',
            'Discrete Mathematics',
            'Analysis of Algorithms',
            'Web Programming 2',
            'Software Engineering 2',
            'Databases 2',
            'Operating Systems 2',
            'Information Retrieval',
            'Advanced Networking and Data Security',
            'Mobile Applications',
            'Computer Graphics',
            'Data Mining and Machine Learning',
            'Artificial Intelligence',


        ];

        foreach ($courses as $course) {
            Course::create([
                'name' => $course,
                'credit' => rand(2, 5),
                'department' => $departments[rand(0, sizeof($departments) - 1)],
            ]);
        }
    }
}
