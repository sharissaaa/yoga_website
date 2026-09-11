<?php

namespace App\Services\Strapi;

use Illuminate\Support\Facades\Cache;

/**
 * Fetches and shapes the Home page content from Strapi.
 *
 * Every value comes straight from Strapi — there is no hardcoded fallback
 * copy. If a field hasn't been filled in (or Strapi is unreachable), it
 * comes back empty/null and the view simply doesn't render that piece;
 * nothing invented is ever shown.
 */
class HomePageContentService
{
    public function __construct(protected StrapiClient $client) {}

    public function get(): array
    {
        $data = Cache::remember(
            'strapi.home-page',
            (int) config('services.strapi.cache_ttl', 300),
            fn () => $this->client->get('home-page', $this->populateQuery())
        ) ?? [];

        return [
            'hero' => $this->hero($data['hero'] ?? null),
            'offerings' => $this->offerings($data['offerings'] ?? null),
            'destinations' => $this->destinations($data['destinations'] ?? null),
            'breathe' => $this->breathe($data['breathe'] ?? null),
            'about' => $this->about($data['about'] ?? null),
            'stories' => $this->stories($data['stories'] ?? null),
            'newsletter' => $this->newsletter($data['newsletter'] ?? null),
            'seo' => $this->seo($data['seo'] ?? null),
        ];
    }

    protected function populateQuery(): array
    {
        return [
            'populate' => [
                'hero' => ['populate' => ['backgroundImage' => true]],
                'offerings' => ['populate' => ['cards' => true]],
                'destinations' => ['populate' => ['items' => ['populate' => ['image' => true]]]],
                'breathe' => ['populate' => ['steps' => true]],
                'about' => true,
                'stories' => ['populate' => ['quotes' => true, 'items' => true]],
                'newsletter' => true,
                'seo' => ['populate' => ['socialImage' => true, 'twitterImage' => true]],
            ],
        ];
    }

    protected function hero(?array $hero): array
    {
        return [
            'headingLine1' => $hero['headingLine1'] ?? null,
            'headingHighlight' => $hero['headingHighlight'] ?? null,
            'description' => $hero['description'] ?? null,
            'primaryButtonText' => $hero['primaryButtonText'] ?? null,
            'primaryButtonLink' => $hero['primaryButtonLink'] ?? null,
            'secondaryButtonText' => $hero['secondaryButtonText'] ?? null,
            'secondaryButtonLink' => $hero['secondaryButtonLink'] ?? null,
            'backgroundImage' => $this->client->mediaUrl($hero['backgroundImage'] ?? null),
        ];
    }

    protected function offerings(?array $section): array
    {
        $cards = collect($section['cards'] ?? [])
            ->sortBy('order')
            ->map(fn ($card) => [
                'title' => $card['title'] ?? null,
                'description' => $card['description'] ?? null,
                'link' => $card['link'] ?? null,
            ])
            ->values();

        return [
            'eyebrow' => $section['eyebrow'] ?? null,
            'heading' => $section['heading'] ?? null,
            'headingLink' => $section['headingLink'] ?? null,
            'description' => $section['description'] ?? null,
            'cards' => $cards->all(),
        ];
    }

    protected function destinations(?array $section): array
    {
        $items = collect($section['items'] ?? [])
            ->sortBy('order')
            ->map(fn ($item) => [
                'name' => $item['name'] ?? null,
                'slug' => $item['slug'] ?? null,
                'dates' => $item['dates'] ?? null,
                'image' => $this->client->mediaUrl($item['image'] ?? null),
            ])
            ->values();

        return [
            'heading' => $section['heading'] ?? null,
            'items' => $items->all(),
        ];
    }

    protected function breathe(?array $section): array
    {
        $steps = collect($section['steps'] ?? [])
            ->sortBy('order')
            ->map(fn ($step) => [
                'label' => $step['label'] ?? null,
                'durationSeconds' => $step['durationSeconds'] ?? null,
            ])
            ->values();

        return [
            'eyebrow' => $section['eyebrow'] ?? null,
            'heading' => $section['heading'] ?? null,
            'steps' => $steps->all(),
        ];
    }

    protected function about(?array $about): array
    {
        return [
            'title' => $about['title'] ?? null,
            'subtitle' => $about['subtitle'] ?? null,
            'paragraph1' => $about['paragraph1'] ?? null,
            'paragraph2' => $about['paragraph2'] ?? null,
            'linkText' => $about['linkText'] ?? null,
            'linkUrl' => $about['linkUrl'] ?? null,
        ];
    }

    protected function stories(?array $section): array
    {
        $quotes = collect($section['quotes'] ?? [])
            ->sortBy('order')
            ->map(fn ($quote) => [
                'sanskrit' => $quote['sanskrit'] ?? null,
                'transliteration' => $quote['transliteration'] ?? null,
                'translation' => $quote['translation'] ?? null,
            ])
            ->values();

        $items = collect($section['items'] ?? [])
            ->sortBy('order')
            ->map(fn ($story) => [
                'name' => $story['name'] ?? null,
                'meta' => $story['meta'] ?? null,
                'quote' => $story['quote'] ?? null,
                'isPlaceholder' => (bool) ($story['isPlaceholder'] ?? false),
            ])
            ->values();

        return [
            'eyebrow' => $section['eyebrow'] ?? null,
            'quotes' => $quotes->all(),
            'items' => $items->all(),
        ];
    }

    protected function newsletter(?array $section): array
    {
        return [
            'heading' => $section['heading'] ?? null,
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
            'canonicalUrl' => url($seo['canonicalUrl'] ?? '/'),
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
