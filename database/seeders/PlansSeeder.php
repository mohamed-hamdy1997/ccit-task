<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Seeder;

class PlansSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Plan::query()->firstOrCreate([
            'name' => 'Pro',
            'price' => 10,
            'type' => Plan::TYPE['monthly'],
        ]);

        Plan::query()->firstOrCreate([
            'name' => 'Pro',
            'price' => 100,
            'type' => Plan::TYPE['annual'],
        ]);
    }
}
