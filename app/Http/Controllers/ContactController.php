<?php

namespace App\Http\Controllers;

use App\Services\Strapi\ContactPageContentService;
use App\Services\Strapi\GlobalContentService;

class ContactController extends Controller
{
    public function index(ContactPageContentService $service, GlobalContentService $global)
    {
        return view('contact', array_merge($service->get(), $global->get()));
    }
}
