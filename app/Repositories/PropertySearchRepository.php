<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Contracts\SearchRepositoryContract;
use App\Models\Property;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class PropertySearchRepository implements SearchRepositoryContract
{
    public function search(string $query): Collection
    {
        return Property::query()
            ->where(fn(Builder $builder) => (
                $builder->where('description', 'ILIKE', "%$query%")
                    ->orWhere('tags', 'ILIKE', "%$query%")
            ))
            ->limit(10)
            ->get();
    }
}
