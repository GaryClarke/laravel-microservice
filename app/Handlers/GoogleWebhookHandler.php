<?php // app/Handlers/GoogleWebhookHandler.php

declare(strict_types=1);

namespace App\Handlers;

use App\Contracts\WebhookHandler;
use App\DTOs\Google\SubscriptionFactory;
use App\DTOs\Webhook;

class GoogleWebhookHandler implements WebhookHandler
{
    private const string SUPPORTED_PLATFORM = 'google';

    public function __construct(private SubscriptionFactory $subscriptionFactory)
    {
    }

    public function supports(Webhook $webhook): bool
    {
        return strtolower($webhook->getPlatform()) === self::SUPPORTED_PLATFORM;
    }

    public function handle(Webhook $webhook): void
    {
        // STEP 1: Use a factory class to extract relevant data into Google\Subscription
          = $this->subscriptionFactory->create($webhook);

        dd($subscription);
    }
}
