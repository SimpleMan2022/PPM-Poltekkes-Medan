@extends('layouts.app')

@section('title', 'Dokumen & SOP - ' . ($siteSetting->site_name ?? 'PPM Poltekkes Kemenkes'))

@section('content')
<div class="py-8 sm:py-12">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb -->
        <nav class="mb-6 text-xs sm:text-sm text-slate-500">
            <a href="{{ route('landing') }}" class="hover:text-primary transition-colors">Beranda</a>
            <span class="mx-1.5">/</span>
            <span class="text-primary font-medium">Dokumen &amp; SOP</span>
        </nav>

        <!-- Page header -->
        <header class="mb-8 sm:mb-10">
            <p class="section-label text-primary">Arsip Resmi</p>
            <h1 class="font-display text-2xl sm:text-3xl font-bold text-slate-800 mt-1 leading-snug">Dokumen &amp; SOP</h1>
            <p class="text-sm text-slate-500 mt-1.5 max-w-2xl">Cari, saring, dan unduh dokumen resmi Pusat Penjaminan Mutu — Kebijakan Mutu, Manual Mutu, Standar Mutu, SOP, dan Formulir.</p>
            <div class="h-1 w-24 brand-stripe-lime rounded-sm mt-4" aria-hidden="true"></div>
        </header>

        @if($documents->isEmpty())
            <div class="rounded-xl border border-amber-200 bg-amber-50 p-5 text-sm text-amber-800">
                Belum ada dokumen yang dipublikasikan. Hubungi administrator untuk mengunggah dokumen melalui panel admin.
            </div>
        @else
            <!-- Search -->
            <div class="relative mb-4">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                </svg>
                <input
                    id="docSearch"
                    type="search"
                    placeholder="Cari nama atau kode dokumen…"
                    autocomplete="off"
                    class="w-full pl-10 pr-4 py-2.5 text-sm bg-white border border-slate-200 rounded-lg placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition"
                >
            </div>

            <!-- Category pills -->
            <p class="text-xs font-medium text-slate-500 mb-2">Saring berdasarkan kategori</p>
            <div class="flex gap-2 overflow-x-auto pb-2 mb-4 -mx-4 px-4 sm:mx-0 sm:px-0 sm:flex-wrap">
                <button type="button" data-filter="all" class="doc-filter shrink-0 px-3.5 py-1.5 rounded-md text-xs sm:text-sm font-medium border bg-primary border-primary text-white transition-colors">Semua ({{ $documents->count() }})</button>
                @foreach($categories as $cat)
                    <button type="button" data-filter="{{ $cat->slug }}" class="doc-filter shrink-0 px-3.5 py-1.5 rounded-md text-xs sm:text-sm font-medium border bg-white border-slate-200 text-slate-600 hover:text-primary hover:border-primary/40 transition-colors">{{ $cat->name }} ({{ $cat->documents_count }})</button>
                @endforeach
            </div>

            <!-- Result count -->
            <p id="docCount" class="text-xs text-slate-500 mb-3">Menampilkan {{ $documents->count() }} dari {{ $documents->count() }} dokumen</p>

            <!-- Mobile cards -->
            <div id="docCards" class="sm:hidden space-y-3">
                @foreach($documents as $doc)
                    <article class="doc-card bg-white border border-slate-200 rounded-xl p-4"
                        data-name="{{ strtolower($doc->name ?? '') }}"
                        data-code="{{ strtolower($doc->code ?? '') }}"
                        data-category="{{ $doc->documentCategory?->slug ?? '' }}">
                        <div class="flex items-start justify-between gap-3">
                            <h3 class="text-sm font-semibold text-slate-800 leading-snug">{{ $doc->name }}</h3>
                            <span class="shrink-0 inline-block px-2 py-0.5 text-[11px] font-semibold bg-primary/10 text-primary-darker rounded-md">{{ $doc->documentCategory?->name ?? '—' }}</span>
                        </div>
                        <p class="mt-1.5 text-xs text-slate-500 tabular-nums">{{ $doc->code }} &bull; {{ $doc->published_year }}</p>
                        <div class="mt-3 flex gap-2">
                            @include('dokumen._actions', ['doc' => $doc, 'block' => true])
                        </div>
                    </article>
                @endforeach
                <div id="docEmptyCard" class="hidden rounded-xl border border-dashed border-slate-200 bg-white px-4 py-10 text-center text-sm text-slate-400">
                    Tidak ada dokumen yang cocok dengan pencarian Anda. Coba kata kunci atau kategori lain, atau hubungi administrator jika dokumen yang dicari belum tersedia.
                </div>
            </div>

            <!-- Table (tablet ke atas) -->
            <div class="hidden sm:block overflow-x-auto rounded-xl border border-slate-200 bg-white">
                <table class="w-full min-w-[760px] text-sm">
                    <thead>
                        <tr class="bg-slate-800 text-white text-left">
                            <th scope="col" class="w-12 px-4 py-3 text-xs font-semibold uppercase tracking-wider">No</th>
                            <th scope="col" class="px-4 py-3 text-xs font-semibold uppercase tracking-wider">Kode</th>
                            <th scope="col" class="px-4 py-3 text-xs font-semibold uppercase tracking-wider">Nama Dokumen</th>
                            <th scope="col" class="px-4 py-3 text-xs font-semibold uppercase tracking-wider">Kategori</th>
                            <th scope="col" class="w-24 px-4 py-3 text-xs font-semibold uppercase tracking-wider">Tahun</th>
                            <th scope="col" class="px-4 py-3 text-xs font-semibold uppercase tracking-wider text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="docTableBody" class="divide-y divide-slate-100">
                        @foreach($documents as $doc)
                            <tr class="doc-row hover:bg-primary/5 transition-colors"
                                data-name="{{ strtolower($doc->name) }}"
                                data-code="{{ strtolower($doc->code) }}"
                                data-category="{{ $doc->documentCategory?->slug ?? '' }}">
                                <td class="doc-no px-4 py-3.5 text-slate-500 tabular-nums">{{ $loop->iteration }}</td>
                                <td class="px-4 py-3.5 text-slate-600 tabular-nums whitespace-nowrap">{{ $doc->code }}</td>
                                <td class="px-4 py-3.5 font-medium text-slate-800 min-w-[220px]">{{ $doc->name }}</td>
                                <td class="px-4 py-3.5 whitespace-nowrap">
                                    <span class="inline-block px-2.5 py-1 text-[11px] font-semibold bg-primary/10 text-primary-darker rounded-md">{{ $doc->documentCategory?->name ?? '—' }}</span>
                                </td>
                                <td class="px-4 py-3.5 text-slate-600 tabular-nums">{{ $doc->published_year }}</td>
                                <td class="px-4 py-3.5 whitespace-nowrap text-right">
                                    @include('dokumen._actions', ['doc' => $doc])
                                </td>
                            </tr>
                        @endforeach
                        <tr id="docEmpty" class="hidden">
                            <td colspan="6" class="px-4 py-10 text-center text-sm text-slate-400">
                                Tidak ada dokumen yang cocok dengan pencarian Anda. Coba kata kunci atau kategori lain, atau hubungi administrator jika dokumen yang dicari belum tersedia.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div id="docPagination" class="mt-4 flex items-center justify-between gap-3">
                <p id="docPageInfo" class="text-xs text-slate-500 tabular-nums"></p>
                <div class="flex items-center gap-1.5">
                    <button id="pagePrev" type="button" aria-label="Halaman sebelumnya" class="inline-flex items-center justify-center w-8 h-8 text-sm border border-slate-200 rounded-md bg-white text-slate-600 hover:text-primary hover:border-primary/40 disabled:opacity-40 disabled:cursor-not-allowed transition-colors">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" /></svg>
                    </button>
                    <div id="pageNumbers" class="hidden sm:flex items-center gap-1.5"></div>
                    <button id="pageNext" type="button" aria-label="Halaman berikutnya" class="inline-flex items-center justify-center w-8 h-8 text-sm border border-slate-200 rounded-md bg-white text-slate-600 hover:text-primary hover:border-primary/40 disabled:opacity-40 disabled:cursor-not-allowed transition-colors">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" /></svg>
                    </button>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
(function () {
    var searchInput = document.getElementById('docSearch');
    var pills = Array.prototype.slice.call(document.querySelectorAll('.doc-filter'));
    var rows = Array.prototype.slice.call(document.querySelectorAll('.doc-row'));
    var cards = Array.prototype.slice.call(document.querySelectorAll('.doc-card'));
    var pairs = rows.map(function (row, i) { return { row: row, card: cards[i] }; });
    var emptyRow = document.getElementById('docEmpty');
    var emptyCard = document.getElementById('docEmptyCard');
    var countText = document.getElementById('docCount');
    var pageBar = document.getElementById('docPagination');
    var pageInfo = document.getElementById('docPageInfo');
    var pageNumbers = document.getElementById('pageNumbers');
    var prevBtn = document.getElementById('pagePrev');
    var nextBtn = document.getElementById('pageNext');

    var pageSize = 10;
    var currentPage = 1;
    var activeCategory = 'all';

    var activeClasses = ['bg-primary', 'border-primary', 'text-white'];
    var idleClasses = ['bg-white', 'border-slate-200', 'text-slate-600', 'hover:text-primary', 'hover:border-primary/40'];

    function isMatch(pair, query) {
        if (activeCategory !== 'all' && pair.row.dataset.category !== activeCategory) return false;
        if (!query) return true;
        return pair.row.dataset.name.indexOf(query) !== -1
            || pair.row.dataset.code.indexOf(query) !== -1;
    }

    function render() {
        var query = searchInput.value.trim().toLowerCase();
        var filtered = pairs.filter(function (p) { return isMatch(p, query); });
        var totalPages = Math.max(1, Math.ceil(filtered.length / pageSize));
        if (currentPage > totalPages) currentPage = totalPages;

        pairs.forEach(function (p) {
            p.row.classList.add('hidden');
            if (p.card) p.card.classList.add('hidden');
        });

        var start = (currentPage - 1) * pageSize;
        var pageItems = filtered.slice(start, start + pageSize);
        pageItems.forEach(function (p, idx) {
            p.row.classList.remove('hidden');
            if (p.card) p.card.classList.remove('hidden');
            p.row.querySelector('.doc-no').textContent = start + idx + 1;
        });

        var hasResult = filtered.length > 0;
        emptyRow.classList.toggle('hidden', hasResult);
        emptyCard.classList.toggle('hidden', hasResult);

        if (hasResult) {
            countText.textContent = 'Menampilkan ' + (start + 1) + '\u2013' + (start + pageItems.length) + ' dari ' + filtered.length + ' dokumen';
        } else {
            countText.textContent = 'Menampilkan 0 dari ' + pairs.length + ' dokumen';
        }

        pageBar.classList.toggle('hidden', totalPages <= 1);
        pageInfo.textContent = 'Halaman ' + currentPage + ' dari ' + totalPages;
        prevBtn.disabled = currentPage <= 1;
        nextBtn.disabled = currentPage >= totalPages;

        pageNumbers.innerHTML = '';
        for (var i = 1; i <= totalPages; i++) {
            var b = document.createElement('button');
            b.type = 'button';
            b.textContent = i;
            b.setAttribute('data-page', i);
            b.setAttribute('aria-label', 'Ke halaman ' + i);
            b.className = 'w-8 h-8 text-xs rounded-md border transition-colors ' + (i === currentPage
                ? 'bg-primary border-primary text-white font-semibold'
                : 'bg-white border-slate-200 text-slate-600 hover:text-primary hover:border-primary/40');
            pageNumbers.appendChild(b);
        }
    }

    pageNumbers.addEventListener('click', function (e) {
        var btn = e.target.closest('button');
        if (!btn) return;
        currentPage = parseInt(btn.getAttribute('data-page'), 10);
        render();
    });

    prevBtn.addEventListener('click', function () {
        if (currentPage > 1) { currentPage--; render(); }
    });

    nextBtn.addEventListener('click', function () {
        currentPage++;
        render();
    });

    searchInput.addEventListener('input', function () {
        currentPage = 1;
        render();
    });

    pills.forEach(function (pill) {
        pill.addEventListener('click', function () {
            activeCategory = pill.getAttribute('data-filter');
            currentPage = 1;
            pills.forEach(function (p) {
                activeClasses.forEach(function (cls) { p.classList.remove(cls); });
                idleClasses.forEach(function (cls) { p.classList.remove(cls); });
                var target = (p === pill) ? activeClasses : idleClasses;
                target.forEach(function (cls) { p.classList.add(cls); });
            });
            render();
        });
    });

    render();
})();
</script>
@endpush
