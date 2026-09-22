<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Service;
use App\Models\SiteSetting;

class GalleryController extends Controller
{
    public function index()
    {
        $siteSetting = SiteSetting::first();
        $services = Service::active()->ordered()->get();
        $galleries = Gallery::orderBy('event_date', 'desc')
            ->orderBy('id', 'desc')
            ->paginate(12);

        return view('galeri.index', compact('siteSetting', 'services', 'galleries'));
    }
}
