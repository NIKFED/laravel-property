<?php

declare(strict_types=1);

namespace App\Actions;

use App\Contracts\PropertyIndexContract;
use App\Contracts\SearchRepositoryContract;
use App\Enums\PaginationEnum;
use App\Http\Resources\PropertyResource;
use App\Queries\GetPropertyListQuery;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

final class GetPropertyListWithFilterAction implements PropertyIndexContract
{
    public function __invoke(?int $perPage): AnonymousResourceCollection
    {
        $query = new GetPropertyListQuery();

        if (! $perPage) {
            $perPage = PaginationEnum::DEFAULT_PER_PAGE->value;
        }

        return PropertyResource::collection(
            $query->paginate($perPage),
        );
    }
}
