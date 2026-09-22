@extends('layouts.admin')

@section('page-title', 'Personalia')

@section('content')
<div class="mb-6">
    <nav class="mb-4 text-xs sm:text-sm text-slate-500">
        <a href="{{ route('admin.dashboard') }}" class="hover:text-primary transition-colors">Dashboard</a>
        <span class="mx-1.5">/</span>
        <span class="text-primary font-medium">Personalia</span>
    </nav>
    <div class="flex items-start justify-between gap-4">
        <div>
            <h1 class="font-display text-xl sm:text-2xl font-bold text-slate-800 leading-snug">Personalia</h1>
            <p class="text-sm text-slate-500 mt-1">Daftar pengelola yang tampil di halaman Struktur Organisasi, urut dari angka terkecil.</p>
        </div>
        <a href="{{ route('admin.personnels.create') }}" class="shrink-0 inline-flex items-center gap-1.5 px-4 py-2 text-sm font-semibold text-white bg-primary hover:bg-primary-dark rounded-md transition-colors">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            Tambah
        </a>
    </div>
</div>

<div class="bg-white border border-slate-200 rounded-xl overflow-hidden">
    @if($personnels->isEmpty())
        <p class="px-5 py-10 text-center text-sm text-slate-400">Belum ada data personalia. Klik <span class="font-semibold text-slate-600">Tambah</span> untuk mengisi daftar pertama.</p>
    @else
        <div class="overflow-x-auto">
            <table class="w-full min-w-[720px] text-sm">
                <thead>
                    <tr class="bg-slate-800 text-white text-left">
                        <th scope="col" class="w-20 px-4 py-3 text-xs font-semibold uppercase tracking-wider">Foto</th>
                        <th scope="col" class="px-4 py-3 text-xs font-semibold uppercase tracking-wider">Nama</th>
                        <th scope="col" class="w-20 px-4 py-3 text-xs font-semibold uppercase tracking-wider">Urutan</th>
                        <th scope="col" class="px-4 py-3 text-xs font-semibold uppercase tracking-wider text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($personnels as $personnel)
                        <tr class="hover:bg-primary/5 transition-colors">
                            <td class="px-4 py-3">
                                @if($personnel->photo)
                                    <img src="{{ asset($personnel->photo) }}" alt="{{ $personnel->name }}" class="w-12 h-12 object-cover rounded-md bg-slate-100">
                                @else
                                    <span class="flex items-center justify-center w-12 h-12 rounded-md bg-slate-100 text-slate-300">
                                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                        </svg>
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-3 min-w-[200px]">
                                <p class="font-medium text-slate-800">{{ $personnel->name }}</p>
                                <p class="text-xs text-slate-500 mt-0.5">{{ $personnel->position }}@if($personnel->nip) <span class="text-slate-400 font-mono">• {{ $personnel->nip }}</span>@endif</p>
                            </td>
                            <td class="px-4 py-3 text-slate-600 tabular-nums">{{ $personnel->sort_order }}</td>
                            <td class="px-4 py-3 whitespace-nowrap text-right">
                                <a href="{{ route('admin.personnels.edit', $personnel) }}" class="inline-flex items-center px-2.5 py-1.5 text-xs font-medium text-primary-dark border border-primary/30 rounded-md hover:bg-primary/10 transition-colors">Ubah</a>
                                <form method="POST" action="{{ route('admin.personnels.destroy', $personnel) }}" class="inline" onsubmit="return confirm('Hapus &quot;{{ $personnel->name }}&quot; dari daftar personalia? Tindakan ini tidak bisa dikembalikan.')">
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
