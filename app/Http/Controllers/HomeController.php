<?php

namespace App\Http\Controllers;

use App\Services\Strapi\HomePageContentService;

class HomeController extends Controller
{
    public function index(HomePageContentService $service)
    {
        return view('home', $service->get());
    }
}
