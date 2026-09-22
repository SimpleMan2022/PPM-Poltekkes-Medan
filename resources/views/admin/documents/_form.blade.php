{{-- Dipakai create & edit. Variabel $document dan $categories selalu tersedia. --}}
<div class="bg-white border border-slate-200 rounded-xl p-5 sm:p-6 space-y-5 max-w-2xl">
    <div class="grid sm:grid-cols-2 gap-5">
        <div>
            <label for="code" class="block text-sm font-semibold text-slate-800 mb-1.5">Kode dokumen <span class="text-red-500">*</span></label>
            <input id="code" type="text" name="code" value="{{ old('code', $document->code) }}" required maxlength="100"
                placeholder="Contoh: SOP/PPM/01/2026"
                class="w-full px-3.5 py-2.5 text-sm border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition @error('code') border-red-300 @else border-slate-200 @enderror">
            @error('code')
                <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="published_year" class="block text-sm font-semibold text-slate-800 mb-1.5">Tahun terbit <span class="text-red-500">*</span></label>
            <input id="published_year" type="number" name="published_year" value="{{ old('published_year', $document->published_year ?? date('Y')) }}" required min="1900" max="{{ date('Y') }}" step="1"
                class="w-full px-3.5 py-2.5 text-sm border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition @error('published_year') border-red-300 @else border-slate-200 @enderror">
            @error('published_year')
                <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div>
        <label for="name" class="block text-sm font-semibold text-slate-800 mb-1.5">Nama dokumen <span class="text-red-500">*</span></label>
        <input id="name" type="text" name="name" value="{{ old('name', $document->name) }}" required maxlength="255"
            placeholder="Contoh: SOP Audit Mutu Internal"
            class="w-full px-3.5 py-2.5 text-sm border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition @error('name') border-red-300 @else border-slate-200 @enderror">
        @error('name')
            <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="document_category_id" class="block text-sm font-semibold text-slate-800 mb-1.5">Kategori <span class="text-red-500">*</span></label>
        @if($categories->isEmpty())
            <p class="text-sm text-amber-800 bg-amber-50 border border-amber-200 rounded-lg p-3.5">Belum ada kategori. <a href="{{ route('admin.document-categories.create') }}" class="font-semibold text-primary hover:underline">Buat kategori dulu</a> sebelum menambah dokumen.</p>
        @else
            <select id="document_category_id" name="document_category_id" required
                class="w-full px-3.5 py-2.5 text-sm border rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition @error('document_category_id') border-red-300 @else border-slate-200 @enderror">
                <option value="">— Pilih kategori —</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" @selected(old('document_category_id', $document->document_category_id) == $category->id)>{{ $category->name }}</option>
                @endforeach
            </select>
        @endif
        @error('document_category_id')
            <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="file" class="block text-sm font-semibold text-slate-800 mb-1.5">Berkas PDF {{ $document->exists ? '' : '*' }}</label>
        @if($document->exists && $document->fileUrl())
            <p class="mb-2.5 text-sm">
                <a href="{{ $document->fileUrl() }}" target="_blank" rel="noopener" class="font-medium text-primary hover:underline">Lihat berkas saat ini</a>
                <span class="text-slate-400">({{ basename($document->file_path) }})</span>
            </p>
        @endif
        <p id="fileInfo" class="hidden mb-2.5 text-sm text-slate-600"></p>
        <input id="file" type="file" name="file" accept="application/pdf,.pdf" {{ $document->exists ? '' : 'required' }}
            class="w-full text-sm text-slate-600 file:mr-3 file:px-3.5 file:py-2 file:text-xs file:font-semibold file:text-white file:bg-primary hover:file:bg-primary-dark file:rounded-md file:border-0 file:cursor-pointer border rounded-lg @error('file') border-red-300 @else border-slate-200 @enderror">
        <p id="fileSizeError" class="hidden mt-1.5 text-xs text-red-600">Ukuran berkas melebihi 5 MB. Kompres dulu PDF-nya lalu pilih ulang.</p>
        <p class="mt-1.5 text-xs text-slate-400">Wajib PDF, maksimal 5 MB. Nama berkas diamankan otomatis saat disimpan. {{ $document->exists ? 'Biarkan kosong bila berkas tidak diganti.' : '' }}</p>
        @error('file')
            <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex items-center gap-2.5 pt-1">
        <button type="submit" class="px-5 py-2.5 text-sm font-semibold text-white bg-primary hover:bg-primary-dark rounded-md transition-colors">Simpan</button>
        <a href="{{ route('admin.documents.index') }}" class="px-5 py-2.5 text-sm font-medium text-slate-600 hover:text-slate-800 transition-colors">Batal</a>
    </div>
</div>

@push('scripts')
<script>
    (function() {
        var input = document.getElementById('file');
        var info = document.getElementById('fileInfo');
        var sizeError = document.getElementById('fileSizeError');
        var maxBytes = 5 * 1024 * 1024;
        if (!input || !info) return;
        function formatSize(bytes) {
            if (bytes >= 1048576) return (bytes / 1048576).toFixed(1) + ' MB';
            return Math.round(bytes / 1024) + ' KB';
        }
        input.addEventListener('change', function() {
            var file = input.files && input.files[0];
            if (sizeError) sizeError.classList.add('hidden');
            if (!file) {
                info.classList.add('hidden');
                info.textContent = '';
                return;
            }
            if (file.size > maxBytes) {
                if (sizeError) sizeError.classList.remove('hidden');
                input.value = '';
                info.classList.add('hidden');
                info.textContent = '';
                return;
            }
            info.textContent = file.name + ' (' + formatSize(file.size) + ')';
            info.classList.remove('hidden');
        });
    })();
</script>
@endpush
