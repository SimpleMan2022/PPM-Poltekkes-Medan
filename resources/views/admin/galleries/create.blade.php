@extends('layouts.admin')

@section('page-title', 'Tambah Foto')

@section('content')
<div class="mb-6">
    <nav class="mb-4 text-xs sm:text-sm text-slate-500">
        <a href="{{ route('admin.galleries.index') }}" class="hover:text-primary transition-colors">Galeri</a>
        <span class="mx-1.5">/</span>
        <span class="text-primary font-medium">Tambah</span>
    </nav>
    <h1 class="font-display text-xl sm:text-2xl font-bold text-slate-800 leading-snug">Tambah Foto</h1>
    <p class="text-sm text-slate-500 mt-1">Foto yang diunggah langsung tampil di halaman galeri publik.</p>
</div>

<form method="POST" action="{{ route('admin.galleries.store') }}" enctype="multipart/form-data">
    @csrf
    @include('admin.galleries._form')
</form>
@endsection
