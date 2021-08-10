<?php

namespace Database\Seeders;

use App\Models\Clients;
use Faker\Provider\Payment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('accounts')->insert([
            'client_id' => Clients::all()->random()->id,
            'iban' => Payment::iban(),
        ]);
    }
}
