<?php
// App/Services/SeoRadarService.php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class SeoRadarService
{
    private string $baseUrl = 'https://seo.zerhal.fr/api';

    public function audit(string $url): array
    {
        $response = Http::post($this->baseUrl . '/audit', [
            'url' => $url
        ]);

        return $response->json();
    }

    public function checkIndexation(string $url): array
    {
        $response = Http::post($this->baseUrl . '/indexation', [
            'url' => $url
        ]);

        return $response->json();
    }

    public function checkBrokenLinks(string $url): array
    {
        $response = Http::post($this->baseUrl . '/broken-links', [
            'url' => $url
        ]);

        return $response->json();
    }
}