<?php // app/Http/Controllers/WebhookController.php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Contracts\ErrorHandler;
use App\DTOs\Webhook;
use App\Exceptions\WebhookException;
use App\Handlers\HandlerDelegator;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class WebhookController
{
    public function __construct(
        private HandlerDelegator $handlerDelegator,
        private ErrorHandler $errorHandler,
    ) {
    }

    public function __invoke(Request $request): JsonResponse
    {
        // Determine the platform from header
        $platform = strtolower($request->header('X-Webhook-Source', 'unknown'));
        // Get the payload off of the request
        $payload = $request->all();

        try {
            $webhook = new Webhook($platform, $payload);
            $this->handlerDelegator->delegate($webhook);
            return new JsonResponse(status: Response::HTTP_NO_CONTENT);
        } catch (Throwable $throwable) {
            $this->errorHandler->handle($throwable);
            $status = $throwable instanceof WebhookException
                ? Response::HTTP_BAD_REQUEST
                : Response::HTTP_INTERNAL_SERVER_ERROR;
            return new JsonResponse(status: $status);
        }
    }
}
