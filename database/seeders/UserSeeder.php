<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;

final class UserSeeder extends DatabaseSeeder
{
    public function run(): void
    {
        $this->command->warn(PHP_EOL . 'Creating users...');
        $this->withProgressBar(100, fn() => User::factory(1)->createQuietly());
        $this->command->info('Users created!');
    }
}
