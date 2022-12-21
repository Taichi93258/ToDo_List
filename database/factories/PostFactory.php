<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Enums\Release;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'task_name' => fake()->realText(10),
            'task_description' => fake()->realText(10),
            'estimate_hour' => fake()->randomNumber(2),
            'priority' => fake()->numberBetween(1, 3),
            'release' => Release::PUBLIC->value,
        ];
    }
}