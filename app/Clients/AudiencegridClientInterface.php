<?php

declare(strict_types=1);

namespace App\Clients;

use Illuminate\Http\Client\Response;

interface AudiencegridClientInterface
{
    /**
     * Sends data to AudienceGrid.
     *
     * @param array<string, mixed> $data The data payload to send.
     * @return Response The HTTP response from AudienceGrid.
     */
    public function post(array $data): Response;
}
