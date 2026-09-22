@if($doc->fileUrl())
    <a href="{{ $doc->fileUrl() }}" target="_blank" rel="noopener" class="inline-flex items-center gap-1.5 px-2.5 py-1.5 text-xs font-medium text-primary-dark border border-primary/30 rounded-md hover:bg-primary/10 transition-colors {{ ($block ?? false) ? 'flex-1 justify-center' : '' }}">
        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
        </svg>
        Lihat
    </a>
    <a href="{{ route('dokumen.download', $doc) }}" class="inline-flex items-center gap-1.5 px-2.5 py-1.5 text-xs font-semibold text-white bg-primary hover:bg-primary-dark rounded-md transition-colors {{ ($block ?? false) ? 'flex-1 justify-center' : 'ml-1.5' }}">
        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
        </svg>
        Unduh
    </a>
@else
    <span class="text-[11px] text-slate-400">Berkas belum diunggah — hubungi administrator.</span>
@endif
