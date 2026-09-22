@extends('layouts.admin')

@section('page-title', 'Pengguna')

@section('content')
<div class="mb-6">
    <nav class="mb-4 text-xs sm:text-sm text-slate-500">
        <a href="{{ route('admin.dashboard') }}" class="hover:text-primary transition-colors">Dashboard</a>
        <span class="mx-1.5">/</span>
        <span class="text-primary font-medium">Pengguna</span>
    </nav>
    <div class="flex items-start justify-between gap-4">
        <div>
            <h1 class="font-display text-xl sm:text-2xl font-bold text-slate-800 leading-snug">Pengguna</h1>
            <p class="text-sm text-slate-500 mt-1">Kelola akun admin beserta perannya. Hanya Super Admin yang bisa membuka halaman ini.</p>
        </div>
        <a href="{{ route('admin.users.create') }}" class="shrink-0 inline-flex items-center gap-1.5 px-4 py-2 text-sm font-semibold text-white bg-primary hover:bg-primary-dark rounded-md transition-colors">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            Tambah
        </a>
    </div>
</div>

<div class="bg-white border border-slate-200 rounded-xl overflow-hidden">
    @if($users->isEmpty())
        <p class="px-5 py-10 text-center text-sm text-slate-400">Belum ada akun selain Anda. Klik <span class="font-semibold text-slate-600">Tambah</span> untuk membuat akun baru.</p>
    @else
        <div class="overflow-x-auto">
            <table class="w-full min-w-[640px] text-sm">
                <thead>
                    <tr class="bg-slate-800 text-white text-left">
                        <th scope="col" class="px-4 py-3 text-xs font-semibold uppercase tracking-wider">Nama</th>
                        <th scope="col" class="px-4 py-3 text-xs font-semibold uppercase tracking-wider">Peran</th>
                        <th scope="col" class="px-4 py-3 text-xs font-semibold uppercase tracking-wider text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($users as $user)
                        <tr class="hover:bg-primary/5 transition-colors">
                            <td class="px-4 py-3 min-w-[200px]">
                                <p class="font-medium text-slate-800">
                                    {{ $user->name }}
                                    @if($user->is(auth()->user()))
                                        <span class="ml-1.5 text-[11px] font-semibold text-slate-400">(Anda)</span>
                                    @endif
                                </p>
                                <p class="text-xs text-slate-500 mt-0.5">{{ $user->email }}</p>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                <span class="inline-block px-2.5 py-1 text-[11px] font-semibold rounded-md {{ $user->role === 'superadmin' ? 'bg-primary/10 text-primary-darker' : 'bg-secondary/20 text-secondary-dark' }}">
                                    {{ $user->role === 'superadmin' ? 'Super Admin' : 'Admin Operator' }}
                                </span>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-right">
                                <a href="{{ route('admin.users.edit', $user) }}" class="inline-flex items-center px-2.5 py-1.5 text-xs font-medium text-primary-dark border border-primary/30 rounded-md hover:bg-primary/10 transition-colors">Ubah</a>
                                @if(!$user->is(auth()->user()))
                                    <form method="POST" action="{{ route('admin.users.destroy', $user) }}" class="inline" onsubmit="return confirm('Hapus akun &quot;{{ $user->name }}&quot;? Akun tersebut langsung tidak bisa login lagi.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center px-2.5 py-1.5 ml-1.5 text-xs font-medium text-red-600 border border-red-200 rounded-md hover:bg-red-50 transition-colors">Hapus</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
