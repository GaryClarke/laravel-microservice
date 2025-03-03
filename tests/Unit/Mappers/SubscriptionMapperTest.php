<?php

declare(strict_types=1);

use App\DTOs\Google\Subscription as GoogleSubscription;
use App\DTOs\AudienceGrid\Subscription as AudienceGridSubscription;
use App\Mappers\Google\SubscriptionMapper;
use Carbon\CarbonImmutable;

it('successfully maps a GoogleSubscription to an AudienceGridSubscription', function () {
    $googleSubscription = createSubscription();

    $mapper = new SubscriptionMapper();
    $audienceGridSubscription = $mapper->mapToAudienceGrid($googleSubscription);

    expect($audienceGridSubscription)->toBeInstanceOf(AudienceGridSubscription::class)
        ->and($audienceGridSubscription->toArray())->toMatchArray([
            'event' => 'subscription_started',
            'properties' => [
                'subscription_id' => 'premium_monthly',
                'platform' => 'Google Android',
                'auto_renew_status' => true,
                'currency' => 'USD',
                'in_trial' => false,
                'product_name' => 'premium_monthly',
                'renewal_date' => CarbonImmutable::now()->addMonth()->toIso8601String(),
                'start_date' => CarbonImmutable::now()->toIso8601String(),
            ],
            'user' => [
                'id' => 'USER-001',
                'email' => 'joe@example.com',
                'region' => 'US',
            ],
        ]);
});

