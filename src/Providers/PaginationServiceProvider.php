<?php

namespace Galexth\LaravelPagination\Providers;

use Galexth\LaravelPagination\LengthAwarePaginator;
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
        Builder::macro('offsetPaginate', function (int $offset = 0, int $limit = 20, array $columns = ['*']) {
            /** @var Builder $this */
            $total = $this->count($columns);
            /** @var Builder $this */
            $results = $this->skip($offset)->limit($limit)->get();

            return new LengthAwarePaginator($results, $total, $offset, $limit);
        });
    }

}
