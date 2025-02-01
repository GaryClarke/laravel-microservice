<?php // app/Http/Controllers/WebhookController.php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\DTOs\Webhook;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class WebhookController
{
    public function __invoke(Request $request): JsonResponse
    {
        // Determine the platform from header
        $platform = strtolower($request->header('X-Webhook-Source', 'unknown'));

        // Get the payload off of the request
        $payload = $request->all();

        // Instantiate the webhook DTO
        $webhook = new Webhook($platform, $payload);

        // ... do something with the webhook

        return new JsonResponse(status: Response::HTTP_NO_CONTENT);
    }
}
