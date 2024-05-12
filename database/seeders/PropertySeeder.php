<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Property;

final class PropertySeeder extends DatabaseSeeder
{
    public function run(): void
    {
        $this->command->warn(PHP_EOL . 'Creating properties...');
        $this->withProgressBar(5000, fn() => Property::factory(1)->createQuietly());
        $this->command->info('Properties created!');
    }
}
