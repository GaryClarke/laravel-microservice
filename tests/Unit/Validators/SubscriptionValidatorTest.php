<?php // tests/Unit/Validators/SubscriptionValidatorTest.php

declare(strict_types=1);

use App\Exceptions\WebhookException;
use App\Validators\SubscriptionValidator;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Validation\Factory;
use Illuminate\Translation\ArrayLoader;
use Illuminate\Translation\Translator;

beforeEach(function () {
    // Set up real validation factory
    $translator = new Translator(new ArrayLoader(), 'en');
    $this->factory = new Factory($translator);
});

it('validates the subscription successfully with dynamic rules', function () {
    // Create the validator with the real Factory
    $validator = new SubscriptionValidator($this->factory);

    // Anonymous class implementing Arrayable with valid data
    $subscription = new class implements Arrayable {
        public function toArray(): array
        {
            return [
                'event' => 'subscription_started',
                'properties' => [
                    'subscription_id' => 'premium_monthly',
                    'platform' => 'Google Android',
                    'auto_renew_status' => true,
                    'currency' => 'USD',
                    'in_trial' => false,
                    'product_name' => 'premium_monthly',
                    'renewal_date' => '2024-02-10T12:24:50+00:00',
                    'start_date' => '2024-01-06T19:04:50+00:00',
                ],
                'user' => [
                    'id' => 'USER-001',
                    'email' => 'joe@example.com',
                    'region' => 'US',
                ],
            ];
        }

        public static function rules(): array
        {
            return [
                'event' => 'required|string',
                'properties.subscription_id' => 'required|string',
                'properties.platform' => 'required|string',
                'properties.auto_renew_status' => 'required|boolean',
                'properties.currency' => 'required|string|size:3',
                'properties.in_trial' => 'required|boolean',
                'properties.product_name' => 'required|string',
                'properties.renewal_date' => 'required|date|after_or_equal:properties.start_date',
                'properties.start_date' => 'required|date',
                'user.id' => 'required|string',
                'user.email' => 'required|email',
                'user.region' => 'required|string|size:2',
            ];
        }
    };

    // No exception should be thrown
    $validator->validate($subscription, $subscription::rules());

    expect(true)->toBeTrue(); // Just to confirm the test runs through
});

it('throws an exception on validation failure with dynamic rules', function () {
    // Create the validator with the real Factory
    $validator = new SubscriptionValidator($this->factory);

    // Anonymous class implementing Arrayable with invalid data
    $subscription = new class implements Arrayable {
        public function toArray(): array
        {
            return []; // Invalid data
        }

        public static function rules(): array
        {
            return [
                'event' => 'required|string',
                'properties.subscription_id' => 'required|string'
            ];
        }
    };

    // Exception expectation
    expect(fn () => $validator->validate($subscription, $subscription::rules()))
        ->toThrow(WebhookException::class, 'Validation failed: Check your webhook payload');
});
