<?php // app/Models/SubscriptionProvider.php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\SubscriptionProviderFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionProvider extends Model
{
    /** @use HasFactory<SubscriptionProviderFactory> */
    use HasFactory;
}
