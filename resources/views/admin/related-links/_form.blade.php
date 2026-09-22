{{-- Dipakai create & edit. Variabel $link selalu tersedia. --}}
<div class="bg-white border border-slate-200 rounded-xl p-5 sm:p-6 space-y-5 max-w-2xl">
    <div>
        <label for="name" class="block text-sm font-semibold text-slate-800 mb-1.5">Nama institusi/aplikasi <span class="text-red-500">*</span></label>
        <input id="name" type="text" name="name" value="{{ old('name', $link->name) }}" required maxlength="255"
            placeholder="Contoh: Kementerian Kesehatan RI"
            class="w-full px-3.5 py-2.5 text-sm border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition @error('name') border-red-300 @else border-slate-200 @enderror">
        @error('name')
            <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="url" class="block text-sm font-semibold text-slate-800 mb-1.5">URL tautan tujuan <span class="text-red-500">*</span></label>
        <input id="url" type="url" name="url" value="{{ old('url', $link->url) }}" required maxlength="255"
            placeholder="https://…"
            class="w-full px-3.5 py-2.5 text-sm border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition @error('url') border-red-300 @else border-slate-200 @enderror">
        @error('url')
            <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="logo" class="block text-sm font-semibold text-slate-800 mb-1.5">Logo</label>
        @if($link->exists && $link->logoUrl())
            <img id="currentImage" src="{{ $link->logoUrl() }}" alt="{{ $link->name }}" class="w-20 h-20 object-contain rounded-lg bg-slate-100 border border-slate-200 mb-2.5">
        @endif
        <img id="imagePreview" src="#" alt="Pratinjau logo baru" class="hidden w-20 h-20 object-contain rounded-lg bg-slate-100 border border-slate-200 mb-2.5">
        <input id="logo" type="file" name="logo" accept="image/jpeg,image/png,image/webp"
            class="w-full text-sm text-slate-600 file:mr-3 file:px-3.5 file:py-2 file:text-xs file:font-semibold file:text-white file:bg-primary hover:file:bg-primary-dark file:rounded-md file:border-0 file:cursor-pointer border rounded-lg @error('logo') border-red-300 @else border-slate-200 @enderror">
        <p id="imageSizeError" class="hidden mt-1.5 text-xs text-red-600">Ukuran logo melebihi 2 MB. Kecilkan dulu logonya lalu pilih ulang.</p>
        <p class="mt-1.5 text-xs text-slate-400">Opsional. JPG, PNG, atau WebP, maksimal 2 MB. Idealnya logo persegi karena tampil kecil di beranda. {{ $link->exists ? 'Biarkan kosong bila logo tidak diganti.' : '' }}</p>
        @error('logo')
            <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="grid sm:grid-cols-2 gap-5">
        <div>
            <label for="sort_order" class="block text-sm font-semibold text-slate-800 mb-1.5">Urutan <span class="text-red-500">*</span></label>
            <input id="sort_order" type="number" name="sort_order" value="{{ old('sort_order', $link->sort_order) }}" required min="0" step="1"
                class="w-full px-3.5 py-2.5 text-sm border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition @error('sort_order') border-red-300 @else border-slate-200 @enderror">
            <p class="mt-1.5 text-xs text-slate-400">Angka kecil tampil lebih dulu. Tiap nomor hanya boleh dipakai satu tautan.</p>
            @error('sort_order')
                <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>
        <div class="flex items-end pb-1">
            <label class="flex items-center gap-2.5 cursor-pointer select-none">
                <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $link->is_active)) class="w-4 h-4 rounded text-primary border-slate-300 focus:ring-primary">
                <span class="text-sm font-medium text-slate-700">Tayangkan <span class="block text-xs font-normal text-slate-400">tampil di beranda</span></span>
            </label>
        </div>
    </div>

    <div class="flex items-center gap-2.5 pt-1">
        <button type="submit" class="px-5 py-2.5 text-sm font-semibold text-white bg-primary hover:bg-primary-dark rounded-md transition-colors">Simpan</button>
        <a href="{{ route('admin.related-links.index') }}" class="px-5 py-2.5 text-sm font-medium text-slate-600 hover:text-slate-800 transition-colors">Batal</a>
    </div>
</div>

@push('scripts')
<script>
    (function() {
        var input = document.getElementById('logo');
        var preview = document.getElementById('imagePreview');
        var current = document.getElementById('currentImage');
        var sizeError = document.getElementById('imageSizeError');
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
