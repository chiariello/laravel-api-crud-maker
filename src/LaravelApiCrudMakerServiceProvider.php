<?php

namespace Chiariello\LaravelApiCrudMaker;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Chiariello\LaravelApiCrudMaker\Commands\LaravelApiCrudMakerCommand;

class LaravelApiCrudMakerServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-api-crud-maker')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel-api-crud-maker_table')
            ->hasCommand(LaravelApiCrudMakerCommand::class);
    }
}
