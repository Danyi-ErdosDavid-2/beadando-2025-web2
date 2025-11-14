<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


class MessageFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->safeEmail(),
            'topic' => fake()->sentence(4),
            'content' => fake()->paragraph(),
            'submitted_at' => now(),
        ];
    }
}
