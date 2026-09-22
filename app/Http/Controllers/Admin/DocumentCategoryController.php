<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DocumentCategory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DocumentCategoryController extends Controller
{
    public function index()
    {
        return view('admin.document-categories.index', [
            'categories' => DocumentCategory::withCount('documents')->orderBy('name')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.document-categories.create', [
            'category' => new DocumentCategory(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate($this->rules(), $this->messages());
        $data['slug'] = $this->makeSlug($data['name']);

        $category = DocumentCategory::create($data);

        return redirect()->route('admin.document-categories.index')
            ->with('success', "Kategori \"{$category->name}\" ditambahkan.");
    }

    public function edit(DocumentCategory $documentCategory)
    {
        return view('admin.document-categories.edit', [
            'category' => $documentCategory,
        ]);
    }

    public function update(Request $request, DocumentCategory $documentCategory)
    {
        $data = $request->validate($this->rules($documentCategory), $this->messages());
        $data['slug'] = $this->makeSlug($data['name'], $documentCategory->id);

        $documentCategory->update($data);

        return redirect()->route('admin.document-categories.index')
            ->with('success', "Kategori \"{$documentCategory->name}\" disimpan.");
    }

    public function destroy(DocumentCategory $documentCategory)
    {
        foreach ($documentCategory->documents as $document) {
            if ($document->file_path) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($document->file_path);
            }
        }
        $name = $documentCategory->name;
        $documentCategory->delete();

        return redirect()->route('admin.document-categories.index')
            ->with('success', "Kategori \"{$name}\" beserta seluruh berkas di dalamnya dihapus.");
    }

    private function rules(?DocumentCategory $category = null): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('document_categories', 'name')->ignore($category?->id),
            ],
        ];
    }

    private function messages(): array
    {
        return [
            'name.required' => 'Nama kategori wajib diisi.',
            'name.unique' => 'Nama kategori ini sudah dipakai. Gunakan nama lain.',
        ];
    }

    private function makeSlug(string $name, ?int $ignoreId = null): string
    {
        $base = \Illuminate\Support\Str::slug($name) ?: 'kategori';
        $slug = $base;
        $i = 2;

        while (DocumentCategory::where('slug', $slug)->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))->exists()) {
            $slug = "{$base}-{$i}";
            $i++;
        }

        return $slug;
    }
}
