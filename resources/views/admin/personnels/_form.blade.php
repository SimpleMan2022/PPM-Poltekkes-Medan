{{-- Dipakai create & edit. Variabel $personnel selalu tersedia. --}}
<div class="bg-white border border-slate-200 rounded-xl p-5 sm:p-6 space-y-5 max-w-2xl">
    <div>
        <label for="name" class="block text-sm font-semibold text-slate-800 mb-1.5">Nama <span class="text-red-500">*</span></label>
        <input id="name" type="text" name="name" value="{{ old('name', $personnel->name) }}" required maxlength="255"
            placeholder="Contoh: Bdn. Tiyara Safitri, S.Si.T., M.Tr.Keb"
            class="w-full px-3.5 py-2.5 text-sm border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition @error('name') border-red-300 @else border-slate-200 @enderror">
        @error('name')
            <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="grid sm:grid-cols-2 gap-5">
        <div>
            <label for="position" class="block text-sm font-semibold text-slate-800 mb-1.5">Jabatan <span class="text-red-500">*</span></label>
            <input id="position" type="text" name="position" value="{{ old('position', $personnel->position) }}" required maxlength="255"
                placeholder="Contoh: PJ. SPMI dan SPME"
                class="w-full px-3.5 py-2.5 text-sm border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition @error('position') border-red-300 @else border-slate-200 @enderror">
            @error('position')
                <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="nip" class="block text-sm font-semibold text-slate-800 mb-1.5">NIP</label>
            <input id="nip" type="text" name="nip" value="{{ old('nip', $personnel->nip) }}" maxlength="50" inputmode="numeric"
                placeholder="Contoh: 199010262025062001"
                class="w-full px-3.5 py-2.5 text-sm border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition @error('nip') border-red-300 @else border-slate-200 @enderror">
            <p class="mt-1.5 text-xs text-slate-400">Boleh dikosongkan bila belum ada.</p>
            @error('nip')
                <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="grid sm:grid-cols-2 gap-5">
        <div>
            <label for="photo" class="block text-sm font-semibold text-slate-800 mb-1.5">Foto</label>
            @if($personnel->exists && $personnel->photo)
                <img id="currentImage" src="{{ asset($personnel->photo) }}" alt="{{ $personnel->name }}" class="w-24 h-24 object-cover rounded-lg bg-slate-100 mb-2.5">
            @endif
            <img id="imagePreview" src="#" alt="Pratinjau foto baru" class="hidden w-24 h-24 object-cover rounded-lg bg-slate-100 mb-2.5">
            <input id="photo" type="file" name="photo" accept="image/jpeg,image/png,image/webp"
                class="w-full text-sm text-slate-600 file:mr-3 file:px-3.5 file:py-2 file:text-xs file:font-semibold file:text-white file:bg-primary hover:file:bg-primary-dark file:rounded-md file:border-0 file:cursor-pointer border rounded-lg @error('photo') border-red-300 @else border-slate-200 @enderror">
            <p id="imageSizeError" class="hidden mt-1.5 text-xs text-red-600">Ukuran foto melebihi 2 MB. Kecilkan dulu fotonya lalu pilih ulang.</p>
            <p class="mt-1.5 text-xs text-slate-400">Opsional. JPG, PNG, atau WebP, maksimal 2 MB. {{ $personnel->exists ? 'Biarkan kosong bila foto tidak diganti.' : '' }}</p>
            @error('photo')
                <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="sort_order" class="block text-sm font-semibold text-slate-800 mb-1.5">Urutan <span class="text-red-500">*</span></label>
            <input id="sort_order" type="number" name="sort_order" value="{{ old('sort_order', $personnel->sort_order) }}" required min="0" step="1"
                class="w-full px-3.5 py-2.5 text-sm border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition @error('sort_order') border-red-300 @else border-slate-200 @enderror">
            <p class="mt-1.5 text-xs text-slate-400">Angka kecil tampil lebih dulu. Tiap nomor hanya boleh dipakai satu orang.</p>
            @error('sort_order')
                <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="flex items-center gap-2.5 pt-1">
        <button type="submit" class="px-5 py-2.5 text-sm font-semibold text-white bg-primary hover:bg-primary-dark rounded-md transition-colors">Simpan</button>
        <a href="{{ route('admin.personnels.index') }}" class="px-5 py-2.5 text-sm font-medium text-slate-600 hover:text-slate-800 transition-colors">Batal</a>
    </div>
</div>

@push('scripts')
<script>
    (function() {
        var input = document.getElementById('photo');
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
