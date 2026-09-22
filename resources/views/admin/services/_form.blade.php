{{-- Dipakai create & edit. Variabel $service selalu tersedia. --}}
<div class="bg-white border border-slate-200 rounded-xl p-5 sm:p-6 space-y-5 max-w-2xl">
    <div>
        <label for="name" class="block text-sm font-semibold text-slate-800 mb-1.5">Nama layanan <span class="text-red-500">*</span></label>
        <input id="name" type="text" name="name" value="{{ old('name', $service->name) }}" required maxlength="255"
            placeholder="Contoh: Konsultasi SPMI"
            class="w-full px-3.5 py-2.5 text-sm border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition @error('name') border-red-300 @else border-slate-200 @enderror">
        @error('name')
            <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="description" class="block text-sm font-semibold text-slate-800 mb-1.5">Deskripsi singkat</label>
        <textarea id="description" name="description" rows="3" placeholder="Satu-dua kalimat penjelasan layanan (boleh kosong)"
            class="w-full px-3.5 py-2.5 text-sm border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition @error('description') border-red-300 @else border-slate-200 @enderror">{{ old('description', $service->description) }}</textarea>
        @error('description')
            <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <span class="block text-sm font-semibold text-slate-800 mb-1.5">Ikon</span>
        <div class="grid grid-cols-4 sm:grid-cols-6 gap-2">
            <label class="cursor-pointer">
                <input type="radio" name="icon" value="" class="peer sr-only" @checked(old('icon', $service->icon) === null || old('icon', $service->icon) === '')>
                <span class="flex flex-col items-center gap-1 p-2.5 border rounded-lg transition-colors peer-checked:border-primary peer-checked:bg-primary/5 peer-checked:text-primary text-slate-400 hover:border-slate-300">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                    </svg>
                    <span class="text-[10px] font-medium text-center leading-tight">Tanpa ikon</span>
                </span>
            </label>
            @foreach(config('service-icons', []) as $id => $icon)
                <label class="cursor-pointer" title="{{ $icon['label'] }}">
                    <input type="radio" name="icon" value="{{ $id }}" class="peer sr-only" @checked(old('icon', $service->icon) === $id)>
                    <span class="flex flex-col items-center gap-1 p-2.5 border rounded-lg transition-colors peer-checked:border-primary peer-checked:bg-primary/5 peer-checked:text-primary text-slate-400 hover:border-slate-300">
                        <x-service-icon :name="$id" class="w-6 h-6" />
                        <span class="text-[10px] font-medium text-center leading-tight">{{ $icon['label'] }}</span>
                    </span>
                </label>
            @endforeach
        </div>
        @error('icon')
            <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="grid sm:grid-cols-2 gap-5">
        <div>
            <label for="sort_order" class="block text-sm font-semibold text-slate-800 mb-1.5">Urutan <span class="text-red-500">*</span></label>
            <input id="sort_order" type="number" name="sort_order" value="{{ old('sort_order', $service->sort_order) }}" required min="0" step="1"
                class="w-full px-3.5 py-2.5 text-sm border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition @error('sort_order') border-red-300 @else border-slate-200 @enderror">
            <p class="mt-1.5 text-xs text-slate-400">Angka kecil tampil lebih dulu.</p>
            @error('sort_order')
                <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="flex items-end pb-1">
        <label class="flex items-center gap-2.5 cursor-pointer select-none">
            <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $service->is_active)) class="w-4 h-4 rounded text-primary border-slate-300 focus:ring-primary">
            <span class="text-sm font-medium text-slate-700">Tayangkan <span class="block text-xs font-normal text-slate-400">tampil di beranda</span></span>
        </label>
    </div>

    <div class="flex items-center gap-2.5 pt-1">
        <button type="submit" class="px-5 py-2.5 text-sm font-semibold text-white bg-primary hover:bg-primary-dark rounded-md transition-colors">Simpan</button>
        <a href="{{ route('admin.services.index') }}" class="px-5 py-2.5 text-sm font-medium text-slate-600 hover:text-slate-800 transition-colors">Batal</a>
    </div>
</div>
