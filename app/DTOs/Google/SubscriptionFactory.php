<?php // app/DTOs/Google/SubscriptionFactory.php

declare(strict_types=1);

namespace App\DTOs\Google;

use App\DTOs\Webhook;
use App\Models\SubscriptionEvent;
use Carbon\CarbonImmutable;

class SubscriptionFactory
{
    public function create(Webhook $webhook): Subscription
    {
        $data = $webhook->getPayload();

        // Extract necessary fields from the webhook
        $subscriptionNotification = $data['data']['subscription_notification'];
        $developerNotification = $data['data']['developer_notification'];

        // Perform DB lookup to find matching event
        $subEvent = SubscriptionEvent::where([
            ['notification_type', '=', $subscriptionNotification['notification_type']],
            ['in_trial', '=', $subscriptionNotification['in_trial']],
        ])->firstOrFail();

        // Return a populated Subscription DTO
        return new Subscription(
            subscriptionId: $subscriptionNotification['subscription_id'],
            notificationType: $subscriptionNotification['notification_type'],
            inTrial: $subscriptionNotification['in_trial'],
            eventTime: CarbonImmutable::createFromTimestampMs($data['data']['event_time_millis']),
            event: $subEvent->name,
            category: $subEvent->category->value,
            productId: $developerNotification['product_id'],
            orderId: $developerNotification['order_id'],
            userId: $developerNotification['user_account_id'],
            email: $developerNotification['email'],
            autoRenewing: $developerNotification['auto_renewing'],
            purchaseDate: CarbonImmutable::createFromTimestampMs($developerNotification['purchase_time_millis']),
            expiryDate: CarbonImmutable::createFromTimestampMs($developerNotification['expiry_time_millis']),
            currency: $developerNotification['price_currency_code'],
            region: $developerNotification['region_code']
        );
    }
}
