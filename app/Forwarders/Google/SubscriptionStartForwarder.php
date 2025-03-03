<?php // app/Forwarders/Google/SubscriptionStartForwarder.php

declare(strict_types=1);

namespace App\Forwarders\Google;

use App\Contracts\GoogleSubscriptionForwarder;
use App\DTOs\Google\Subscription as GoogleSubscription;
use App\DTOs\SubscriptionEventCategory;
use App\Mappers\Google\SubscriptionMapper;
use App\Validators\SubscriptionValidator;

class SubscriptionStartForwarder implements GoogleSubscriptionForwarder
{
    public function __construct(private SubscriptionValidator $validator)
    {
    }

    public function supports(GoogleSubscription $googleSubscription): bool
    {
        return $googleSubscription->category === SubscriptionEventCategory::START->value;
    }

    public function forward(GoogleSubscription $googleSubscription): void
    {
        // Map to $audienceGridSubscription
        $audienceGridSubscription = (new SubscriptionMapper())->mapToAudienceGrid($googleSubscription);

        // Validate the $audienceGridSubscription
        $this->validator->validate($audienceGridSubscription, $audienceGridSubscription::rules());

        dd($audienceGridSubscription);

        // Forward the $audienceGridSubscription data
    }
}
