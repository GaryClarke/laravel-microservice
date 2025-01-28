<?php // routes/api.php

declare(strict_types=1);

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Route;

Route::get('/healthcheck', function (): JsonResponse {
    return new JsonResponse(['status' => 'ok']);
});

