<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Services\ImageService;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        return view('admin.galleries.index', [
            'galleries' => Gallery::orderBy('event_date', 'desc')
                ->orderBy('id', 'desc')
                ->get(),
        ]);
    }

    public function create()
    {
        return view('admin.galleries.create', [
            'gallery' => new Gallery(),
        ]);
    }

    public function store(Request $request, ImageService $images)
    {
        $data = $request->validate($this->rules(true), $this->messages());
        $data['image'] = $images->storeAsWebp($request->file('image'), 'galleries');

        $gallery = Gallery::create($data);

        return redirect()->route('admin.galleries.index')
            ->with('success', "Foto \"{$gallery->title}\" ditambahkan ke galeri.");
    }

    public function edit(Gallery $gallery)
    {
        return view('admin.galleries.edit', compact('gallery'));
    }

    public function update(Request $request, Gallery $gallery, ImageService $images)
    {
        $data = $request->validate($this->rules(false), $this->messages());

        if ($request->hasFile('image')) {
            $images->delete($gallery->image);
            $data['image'] = $images->storeAsWebp($request->file('image'), 'galleries');
        } else {
            unset($data['image']);
        }

        if (empty($data['event_date'])) {
            $data['event_date'] = null;
        }

        $gallery->update($data);

        return redirect()->route('admin.galleries.index')
            ->with('success', "Foto \"{$gallery->title}\" disimpan.");
    }

    public function destroy(Gallery $gallery, ImageService $images)
    {
        $images->delete($gallery->image);
        $gallery->delete();

        return redirect()->route('admin.galleries.index')
            ->with('success', "Foto \"{$gallery->title}\" dihapus dari galeri.");
    }

    private function rules(bool $withImage): array
    {
        return [
            'title' => 'required|string|max:255',
            'event_date' => 'nullable|date',
            'description' => 'nullable|string',
            'image' => ($withImage ? 'required|' : 'nullable|') . 'image|mimes:jpg,jpeg,png,webp|max:2048',
        ];
    }

    private function messages(): array
    {
        return [
            'title.required' => 'Judul kegiatan wajib diisi.',
            'event_date.date' => 'Tanggal tidak valid. Gunakan kalender yang tersedia.',
            'image.required' => 'Pilih berkas foto untuk diunggah.',
            'image.image' => 'Berkas harus berupa gambar.',
            'image.mimes' => 'Foto harus berformat JPG, JPEG, PNG, atau WebP.',
            'image.max' => 'Ukuran foto maksimal 2 MB. Kecilkan dulu fotonya lalu unggah ulang.',
            'image.uploaded' => 'Foto gagal diunggah karena melebihi batas server (maksimal 2 MB). Kecilkan dulu fotonya lalu coba lagi.',
        ];
    }
}
