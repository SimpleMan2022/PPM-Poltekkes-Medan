<footer class="bg-slate-800 text-white mt-16">
    <div class="h-8 sm:h-10 md:h-12 pattern-strip" aria-hidden="true"></div>
    <div class="h-1 brand-stripe" aria-hidden="true"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-10 md:py-12">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 sm:gap-8">
            <div class="sm:col-span-2 lg:col-span-1">
                <div class="flex items-center gap-2.5 mb-3">
                    <img src="{{ $siteSetting?->logoUrl() ?? asset('assets/images/logo_poltekkes.webp') }}" alt="Logo" class="h-10 w-auto object-contain brightness-0 invert">
                </div>
                <p class="text-xs text-slate-400 leading-relaxed">{{ $siteSetting?->address }}</p>
            </div>
            <div>
                <h4 class="text-xs font-semibold mb-2.5 text-secondary uppercase tracking-wider">Tautan Cepat</h4>
                <ul class="space-y-1.5">
                    <li><a href="{{ route('landing') }}#beranda" class="text-xs text-slate-400 hover:text-white transition-colors">Beranda</a></li>
                    <li><a href="{{ route('landing') }}#sambutan" class="text-xs text-slate-400 hover:text-white transition-colors">Profil</a></li>
                    <li><a href="{{ route('landing') }}#dokumen" class="text-xs text-slate-400 hover:text-white transition-colors">Dokumen &amp; SOP</a></li>
                    <li><a href="{{ route('landing') }}#galeri" class="text-xs text-slate-400 hover:text-white transition-colors">Galeri</a></li>
                    <li><a href="{{ route('landing') }}#kontak" class="text-xs text-slate-400 hover:text-white transition-colors">Kontak</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-xs font-semibold mb-2.5 text-secondary uppercase tracking-wider">Layanan</h4>
                <ul class="space-y-1.5">
                    @if(isset($services))
                    @foreach($services->take(5) as $service)
                    <li><span class="text-xs text-slate-400">{{ $service->name }}</span></li>
                    @endforeach
                    @endif
                </ul>
            </div>
        </div>
        <div class="border-t border-slate-700/50 mt-8 pt-4 text-center">
            <p class="text-[11px] text-slate-500">{!! $siteSetting?->copyright_text ?? '&copy; ' . date('Y') . ' PPM Poltekkes Kemenkes Medan' !!}</p>
        </div>
    </div>
</footer>