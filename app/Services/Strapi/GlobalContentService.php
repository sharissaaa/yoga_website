<?php

namespace App\Services\Strapi;

use Illuminate\Support\Facades\Cache;

/**
 * Fetches content shared across multiple pages (currently just the closing
 * tagline quote shown at the bottom of About, Travel, Destination and
 * Personalized Package pages).
 */
class GlobalContentService
{
    public function __construct(protected StrapiClient $client) {}

    public function get(): array
    {
        $data = Cache::remember(
            'strapi.global',
            (int) config('services.strapi.cache_ttl', 300),
            fn () => $this->client->get('global', ['populate' => ['taglineQuote' => true]])
        ) ?? [];

        return [
            'tagline' => $this->tagline($data['taglineQuote'] ?? null),
        ];
    }

    protected function tagline(?array $quote): array
    {
        return [
            'sanskrit' => $quote['sanskrit'] ?? null,
            'transliteration' => $quote['transliteration'] ?? null,
            'translation' => $quote['translation'] ?? null,
        ];
    }
}
