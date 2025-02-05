<?php // app/Contracts/WebhookHandler.php

declare(strict_types=1);

namespace App\Contracts;

use App\DTOs\Webhook;

interface WebhookHandler
{
    public function supports(Webhook $webhook): bool;

    public function handle(Webhook $webhook): void;
}
