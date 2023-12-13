<?php

declare(strict_types=1);

namespace App\Queries\Filters;

use App\Builders\UserBuilder;
use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Filters\Filter;

final class UserNameSearchFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property): void
    {
        $query->whereHas('user', fn (UserBuilder $builder) => $builder->whereName($value));
    }
}
