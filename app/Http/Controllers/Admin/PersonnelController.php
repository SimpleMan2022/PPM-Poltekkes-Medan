<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Personnel;
use App\Services\ImageService;
use Illuminate\Http\Request;

class PersonnelController extends Controller
{
    public function index()
    {
        return view('admin.personnels.index', [
            'personnels' => Personnel::ordered()->get(),
        ]);
    }

    public function create()
    {
        return view('admin.personnels.create', [
            'personnel' => new Personnel([
                'sort_order' => (Personnel::max('sort_order') ?? -1) + 1,
            ]),
        ]);
    }

    public function store(Request $request, ImageService $images)
    {
        $data = $request->validate($this->rules(), $this->messages());

        if ($request->hasFile('photo')) {
            $data['photo'] = $images->storeAsWebp($request->file('photo'), 'personnels');
        }

        $personnel = Personnel::create($data);

        return redirect()->route('admin.personnels.index')
            ->with('success', "Personalia \"{$personnel->name}\" ditambahkan.");
    }

    public function edit(Personnel $personnel)
    {
        return view('admin.personnels.edit', compact('personnel'));
    }

    public function update(Request $request, Personnel $personnel, ImageService $images)
    {
        $data = $request->validate($this->rules($personnel), $this->messages());

        if ($request->hasFile('photo')) {
            $images->delete($personnel->photo);
            $data['photo'] = $images->storeAsWebp($request->file('photo'), 'personnels');
        } else {
            unset($data['photo']);
        }

        $personnel->update($data);

        return redirect()->route('admin.personnels.index')
            ->with('success', "Personalia \"{$personnel->name}\" disimpan.");
    }

    public function destroy(Personnel $personnel, ImageService $images)
    {
        $images->delete($personnel->photo);
        $personnel->delete();

        return redirect()->route('admin.personnels.index')
            ->with('success', "Personalia \"{$personnel->name}\" dihapus.");
    }

    private function rules(?Personnel $personnel = null): array
    {
        return [
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'nip' => 'nullable|string|max:50',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'sort_order' => [
                'required',
                'integer',
                'min:0',
                function ($attribute, $value, $fail) use ($personnel) {
                    $query = Personnel::where('sort_order', $value);
                    if ($personnel?->exists) {
                        $query->where('id', '!=', $personnel->id);
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
            'name.required' => 'Nama wajib diisi.',
            'position.required' => 'Jabatan wajib diisi.',
            'photo.image' => 'Berkas harus berupa gambar.',
            'photo.mimes' => 'Foto harus berformat JPG, JPEG, PNG, atau WebP.',
            'photo.max' => 'Ukuran foto maksimal 2 MB. Kecilkan dulu fotonya lalu unggah ulang.',
            'photo.uploaded' => 'Foto gagal diunggah karena melebihi batas server (maksimal 2 MB). Kecilkan dulu fotonya lalu coba lagi.',
            'sort_order.required' => 'Urutan wajib diisi.',
            'sort_order.min' => 'Urutan minimal 0. Angka kecil tampil lebih dulu.',
        ];
    }
}
