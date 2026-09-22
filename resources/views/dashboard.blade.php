<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">
    <title>Dashboard - PPM Poltekkes Kemenkes</title>
    @fonts
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-50">

    <!-- Navbar -->
    <nav class="bg-white border-b border-slate-200 border-t-2 border-t-primary shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center gap-3">
                    <img src="{{ $siteSetting?->logoUrl() ?? asset('assets/images/logo_poltekkes.webp') }}" alt="PPM Poltekkes Kemenkes Medan" class="h-12 w-auto object-contain">
                </div>
                <div class="flex items-center gap-4">
                    <span class="text-sm text-slate-600">{{ auth()->user()->name }}</span>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ auth()->user()->isSuperAdmin() ? 'bg-primary/10 text-primary' : 'bg-secondary/20 text-secondary-dark' }}">
                        {{ auth()->user()->role === 'superadmin' ? 'Super Admin' : 'Admin Operator' }}
                    </span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-sm text-slate-500 hover:text-primary transition-colors font-medium">
                            Keluar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg text-sm text-green-700">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-8 text-center">
            <h2 class="text-2xl font-bold text-slate-800 mb-2">Selamat Datang di Dashboard</h2>
            <p class="text-slate-500">Halaman dashboard sedang dalam pengembangan.</p>
        </div>
    </main>

</body>
</html>