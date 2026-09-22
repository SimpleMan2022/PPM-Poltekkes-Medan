<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RelatedLink;
use App\Services\ImageService;
use Illuminate\Http\Request;

class RelatedLinkController extends Controller
{
    public function index()
    {
        return view('admin.related-links.index', [
            'links' => RelatedLink::ordered()->get(),
        ]);
    }

    public function create()
    {
        return view('admin.related-links.create', [
            'link' => new RelatedLink([
                'sort_order' => (RelatedLink::max('sort_order') ?? -1) + 1,
                'is_active' => true,
            ]),
        ]);
    }

    public function store(Request $request, ImageService $images)
    {
        $data = $request->validate($this->rules(), $this->messages());

        if ($request->hasFile('logo')) {
            $data['logo'] = $images->storeAsWebp($request->file('logo'), 'related-links');
        }

        $data['is_active'] = $request->boolean('is_active');

        $link = RelatedLink::create($data);

        return redirect()->route('admin.related-links.index')
            ->with('success', "Tautan \"{$link->name}\" ditambahkan.");
    }

    public function edit(RelatedLink $relatedLink)
    {
        return view('admin.related-links.edit', ['link' => $relatedLink]);
    }

    public function update(Request $request, RelatedLink $relatedLink, ImageService $images)
    {
        $data = $request->validate($this->rules($relatedLink), $this->messages());
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('logo')) {
            $images->delete($relatedLink->logo);
            $data['logo'] = $images->storeAsWebp($request->file('logo'), 'related-links');
        } else {
            unset($data['logo']);
        }

        $relatedLink->update($data);

        return redirect()->route('admin.related-links.index')
            ->with('success', "Tautan \"{$relatedLink->name}\" disimpan.");
    }

    public function destroy(RelatedLink $relatedLink, ImageService $images)
    {
        $images->delete($relatedLink->logo);
        $relatedLink->delete();

        return redirect()->route('admin.related-links.index')
            ->with('success', "Tautan \"{$relatedLink->name}\" dihapus.");
    }

    public function toggle(RelatedLink $relatedLink)
    {
        $relatedLink->update(['is_active' => ! $relatedLink->is_active]);

        return back()->with(
            'success',
            $relatedLink->is_active
                ? "Tautan \"{$relatedLink->name}\" ditayangkan."
                : "Tautan \"{$relatedLink->name}\" disembunyikan dari beranda."
        );
    }

    private function rules(?RelatedLink $link = null): array
    {
        return [
            'name' => 'required|string|max:255',
            'url' => 'required|url|max:255',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'sort_order' => [
                'required',
                'integer',
                'min:0',
                function ($attribute, $value, $fail) use ($link) {
                    $query = RelatedLink::where('sort_order', $value);
                    if ($link?->exists) {
                        $query->where('id', '!=', $link->id);
                    }
                    if ($conflict = $query->first(['name'])) {
                        $fail("Nomor urutan {$value} sudah dipakai oleh \"{$conflict->name}\". Gunakan nomor lain.");
                    }
                },
            ],
        ];
    }

    private function messages(): array
    {
        return [
            'name.required' => 'Nama institusi/aplikasi wajib diisi.',
            'url.required' => 'URL tautan wajib diisi.',
            'url.url' => 'URL harus lengkap, contoh https://kemkes.go.id.',
            'logo.image' => 'Berkas harus berupa gambar.',
            'logo.mimes' => 'Logo harus berformat JPG, JPEG, PNG, atau WebP.',
            'logo.max' => 'Ukuran logo maksimal 2 MB. Kecilkan dulu logonya lalu unggah ulang.',
            'logo.uploaded' => 'Logo gagal diunggah karena melebihi batas server (maksimal 2 MB). Kecilkan dulu logonya lalu coba lagi.',
            'sort_order.required' => 'Urutan wajib diisi.',
            'sort_order.min' => 'Urutan minimal 0. Angka kecil tampil lebih dulu.',
        ];
    }
}
