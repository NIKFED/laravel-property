<?php

declare(strict_types=1);

namespace App\Actions;

use App\Contracts\PropertyIndexInterface;
use App\Http\Resources\PropertyResource;
use App\Models\Property;
use App\Queries\GetPropertyListQuery;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

final class GetPropertyListWithFilterAction implements PropertyIndexInterface
{
    public function __invoke(): AnonymousResourceCollection
    {
        $query = new GetPropertyListQuery();

        return PropertyResource::collection(
            $query->paginate(),
        );
    }
}