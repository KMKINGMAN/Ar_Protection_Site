<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class IssueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $statuses = ['مدان', 'محتجز', 'معاقب', 'مطرود'];
        for ($i = 0; $i < 40; $i++) {
            $k = array_rand($statuses);
            $v = $statuses[$k];
            \App\Models\Issue::create([
                'user_id' => \App\User::inRandomOrder()->first()->id,
                'caseId' => $faker->numberBetween(1000000000, 9999999999),
                'name' => $faker->name,
                'status' => $v,
                'evidences' => "['evidences/test1.png', 'evidences/test1.png', 'evidences/test1.png']",
            ]);
        }
    }
}
