<?php // app/Contracts/GoogleSubscriptionForwarder.php

declare(strict_types=1);

namespace App\Contracts;

use App\DTOs\Google\Subscription;

interface GoogleSubscriptionForwarder
{
    /**
     * Determines if this forwarder should handle the given subscription.
     */
    public function supports(Subscription $subscription): bool;

    /**
     * Forwards the subscription data to an external system.
     */
    public function forward(Subscription $subscription): void;
}
