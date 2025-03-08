<?php // app/Error/DebugErrorHandler.php

declare(strict_types=1);

namespace App\Error;

use App\Contracts\ErrorHandler;
use Throwable;

class DebugErrorHandler implements ErrorHandler
{
    /**
     * @throws Throwable
     */
    public function handle(Throwable $throwable): void
    {
        throw $throwable;
    }
}
