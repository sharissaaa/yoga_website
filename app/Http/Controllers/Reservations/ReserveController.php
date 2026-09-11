<?php

namespace App\Http\Controllers\Reservations;

use App\Http\Controllers\Controller;
use App\Services\Strapi\ReservePageContentService;

class ReserveController extends Controller
{
    public function index(ReservePageContentService $service)
    {
        return view('reserve', $service->get());
    }
}
