<?php

namespace Chiariello\LaravelApiCrudMaker\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Chiariello\LaravelApiCrudMaker\LaravelApiCrudMaker
 */
class LaravelApiCrudMaker extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Chiariello\LaravelApiCrudMaker\LaravelApiCrudMaker::class;
    }
}
