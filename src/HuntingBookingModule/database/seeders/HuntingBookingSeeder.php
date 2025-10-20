<?php
namespace test186\HuntingBookingModule\Database\Seeders;

use Illuminate\Database\Seeder;
use test186\HuntingBookingModule\Models\{HuntingBooking, Service, Guide};

/**
* Сеятель HuntingBooking
*/
class HuntingBookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create('ru_RU');

        for ($i = 0; $i < 100; $i ++) {
            $bookingDate = $faker->dateTimeBetween('now', '+3 months');
            $createdDate = $faker->dateTimeBetween('-2 months', $bookingDate);

            try {
                HuntingBooking::create([
                    'guide_id' => Guide::inRandomOrder()->first()->id,
                    'service_id' => Service::inRandomOrder()->first()->id,
                    'date' => $bookingDate->format('Y-m-d'),
                    'participants_count' => $faker->numberBetween(1, 8),
                    'created_at' => $createdDate,
                    'updated_at' => $faker->dateTimeBetween($createdDate, '+1 months'),
                ]);
            } catch(\Throwable $e) {
            }
        }
    }
}