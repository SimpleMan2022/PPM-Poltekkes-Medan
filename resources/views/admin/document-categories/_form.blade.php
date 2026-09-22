{{-- Dipakai create & edit. Variabel $category selalu tersedia. --}}
<div class="bg-white border border-slate-200 rounded-xl p-5 sm:p-6 space-y-5 max-w-2xl">
    <div>
        <label for="name" class="block text-sm font-semibold text-slate-800 mb-1.5">Nama kategori <span class="text-red-500">*</span></label>
        <input id="name" type="text" name="name" value="{{ old('name', $category->name) }}" required maxlength="100"
            placeholder="Contoh: Standar Mutu"
            class="w-full px-3.5 py-2.5 text-sm border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition @error('name') border-red-300 @else border-slate-200 @enderror">
        <p class="mt-1.5 text-xs text-slate-400">Contoh: Kebijakan Mutu, Manual Mutu, Standar Mutu, SOP, Formulir.</p>
        @error('name')
            <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex items-center gap-2.5 pt-1">
        <button type="submit" class="px-5 py-2.5 text-sm font-semibold text-white bg-primary hover:bg-primary-dark rounded-md transition-colors">Simpan</button>
        <a href="{{ route('admin.document-categories.index') }}" class="px-5 py-2.5 text-sm font-medium text-slate-600 hover:text-slate-800 transition-colors">Batal</a>
    </div>
</div>
