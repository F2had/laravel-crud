<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Student::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'department' => $this->faker->randomElement([
                'Information Systems',
                'Software Engineering',
                'Artificial Intelligence',
                'Computer System and Network',
                'Multimedia',
                'Data Science',
            ]),
            'phone' => $this->faker->mobileNumber(),
            'address' => $this->faker->address(),
            'state' => $this->faker->state(),
            'country' => $this->faker->country(),
            'nationality' => $this->faker->country(),

        ];
    }
}
