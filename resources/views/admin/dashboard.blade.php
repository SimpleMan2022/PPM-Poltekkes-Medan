@extends('layouts.admin')

@section('page-title', 'Dashboard')

@section('content')
<div class="mb-6 sm:mb-8">
    <p class="section-label text-primary">Ringkasan</p>
    <h1 class="font-display text-xl sm:text-2xl font-bold text-slate-800 mt-1 leading-snug">Selamat datang, {{ explode(' ', auth()->user()->name)[0] }}.</h1>
    <p class="text-sm text-slate-500 mt-1">Kondisi konten website PPM per {{ now()->format('d M Y') }}.</p>
</div>

<!-- Statistik utama -->
<div class="grid sm:grid-cols-3 gap-4 mb-6 sm:mb-8">
    <div class="bg-white border border-slate-200 rounded-xl p-5">
        <p class="font-display text-3xl sm:text-4xl font-extrabold text-slate-800 tabular-nums">{{ $documentCount }}</p>
        <p class="text-xs font-semibold uppercase tracking-widest text-slate-400 mt-1.5">Dokumen &amp; SOP</p>
        <p class="text-sm text-slate-500 mt-1">dalam {{ $categoryCount }} kategori</p>
    </div>
    <div class="bg-white border border-slate-200 rounded-xl p-5">
        <p class="font-display text-3xl sm:text-4xl font-extrabold text-slate-800 tabular-nums">{{ $galleryCount }}</p>
        <p class="text-xs font-semibold uppercase tracking-widest text-slate-400 mt-1.5">Foto Galeri</p>
        <p class="text-sm text-slate-500 mt-1">dokumentasi kegiatan</p>
    </div>
    <div class="bg-white border border-slate-200 rounded-xl p-5">
        <p class="font-display text-3xl sm:text-4xl font-extrabold text-slate-800 tabular-nums">{{ $activeBannerCount }}<span class="text-lg text-slate-400 font-bold">/{{ $banners->count() }}</span></p>
        <p class="text-xs font-semibold uppercase tracking-widest text-slate-400 mt-1.5">Banner Aktif</p>
        <p class="text-sm text-slate-500 mt-1">tayang di slider beranda</p>
    </div>
</div>

<!-- Status banner -->
<div class="bg-white border border-slate-200 rounded-xl mb-6 sm:mb-8">
    <div class="px-5 pt-5 pb-3">
        <h2 class="font-display text-base sm:text-lg font-bold text-slate-800">Status Banner</h2>
        <p class="text-sm text-slate-500 mt-0.5">Banner aktif tampil bergantian di slider halaman beranda.</p>
    </div>
    @if($banners->isEmpty())
    <p class="px-5 pb-5 text-sm text-slate-400">Belum ada banner. <a href="{{ route('admin.banners.create') }}" class="text-primary font-medium hover:underline">Tambah banner pertama</a>.</p>
    @else
    <ul class="divide-y divide-slate-100">
        @foreach($banners as $banner)
        <li class="flex items-center gap-3 px-5 py-3">
            <span class="shrink-0 w-2 h-2 rounded-full {{ $banner->is_active ? 'bg-emerald-500' : 'bg-slate-300' }}" aria-hidden="true"></span>
            <span class="flex-1 min-w-0 text-sm font-medium text-slate-800 truncate">{{ $banner->title }}</span>
            <span class="shrink-0 text-xs {{ $banner->is_active ? 'text-emerald-600' : 'text-slate-400' }}">{{ $banner->is_active ? 'Aktif' : 'Nonaktif' }}</span>
        </li>
        @endforeach
    </ul>
    @endif
</div>

<!-- Dokumen terbaru -->
<div class="bg-white border border-slate-200 rounded-xl">
    <div class="px-5 pt-5 pb-3">
        <h2 class="font-display text-base sm:text-lg font-bold text-slate-800">Dokumen Terbaru</h2>
        <p class="text-sm text-slate-500 mt-0.5">Lima berkas terakhir yang diunggah ke arsip.</p>
    </div>
    @if($latestDocuments->isEmpty())
    <p class="px-5 pb-5 text-sm text-slate-400">Belum ada dokumen. Tambahkan dokumen setelah modul Dokumen &amp; SOP tersedia.</p>
    @else
    <ul class="divide-y divide-slate-100">
        @foreach($latestDocuments as $doc)
        <li class="px-5 py-3">
            <p class="text-[11px] text-slate-400 tabular-nums">{{ $doc->code }} &bull; {{ $doc->published_year }}</p>
            <p class="text-sm font-medium text-slate-800 mt-0.5">{{ $doc->name }}</p>
        </li>
        @endforeach
    </ul>
    @endif
</div>
@endsection