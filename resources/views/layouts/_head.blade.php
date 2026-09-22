<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>@yield('title', 'PPM Poltekkes Kemenkes')</title>

    <!-- Favicons -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">

    @fonts
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .pattern-strip {
            background-image: url('{{ asset("assets/images/pattern.svg") }}');
            background-repeat: repeat;
            background-size: 217px 72px;
        }
        .brand-stripe { background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-tertiary) 100%); }
        .brand-stripe-lime { background: linear-gradient(135deg, var(--color-secondary) 0%, var(--color-primary) 60%); }
        .section-label { font-size: 0.65rem; letter-spacing: 0.15em; text-transform: uppercase; font-weight: 600; }
        html { scroll-behavior: smooth; }
    </style>

    @stack('styles')
</head>
