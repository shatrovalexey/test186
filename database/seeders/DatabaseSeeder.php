<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\{ServiceSeeder, GuideSeeder, HuntingBookingSeeder};

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ServiceSeeder::class,
            GuideSeeder::class,
            HuntingBookingSeeder::class,
        ]);
    }
}