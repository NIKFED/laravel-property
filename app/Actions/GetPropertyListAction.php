<?php

declare(strict_types=1);

namespace App\Actions;

use App\Contracts\PropertyIndexInterface;
use App\Http\Resources\PropertyResource;
use App\Models\Property;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

final class GetPropertyListAction implements PropertyIndexInterface
{
    public function __invoke(): AnonymousResourceCollection
    {
        return PropertyResource::collection(
            Property::with(['user'])->paginate(),
        );
    }
}
