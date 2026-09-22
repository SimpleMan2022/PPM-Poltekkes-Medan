{{-- Dipakai create & edit. Variabel $gallery selalu tersedia. --}}
<div class="bg-white border border-slate-200 rounded-xl p-5 sm:p-6 space-y-5 max-w-2xl">
    <div>
        <label for="title" class="block text-sm font-semibold text-slate-800 mb-1.5">Judul kegiatan <span class="text-red-500">*</span></label>
        <input id="title" type="text" name="title" value="{{ old('title', $gallery->title) }}" required maxlength="255"
            placeholder="Contoh: Audit Mutu Internal 2026"
            class="w-full px-3.5 py-2.5 text-sm border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition @error('title') border-red-300 @else border-slate-200 @enderror">
        @error('title')
            <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="event_date" class="block text-sm font-semibold text-slate-800 mb-1.5">Tanggal pelaksanaan</label>
        <input id="event_date" type="date" name="event_date" value="{{ old('event_date', $gallery->event_date?->format('Y-m-d')) }}"
            class="w-full px-3.5 py-2.5 text-sm border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition @error('event_date') border-red-300 @else border-slate-200 @enderror">
        <p class="mt-1.5 text-xs text-slate-400">Boleh dikosongkan bila tanggal belum pasti.</p>
        @error('event_date')
            <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="description" class="block text-sm font-semibold text-slate-800 mb-1.5">Deskripsi singkat</label>
        <textarea id="description" name="description" rows="3" placeholder="Satu-dua kalimat tentang kegiatan (boleh kosong)"
            class="w-full px-3.5 py-2.5 text-sm border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition @error('description') border-red-300 @else border-slate-200 @enderror">{{ old('description', $gallery->description) }}</textarea>
        @error('description')
            <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="image" class="block text-sm font-semibold text-slate-800 mb-1.5">Foto {{ $gallery->exists ? '' : '*' }}</label>
        @if($gallery->exists && $gallery->image)
            <img id="currentImage" src="{{ asset($gallery->image) }}" alt="{{ $gallery->title }}" class="w-full max-w-sm aspect-[16/9] object-cover rounded-lg bg-slate-100 mb-2.5">
        @endif
        <img id="imagePreview" src="#" alt="Pratinjau foto baru" class="hidden w-full max-w-sm aspect-[16/9] object-cover rounded-lg bg-slate-100 mb-2.5">
        <input id="image" type="file" name="image" accept="image/jpeg,image/png,image/webp" {{ $gallery->exists ? '' : 'required' }}
            class="w-full text-sm text-slate-600 file:mr-3 file:px-3.5 file:py-2 file:text-xs file:font-semibold file:text-white file:bg-primary hover:file:bg-primary-dark file:rounded-md file:border-0 file:cursor-pointer border rounded-lg @error('image') border-red-300 @else border-slate-200 @enderror">
        <p id="imageSizeError" class="hidden mt-1.5 text-xs text-red-600">Ukuran foto melebihi 2 MB. Kecilkan dulu fotonya lalu pilih ulang.</p>
        <p class="mt-1.5 text-xs text-slate-400">JPG, PNG, atau WebP, maksimal 2 MB. Foto otomatis dikonversi ke WebP. {{ $gallery->exists ? 'Biarkan kosong bila foto tidak diganti.' : '' }}</p>
        @error('image')
            <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex items-center gap-2.5 pt-1">
        <button type="submit" class="px-5 py-2.5 text-sm font-semibold text-white bg-primary hover:bg-primary-dark rounded-md transition-colors">Simpan</button>
        <a href="{{ route('admin.galleries.index') }}" class="px-5 py-2.5 text-sm font-medium text-slate-600 hover:text-slate-800 transition-colors">Batal</a>
    </div>
</div>

@push('scripts')
<script>
    (function() {
        var input = document.getElementById('image');
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
