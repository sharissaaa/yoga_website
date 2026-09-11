<?php

namespace App\Http\Controllers;

use App\Services\Strapi\CoursePageContentService;
use App\Services\Strapi\GlobalContentService;

class CourseController extends Controller
{
    public function index(CoursePageContentService $service, GlobalContentService $global)
    {
        return view('course', array_merge($service->get(), $global->get()));
    }
}
