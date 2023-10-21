<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CreateAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::query()->firstOrCreate([
            'email' => 'admin@admin.com'
        ], [
            "name" => "Admin",
//            "password" => Hash::make('12345'),
            "password" => '12345',
            "type" => User::TYPES['admin'],
        ]);
    }
}
