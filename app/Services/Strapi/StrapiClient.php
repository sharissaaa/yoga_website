<?php

namespace App\Services\Strapi;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Throwable;

/**
 * Thin wrapper around Strapi's REST API. Every call is defensive: a failure
 * (network error, timeout, non-2xx response) is logged and returns null
 * instead of throwing, so a Strapi outage never takes the website down.
 */
class StrapiClient
{
    protected string $baseUrl;

    protected string $publicUrl;

    protected ?string $token;

    protected int $timeout;

    public function __construct()
    {
        $this->baseUrl = rtrim(config('services.strapi.url'), '/');
        $this->publicUrl = rtrim(config('services.strapi.public_url'), '/');
        $this->token = config('services.strapi.token');
        $this->timeout = (int) config('services.strapi.timeout', 5);
    }

    /**
     * GET a Strapi API endpoint (e.g. "home-page") with an optional nested
     * query array (populate, filters, etc.). Returns the decoded "data"
     * payload, or null if the request failed or the entry doesn't exist.
     */
    public function get(string $endpoint, array $query = []): ?array
    {
        try {
            $response = Http::baseUrl($this->baseUrl)
                ->withToken($this->token)
                ->timeout($this->timeout)
                ->acceptJson()
                ->get("/api/{$endpoint}", $query);

            if ($response->failed()) {
                Log::warning("Strapi request to [{$endpoint}] failed", [
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);

                return null;
            }

            return $response->json('data');
        } catch (Throwable $e) {
            Log::warning("Strapi request to [{$endpoint}] threw an exception", [
                'message' => $e->getMessage(),
            ]);

            return null;
        }
    }

    /**
     * Resolve a Strapi media object's URL to an absolute URL. Strapi returns
     * media URLs relative to its own host (e.g. "/uploads/foo.jpg").
     */
    public function mediaUrl(?array $media): ?string
    {
        if (empty($media['url'])) {
            return null;
        }

        return str_starts_with($media['url'], 'http')
            ? $media['url']
            : $this->publicUrl.$media['url'];
    }
}
