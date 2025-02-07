<?php // app/Providers/AppServiceProvider.php

namespace App\Providers;

use App\Contracts\WebhookHandler;
use App\Handlers\AppleWebhookHandler;
use App\Handlers\GoogleWebhookHandler;
use App\Handlers\HandlerDelegator;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->tag([
            AppleWebhookHandler::class,
            GoogleWebhookHandler::class
        ], WebhookHandler::class);

        $this->app->bind(HandlerDelegator::class, function (Application $app) {
            return new HandlerDelegator($app->tagged(WebhookHandler::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
