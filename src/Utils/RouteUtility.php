<?php

namespace Chiariello\LaravelApiCrudMaker\Utils;

use Illuminate\Support\Facades\Route;

class RouteUtility
{
    /**
     * Set canonical routes for Controller
     * @param string $controllerName
     * @param string $routeName
     * @param array $excludedMethods
     * @return void
     */
    public static function controllerRoutes(string $controllerName, string $routeName, array $excludedMethods = []){
        if(!in_array('getPage',$excludedMethods)) Route::post($routeName,[$controllerName,'getPage']);
        if(!in_array('index',$excludedMethods)) Route::get($routeName,[$controllerName,'index']);
        if(!in_array('show',$excludedMethods)) Route::get($routeName.'/{id}',[$controllerName,'show']);
        if(!in_array('store',$excludedMethods)) Route::post($routeName.'/store',[$controllerName,'store']);
        if(!in_array('destroy',$excludedMethods)) Route::delete($routeName.'/{id}',[$controllerName,'destroy']);
        if(!in_array('update',$excludedMethods)) Route::patch($routeName.'/{id}',[$controllerName,'update']);
    }

    public static function exportRoute($controller, $routename){
        Route::post($routename.'/export',[$controller,'export']);
    }
}
