<?php

declare(strict_types=1);

namespace App\Handlers;

use App\Contracts\WebhookHandler;
use App\DTOs\Webhook;

readonly class HandlerDelegator
{
    /**
     * @param iterable<WebhookHandler> $handlers
     */
    public function __construct(private iterable $handlers)
    {
    }

    public function delegate(Webhook $webhook): void
    {
        // Laravel delays resolving tagged services for performance and memory efficiency.
        // RewindableGenerator acts like a "lazy" list that only creates objects when needed.
        // When you loop over $handlers, Laravel actually instantiates the handlers and makes them available.

        // Key Takeaway: Laravel doesn't create all handlers immediately.
        // Instead, it waits until they are actually needed and provides them one by one
        // using RewindableGenerator.
        foreach ($this->handlers as $handler) {
            if ($handler->supports($webhook)) {
                $handler->handle($webhook);
            }
        }
    }
}
