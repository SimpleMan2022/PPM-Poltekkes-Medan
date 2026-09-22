@extends('layouts.app')

@section('title', 'Galeri - ' . ($siteSetting->site_name ?? 'PPM Poltekkes Kemenkes'))

@section('content')
<div class="py-8 sm:py-12">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb -->
        <nav class="mb-6 text-xs sm:text-sm text-slate-500">
            <a href="{{ route('landing') }}" class="hover:text-primary transition-colors">Beranda</a>
            <span class="mx-1.5">/</span>
            <span class="text-primary font-medium">Galeri</span>
        </nav>

        <!-- Page header -->
        <header class="mb-8 sm:mb-10">
            <p class="section-label text-primary">Dokumentasi</p>
            <h1 class="font-display text-2xl sm:text-3xl font-bold text-slate-800 mt-1 leading-snug">Galeri Kegiatan</h1>
            <p class="text-sm text-slate-500 mt-1.5 max-w-2xl">Dokumentasi foto kegiatan Pusat Penjaminan Mutu — RTM, audit mutu internal, workshop, dan pendampingan akreditasi. Klik foto untuk melihat lebih besar.</p>
            <div class="h-1 w-24 brand-stripe-lime rounded-sm mt-4" aria-hidden="true"></div>
        </header>

        @if($galleries->isEmpty())
            <div class="rounded-xl border border-amber-200 bg-amber-50 p-5 text-sm text-amber-800">
                Belum ada foto kegiatan yang dipublikasikan. Hubungi administrator untuk mengunggah dokumentasi melalui panel admin.
            </div>
        @else
            <!-- Photo grid -->
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-4">
                @foreach($galleries as $gallery)
                    <figure class="group bg-white border border-slate-200 rounded-xl overflow-hidden cursor-zoom-in hover:border-primary/40 hover:shadow-md transition-all"
                        data-title="{{ $gallery->title }}"
                        data-date="{{ $gallery->event_date?->format('d M Y') ?? '' }}"
                        data-description="{{ $gallery->description ?? '' }}"
                        data-src="{{ asset($gallery->image) }}">
                        <div class="aspect-[4/3] overflow-hidden bg-slate-100">
                            <img src="{{ asset($gallery->image) }}" alt="{{ $gallery->title }}" loading="lazy"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        </div>
                        <figcaption class="p-3 sm:p-3.5">
                            <h3 class="text-xs sm:text-sm font-semibold text-slate-800 leading-snug line-clamp-2">{{ $gallery->title }}</h3>
                            @if($gallery->event_date)
                                <p class="mt-1.5 flex items-center gap-1.5 text-[11px] sm:text-xs text-slate-500 tabular-nums">
                                    <svg class="w-3.5 h-3.5 text-primary-dark shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                                    </svg>
                                    {{ $gallery->event_date->format('d M Y') }}
                                </p>
                            @endif
                        </figcaption>
                    </figure>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($galleries->lastPage() > 1)
                <div class="mt-8 flex items-center justify-between gap-3">
                    <p class="text-xs text-slate-500 tabular-nums">Halaman {{ $galleries->currentPage() }} dari {{ $galleries->lastPage() }} &bull; {{ $galleries->total() }} foto</p>
                    <div class="flex items-center gap-1.5">
                        @if($galleries->onFirstPage())
                            <span class="inline-flex items-center justify-center w-8 h-8 text-sm border border-slate-200 rounded-md bg-slate-50 text-slate-300 cursor-not-allowed">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" /></svg>
                            </span>
                        @else
                            <a href="{{ $galleries->previousPageUrl() }}" aria-label="Halaman sebelumnya" class="inline-flex items-center justify-center w-8 h-8 text-sm border border-slate-200 rounded-md bg-white text-slate-600 hover:text-primary hover:border-primary/40 transition-colors">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" /></svg>
                            </a>
                        @endif
                        <div class="hidden sm:flex items-center gap-1.5">
                            @foreach($galleries->getUrlRange(1, $galleries->lastPage()) as $page => $url)
                                @if($page == $galleries->currentPage())
                                    <span class="w-8 h-8 inline-flex items-center justify-center text-xs rounded-md border bg-primary border-primary text-white font-semibold tabular-nums">{{ $page }}</span>
                                @else
                                    <a href="{{ $url }}" aria-label="Ke halaman {{ $page }}" class="w-8 h-8 inline-flex items-center justify-center text-xs rounded-md border bg-white border-slate-200 text-slate-600 hover:text-primary hover:border-primary/40 tabular-nums transition-colors">{{ $page }}</a>
                                @endif
                            @endforeach
                        </div>
                        @if($galleries->hasMorePages())
                            <a href="{{ $galleries->nextPageUrl() }}" aria-label="Halaman berikutnya" class="inline-flex items-center justify-center w-8 h-8 text-sm border border-slate-200 rounded-md bg-white text-slate-600 hover:text-primary hover:border-primary/40 transition-colors">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" /></svg>
                            </a>
                        @else
                            <span class="inline-flex items-center justify-center w-8 h-8 text-sm border border-slate-200 rounded-md bg-slate-50 text-slate-300 cursor-not-allowed">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" /></svg>
                            </span>
                        @endif
                    </div>
                </div>
            @endif
        @endif
    </div>
</div>

<!-- Lightbox -->
<div id="galleryLightbox" class="fixed inset-0 z-[100] bg-slate-900/90 backdrop-blur-sm hidden items-center justify-center p-4">
    <button id="galleryLightboxClose" type="button" aria-label="Tutup pratinjau" class="absolute top-4 right-4 text-white/70 hover:text-white transition-colors">
        <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
    </button>
    <figure class="max-w-3xl w-full">
        <img id="galleryLightboxImg" src="" alt="" class="w-full max-h-[75vh] object-contain rounded-lg shadow-2xl bg-slate-900">
        <figcaption class="mt-3 text-center">
            <p id="galleryLightboxTitle" class="text-sm sm:text-base font-semibold text-white"></p>
            <p id="galleryLightboxMeta" class="text-xs text-white/60 mt-1 tabular-nums"></p>
            <p id="galleryLightboxDesc" class="text-xs sm:text-sm text-white/70 mt-1.5 leading-relaxed"></p>
        </figcaption>
    </figure>
</div>
@endsection

@push('scripts')
<script>
(function () {
    var lightbox = document.getElementById('galleryLightbox');
    var lightboxImg = document.getElementById('galleryLightboxImg');
    var lightboxTitle = document.getElementById('galleryLightboxTitle');
    var lightboxMeta = document.getElementById('galleryLightboxMeta');
    var lightboxDesc = document.getElementById('galleryLightboxDesc');

    function openLightbox(fig) {
        lightboxImg.src = fig.dataset.src;
        lightboxImg.alt = fig.dataset.title;
        lightboxTitle.textContent = fig.dataset.title || '';
        lightboxMeta.textContent = fig.dataset.date || '';
        lightboxDesc.textContent = fig.dataset.description || '';
        lightbox.classList.remove('hidden');
        lightbox.classList.add('flex');
        document.body.style.overflow = 'hidden';
    }

    function closeLightbox() {
        lightbox.classList.add('hidden');
        lightbox.classList.remove('flex');
        document.body.style.overflow = '';
        lightboxImg.src = '';
    }

    document.querySelectorAll('figure[data-src]').forEach(function (fig) {
        fig.addEventListener('click', function () { openLightbox(fig); });
    });

    document.getElementById('galleryLightboxClose').addEventListener('click', closeLightbox);
    lightbox.addEventListener('click', function (e) {
        if (e.target === lightbox) closeLightbox();
    });
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && !lightbox.classList.contains('hidden')) closeLightbox();
    });
})();
</script>
@endpush
