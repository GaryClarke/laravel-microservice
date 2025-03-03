<?php

declare(strict_types=1);

namespace App\Validators;

use App\Exceptions\WebhookException;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Validation\Factory;

class SubscriptionValidator
{
    public function __construct(private Factory $validator)
    {
    }

    public function validate(Arrayable $subscription, array $rules): void
    {
        $validator = $this->validator->make($subscription->toArray(), $rules);

        if ($validator->fails()) {
            throw new WebhookException('Validation failed: Check your webhook payload');
        }
    }
}
