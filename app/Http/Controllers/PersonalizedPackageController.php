<?php

namespace App\Http\Controllers;

use App\Services\Strapi\GlobalContentService;
use App\Services\Strapi\PersonalizedPageContentService;

class PersonalizedPackageController extends Controller
{
    public function index(PersonalizedPageContentService $service, GlobalContentService $global)
    {
        return view('personalized-package', array_merge($service->get(), $global->get()));
    }
}
