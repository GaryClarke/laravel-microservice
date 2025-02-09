<?php

declare(strict_types=1);

use App\DTOs\Webhook;
use App\Handlers\AppleWebhookHandler;
use App\Handlers\GoogleWebhookHandler;

test('supports', function (
    string $platform,
    bool $googleShouldHandle,
    bool $appleShouldHandle
) {
    // Create instances of handlers
    $googleHandler = new GoogleWebhookHandler();
    $appleHandler = new AppleWebhookHandler();

    // Create the webhook DTO
    $webhook = new Webhook($platform, ['some' => 'data']);

    // Expectations
    expect($googleHandler->supports($webhook))->toBe($googleShouldHandle);
    expect($appleHandler->supports($webhook))->toBe($appleShouldHandle);
})->with([
    ['google', true, false],  // Google webhook should be handled by Google handler only
    ['apple', false, true],   // Apple webhook should be handled by Apple handler only
    ['unknown', false, false] // Unknown webhook should not be handled by either
]);
