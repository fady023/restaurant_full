<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\MenuSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::updateOrCreate(["email"=>"admin@bistro.com"],[
            "name"=>"fady",
            "password"=>"abcd1234",
            "role"=>"admin",
            "phone"=>"0100"
        ]);

        $this->call(MenuSeeder::class);
    }
}
