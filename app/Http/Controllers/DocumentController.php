<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\DocumentCategory;
use App\Models\Service;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function index()
    {
        $siteSetting = SiteSetting::first();
        $services = Service::active()->ordered()->get();
        $categories = DocumentCategory::withCount('documents')->orderBy('name')->get();
        $documents = Document::with('documentCategory')
            ->orderBy('published_year', 'desc')
            ->orderBy('name')
            ->get();

        return view('dokumen.index', compact('siteSetting', 'services', 'categories', 'documents'));
    }

    public function download(Document $document)
    {
        if (! $document->fileExists()) {
            abort(404, 'Berkas dokumen belum tersedia. Hubungi administrator untuk mengunggah berkas.');
        }

        return Storage::disk('public')->download($document->file_path, basename($document->file_path));
    }
}
