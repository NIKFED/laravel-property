<?php

declare(strict_types=1);

namespace App\Queries\Filters;

use App\Builders\UserBuilder;
use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Filters\Filter;

final class MinPriceSearchFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property): void
    {
        $query->where('price', '>=', $value);
    }
}
