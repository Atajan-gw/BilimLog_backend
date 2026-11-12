<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SubjectFactory extends Factory
{
    public function definition(): array {
        return ['name' => fake()->unique()->words(2, true), 'credits' => fake()->numberBetween(2, 8), 'description' => fake()->sentence()];
    }
}
