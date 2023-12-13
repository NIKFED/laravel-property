<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

final class PropertyFactory extends Factory
{
    public function definition(): array
    {
        $user = User::factory()->createOne();

        return [
            'user_id' => $user->id,
            'price' => $this->faker->numberBetween(1, 100000),
            'bedrooms' => $this->faker->numberBetween(1, 10),
            'bathrooms' => $this->faker->numberBetween(1, 3),
            'storeys' => $this->faker->numberBetween(1, 3),
            'garages' => $this->faker->numberBetween(1, 3),
        ];
    }
}
