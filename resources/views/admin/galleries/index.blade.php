@extends('layouts.admin')

@section('page-title', 'Galeri')

@section('content')
<div class="mb-6">
    <nav class="mb-4 text-xs sm:text-sm text-slate-500">
        <a href="{{ route('admin.dashboard') }}" class="hover:text-primary transition-colors">Dashboard</a>
        <span class="mx-1.5">/</span>
        <span class="text-primary font-medium">Galeri</span>
    </nav>
    <div class="flex items-start justify-between gap-4">
        <div>
            <h1 class="font-display text-xl sm:text-2xl font-bold text-slate-800 leading-snug">Galeri</h1>
            <p class="text-sm text-slate-500 mt-1">Foto terbaru tampil paling atas di halaman galeri publik.</p>
        </div>
        <a href="{{ route('admin.galleries.create') }}" class="shrink-0 inline-flex items-center gap-1.5 px-4 py-2 text-sm font-semibold text-white bg-primary hover:bg-primary-dark rounded-md transition-colors">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            Tambah
        </a>
    </div>
</div>

<div class="bg-white border border-slate-200 rounded-xl overflow-hidden">
    @if($galleries->isEmpty())
        <p class="px-5 py-10 text-center text-sm text-slate-400">Belum ada foto. Klik <span class="font-semibold text-slate-600">Tambah</span> untuk mengunggah dokumentasi pertama.</p>
    @else
        <div class="overflow-x-auto">
            <table class="w-full min-w-[720px] text-sm">
                <thead>
                    <tr class="bg-slate-800 text-white text-left">
                        <th scope="col" class="w-32 px-4 py-3 text-xs font-semibold uppercase tracking-wider">Foto</th>
                        <th scope="col" class="px-4 py-3 text-xs font-semibold uppercase tracking-wider">Judul</th>
                        <th scope="col" class="w-32 px-4 py-3 text-xs font-semibold uppercase tracking-wider">Tanggal</th>
                        <th scope="col" class="px-4 py-3 text-xs font-semibold uppercase tracking-wider text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($galleries as $gallery)
                        <tr class="hover:bg-primary/5 transition-colors">
                            <td class="px-4 py-3">
                                <img src="{{ asset($gallery->image) }}" alt="{{ $gallery->title }}" class="w-28 h-16 object-cover rounded-md bg-slate-100">
                            </td>
                            <td class="px-4 py-3 min-w-[200px]">
                                <p class="font-medium text-slate-800">{{ $gallery->title }}</p>
                                @if($gallery->description)
                                    <p class="text-xs text-slate-500 mt-0.5 line-clamp-1">{{ $gallery->description }}</p>
                                @else
                                    <p class="text-xs text-slate-400 mt-0.5">Tanpa deskripsi.</p>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-slate-600 tabular-nums whitespace-nowrap">{{ $gallery->event_date?->format('d M Y') ?? '—' }}</td>
                            <td class="px-4 py-3 whitespace-nowrap text-right">
                                <a href="{{ route('admin.galleries.edit', $gallery) }}" class="inline-flex items-center px-2.5 py-1.5 text-xs font-medium text-primary-dark border border-primary/30 rounded-md hover:bg-primary/10 transition-colors">Ubah</a>
                                <form method="POST" action="{{ route('admin.galleries.destroy', $gallery) }}" class="inline" onsubmit="return confirm('Hapus foto &quot;{{ $gallery->title }}&quot; beserta berkasnya? Tindakan ini tidak bisa dikembalikan.')">
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
    @endif
</div>
@endsection
