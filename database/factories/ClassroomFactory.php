<?php

namespace Database\Factories;
use App\Models\Grade;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Classroom>
 */
class ClassroomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => [
                'ar' => 'classroom A',
                'en' => 'الصف الدراسي أ'
            ],
            'grade_id' => Grade::factory()
        ];
    }
}
