<?php

namespace Database\Factories;

use App\Models\Lesson;
use App\Models\Mark;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class MarkFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Mark::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'value' => $this->faker->numberBetween(0, 20),
            'student_id' => Student::all()->random()->id,
            'lesson_id' => Lesson::all()->random()->id,
        ];
    }
}