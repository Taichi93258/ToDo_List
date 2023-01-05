<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)
            ->hasPosts(3)
            ->create();

        DB::table('users')->insert([
            [
                'name'           => '會澤大智',
                'email'          => 'test@gmail.com',
                'email_verified_at' => '2022-12-30 07:19:5',
                'password'       => Hash::make('password'),
                'remember_token' => Str::random(10),
            ]
            ]);
    }
}