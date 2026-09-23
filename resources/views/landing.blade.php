@extends('layouts.app')

@section('title', $siteSetting->site_name ?? 'PPM Poltekkes Kemenkes')

@push('styles')
<style>
    @keyframes marquee {
        0% {
            transform: translateX(0);
        }

        100% {
            transform: translateX(-50%);
        }
    }

    .marquee-track {
        animation: marquee 30s linear infinite;
    }

    .marquee-track:hover {
        animation-play-state: paused;
    }
</style>
@endpush

@section('content')
<!-- HERO CAROUSEL -->
@include('components.hero-carousel', ['banners' => $banners])

<!-- SAMBUTAN KEPALA -->
@if($organizationProfile)
<section id="sambutan" class="py-10 sm:py-16 md:py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row gap-6 md:gap-10 items-start">
            <div class="shrink-0 mx-auto md:mx-0 flex flex-col items-center md:items-start">
                <div class="w-40 h-40 sm:w-48 sm:h-48 md:w-56 md:h-56 rounded-2xl overflow-hidden bg-slate-100"><img src="{{ asset($organizationProfile->leader_photo ?? 'assets/images/logo_poltekkes.webp') }}" alt="{{ $organizationProfile->leader_name }}" class="w-full h-full object-cover"></div>
                <div class="mt-4 text-center md:text-left">
                    <h3 class="text-base sm:text-lg font-bold text-slate-800 leading-tight">{{ $organizationProfile->leader_name }}</h3>
                    <p class="text-xs sm:text-sm text-primary font-medium">{{ $organizationProfile->leader_title }}</p>
                    <p class="text-[11px] sm:text-xs text-slate-500">{{ $organizationProfile->leader_position }}</p>
                </div>
            </div>
            <div class="flex-1 min-w-0">
                <span aria-hidden="true" class="block font-display text-6xl sm:text-7xl font-extrabold leading-[0.8] text-primary/30 select-none">&ldquo;</span>
                <h2 class="font-display text-2xl sm:text-3xl md:text-4xl font-bold text-primary mt-2 mb-3 sm:mb-4 leading-snug">Sambutan Resmi</h2>
                <div class="text-sm sm:text-[15px] text-slate-600 leading-relaxed space-y-3">
                    <div
                        class="line-clamp-4 md:line-clamp-none text-base [&>*]:text-base [&>*]:font-normal [&>*]:text-slate-800"
                        id="welcomeText">
                        {!! $organizationProfile->welcome_message !!}
                    </div>
                    <button id="readMoreBtn" class="text-primary font-medium text-sm hover:underline md:hidden">Baca selengkapnya &rarr;</button>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<!-- LAYANAN KAMI -->
<section id="layanan" class="py-10 sm:py-16 md:py-20 bg-primary/[0.04]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8 sm:mb-10">
            <span class="section-label text-tertiary-dark">Layanan Kami</span>
            <h2 class="text-xl sm:text-2xl md:text-3xl font-bold text-slate-800 mt-1 leading-snug">Penjaminan Mutu Internal &amp; Eksternal</h2>
            <p class="text-sm text-slate-500 mt-2 max-w-2xl leading-relaxed">Rangkaian layanan yang kami selenggarakan untuk memastikan standar mutu pendidikan dan pelayanan kesehatan terpenuhi secara berkelanjutan.</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-5">
            @foreach($services as $service)
            <div class="p-5 sm:p-6 bg-white border border-primary/10 rounded-lg hover:border-primary/25 hover:shadow-sm transition-all duration-200 group">
                <h3 class="flex items-center gap-2 text-[15px] sm:text-base font-semibold text-slate-800 mb-1.5 group-hover:text-primary transition-colors">
                    @if($service->icon)<x-service-icon :name="$service->icon" class="w-5 h-5 shrink-0 text-primary" />@endif
                    <span>{{ $service->name }}</span>
                </h3>
                @if($service->description)<p class="text-xs sm:text-sm text-slate-500 leading-relaxed line-clamp-2">{{ $service->description }}</p>@endif
            </div>
            @endforeach
        </div>
    </div>
</section>


<!-- DOKUMEN & SOP -->
<section id="dokumen" class="relative py-10 sm:py-16 md:py-20 overflow-hidden">
    <div
        aria-hidden="true"
        class="pointer-events-none absolute inset-y-0 right-0 w-full sm:w-2/3 opacity-50 [mask-image:linear-gradient(to_right,transparent,black_35%)]"
        style="--pattern-url: url('{{ asset('assets/images/pattern.svg') }}'); background-image: var(--pattern-url); background-size: 300px auto; background-repeat: repeat;"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8 sm:mb-10 flex items-end justify-between gap-4">
            <div>
                <span class="section-label text-primary">Dokumen &amp; SOP</span>
                <h2 class="text-xl sm:text-2xl md:text-3xl font-bold text-slate-800 mt-1 leading-snug">Akses Dokumen Resmi</h2>
            </div>
            <a href="{{ route('dokumen.index') }}" class="shrink-0 inline-flex items-center gap-1.5 px-4 py-1.5 text-xs sm:text-sm font-semibold text-white bg-primary hover:bg-primary-dark rounded-md transition-colors">
                Lihat semua
                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                </svg>
            </a>
        </div>
        <div class="flex gap-2 overflow-x-auto pb-2 mb-5 -mx-4 px-4 sm:mx-0 sm:px-0">
            @foreach($documentCategories as $i => $cat)<button class="doc-tab shrink-0 px-3 py-1.5 rounded-md text-xs sm:text-sm font-medium transition-colors {{ $i === 0 ? 'bg-primary text-white' : 'bg-white text-slate-600 hover:text-primary hover:bg-primary/5' }}" data-category="{{ $cat->slug }}">{{ $cat->name }}</button>@endforeach
        </div>
        @foreach($documentCategories as $cat)
        <div class="doc-panel {{ $loop->first ? '' : 'hidden' }}" data-category="{{ $cat->slug }}">
            @if($cat->documents->count() > 0)
            <div class="divide-y divide-slate-200 bg-white border border-slate-200/80 shadow-sm rounded-lg overflow-hidden">
                @foreach($cat->documents as $doc)
                <div class="flex items-center gap-3 px-4 sm:px-5 py-3 hover:bg-primary/5 transition-colors">
                    <svg class="shrink-0 w-4 h-4 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m.75 12h8.25m-8.25-3H12" />
                    </svg>
                    <div class="min-w-0 flex-1"><span class="text-sm text-slate-800 font-medium truncate block">{{ $doc->name }}</span></div>
                    <span class="shrink-0 text-[11px] text-slate-400 tabular-nums">{{ $doc->published_year }}</span>
                </div>
                @endforeach
            </div>
            @else
            <p class="text-sm text-slate-400 py-6 text-center">Belum ada dokumen untuk kategori ini.</p>
            @endif
        </div>
        @endforeach
    </div>
</section>
<!-- GALERI -->
<section id="galeri" class="py-10 sm:py-16 md:py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-end justify-between mb-6 sm:mb-8">
            <div>
                <span class="section-label text-tertiary-dark">Galeri</span>
                <h2 class="text-xl sm:text-2xl md:text-3xl font-bold text-slate-800 mt-1 leading-snug">Kegiatan &amp; Dokumentasi</h2>
            </div>
            <a href="{{ route('galeri.index') }}" class="shrink-0 inline-flex items-center gap-1.5 px-4 py-1.5 text-xs sm:text-sm font-semibold text-primary bg-primary/10 hover:bg-primary/20 rounded-md transition-colors">
                Lihat semua
                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                </svg>
            </a>
        </div>

        @if($galleries->count() > 0)
        <div class="grid grid-cols-2 md:grid-cols-4 gap-2 sm:gap-3">
            @foreach($galleries as $i => $gallery)
            @if($i === 0)
            {{-- Featured: first item spans 2 cols + 2 rows --}}
            <div class="col-span-2 row-span-2 group relative overflow-hidden rounded-lg cursor-pointer aspect-square">
                <img src="{{ asset($gallery->image) }}" alt="{{ $gallery->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-4 sm:p-5">
                    <div>
                        <h4 class="text-sm sm:text-base font-semibold text-white leading-snug">{{ $gallery->title }}</h4>
                        @if($gallery->event_date)<p class="text-[10px] sm:text-xs text-white/60 mt-0.5">{{ $gallery->event_date->format('d M Y') }}</p>@endif
                    </div>
                </div>
            </div>
            @else
            {{-- Small items --}}
            <div class="group relative overflow-hidden aspect-[4/3] cursor-pointer rounded-md">
                <img src="{{ asset($gallery->image) }}" alt="{{ $gallery->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-2.5 sm:p-3">
                    <h4 class="text-xs sm:text-sm font-semibold text-white line-clamp-2 leading-snug">{{ $gallery->title }}</h4>
                </div>
            </div>
            @endif
            @endforeach
        </div>
        @else
        <p class="text-sm text-slate-400 py-6 text-center">Belum ada dokumentasi galeri.</p>
        @endif
    </div>
</section>

<!-- LINK TERKAIT -->
<section id="link-terkait" class="py-10 sm:py-16 md:py-20 bg-slate-50/50 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-6 sm:mb-8">
        <span class="section-label text-primary">Link Terkait</span>
        <h2 class="text-xl sm:text-2xl md:text-3xl font-bold text-slate-800 mt-1 leading-snug">Mitra &amp; Rujukan</h2>
    </div>

    @if($relatedLinks->count() > 0)
    <div class="relative">
        {{-- Fade edges --}}
        <div class="absolute left-0 top-0 bottom-0 w-10 sm:w-20 bg-gradient-to-r from-slate-50/50 to-transparent z-10 pointer-events-none"></div>
        <div class="absolute right-0 top-0 bottom-0 w-10 sm:w-20 bg-gradient-to-l from-slate-50/50 to-transparent z-10 pointer-events-none"></div>

        <div class="marquee-viewport overflow-hidden">
            <div class="marquee-track flex w-max items-center" id="marqueeTrack">
                {{-- Base set: JS akan menduplikasinya sampai memenuhi lebar layar, lalu digandakan sekali lagi untuk loop mulus --}}
                <div class="marquee-set flex items-center shrink-0">
                    @foreach($relatedLinks as $link)
                    <a href="{{ $link->url }}" target="_blank" rel="noopener noreferrer" class="shrink-0 flex items-center gap-4 mr-10 sm:mr-14 py-3 group">
                        @if($link->logoUrl())
                        <img src="{{ $link->logoUrl() }}" alt="{{ $link->name }}" class="w-24 h-24 sm:w-28 sm:h-28 md:w-32 md:h-32 object-contain" loading="lazy">
                        @else
                        <div class="w-24 h-24 sm:w-28 sm:h-28 md:w-32 md:h-32 rounded-full bg-primary/10 flex items-center justify-center">
                            <svg class="w-10 h-10 sm:w-12 sm:h-12 text-primary/50" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 0 0 8.716-6.747M12 21a9.004 9.004 0 0 1-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 0 1 7.743 4.5M12 3a8.997 8.997 0 0 0-7.743 4.5" />
                            </svg>
                        </div>
                        @endif
                        <span class="text-base sm:text-lg md:text-xl font-semibold text-slate-600 group-hover:text-primary transition-colors whitespace-nowrap">{{ $link->name }}</span>
                        <span class="text-slate-300 group-hover:text-primary/30 transition-colors text-xl ml-6 sm:ml-8">|</span>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @endif
</section>

@push('styles')
<style>
    .marquee-viewport {
        width: 100%;
    }

    .marquee-track {
        animation: marquee-scroll linear infinite;
        will-change: transform;
    }

    .marquee-track:hover {
        animation-play-state: paused;
    }

    @keyframes marquee-scroll {
        from {
            transform: translateX(0);
        }

        to {

            transform: translateX(calc(-1 * var(--marquee-shift, 50%)));
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .marquee-track {
            animation: none;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    (function() {
        var track = document.getElementById('marqueeTrack');
        if (!track) return;

        var viewport = track.parentElement;
        var baseSet = track.querySelector('.marquee-set');
        if (!baseSet) return;

        var guard = 0;
        while (baseSet.scrollWidth < viewport.clientWidth && guard < 20) {
            track.appendChild(baseSet.cloneNode(true));
            // Gabungkan ulang semua set jadi satu "baseSet" acuan lebar
            var sets = track.querySelectorAll('.marquee-set');
            var totalWidth = 0;
            sets.forEach(function(s) {
                totalWidth += s.scrollWidth;
            });
            baseSet = {
                scrollWidth: totalWidth
            }; // objek sementara hanya untuk cek lebar
            guard++;
        }


        var originalWidth = track.scrollWidth;
        track.innerHTML += track.innerHTML;


        track.style.setProperty('--marquee-shift', originalWidth + 'px');

        var pxPerSecond = 60;
        var duration = originalWidth / pxPerSecond;
        track.style.animationDuration = duration + 's';
    })();
</script>
@endpush

<!-- KONTAK -->
<section id="kontak" class="py-10 sm:py-16 md:py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8 sm:mb-10">
            <span class="section-label text-primary">Kontak</span>
            <h2 class="text-xl sm:text-2xl md:text-3xl font-bold text-slate-800 mt-1 leading-snug">Hubungi Kami</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 sm:gap-8">
            <div class="space-y-4">
                @if($siteSetting)
                @if($siteSetting->address)
                <div class="flex items-start gap-3">
                    <svg class="shrink-0 w-4 h-4 text-primary mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.141-7.5 11.25-7.5 11.25S4.5 17.641 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                    </svg>
                    <div><span class="text-sm font-semibold text-slate-800">Alamat</span>
                        <p class="text-sm text-slate-500 mt-0.5 leading-relaxed">{{ $siteSetting->address }}</p>
                    </div>
                </div>@endif
                @if($siteSetting->phone)
                <div class="flex items-start gap-3">
                    <svg class="shrink-0 w-4 h-4 text-primary mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.75 15 6.75 15s6.75-6.716 6.75-15A6.75 6.75 0 0 1 9 0a6.75 6.75 0 0 1 6.75 6.75Z" />
                    </svg>
                    <div><span class="text-sm font-semibold text-slate-800">Telepon</span>
                        <p class="text-sm text-slate-500 mt-0.5">{{ $siteSetting->phone }}</p>
                    </div>
                </div>@endif
                @if($siteSetting->email)
                <div class="flex items-start gap-3">
                    <svg class="shrink-0 w-4 h-4 text-primary mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75a2.25 2.25 0 0 1 2.25-2.25h15a2.25 2.25 0 0 1 2.25 2.25Zm-8.25-3v3m0 0v3m0-3h3m-3 0h-3" />
                    </svg>
                    <div><span class="text-sm font-semibold text-slate-800">Email</span>
                        <p class="text-sm text-slate-500 mt-0.5">{{ $siteSetting->email }}</p>
                    </div>
                </div>@endif
                @if($siteSetting->operating_hours)
                <div class="flex items-start gap-3">
                    <svg class="shrink-0 w-4 h-4 text-primary mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <div><span class="text-sm font-semibold text-slate-800">Jam Operasional</span>
                        <p class="text-sm text-slate-500 mt-0.5">{{ $siteSetting->operating_hours }}</p>
                    </div>
                </div>@endif
                <div class="flex items-center gap-2 pt-2">
                    @if($siteSetting->instagram_url)<a href="{{ $siteSetting->instagram_url }}" target="_blank" class="w-8 h-8 sm:w-9 sm:h-9 bg-primary/10 hover:bg-primary text-primary hover:text-white rounded-md flex items-center justify-center transition-colors"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.777 1.691 4.925 4.925.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.684 4.777-4.925 4.925-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.925-4.925-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.925-4.925 1.266-.057 1.645-.069 4.849-.069ZM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.695.072 7.053.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0Zm0 5.838a6.162 6.162 0 1 0 0 12.324 6.162 6.162 0 0 0 0-12.324ZM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8Zm6.406-11.845a1.44 1.44 0 1 0 0 2.881 1.44 1.44 0 0 0 0-2.881Z" />
                        </svg></a>@endif
                    @if($siteSetting->facebook_url)<a href="{{ $siteSetting->facebook_url }}" target="_blank" class="w-8 h-8 sm:w-9 sm:h-9 bg-primary/10 hover:bg-primary text-primary hover:text-white rounded-md flex items-center justify-center transition-colors"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.413c0-3.014 1.831-4.669 4.532-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.923-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073Z" />
                        </svg></a>@endif
                    @if($siteSetting->youtube_url)<a href="{{ $siteSetting->youtube_url }}" target="_blank" class="w-8 h-8 sm:w-9 sm:h-9 bg-primary/10 hover:bg-primary text-primary hover:text-white rounded-md flex items-center justify-center transition-colors"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814ZM9.545 15.568V8.432L15.818 12l-6.273 3.568Z" />
                        </svg></a>@endif
                </div>
                @endif
            </div>
            <div class="rounded-lg overflow-hidden border border-slate-200 h-64 sm:h-72 md:h-auto">
                @if($siteSetting && $siteSetting->google_maps_embed){!! $siteSetting->google_maps_embed !!}
                @else<div class="w-full h-full bg-slate-100 flex items-center justify-center">
                    <p class="text-sm text-slate-400">Peta lokasi</p>
                </div>@endif
            </div>
        </div>
    </div>
</section>


@endsection

@push('scripts')
<script>
    document.querySelectorAll('.doc-tab').forEach(tab => {
        tab.addEventListener('click', () => {
            const cat = tab.dataset.category;
            document.querySelectorAll('.doc-tab').forEach(t => {
                t.classList.remove('bg-primary', 'text-white');
                t.classList.add('bg-white', 'text-slate-600');
            });
            tab.classList.remove('bg-white', 'text-slate-600');
            tab.classList.add('bg-primary', 'text-white');
            document.querySelectorAll('.doc-panel').forEach(p => p.classList.toggle('hidden', p.dataset.category !== cat));
        });
    });

    const rBtn = document.getElementById('readMoreBtn');
    const wTxt = document.getElementById('welcomeText');
    if (rBtn && wTxt) {
        let ex = false;
        rBtn.addEventListener('click', () => {
            ex = !ex;
            wTxt.classList.toggle('line-clamp-4', !ex);
            rBtn.textContent = ex ? 'Tutup' : 'Baca selengkapnya →';
        });
    }

    // Lightbox
    const orgImg = document.getElementById('orgStructureImg');
    const lightbox = document.getElementById('lightbox');
    const lightboxImg = document.getElementById('lightboxImg');
    if (orgImg && lightbox && lightboxImg) {
        orgImg.addEventListener('click', () => {
            const img = orgImg.querySelector('img');
            if (img) {
                lightboxImg.src = img.src;
                lightboxImg.alt = img.alt;
                lightbox.classList.remove('hidden');
                lightbox.classList.add('flex');
                document.body.style.overflow = 'hidden';
            }
        });
    }

    function closeLightbox() {
        if (lightbox) {
            lightbox.classList.add('hidden');
            lightbox.classList.remove('flex');
            document.body.style.overflow = '';
        }
    }
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') closeLightbox();
    });
</script>
@endpush