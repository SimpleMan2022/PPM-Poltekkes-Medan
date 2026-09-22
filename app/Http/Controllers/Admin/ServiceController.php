<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ServiceController extends Controller
{
    public function index()
    {
        return view('admin.services.index', [
            'services' => Service::ordered()->get(),
        ]);
    }

    public function create()
    {
        return view('admin.services.create', [
            'service' => new Service([
                'sort_order' => (Service::max('sort_order') ?? -1) + 1,
                'is_active' => true,
            ]),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate($this->rules(), $this->messages());
        $data['is_active'] = $request->boolean('is_active');

        $service = Service::create($data);

        return redirect()->route('admin.services.index')
            ->with('success', "Layanan \"{$service->name}\" ditambahkan.");
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $data = $request->validate($this->rules($service), $this->messages());
        $data['is_active'] = $request->boolean('is_active');

        $service->update($data);

        return redirect()->route('admin.services.index')
            ->with('success', "Layanan \"{$service->name}\" disimpan.");
    }

    public function destroy(Service $service)
    {
        $service->delete();

        return redirect()->route('admin.services.index')
            ->with('success', "Layanan \"{$service->name}\" dihapus.");
    }

    public function toggle(Service $service)
    {
        $service->update(['is_active' => ! $service->is_active]);

        return back()->with(
            'success',
            $service->is_active
                ? "Layanan \"{$service->name}\" ditayangkan."
                : "Layanan \"{$service->name}\" disembunyikan dari beranda."
        );
    }

    private function rules(?Service $service = null): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => ['nullable', 'string', Rule::in(array_keys(config('service-icons', [])))],
            'sort_order' => [
                'required',
                'integer',
                'min:0',
                function ($attribute, $value, $fail) use ($service) {
                    $query = Service::where('sort_order', $value);
                    if ($service?->exists) {
                        $query->where('id', '!=', $service->id);
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
            'name.required' => 'Nama layanan wajib diisi.',
            'icon.in' => 'Ikon yang dipilih tidak dikenal. Pilih salah satu ikon yang tersedia.',
            'sort_order.required' => 'Urutan wajib diisi.',
            'sort_order.min' => 'Urutan minimal 0. Angka kecil tampil lebih dulu.',
        ];
    }
}
