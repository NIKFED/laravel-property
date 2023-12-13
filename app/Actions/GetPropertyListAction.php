<?php

declare(strict_types=1);

namespace App\Actions;

use App\Contracts\PropertyIndexInterface;
use App\Enums\PaginationEnum;
use App\Http\Resources\PropertyResource;
use App\Models\Property;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

final class GetPropertyListAction implements PropertyIndexInterface
{
    public function __invoke(?int $perPage): AnonymousResourceCollection
    {
        if (! $perPage) {
            $perPage = PaginationEnum::DEFAULT_PER_PAGE->value;
        }

        return PropertyResource::collection(
            Property::with(['user'])->paginate($perPage),
        );
    }
}
