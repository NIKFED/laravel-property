<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\RoomEnum;
use App\Models\Property;
use App\Models\Room;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PropertyFactory extends Factory
{
    public function definition(): array
    {
        /** @var User $user */
        $user = User
            ::query()
            ->inRandomOrder()
            ->first();

        return [
            'user_id' => $user->id,
            'price' => $this->faker->numberBetween(1, 100000),
            'storeys' => $this->faker->numberBetween(1, 3),
            'description' => $this->faker->text(100),
            'tags' => collect(['php', 'ruby', 'java', 'javascript', 'bash'])
                ->random(2)
                ->values()
                ->all(),
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function (Property $property) {
            if ($this->faker->boolean()) {
                $this->attachPropertyRoom($property, RoomEnum::ROOM);
            }

            if ($this->faker->boolean()) {
                $this->attachPropertyRoom($property, RoomEnum::BEDROOM);
            }

            if ($this->faker->boolean()) {
                $this->attachPropertyRoom($property, RoomEnum::BATHROOM);
            }

            if ($this->faker->boolean()) {
                $this->attachPropertyRoom($property, RoomEnum::GARAGE);
            }

            if ($this->faker->boolean()) {
                $this->attachPropertyRoom($property, RoomEnum::KITCHEN);
            }
        });
    }

    private function attachPropertyRoom(Property $property, RoomEnum $roomEnum): void
    {
        $property->rooms()->attach(
            Room
                ::factory(['entity' => $roomEnum->value])
                ->create()
                ->id
        );
    }
}
