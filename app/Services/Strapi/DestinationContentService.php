<?php

namespace App\Services\Strapi;

use Illuminate\Support\Facades\Cache;

/**
 * Fetches and shapes Destination entries from Strapi (the collection of
 * retreats shown on the Travel listing page and their own detail pages).
 */
class DestinationContentService
{
    public function __construct(protected StrapiClient $client) {}

    /**
     * All destinations, sorted for the Travel listing page.
     */
    public function all(): array
    {
        $data = Cache::remember(
            'strapi.destinations',
            (int) config('services.strapi.cache_ttl', 300),
            fn () => $this->client->get('destinations', $this->populateQuery(['sort' => 'order:asc']))
        ) ?? [];

        return collect($data)->map(fn ($d) => $this->shape($d))->values()->all();
    }

    /**
     * A single destination by slug, for the detail page.
     */
    public function find(string $slug): ?array
    {
        $destinations = Cache::remember(
            "strapi.destination.{$slug}",
            (int) config('services.strapi.cache_ttl', 300),
            fn () => $this->client->get('destinations', $this->populateQuery(['filters' => ['slug' => ['$eq' => $slug]]]))
        ) ?? [];

        $data = $destinations[0] ?? null;

        return $data ? $this->shape($data) : null;
    }

    protected function populateQuery(array $extra = []): array
    {
        return array_merge([
            'populate' => [
                'image' => true,
                'aboutImage' => true,
                'highlights' => true,
                'gallery' => ['populate' => ['image' => true]],
                'departures' => true,
                'itinerary' => true,
            ],
        ], $extra);
    }

    protected function shape(array $d): array
    {
        $highlights = collect($d['highlights'] ?? [])->sortBy('order')->pluck('text')->filter()->values();

        $gallery = collect($d['gallery'] ?? [])
            ->sortBy('order')
            ->map(fn ($g) => $this->client->mediaUrl($g['image'] ?? null))
            ->filter()
            ->values();

        $departures = collect($d['departures'] ?? [])
            ->sortBy('order')
            ->map(fn ($dep) => ['range' => $dep['range'] ?? null, 'spots' => $dep['spots'] ?? null])
            ->values();

        $itinerary = collect($d['itinerary'] ?? [])
            ->sortBy('order')
            ->map(fn ($day) => ['title' => $day['title'] ?? null, 'text' => $day['text'] ?? null])
            ->values();

        return [
            'title' => $d['title'] ?? null,
            'slug' => $d['slug'] ?? null,
            'badge' => $d['badge'] ?? null,
            'image' => $this->client->mediaUrl($d['image'] ?? null),
            'aboutImage' => $this->client->mediaUrl($d['aboutImage'] ?? null),
            'destinationCountry' => $d['destinationCountry'] ?? null,
            'duration' => $d['duration'] ?? null,
            'level' => $d['level'] ?? null,
            'dates' => $d['dates'] ?? null,
            'description' => $d['description'] ?? null,
            'whyText' => $d['whyText'] ?? null,
            'highlights' => $highlights->all(),
            'gallery' => $gallery->all(),
            'departures' => $departures->all(),
            'itinerary' => $itinerary->all(),
        ];
    }
}
