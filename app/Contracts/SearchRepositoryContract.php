<?php

declare(strict_types=1);

namespace App\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface SearchRepositoryContract
{
    public function search(string $query): Collection;
}