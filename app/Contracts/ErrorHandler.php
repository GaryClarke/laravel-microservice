<?php // app/Contracts/ErrorHandler.php

declare(strict_types=1);

namespace App\Contracts;

use Throwable;

interface ErrorHandler
{
    /**
     * Handle the given throwable.
     *
     * @param Throwable $throwable The error or exception to handle.
     */
    public function handle(Throwable $throwable): void;
}
