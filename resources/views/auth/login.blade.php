<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">
    <title>Login - PPM Poltekkes Kemenkes</title>
    @fonts
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .pattern-strip {
            background-image: url('{{ asset("assets/images/pattern.svg") }}');
            background-repeat: repeat;
            background-size: 217px 72px;
        }
            .brand-stripe-lime { background: linear-gradient(135deg, var(--color-secondary) 0%, var(--color-primary) 60%); }
    </style>
</head>
<body class="h-screen flex flex-col bg-slate-50 overflow-hidden">

    <!-- Pattern Strip Atas -->
    <div class="shrink-0 h-12 sm:h-14 md:h-16 pattern-strip" aria-hidden="true"></div>

    <!-- Main Content -->
    <div class="flex-1 flex items-center justify-center px-4 py-3 sm:py-6 overflow-y-auto">

        <div class="w-full max-w-sm">

            <!-- Logo & Title -->
            <div class="text-center mb-4 sm:mb-6">
                <img src="{{ $siteSetting?->logoUrl() ?? asset('assets/images/logo_poltekkes.webp') }}" alt="PPM Poltekkes Kemenkes Medan" class="h-24 sm:h-28 md:h-32 w-auto mx-auto mb-3 sm:mb-4 object-contain">
            </div>

            <!-- Login Card -->
            <div class="bg-white rounded-xl sm:rounded-2xl shadow-lg border border-slate-200 px-5 py-5 sm:px-8 sm:py-6">

                <h2 class="text-base sm:text-lg font-semibold text-slate-800 text-center mb-1">Masuk ke Sistem</h2>
                <div class="h-0.5 w-16 sm:w-20 brand-stripe-lime mx-auto mb-4 sm:mb-5 rounded-sm" aria-hidden="true"></div>

                <!-- Success Message -->
                @if(session('success'))
                    <div class="mb-3 p-2.5 sm:p-3 bg-green-50 border border-green-200 rounded-lg text-xs sm:text-sm text-green-700 text-center">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Error Message -->
                @if(session('error'))
                    <div class="mb-3 p-2.5 sm:p-3 bg-red-50 border border-red-200 rounded-lg text-xs sm:text-sm text-red-700 text-center">
                        {{ session('error') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-3.5 sm:space-y-4">
                    @csrf

                    <!-- Email Field -->
                    <div>
                        <label for="email" class="block text-xs sm:text-sm font-medium text-slate-700 mb-1">Email</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-2.5 sm:pl-3">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-slate-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75a2.25 2.25 0 0 1 2.25-2.25h15a2.25 2.25 0 0 1 2.25 2.25Zm-8.25-3v3m0 0v3m0-3h3m-3 0h-3" />
                                </svg>
                            </span>
                            <input
                                id="email"
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                autocomplete="email"
                                autofocus
                                placeholder="nama@poltekkes.ac.id"
                                class="w-full pl-9 sm:pl-10 pr-3 sm:pr-4 py-2 sm:py-2.5 border rounded-lg text-sm text-slate-800 placeholder-slate-400 transition-colors duration-150 focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary @error('email') border-red-300 @else border-slate-300 @enderror"
                            >
                        </div>
                        @error('email')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password Field -->
                    <div>
                        <label for="password" class="block text-xs sm:text-sm font-medium text-slate-700 mb-1">Password</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-2.5 sm:pl-3">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-slate-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 8.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                                </svg>
                            </span>
                            <input
                                id="password"
                                type="password"
                                name="password"
                                required
                                autocomplete="current-password"
                                placeholder="Masukkan password"
                                class="w-full pl-9 sm:pl-10 pr-9 sm:pr-10 py-2 sm:py-2.5 border rounded-lg text-sm text-slate-800 placeholder-slate-400 transition-colors duration-150 focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary @error('password') border-red-300 @else border-slate-300 @enderror"
                            >
                            <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 flex items-center pr-2.5 sm:pr-3 text-slate-400 hover:text-slate-600 transition-colors">
                                <svg id="eyeIcon" class="w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.2 7.52 7.38 4.5 12 4.5c4.618 0 8.8 3.022 9.964 7.183a1.012 1.012 0 0 1 0 .639C20.8 16.48 16.618 19.5 12 19.5c-4.618 0-8.8-3.022-9.964-7.178Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                                <svg id="eyeOffIcon" class="w-4 h-4 sm:w-5 sm:h-5 hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.983a10.477 10.477 0 0 1 4.317-3.44M14.131 14.5a3.5 3.5 0 0 1-5.262 0m7.591 2.567a10.47 10.47 0 0 1-4.46 2.966M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.2 7.52 7.38 4.5 12 4.5c1.53 0 2.98.246 4.288.7M18.36 5.64l-13.72 13.72" />
                                </svg>
                            </button>
                        </div>
                        @error('password')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center">
                        <label class="flex items-center gap-1.5 sm:gap-2 cursor-pointer">
                            <input type="checkbox" name="remember" class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-primary border-slate-300 rounded focus:ring-primary transition-colors">
                            <span class="text-xs sm:text-sm text-slate-600">Ingat saya</span>
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <button
                        type="submit"
                        class="w-full py-2 sm:py-2.5 px-4 bg-primary hover:bg-primary-dark active:bg-primary-darker text-white font-semibold rounded-lg text-sm transition-colors duration-150 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2"
                    >
                        Masuk
                    </button>
                </form>

                <!-- Help Text -->
                <p class="text-center text-xs text-slate-400 mt-4 sm:mt-5">
                    Jika ada masalah, hubungi <a href="mailto:admin@poltekkesmedan.ac.id" class="text-primary hover:underline">administrator</a>
                </p>
            </div>

            <!-- Footer -->
            <p class="text-center text-[10px] sm:text-xs text-tertiary mt-3 sm:mt-4">
                &copy; {{ date('Y') }} PPM Poltekkes Kemenkes Medan
            </p>
        </div>
    </div>

    <!-- Pattern Strip Bawah -->
    <div class="shrink-0 h-12 sm:h-14 md:h-16 pattern-strip" aria-hidden="true"></div>

    <script>
        document.getElementById('togglePassword').addEventListener('click', function () {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            const eyeOffIcon = document.getElementById('eyeOffIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.add('hidden');
                eyeOffIcon.classList.remove('hidden');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('hidden');
                eyeOffIcon.classList.add('hidden');
            }
        });
    </script>

</body>
</html>