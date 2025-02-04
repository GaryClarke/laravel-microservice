<?php

declare(strict_types=1);

namespace App\Clients;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class AudienceGridClient implements AudiencegridClientInterface
{
    private string $apiUrl;

    public function __construct()
    {
        $this->apiUrl = config('services.audiencegrid.api_url');
    }

    public function post(array $data): Response
    {
        return Http::post($this->apiUrl, $data);
    }
}
