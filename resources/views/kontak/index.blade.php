@extends('layouts.page')

@section('title', 'Kontak - ' . ($siteSetting->site_name ?? 'PPM Poltekkes Kemenkes'))

@section('content')
<div class="py-8 sm:py-12">
    <div class="max-w-3xl mx-auto px-4 sm:px-6">
        <!-- Breadcrumb -->
        <nav class="mb-6 text-xs sm:text-sm text-slate-500">
            <a href="{{ route('landing') }}" class="hover:text-primary transition-colors">Beranda</a>
            <span class="mx-1.5">/</span>
            <span class="text-primary font-medium">Kontak</span>
        </nav>

        <!-- Page header -->
        <header class="mb-8 sm:mb-10">
            <p class="section-label text-primary">Hubungi Kami</p>
            <h1 class="font-display text-2xl sm:text-3xl font-bold text-slate-800 mt-1 leading-snug">Kontak</h1>
            <p class="text-sm text-slate-500 mt-1.5">Ketuk salah satu kanal di bawah untuk langsung menghubungi Pusat Penjaminan Mutu.</p>
            <div class="h-1 w-24 brand-stripe-lime rounded-sm mt-4" aria-hidden="true"></div>
        </header>

        @php
            $wa = $siteSetting?->whatsapp;
            $waLink = $wa ? 'https://wa.me/' . preg_replace('/^0/', '62', preg_replace('/\D/', '', $wa)) : null;
            $hasSosmed = $siteSetting?->instagram_url || $siteSetting?->facebook_url || $siteSetting?->youtube_url;
            $hasChannel = $siteSetting && ($siteSetting->phone || $wa || $siteSetting->email);
            $hasPlace = $siteSetting && ($siteSetting->address || $siteSetting->operating_hours);
            $hasAnything = $hasChannel || $hasPlace || $hasSosmed || ($siteSetting?->google_maps_embed);
        @endphp

        @if(!$hasAnything)
            <div class="rounded-xl border border-amber-200 bg-amber-50 p-5 text-sm text-amber-800">
                Informasi kontak belum tersedia. Hubungi administrator untuk melengkapi data kontak melalui panel admin.
            </div>
        @else
            <!-- Saluran komunikasi: baris tappable -->
            @if($hasChannel)
                <div class="divide-y divide-slate-200 border-y border-slate-200 mb-10 sm:mb-12">
                    @if($siteSetting?->phone)
                        <a href="tel:{{ preg_replace('/\D/', '', $siteSetting->phone) }}" class="flex items-center gap-4 py-5 group">
                            <svg class="shrink-0 w-5 h-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.75 15 6.75 15s6.75-6.716 6.75-15A6.75 6.75 0 019 0a6.75 6.75 0 016.75 6.75z" />
                            </svg>
                            <span class="flex-1 min-w-0">
                                <span class="block text-[11px] font-semibold uppercase tracking-widest text-slate-400">Telepon</span>
                                <span class="block text-base sm:text-lg font-semibold text-slate-800 group-hover:text-primary transition-colors mt-0.5">{{ $siteSetting->phone }}</span>
                            </span>
                            <svg class="shrink-0 w-5 h-5 text-slate-300 group-hover:text-primary group-hover:translate-x-0.5 transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                            </svg>
                        </a>
                    @endif

                    @if($wa)
                        <a href="{{ $waLink }}" target="_blank" rel="noopener" class="flex items-center gap-4 py-5 group">
                            <svg class="shrink-0 w-5 h-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm3.75 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm3.75 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 01-2.555-.337A5.972 5.972 0 015.41 20.97a5.969 5.969 0 01-.474-.065 4.48 4.48 0 00.978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25z" />
                            </svg>
                            <span class="flex-1 min-w-0">
                                <span class="block text-[11px] font-semibold uppercase tracking-widest text-slate-400">WhatsApp</span>
                                <span class="block text-base sm:text-lg font-semibold text-slate-800 group-hover:text-primary transition-colors mt-0.5">{{ $wa }}</span>
                            </span>
                            <svg class="shrink-0 w-5 h-5 text-slate-300 group-hover:text-primary group-hover:translate-x-0.5 transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                            </svg>
                        </a>
                    @endif

                    @if($siteSetting?->email)
                        <a href="mailto:{{ $siteSetting->email }}" class="flex items-center gap-4 py-5 group">
                            <svg class="shrink-0 w-5 h-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                            </svg>
                            <span class="flex-1 min-w-0">
                                <span class="block text-[11px] font-semibold uppercase tracking-widest text-slate-400">Email</span>
                                <span class="block text-base sm:text-lg font-semibold text-slate-800 group-hover:text-primary transition-colors mt-0.5 break-all">{{ $siteSetting->email }}</span>
                            </span>
                            <svg class="shrink-0 w-5 h-5 text-slate-300 group-hover:text-primary group-hover:translate-x-0.5 transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                            </svg>
                        </a>
                    @endif
                </div>
            @endif

            <!-- Peta lokasi penuh -->
            <div class="relative overflow-hidden rounded-xl border border-slate-200 bg-slate-100 h-64 sm:h-80 mb-10 sm:mb-12 [&_iframe]:absolute [&_iframe]:inset-0 [&_iframe]:h-full [&_iframe]:w-full [&_iframe]:border-0">
                @if($siteSetting?->google_maps_embed)
                    {!! $siteSetting->google_maps_embed !!}
                @else
                    <div class="absolute inset-0 flex items-center justify-center px-6 text-center">
                        <p class="text-sm text-slate-400">Peta lokasi belum tersedia. Hubungi administrator untuk memasang peta melalui panel admin.</p>
                    </div>
                @endif
            </div>

            <!-- Alamat & jam operasional -->
            @if($hasPlace)
                <div class="grid gap-8 sm:grid-cols-2 mb-10 sm:mb-12">
                    @if($siteSetting?->address)
                        <div>
                            <p class="text-[11px] font-semibold uppercase tracking-widest text-slate-400 mb-1.5">Alamat Lengkap</p>
                            <p class="text-sm sm:text-[15px] text-slate-700 leading-relaxed">{{ $siteSetting->address }}</p>
                        </div>
                    @endif
                    @if($siteSetting?->operating_hours)
                        <div>
                            <p class="text-[11px] font-semibold uppercase tracking-widest text-slate-400 mb-1.5">Jam Operasional</p>
                            <p class="text-sm sm:text-[15px] text-slate-700 leading-relaxed">{{ $siteSetting->operating_hours }}</p>
                        </div>
                    @endif
                </div>
            @endif

            <!-- Media sosial -->
            @if($hasSosmed)
                <div>
                    <p class="text-[11px] font-semibold uppercase tracking-widest text-slate-400 mb-3">Ikuti Kami</p>
                    <div class="flex items-center gap-2">
                        @if($siteSetting->instagram_url)
                            <a href="{{ $siteSetting->instagram_url }}" target="_blank" rel="noopener" aria-label="Instagram PPM" class="h-10 px-4 gap-2 bg-primary/10 hover:bg-primary text-primary hover:text-white rounded-md flex items-center justify-center transition-colors">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.777 1.691 4.925 4.925.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.684 4.777-4.925 4.925-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.925-4.925-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.925-4.925 1.266-.057 1.645-.069 4.849-.069ZM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.695.072 7.053.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0Zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324ZM12 16a4 4 0 110-8 4 4 0 010 8Zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881Z" />
                                </svg>
                                <span class="text-xs font-semibold">Instagram</span>
                            </a>
                        @endif
                        @if($siteSetting->facebook_url)
                            <a href="{{ $siteSetting->facebook_url }}" target="_blank" rel="noopener" aria-label="Facebook PPM" class="h-10 px-4 gap-2 bg-primary/10 hover:bg-primary text-primary hover:text-white rounded-md flex items-center justify-center transition-colors">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.413c0-3.014 1.831-4.669 4.532-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.923-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073Z" />
                                </svg>
                                <span class="text-xs font-semibold">Facebook</span>
                            </a>
                        @endif
                        @if($siteSetting->youtube_url)
                            <a href="{{ $siteSetting->youtube_url }}" target="_blank" rel="noopener" aria-label="YouTube PPM" class="h-10 px-4 gap-2 bg-primary/10 hover:bg-primary text-primary hover:text-white rounded-md flex items-center justify-center transition-colors">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814ZM9.545 15.568V8.432L15.818 12l-6.273 3.568Z" />
                                </svg>
                                <span class="text-xs font-semibold">YouTube</span>
                            </a>
                        @endif
                    </div>
                </div>
            @endif
        @endif
    </div>
</div>
@endsection
