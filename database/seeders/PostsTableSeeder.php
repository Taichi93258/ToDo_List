<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Enums\Release;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
            [
                'user_id' => 11,
                'release' => Release::PUBLIC->value,
                'task_name'      => 'テスト1',
                'task_description'  => 'テストデータです',
                'estimate_hour' => 10,
                'priority' => fake()->numberBetween(1, 3),
            ],

            [
                'user_id' => 11,
                'release' => Release::PUBLIC->value,
                'task_name'      => 'テスト2',
                'task_description'  => 'テストデータです',
                'estimate_hour' => 10,
                'priority' => fake()->numberBetween(1, 3),
            ],

            [
                'user_id' => 11,
                'release' => Release::PUBLIC->value,
                'task_name'      => 'テスト3',
                'task_description'  => 'テストデータです',
                'estimate_hour' => 10,
                'priority' => fake()->numberBetween(1, 3),
            ]
            ]);

        //Post::factory()->count(10)->create();
    }
}