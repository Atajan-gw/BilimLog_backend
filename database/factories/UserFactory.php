<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected static ?string $password = null;

    public function definition(): array {
        return [
            'name' => fake()->firstName(),
            'surname' => fake()->lastName(),
            'phone_number' => fake()->unique()->numerify('+49###########'),
            'username' => fake()->unique()->userName(),
            'password' => static::$password ??= Hash::make('password'),
            'role' => 'student',
            'remember_token' => Str::random(10),
        ];
    }

    public function admin(): static { return $this->state(fn () => ['role' => 'admin']); }
}
