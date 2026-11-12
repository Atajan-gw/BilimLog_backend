<?php

namespace Database\Factories;

use App\Models\Faculty;
use Illuminate\Database\Eloquent\Factories\Factory;

class GroupFactory extends Factory
{
    public function definition(): array {
        return ['name' => strtoupper(fake()->bothify('CS-##')), 'faculty_id' => Faculty::factory(), 'course_number' => fake()->numberBetween(1, 4)];
    }
}
