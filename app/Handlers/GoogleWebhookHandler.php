<?php // app/Handlers/GoogleWebhookHandler.php

declare(strict_types=1);

namespace App\Handlers;

use App\Contracts\GoogleSubscriptionForwarder;
use App\Contracts\WebhookHandler;
use App\DTOs\Google\SubscriptionFactory;
use App\DTOs\Webhook;

class GoogleWebhookHandler implements WebhookHandler
{
    private const string SUPPORTED_PLATFORM = 'google';

    /**
     * @param SubscriptionFactory $subscriptionFactory
     * @param iterable<GoogleSubscriptionForwarder> $forwarders
     */
    public function __construct(
        private SubscriptionFactory $subscriptionFactory,
        private iterable $forwarders
    ) {
    }

    public function supports(Webhook $webhook): bool
    {
        return strtolower($webhook->getPlatform()) === self::SUPPORTED_PLATFORM;
    }

    public function handle(Webhook $webhook): void
    {
        // STEP 1: Use a factory class to extract relevant data into Google\Subscription
         $subscription = $this->subscriptionFactory->create($webhook);

        // STEP 2: Loop over forwarders
        foreach ($this->forwarders as $forwarder) {
            // Check if forwarder supports the subscription
            if ($forwarder->supports($subscription)) {
                // Call forward if so, passing in the subscription
                $forwarder->forward($subscription);
            }
        }
    }
}
