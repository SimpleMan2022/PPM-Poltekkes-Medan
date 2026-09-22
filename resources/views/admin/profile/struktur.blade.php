@extends('layouts.admin')

@section('page-title', 'Struktur Organisasi')

@section('content')
<div class="mb-6">
    <nav class="mb-4 text-xs sm:text-sm text-slate-500">
        <a href="{{ route('admin.dashboard') }}" class="hover:text-primary transition-colors">Dashboard</a>
        <span class="mx-1.5">/</span>
        <span class="text-slate-800 font-medium">Profil</span>
        <span class="mx-1.5">/</span>
        <span class="text-primary font-medium">Struktur Organisasi</span>
    </nav>
    <h1 class="font-display text-xl sm:text-2xl font-bold text-slate-800 leading-snug">Struktur Organisasi</h1>
    <p class="text-sm text-slate-500 mt-1">Bagan tampil di halaman Profil → Struktur Organisasi. Klik gambar untuk memperbesar.</p>
</div>

<form method="POST" action="{{ route('admin.profile.struktur.update') }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="bg-white border border-slate-200 rounded-xl p-5 sm:p-6 space-y-5 max-w-2xl">
        <div>
            <label for="organization_structure" class="block text-sm font-semibold text-slate-800 mb-1.5">Gambar bagan</label>
            @if($profile->exists && $profile->organization_structure)
                <img id="currentStructure" src="{{ asset($profile->organization_structure) }}" alt="Bagan struktur organisasi" class="w-full max-w-sm rounded-lg bg-slate-100 border border-slate-200 mb-2.5">
            @endif
            <img id="structurePreview" src="#" alt="Pratinjau bagan baru" class="hidden w-full max-w-sm rounded-lg bg-slate-100 border border-slate-200 mb-2.5">
            <input id="organization_structure" type="file" name="organization_structure" accept="image/jpeg,image/png,image/webp"
                class="w-full text-sm text-slate-600 file:mr-3 file:px-3.5 file:py-2 file:text-xs file:font-semibold file:text-white file:bg-primary hover:file:bg-primary-dark file:rounded-md file:border-0 file:cursor-pointer border rounded-lg @error('organization_structure') border-red-300 @else border-slate-200 @enderror">
            <p id="structureSizeError" class="hidden mt-1.5 text-xs text-red-600">Ukuran bagan melebihi 2 MB. Kecilkan dulu gambarnya lalu pilih ulang.</p>
            <p class="mt-1.5 text-xs text-slate-400">JPG, PNG, atau WebP, maksimal 2 MB. Gambar otomatis dikonversi ke WebP. Biarkan kosong bila bagan tidak diganti.</p>
            @error('organization_structure')
                <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center gap-2.5 pt-1">
            <button type="submit" class="px-5 py-2.5 text-sm font-semibold text-white bg-primary hover:bg-primary-dark rounded-md transition-colors">Simpan</button>
            <a href="{{ route('admin.dashboard') }}" class="px-5 py-2.5 text-sm font-medium text-slate-600 hover:text-slate-800 transition-colors">Batal</a>
        </div>
    </div>
</form>
@endsection

@push('scripts')
<script>
    (function() {
        var input = document.getElementById('organization_structure');
        var preview = document.getElementById('structurePreview');
        var current = document.getElementById('currentStructure');
        var sizeError = document.getElementById('structureSizeError');
        var maxBytes = 2 * 1024 * 1024;
        var objectUrl = null;
        if (!input || !preview) return;

        input.addEventListener('change', function() {
            var file = input.files && input.files[0];
            if (sizeError) sizeError.classList.add('hidden');
            if (objectUrl) {
                URL.revokeObjectURL(objectUrl);
                objectUrl = null;
            }
            if (!file || file.type.indexOf('image/') !== 0) {
                preview.classList.add('hidden');
                preview.removeAttribute('src');
                if (current) current.classList.remove('hidden');
                return;
            }
            if (file.size > maxBytes) {
                if (sizeError) sizeError.classList.remove('hidden');
                input.value = '';
                preview.classList.add('hidden');
                preview.removeAttribute('src');
                if (current) current.classList.remove('hidden');
                return;
            }
            objectUrl = URL.createObjectURL(file);
            preview.src = objectUrl;
            preview.classList.remove('hidden');
            if (current) current.classList.add('hidden');
        });
    })();
</script>
@endpush
