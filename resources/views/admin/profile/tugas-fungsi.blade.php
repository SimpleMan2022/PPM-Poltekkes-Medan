@extends('layouts.admin')

@section('page-title', 'Tugas & Fungsi')

@section('content')
<div class="mb-6">
    <nav class="mb-4 text-xs sm:text-sm text-slate-500">
        <a href="{{ route('admin.dashboard') }}" class="hover:text-primary transition-colors">Dashboard</a>
        <span class="mx-1.5">/</span>
        <span class="text-slate-800 font-medium">Profil</span>
        <span class="mx-1.5">/</span>
        <span class="text-primary font-medium">Tugas &amp; Fungsi</span>
    </nav>
    <h1 class="font-display text-xl sm:text-2xl font-bold text-slate-800 leading-snug">Tugas Pokok &amp; Fungsi</h1>
    <p class="text-sm text-slate-500 mt-1">Tampil di halaman Profil → Tugas &amp; Fungsi. Kosongkan untuk menampilkan konten bawaan.</p>
</div>

<form method="POST" action="{{ route('admin.profile.tugas-fungsi.update') }}">
    @csrf
    @method('PUT')
    <div class="bg-white border border-slate-200 rounded-xl p-5 sm:p-6 space-y-5 max-w-2xl">
        <div>
            <label for="main_duties" class="block text-sm font-semibold text-slate-800 mb-1.5">Tugas pokok</label>
            <textarea id="main_duties" name="main_duties" rows="3" placeholder="Satu pernyataan mandat, contoh: Mengoordinasikan, memantau, dan mengevaluasi penjaminan mutu di seluruh program studi."
                class="w-full px-3.5 py-2.5 text-sm border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition @error('main_duties') border-red-300 @else border-slate-200 @enderror">{{ old('main_duties', $profile->main_duties ? strip_tags($profile->main_duties) : null) }}</textarea>
            @error('main_duties')
                <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="dutiesEditor" class="block text-sm font-semibold text-slate-800 mb-1.5">Rincian fungsi</label>
            <div id="dutiesEditor">{!! old('duties_functions', $profile->duties_functions) !!}</div>
            <input id="duties_functions" type="hidden" name="duties_functions" value="{{ old('duties_functions', $profile->duties_functions) }}">
            @error('duties_functions')
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
    #dutiesEditor .ql-toolbar.ql-snow {
        border-radius: 0.5rem 0.5rem 0 0;
        border-color: rgb(226 232 240);
    }
    #dutiesEditor .ql-container.ql-snow {
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
        var editorEl = document.getElementById('dutiesEditor');
        var hiddenInput = document.getElementById('duties_functions');
        if (!editorEl || !hiddenInput || typeof Quill === 'undefined') return;
        var quill = new Quill(editorEl, {
            theme: 'snow',
            placeholder: 'Tulis rincian fungsi di sini…',
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
        function syncHidden() {
            hiddenInput.value = quill.getText().trim() === '' ? '' : quill.root.innerHTML;
        }
        quill.on('text-change', syncHidden);
        var form = editorEl.closest('form');
        if (form) form.addEventListener('submit', syncHidden);
        syncHidden();
    })();
</script>
@endpush
