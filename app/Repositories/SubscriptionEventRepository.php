<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\SubscriptionEvent;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SubscriptionEventRepository
{
    /**
     * Find a subscription event based on notification type and trial status.
     * @throws ModelNotFoundException
     */
    public function findByNotificationType(int $notificationType, bool $inTrial = false): SubscriptionEvent
    {
        return SubscriptionEvent::where([
            ['notification_type', '=', $notificationType],
            ['in_trial', '=', $inTrial],
        ])->firstOrFail();
    }
}
