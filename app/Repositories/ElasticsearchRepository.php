<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Contracts\SearchRepositoryContract;
use App\Models\Property;
use Elastic\Elasticsearch\Client;
use Elastic\Elasticsearch\Exception\ClientResponseException;
use Elastic\Elasticsearch\Exception\ServerResponseException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;

final readonly class ElasticsearchRepository implements SearchRepositoryContract
{
    public function __construct(
        private Client $elasticsearch,
    )
    {
    }

    /**
     * @throws ClientResponseException
     * @throws ServerResponseException
     */
    public function search(string $query = ''): Collection
    {
        $items = $this->searchOnElasticsearch($query);
//        dd($items);

        return $this->buildCollection($items);
    }

    /**
     * @throws ClientResponseException
     * @throws ServerResponseException
     */
    private function searchOnElasticsearch(string $query = ''): array
    {
        $model = new Property;

        return $this->elasticsearch->search([
            'index' => $model->getSearchIndex(),
            'type' => $model->getSearchType(),
            'body' => [
                'query' => [
                    'bool' => [
                        'should' => [
                            [
                                'wildcard' => [
                                    'description' => [
                                        'value' => "*$query*",
                                    ],
                                ],
                            ],
                            [
                                'wildcard' => [
                                    'tags' => [
                                        'value' => "*$query*",
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ])->asArray();
    }

    private function buildCollection(array $items): Collection
    {
        $ids = Arr::pluck($items['hits']['hits'], '_id');

        return Property::query()->findMany($ids)
            ->sortBy(function ($article) use ($ids) {
                return array_search($article->getKey(), $ids);
            });
    }
}