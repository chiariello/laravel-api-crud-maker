<?php

namespace Chiariello\LaravelApiCrudMaker\Providers;

use Chiariello\LaravelApiCrudMaker\Requests\AbstractRequest;
use Chiariello\LaravelApiCrudMaker\Traits\ModelDispatcher;
use Illuminate\Support\ServiceProvider;

class RequestServiceProvider extends ServiceProvider
{
    use ModelDispatcher;

    public function register(): void
    {
        $this->app->bind(AbstractRequest::class, function ($app): ?AbstractRequest {
            return $app->make('App\Http\Requests\\'.$this->getModel().'Request');
        });
    }

    public function boot(): void
    {
        //
    }
}
