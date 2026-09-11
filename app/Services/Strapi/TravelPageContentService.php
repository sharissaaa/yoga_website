<?php

namespace App\Services\Strapi;

use Illuminate\Support\Facades\Cache;

/**
 * Fetches and shapes the Travel page content from Strapi — the listing
 * page's own hero/teaser, plus the sections shared by every Destination
 * detail page (What To Expect, Good To Know, FAQ, Reserve CTA).
 */
class TravelPageContentService
{
    public function __construct(protected StrapiClient $client) {}

    public function get(): array
    {
        $data = Cache::remember(
            'strapi.travel-page',
            (int) config('services.strapi.cache_ttl', 300),
            fn () => $this->client->get('travel-page', $this->populateQuery())
        ) ?? [];

        return [
            'hero' => $this->hero($data['hero'] ?? null),
            'personalizedTeaser' => $this->personalizedTeaser($data['personalizedTeaser'] ?? null),
            'whatToExpect' => $this->whatToExpect($data['whatToExpect'] ?? null),
            'goodToKnow' => $this->goodToKnow($data['goodToKnow'] ?? null),
            'faq' => $this->faq($data['faq'] ?? null),
            'reserveCta' => $this->reserveCta($data['reserveCta'] ?? null),
            'seo' => $this->seo($data['seo'] ?? null),
        ];
    }

    protected function populateQuery(): array
    {
        return [
            'populate' => [
                'hero' => ['populate' => ['backgroundImage' => true]],
                'personalizedTeaser' => true,
                'whatToExpect' => ['populate' => ['items' => true]],
                'goodToKnow' => [
                    'populate' => [
                        'includedItems' => true,
                        'notIncludedItems' => true,
                        'guides' => ['populate' => ['image' => true]],
                    ],
                ],
                'faq' => ['populate' => ['items' => true]],
                'reserveCta' => true,
                'seo' => ['populate' => ['socialImage' => true, 'twitterImage' => true]],
            ],
        ];
    }

    protected function hero(?array $hero): array
    {
        return [
            'heading' => $hero['heading'] ?? null,
            'headingHighlight' => $hero['headingHighlight'] ?? null,
            'backgroundImage' => $this->client->mediaUrl($hero['backgroundImage'] ?? null),
        ];
    }

    protected function personalizedTeaser(?array $section): array
    {
        return [
            'heading' => $section['heading'] ?? null,
            'text' => $section['text'] ?? null,
            'linkText' => $section['linkText'] ?? null,
            'linkUrl' => $section['linkUrl'] ?? null,
        ];
    }

    protected function whatToExpect(?array $section): array
    {
        $items = collect($section['items'] ?? [])
            ->sortBy('order')
            ->map(fn ($i) => ['heading' => $i['heading'] ?? null, 'text' => $i['text'] ?? null])
            ->values();

        return ['items' => $items->all()];
    }

    protected function goodToKnow(?array $section): array
    {
        $included = collect($section['includedItems'] ?? [])->sortBy('order')->pluck('text')->filter()->values();
        $notIncluded = collect($section['notIncludedItems'] ?? [])->sortBy('order')->pluck('text')->filter()->values();
        $guides = collect($section['guides'] ?? [])
            ->sortBy('order')
            ->map(fn ($g) => [
                'name' => $g['name'] ?? null,
                'meta' => $g['meta'] ?? null,
                'image' => $this->client->mediaUrl($g['image'] ?? null),
            ])
            ->values();

        return [
            'pricingText' => $section['pricingText'] ?? null,
            'includedItems' => $included->all(),
            'notIncludedItems' => $notIncluded->all(),
            'guides' => $guides->all(),
        ];
    }

    protected function faq(?array $section): array
    {
        $items = collect($section['items'] ?? [])
            ->sortBy('order')
            ->map(fn ($i) => ['question' => $i['question'] ?? null, 'answer' => $i['answer'] ?? null])
            ->values();

        return [
            'heading' => $section['heading'] ?? null,
            'items' => $items->all(),
        ];
    }

    protected function reserveCta(?array $section): array
    {
        return [
            'heading' => $section['heading'] ?? null,
            'text' => $section['text'] ?? null,
            'buttonText' => $section['buttonText'] ?? null,
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
            'canonicalUrl' => url($seo['canonicalUrl'] ?? '/travel.html'),
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
