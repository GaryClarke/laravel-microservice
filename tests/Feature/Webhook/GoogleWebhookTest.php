<?php // tests/Feature/Webhooks/GoogleWebhookTest.php

declare(strict_types=1);

use function Pest\Laravel\postJson;

it('processes subscription purchase notifications', function () {
    $payload = [];

    $response = postJson('/api/webhook', $payload);

    $response->assertStatus(204);
});
