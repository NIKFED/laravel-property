<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\Property;
use Elastic\Elasticsearch\Client;
use Elastic\Elasticsearch\Exception\ClientResponseException;
use Elastic\Elasticsearch\Exception\MissingParameterException;
use Elastic\Elasticsearch\Exception\ServerResponseException;
use Illuminate\Console\Command;

final class ReindexElasticsearchCommand extends Command
{
    protected $signature = 'search:reindex';

    protected $description = 'Indexes all properties to Elasticsearch';

    public function __construct(
        private readonly Client $elasticsearch,
    ) {
        parent::__construct();
    }

    /**
     * @throws ServerResponseException
     * @throws ClientResponseException
     * @throws MissingParameterException
     */
    public function handle(): void
    {
        $this->info('Indexing all properties...');

        $bar = $this->output->createProgressBar(Property::query()->count());
        $bar->start();

        foreach (Property::query()->cursor() as $property) {
            $this->elasticsearch->index([
                'index' => $property->getSearchIndex(),
                'type' => $property->getSearchType(),
                'id' => $property->getKey(),
                'body' => $property->toSearchArray(),
            ]);
            $bar->advance();
        }

        $bar->finish();
        $this->info("\nDone!");
    }
}
