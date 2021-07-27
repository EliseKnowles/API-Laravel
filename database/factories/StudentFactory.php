<?php

namespace Database\Factories;

use App\Models\Grade;
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
            'name' => $this->faker->lastName,
            'firstname' => $this->faker->firstName,
            'age' => $this->faker->numberBetween(18, 30),
            'arrival_year' => $this->faker->numberBetween(2016, 2021),
            'grade_id' => Grade::all()->random()->id,
        ];
    }
}