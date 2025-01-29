<?php // routes/api.php

declare(strict_types=1);

use App\Http\Controllers\WebhookController;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Route;

Route::get('/healthcheck', function (): JsonResponse {
    return new JsonResponse(['status' => 'ok']);
});

Route::post('/webhook', WebhookController::class);
