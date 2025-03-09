<?php // app/Providers/AppServiceProvider.php

namespace App\Providers;

use App\Contracts\ErrorHandler;
use App\Contracts\GoogleSubscriptionForwarder;
use App\Contracts\WebhookHandler;
use App\DTOs\Google\SubscriptionFactory;
use App\Error\AppErrorHandler;
use App\Error\DebugErrorHandler;
use App\Forwarders\Google\SubscriptionStartForwarder;
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
            SubscriptionStartForwarder::class
        ], GoogleSubscriptionForwarder::class);

        $this->app->bind(GoogleWebhookHandler::class, function (Application $app) {
            return new GoogleWebhookHandler(
                $app->make(SubscriptionFactory::class),
                $app->tagged(GoogleSubscriptionForwarder::class)
            );
        });

        $this->app->tag([
            AppleWebhookHandler::class,
            GoogleWebhookHandler::class
        ], WebhookHandler::class);

        $this->app->bind(HandlerDelegator::class, function (Application $app) {
            return new HandlerDelegator($app->tagged(WebhookHandler::class));
        });

        $this->app->singleton(ErrorHandler::class, function () {
            if (app()->environment('production')) {
                return AppErrorHandler::class;
            }

            return DebugErrorHandler::class;
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
