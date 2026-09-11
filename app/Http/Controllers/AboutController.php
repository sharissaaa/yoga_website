<?php

namespace App\Http\Controllers;

use App\Services\Strapi\AboutPageContentService;

class AboutController extends Controller
{
    public function index(AboutPageContentService $service)
    {
        return view('about', $service->get());
    }
}
