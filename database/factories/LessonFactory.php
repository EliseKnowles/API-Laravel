<?php

namespace Database\Factories;

use App\Models\Grade;
use App\Models\Lesson;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;

class LessonFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Lesson::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'start_date' => $this->faker->dateTimeBetween('now'),
            'end_date' => $this->faker->dateTimeBetween('now', '+5 days'),
            'teacher_id' => Teacher::all()->random()->id,
            'grade_id' => Grade::all()->random()->id,
        ];
    }
}