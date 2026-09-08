<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;

class ClashOfClansService
{
    protected string $baseUrl;
    protected string $token;

    public function __construct()
    {
        $this->baseUrl = config(
            'services.coc.base_url',
            'https://api.clashofclans.com/v1'
        );

        $this->token = config('services.coc.token');
    }

    /**
     * Send an authenticated GET request to the Clash of Clans API.
     */
    protected function get(string $endpoint, array $queryParams = []): Response
    {
        return Http::withToken($this->token)
            ->baseUrl($this->baseUrl)
            ->withoutVerifying() // LOCAL DEVELOPMENT ONLY
            ->acceptJson()
            ->get($endpoint, $queryParams);
    }

    /**
     * Get player details by tag.
     */
    public function getPlayer(string $playerTag): ?array
    {
        $formattedTag = '#' . ltrim($playerTag, '#');
        $encodedTag = urlencode($formattedTag);

        $response = $this->get("/players/{$encodedTag}");

        return $response->successful()
            ? $response->json()
            : null;
    }

    /**
     * Get clan details by tag.
     */
    public function getClan(string $clanTag): ?array
    {
        $formattedTag = '#' . ltrim($clanTag, '#');
        $encodedTag = urlencode($formattedTag);

        $response = $this->get("/clans/{$encodedTag}");

        return $response->successful()
            ? $response->json()
            : null;
    }
}
