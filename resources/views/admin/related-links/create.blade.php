@extends('layouts.admin')

@section('page-title', 'Tambah Tautan')

@section('content')
<div class="mb-6">
    <nav class="mb-4 text-xs sm:text-sm text-slate-500">
        <a href="{{ route('admin.related-links.index') }}" class="hover:text-primary transition-colors">Link Terkait</a>
        <span class="mx-1.5">/</span>
        <span class="text-primary font-medium">Tambah</span>
    </nav>
    <h1 class="font-display text-xl sm:text-2xl font-bold text-slate-800 leading-snug">Tambah Tautan</h1>
    <p class="text-sm text-slate-500 mt-1">Tautan yang ditayangkan langsung tampil di beranda.</p>
</div>

<form method="POST" action="{{ route('admin.related-links.store') }}" enctype="multipart/form-data">
    @csrf
    @include('admin.related-links._form')
</form>
@endsection
