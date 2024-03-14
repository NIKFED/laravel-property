<?php

declare(strict_types=1);

namespace App\Actions;

use App\Contracts\PropertySearchContract;
use App\Contracts\SearchRepositoryContract;
use App\Http\Resources\PropertySearchResource;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

final class GetSearchPropertyListAction implements PropertySearchContract
{
    /**
     * @throws BindingResolutionException
     */
    public function __invoke(string $search = ''): AnonymousResourceCollection
    {
        $properties = app()
            ->make(SearchRepositoryContract::class)
            ->search($search);

        return PropertySearchResource::collection(
            $properties,
        );
    }
}
