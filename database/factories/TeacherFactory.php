<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Specialization;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Teacher>
 */
class TeacherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'specialization_id' => Specialization::query()->create([
                'name' => ['ar' => $this->faker->word(),
                'en' => $this->faker->word()]
                ])->id,
            'gender' => $this->faker->randomElement(['male', 'female']),
            'joining_date' => $this->faker->date(),
            'address' => $this->faker->address(),
        ];
    }
}
