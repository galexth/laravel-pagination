<?php

namespace Galexth\Pagination;

use Illuminate\Support\Collection;

class LengthAwarePaginator extends AbstractPaginator
{
    /**
     * @var int
     */
    protected $total;

    /**
     * LengthAwarePaginator constructor.
     *
     * @param \Illuminate\Support\Collection $collection
     * @param int                            $total
     * @param int                            $offset
     * @param int                            $limit
     */
    public function __construct(Collection $collection, int $total, int $offset = 0, int $limit = 20)
    {
        $this->limit = $limit;
        $this->offset = $offset;
        $this->total = $total;
        $this->items = $collection;
    }

    /**
     * Get the instance as an array.
     * @todo remove 'has_more'
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'limit' => $this->limit,
            'offset' => $this->offset,
            'total' => $this->total,
            'has_more' => $this->offset + $this->limit < $this->total,
            'data' => $this->items->toArray(),
        ];
    }

}
