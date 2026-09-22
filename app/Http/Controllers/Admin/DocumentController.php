<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\DocumentCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->query('search', ''));
        $categoryId = (int) $request->query('category', 0);
        if ($categoryId > 0 && ! DocumentCategory::whereKey($categoryId)->exists()) {
            $categoryId = 0;
        }
        $hasFilter = $search !== '' || $categoryId > 0;

        $documents = Document::with('documentCategory')
            ->when($search !== '', fn ($q) => $q->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('code', 'like', "%{$search}%");
            }))
            ->when($categoryId > 0, fn ($q) => $q->where('document_category_id', $categoryId))
            ->orderBy('published_year', 'desc')
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        return view('admin.documents.index', [
            'documents' => $documents,
            'categories' => DocumentCategory::orderBy('name')->get(),
            'search' => $search,
            'categoryId' => $categoryId,
            'hasFilter' => $hasFilter,
        ]);
    }

    public function create()
    {
        return view('admin.documents.create', [
            'document' => new Document(),
            'categories' => DocumentCategory::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate($this->rules(), $this->messages());
        $data['file_path'] = $request->file('file')->store('documents', 'public');

        $document = Document::create($data);

        return redirect()->route('admin.documents.index')
            ->with('success', "Dokumen \"{$document->name}\" ditambahkan dan langsung tampil di halaman Dokumen.");
    }

    public function edit(Document $document)
    {
        return view('admin.documents.edit', [
            'document' => $document,
            'categories' => DocumentCategory::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Document $document)
    {
        $data = $request->validate($this->rules(true), $this->messages());

        if ($request->hasFile('file')) {
            if ($document->file_path) {
                Storage::disk('public')->delete($document->file_path);
            }
            $data['file_path'] = $request->file('file')->store('documents', 'public');
        } else {
            unset($data['file_path']);
        }

        $document->update($data);

        return redirect()->route('admin.documents.index')
            ->with('success', "Dokumen \"{$document->name}\" disimpan.");
    }

    public function destroy(Document $document)
    {
        if ($document->file_path) {
            Storage::disk('public')->delete($document->file_path);
        }
        $name = $document->name;
        $document->delete();

        return redirect()->route('admin.documents.index')
            ->with('success', "Dokumen \"{$name}\" beserta berkasnya dihapus.");
    }

    private function rules(bool $fileOptional = false): array
    {
        return [
            'code' => 'required|string|max:100',
            'name' => 'required|string|max:255',
            'document_category_id' => 'required|exists:document_categories,id',
            'published_year' => 'required|integer|min:1900|max:' . date('Y'),
            'file' => ($fileOptional ? 'nullable|' : 'required|') . 'file|mimetypes:application/pdf|max:5120',
        ];
    }

    private function messages(): array
    {
        return [
            'code.required' => 'Kode dokumen wajib diisi, contoh SOP/PPM/01/2026.',
            'name.required' => 'Nama dokumen wajib diisi.',
            'document_category_id.required' => 'Pilih kategori dokumen.',
            'document_category_id.exists' => 'Kategori yang dipilih tidak dikenal. Muat ulang halaman lalu pilih lagi.',
            'published_year.required' => 'Tahun terbit wajib diisi.',
            'published_year.min' => 'Tahun terbit minimal 1900.',
            'published_year.max' => 'Tahun terbit tidak boleh melebihi tahun berjalan.',
            'file.required' => 'Pilih berkas PDF untuk diunggah.',
            'file.mimetypes' => 'Berkas harus PDF asli. Berkas hasil ubah ekstensi manual akan ditolak.',
            'file.max' => 'Ukuran berkas maksimal 5 MB. Kecilkan atau kompres dulu PDF-nya lalu unggah ulang.',
            'file.uploaded' => 'Berkas gagal diunggah karena melebihi batas server. Kecilkan dulu berkasnya lalu coba lagi.',
        ];
    }
}
