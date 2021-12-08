<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Room;
use App\Models\RoomType;
use Faker\Factory;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
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
            Room::create([
                'price' => $faker->randomNumber(2),
                'floor' => $faker->numberBetween(1,5),
                'branch_id' => Branch::inRandomOrder()->first()->id,
                'room_type_id' => RoomType::inRandomOrder()->first()->id,
            ]);
        }
    }
}
