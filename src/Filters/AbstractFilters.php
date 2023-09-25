<?php

namespace Chiariello\LaravelApiCrudMaker\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class AbstractFilters
{
    protected Request $request;

    protected array $filters = [];
    protected array $with = [];

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function apply(Builder $builder)
    {
        $this->builder = $builder;

        $this->builder->with($this->with);

        foreach ($this->getFilters() as $field => $value) {
            if (method_exists($this, $field)) {
                $this->{$field}($value);
            }
        }

        $sortResult = $this->hookSort($this->request->order['attribute'], $this->request->order['direction']);
        if(!$sortResult) {
            $this->sort($this->request->order['attribute']);
        }

    }

    protected function hookSort($attribute, $direction) : bool
    {
        return false;
    }

    protected function getFilters()
    {
        return array_filter($this->request->data ?? [], fn($value)=>(!is_null($value)));
    }

    public function sort(string $sort)
    {
        $this->builder->orderBy($sort, $this->request->order['direction'] === 'asc' ? 'asc' : 'desc');
    }

    public function like(string $column, $value)
    {
        $this->builder->where($column, $this->getLike(), "%{$value}%");
    }

    public function equal(string $column, $value)
    {
        $this->builder->where($column, $value);
    }

    public function greaterThanEqual(string $column, $value)
    {
        $this->builder->where($column, '>=', $value);
    }

    public function lessThanEqual(string $column, $value)
    {
        $this->builder->where($column, '<=', $value);
    }

    public function getLike(){
        return env('DB_CONNECTION') == 'pgsql' ? 'ilike' : 'like';
    }
}
