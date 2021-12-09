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
        $branchs = Branch::all();
        foreach ($branchs as $branch) {
            $branch->rooms()->create([
                'price' => $faker->randomNumber(2),
                'floor' => $faker->numberBetween(1,5),
                'room_type_id' => RoomType::inRandomOrder()->first()->id,
            ]);
        }
    }
}
