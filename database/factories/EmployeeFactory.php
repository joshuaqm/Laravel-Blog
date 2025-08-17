<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'full_name' => $this->faker->name(),
            'initials' => function (array $attributes) {
                $name = $attributes['full_name'];
                $words = explode(' ', $name);
                $initials = '';
                
                foreach ($words as $word) {
                    $initials .= mb_substr($word, 0, 1); // Usamos mb_substr para soportar UTF-8 (tildes, ñ, etc.)
                }
                
                return strtoupper($initials); // Ejemplo: "Juan Pérez" → "JP"
            },
        ];
    }
}
