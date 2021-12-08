<?php

namespace Database\Seeders;

use App\Models\Location;
use Faker\Factory;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        for ($i=0;$i<15;$i++){
            Location::create([
                'location_name' => $faker->name,
            ]);
        }
    }
}
