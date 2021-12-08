<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Hotel;
use App\Models\Location;
use Faker\Factory;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
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
            Branch::create([
                'branch_name' => $faker->name,
                'location_id' => Location::inRandomOrder()->first()->id,
                'hotel_id' => Hotel::inRandomOrder()->first()->id,
            ]);
        }

    }
}
