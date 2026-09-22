<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use App\Services\ImageService;
use Illuminate\Http\Request;

class SiteSettingController extends Controller
{
    public function edit()
    {
        return view('admin.site-settings.edit', [
            'setting' => SiteSetting::first() ?? new SiteSetting(),
        ]);
    }

    public function update(Request $request, ImageService $images)
    {
        $data = $request->validate([
            'site_name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
            'address' => 'nullable|string',
            'phone' => 'nullable|string|max:50',
            'whatsapp' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'operating_hours' => 'nullable|string',
            'instagram_url' => 'nullable|url|max:255',
            'facebook_url' => 'nullable|url|max:255',
            'youtube_url' => 'nullable|url|max:255',
            'google_maps_embed' => 'nullable|string',
            'copyright_text' => 'nullable|string|max:255',
        ], [
            'site_name.required' => 'Nama situs wajib diisi.',
            'logo.image' => 'Berkas harus berupa gambar.',
            'logo.mimes' => 'Logo harus berformat JPG, JPEG, PNG, WebP, atau SVG.',
            'logo.max' => 'Ukuran logo maksimal 2 MB. Kecilkan dulu logonya lalu unggah ulang.',
            'logo.uploaded' => 'Logo gagal diunggah karena melebihi batas server (maksimal 2 MB). Kecilkan dulu logonya lalu coba lagi.',
            'email.email' => 'Format email tidak valid.',
            'instagram_url.url' => 'URL Instagram harus lengkap, contoh https://instagram.com/….',
            'facebook_url.url' => 'URL Facebook harus lengkap, contoh https://facebook.com/….',
            'youtube_url.url' => 'URL YouTube harus lengkap, contoh https://youtube.com/….',
        ]);

        $setting = SiteSetting::firstOrNew();

        if ($request->hasFile('logo')) {
            $images->delete($setting->logo);
            $data['logo'] = $images->storeAsWebp($request->file('logo'), 'site');
        } else {
            unset($data['logo']);
        }

        $setting->fill($data)->save();

        return redirect()->route('admin.site-settings.edit')
            ->with('success', 'Identitas situs disimpan dan langsung tampil di halaman publik.');
    }
}
