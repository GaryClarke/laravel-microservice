<?php

declare(strict_types=1);

namespace App\DTOs\Google;

use Carbon\CarbonImmutable;

readonly class Subscription
{
    public function __construct(
        // data.subscription_notification.subscription_id
        public ?string $subscriptionId = null,
        // data.subscription_notification.notification_type
        public ?int $notificationType = null,
        // data.subscription_notification.in_trial
        public ?bool $inTrial = null,
        // Converted: data.event_time_millis
        public ?CarbonImmutable $eventTime = null,
        // From subscription_events DB lookup
        public ?string $event = null,
        // From subscription_events DB lookup
        public ?string $category = null,
        // data.developer_notification.product_id
        public ?string $productId = null,
        // data.developer_notification.order_id
        public ?string $orderId = null,
        // data.developer_notification.user_account_id
        public ?string $userId = null,
        // data.developer_notification.email
        public ?string $email = null,
        // data.developer_notification.auto_renewing
        public ?bool $autoRenewing = null,
        // Converted: data.developer_notification.purchase_time_millis
        public ?CarbonImmutable $purchaseDate = null,
        // Converted: data.developer_notification.expiry_time_millis
        public ?CarbonImmutable $expiryDate = null,
        // data.developer_notification.price_currency_code
        public ?string $currency = null,
        // data.developer_notification.region_code
        public ?string $region = null
    ) {
    }
}
