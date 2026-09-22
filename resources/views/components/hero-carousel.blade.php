{{-- PENTING: rasio & skala teks disamakan dengan pratinjau di admin/banners/_preview. Ubah berbarengan. --}}
<section id="beranda" class="relative overflow-hidden bg-slate-900">
        @if($banners->count() > 0)
        <div id="carousel" class="relative">
            <div id="carouselTrack" class="carousel-track flex">
                @foreach($banners as $banner)
                <div class="w-full shrink-0 relative">
                    <div class="aspect-[16/9] sm:aspect-[21/9] md:aspect-[3/1]">
                        <img src="{{ asset($banner->image) }}" alt="{{ $banner->title }}" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-r from-slate-900/80 via-slate-900/40 to-transparent"></div>
                        @if(($showStatus ?? false) && !$banner->is_active)
                        <span class="absolute top-3 right-3 sm:top-4 sm:right-4 px-2.5 py-1 text-[11px] font-semibold rounded-md bg-slate-900/70 text-white/80">Nonaktif</span>
                        @endif
                    </div>
                    <div class="absolute inset-0 flex items-center">
                        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
                            <h2 class="text-xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-1.5 sm:mb-2 leading-tight">{{ $banner->title }}</h2>
                            @if($banner->subtitle)<p class="text-sm sm:text-base md:text-lg text-white/70 mb-3 sm:mb-5 max-w-xl leading-relaxed">{{ $banner->subtitle }}</p>@endif
                            @if($banner->cta_text)<a href="{{ $banner->cta_url ?? '#' }}" class="inline-block px-4 sm:px-5 py-2 sm:py-2.5 bg-secondary hover:bg-secondary-dark text-slate-900 font-semibold rounded-md text-xs sm:text-sm transition-colors">{{ $banner->cta_text }} &rarr;</a>@endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @if($banners->count() > 1)
            <button id="prevBtn" class="absolute left-2 sm:left-4 top-1/2 -translate-y-1/2 w-8 h-8 sm:w-10 sm:h-10 bg-white/10 hover:bg-white/25 rounded-full flex items-center justify-center text-white transition-colors"><svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg></button>
            <button id="nextBtn" class="absolute right-2 sm:right-4 top-1/2 -translate-y-1/2 w-8 h-8 sm:w-10 sm:h-10 bg-white/10 hover:bg-white/25 rounded-full flex items-center justify-center text-white transition-colors"><svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                </svg></button>
            <div id="carouselDots" class="absolute bottom-3 sm:bottom-5 left-1/2 -translate-x-1/2 flex gap-1.5">@foreach($banners as $i => $banner)<button class="carousel-dot w-6 h-1 rounded-full {{ $i === 0 ? 'bg-secondary' : 'bg-white/30' }} transition-colors" data-index="{{ $i }}"></button>@endforeach</div>
            @endif
        </div>
        @else
        <div class="aspect-[16/9] sm:aspect-[21/9] md:aspect-[3/1] brand-stripe flex items-center">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-xl sm:text-3xl md:text-4xl font-bold text-white mb-1.5">PPM Poltekkes</h2>
                <p class="text-sm sm:text-base text-white/70">Pusat Penjaminan Mutu &mdash; Poltekkes Kemenkes Medan</p>
            </div>
        </div>
        @endif
    </section>

@push('scripts')
<script>
const track = document.getElementById('carouselTrack');
        if (track) {
            const slides = track.children;
            const total = slides.length;
            let cur = 0;
            let auto;

            function go(i) {
                cur = ((i % total) + total) % total;
                track.style.transform = `translateX(-${cur * 100}%)`;
                document.querySelectorAll('.carousel-dot').forEach((d, j) => {
                    d.classList.toggle('bg-secondary', j === cur);
                    d.classList.toggle('bg-white/30', j !== cur);
                });
            }

            function start() {
                auto = setInterval(() => go(cur + 1), 5000);
            }

            function stop() {
                clearInterval(auto);
            }
            const p = document.getElementById('prevBtn');
            const n = document.getElementById('nextBtn');
            if (p) p.addEventListener('click', () => {
                stop();
                go(cur - 1);
                start();
            });
            if (n) n.addEventListener('click', () => {
                stop();
                go(cur + 1);
                start();
            });
            document.querySelectorAll('.carousel-dot').forEach(d => d.addEventListener('click', () => {
                stop();
                go(+d.dataset.index);
                start();
            }));
            start();
        }
</script>
@endpush
