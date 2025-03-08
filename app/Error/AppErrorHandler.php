<?php // app/Error/AppErrorHandler.php

declare(strict_types=1);

namespace App\Error;

use App\Contracts\ErrorHandler;
use Illuminate\Support\Facades\Log;
use Throwable;

class AppErrorHandler implements ErrorHandler
{
    public function handle(Throwable $throwable): void
    {
        // Log the error
        Log::error('An error occurred', [
            'message' => $throwable->getMessage(),
            'trace' => $throwable->getTraceAsString(),
            'file' => $throwable->getFile(),
            'line' => $throwable->getLine(),
        ]);

        // Ideally this should send alerts to external systems
        // like Sentry, Datadog, or another monitoring tool.
    }
}
