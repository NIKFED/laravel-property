<?php

declare(strict_types=1);

namespace App\Providers;

use App\Contracts\SearchRepositoryContract;
use App\Repositories\ElasticsearchRepository;
use App\Repositories\PropertySearchRepository;
use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;
use Elastic\Elasticsearch\Client;
use Elastic\Elasticsearch\ClientBuilder;
use Illuminate\Support\ServiceProvider;
use Laravel\Telescope\TelescopeServiceProvider as LaravelTelescopeServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if ($this->app->isLocal()) {
            $this->app->register(LaravelTelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
            $this->app->register(IdeHelperServiceProvider::class);
        }

        $this->app->bind(SearchRepositoryContract::class, function ($app) {
            // This is useful in case we want to turn off our
            // search cluster or when deploying the search
            // to a live, running application at first.
            if (! config('services.search.enabled')) {
                return new PropertySearchRepository();
            }

            return new ElasticsearchRepository(
                $app->make(Client::class)
            );
        });

        $this->bindSearchClient();
    }

    private function bindSearchClient(): void
    {
        $this->app->bind(Client::class, function ($app) {
            return ClientBuilder::create()
                ->setHosts($app['config']->get('services.search.hosts'))
                ->build();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
