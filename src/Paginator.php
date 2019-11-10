<?php

namespace Galexth\LaravelPagination;

use Illuminate\Support\Collection;

class Paginator extends AbstractPaginator
{
    /**
     * @var bool
     */
    protected $hasMore = false;

    /**
     * Paginator constructor.
     *
     * @param \Illuminate\Support\Collection $collection
     * @param int                            $offset
     * @param int                            $limit
     */
    public function __construct(Collection $collection, int $offset = 0, int $limit = 20)
    {
        parent::__construct($collection, $offset, $limit);

        $this->checkForMorePages();
    }

    /**
     * Check for more pages. The last item will be sliced off.
     *
     * @return void
     */
    protected function checkForMorePages()
    {
        $this->hasMore = $this->items->count() > $this->limit;

        $this->items = $this->items->slice(0, $this->limit);
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'limit' => $this->limit,
            'offset' => $this->offset,
            'has_more' => $this->hasMore,
            'data' => $this->items->toArray(),
        ];
    }

}
