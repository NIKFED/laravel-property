<?php

declare(strict_types=1);

namespace App\Queries;

use App\Models\Property;
use App\Queries\Filters\MaxPriceSearchFilter;
use App\Queries\Filters\MinPriceSearchFilter;
use App\Queries\Filters\UserNameSearchFilter;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

final class GetPropertyListQuery extends QueryBuilder
{
    public function __construct()
    {
        $query = Property::query();

        parent::__construct($query);

        $query->with([
            'user',
        ]);

        $this
            ->defaultSort('-created_at')
            ->allowedSorts([
                'price',
                'bedrooms',
                'bathrooms',
                'storeys',
                'garages',
            ])
            ->allowedFilters([
                AllowedFilter::exact('bedrooms'),
                AllowedFilter::exact('bathrooms'),
                AllowedFilter::exact('storeys'),
                AllowedFilter::exact('garages'),
                AllowedFilter::custom('user_name', new UserNameSearchFilter()),
                AllowedFilter::custom('min_price', new MinPriceSearchFilter()),
                AllowedFilter::custom('max_price', new MaxPriceSearchFilter()),
            ]);
    }
}
