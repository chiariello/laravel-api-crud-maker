<?php

namespace Chiariello\LaravelApiCrudMaker\Providers;

use Chiariello\LaravelApiCrudMaker\Filters\AbstractFilters;
use Chiariello\LaravelApiCrudMaker\Traits\ModelDispatcher;
use Illuminate\Support\ServiceProvider;

class FilterServiceProvider extends ServiceProvider
{
    use ModelDispatcher;

    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(AbstractFilters::class, function ($app): ?AbstractFilters {
            $model = $this->getModel();

            return
                ($model) ?
                    $app->make('App\Filters\\'.$model.'Filters') :
                    $app->make('App\Filters\UserFilters');
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
