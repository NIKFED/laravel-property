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
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'search:reindex';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Indexes all articles to Elasticsearch';

    public function __construct(
        private readonly Client $elasticsearch,
    )
    {
        parent::__construct();
    }

    /**
     * @throws ServerResponseException
     * @throws ClientResponseException
     * @throws MissingParameterException
     */
    public function handle(): void
    {
        $this->info('Indexing all properties. This might take a while...');


        foreach (Property::query()->cursor() as $property)
        {
            $this->elasticsearch->index([
                'index' => $property->getSearchIndex(),
                'type' => $property->getSearchType(),
                'id' => $property->getKey(),
                'body' => $property->toSearchArray(),
            ]);

            // PHPUnit-style feedback
            $this->output->write('.');
        }

        $this->info("\nDone!");
    }
}