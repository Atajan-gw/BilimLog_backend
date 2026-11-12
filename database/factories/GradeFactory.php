<?php

namespace Database\Factories;

use App\Models\Student;
use App\Models\Subject;
use Illuminate\Database\Eloquent\Factories\Factory;

class GradeFactory extends Factory
{
    public function definition(): array {
        return ['student_id' => Student::factory(), 'subject_id' => Subject::factory(), 'score' => fake()->randomFloat(2, 0, 100), 'semester' => fake()->randomElement(['2025-Fall', '2026-Spring'])];
    }
}
