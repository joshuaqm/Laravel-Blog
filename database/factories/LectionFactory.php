<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lection>
 */
class LectionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(3), // Generate a random name for the lection
            'section_id' => $this->faker->numberBetween(1, 20), // Assuming you have 20 sections, adjust as necessary
        ];
    }
}
