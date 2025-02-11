<?php // app/Models/SubscriptionEvent.php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\SubscriptionEventFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionEvent extends Model
{
    /** @use HasFactory<SubscriptionEventFactory> */
    use HasFactory;
}
