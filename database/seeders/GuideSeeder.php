<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use test186\HuntingBookingModule\Models\Guide;

/**
* Сеятель Guide
*/
class GuideSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create('ru_RU');

        for ($i = 0; $i < 10; $i ++)
            Guide::create([
                'name' => implode(' ', [$faker->firstName, $faker->lastName]),
                'experience_years' => $faker->numberBetween(1, 20),
                'is_active' => $faker->boolean(90),
                'created_at' => $faker->dateTimeBetween('-2 years', 'now'),
                'updated_at' => $faker->dateTimeBetween('-2 years', 'now'),
            ]);
    }
}
