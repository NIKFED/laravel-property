<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\RoomEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoomFactory extends Factory
{
    public function definition(): array
    {
        return [
            'entity' => $this->faker->randomElement(RoomEnum::cases()),
            'count' => $this->faker->numberBetween(1, 10),
            'additional_info' => [
                'state' => $this->faker->word(),
                'status' => $this->faker->word(),
                'square' => $this->faker->numberBetween(10, 100),
            ],
        ];
    }
}
