<?php

namespace Database\Seeders;

use App\Models\Accounts;
use App\Models\Clients;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//         User::factory(10)->create();
        Clients::factory(500)->create();
        Accounts::factory(1000)->create();
    }
}
