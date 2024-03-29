<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Contracts\PropertyIndexContract;
use App\Contracts\PropertySearchContract;
use App\Http\Requests\PropertyIndexRequest;
use App\Http\Requests\PropertySearchRequest;
use Illuminate\Http\Resources\Json\ResourceCollection;
use OpenApi\Attributes\Get;
use OpenApi\Attributes\JsonContent;
use OpenApi\Attributes\Parameter;
use OpenApi\Attributes\Response;
use OpenApi\Attributes\Schema;

final class PropertyController extends Controller
{
    #[Get(
        path: '/properties',
        description: 'Get properties list with filters',
        summary: 'Get properties list',
        tags: ['Properties'],
        parameters: [
            new Parameter(
                name: 'Request',
                in: 'query',
                schema: new Schema(
                    ref: '#/components/schemas/Property_Index_Request',
                ),
            ),
        ],
        responses: [
            new Response(
                response: 200,
                description: 'Property list',
                content: new JsonContent(
                    ref: '#/components/schemas/Property_Resource',
                ),
            ),
        ],
    )]
    public function index(PropertyIndexRequest $request, PropertyIndexContract $propertyIndexAction): ResourceCollection
    {
        $perPage = (int) $request->validated('per_page');

        return $propertyIndexAction($perPage);
    }

    /**
     * @param PropertySearchRequest $request
     * @param PropertySearchContract $propertySearchAction
     * @return ResourceCollection
     */
    public function search(PropertySearchRequest $request, PropertySearchContract $propertySearchAction): ResourceCollection
    {
        return $propertySearchAction($request->validated('search'));
    }
}
