<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class JudgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for ($i = 0; $i < 20; $i++) {
            $user = \App\User::create([
                'role' => 'judge',
                'first_name' => $faker->name,
                'last_name' => $faker->name,
                'username' => $faker->userName,
                'email' => $faker->email,
                'email_verified_at' => \Carbon\Carbon::now(),
                'password' => \Illuminate\Support\Facades\Hash::make('123')
            ]);
            \App\Models\Judge::create([
                'user_id' => $user->id
            ]);
        }
    }
}
