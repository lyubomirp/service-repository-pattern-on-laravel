<?php

namespace Database\Factories;

use App\Models\Accounts;
use App\Models\Clients;
use Illuminate\Database\Eloquent\Factories\Factory;

class AccountsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Accounts::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'client_id' => Clients::all()->random()->id,
            "iban" => $this->faker->iban(),
        ];
    }
}
