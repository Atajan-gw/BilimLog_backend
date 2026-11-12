<?php

namespace Database\Factories;

use App\Models\Faculty;
use App\Models\Group;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    public function definition(): array {
        $faculty = Faculty::factory();
        return [
            'user_id' => User::factory(),
            'faculty_id' => $faculty,
            'group_id' => Group::factory(),
            'specialty' => fake()->jobTitle(),
            'course_year' => fake()->numberBetween(1, 4),
            'student_id_card_number' => strtoupper(fake()->unique()->bothify('STU-######')),
        ];
    }
}
