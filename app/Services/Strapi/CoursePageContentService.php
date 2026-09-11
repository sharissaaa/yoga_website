<?php

namespace App\Services\Strapi;

use Illuminate\Support\Facades\Cache;

/**
 * Fetches and shapes the Course page content from Strapi.
 */
class CoursePageContentService
{
    public function __construct(protected StrapiClient $client) {}

    public function get(): array
    {
        $data = Cache::remember(
            'strapi.course-page',
            (int) config('services.strapi.cache_ttl', 300),
            fn () => $this->client->get('course-page', $this->populateQuery())
        ) ?? [];

        return [
            'hero' => $this->hero($data['hero'] ?? null),
            'highlights' => $this->highlights($data['highlights'] ?? null),
            'learn' => $this->learn($data['learn'] ?? null),
            'compare' => $this->compare($data['compare'] ?? null),
            'seo' => $this->seo($data['seo'] ?? null),
        ];
    }

    protected function populateQuery(): array
    {
        return [
            'populate' => [
                'hero' => ['populate' => ['backgroundImage' => true]],
                'highlights' => ['populate' => ['cards' => ['populate' => ['image' => true]]]],
                'learn' => ['populate' => ['items' => true, 'image' => true, 'backgroundImage' => true]],
                'compare' => ['populate' => ['image' => true]],
                'seo' => ['populate' => ['socialImage' => true, 'twitterImage' => true]],
            ],
        ];
    }

    protected function hero(?array $hero): array
    {
        return [
            'heading' => $hero['heading'] ?? null,
            'subText' => $hero['subText'] ?? null,
            'backgroundImage' => $this->client->mediaUrl($hero['backgroundImage'] ?? null),
        ];
    }

    protected function highlights(?array $section): array
    {
        $cards = collect($section['cards'] ?? [])
            ->sortBy('order')
            ->map(fn ($c) => [
                'title' => $c['title'] ?? null,
                'badge' => $c['badge'] ?? null,
                'meta' => $c['meta'] ?? null,
                'description' => $c['description'] ?? null,
                'image' => $this->client->mediaUrl($c['image'] ?? null),
            ])
            ->values();

        return [
            'heading' => $section['heading'] ?? null,
            'headingHighlight' => $section['headingHighlight'] ?? null,
            'description' => $section['description'] ?? null,
            'cards' => $cards->all(),
        ];
    }

    protected function learn(?array $section): array
    {
        $items = collect($section['items'] ?? [])
            ->sortBy('order')
            ->map(fn ($i) => ['title' => $i['title'] ?? null, 'description' => $i['description'] ?? null])
            ->values();

        return [
            'eyebrow' => $section['eyebrow'] ?? null,
            'items' => $items->all(),
            'image' => $this->client->mediaUrl($section['image'] ?? null),
            'backgroundImage' => $this->client->mediaUrl($section['backgroundImage'] ?? null),
            'quoteText' => $section['quoteText'] ?? null,
            'quoteAuthor' => $section['quoteAuthor'] ?? null,
        ];
    }

    protected function compare(?array $section): array
    {
        return [
            'heading' => $section['heading'] ?? null,
            'noteText' => $section['noteText'] ?? null,
            'image' => $this->client->mediaUrl($section['image'] ?? null),
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
            'canonicalUrl' => url($seo['canonicalUrl'] ?? '/course.html'),
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
