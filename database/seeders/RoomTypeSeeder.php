<?php

namespace Database\Seeders;

use App\Models\RoomType;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class RoomTypeSeeder extends Seeder
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
            RoomType::create([
                'type' => Arr::random(['single','double','suits']),
            ]);
        }
    }
}
