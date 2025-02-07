<?php // app/Handlers/AppleWebhookHandler.php

declare(strict_types=1);

namespace App\Handlers;

use App\Contracts\WebhookHandler;
use App\DTOs\Webhook;

class AppleWebhookHandler implements WebhookHandler
{
    private const string SUPPORTED_PLATFORM = 'apple';

    public function supports(Webhook $webhook): bool
    {
        return strtolower($webhook->getPlatform()) === self::SUPPORTED_PLATFORM;
    }

    public function handle(Webhook $webhook): void
    {
        dump('apple');
    }
}
