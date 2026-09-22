<div class="bg-white border border-slate-200 rounded-xl p-5 sm:p-6 space-y-5 max-w-2xl">
    <div>
        <label for="title" class="block text-sm font-semibold text-slate-800 mb-1.5">Judul <span class="text-red-500">*</span></label>
        <input id="title" type="text" name="title" value="{{ old('title', $banner->title) }}" required maxlength="255"
            placeholder="Contoh: Penerimaan Mahasiswa Baru 2026"
            class="w-full px-3.5 py-2.5 text-sm border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition @error('title') border-red-300 @else border-slate-200 @enderror">
        @error('title')
        <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="subtitle" class="block text-sm font-semibold text-slate-800 mb-1.5">Subjudul</label>
        <textarea id="subtitle" name="subtitle" rows="2" placeholder="Satu-dua kalimat ringkas di bawah judul (boleh kosong)"
            class="w-full px-3.5 py-2.5 text-sm border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition @error('subtitle') border-red-300 @else border-slate-200 @enderror">{{ old('subtitle', $banner->subtitle) }}</textarea>
        @error('subtitle')
        <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="image" class="block text-sm font-semibold text-slate-800 mb-1.5">Gambar {{ $banner->exists ? '' : '*' }}</label>
        @if($banner->exists && $banner->image)
        <img id="currentImage" src="{{ asset($banner->image) }}" alt="{{ $banner->title }}" class="w-full max-w-sm aspect-[16/9] sm:aspect-[21/9] md:aspect-[3/1] object-cover rounded-lg bg-slate-100 mb-2.5">
        @endif
        <img id="imagePreview" src="#" alt="Pratinjau gambar baru" class="hidden w-full max-w-sm aspect-[16/9] sm:aspect-[21/9] md:aspect-[3/1] object-cover rounded-lg bg-slate-100 mb-2.5">
        <input id="image" type="file" name="image" accept="image/jpeg,image/png,image/webp" {{ $banner->exists ? '' : 'required' }}
            class="w-full text-sm text-slate-600 file:mr-3 file:px-3.5 file:py-2 file:text-xs file:font-semibold file:text-white file:bg-primary hover:file:bg-primary-dark file:rounded-md file:border-0 file:cursor-pointer border rounded-lg @error('image') border-red-300 @else border-slate-200 @enderror">
        <div id="cropWrap" class="hidden mt-2.5">
            <p class="text-xs font-medium text-slate-600 mb-1.5">Geser atau ubah ukuran kotak untuk memilih bagian gambar (rasio 16:9).</p>
            <div class="grid sm:grid-cols-[1fr_160px] gap-3 items-start">
                <div class="rounded-lg overflow-hidden bg-slate-900 max-h-[360px]">
                    <img id="cropImage" alt="Area potong gambar" class="block max-w-full">
                </div>
                <div class="hidden sm:block">
                    <p class="text-[11px] text-slate-400 mb-1">Hasil:</p>
                    <div id="cropPreviewBox" class="w-40 aspect-[16/9] sm:aspect-[21/9] md:aspect-[3/1] overflow-hidden rounded-md bg-slate-100 border border-slate-200"></div>
                </div>
            </div>
        </div>
        <p id="imageSizeError" class="hidden mt-1.5 text-xs text-red-600">Ukuran gambar melebihi 2 MB. Kecilkan dulu gambarnya lalu pilih ulang.</p>
        <p id="imageSmallWarn" class="hidden mt-1.5 text-xs text-amber-700">Foto ini kecil (di bawah 1600px) — di slider besar bisa tampak buram. Gunakan foto beresolusi lebih besar bila ada.</p>
        <p class="mt-1.5 text-xs text-slate-400">JPG, PNG, atau WebP, maksimal 2 MB, disarankan minimal 1600px. Gambar otomatis dikonversi ke WebP. {{ $banner->exists ? 'Biarkan kosong bila gambar tidak diganti.' : '' }}</p>
        @error('image')
        <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="grid sm:grid-cols-2 gap-5">
        <div>
            <label for="cta_text" class="block text-sm font-semibold text-slate-800 mb-1.5">Teks Tombol</label>
            <input id="cta_text" type="text" name="cta_text" value="{{ old('cta_text', $banner->cta_text) }}" maxlength="100"
                placeholder="Contoh: Daftar Sekarang"
                class="w-full px-3.5 py-2.5 text-sm border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition @error('cta_text') border-red-300 @else border-slate-200 @enderror">
            @error('cta_text')
            <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="cta_url" class="block text-sm font-semibold text-slate-800 mb-1.5">Link Tombol</label>
            <input id="cta_url" type="url" name="cta_url" value="{{ old('cta_url', $banner->cta_url) }}" maxlength="255"
                placeholder="https://…"
                class="w-full px-3.5 py-2.5 text-sm border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition @error('cta_url') border-red-300 @else border-slate-200 @enderror">
            @error('cta_url')
            <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>
    <p class="text-xs text-slate-400 -mt-2">Tombol hanya tampil bila teks dan link keduanya diisi.</p>

    <div class="grid sm:grid-cols-2 gap-5">
        <div>
            <label for="sort_order" class="block text-sm font-semibold text-slate-800 mb-1.5">Urutan <span class="text-red-500">*</span></label>
            <input id="sort_order" type="number" name="sort_order" value="{{ old('sort_order', $banner->sort_order) }}" required min="0" step="1"
                class="w-full px-3.5 py-2.5 text-sm border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition @error('sort_order') border-red-300 @else border-slate-200 @enderror">
            <p class="mt-1.5 text-xs text-slate-400">Angka kecil tampil lebih dulu.</p>
            @error('sort_order')
            <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>
        <div class="flex items-end pb-1">
            <label class="flex items-center gap-2.5 cursor-pointer select-none">
                <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $banner->is_active)) class="w-4 h-4 rounded text-primary border-slate-300 focus:ring-primary">
                <span class="text-sm font-medium text-slate-700">Aktif <span class="block text-xs font-normal text-slate-400">tampil di slider beranda</span></span>
            </label>
        </div>
    </div>

    <div class="flex items-center gap-2.5 pt-1">
        <button type="submit" class="px-5 py-2.5 text-sm font-semibold text-white bg-primary hover:bg-primary-dark rounded-md transition-colors">Simpan</button>
        <a href="{{ route('admin.banners.index') }}" class="px-5 py-2.5 text-sm font-medium text-slate-600 hover:text-slate-800 transition-colors">Batal</a>
    </div>
</div>

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/cropperjs@1.6.2/dist/cropper.min.css">
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/cropperjs@1.6.2/dist/cropper.min.js"></script>
<script>
    (function() {
        var input = document.getElementById('image');
        var preview = document.getElementById('imagePreview');
        var current = document.getElementById('currentImage');
        var sizeError = document.getElementById('imageSizeError');
        var maxBytes = 2 * 1024 * 1024;
        var maxDim = 1920;
        var quality = 0.92;
        var cropRatio = 16 / 9;
        var objectUrl = null;
        var cropUrl = null;
        var changeId = 0;
        var cropper = null;
        var submitting = false;
        var cropWrap = document.getElementById('cropWrap');
        var cropImage = document.getElementById('cropImage');
        if (!input || !preview) return;

        function resetPreview() {
            if (objectUrl) {
                URL.revokeObjectURL(objectUrl);
                objectUrl = null;
            }
            preview.classList.add('hidden');
            preview.removeAttribute('src');
            if (current) current.classList.remove('hidden');
        }

        function showPreview(file) {
            if (objectUrl) {
                URL.revokeObjectURL(objectUrl);
            }
            objectUrl = URL.createObjectURL(file);
            preview.src = objectUrl;
            preview.classList.remove('hidden');
            if (current) current.classList.add('hidden');
        }

        function rejectTooBig() {
            if (sizeError) sizeError.classList.remove('hidden');
            input.value = '';
            destroyCropper();
            resetPreview();
        }
        function destroyCropper() {
            if (cropper) {
                try { cropper.destroy(); } catch (e) {}
                cropper = null;
            }
            if (cropUrl) {
                URL.revokeObjectURL(cropUrl);
                cropUrl = null;
            }
            if (cropWrap) cropWrap.classList.add('hidden');
        }
        function updateResultPreview() {
            if (!cropper) return;
            try {
                var c = cropper.getCroppedCanvas({ width: 480 });
                if (c) {
                    preview.src = c.toDataURL('image/jpeg', 0.85);
                    preview.classList.remove('hidden');
                    if (current) current.classList.add('hidden');
                }
            } catch (e) {}
        }
        // Alur lama (tanpa crop): konversi + cek ukuran + tampilkan pratinjau.
        // Dipakai sebagai fallback bila lib crop tidak tersedia.
        function fallbackPreview(file) {
            var myChange = ++changeId;
            convertToWebp(file).then(function(result) {
                if (myChange !== changeId) return;
                try {
                    var dt = new DataTransfer();
                    dt.items.add(result.file);
                    input.files = dt.files;
                } catch (e) {
                    /* browser lama: pakai berkas original */ }
                if (result.file.size > maxBytes) {
                    rejectTooBig();
                    return;
                }
                showPreview(result.file);
            });
        }
        // Kompres + konversi ke WebP di browser agar foto besar lolos batas 2 MB.
        // Gagal/tidak didukung? Berkas original dipakai apa adanya (server yang menangani).
        function convertToWebp(file) {
            return new Promise(function(resolve) {
                var url, img;
                try {
                    url = URL.createObjectURL(file);
                    img = new Image();
                } catch (e) {
                    resolve({
                        file: file,
                        converted: false
                    });
                    return;
                }
                img.onload = function() {
                    showSmallWarn(img.naturalWidth > 0 && img.naturalWidth < 1600);
                    try {
                        var scale = Math.min(1, maxDim / Math.max(img.naturalWidth, img.naturalHeight));
                        var cw = Math.max(1, Math.round(img.naturalWidth * scale));
                        var ch = Math.max(1, Math.round(img.naturalHeight * scale));
                        var canvas = document.createElement('canvas');
                        canvas.width = cw;
                        canvas.height = ch;
                        canvas.getContext('2d').drawImage(img, 0, 0, cw, ch);
                        URL.revokeObjectURL(url);
                        if ((canvas.toDataURL('image/webp') || '').indexOf('data:image/webp') !== 0) {
                            resolve({
                                file: file,
                                converted: false
                            });
                            return;
                        }
                        canvas.toBlob(function(blob) {
                            if (!blob) {
                                resolve({
                                    file: file,
                                    converted: false
                                });
                                return;
                            }
                            var name = (file.name || 'gambar').replace(/\.[^.]+$/, '') + '.webp';
                            resolve({
                                file: new File([blob], name, {
                                    type: 'image/webp'
                                }),
                                converted: true
                            });
                        }, 'image/webp', quality);
                    } catch (e) {
                        URL.revokeObjectURL(url);
                        resolve({
                            file: file,
                            converted: false
                        });
                    }
                };
                img.onerror = function() {
                    URL.revokeObjectURL(url);
                    resolve({
                        file: file,
                        converted: false
                    });
                };
                img.src = url;
            });
        }
        function showSmallWarn(show) {
            var el = document.getElementById('imageSmallWarn');
            if (el) el.classList.toggle('hidden', !show);
        }
        function canvasSupportsWebp() {
            try {
                var c = document.createElement('canvas');
                return (c.toDataURL('image/webp') || '').indexOf('data:image/webp') === 0;
            } catch (e) {
                return false;
            }
        }
        function stageAndSubmit(file) {
            try {
                var dt = new DataTransfer();
                dt.items.add(file);
                input.files = dt.files;
            } catch (err) {}
            if (file.size > maxBytes) {
                submitting = false;
                rejectTooBig();
                return;
            }
            showPreview(file);
            submitting = true;
            form.submit();
        }
        input.addEventListener('change', function() {
            var file = input.files && input.files[0];
            if (sizeError) sizeError.classList.add('hidden');
            showSmallWarn(false);
            destroyCropper();
            if (!file || file.type.indexOf('image/') !== 0) {
                resetPreview();
                return;
            }
            // Tanpa lib crop: langsung ke alur lama.
            if (typeof Cropper === 'undefined' || !cropImage || !cropWrap) {
                fallbackPreview(file);
                return;
            }
            var myChange = ++changeId;
            if (cropUrl) URL.revokeObjectURL(cropUrl);
            cropUrl = URL.createObjectURL(file);
            cropImage.src = cropUrl;
            cropWrap.classList.remove('hidden');
            preview.classList.add('hidden');
            preview.removeAttribute('src');
            if (current) current.classList.add('hidden');
            cropImage.onload = function() {
                if (myChange !== changeId) return;
                showSmallWarn(cropImage.naturalWidth > 0 && cropImage.naturalWidth < 1600);
                try {
                    cropper = new Cropper(cropImage, {
                        aspectRatio: cropRatio,
                        viewMode: 1,
                        dragMode: 'crop',
                        autoCropArea: 0.85,
                        responsive: true,
                        background: true,
                        guides: true,
                        center: true,
                        preview: '#cropPreviewBox',
                        ready: function() { updateResultPreview(); },
                        cropend: function() {
                            updateResultPreview();
                            try {
                                var d = cropper.getData(true);
                                showSmallWarn(!(d && d.width >= 1600));
                            } catch (err) {}
                        }
                    });
                } catch (e) {
                    cropper = null;
                    fallbackPreview(file);
                }
            };
            cropImage.onerror = function() {
                fallbackPreview(file);
            };
        });
        var form = input.closest('form');
        if (form) form.addEventListener('submit', function(e) {
            if (submitting) {
                e.preventDefault();
                return;
            }
            // Tidak ada crop aktif (edit tanpa gambar baru / fallback): submit normal.
            if (!cropper) return;
            var file = input.files && input.files[0];
            if (!file) return;
            if (typeof form.reportValidity === 'function' && !form.reportValidity()) return;
            e.preventDefault();
            var base = (file.name || 'gambar').replace(/\.[^.]+$/, '');
            var canvas = null;
            try {
                var data = cropper.getData(true);
                var w = data ? Math.min(1920, Math.round(data.width || 0)) : 0;
                if (w > 0) {
                    canvas = cropper.getCroppedCanvas({ width: w });
                }
            } catch (err) { canvas = null; }
            // Crop gagal: kirim berkas original, server yang menangani.
            if (!canvas) {
                submitting = true;
                form.submit();
                return;
            }
            if (canvasSupportsWebp()) {
                // Jalur utama: SATU KALI encode langsung ke WebP (tanpa perantara JPEG)
                // agar ketajaman maksimal.
                var outW = Math.min(1920, canvas.width);
                var target = canvas;
                if (outW < canvas.width) {
                    target = document.createElement('canvas');
                    target.width = outW;
                    target.height = Math.max(1, Math.round(canvas.height * (outW / canvas.width)));
                    target.getContext('2d').drawImage(canvas, 0, 0, target.width, target.height);
                }
                target.toBlob(function(blob) {
                    if (!blob) {
                        submitting = true;
                        form.submit();
                        return;
                    }
                    stageAndSubmit(new File([blob], base + '-crop.webp', { type: 'image/webp' }));
                }, 'image/webp', quality);
            } else {
                // Browser lama tanpa WebP: alur lama via JPEG.
                canvas.toBlob(function(blob) {
                    if (!blob) {
                        submitting = true;
                        form.submit();
                        return;
                    }
                    var cropped = new File([blob], base + '-crop.jpg', { type: 'image/jpeg' });
                    convertToWebp(cropped).then(function(result) {
                        stageAndSubmit(result.file);
                    });
                }, 'image/jpeg', 0.92);
            }
        });
    })();
</script>
@endpush