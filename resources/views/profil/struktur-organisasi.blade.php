@extends('layouts.app')

@section('title', 'Struktur Organisasi - ' . ($siteSetting->site_name ?? 'PPM Poltekkes Kemenkes'))

@section('content')
<div class="py-8 sm:py-12 md:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb -->
        <nav class="mb-6 text-xs sm:text-sm text-slate-500">
            <a href="{{ route('landing') }}" class="hover:text-primary transition-colors">Beranda</a>
            <span class="mx-1.5">/</span>
            <span class="text-slate-800 font-medium">Profil</span>
            <span class="mx-1.5">/</span>
            <span class="text-primary font-medium">Struktur Organisasi</span>
        </nav>

        <div class="mb-8 sm:mb-10">
            <span class="section-label text-primary">Bagan &amp; Personalia</span>
            <h1 class="font-display text-2xl sm:text-3xl font-bold text-slate-800 mt-1 leading-snug">Struktur Organisasi PPM</h1>
            <p class="text-sm text-slate-500 mt-1.5 max-w-2xl">Susunan bagan hierarki struktural dan personil pengelola penjaminan mutu di lingkungan Poltekkes Kemenkes Medan.</p>
            <div class="h-1 w-24 brand-stripe-lime rounded-sm mt-4" aria-hidden="true"></div>
        </div>

        <!-- Visual Bagan Section -->
        <div class="mb-14">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-base sm:text-lg font-bold text-slate-800 flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-primary inline-block"></span>
                    Bagan Visual Organisasi
                </h2>
                <span class="text-xs text-slate-400">Klik untuk melihat detail</span>
            </div>

            @if($organizationProfile && $organizationProfile->organization_structure)
                <div class="relative group cursor-zoom-in rounded-xl border border-slate-200/80 bg-white p-3 sm:p-4 shadow-sm hover:shadow-md hover:border-primary/30 transition-all overflow-hidden" onclick="openLightbox('{{ asset($organizationProfile->organization_structure) }}', 'Bagan Struktur Organisasi')">
                    <img id="orgChart" src="{{ asset($organizationProfile->organization_structure) }}" alt="Struktur Organisasi PPM Poltekkes Kemenkes Medan" class="w-full max-h-[500px] object-contain mx-auto rounded-lg transition-transform duration-300 group-hover:scale-[1.01]">
                    <div class="absolute inset-0 bg-slate-900/0 group-hover:bg-slate-900/10 transition-colors flex items-center justify-center">
                        <span class="opacity-0 group-hover:opacity-100 transition-opacity duration-200 bg-slate-900/75 text-white text-xs font-medium px-3.5 py-2 rounded-lg flex items-center gap-1.5 shadow-lg backdrop-blur-xs">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607zM10.5 7.5v6m3-3h-6"/></svg>
                            Perbesar Bagan
                        </span>
                    </div>
                </div>
            @else
                <div class="text-center py-16 bg-white rounded-xl border border-slate-200 text-sm text-slate-400">Bagan struktur organisasi belum diunggah. Hubungi administrator untuk mengunggah bagan melalui panel admin.</div>
            @endif
        </div>

        <!-- Personalia Cards Grid Layout -->
        <div>
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-base sm:text-lg font-bold text-slate-800 flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-secondary inline-block"></span>
                        Personalia &amp; Susunan Pengelola
                    </h2>
                    <p class="text-xs sm:text-sm text-slate-500 mt-0.5">Daftar pejabat dan penanggung jawab mutu Pusat Penjaminan Mutu</p>
                </div>
                <span class="text-xs font-semibold px-2.5 py-1 bg-primary/10 text-primary-darker rounded-full">{{ $personnels->count() }} Anggota</span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-5">
                @forelse($personnels as $personnel)
                    <div class="bg-white rounded-xl border border-slate-200/80 p-5 shadow-sm hover:border-primary/30 hover:shadow-md transition-all flex items-start gap-4">
                        <div class="shrink-0 relative">
                            <div class="w-16 h-16 sm:w-18 sm:h-18 rounded-xl overflow-hidden bg-slate-100 border border-slate-100 shadow-inner {{ $personnel->photo ? 'cursor-zoom-in' : '' }}" @if($personnel->photo) onclick="openLightbox('{{ asset($personnel->photo) }}', '{{ $personnel->name }}')" @endif>
                                @if($personnel->photo)
                                    <img src="{{ asset($personnel->photo) }}" alt="{{ $personnel->name }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-slate-300">
                                        <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <span class="absolute -bottom-1 -right-1 w-5 h-5 rounded-full bg-primary text-white text-[10px] font-bold flex items-center justify-center ring-2 ring-white">
                                {{ $loop->iteration }}
                            </span>
                        </div>
                        <div class="min-w-0 flex-1">
                            <span class="inline-block text-[11px] font-semibold text-primary-darker mb-1 line-clamp-1 bg-primary/5 px-2 py-0.5 rounded">
                                {{ $personnel->position }}
                            </span>
                            <h3 class="text-sm sm:text-[15px] font-bold text-slate-800 leading-snug line-clamp-2">
                                {{ $personnel->name }}
                            </h3>
                            @if($personnel->nip)
                                <p class="text-xs text-slate-500 mt-2 font-mono tracking-tight">
                                    NIP. {{ $personnel->nip }}
                                </p>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12 bg-white rounded-xl border border-slate-200 text-sm text-slate-400">
                        Data personalia pengelola belum tersedia. Hubungi administrator untuk melengkapi data melalui panel admin.
                    </div>
                @endforelse
            </div>
        </div>

    </div>
</div>

<!-- Lightbox Modal -->
<div id="lightbox" class="fixed inset-0 z-[100] bg-slate-900/90 backdrop-blur-sm hidden items-center justify-center p-4" onclick="closeLightbox()">
    <button class="absolute top-4 right-4 text-white/70 hover:text-white transition-colors" onclick="closeLightbox()">
        <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
    </button>
    <img id="lightboxImg" src="" alt="" class="max-w-full max-h-full object-contain rounded-lg shadow-2xl">
</div>
@endsection

@push('scripts')
<script>
    function openLightbox(src, alt) {
        const lb = document.getElementById('lightbox');
        const img = document.getElementById('lightboxImg');
        img.src = src; img.alt = alt;
        lb.classList.remove('hidden'); lb.classList.add('flex');
        document.body.style.overflow = 'hidden';
    }
    function closeLightbox() {
        const lb = document.getElementById('lightbox');
        lb.classList.add('hidden'); lb.classList.remove('flex');
        document.body.style.overflow = '';
    }
    document.addEventListener('keydown', e => { if (e.key === 'Escape') closeLightbox(); });
</script>
@endpush
