<!DOCTYPE html>
<html lang="id">
@include('layouts._head')

<body class="min-h-screen bg-slate-50 text-slate-800 antialiased overflow-x-clip">

    <style>
        @media (min-width: 1024px) {
            body.sidebar-collapsed #adminSidebar {
                width: 4.75rem;
            }

            body.sidebar-collapsed .admin-main {
                padding-left: 4.75rem;
            }

            body.sidebar-collapsed .sidebar-label,
            body.sidebar-collapsed .sidebar-group-title,
            body.sidebar-collapsed .sidebar-badge,
            body.sidebar-collapsed .sidebar-logo-text {
                display: none;
            }

            body.sidebar-collapsed .sidebar-link {
                justify-content: center;
                padding-left: 0.5rem;
                padding-right: 0.5rem;
            }

            body.sidebar-collapsed .sidebar-brand {
                justify-content: center;
                padding-left: 0;
                padding-right: 0;
            }

            body.sidebar-collapsed #adminSidebar nav,
            body.sidebar-collapsed #adminSidebar .sidebar-bottom {
                padding-left: 0.5rem;
                padding-right: 0.5rem;
            }

            body.sidebar-collapsed #adminSidebar nav {
                overflow: visible;
            }

            body.sidebar-collapsed .sidebar-group-menu {
                position: relative;
            }

            body.sidebar-collapsed .sidebar-submenu:not(.hidden) {
                position: absolute;
                left: calc(100% + 0.5rem);
                top: 0;
                width: 12rem;
                background-color: #fff;
                border: 1px solid rgb(226 232 240);
                border-radius: 0.5rem;
                box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1);
                padding: 0.25rem;
                z-index: 60;
            }

            body.sidebar-collapsed .sidebar-submenu .sidebar-link {
                justify-content: flex-start;
            }
        }
    </style>

    <div id="adminOverlay" class="fixed inset-0 z-40 bg-slate-900/50 hidden lg:hidden"></div>

    <!-- Sidebar -->
    <aside id="adminSidebar" class="fixed inset-y-0 left-0 z-50 w-64 bg-white border-r border-slate-200 flex flex-col -translate-x-full lg:translate-x-0 transition-transform duration-200">
        <div class="h-1 brand-stripe-lime shrink-0" aria-hidden="true"></div>
        <a href="{{ route('admin.dashboard') }}" class="sidebar-brand flex items-center gap-2.5 px-5 h-16 shrink-0">
            <img src="{{ $siteSetting?->logoUrl() ?? asset('assets/images/logo_poltekkes.webp') }}" alt="PPM Poltekkes" class="h-10 w-auto object-contain">
        </a>

        <nav class="flex-1 overflow-y-auto px-3 pb-4 space-y-6">
            <div>
                <p class="sidebar-group-title px-3 mb-1.5 text-[11px] font-semibold uppercase tracking-widest text-slate-400">Utama</p>
                <a href="{{ route('admin.dashboard') }}" title="Dashboard" class="sidebar-link flex items-center gap-2.5 px-3 py-2 rounded-md text-sm font-semibold {{ request()->routeIs('admin.dashboard') ? 'bg-primary/10 text-primary' : 'text-slate-700 hover:text-primary hover:bg-primary/5' }} transition-colors">
                    <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                    </svg>
                    <span class="sidebar-label">Dashboard</span>
                </a>
            </div>

            <div>
                <p class="sidebar-group-title px-3 mb-1.5 text-[11px] font-semibold uppercase tracking-widest text-slate-400">Kelola Konten</p>
                <div class="space-y-0.5">
                    <a href="{{ route('admin.banners.index') }}" title="Banner Slider" class="sidebar-link flex items-center gap-2.5 px-3 py-2 rounded-md text-sm font-semibold {{ request()->routeIs('admin.banners.*') ? 'bg-primary/10 text-primary' : 'text-slate-700 hover:text-primary hover:bg-primary/5' }} transition-colors">
                        <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                        </svg>
                        <span class="sidebar-label">Banner Slider</span>
                    </a>
                    <a href="{{ route('admin.profile.edit') }}" title="Sambutan" class="sidebar-link flex items-center gap-2.5 px-3 py-2 rounded-md text-sm font-semibold {{ request()->routeIs('admin.profile.edit', 'admin.profile.update') ? 'bg-primary/10 text-primary' : 'text-slate-700 hover:text-primary hover:bg-primary/5' }} transition-colors">
                        <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5zm4.125-9.75a1.875 1.875 0 11-3.75 0 1.875 1.875 0 013.75 0zm1.294 6.336a6.721 6.721 0 01-3.17.789 6.721 6.721 0 01-3.168-.789 3.376 3.376 0 016.338 0z" />
                        </svg>
                        <span class="sidebar-label">Sambutan</span>
                    </a>
                    @php($profilMenuOpen = request()->routeIs('admin.profile.struktur*', 'admin.profile.tugas-fungsi*'))
                    <div class="sidebar-group-menu">
                        <button type="button" title="Profil" aria-expanded="{{ $profilMenuOpen ? 'true' : 'false' }}" aria-controls="submenu-profil" data-submenu-toggle class="sidebar-link w-full flex items-center gap-2.5 px-3 py-2 rounded-md text-sm font-semibold {{ $profilMenuOpen ? 'bg-primary/10 text-primary' : 'text-slate-700 hover:text-primary hover:bg-primary/5' }} transition-colors">
                            <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                            </svg>
                            <span class="sidebar-label">Profil</span>
                            <svg data-chevron class="sidebar-label w-4 h-4 shrink-0 ml-auto transition-transform {{ $profilMenuOpen ? 'rotate-180' : '' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                        </button>
                        <div id="submenu-profil" class="sidebar-submenu mt-0.5 space-y-0.5 {{ $profilMenuOpen ? '' : 'hidden' }}">
                            <a href="{{ route('admin.profile.struktur') }}" class="sidebar-link flex items-center gap-2.5 pl-11 pr-3 py-2 rounded-md text-sm {{ request()->routeIs('admin.profile.struktur*') ? 'text-primary font-semibold bg-primary/5' : 'text-slate-600 hover:text-primary hover:bg-primary/5' }} transition-colors">Struktur Organisasi</a>
                            <a href="{{ route('admin.profile.tugas-fungsi') }}" class="sidebar-link flex items-center gap-2.5 pl-11 pr-3 py-2 rounded-md text-sm {{ request()->routeIs('admin.profile.tugas-fungsi*') ? 'text-primary font-semibold bg-primary/5' : 'text-slate-600 hover:text-primary hover:bg-primary/5' }} transition-colors">Tugas &amp; Fungsi</a>
                        </div>
                    </div>
                    <a href="{{ route('admin.services.index') }}" title="Layanan" class="sidebar-link flex items-center gap-2.5 px-3 py-2 rounded-md text-sm font-semibold {{ request()->routeIs('admin.services.*') ? 'bg-primary/10 text-primary' : 'text-slate-700 hover:text-primary hover:bg-primary/5' }} transition-colors">
                        <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0" />
                        </svg>
                        <span class="sidebar-label">Layanan</span>
                    </a>
                    <a href="{{ route('admin.related-links.index') }}" title="Link Terkait" class="sidebar-link flex items-center gap-2.5 px-3 py-2 rounded-md text-sm font-semibold {{ request()->routeIs('admin.related-links.*') ? 'bg-primary/10 text-primary' : 'text-slate-700 hover:text-primary hover:bg-primary/5' }} transition-colors">
                        <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244" />
                        </svg>
                        <span class="sidebar-label">Link Terkait</span>
                    </a>
                    <a href="{{ route('admin.documents.index') }}" title="Dokumen & SOP" class="sidebar-link flex items-center gap-2.5 px-3 py-2 rounded-md text-sm font-semibold {{ request()->routeIs('admin.documents.*', 'admin.document-categories.*') ? 'bg-primary/10 text-primary' : 'text-slate-700 hover:text-primary hover:bg-primary/5' }} transition-colors">
                        <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                        </svg>
                        <span class="sidebar-label">Dokumen &amp; SOP</span>
                    </a>
                    <a href="{{ route('admin.galleries.index') }}" title="Galeri" class="sidebar-link flex items-center gap-2.5 px-3 py-2 rounded-md text-sm font-semibold {{ request()->routeIs('admin.galleries.*') ? 'bg-primary/10 text-primary' : 'text-slate-700 hover:text-primary hover:bg-primary/5' }} transition-colors">
                        <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 6.878V6a2.25 2.25 0 012.25-2.25h7.5A2.25 2.25 0 0118 6v.878m-12 0c.235-.083.487-.128.75-.128h10.5c.263 0 .515.045.75.128m-12 0A2.25 2.25 0 004.5 9v.878m13.5-3A2.25 2.25 0 0119.5 9v.878m0 0a2.246 2.246 0 00-.75-.128H5.25c-.263 0-.515.045-.75.128m15 0A2.25 2.25 0 0121 12v6a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 18v-6c0-.98.626-1.813 1.5-2.122" />
                        </svg>
                        <span class="sidebar-label">Galeri</span>
                    </a>
                    <a href="{{ route('admin.personnels.index') }}" title="Personalia" class="sidebar-link flex items-center gap-2.5 px-3 py-2 rounded-md text-sm font-semibold {{ request()->routeIs('admin.personnels.*') ? 'bg-primary/10 text-primary' : 'text-slate-700 hover:text-primary hover:bg-primary/5' }} transition-colors">
                        <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                        </svg>
                        <span class="sidebar-label">Personalia</span>
                    </a>
                </div>
            </div>

            @if(auth()->user()->isSuperAdmin())
            <div>
                <p class="sidebar-group-title px-3 mb-1.5 text-[11px] font-semibold uppercase tracking-widest text-slate-400">Pengaturan</p>
                <div class="space-y-0.5">
                    <a href="{{ route('admin.users.index') }}" title="Pengguna" class="sidebar-link flex items-center gap-2.5 px-3 py-2 rounded-md text-sm font-semibold {{ request()->routeIs('admin.users.*') ? 'bg-primary/10 text-primary' : 'text-slate-700 hover:text-primary hover:bg-primary/5' }} transition-colors">
                        <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM3 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 019.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                        </svg>
                        <span class="sidebar-label">Pengguna</span>
                    </a>
                    <a href="{{ route('admin.site-settings.edit') }}" title="Identitas Situs" class="sidebar-link flex items-center gap-2.5 px-3 py-2 rounded-md text-sm font-semibold {{ request()->routeIs('admin.site-settings.*') ? 'bg-primary/10 text-primary' : 'text-slate-700 hover:text-primary hover:bg-primary/5' }} transition-colors">
                        <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.759 6.759 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span class="sidebar-label">Identitas Situs</span>
                    </a>
                </div>
            </div>
            @endif
        </nav>

        <div class="pattern-strip h-10 shrink-0 border-t border-slate-100" aria-hidden="true"></div>

        <div class="sidebar-bottom border-t border-slate-200 p-3 space-y-0.5">
            <a href="{{ route('landing') }}" target="_blank" rel="noopener" title="Lihat Situs" class="sidebar-link flex items-center gap-2.5 px-3 py-2 rounded-md text-sm text-slate-600 hover:text-primary hover:bg-primary/5 transition-colors">
                <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.743 4.5M12 3a8.997 8.997 0 00-7.743 4.5" />
                </svg>
                <span class="sidebar-label">Lihat Situs</span>
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" title="Keluar" class="sidebar-link w-full flex items-center gap-2.5 px-3 py-2 rounded-md text-sm text-slate-600 hover:text-red-600 hover:bg-red-50 transition-colors">
                    <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                    </svg>
                    <span class="sidebar-label">Keluar</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main column -->
    <div class="admin-main lg:pl-64 flex flex-col min-h-screen">
        <header class="sticky top-0 z-30 bg-white/90 backdrop-blur border-b border-slate-200">
            <div class="h-16 flex items-center gap-3 px-4 sm:px-6">
                <button id="adminSidebarBtn" type="button" class="p-2 -ml-2 text-slate-600 hover:text-primary transition-colors" aria-label="Buka atau tutup menu">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                <p class="font-display text-base sm:text-lg font-bold text-slate-800">@yield('page-title', 'Dashboard')</p>
                <div class="ml-auto flex items-center gap-2.5">
                    <span class="hidden sm:block text-sm text-slate-600">{{ auth()->user()->name }}</span>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ auth()->user()->isSuperAdmin() ? 'bg-primary/10 text-primary-darker' : 'bg-secondary/20 text-secondary-dark' }}">
                        {{ auth()->user()->role === 'superadmin' ? 'Super Admin' : 'Admin Operator' }}
                    </span>
                </div>
            </div>
            <div class="pattern-strip h-8" aria-hidden="true"></div>
            <div class="h-0.5 brand-stripe-lime" aria-hidden="true"></div>
        </header>

        <main class="flex-1 w-full max-w-6xl mx-auto px-4 sm:px-6 py-6 sm:py-8">
            @if(session('success'))
            <div class="mb-5 p-3.5 rounded-lg text-sm bg-primary/10 text-primary-darker border border-primary/20">
                {{ session('success') }}
            </div>
            @endif
            @if(session('error'))
            <div class="mb-5 p-3.5 rounded-lg text-sm bg-red-50 text-red-700 border border-red-200">
                {{ session('error') }}
            </div>
            @endif

            @yield('content')
        </main>

        <footer class="px-4 sm:px-6 py-4 text-center">
            <p class="text-[11px] text-slate-400">&copy; {{ date('Y') }} PPM Poltekkes Kemenkes Medan — Panel Admin</p>
        </footer>
    </div>

    <script>
        const sidebarBtn = document.getElementById('adminSidebarBtn');
        const sidebar = document.getElementById('adminSidebar');
        const overlay = document.getElementById('adminOverlay');
        const desktopQuery = window.matchMedia('(min-width: 1024px)');
        function storageGet(key) {
            try {
                return window.localStorage.getItem(key);
            } catch (e) {
                return null;
            }
        }
        function storageSet(key, value) {
            try {
                window.localStorage.setItem(key, value);
            } catch (e) {}
        }
        if (storageGet('admin-sidebar') === 'collapsed') {
            document.body.classList.add('sidebar-collapsed');
        }

        function closeSidebar() {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        }
        if (sidebarBtn && sidebar && overlay) {
            sidebarBtn.addEventListener('click', () => {
                if (desktopQuery.matches) {
                    const collapsed = document.body.classList.toggle('sidebar-collapsed');
                    storageSet('admin-sidebar', collapsed ? 'collapsed' : 'expanded');
                } else {
                    sidebar.classList.toggle('-translate-x-full');
                    overlay.classList.toggle('hidden');
                }
            });
            overlay.addEventListener('click', closeSidebar);
        }
        document.querySelectorAll('[data-submenu-toggle]').forEach(function (btn) {
            btn.addEventListener('click', function () {
                var target = document.getElementById(btn.getAttribute('aria-controls'));
                if (!target) return;
                var isHidden = target.classList.toggle('hidden');
                btn.setAttribute('aria-expanded', String(!isHidden));
                var chevron = btn.querySelector('[data-chevron]');
                if (chevron) chevron.classList.toggle('rotate-180', !isHidden);
            });
        });
    </script>

    @stack('scripts')
</body>

</html>