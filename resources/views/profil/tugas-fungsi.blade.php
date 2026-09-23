@extends('layouts.app')

@section('title', 'Tugas Pokok & Fungsi - ' . ($siteSetting->site_name ?? 'PPM Poltekkes Kemenkes'))

@section('content')
<div class="py-8 sm:py-12">
    <div class="max-w-3xl mx-auto px-4 sm:px-6">
        <!-- Breadcrumb -->
        <nav class="mb-6 text-xs sm:text-sm text-slate-500">
            <a href="{{ route('landing') }}" class="hover:text-primary transition-colors">Beranda</a>
            <span class="mx-1.5">/</span>
            <span class="text-slate-800 font-medium">Profil</span>
            <span class="mx-1.5">/</span>
            <span class="text-primary font-medium">Tugas &amp; Fungsi</span>
        </nav>

        <!-- Page header -->
        <header class="mb-10 sm:mb-12">
            <p class="section-label text-primary">Profil — Tupoksi</p>
            <h1 class="font-display text-2xl sm:text-3xl font-bold text-slate-800 mt-1 leading-snug">Tugas Pokok &amp; Fungsi</h1>
            <p class="text-sm text-slate-500 mt-1.5">Mandat operasional Pusat Penjaminan Mutu Poltekkes Kemenkes Medan.</p>
            <div class="h-1 w-24 brand-stripe-lime rounded-sm mt-4" aria-hidden="true"></div>
        </header>

        @if(!$organizationProfile)
        <div class="rounded-xl border border-amber-200 bg-amber-50 p-5 text-sm text-amber-800">
            Data profil belum tersedia. Hubungi administrator untuk melengkapi data Pusat Penjaminan Mutu melalui panel admin.
        </div>
        @else
        <!-- Tugas Pokok: satu pernyataan mandat -->
        <section class="mb-12 sm:mb-16" aria-labelledby="tugas-pokok-heading">
            <p class="section-label text-primary" id="tugas-pokok-heading">Tugas Pokok</p>
            <p class="font-display text-lg sm:text-xl font-semibold text-slate-800 leading-relaxed mt-2">
                @if($organizationProfile->main_duties)
                {!! strip_tags($organizationProfile->main_duties, '<strong><em><a>') !!}
                            @else
                            Mengoordinasikan, memantau, dan mengevaluasi penjaminan mutu di seluruh program studi — dari penetapan standar sampai peningkatan berkelanjutan — agar memenuhi Standar Nasional Pendidikan Tinggi dan kriteria LAM-PTKes.
                            @endif
            </p>
        </section>

        <!-- Fungsi: satu daftar bernomor -->
        <section aria-labelledby="fungsi-heading">
            <p class="section-label text-primary" id="fungsi-heading">Fungsi</p>

            @if($organizationProfile->duties_functions)
            <div class="text-sm sm:text-[15px] text-slate-600 leading-relaxed space-y-3 [&_ul]:space-y-2.5 [&_ul>li]:relative [&_ul>li]:pl-5 [&_ul>li]:before:content-['–'] [&_ul>li]:before:absolute [&_ul>li]:before:left-0 [&_ul>li]:before:text-primary [&_ul>li]:before:font-bold [&_ol]:list-decimal [&_ol]:pl-6 [&_ol]:space-y-2.5 [&_ol>li]:pl-1 [&_ol>li]:marker:text-primary [&_ol>li]:marker:font-semibold">
                {!! $organizationProfile->duties_functions !!}
            </div>
            @else
            <ol class="divide-y divide-slate-200 border-y border-slate-200">
                <li class="flex gap-4 py-5 sm:py-6">
                    <span class="shrink-0 font-display text-sm font-bold text-primary tabular-nums pt-1">01</span>
                    <div>
                        <h3 class="text-sm sm:text-base font-semibold text-slate-800">Audit Mutu Internal (AMI)</h3>
                        <p class="text-sm text-slate-500 leading-relaxed mt-1">Merancang dan melaksanakan AMI berkala, termasuk temuan serta rekomendasi tindak lanjut untuk setiap unit. Jika jadwal AMI belum tayang, hubungi sekretariat PPM.</p>
                    </div>
                </li>
                <li class="flex gap-4 py-5 sm:py-6">
                    <span class="shrink-0 font-display text-sm font-bold text-primary tabular-nums pt-1">02</span>
                    <div>
                        <h3 class="text-sm sm:text-base font-semibold text-slate-800">Pendampingan akreditasi</h3>
                        <p class="text-sm text-slate-500 leading-relaxed mt-1">Mendampingi program studi menyiapkan dokumen akreditasi, menyusun Laporan Evaluasi Diri, dan simulasi asesmen.</p>
                    </div>
                </li>
                <li class="flex gap-4 py-5 sm:py-6">
                    <span class="shrink-0 font-display text-sm font-bold text-primary tabular-nums pt-1">03</span>
                    <div>
                        <h3 class="text-sm sm:text-base font-semibold text-slate-800">Survei kepuasan &amp; umpan balik</h3>
                        <p class="text-sm text-slate-500 leading-relaxed mt-1">Mengelola survei kepuasan mahasiswa, dosen, tenaga kependidikan, alumni, dan pengguna lulusan.</p>
                    </div>
                </li>
                <li class="flex gap-4 py-5 sm:py-6">
                    <span class="shrink-0 font-display text-sm font-bold text-primary tabular-nums pt-1">04</span>
                    <div>
                        <h3 class="text-sm sm:text-base font-semibold text-slate-800">Pengembangan budaya mutu</h3>
                        <p class="text-sm text-slate-500 leading-relaxed mt-1">Menyelenggarakan pelatihan dan sosialisasi budaya mutu bagi civitas akademika.</p>
                    </div>
                </li>
                <li class="flex gap-4 py-5 sm:py-6">
                    <span class="shrink-0 font-display text-sm font-bold text-primary tabular-nums pt-1">05</span>
                    <div>
                        <h3 class="text-sm sm:text-base font-semibold text-slate-800">Dokumentasi &amp; pelaporan mutu</h3>
                        <p class="text-sm text-slate-500 leading-relaxed mt-1">Mengelola dokumen mutu — SOP, formulir, rekaman — serta laporan kinerja mutu periodik. Dokumen lengkapnya ada di halaman <a href="{{ route('landing') }}#dokumen" class="text-primary font-medium hover:underline">Dokumen &amp; SOP</a>.</p>
                    </div>
                </li>
            </ol>
            @endif
        </section>
        @endif
    </div>
</div>
@endsection