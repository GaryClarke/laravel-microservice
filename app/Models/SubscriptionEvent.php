<?php // app/Models/SubscriptionEvent.php

declare(strict_types=1);

namespace App\Models;

use App\DTOs\SubscriptionEventCategory;
use Database\Factories\SubscriptionEventFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubscriptionEvent extends Model
{
    /** @use HasFactory<SubscriptionEventFactory> */
    use HasFactory;

    // fillables
    protected $fillable = [
        'subscription_provider_id',
        'name',
        'category',
        'notification_type',
        'in_trial',
    ];

    // casting
    protected $casts = [
        'in_trial' => 'boolean',
        'category' => SubscriptionEventCategory::class,
    ];

    /**
     * @phpstan-ignore missingType.generics
     */
    public function provider(): BelongsTo
    {
        return $this->belongsTo(SubscriptionProvider::class);
    }
}
