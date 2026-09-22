{{-- Ikon layanan. Sumber: config/service-icons.php. Fallback: shield-check. --}}
@props(['name' => null, 'class' => 'w-5 h-5'])
@php($icons = config('service-icons', []))
@php($svg = $icons[$name]['svg'] ?? $icons['shield-check']['svg'] ?? '')
<svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" class="{{ $class }}" aria-hidden="true">{!! $svg !!}</svg>
