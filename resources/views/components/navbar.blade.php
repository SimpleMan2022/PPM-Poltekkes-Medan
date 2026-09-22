@php($onLanding = request()->routeIs('landing'))
<nav class="sticky top-0 z-50 bg-white border-b border-primary/10 shadow-sm">
    <div class="h-8 sm:h-10 pattern-strip" aria-hidden="true"></div>
    <div class="h-1 brand-stripe-lime" aria-hidden="true"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16 sm:h-20">
            <a href="{{ route('landing') }}" class="shrink-0 flex items-center">
                <img src="{{ $siteSetting?->logoUrl() ?? asset('assets/images/logo_poltekkes.webp') }}" alt="PPM Poltekkes" class="h-11 sm:h-14 md:h-16 w-auto max-h-full object-contain">
            </a>
            <div class="hidden md:flex items-center gap-0.5">
                <a href="{{ $onLanding ? '#beranda' : route('landing') }}" class="px-3 py-2 text-[13px] font-medium {{ request()->routeIs('landing') && !request()->has('section') ? 'text-primary' : 'text-slate-700 hover:text-primary' }} transition-colors">Beranda</a>
                <div class="relative group">
                    <button class="px-3 py-2 text-[13px] font-medium {{ request()->routeIs('profil.*') ? 'text-primary font-semibold' : 'text-slate-700 hover:text-primary' }} flex items-center gap-0.5 transition-colors">
                        Profil 
                        <svg class="w-3.5 h-3.5 transition-transform group-hover:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div class="absolute top-full left-0 pt-2 w-48 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                        <div class="bg-white rounded-lg shadow-lg border border-slate-100 py-1.5">
                            <a href="{{ route('profil.struktur-organisasi') }}" class="block px-4 py-2 text-[13px] {{ request()->routeIs('profil.struktur-organisasi') ? 'text-primary font-semibold bg-primary/5' : 'text-slate-700 hover:bg-primary/5 hover:text-primary' }} transition-colors">Struktur Organisasi</a>
                            <a href="{{ route('profil.tugas-fungsi') }}" class="block px-4 py-2 text-[13px] {{ request()->routeIs('profil.tugas-fungsi') ? 'text-primary font-semibold bg-primary/5' : 'text-slate-700 hover:bg-primary/5 hover:text-primary' }} transition-colors">Tugas &amp; Fungsi</a>
                        </div>
                    </div>
                </div>
                <a href="{{ route('dokumen.index') }}" class="px-3 py-2 text-[13px] font-medium {{ request()->routeIs('dokumen.*') ? 'text-primary font-semibold' : 'text-slate-700 hover:text-primary' }} transition-colors">Dokumen &amp; SOP</a>
                <a href="{{ route('galeri.index') }}" class="px-3 py-2 text-[13px] font-medium {{ request()->routeIs('galeri.*') ? 'text-primary font-semibold' : 'text-slate-700 hover:text-primary' }} transition-colors">Galeri</a>
                <a href="{{ route('kontak.index') }}" class="px-3 py-2 text-[13px] font-medium {{ request()->routeIs('kontak.*') ? 'text-primary font-semibold' : 'text-slate-700 hover:text-primary' }} transition-colors">Kontak</a>
            </div>
            <button id="mobileMenuBtn" class="md:hidden p-2 text-slate-600 hover:text-primary transition-colors -mr-1">
                <svg id="menuIconOpen" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/></svg>
                <svg id="menuIconClose" class="w-5 h-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
    </div>
    <div id="mobileMenu" class="hidden md:hidden border-t border-primary/10 bg-white">
        <div class="px-4 py-2.5 space-y-0.5">
            <a href="{{ $onLanding ? '#beranda' : route('landing') }}" class="mobile-link block px-3 py-2 text-sm text-slate-700 hover:text-primary hover:bg-primary/5 rounded-md">Beranda</a>
            <a href="{{ route('profil.struktur-organisasi') }}" class="mobile-link block px-3 py-2 text-sm {{ request()->routeIs('profil.struktur-organisasi') ? 'text-primary font-semibold bg-primary/5' : 'text-slate-700 hover:text-primary hover:bg-primary/5' }} rounded-md">Struktur Organisasi</a>
            <a href="{{ route('profil.tugas-fungsi') }}" class="mobile-link block px-3 py-2 text-sm {{ request()->routeIs('profil.tugas-fungsi') ? 'text-primary font-semibold bg-primary/5' : 'text-slate-700 hover:text-primary hover:bg-primary/5' }} rounded-md">Tugas &amp; Fungsi</a>
            <a href="{{ route('dokumen.index') }}" class="mobile-link block px-3 py-2 text-sm {{ request()->routeIs('dokumen.*') ? 'text-primary font-semibold bg-primary/5' : 'text-slate-700 hover:text-primary hover:bg-primary/5' }} rounded-md">Dokumen &amp; SOP</a>
            <a href="{{ route('galeri.index') }}" class="mobile-link block px-3 py-2 text-sm {{ request()->routeIs('galeri.*') ? 'text-primary font-semibold bg-primary/5' : 'text-slate-700 hover:text-primary hover:bg-primary/5' }} rounded-md">Galeri</a>
            <a href="{{ route('kontak.index') }}" class="mobile-link block px-3 py-2 text-sm {{ request()->routeIs('kontak.*') ? 'text-primary font-semibold bg-primary/5' : 'text-slate-700 hover:text-primary hover:bg-primary/5' }} rounded-md">Kontak</a>
        </div>
    </div>
</nav>
