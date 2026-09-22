@extends('layouts.admin')

@section('page-title', 'Ubah Pengguna')

@section('content')
<div class="mb-6">
    <nav class="mb-4 text-xs sm:text-sm text-slate-500">
        <a href="{{ route('admin.users.index') }}" class="hover:text-primary transition-colors">Pengguna</a>
        <span class="mx-1.5">/</span>
        <span class="text-primary font-medium">Ubah</span>
    </nav>
    <h1 class="font-display text-xl sm:text-2xl font-bold text-slate-800 leading-snug">Ubah Pengguna</h1>
    <p class="text-sm text-slate-500 mt-1">Mengubah “{{ $user->name }}”. Isi password hanya bila ingin meresetnya.</p>
</div>

<form method="POST" action="{{ route('admin.users.update', $user) }}">
    @csrf
    @method('PUT')
    @include('admin.users._form')
</form>
@endsection
