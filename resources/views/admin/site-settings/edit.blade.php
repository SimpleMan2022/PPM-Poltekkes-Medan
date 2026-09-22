@extends('layouts.admin')

@section('page-title', 'Identitas Situs')

@section('content')
<div class="mb-6">
    <nav class="mb-4 text-xs sm:text-sm text-slate-500">
        <a href="{{ route('admin.dashboard') }}" class="hover:text-primary transition-colors">Dashboard</a>
        <span class="mx-1.5">/</span>
        <span class="text-primary font-medium">Identitas Situs</span>
    </nav>
    <h1 class="font-display text-xl sm:text-2xl font-bold text-slate-800 leading-snug">Identitas Situs</h1>
    <p class="text-sm text-slate-500 mt-1">Data ini tampil di navbar, footer, dan halaman Kontak publik.</p>
</div>

<form method="POST" action="{{ route('admin.site-settings.update') }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="bg-white border border-slate-200 rounded-xl p-5 sm:p-6 space-y-5 max-w-2xl">
        <div>
            <label for="site_name" class="block text-sm font-semibold text-slate-800 mb-1.5">Nama situs <span class="text-red-500">*</span></label>
            <input id="site_name" type="text" name="site_name" value="{{ old('site_name', $setting->site_name) }}" required maxlength="255"
                placeholder="Contoh: PPM Poltekkes Kemenkes Medan"
                class="w-full px-3.5 py-2.5 text-sm border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition @error('site_name') border-red-300 @else border-slate-200 @enderror">
            @error('site_name')
                <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="logo" class="block text-sm font-semibold text-slate-800 mb-1.5">Logo</label>
            @if($setting->exists && $setting->logo)
                <img id="currentImage" src="{{ asset($setting->logo) }}" alt="Logo saat ini" class="h-16 w-auto object-contain rounded-lg bg-slate-100 border border-slate-200 px-3 py-2 mb-2.5">
            @endif
            <img id="imagePreview" src="#" alt="Pratinjau logo baru" class="hidden h-16 w-auto object-contain rounded-lg bg-slate-100 border border-slate-200 px-3 py-2 mb-2.5">
            <input id="logo" type="file" name="logo" accept="image/jpeg,image/png,image/webp,image/svg+xml"
                class="w-full text-sm text-slate-600 file:mr-3 file:px-3.5 file:py-2 file:text-xs file:font-semibold file:text-white file:bg-primary hover:file:bg-primary-dark file:rounded-md file:border-0 file:cursor-pointer border rounded-lg @error('logo') border-red-300 @else border-slate-200 @enderror">
            <p id="imageSizeError" class="hidden mt-1.5 text-xs text-red-600">Ukuran logo melebihi 2 MB. Kecilkan dulu logonya lalu pilih ulang.</p>
            <p class="mt-1.5 text-xs text-slate-400">JPG, PNG, WebP, atau SVG, maksimal 2 MB. Biarkan kosong bila logo tidak diganti.</p>
            @error('logo')
                <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="pt-5 border-t border-slate-200 space-y-5">
            <p class="text-xs font-semibold uppercase tracking-widest text-slate-400">Kontak</p>
            <div>
                <label for="address" class="block text-sm font-semibold text-slate-800 mb-1.5">Alamat</label>
                <textarea id="address" name="address" rows="2" placeholder="Contoh: Jl. Brigjend Katamso No. 103, Medan"
                    class="w-full px-3.5 py-2.5 text-sm border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition @error('address') border-red-300 @else border-slate-200 @enderror">{{ old('address', $setting->address) }}</textarea>
                @error('address')
                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div class="grid sm:grid-cols-2 gap-5">
                <div>
                    <label for="phone" class="block text-sm font-semibold text-slate-800 mb-1.5">Telepon</label>
                    <input id="phone" type="text" name="phone" value="{{ old('phone', $setting->phone) }}" maxlength="50"
                        placeholder="Contoh: (061) 8455651"
                        class="w-full px-3.5 py-2.5 text-sm border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition @error('phone') border-red-300 @else border-slate-200 @enderror">
                    @error('phone')
                        <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="whatsapp" class="block text-sm font-semibold text-slate-800 mb-1.5">WhatsApp</label>
                    <input id="whatsapp" type="text" name="whatsapp" value="{{ old('whatsapp', $setting->whatsapp) }}" maxlength="50"
                        placeholder="Contoh: 0812-6000-0000"
                        class="w-full px-3.5 py-2.5 text-sm border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition @error('whatsapp') border-red-300 @else border-slate-200 @enderror">
                    @error('whatsapp')
                        <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="grid sm:grid-cols-2 gap-5">
                <div>
                    <label for="email" class="block text-sm font-semibold text-slate-800 mb-1.5">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email', $setting->email) }}" maxlength="255"
                        placeholder="Contoh: info@ppm-poltekkes.ac.id"
                        class="w-full px-3.5 py-2.5 text-sm border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition @error('email') border-red-300 @else border-slate-200 @enderror">
                    @error('email')
                        <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="operating_hours" class="block text-sm font-semibold text-slate-800 mb-1.5">Jam operasional</label>
                    <input id="operating_hours" type="text" name="operating_hours" value="{{ old('operating_hours', $setting->operating_hours) }}"
                        placeholder="Contoh: Senin–Jumat, 08.00–16.00"
                        class="w-full px-3.5 py-2.5 text-sm border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition @error('operating_hours') border-red-300 @else border-slate-200 @enderror">
                    @error('operating_hours')
                        <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <div class="pt-5 border-t border-slate-200 space-y-5">
            <p class="text-xs font-semibold uppercase tracking-widest text-slate-400">Media sosial</p>
            <div>
                <label for="instagram_url" class="block text-sm font-semibold text-slate-800 mb-1.5">Instagram</label>
                <input id="instagram_url" type="url" name="instagram_url" value="{{ old('instagram_url', $setting->instagram_url) }}" maxlength="255"
                    placeholder="https://instagram.com/…"
                    class="w-full px-3.5 py-2.5 text-sm border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition @error('instagram_url') border-red-300 @else border-slate-200 @enderror">
                @error('instagram_url')
                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="facebook_url" class="block text-sm font-semibold text-slate-800 mb-1.5">Facebook</label>
                <input id="facebook_url" type="url" name="facebook_url" value="{{ old('facebook_url', $setting->facebook_url) }}" maxlength="255"
                    placeholder="https://facebook.com/…"
                    class="w-full px-3.5 py-2.5 text-sm border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition @error('facebook_url') border-red-300 @else border-slate-200 @enderror">
                @error('facebook_url')
                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="youtube_url" class="block text-sm font-semibold text-slate-800 mb-1.5">YouTube</label>
                <input id="youtube_url" type="url" name="youtube_url" value="{{ old('youtube_url', $setting->youtube_url) }}" maxlength="255"
                    placeholder="https://youtube.com/…"
                    class="w-full px-3.5 py-2.5 text-sm border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition @error('youtube_url') border-red-300 @else border-slate-200 @enderror">
                @error('youtube_url')
                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="pt-5 border-t border-slate-200 space-y-5">
            <p class="text-xs font-semibold uppercase tracking-widest text-slate-400">Peta &amp; footer</p>
            <div>
                <label for="google_maps_embed" class="block text-sm font-semibold text-slate-800 mb-1.5">Embed Google Maps</label>
                <textarea id="google_maps_embed" name="google_maps_embed" rows="3" placeholder='<iframe src="https://www.google.com/maps/embed?…" …></iframe>'
                    class="w-full px-3.5 py-2.5 text-sm font-mono border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition @error('google_maps_embed') border-red-300 @else border-slate-200 @enderror">{{ old('google_maps_embed', $setting->google_maps_embed) }}</textarea>
                <p class="mt-1.5 text-xs text-slate-400">Tempel kode semat iframe dari Google Maps → Bagikan → Sematkan peta.</p>
                @error('google_maps_embed')
                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="copyright_text" class="block text-sm font-semibold text-slate-800 mb-1.5">Teks copyright</label>
                <input id="copyright_text" type="text" name="copyright_text" value="{{ old('copyright_text', $setting->copyright_text) }}" maxlength="255"
                    placeholder="Contoh: © 2026 PPM Poltekkes Kemenkes Medan"
                    class="w-full px-3.5 py-2.5 text-sm border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition @error('copyright_text') border-red-300 @else border-slate-200 @enderror">
                @error('copyright_text')
                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>
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
