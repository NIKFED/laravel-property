<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Contracts\SearchableContract;
use App\Contracts\SearchRepositoryContract;
use App\Models\Property;
use Elastic\Elasticsearch\Client;
use Elastic\Elasticsearch\Exception\ClientResponseException;
use Elastic\Elasticsearch\Exception\ServerResponseException;
use Elastic\Elasticsearch\Response\Elasticsearch;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;
use Mustache_Engine;
use Mustache_Loader_FilesystemLoader;

final readonly class ElasticsearchRepository implements SearchRepositoryContract
{
    private Mustache_Engine $mustache;

    public function __construct(
        private Client $elasticsearch,
    ) {
        $this->mustache = new Mustache_Engine([
            'loader' => new Mustache_Loader_FilesystemLoader(resource_path('/views/templates/elasticsearch')),
        ]);
    }

    /**
     * @throws ClientResponseException
     * @throws ServerResponseException
     */
    public function search(string $query = ''): Collection
    {
        $items = $this->searchOnElasticsearch($query);

        return $this->buildCollection($items);
    }

    /**
     * @throws ClientResponseException
     * @throws ServerResponseException
     */
    private function searchOnElasticsearch(string $query = ''): array
    {
        $model = new Property();

//        return $this->searchByPhpArray($model, $query)->asArray();
        return $this->searchByMustache($model, $query)->asArray();
    }

    /**
     * @throws ServerResponseException
     * @throws ClientResponseException
     */
    private function searchByMustache(SearchableContract $model, string $query): Elasticsearch
    {
        $mustacheTemplate = $this->mustache->loadTemplate('search_property');

        return $this->elasticsearch->search([
            'index' => $model->getSearchIndex(),
            'type' => $model->getSearchType(),
            'body' => $mustacheTemplate->render([
                'query' => $query,
            ]),
        ]);
    }

    /**
     * @throws ClientResponseException
     * @throws ServerResponseException
     */
    private function searchByPhpArray(SearchableContract $model, string $query): Elasticsearch
    {
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
        ]);
    }

    private function buildCollection(array $items): Collection
    {
        $ids = Arr::pluck($items['hits']['hits'], '_id');

        return Property::query()->findMany($ids)
            ->sortBy(function ($article) use ($ids) {
                return array_search($article->getKey(), $ids, true);
            });
    }
}
