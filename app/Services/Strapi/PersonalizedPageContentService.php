<?php

namespace App\Services\Strapi;

use Illuminate\Support\Facades\Cache;

/**
 * Fetches and shapes the Personalized Package page content from Strapi.
 */
class PersonalizedPageContentService
{
    public function __construct(protected StrapiClient $client) {}

    public function get(): array
    {
        $data = Cache::remember(
            'strapi.personalized-page',
            (int) config('services.strapi.cache_ttl', 300),
            fn () => $this->client->get('personalized-page', $this->populateQuery())
        ) ?? [];

        return [
            'hero' => $this->hero($data['hero'] ?? null),
            'steps' => $this->steps($data['steps'] ?? null),
            'breakSection' => $this->breakSection($data['breakSection'] ?? null),
            'ideas' => $this->ideas($data['ideas'] ?? null),
            'cta' => $this->cta($data['cta'] ?? null),
            'seo' => $this->seo($data['seo'] ?? null),
        ];
    }

    protected function populateQuery(): array
    {
        return [
            'populate' => [
                'hero' => ['populate' => ['backgroundImage' => true]],
                'steps' => ['populate' => ['items' => true]],
                'breakSection' => ['populate' => ['backgroundImage' => true]],
                'ideas' => ['populate' => ['items' => ['populate' => ['image' => true]]]],
                'cta' => true,
                'seo' => ['populate' => ['socialImage' => true, 'twitterImage' => true]],
            ],
        ];
    }

    protected function hero(?array $hero): array
    {
        return [
            'heading' => $hero['heading'] ?? null,
            'headingHighlight' => $hero['headingHighlight'] ?? null,
            'subText' => $hero['subText'] ?? null,
            'subLinkUrl' => $hero['subLinkUrl'] ?? null,
            'backgroundImage' => $this->client->mediaUrl($hero['backgroundImage'] ?? null),
        ];
    }

    protected function steps(?array $section): array
    {
        $items = collect($section['items'] ?? [])
            ->sortBy('order')
            ->map(fn ($i) => [
                'number' => $i['number'] ?? null,
                'heading' => $i['heading'] ?? null,
                'text' => $i['text'] ?? null,
            ])
            ->values();

        return [
            'eyebrow' => $section['eyebrow'] ?? null,
            'items' => $items->all(),
        ];
    }

    protected function breakSection(?array $section): array
    {
        return [
            'quote' => $section['quote'] ?? null,
            'backgroundImage' => $this->client->mediaUrl($section['backgroundImage'] ?? null),
        ];
    }

    protected function ideas(?array $section): array
    {
        $items = collect($section['items'] ?? [])
            ->sortBy('order')
            ->map(fn ($i) => [
                'heading' => $i['heading'] ?? null,
                'text' => $i['text'] ?? null,
                'image' => $this->client->mediaUrl($i['image'] ?? null),
            ])
            ->values();

        return [
            'eyebrow' => $section['eyebrow'] ?? null,
            'heading' => $section['heading'] ?? null,
            'subText' => $section['subText'] ?? null,
            'items' => $items->all(),
            'noteHeading' => $section['noteHeading'] ?? null,
            'noteText' => $section['noteText'] ?? null,
            'noteLinkText' => $section['noteLinkText'] ?? null,
            'noteLinkUrl' => $section['noteLinkUrl'] ?? null,
        ];
    }

    protected function cta(?array $section): array
    {
        return [
            'eyebrow' => $section['eyebrow'] ?? null,
            'heading' => $section['heading'] ?? null,
            'text' => $section['text'] ?? null,
            'linkText' => $section['linkText'] ?? null,
            'linkUrl' => $section['linkUrl'] ?? null,
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
            'canonicalUrl' => url($seo['canonicalUrl'] ?? '/personalized-package.html'),
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
