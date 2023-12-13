<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes\Property;
use OpenApi\Attributes\Schema;

#[Schema(
    schema: 'Property_Index_Request',
    properties: [
        new Property(
            property: 'per_page',
            description: 'Properties per page',
            type: 'integer',
            example: 20,
        ),
        new Property(
            property: 'filter[user_name]',
            description: 'Filter by user_name',
            type: 'string',
            example: 'Alex',
        ),
        new Property(
            property: 'filter[min_price]',
            description: 'Filter by min price',
            type: 'integer',
            example: 100000,
        ),
        new Property(
            property: 'filter[max_price]',
            description: 'Filter by max price',
            type: 'integer',
            example: 300000,
        ),
        new Property(
            property: 'filter[bedrooms]',
            description: 'Filter by bedroom count',
            type: 'integer',
            example: 3,
        ),
        new Property(
            property: 'filter[bathrooms]',
            description: 'Filter by bathroom count',
            type: 'integer',
            example: 3,
        ),
        new Property(
            property: 'filter[storeys]',
            description: 'Filter by storey count',
            type: 'integer',
            example: 3,
        ),
        new Property(
            property: 'filter[garages]',
            description: 'Filter by garage count',
            type: 'integer',
            example: 3,
        ),
        new Property(
            property: 'sort',
            description: 'price, bedrooms, bathrooms, storeys, of garages',
            type: 'string',
            example: 'price',
        ),
    ],
)]
class PropertyIndexRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'per_page' => 'integer',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
