<?php

namespace App\Services\Strapi;

use Illuminate\Support\Facades\Cache;

/**
 * Fetches and shapes the Contact page content from Strapi. The message
 * form itself stays in code — only the surrounding copy is CMS-driven.
 */
class ContactPageContentService
{
    public function __construct(protected StrapiClient $client) {}

    public function get(): array
    {
        $data = Cache::remember(
            'strapi.contact-page',
            (int) config('services.strapi.cache_ttl', 300),
            fn () => $this->client->get('contact-page', $this->populateQuery())
        ) ?? [];

        return [
            'hero' => $this->hero($data['hero'] ?? null),
            'getInTouch' => $this->getInTouch($data['getInTouch'] ?? null),
            'seo' => $this->seo($data['seo'] ?? null),
        ];
    }

    protected function populateQuery(): array
    {
        return [
            'populate' => [
                'hero' => ['populate' => ['image' => true]],
                'getInTouch' => true,
                'seo' => ['populate' => ['socialImage' => true, 'twitterImage' => true]],
            ],
        ];
    }

    protected function hero(?array $hero): array
    {
        return [
            'eyebrow' => $hero['eyebrow'] ?? null,
            'heading' => $hero['heading'] ?? null,
            'headingAccent' => $hero['headingAccent'] ?? null,
            'image' => $this->client->mediaUrl($hero['image'] ?? null),
        ];
    }

    protected function getInTouch(?array $section): array
    {
        return [
            'heading' => $section['heading'] ?? null,
            'teamName' => $section['teamName'] ?? null,
            'teamRole' => $section['teamRole'] ?? null,
            'email' => $section['email'] ?? null,
            'locationLabel' => $section['locationLabel'] ?? null,
            'locationNote' => $section['locationNote'] ?? null,
            'yearRoundHeading' => $section['yearRoundHeading'] ?? null,
            'yearRoundText' => $section['yearRoundText'] ?? null,
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
            'canonicalUrl' => url($seo['canonicalUrl'] ?? '/contact.html'),
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
