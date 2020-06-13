<?php

namespace App\Core\Listing;

use Illuminate\Database\Eloquent\Collection;

class Listing
{
    private $filters = [];
    private $columns = [];
    private $orders = [];
    private $callbackMap = [];

    public static function new()
    {
        return new static;
    }

    public function setColumns(array $columns)
    {
        $this->columns = $columns;

        return $this;
    }

    public function setFilters(array $filters)
    {
        $this->filters = new Collection($filters);

        return $this;
    }

    public function setOrders(array $orders)
    {
        $this->orders = $orders;

        return $this;
    }

    public function map($callback)
    {
        $this->callbackMap = $callback;

        return $this;
    }

    protected function hasFilter(string $filterName)
    {
        return $this->filters->has($filterName) && !is_null($this->filters->get($filterName));
    }

    protected function getFilter(string $filterName)
    {
        return $this->filters->get($filterName);
    }

    private function applyColumns($query)
    {
        foreach ($this->availableColumns() as $columnName => $select) {
            if (in_array($columnName, $this->columns)) {
                $query->selectRaw($select . ' as ' . $columnName);
            }
        }

        return $query;
    }

    private function applyOrders($query)
    {
        foreach ($this->orders as $column => $order) {
            $query->orderBy($column, $order);
        }

        return $query;
    }

    public function paginate($perPage = 15)
    {
        $data = $this->applyColumns($this->applyOrders($this->buildQuery()))->paginate($perPage);

        if ($this->callbackMap) {
            $data->setCollection($data->getCollection()->transform($this->callbackMap));
        }

        return $data;
    }

    public function collect()
    {
        $data = $this->applyColumns($this->applyOrders($this->buildQuery()))
            ->get();

        if ($this->callbackMap) {
            return $data->map($this->callbackMap);
        }

        return $data;
    }

    public function toArray()
    {
        return $this->collect()->toArray();
    }
}
