<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->company,
            'url' => fake()->url,
            'street' => fake()->streetName,
            'zip' => fake()->postcode,
            'travel_time_train' => fake()->numberBetween(10, 120),
            'travel_time_car' => fake()->numberBetween(10, 120),
            'company_type' => fake()->randomElement(['Software development', 'Marketing Agency', 'Consulting'])
        ];

    }
}
