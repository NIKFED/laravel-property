<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Property;
use App\Models\User;
use Illuminate\Database\Seeder;

final class PropertySeeder extends Seeder
{
    public function run(): void
    {
        Property::query()->truncate();

        $csvFile = fopen(base_path("database/data/property-data.csv"), "r");

        $isFirstLine = true;
        while (($data = fgetcsv($csvFile, 200))) {
            if ($isFirstLine) {
                $isFirstLine = false;
                continue;
            }

            $user = User::factory()->createOne([
                'name' => $data['0'],
            ]);

            Property::query()->create([
                'user_id' => $user->id,
                'price' => $data['1'],
                'bedrooms' => $data['2'],
                'bathrooms' => $data['3'],
                'storeys' => $data['4'],
                'garages' => $data['5'],
            ]);
        }

        fclose($csvFile);
    }
}
