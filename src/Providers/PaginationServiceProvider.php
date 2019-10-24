<?php

namespace Galexth\LaravelPagination\Providers;

use Galexth\LaravelPagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Builder;

class PaginationServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Builder::macro('offsetPaginate', function (int $offset = 0, int $limit = 20) {
            /** @var Builder $this */
            $results = $this->skip($offset)->limit($limit)->get();

            return new Paginator($results, $offset, $limit);
        });
    }

}
