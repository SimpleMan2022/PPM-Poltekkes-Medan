@extends('layouts.admin')

@section('page-title', 'Link Terkait')

@section('content')
<div class="mb-6">
    <nav class="mb-4 text-xs sm:text-sm text-slate-500">
        <a href="{{ route('admin.dashboard') }}" class="hover:text-primary transition-colors">Dashboard</a>
        <span class="mx-1.5">/</span>
        <span class="text-primary font-medium">Link Terkait</span>
    </nav>
    <div class="flex items-start justify-between gap-4">
        <div>
            <h1 class="font-display text-xl sm:text-2xl font-bold text-slate-800 leading-snug">Link Terkait</h1>
            <p class="text-sm text-slate-500 mt-1">Urutan kecil tampil lebih dulu. Hanya tautan yang ditayangkan muncul di beranda.</p>
        </div>
        <a href="{{ route('admin.related-links.create') }}" class="shrink-0 inline-flex items-center gap-1.5 px-4 py-2 text-sm font-semibold text-white bg-primary hover:bg-primary-dark rounded-md transition-colors">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            Tambah
        </a>
    </div>
</div>

<div class="bg-white border border-slate-200 rounded-xl overflow-hidden">
    @if($links->isEmpty())
        <p class="px-5 py-10 text-center text-sm text-slate-400">Belum ada tautan. Klik <span class="font-semibold text-slate-600">Tambah</span> untuk membuat tautan pertama.</p>
    @else
        <div class="overflow-x-auto">
            <table class="w-full min-w-[720px] text-sm">
                <thead>
                    <tr class="bg-slate-800 text-white text-left">
                        <th scope="col" class="w-20 px-4 py-3 text-xs font-semibold uppercase tracking-wider">Logo</th>
                        <th scope="col" class="px-4 py-3 text-xs font-semibold uppercase tracking-wider">Nama</th>
                        <th scope="col" class="w-20 px-4 py-3 text-xs font-semibold uppercase tracking-wider">Urutan</th>
                        <th scope="col" class="w-28 px-4 py-3 text-xs font-semibold uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-4 py-3 text-xs font-semibold uppercase tracking-wider text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($links as $link)
                        <tr class="hover:bg-primary/5 transition-colors">
                            <td class="px-4 py-3">
                                @if($link->logoUrl())
                                    <img src="{{ $link->logoUrl() }}" alt="{{ $link->name }}" class="w-12 h-12 object-contain rounded-md bg-slate-100 border border-slate-200">
                                @else
                                    <span class="block w-12 h-12 rounded-md bg-slate-100 text-slate-300 text-[10px] font-medium leading-[3rem] text-center">Kosong</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 min-w-[200px]">
                                <p class="font-medium text-slate-800">{{ $link->name }}</p>
                                <p class="text-xs text-slate-500 mt-0.5 truncate">{{ $link->url }}</p>
                            </td>
                            <td class="px-4 py-3 text-slate-600 tabular-nums">{{ $link->sort_order }}</td>
                            <td class="px-4 py-3">
                                <form method="POST" action="{{ route('admin.related-links.toggle', $link) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" title="Klik untuk {{ $link->is_active ? 'menyembunyikan' : 'menayangkan' }}"
                                        class="inline-block px-2.5 py-1 text-[11px] font-semibold rounded-md transition-colors {{ $link->is_active ? 'bg-primary/10 text-primary-darker hover:bg-primary/20' : 'bg-slate-100 text-slate-500 hover:bg-slate-200' }}">
                                        {{ $link->is_active ? 'Tayang' : 'Sembunyi' }}
                                    </button>
                                </form>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-right">
                                <a href="{{ route('admin.related-links.edit', $link) }}" class="inline-flex items-center px-2.5 py-1.5 text-xs font-medium text-primary-dark border border-primary/30 rounded-md hover:bg-primary/10 transition-colors">Ubah</a>
                                <form method="POST" action="{{ route('admin.related-links.destroy', $link) }}" class="inline" onsubmit="return confirm('Hapus tautan &quot;{{ $link->name }}&quot;? Tindakan ini tidak bisa dikembalikan.')">
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
