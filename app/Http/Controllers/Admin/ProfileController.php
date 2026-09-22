<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrganizationProfile;
use App\Services\ImageService;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('admin.profile.edit', [
            'profile' => OrganizationProfile::first() ?? new OrganizationProfile(),
        ]);
    }

    public function update(Request $request, ImageService $images)
    {
        $data = $request->validate([
            'leader_name' => 'required|string|max:255',
            'leader_title' => 'nullable|string|max:255',
            'leader_position' => 'nullable|string|max:255',
            'leader_photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'welcome_message' => 'required|string',
        ], [
            'leader_name.required' => 'Nama lengkap & gelar wajib diisi.',
            'leader_photo.image' => 'Berkas harus berupa gambar.',
            'leader_photo.mimes' => 'Foto harus berformat JPG, JPEG, PNG, atau WebP.',
            'leader_photo.max' => 'Ukuran foto maksimal 2 MB. Kecilkan dulu fotonya lalu unggah ulang.',
            'leader_photo.uploaded' => 'Foto gagal diunggah karena melebihi batas server (maksimal 2 MB). Kecilkan dulu fotonya lalu coba lagi.',
            'welcome_message.required' => 'Sambutan wajib diisi.',
        ]);

        $profile = OrganizationProfile::firstOrNew();

        if ($request->hasFile('leader_photo')) {
            $images->delete($profile->leader_photo);
            $data['leader_photo'] = $images->storeAsWebp($request->file('leader_photo'), 'leaders');
        } else {
            unset($data['leader_photo']);
        }

        $data['welcome_message'] = $this->cleanHtml($data['welcome_message']);
        if (trim(strip_tags((string) $data['welcome_message'])) === '') {
            return back()
                ->withErrors(['welcome_message' => 'Sambutan masih kosong. Tulis dulu sambutannya sebelum menyimpan.'])
                ->withInput();
        }

        $profile->fill($data)->save();

        return redirect()->route('admin.profile.edit')
            ->with('success', 'Sambutan Kepala PPM disimpan dan langsung tampil di beranda.');
    }

    public function struktur()
    {
        return view('admin.profile.struktur', [
            'profile' => OrganizationProfile::first() ?? new OrganizationProfile(),
        ]);
    }

    public function updateStruktur(Request $request, ImageService $images)
    {
        $request->validate([
            'organization_structure' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'organization_structure.image' => 'Berkas harus berupa gambar.',
            'organization_structure.mimes' => 'Bagan harus berformat JPG, JPEG, PNG, atau WebP.',
            'organization_structure.max' => 'Ukuran bagan maksimal 2 MB. Kecilkan dulu gambarnya lalu unggah ulang.',
            'organization_structure.uploaded' => 'Bagan gagal diunggah karena melebihi batas server (maksimal 2 MB). Kecilkan dulu gambarnya lalu coba lagi.',
        ]);

        $profile = OrganizationProfile::firstOrNew();

        if ($request->hasFile('organization_structure')) {
            $images->delete($profile->organization_structure);
            $profile->organization_structure = $images->storeAsWebp($request->file('organization_structure'), 'organization');
            $profile->save();

            return redirect()->route('admin.profile.struktur')
                ->with('success', 'Bagan struktur organisasi disimpan dan langsung tampil di halaman publik.');
        }

        return redirect()->route('admin.profile.struktur')
            ->with('success', 'Tidak ada gambar baru yang diunggah.');
    }

    public function tugasFungsi()
    {
        return view('admin.profile.tugas-fungsi', [
            'profile' => OrganizationProfile::first() ?? new OrganizationProfile(),
        ]);
    }

    public function updateTugasFungsi(Request $request)
    {
        $data = $request->validate([
            'main_duties' => 'nullable|string',
            'duties_functions' => 'nullable|string',
        ]);

        foreach (['main_duties', 'duties_functions'] as $field) {
            $cleaned = $this->cleanHtml($data[$field] ?? null);
            $data[$field] = trim(strip_tags((string) $cleaned)) === '' ? null : $cleaned;
        }

        $profile = OrganizationProfile::firstOrNew();
        $profile->fill($data)->save();

        return redirect()->route('admin.profile.tugas-fungsi')
            ->with('success', 'Tugas pokok & fungsi disimpan dan langsung tampil di halaman publik.');
    }

    /**
     * Buang tag & atribut berbahaya dari HTML editor.
     * Isi teks tetap dipertahankan.
     */
    private function cleanHtml(?string $html): ?string
    {
        if (! is_string($html)) {
            return $html;
        }

        $allowed = '<p><br><strong><em><u><ol><ul><li><a><h1><h2><h3><h4><blockquote>';
        $html = strip_tags($html, $allowed);
        $html = (string) preg_replace('/\s+on\w+\s*=\s*("[^"]*"|\'[^\']*\'|[^\s>]+)/i', '', $html);
        $html = (string) preg_replace('/href\s*=\s*"\s*javascript:[^"]*"/i', 'href="#"', $html);

        return $html;
    }
}
