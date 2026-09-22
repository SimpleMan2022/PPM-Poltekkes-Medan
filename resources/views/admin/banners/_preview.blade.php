{{-- Pratinjau slider khusus halaman kelola banner. Kode mandiri,
    dirancang untuk lebar kolom admin (bukan comotan carousel publik).
    PENTING: rasio & skala teks disamakan dengan components/hero-carousel.
    Kalau salah satu diubah, ubah juga yang lain. --}}
<div class="mb-6">
    <div class="mb-3">
        <p class="section-label text-primary">Pratinjau</p>
        <h2 class="font-display text-base sm:text-lg font-bold text-slate-800 mt-1 leading-snug">Slider Beranda</h2>
    </div>

    @if($banners->count() > 0)
    <div class="rounded-xl overflow-hidden border border-slate-200 shadow-sm bg-slate-900">
        <div id="bannerAdminSlider" class="relative">
            <div id="bannerAdminTrack" class="flex transition-transform duration-500 ease-in-out">
                @foreach($banners as $banner)
                <div class="w-full shrink-0 relative">
                    <div class="aspect-[16/9] sm:aspect-[21/9] md:aspect-[3/1]">
                        <img
                            src="{{ asset($banner->image) }}"
                            alt="{{ $banner->title }}"
                            class="w-full h-full object-cover">

                        <div class="absolute inset-0 bg-gradient-to-r from-slate-900/80 via-slate-900/40 to-transparent"></div>
                    </div>

                    <span class="absolute top-2.5 left-2.5 w-6 h-6 flex items-center justify-center text-[11px] font-bold rounded-full bg-white/10 text-white tabular-nums">
                        {{ $banner->sort_order }}
                    </span>

                    @if($banner->is_active)
                    <span class="absolute top-2.5 right-2.5 px-2 py-0.5 text-[10px] font-semibold rounded-md bg-emerald-400/90 text-slate-900">
                        Aktif
                    </span>
                    @else
                    <span class="absolute top-2.5 right-2.5 px-2 py-0.5 text-[10px] font-semibold rounded-md bg-slate-900/70 text-white/80">
                        Nonaktif
                    </span>
                    @endif

                    <div class="absolute inset-0 flex items-center pointer-events-none">
                        <div class="px-4 sm:px-6 lg:px-8 pr-16 w-full">
                            <h3 class="text-xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-1.5 sm:mb-2 leading-tight line-clamp-1">
                                {{ $banner->title }}
                            </h3>

                            @if($banner->subtitle)
                            <p class="text-sm sm:text-base md:text-lg text-white/70 mb-3 sm:mb-5 max-w-xl leading-relaxed line-clamp-1">
                                {{ $banner->subtitle }}
                            </p>
                            @endif

                            @if($banner->cta_text)
                            <span class="inline-block px-4 sm:px-5 py-2 sm:py-2.5 bg-secondary text-slate-900 font-semibold rounded-md text-xs sm:text-sm">
                                {{ $banner->cta_text }}
                                <span aria-hidden="true">&rarr;</span>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            @if($banners->count() > 1)
            <button
                id="bannerAdminPrev"
                type="button"
                aria-label="Slide sebelumnya"
                class="absolute left-2 sm:left-4 top-1/2 -translate-y-1/2 w-8 h-8 sm:w-10 sm:h-10 bg-white/10 hover:bg-white/25 rounded-full flex items-center justify-center text-white transition-colors">
                <svg
                    class="w-4 h-4"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2">
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M15 19l-7-7 7-7" />
                </svg>
            </button>

            <button
                id="bannerAdminNext"
                type="button"
                aria-label="Slide berikutnya"
                class="absolute right-2 sm:right-4 top-1/2 -translate-y-1/2 w-8 h-8 sm:w-10 sm:h-10 bg-white/10 hover:bg-white/25 rounded-full flex items-center justify-center text-white transition-colors">
                <svg
                    class="w-4 h-4"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2">
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M9 5l7 7-7 7" />
                </svg>
            </button>

            <div class="absolute bottom-3 sm:bottom-5 left-1/2 -translate-x-1/2 flex gap-1.5">
                @foreach($banners as $i => $banner)
                <button
                    type="button"
                    aria-label="Ke slide {{ $i + 1 }}"
                    data-index="{{ $i }}"
                    class="banner-admin-dot w-6 h-1 rounded-full transition-colors {{ $i === 0 ? 'bg-secondary' : 'bg-white/30' }}">
                </button>
                @endforeach
            </div>
            @endif
        </div>
    </div>

    @endif
</div>

@push('scripts')
<script>
    (function() {
        var track = document.getElementById('bannerAdminTrack');
        if (!track) return;

        var total = track.children.length;
        var cur = 0;
        var auto = null;

        function paint() {
            track.style.transform = 'translateX(-' + (cur * 100) + '%)';

            document.querySelectorAll('.banner-admin-dot').forEach(function(d, j) {
                var on = j === cur;
                d.classList.toggle('bg-secondary', on);
                d.classList.toggle('bg-white/30', !on);
            });
        }

        function go(i) {
            cur = ((i % total) + total) % total;
            paint();
        }

        function start() {
            auto = setInterval(function() {
                go(cur + 1);
            }, 5000);
        }

        function stop() {
            clearInterval(auto);
        }

        var prev = document.getElementById('bannerAdminPrev');
        var next = document.getElementById('bannerAdminNext');

        if (prev) prev.addEventListener('click', function() {
            stop();
            go(cur - 1);
            start();
        });
        if (next) next.addEventListener('click', function() {
            stop();
            go(cur + 1);
            start();
        });

        document.querySelectorAll('.banner-admin-dot').forEach(function(d) {
            d.addEventListener('click', function() {
                stop();
                go(+d.dataset.index);
                start();
            });
        });

        start();
    })();
</script>
@endpush