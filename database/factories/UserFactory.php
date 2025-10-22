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
            'name'                  => 'JOAO LUIS',
            'email'                 => 'galvaojl@gmail.com',
            'email_verified_at'     => now(),
            'password'              => '$2y$10$Qis3Vc.rgVuo.NQ6Z4CAH.U11/m5yKTcEZ5kFWqWRVE4dJO7UBEFS',
            'nivel'                 => '1',
            'equipe'                => '1',
            'status'                => '1',            
            'remember_token'        => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return $this
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
