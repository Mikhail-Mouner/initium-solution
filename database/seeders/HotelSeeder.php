<?php

namespace Database\Seeders;

use App\Models\Hotel;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class HotelSeeder extends Seeder
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
            $name = $faker->name;
            Hotel::create([
                'hotel_name' => $name,
                'hotel_slug' => Str::slug($name),
            ]);
        }
    }
}
