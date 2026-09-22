<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\SiteSetting;

class KontakController extends Controller
{
    public function index()
    {
        $siteSetting = SiteSetting::first();
        $services = Service::active()->ordered()->get();

        return view('kontak.index', compact('siteSetting', 'services'));
    }
}
