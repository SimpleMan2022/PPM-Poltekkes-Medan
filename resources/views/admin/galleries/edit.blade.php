@extends('layouts.admin')

@section('page-title', 'Ubah Foto')

@section('content')
<div class="mb-6">
    <nav class="mb-4 text-xs sm:text-sm text-slate-500">
        <a href="{{ route('admin.galleries.index') }}" class="hover:text-primary transition-colors">Galeri</a>
        <span class="mx-1.5">/</span>
        <span class="text-primary font-medium">Ubah</span>
    </nav>
    <h1 class="font-display text-xl sm:text-2xl font-bold text-slate-800 leading-snug">Ubah Foto</h1>
    <p class="text-sm text-slate-500 mt-1">Mengubah “{{ $gallery->title }}”.</p>
</div>

<form method="POST" action="{{ route('admin.galleries.update', $gallery) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    @include('admin.galleries._form')
</form>
@endsection
