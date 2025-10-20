<?php
namespace test186\HuntingBookingModule\Database\Seeders;

use Illuminate\Database\Seeder;
use test186\HuntingBookingModule\Models\Service;

/**
* Сеятель Service
*/
class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create('ru_RU');
        $tourTypes = ['Охотничий', 'Рыболовный', 'Экскурсионный', 'Экстремальный', 'Семейный'];
        $tourTargets = ['на кабана', 'на птицу', 'на оленя', 'на рыбу', 'по грибы'];

        for ($i = 0; $i < 10; $i ++) {
            Service::create([
                'name' => $tourTypes[array_rand($tourTypes)] . ' тур ' . $tourTargets[array_rand($tourTargets)] . 
                         ' (' . $faker->numberBetween(30, 240) . ' мин)',
                'description' => $faker->boolean(70) ? $faker->sentence(10) : null,
                'price' => $faker->randomFloat(2, 1000, 20000),
                'is_active' => $faker->boolean(85),
                'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
                'updated_at' => $faker->dateTimeBetween('-1 year', 'now'),
            ]);
        }
    }
}