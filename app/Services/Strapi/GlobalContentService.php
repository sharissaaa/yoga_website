<?php

namespace App\Services\Strapi;

use Illuminate\Support\Facades\Cache;

/**
 * Fetches content shared across every page: the site header and footer,
 * social links, and the closing tagline quote shown at the bottom of
 * About, Travel, Destination and Personalized Package pages.
 */
class GlobalContentService
{
    public function __construct(protected StrapiClient $client) {}

    public function get(): array
    {
        $data = Cache::remember(
            'strapi.global',
            (int) config('services.strapi.cache_ttl', 300),
            fn () => $this->client->get('global', $this->populateQuery())
        ) ?? [];

        return [
            'siteHeader' => $this->header($data['header'] ?? null),
            'siteFooter' => $this->footer($data['footer'] ?? null),
            'social' => $this->social($data['socialLinks'] ?? null),
            'tagline' => $this->tagline($data['taglineQuote'] ?? null),
        ];
    }

    protected function populateQuery(): array
    {
        return [
            'populate' => [
                'header' => ['populate' => ['logo' => true, 'navLinks' => true]],
                'footer' => ['populate' => ['logo' => true, 'quickLinks' => true, 'offeringsLinks' => true]],
                'socialLinks' => true,
                'taglineQuote' => true,
            ],
        ];
    }

    protected function header(?array $header): array
    {
        $navLinks = collect($header['navLinks'] ?? [])
            ->sortBy('order')
            ->map(fn ($l) => ['label' => $l['label'] ?? null, 'url' => $l['url'] ?? null])
            ->values();

        return [
            'logo' => $this->client->mediaUrl($header['logo'] ?? null),
            'logoText' => $header['logoText'] ?? null,
            'logoTagline' => $header['logoTagline'] ?? null,
            'navLinks' => $navLinks->all(),
            'contactHeading' => $header['contactHeading'] ?? null,
            'phone' => $header['phone'] ?? null,
            'email' => $header['email'] ?? null,
            'locationNote' => $header['locationNote'] ?? null,
        ];
    }

    protected function footer(?array $footer): array
    {
        $quickLinks = collect($footer['quickLinks'] ?? [])
            ->sortBy('order')
            ->map(fn ($l) => ['label' => $l['label'] ?? null, 'url' => $l['url'] ?? null])
            ->values();

        $offeringsLinks = collect($footer['offeringsLinks'] ?? [])
            ->sortBy('order')
            ->map(fn ($l) => ['label' => $l['label'] ?? null, 'url' => $l['url'] ?? null])
            ->values();

        return [
            'logo' => $this->client->mediaUrl($footer['logo'] ?? null),
            'brandTitle' => $footer['brandTitle'] ?? null,
            'brandSubtitle' => $footer['brandSubtitle'] ?? null,
            'tagline' => $footer['tagline'] ?? null,
            'quickLinksHeading' => $footer['quickLinksHeading'] ?? null,
            'quickLinks' => $quickLinks->all(),
            'offeringsHeading' => $footer['offeringsHeading'] ?? null,
            'offeringsLinks' => $offeringsLinks->all(),
            'newsletterHeading' => $footer['newsletterHeading'] ?? null,
            'newsletterText' => $footer['newsletterText'] ?? null,
        ];
    }

    protected function social(?array $social): array
    {
        return [
            'whatsapp' => $social['whatsapp'] ?? null,
            'instagram' => $social['instagram'] ?? null,
            'youtube' => $social['youtube'] ?? null,
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
