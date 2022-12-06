<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'user_id' => function () {
                return User::factory(App\User::class)->create()->id;
            },
            'task_name' => fake()->name(),
            'task_description' => fake()->name(),
            'assign_person_name' => function () {
                return User::factory(App\User::class)->create()->name;
            },
            'estimate_hour' => fake()->randomNumber(2),
        ];
    }
}