<?php

namespace App\Services\Strapi;

use Illuminate\Support\Facades\Cache;

/**
 * Fetches and shapes the About page content from Strapi.
 *
 * Every value comes straight from Strapi — there is no hardcoded fallback
 * copy. If a field hasn't been filled in (or Strapi is unreachable), it
 * comes back empty/null and the view simply doesn't render that piece;
 * nothing invented is ever shown.
 */
class AboutPageContentService
{
    public function __construct(protected StrapiClient $client) {}

    public function get(): array
    {
        $data = Cache::remember(
            'strapi.about-page',
            (int) config('services.strapi.cache_ttl', 300),
            fn () => $this->client->get('about-page', $this->populateQuery())
        ) ?? [];

        return [
            'hero' => $this->hero($data['hero'] ?? null),
            'team' => $this->team($data['team'] ?? null),
            'story' => $this->story($data['story'] ?? null),
            'quote' => $this->quote($data['quote'] ?? null),
            'seo' => $this->seo($data['seo'] ?? null),
        ];
    }

    protected function populateQuery(): array
    {
        return [
            'populate' => [
                'hero' => ['populate' => ['paragraphs' => true, 'image' => true]],
                'team' => ['populate' => ['members' => ['populate' => ['image' => true]]]],
                'story' => ['populate' => ['paragraphs' => true, 'image' => true]],
                'quote' => true,
                'seo' => ['populate' => ['socialImage' => true, 'twitterImage' => true]],
            ],
        ];
    }

    protected function hero(?array $hero): array
    {
        $paragraphs = collect($hero['paragraphs'] ?? [])
            ->sortBy('order')
            ->pluck('text')
            ->filter()
            ->values();

        return [
            'headline' => $hero['headline'] ?? null,
            'headlineHighlight' => $hero['headlineHighlight'] ?? null,
            'paragraphs' => $paragraphs->all(),
            'image' => $this->client->mediaUrl($hero['image'] ?? null),
        ];
    }

    protected function team(?array $section): array
    {
        $members = collect($section['members'] ?? [])
            ->sortBy('order')
            ->map(fn ($member) => [
                'name' => $member['name'] ?? null,
                'meta' => $member['meta'] ?? null,
                'description' => $member['description'] ?? null,
                'image' => $this->client->mediaUrl($member['image'] ?? null),
            ])
            ->values();

        return [
            'eyebrow' => $section['eyebrow'] ?? null,
            'heading' => $section['heading'] ?? null,
            'members' => $members->all(),
        ];
    }

    protected function story(?array $section): array
    {
        $paragraphs = collect($section['paragraphs'] ?? [])
            ->sortBy('order')
            ->map(fn ($p) => [
                'text' => $p['text'] ?? null,
                'isExtra' => (bool) ($p['isExtra'] ?? false),
            ])
            ->values();

        return [
            'heading' => $section['heading'] ?? null,
            'paragraphs' => $paragraphs->all(),
            'image' => $this->client->mediaUrl($section['image'] ?? null),
        ];
    }

    protected function quote(?array $quote): array
    {
        return [
            'sanskrit' => $quote['sanskrit'] ?? null,
            'transliteration' => $quote['transliteration'] ?? null,
            'translation' => $quote['translation'] ?? null,
        ];
    }

    protected function seo(?array $seo): array
    {
        $socialImage = $this->client->mediaUrl($seo['socialImage'] ?? null);
        $twitterImage = $this->client->mediaUrl($seo['twitterImage'] ?? null);

        return [
            'pageTitle' => $seo['pageTitle'] ?? null,
            'searchDescription' => $seo['searchDescription'] ?? null,
            'keywords' => $seo['keywords'] ?? null,
            'canonicalUrl' => url($seo['canonicalUrl'] ?? '/about.html'),
            'socialTitle' => $seo['socialTitle'] ?? $seo['pageTitle'] ?? null,
            'socialDescription' => $seo['socialDescription'] ?? $seo['searchDescription'] ?? null,
            'socialImage' => $socialImage,
            'twitterTitle' => $seo['twitterTitle'] ?? $seo['pageTitle'] ?? null,
            'twitterDescription' => $seo['twitterDescription'] ?? $seo['searchDescription'] ?? null,
            'twitterImage' => $twitterImage ?? $socialImage,
            'allowSearchEngines' => $seo['allowSearchEngines'] ?? true,
        ];
    }
}
