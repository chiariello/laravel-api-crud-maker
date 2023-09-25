<?php

namespace Chiariello\LaravelApiCrudMaker\Traits;

use Chiariello\LaravelApiCrudMaker\Filters\AbstractFilters;
use Illuminate\Database\Eloquent\Builder;

trait HasFilters
{
    public function scopeFilter(Builder $builder, AbstractFilters $filters)
    {
        $filters->apply($builder);
    }
}
