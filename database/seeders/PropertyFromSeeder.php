<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Property;
use Illuminate\Database\Seeder;

final class PropertyFromSeeder extends Seeder
{
    public function run(): void
    {
        Property::factory(200000)->create();
    }
}
