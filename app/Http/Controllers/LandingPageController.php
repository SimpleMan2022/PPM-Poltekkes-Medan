<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\DocumentCategory;
use App\Models\Gallery;
use App\Models\OrganizationProfile;
use App\Models\Personnel;
use App\Models\RelatedLink;
use App\Models\Service;
use App\Models\SiteSetting;

class LandingPageController extends Controller
{
    public function index()
    {
        $siteSetting = SiteSetting::first();
        $banners = Banner::active()->ordered()->get();
        $organizationProfile = OrganizationProfile::first();
        $services = Service::active()->ordered()->get();
        $relatedLinks = RelatedLink::active()->ordered()->get();
        $documentCategories = DocumentCategory::with('documents')->get();
        $galleries = Gallery::orderBy('event_date', 'desc')->take(8)->get();

        return view('landing', compact(
            'siteSetting',
            'banners',
            'organizationProfile',
            'services',
            'relatedLinks',
            'documentCategories',
            'galleries'
        ));
    }

    public function strukturOrganisasi()
    {
        $siteSetting = SiteSetting::first();
        $services = Service::active()->ordered()->get();
        $organizationProfile = OrganizationProfile::first();
        $personnels = Personnel::ordered()->get();
        return view('profil.struktur-organisasi', compact('siteSetting', 'services', 'organizationProfile', 'personnels'));
    }

    public function tugasFungsi()
    {
        $siteSetting = SiteSetting::first();
        $services = Service::active()->ordered()->get();
        $organizationProfile = OrganizationProfile::first();
        return view('profil.tugas-fungsi', compact('siteSetting', 'services', 'organizationProfile'));
    }
}
