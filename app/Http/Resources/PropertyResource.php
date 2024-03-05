<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes\Schema;

#[Schema(
    schema: 'Property_Resource',
    properties: [
        new \OpenApi\Attributes\Property(
            property: 'user_name',
            description: 'User name',
            type: 'string',
            example: 'Alex',
        ),
        new \OpenApi\Attributes\Property(
            property: 'price',
            description: 'Property price',
            type: 'integer',
            example: 100000,
        ),
        new \OpenApi\Attributes\Property(
            property: 'bedrooms',
            description: 'Bedrooms count',
            type: 'integer',
            example: 3,
        ),
        new \OpenApi\Attributes\Property(
            property: 'bathrooms',
            description: 'Bathrooms count',
            type: 'integer',
            example: 3,
        ),
        new \OpenApi\Attributes\Property(
            property: 'storeys',
            description: 'Storeys count',
            type: 'integer',
            example: 3,
        ),
        new \OpenApi\Attributes\Property(
            property: 'garages',
            description: 'Garages count',
            type: 'integer',
            example: 3,
        ),
    ],
)]
/** @mixin Property */
class PropertyResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'user_name'   => $this->user->name,
            'price'       => $this->price,
            'bedrooms'    => $this->bedrooms,
            'bathrooms'   => $this->bathrooms,
            'storeys'     => $this->storeys,
            'garages'     => $this->garages,
            'description' => $this->description,
            'tags'        => $this->tags,
        ];
    }
}
