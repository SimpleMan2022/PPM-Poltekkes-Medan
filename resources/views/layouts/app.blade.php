<!DOCTYPE html>
<html lang="id">
@include('layouts._head')
<body class="min-h-screen bg-slate-50/40 text-slate-800 flex flex-col justify-between antialiased">

    <div class="w-full">
        <!-- Header / Navbar Component -->
        <x-navbar />

        <!-- Main Content Slot -->
        <main>
            @yield('content')
        </main>
    </div>

    <!-- Footer Component -->
    <x-footer :siteSetting="$siteSetting" :services="$services" />

    @include('layouts._scripts')
</body>
</html>
