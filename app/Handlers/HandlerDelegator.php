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
        foreach ($this->handlers as $handler) {
            if ($handler->supports($webhook)) {
                $handler->handle($webhook);
            }
        }
    }
}
