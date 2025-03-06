<?php // app/DTOs/AudienceGrid/Subscription.php

declare(strict_types=1);

namespace App\DTOs\AudienceGrid;

use Carbon\CarbonImmutable;
use Illuminate\Contracts\Support\Arrayable;

/**
 * @implements Arrayable<string, mixed>
 */
class Subscription implements Arrayable
{
    private string $event;
    private string $subscriptionId;
    private string $platform;
    private bool $autoRenewStatus;
    private string $currency;
    private bool $inTrial;
    private string $productName;
    private CarbonImmutable $renewalDate;
    private CarbonImmutable $startDate;
    private string $userId;
    private string $email;
    private string $region;

    /**
     * Returns validation rules for the subscription.
     *
     * @return array<string, mixed>
     */
    public static function rules(): array
    {
        return [
            'event' => ['required', 'string'],
            'properties.subscription_id' => ['required', 'string'],
            'properties.platform' => ['required', 'string'],
            'properties.auto_renew_status' => ['required', 'boolean'],
            'properties.currency' => ['required', 'string', 'size:3'],
            'properties.in_trial' => ['required', 'boolean'],
            'properties.product_name' => ['required', 'string'],
            'properties.renewal_date' => ['required', 'date', 'after_or_equal:properties.start_date'],
            'properties.start_date' => ['required', 'date'],
            'user.id' => ['required', 'string'],
            'user.email' => ['required', 'email'],
            'user.region' => ['required', 'string', 'size:2'],
        ];
    }

    public function toArray(): array
    {
        return [
            'event' => $this->event,
            'properties' => [
                'subscription_id' => $this->subscriptionId,
                'platform' => $this->platform,
                'auto_renew_status' => $this->autoRenewStatus,
                'currency' => $this->currency,
                'in_trial' => $this->inTrial,
                'product_name' => $this->productName,
                'renewal_date' => $this->renewalDate->toIso8601String(),
                'start_date' => $this->startDate->toIso8601String(),
            ],
            'user' => [
                'id' => $this->userId,
                'email' => $this->email,
                'region' => $this->region,
            ],
        ];
    }

    public function getEvent(): string
    {
        return $this->event;
    }

    public function setEvent(string $event): void
    {
        $this->event = $event;
    }

    public function getSubscriptionId(): string
    {
        return $this->subscriptionId;
    }

    public function setSubscriptionId(string $subscriptionId): void
    {
        $this->subscriptionId = $subscriptionId;
    }

    public function getPlatform(): string
    {
        return $this->platform;
    }

    public function setPlatform(string $platform): void
    {
        $this->platform = $platform;
    }

    public function isAutoRenewStatus(): bool
    {
        return $this->autoRenewStatus;
    }

    public function setAutoRenewStatus(bool $autoRenewStatus): void
    {
        $this->autoRenewStatus = $autoRenewStatus;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function setCurrency(string $currency): void
    {
        $this->currency = $currency;
    }

    public function isInTrial(): bool
    {
        return $this->inTrial;
    }

    public function setInTrial(bool $inTrial): void
    {
        $this->inTrial = $inTrial;
    }

    public function getProductName(): string
    {
        return $this->productName;
    }

    public function setProductName(string $productName): void
    {
        $this->productName = $productName;
    }

    public function getRenewalDate(): CarbonImmutable
    {
        return $this->renewalDate;
    }

    public function setRenewalDate(CarbonImmutable $renewalDate): void
    {
        $this->renewalDate = $renewalDate;
    }

    public function getStartDate(): CarbonImmutable
    {
        return $this->startDate;
    }

    public function setStartDate(CarbonImmutable $startDate): void
    {
        $this->startDate = $startDate;
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function setUserId(string $userId): void
    {
        $this->userId = $userId;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getRegion(): string
    {
        return $this->region;
    }

    public function setRegion(string $region): void
    {
        $this->region = $region;
    }
}
