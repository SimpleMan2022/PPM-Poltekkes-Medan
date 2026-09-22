@extends('layouts.admin')

@section('page-title', 'Sambutan')

@section('content')
<div class="mb-6">
    <nav class="mb-4 text-xs sm:text-sm text-slate-500">
        <a href="{{ route('admin.dashboard') }}" class="hover:text-primary transition-colors">Dashboard</a>
        <span class="mx-1.5">/</span>
        <span class="text-primary font-medium">Sambutan</span>
    </nav>
    <h1 class="font-display text-xl sm:text-2xl font-bold text-slate-800 leading-snug">Sambutan Kepala PPM</h1>
    <p class="text-sm text-slate-500 mt-1">Data ini tampil di bagian sambutan halaman beranda.</p>
</div>

<form method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="bg-white border border-slate-200 rounded-xl p-5 sm:p-6 space-y-5 max-w-2xl">
        <div>
            <label for="leader_photo" class="block text-sm font-semibold text-slate-800 mb-1.5">Foto Pimpinan</label>
            @if($profile->exists && $profile->leader_photo)
                <img id="currentPhoto" src="{{ asset($profile->leader_photo) }}" alt="{{ $profile->leader_name }}" class="w-32 h-32 object-cover rounded-lg bg-slate-100 mb-2.5">
            @endif
            <img id="photoPreview" src="#" alt="Pratinjau foto baru" class="hidden w-32 h-32 object-cover rounded-lg bg-slate-100 mb-2.5">
            <input id="leader_photo" type="file" name="leader_photo" accept="image/jpeg,image/png,image/webp"
                class="w-full text-sm text-slate-600 file:mr-3 file:px-3.5 file:py-2 file:text-xs file:font-semibold file:text-white file:bg-primary hover:file:bg-primary-dark file:rounded-md file:border-0 file:cursor-pointer border rounded-lg @error('leader_photo') border-red-300 @else border-slate-200 @enderror">
            <p id="photoSizeError" class="hidden mt-1.5 text-xs text-red-600">Ukuran foto melebihi 2 MB. Kecilkan dulu fotonya lalu pilih ulang.</p>
            <p class="mt-1.5 text-xs text-slate-400">JPG, PNG, atau WebP, maksimal 2 MB. Foto otomatis dikonversi ke WebP. Biarkan kosong bila foto tidak diganti.</p>
            @error('leader_photo')
                <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="leader_name" class="block text-sm font-semibold text-slate-800 mb-1.5">Nama lengkap &amp; gelar <span class="text-red-500">*</span></label>
            <input id="leader_name" type="text" name="leader_name" value="{{ old('leader_name', $profile->leader_name) }}" required maxlength="255"
                placeholder="Contoh: Dr. Hj. Siti Aminah, M.Kes."
                class="w-full px-3.5 py-2.5 text-sm border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition @error('leader_name') border-red-300 @else border-slate-200 @enderror">
            @error('leader_name')
                <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid sm:grid-cols-2 gap-5">
            <div>
                <label for="leader_title" class="block text-sm font-semibold text-slate-800 mb-1.5">Jabatan</label>
                <input id="leader_title" type="text" name="leader_title" value="{{ old('leader_title', $profile->leader_title) }}" maxlength="255"
                    placeholder="Contoh: Direktur"
                    class="w-full px-3.5 py-2.5 text-sm border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition @error('leader_title') border-red-300 @else border-slate-200 @enderror">
                @error('leader_title')
                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="leader_position" class="block text-sm font-semibold text-slate-800 mb-1.5">Keterangan jabatan</label>
                <input id="leader_position" type="text" name="leader_position" value="{{ old('leader_position', $profile->leader_position) }}" maxlength="255"
                    placeholder="Contoh: Kepala PPM Poltekkes Kemenkes Medan"
                    class="w-full px-3.5 py-2.5 text-sm border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition @error('leader_position') border-red-300 @else border-slate-200 @enderror">
                @error('leader_position')
                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div>
            <label for="welcomeEditor" class="block text-sm font-semibold text-slate-800 mb-1.5">Sambutan <span class="text-red-500">*</span></label>
            <div id="welcomeEditor">{!! old('welcome_message', $profile->welcome_message) !!}</div>
            <input id="welcome_message" type="hidden" name="welcome_message" value="{{ old('welcome_message', $profile->welcome_message) }}">
            @error('welcome_message')
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

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/quill@1.3.7/dist/quill.snow.css">
<style>
    #welcomeEditor .ql-toolbar.ql-snow {
        border-radius: 0.5rem 0.5rem 0 0;
        border-color: rgb(226 232 240);
    }
    #welcomeEditor .ql-container.ql-snow {
        min-height: 220px;
        border-radius: 0 0 0.5rem 0.5rem;
        border-color: rgb(226 232 240);
        font-size: 0.875rem;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/quill@1.3.7/dist/quill.min.js"></script>
<script>
    (function() {
        var editorEl = document.getElementById('welcomeEditor');
        var hiddenInput = document.getElementById('welcome_message');
        if (editorEl && hiddenInput && typeof Quill !== 'undefined') {
            var quill = new Quill(editorEl, {
                theme: 'snow',
                placeholder: 'Tulis sambutan di sini…',
                modules: {
                    toolbar: [
                        ['bold', 'italic', 'underline'],
                        [{ 'header': [1, 2, 3, false] }],
                        [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                        ['link'],
                        ['clean']
                    ]
                }
            });
            var Delta = Quill.import('delta');
            quill.clipboard.addMatcher(Node.ELEMENT_NODE, function(node, delta) {
                var ops = [];
                delta.ops.forEach(function(op) {
                    if (op.insert && typeof op.insert === 'object' && op.insert.image) return;
                    ops.push(op);
                });
                delta.ops = ops;
                return delta;
            });
            quill.root.addEventListener('drop', function(e) {
                if (e.dataTransfer && e.dataTransfer.files && e.dataTransfer.files.length) e.preventDefault();
            }, true);
            quill.root.addEventListener('paste', function(e) {
                var cd = e.clipboardData;
                if (cd && cd.files && cd.files.length && !(cd.getData && cd.getData('text/plain').trim())) {
                    e.preventDefault();
                }
            }, true);
            var syncWelcome = function() {
                hiddenInput.value = quill.getText().trim() === '' ? '' : quill.root.innerHTML;
            };
            quill.on('text-change', syncWelcome);
            var welcomeForm = editorEl.closest('form');
            if (welcomeForm) welcomeForm.addEventListener('submit', syncWelcome);
            syncWelcome();
        }

        var input = document.getElementById('leader_photo');
        var preview = document.getElementById('photoPreview');
        var current = document.getElementById('currentPhoto');
        var sizeError = document.getElementById('photoSizeError');
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
