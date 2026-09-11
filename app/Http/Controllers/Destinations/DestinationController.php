<?php

namespace App\Http\Controllers\Destinations;

use App\Http\Controllers\Controller;
use App\Services\Strapi\DestinationContentService;
use App\Services\Strapi\GlobalContentService;
use App\Services\Strapi\TravelPageContentService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class DestinationController extends Controller
{
    /**
     * The travel/destinations list page (travel.html).
     */
    public function index(
        TravelPageContentService $travelPage,
        DestinationContentService $destinations,
        GlobalContentService $global
    ): View {
        return view('travel', array_merge(
            $travelPage->get(),
            ['destinations' => $destinations->all()],
            $global->get(),
        ));
    }

    /**
     * The destination-detail page, populated from Strapi by ?slug=.
     */
    public function show(
        Request $request,
        DestinationContentService $destinations,
        TravelPageContentService $travelPage,
        GlobalContentService $global
    ): View|Response {
        $slug = $request->query('slug');
        $data = $slug ? $destinations->find($slug) : null;

        if (! $data) {
            return response()->view('destinations.not-found', [], 404);
        }

        $galleryPhotos = collect([$data['image']])
            ->merge($data['gallery'])
            ->filter()
            ->values()
            ->all();

        $aboutPhoto = $data['aboutImage'] ?: (count($data['gallery']) > 1 ? $data['gallery'][0] : ($data['image'] ?? null));
        $programPhoto = count($data['gallery']) > 1 ? $data['gallery'][1] : ($data['gallery'][0] ?? $data['image'] ?? null);

        $reserveUrl = 'reserve.html?destination='.urlencode($data['title'] ?? '');

        $shared = $travelPage->get();
        if (! empty($data['title'])) {
            $shared['seo']['pageTitle'] = $data['title'].' – Bhumi Mantra';
            $shared['seo']['socialTitle'] = $shared['seo']['pageTitle'];
            $shared['seo']['twitterTitle'] = $shared['seo']['pageTitle'];
            $shared['seo']['canonicalUrl'] = url('destination-detail.html?slug='.($data['slug'] ?? ''));
        }
        if (! empty($data['description'])) {
            $shared['seo']['searchDescription'] = $data['description'];
            $shared['seo']['socialDescription'] = $data['description'];
            $shared['seo']['twitterDescription'] = $data['description'];
        }

        return view('destinations.show', array_merge(
            ['data' => $data],
            $shared,
            $global->get(),
            [
                'galleryPhotos' => $galleryPhotos,
                'hasFeaturedGallery' => count($galleryPhotos) > 2,
                'aboutPhoto' => $aboutPhoto,
                'programPhoto' => $programPhoto,
                'reserveUrl' => $reserveUrl,
            ]
        ));
    }
}
