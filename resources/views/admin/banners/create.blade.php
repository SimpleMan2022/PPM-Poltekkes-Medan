@extends('layouts.admin')

@section('page-title', 'Tambah Banner')

@section('content')
<div class="mb-6">
    <nav class="mb-4 text-xs sm:text-sm text-slate-500">
        <a href="{{ route('admin.banners.index') }}" class="hover:text-primary transition-colors">Banner Slider</a>
        <span class="mx-1.5">/</span>
        <span class="text-primary font-medium">Tambah</span>
    </nav>
    <h1 class="font-display text-xl sm:text-2xl font-bold text-slate-800 leading-snug">Tambah Banner</h1>
    <p class="text-sm text-slate-500 mt-1">Gambar yang diunggah langsung tersimpan dan tampil di beranda bila statusnya aktif.</p>
</div>

<form method="POST" action="{{ route('admin.banners.store') }}" enctype="multipart/form-data">
    @csrf
    @include('admin.banners._form')
</form>
@endsection
