@extends('layouts.admin')

@section('page-title', 'Tambah Kategori')

@section('content')
<div class="mb-6">
    <nav class="mb-4 text-xs sm:text-sm text-slate-500">
        <a href="{{ route('admin.document-categories.index') }}" class="hover:text-primary transition-colors">Kategori</a>
        <span class="mx-1.5">/</span>
        <span class="text-primary font-medium">Tambah</span>
    </nav>
    <h1 class="font-display text-xl sm:text-2xl font-bold text-slate-800 leading-snug">Tambah Kategori</h1>
    <p class="text-sm text-slate-500 mt-1">Slug dibuat otomatis dari nama kategori.</p>
</div>

<form method="POST" action="{{ route('admin.document-categories.store') }}">
    @csrf
    @include('admin.document-categories._form')
</form>
@endsection
