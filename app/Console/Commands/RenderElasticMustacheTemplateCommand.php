<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Elastic\Elasticsearch\Client;
use Elastic\Elasticsearch\Exception\ClientResponseException;
use Elastic\Elasticsearch\Exception\MissingParameterException;
use Elastic\Elasticsearch\Exception\ServerResponseException;
use Illuminate\Console\Command;
use Mustache_Engine;
use Mustache_Loader_FilesystemLoader;

final class RenderElasticMustacheTemplateCommand extends Command
{
    protected $signature = 'render:elastic-mustache-template';

    protected $description = 'Render mustache templates for Elasticsearch';

    public function __construct(
        private readonly Client $elasticsearch,
    ) {
        parent::__construct();
    }


    /**
     * @throws ClientResponseException
     * @throws ServerResponseException
     * @throws MissingParameterException
     */
    public function handle(): void
    {
        $templateName = 'search_property';

        $m = new Mustache_Engine([
            'loader' => new Mustache_Loader_FilesystemLoader(resource_path('/views/templates/elasticsearch')),
        ]);

        $tpl = $m->loadTemplate($templateName);

//        $result = $this->elasticsearch->putScript([
//            'id' => $templateName,
//            'body' => [
//                'script' => [
//                    'lang' => 'mustache',
//                    'source' => $tpl->render([
//                        'query' => '{{query}}'
//                    ]),
//                ],
//            ],
//        ]);
//        dd($result->asArray());

//        $result = $this->elasticsearch->renderSearchTemplate([
//            'id' => $templateName,
//            'body' => [
//                'params' => [
//                    'query' => 'minus php provident',
//                ],
//            ],
//        ]);
//        dd($result->asArray());

//        $result = $this->elasticsearch->searchTemplate([
//            'index' => 'properties',
//            'body' => [
//                'id' => $templateName,
//                'params' => [
//                    'query' => 'minus php provident',
//                ],
//            ],
//        ]);
//        dd($result->asArray());


        $this->info("\nDone!");
    }
}