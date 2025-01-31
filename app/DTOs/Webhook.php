<?php // app/DTOs/Webhook.php

declare(strict_types=1);

namespace App\DTOs;

readonly class Webhook
{
    /**
     * @param array<string, mixed> $payload
     */
    public function __construct(
        public string $platform,
        public array $payload,
    ) {
    }

    public function getPlatform(): string
    {
        return $this->platform;
    }

    /**
     * @return array<string, mixed>
     */
    public function getPayload(): array
    {
        return $this->payload;
    }
}
