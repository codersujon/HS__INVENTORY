<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Supplier>
 */
class SupplierFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
           'supplier_name' => fake()->name(),
           'contact_person' => fake()->name(),
           'mobile_no' => fake()->numerify('017########'),
           'email' => fake()->unique()->freeEmail(),
           'city' => fake()->city(),
           'country' => fake()->country(),
           'address' => fake()->address(),
           'website' => fake()->domainName(),
        ];
    }
}
