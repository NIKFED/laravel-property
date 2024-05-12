<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Mustache_Engine;
use Mustache_Loader_FilesystemLoader;

final class TestMustacheCommand extends Command
{
    protected $signature = 'test:mustache';

    protected $description = '';
    public function handle(): void
    {
        $m = new Mustache_Engine([
            'loader' => new Mustache_Loader_FilesystemLoader(resource_path('/views/templates/elasticsearch')),
        ]);

        $tpl = $m->loadTemplate('hello');
        echo $tpl->render([
            'name' => 'Hello World',
            'value' => 10000,
            'in_ca' => true,
            'taxed_value' => 1000,
        ]);
    }
}