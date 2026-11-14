<?php

namespace Database\Factories;

use App\Models\Deal;
use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Deal>
 */
class DealFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
           'client_id' => Client::factory(), 
           'title' => fake()->sentence(3),
            'status' => fake()->randomElement(['Lead','In Progress','Won','Lost']), 
            'amount' =>  fake()->numberBetween(100000,500000),
             'start_date' => fake()->dateTimeBetween('-2 months', 'now'), 
             'due_date' => fake()->dateTimeBetween('now', '+3 months'),
        ];
    }
}
