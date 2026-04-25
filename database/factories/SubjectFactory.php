<?php

namespace Database\Factories;

use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subject>
 */
class SubjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "name" => [
                "ar" => $this->faker->unique()->word(),
                "en" => $this->faker->unique()->word()
            ],
            "code" => $this->faker->unique()->numerify('SUBJ-###'),
            "grade_id" => Grade::factory(),
            "classroom_id" => Classroom::factory()->state(function(array $attributes) {
                return [
                    "grade_id" => $attributes['grade_id']
                ];
            }),
            "teacher_id" => Teacher::factory()
        ];
    }
}
