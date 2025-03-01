<?php

declare(strict_types=1);

use App\DTOs\Google\Subscription as GoogleSubscription;
use App\DTOs\AudienceGrid\Subscription as AudienceGridSubscription;
use App\Exceptions\WebhookException;

class SubscriptionMapper
{
    public function mapToAudienceGrid(GoogleSubscription $googleSubscription): AudienceGridSubscription
    {
        $audienceGridSubscription = new AudienceGridSubscription();

        try {
            $audienceGridSubscription->setEvent($googleSubscription->event);
            $audienceGridSubscription->setSubscriptionId($googleSubscription->subscriptionId);
            $audienceGridSubscription->setPlatform('Google Android'); // Could be dynamic if necessary
            $audienceGridSubscription->setAutoRenewStatus($googleSubscription->autoRenewing);
            $audienceGridSubscription->setCurrency($googleSubscription->currency);
            $audienceGridSubscription->setInTrial($googleSubscription->inTrial);
            $audienceGridSubscription->setProductName($googleSubscription->productId);
            $audienceGridSubscription->setRenewalDate($googleSubscription->expiryDate);
            $audienceGridSubscription->setStartDate($googleSubscription->purchaseDate);
            $audienceGridSubscription->setUserId($googleSubscription->userId);
            $audienceGridSubscription->setEmail($googleSubscription->email);
            $audienceGridSubscription->setRegion($googleSubscription->region);
            return $audienceGridSubscription;

        } catch (Throwable $throwable) {
            throw new WebhookException("Mapping failed. Reason: " . $throwable->getMessage());
        }
    }
}
