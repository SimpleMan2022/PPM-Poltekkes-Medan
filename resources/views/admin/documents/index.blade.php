@extends('layouts.admin')

@section('page-title', 'Dokumen & SOP')

@section('content')
<div class="mb-6">
    <nav class="mb-4 text-xs sm:text-sm text-slate-500">
        <a href="{{ route('admin.dashboard') }}" class="hover:text-primary transition-colors">Dashboard</a>
        <span class="mx-1.5">/</span>
        <span class="text-primary font-medium">Dokumen &amp; SOP</span>
    </nav>
    <div class="flex items-start justify-between gap-4">
        <div>
            <h1 class="font-display text-xl sm:text-2xl font-bold text-slate-800 leading-snug">Dokumen &amp; SOP</h1>
            <p class="text-sm text-slate-500 mt-1">Berkas yang tersimpan langsung tampil di halaman Dokumen publik.</p>
        </div>
        <div class="shrink-0 flex items-center gap-2">
            <a href="{{ route('admin.document-categories.index') }}" class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium text-primary-dark border border-primary/30 rounded-md hover:bg-primary/10 transition-colors">Kategori</a>
            <a href="{{ route('admin.documents.create') }}" class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-semibold text-white bg-primary hover:bg-primary-dark rounded-md transition-colors">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Tambah
            </a>
        </div>
    </div>
</div>

<form method="GET" action="{{ route('admin.documents.index') }}" class="mb-4 flex flex-col gap-2.5 sm:flex-row">
    <div class="relative flex-1">
        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
        </svg>
        <input
            type="search"
            name="search"
            value="{{ $search }}"
            placeholder="Cari nama atau kode dokumen…"
            autocomplete="off"
            class="w-full pl-10 pr-4 py-2.5 text-sm bg-white border border-slate-200 rounded-lg placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition"
        >
    </div>
    <div class="flex gap-2.5">
        <select
            name="category"
            aria-label="Saring berdasarkan kategori"
            class="flex-1 sm:flex-none px-3.5 py-2.5 text-sm bg-white border border-slate-200 rounded-lg text-slate-700 focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition"
        >
            <option value="0">Semua kategori</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}" @selected($categoryId === $cat->id)>{{ $cat->name }}</option>
            @endforeach
        </select>
        <button type="submit" class="shrink-0 px-4 py-2.5 text-sm font-semibold text-white bg-primary hover:bg-primary-dark rounded-lg transition-colors">Cari</button>
        @if($hasFilter)
            <a href="{{ route('admin.documents.index') }}" class="shrink-0 inline-flex items-center px-4 py-2.5 text-sm font-medium text-slate-600 border border-slate-200 rounded-lg hover:text-slate-800 hover:border-slate-300 bg-white transition-colors">Reset</a>
        @endif
    </div>
</form>

@if($documents->total() > 0)
    <p class="text-xs text-slate-500 mb-3">Menampilkan {{ $documents->firstItem() }}–{{ $documents->lastItem() }} dari {{ $documents->total() }} dokumen</p>
@endif

<div class="bg-white border border-slate-200 rounded-xl overflow-hidden">
    @if($documents->isEmpty() && !$hasFilter)
        <p class="px-5 py-10 text-center text-sm text-slate-400">Belum ada dokumen. Klik <span class="font-semibold text-slate-600">Tambah</span> untuk mengunggah berkas pertama.</p>
    @elseif($documents->isEmpty())
        <p class="px-5 py-10 text-center text-sm text-slate-400">Tidak ada dokumen yang cocok. Ubah kata kunci atau kategori, atau <a href="{{ route('admin.documents.index') }}" class="font-medium text-primary hover:underline">tampilkan semua</a>.</p>
    @else
        <div class="overflow-x-auto">
            <table class="w-full min-w-[820px] text-sm">
                <thead>
                    <tr class="bg-slate-800 text-white text-left">
                        <th scope="col" class="w-12 px-4 py-3 text-xs font-semibold uppercase tracking-wider">No</th>
                        <th scope="col" class="px-4 py-3 text-xs font-semibold uppercase tracking-wider">Kode</th>
                        <th scope="col" class="px-4 py-3 text-xs font-semibold uppercase tracking-wider">Nama Dokumen</th>
                        <th scope="col" class="px-4 py-3 text-xs font-semibold uppercase tracking-wider">Kategori</th>
                        <th scope="col" class="w-24 px-4 py-3 text-xs font-semibold uppercase tracking-wider">Tahun</th>
                        <th scope="col" class="px-4 py-3 text-xs font-semibold uppercase tracking-wider text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($documents as $document)
                        <tr class="hover:bg-primary/5 transition-colors">
                            <td class="px-4 py-3 text-slate-500 tabular-nums">{{ $documents->firstItem() + $loop->index }}</td>
                            <td class="px-4 py-3 text-slate-600 tabular-nums whitespace-nowrap">{{ $document->code }}</td>
                            <td class="px-4 py-3 min-w-[220px]">
                                <p class="font-medium text-slate-800">{{ $document->name }}</p>
                                @if($document->fileUrl())
                                    <p class="text-xs text-slate-400 mt-0.5 font-mono">{{ basename($document->file_path) }}</p>
                                @else
                                    <p class="text-xs text-red-500 mt-0.5">Berkas tidak ditemukan di penyimpanan.</p>
                                @endif
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                <span class="inline-block px-2.5 py-1 text-[11px] font-semibold bg-primary/10 text-primary-darker rounded-md">{{ $document->documentCategory?->name ?? '—' }}</span>
                            </td>
                            <td class="px-4 py-3 text-slate-600 tabular-nums">{{ $document->published_year }}</td>
                            <td class="px-4 py-3 whitespace-nowrap text-right">
                                @if($document->fileUrl())
                                    <a href="{{ $document->fileUrl() }}" target="_blank" rel="noopener" class="inline-flex items-center px-2.5 py-1.5 text-xs font-medium text-primary-dark border border-primary/30 rounded-md hover:bg-primary/10 transition-colors">Lihat</a>
                                    <a href="{{ route('dokumen.download', $document) }}" class="inline-flex items-center px-2.5 py-1.5 ml-1.5 text-xs font-medium text-primary-dark border border-primary/30 rounded-md hover:bg-primary/10 transition-colors">Unduh</a>
                                @endif
                                <a href="{{ route('admin.documents.edit', $document) }}" class="inline-flex items-center px-2.5 py-1.5 ml-1.5 text-xs font-medium text-primary-dark border border-primary/30 rounded-md hover:bg-primary/10 transition-colors">Ubah</a>
                                <form method="POST" action="{{ route('admin.documents.destroy', $document) }}" class="inline" onsubmit="return confirm('Hapus dokumen &quot;{{ $document->name }}&quot; beserta berkasnya? Tindakan ini tidak bisa dikembalikan.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center px-2.5 py-1.5 ml-1.5 text-xs font-medium text-red-600 border border-red-200 rounded-md hover:bg-red-50 transition-colors">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if($documents->hasPages())
            <div class="px-4 py-3 border-t border-slate-100">
                {{ $documents->links() }}
            </div>
        @endif
    @endif
</div>
@endsection
