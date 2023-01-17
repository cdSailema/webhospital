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
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),

            'cedula' => $this->faker->randomNumber(8, true),
            'surname' => $this->faker->name(),

            'phone' => $this->faker->tollFreePhoneNumber(),
            'address' => $this->faker->address(),
            'city' => $this->faker->city(),
            'birthday' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'gender' => $this->faker->randomElement(['Masculino', 'Femenino']),
            'role' => $this->faker->randomElement(['paciente', 'doctor']),

        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
