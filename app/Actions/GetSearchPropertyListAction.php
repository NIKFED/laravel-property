<?php

declare(strict_types=1);

namespace App\Actions;

use App\Contracts\PropertySearchInterface;
use App\Contracts\SearchRepository;
use App\Http\Resources\PropertyResource;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

final class GetSearchPropertyListAction implements PropertySearchInterface
{
    /**
     * @throws BindingResolutionException
     */
    public function __invoke(string $search = ''): AnonymousResourceCollection
    {
        $properties = app()
            ->make(SearchRepository::class)
            ->search($search);

        return PropertyResource::collection(
            $properties,
        );
    }
}
