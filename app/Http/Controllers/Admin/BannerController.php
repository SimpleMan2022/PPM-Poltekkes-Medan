<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Services\ImageService;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index()
    {
        return view('admin.banners.index', [
            'banners' => Banner::ordered()->get(),
        ]);
    }

    public function create()
    {
        return view('admin.banners.create', [
            'banner' => new Banner([
                'sort_order' => (Banner::max('sort_order') ?? -1) + 1,
                'is_active' => true,
            ]),
        ]);
    }

    public function store(Request $request, ImageService $images)
    {
        $data = $request->validate($this->rules(true), $this->messages());
        $data['image'] = $images->storeAsWebp($request->file('image'), 'banners');
        $data['is_active'] = $request->boolean('is_active');

        $banner = Banner::create($data);

        return redirect()->route('admin.banners.index')
            ->with('success', "Banner \"{$banner->title}\" ditambahkan dan langsung tampil di slider bila statusnya aktif.");
    }

    public function edit(Banner $banner)
    {
        return view('admin.banners.edit', compact('banner'));
    }

    public function update(Request $request, Banner $banner, ImageService $images)
    {
        $data = $request->validate($this->rules(false, $banner), $this->messages());
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('image')) {
            $images->delete($banner->image);
            $data['image'] = $images->storeAsWebp($request->file('image'), 'banners');
        } else {
            unset($data['image']);
        }

        $banner->update($data);

        return redirect()->route('admin.banners.index')
            ->with('success', "Banner \"{$banner->title}\" disimpan. Lihat halaman beranda untuk memeriksa tampilannya.");
    }

    public function destroy(Banner $banner, ImageService $images)
    {
        $images->delete($banner->image);
        $banner->delete();

        return redirect()->route('admin.banners.index')
            ->with('success', "Banner \"{$banner->title}\" dihapus dan tidak lagi tampil di slider.");
    }

    public function toggle(Banner $banner)
    {
        $banner->update(['is_active' => ! $banner->is_active]);

        return back()->with(
            'success',
            $banner->is_active
                ? "Banner \"{$banner->title}\" diaktifkan dan tampil di slider."
                : "Banner \"{$banner->title}\" dinonaktifkan dan disembunyikan dari slider."
        );
    }

    private function rules(bool $withImage, ?Banner $banner = null): array
    {
        return [
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string',
            'image' => ($withImage ? 'required|' : 'nullable|') . 'image|mimes:jpg,jpeg,png,webp|max:2048',
            'cta_text' => 'nullable|string|max:100',
            'cta_url' => 'nullable|url|max:255',
            'sort_order' => [
                'required',
                'integer',
                'min:0',
                function ($attribute, $value, $fail) use ($banner) {
                    $query = Banner::where('sort_order', $value);
                    if ($banner?->exists) {
                        $query->where('id', '!=', $banner->id);
                    }
                    if ($conflict = $query->first(['title'])) {
                        $fail("Nomor urutan {$value} sudah dipakai oleh \"{$conflict->title}\". Gunakan nomor lain.");
                    }
                },
            ],
        ];
    }

    private function messages(): array
    {
        return [
            'title.required' => 'Judul wajib diisi.',
            'image.required' => 'Pilih berkas gambar untuk banner.',
            'image.image' => 'Berkas harus berupa gambar.',
            'image.mimes' => 'Gambar harus berformat JPG, JPEG, PNG, atau WebP.',
            'image.max' => 'Ukuran gambar maksimal 2 MB. Kecilkan dulu gambarnya lalu unggah ulang.',
            'image.uploaded' => 'Gambar gagal diunggah karena melebihi batas server (maksimal 2 MB). Kecilkan dulu gambarnya lalu coba lagi.',
            'cta_url.url' => 'Link CTA harus URL lengkap, contoh https://poltekkesmedan.ac.id/pendaftaran.',
            'sort_order.required' => 'Urutan wajib diisi.',
            'sort_order.min' => 'Urutan minimal 0. Angka kecil tampil lebih dulu.',
        ];
    }

}
