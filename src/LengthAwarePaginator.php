<?php

namespace Galexth\LaravelPagination;

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
        parent::__construct($collection, $offset, $limit);

        $this->total = $total;
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
            'total' => $this->total,
            'data' => $this->items->toArray(),
        ];
    }

}
