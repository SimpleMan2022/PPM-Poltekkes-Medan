@extends('layouts.admin')

@section('page-title', 'Tambah Pengguna')

@section('content')
<div class="mb-6">
    <nav class="mb-4 text-xs sm:text-sm text-slate-500">
        <a href="{{ route('admin.users.index') }}" class="hover:text-primary transition-colors">Pengguna</a>
        <span class="mx-1.5">/</span>
        <span class="text-primary font-medium">Tambah</span>
    </nav>
    <h1 class="font-display text-xl sm:text-2xl font-bold text-slate-800 leading-snug">Tambah Pengguna</h1>
    <p class="text-sm text-slate-500 mt-1">Buat akun admin baru beserta perannya.</p>
</div>

<form method="POST" action="{{ route('admin.users.store') }}">
    @csrf
    @include('admin.users._form')
</form>
@endsection
