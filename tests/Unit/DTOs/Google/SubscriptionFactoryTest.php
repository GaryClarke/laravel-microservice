<?php // tests/Unit/DTOs/Google/SubscriptionFactoryTest.php

declare(strict_types=1);

use App\DTOs\Google\Subscription;
use App\DTOs\Google\SubscriptionFactory;
use App\DTOs\Webhook;
use App\Exceptions\WebhookException;
use App\Models\SubscriptionEvent;
use App\Repositories\SubscriptionEventRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

it('creates a subscription dto successfully', function () {
    // GIVEN
    // Create a SubscriptionEvent
    $subEvent = new SubscriptionEvent([
        'name' => 'subscription_started',
        'category' => 'START',
        'notification_type' => 4,
        'in_trial' => false,
    ]);

    // Mock the repository to return the event
    $mockRepo = Mockery::mock(SubscriptionEventRepository::class);

    // Instantiate SubscriptionFactory, injecting mock repository
    $subscriptionFactory = new SubscriptionFactory($mockRepo);

    // Create $webhook
    $webhook = new Webhook('google', [
        'data' => [
            'event_time_millis' => '1704567890123',
            'subscription_notification' => [
                'notification_type' => 4,
                'subscription_id' => 'premium_monthly',
                'in_trial' => false,
            ],
            'developer_notification' => [
                'product_id' => 'premium_monthly',
                'order_id' => 'GPA.1234-5678-9012-34567',
                'user_account_id' => 'USER-001',
                'email' => 'joe@example.com',
                'auto_renewing' => true,
                'purchase_time_millis' => '1704567890123',
                'expiry_time_millis' => '1707567890123',
                'price_currency_code' => 'USD',
                'region_code' => 'US',
            ]
        ]
    ]);

    $mockRepo->shouldReceive('findByNotificationType')
        ->with(4, false)
        ->once()
        ->andReturn($subEvent);

    // WHEN
    // Call SubscriptionFactory::create($webhook)
    $subscription = $subscriptionFactory->create($webhook);

    // THEN
    // Expectations (subscription created, properties as expected)
    expect($subscription)->toBeInstanceOf(Subscription::class)
        ->and($subscription->event)->toBe('subscription_started')
        ->and($subscription->category)->toBe('START');
});

it('throws WebhookException if subscription event is not found', function () {
    $mockRepo = Mockery::mock(SubscriptionEventRepository::class);
    $mockRepo->shouldReceive('findByNotificationType')
        ->with(999, false) // Non-existent notification type
        ->once()
        ->andThrow(ModelNotFoundException::class);

    $factory = new SubscriptionFactory($mockRepo);

    $webhook = new Webhook('google', [
        'data' => [
            'event_time_millis' => '1704567890123',
            'subscription_notification' => [
                'notification_type' => 999, // Non-existent
                'subscription_id' => 'premium_monthly',
                'in_trial' => false,
            ],
            'developer_notification' => [
                'product_id' => 'premium_monthly',
                'order_id' => 'GPA.1234-5678-9012-34567',
                'user_account_id' => 'USER-001',
                'email' => 'joe@example.com',
                'auto_renewing' => true,
                'purchase_time_millis' => '1704567890123',
                'expiry_time_millis' => '1707567890123',
                'price_currency_code' => 'USD',
                'region_code' => 'US',
            ]
        ]
    ]);

    expect(fn () => $factory->create($webhook))
        ->toThrow(WebhookException::class, 'Unable to create Google Subscription');
});
