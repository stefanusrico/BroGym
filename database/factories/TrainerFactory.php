<?php

namespace Database\Factories;

use App\Models\Trainer;
use Illuminate\Database\Eloquent\Factories\Factory;

class TrainerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nama_trainer' => $this->faker->name,
            'gaji' => $this->faker->numberBetween(30000, 100000),
            'email' => $this->faker->unique()->safeEmail,
            // Add any other fields as needed
        ];
    }
}
