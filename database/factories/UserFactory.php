<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'user_id' => (string) Str::uuid(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => bcrypt('password'), // Hoặc dùng Hash::make nếu muốn
            'name' => $this->faker->name(),
            'phone_number' => $this->faker->numerify('0##########'), // ví dụ: 0123456789
            'is_admin' => false,
        ];
    }
}
