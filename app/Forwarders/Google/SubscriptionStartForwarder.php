<?php // app/Forwarders/Google/SubscriptionStartForwarder.php

declare(strict_types=1);

namespace App\Forwarders\Google;

use App\Contracts\GoogleSubscriptionForwarder;
use App\DTOs\Google\Subscription;
use App\DTOs\SubscriptionEventCategory;

class SubscriptionStartForwarder implements GoogleSubscriptionForwarder
{
    public function supports(Subscription $subscription): bool
    {
        return $subscription->category === SubscriptionEventCategory::START->value;
    }

    public function forward(Subscription $subscription): void
    {
        dd($subscription);
    }
}
