<?php

namespace Galexth\LaravelPagination;

use ArrayAccess;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Support\Collection;
use JsonSerializable;

abstract class AbstractPaginator implements Arrayable, ArrayAccess, JsonSerializable, Jsonable
{
    /**
     * All of the items being paginated.
     *
     * @var Collection
     */
    protected $items;

    /**
     * The number of items to be skipped.
     *
     * @var int
     */
    protected $offset;

    /**
     * The number of items to be shown per page.
     *
     * @var int
     */
    protected $limit;

    /**
     * LengthAwarePaginator constructor.
     *
     * @param \Illuminate\Support\Collection $collection
     * @param int                            $offset
     * @param int                            $limit
     */
    public function __construct(Collection $collection, int $offset = 0, int $limit = 20)
    {
        $this->limit = $limit;
        $this->offset = $offset;
        $this->items = $collection;
    }

    /**
     * @return array
     */
    abstract public function toArray();

    /**
     * Convert the object into something JSON serializable.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return $this->toArray();
    }

    /**
     * Convert the object to its JSON representation.
     *
     * @param  int  $options
     * @return string
     */
    public function toJson($options = 0)
    {
        return json_encode($this->jsonSerialize(), $options);
    }

    /**
     * Determine if the given item exists.
     *
     * @param  mixed  $key
     * @return bool
     */
    public function offsetExists($key)
    {
        return $this->items->has($key);
    }

    /**
     * Get the item at the given offset.
     *
     * @param  mixed  $key
     * @return mixed
     */
    public function offsetGet($key)
    {
        return $this->items->get($key);
    }

    /**
     * Set the item at the given offset.
     *
     * @param  mixed  $key
     * @param  mixed  $value
     * @return void
     */
    public function offsetSet($key, $value)
    {
        $this->items->put($key, $value);
    }

    /**
     * Unset the item at the given key.
     *
     * @param  mixed  $key
     * @return void
     */
    public function offsetUnset($key)
    {
        $this->items->forget($key);
    }

    /**
     * Get the paginator's underlying collection.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getCollection()
    {
        return $this->items;
    }
}
