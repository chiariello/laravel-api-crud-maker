<?php

namespace Chiariello\LaravelApiCrudMaker\Traits;


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

trait ModelDispatcher{
    function getModel()
    {
        $routeArray = Str::parseCallback(Route::currentRouteAction(), null);
        if (last($routeArray) != null) {
            $controller = str_replace('Controller', '', class_basename(head($routeArray)));
            return $controller;
        }

        return null;
    }
}
