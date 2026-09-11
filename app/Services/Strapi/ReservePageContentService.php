<?php

namespace App\Services\Strapi;

use Illuminate\Support\Facades\Cache;

/**
 * Fetches and shapes the Reserve page's static copy from Strapi. The form
 * fields and submission handling stay in code — only the surrounding
 * copy (eyebrow, heading, sub text, success note) is CMS-driven.
 */
class ReservePageContentService
{
    public function __construct(protected StrapiClient $client) {}

    public function get(): array
    {
        $data = Cache::remember(
            'strapi.reserve-page',
            (int) config('services.strapi.cache_ttl', 300),
            fn () => $this->client->get('reserve-page', [
                'populate' => ['seo' => ['populate' => ['socialImage' => true, 'twitterImage' => true]]],
            ])
        ) ?? [];

        return [
            'eyebrow' => $data['eyebrow'] ?? null,
            'heading' => $data['heading'] ?? null,
            'subText' => $data['subText'] ?? null,
            'successNote' => $data['successNote'] ?? null,
            'seo' => $this->seo($data['seo'] ?? null),
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
            'canonicalUrl' => url($seo['canonicalUrl'] ?? '/reserve.html'),
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
