<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class DestinationController extends Controller
{
    /**
     * The travel/destinations list page (travel.html) — the retreat cards
     * there are hand-authored, independent of config/destinations.php, so
     * this just renders the static view.
     */
    public function index(): View
    {
        return view('travel');
    }

    /**
     * The destination-detail page, populated server-side from
     * config/destinations.php by ?slug= (was client-side JS reading
     * DESTINATIONS[slug] from destination-data.js — see the old
     * destination-detail.js for the logic this mirrors).
     */
    public function show(Request $request): View|Response
    {
        $slug = $request->query('slug');
        $destinations = config('destinations');
        $data = $slug ? ($destinations[$slug] ?? null) : null;

        if (! $data) {
            return response()->view('destinations.not-found', [], 404);
        }

        $heroPhoto = ['src' => $data['image'], 'alt' => $data['imageAlt']];
        $extraPhotos = $data['gallery'] ?? [];

        $galleryPhotos = array_merge([$heroPhoto], $extraPhotos);

        // aboutImage when the destination has one set (distinct from the
        // hero and gallery), else fall back to an extra gallery shot for
        // destinations with enough of them to avoid repeats.
        $aboutPhoto = $data['aboutImage']
            ?? (count($extraPhotos) > 1 ? $extraPhotos[0] : $heroPhoto);

        $programPhoto = count($extraPhotos) > 1
            ? $extraPhotos[1]
            : ($extraPhotos[0] ?? $heroPhoto);

        $reserveUrl = 'reserve.html?destination='.urlencode($data['title']);

        return view('destinations.show', [
            'data' => $data,
            'galleryPhotos' => $galleryPhotos,
            'hasFeaturedGallery' => count($galleryPhotos) > 2,
            'aboutPhoto' => $aboutPhoto,
            'programPhoto' => $programPhoto,
            'reserveUrl' => $reserveUrl,
        ]);
    }
}
