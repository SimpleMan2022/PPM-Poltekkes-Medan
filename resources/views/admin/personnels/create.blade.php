@extends('layouts.admin')

@section('page-title', 'Tambah Personalia')

@section('content')
<div class="mb-6">
    <nav class="mb-4 text-xs sm:text-sm text-slate-500">
        <a href="{{ route('admin.personnels.index') }}" class="hover:text-primary transition-colors">Personalia</a>
        <span class="mx-1.5">/</span>
        <span class="text-primary font-medium">Tambah</span>
    </nav>
    <h1 class="font-display text-xl sm:text-2xl font-bold text-slate-800 leading-snug">Tambah Personalia</h1>
    <p class="text-sm text-slate-500 mt-1">Data yang disimpan langsung tampil di halaman Struktur Organisasi.</p>
</div>

<form method="POST" action="{{ route('admin.personnels.store') }}" enctype="multipart/form-data">
    @csrf
    @include('admin.personnels._form')
</form>
@endsection
