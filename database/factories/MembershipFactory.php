<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Membership;
use App\Models\User;

class MembershipFactory extends Factory
{
    protected $model = Membership::class;

    public function definition()
    {
        return [
            'id_user' => User::factory()->create()->id, // This will create a new user and use its ID
            'status' => $this->faker->randomElement(['aktif', 'nonaktif']),
            'tanggal_langganan' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}