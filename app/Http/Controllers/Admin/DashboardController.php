<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Document;
use App\Models\DocumentCategory;
use App\Models\Gallery;

class DashboardController extends Controller
{
    public function index()
    {
        $banners = Banner::ordered()->get();

        return view('admin.dashboard', [
            'documentCount' => Document::count(),
            'categoryCount' => DocumentCategory::count(),
            'galleryCount' => Gallery::count(),
            'banners' => $banners,
            'activeBannerCount' => Banner::active()->count(),
            'latestDocuments' => Document::with('documentCategory')->latest()->take(5)->get(),
        ]);
    }
}
