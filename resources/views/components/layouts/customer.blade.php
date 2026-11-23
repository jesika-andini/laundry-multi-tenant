<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'LaundryMap' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                    },
                },
            },
        };
    </script>
</head>
<body class="bg-[#f6f8fc] font-sans text-slate-900 antialiased">
    @php
        $currentUser = auth()->user();
        $roleLabel = match ($currentUser?->role) {
            'tenant_admin', 'tenant' => 'Mitra Aktif',
            'super_admin', 'admin' => 'Super Admin',
            default => 'Pelanggan Aktif',
        };
        $roleSubtitle = match ($currentUser?->role) {
            'tenant_admin', 'tenant' => 'Mitra',
            'super_admin', 'admin' => 'Super Admin',
            default => 'Customer',
        };
        $panelUrl = match ($currentUser?->role) {
            'super_admin', 'admin' => route('admin.dashboard'),
            'tenant_admin', 'tenant' => route('tenant.dashboard'),
            default => null,
        };
        $activeOrderCount = 0;

        if ($currentUser && \Illuminate\Support\Facades\Schema::hasTable('orders')) {
            $activeOrderCount = \App\Models\Order::query()
                ->withoutGlobalScope('tenant')
                ->where('customer_id', $currentUser->id)
                ->whereNotIn('status', ['Selesai'])
                ->count();
        }

        $supportPhone = '0812-3456-7890';
        $supportEmail = 'cs@laundrymap.id';
        $ordersUrl = auth()->check() ? route('customer.orders.index') : route('customer.login');
    @endphp

    <header class="sticky top-0 z-50 border-b border-slate-200/70 bg-white/95 backdrop-blur-xl">
        <div class="mx-auto flex max-w-7xl items-center gap-4 px-5 py-3">
            <a href="{{ route('customer.home') }}" class="flex shrink-0 items-center gap-2.5">
                <span class="grid h-10 w-10 place-items-center rounded-xl bg-gradient-to-br from-blue-600 via-blue-500 to-sky-400 text-white shadow-lg shadow-blue-600/25">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="4" y="3" width="16" height="18" rx="3"/>
                        <circle cx="12" cy="13" r="4"/>
                        <path d="M8 6.5h.01M11 6.5h.01"/>
                    </svg>
                </span>
                <span class="text-lg font-extrabold tracking-tight text-slate-900">Laundry<span class="text-blue-600">Map</span></span>
            </a>

            <nav class="hidden items-center gap-1 lg:flex">
                <a href="{{ route('customer.home') }}" class="rounded-lg px-3 py-2 text-sm font-semibold transition {{ request()->routeIs('customer.home') ? 'text-blue-600' : 'font-medium text-slate-600 hover:bg-slate-50 hover:text-blue-600' }}">Beranda</a>
                <a href="{{ route('customer.services') }}" class="rounded-lg px-3 py-2 text-sm font-semibold transition {{ request()->routeIs('customer.services') ? 'text-blue-600' : 'font-medium text-slate-600 hover:bg-slate-50 hover:text-blue-600' }}">Cari Laundry</a>
                <a href="{{ $ordersUrl }}" class="rounded-lg px-3 py-2 text-sm font-semibold transition {{ request()->routeIs('customer.orders.*') ? 'text-blue-600' : 'font-medium text-slate-600 hover:bg-slate-50 hover:text-blue-600' }}">Pesanan Saya</a>
                <a href="{{ route('customer.help') }}" class="rounded-lg px-3 py-2 text-sm font-semibold transition {{ request()->routeIs('customer.help') ? 'text-blue-600' : 'font-medium text-slate-600 hover:bg-slate-50 hover:text-blue-600' }}">Bantuan</a>
            </nav>

            <div class="ml-auto flex items-center gap-2 sm:gap-2.5">
                @auth
                    <span class="hidden items-center gap-1.5 rounded-full bg-blue-50 px-3 py-1.5 text-xs font-semibold text-blue-700 sm:flex">
                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                        {{ $roleLabel }}
                    </span>

                    <button type="button" class="relative hidden h-10 w-10 place-items-center rounded-full border border-slate-200 bg-white text-slate-500 transition hover:border-blue-200 hover:text-blue-600 sm:grid" title="Notifikasi">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 8a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9"/>
                            <path d="M10 21h4"/>
                        </svg>
                        <span class="absolute right-2 top-2 h-2 w-2 rounded-full bg-orange-400 ring-2 ring-white"></span>
                    </button>

                    <a href="{{ $ordersUrl }}" class="relative grid h-10 w-10 place-items-center rounded-full border border-slate-200 bg-white text-slate-500 transition hover:border-blue-200 hover:text-blue-600" title="Pesanan aktif">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M6 7h12l1 13H5L6 7Z"/>
                            <path d="M9 7a3 3 0 0 1 6 0"/>
                        </svg>
                        @if ($activeOrderCount > 0)
                            <span class="absolute -right-1 -top-1 grid h-5 min-w-[1.25rem] place-items-center rounded-full bg-blue-600 px-1 text-[10px] font-bold text-white ring-2 ring-white">{{ $activeOrderCount }}</span>
                        @endif
                    </a>

                    <details class="group relative">
                        <summary class="flex cursor-pointer list-none items-center gap-2 rounded-full border border-slate-200 bg-white p-1 pr-2.5 transition hover:border-blue-200 [&::-webkit-details-marker]:hidden">
                            <span class="grid h-8 w-8 place-items-center rounded-full bg-gradient-to-br from-slate-700 to-slate-900 text-xs font-bold uppercase text-white">{{ mb_substr($currentUser->name, 0, 1) }}</span>
                            <span class="hidden text-left xl:block">
                                <span class="block max-w-[7rem] truncate text-xs font-bold leading-tight text-slate-800">{{ $currentUser->name }}</span>
                                <span class="block text-[10px] leading-tight text-slate-400">{{ $roleSubtitle }}</span>
                            </span>
                            <svg class="h-4 w-4 text-slate-400 transition group-open:rotate-180" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                        </summary>
                        <div class="absolute right-0 mt-2 w-44 overflow-hidden rounded-xl border border-slate-200 bg-white p-1 shadow-xl shadow-slate-900/10">
                            @if ($panelUrl)
                                <a href="{{ $panelUrl }}" class="flex items-center gap-2 rounded-lg px-3 py-2 text-xs font-semibold text-slate-600 transition hover:bg-slate-50 hover:text-blue-600">
                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/></svg>
                                    Panel {{ $roleSubtitle }}
                                </a>
                            @endif
                            <a href="{{ $ordersUrl }}" class="flex items-center gap-2 rounded-lg px-3 py-2 text-xs font-semibold text-slate-600 transition hover:bg-slate-50 hover:text-blue-600">
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M6 7h12l1 13H5L6 7Z"/><path d="M9 7a3 3 0 0 1 6 0"/></svg>
                                Pesanan Saya
                            </a>
                            <form method="POST" action="{{ route('customer.logout') }}">
                                @csrf
                                <button type="submit" class="flex w-full items-center gap-2 rounded-lg px-3 py-2 text-xs font-semibold text-red-600 transition hover:bg-red-50">
                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M10 17l5-5-5-5"/><path d="M15 12H3"/><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/></svg>
                                    Keluar
                                </button>
                            </form>
                        </div>
                    </details>
                @else
                    <a href="{{ route('customer.login') }}" class="hidden rounded-full px-4 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-slate-50 hover:text-blue-600 sm:block">Masuk</a>
                    <a href="{{ route('customer.register') }}" class="rounded-full bg-slate-900 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-slate-800 sm:px-5">Daftar</a>
                @endauth

                <button type="button" id="mobile-menu-button" class="grid h-10 w-10 place-items-center rounded-full border border-slate-200 bg-white text-slate-600 lg:hidden" aria-label="Buka menu">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                        <path d="M4 7h16M4 12h16M4 17h16"/>
                    </svg>
                </button>
            </div>
        </div>

        <div id="mobile-menu" class="hidden border-t border-slate-100 bg-white px-5 py-3 lg:hidden">
            <div class="flex flex-col gap-1 text-sm font-semibold text-slate-600">
                <a href="{{ route('customer.home') }}" class="rounded-lg px-3 py-2.5 hover:bg-slate-50 {{ request()->routeIs('customer.home') ? 'bg-blue-50 text-blue-600' : '' }}">Beranda</a>
                <a href="{{ route('customer.services') }}" class="rounded-lg px-3 py-2.5 hover:bg-slate-50 {{ request()->routeIs('customer.services') ? 'bg-blue-50 text-blue-600' : '' }}">Cari Laundry</a>
                <a href="{{ $ordersUrl }}" class="rounded-lg px-3 py-2.5 hover:bg-slate-50 {{ request()->routeIs('customer.orders.*') ? 'bg-blue-50 text-blue-600' : '' }}">Pesanan Saya</a>
                <a href="{{ route('customer.help') }}" class="rounded-lg px-3 py-2.5 hover:bg-slate-50 {{ request()->routeIs('customer.help') ? 'bg-blue-50 text-blue-600' : '' }}">Bantuan</a>
                @guest
                    <a href="{{ route('customer.login') }}" class="rounded-lg px-3 py-2.5 hover:bg-slate-50">Masuk</a>
                @endguest
            </div>
        </div>
    </header>

    <main class="min-h-[75vh]">
        @if (session('success'))
            <div class="mx-auto mt-4 max-w-7xl px-5">
                <div class="rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700">{{ session('success') }}</div>
            </div>
        @endif

        {{ $slot }}
    </main>

    <footer class="border-t border-slate-200 bg-white">
        <div class="mx-auto max-w-7xl px-5 py-12">
            <div class="grid gap-10 md:grid-cols-2 lg:grid-cols-[1.35fr_1fr_1fr_1.2fr]">
                <div>
                    <a href="{{ route('customer.home') }}" class="flex items-center gap-2.5">
                        <span class="grid h-10 w-10 place-items-center rounded-xl bg-gradient-to-br from-blue-600 via-blue-500 to-sky-400 text-white">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="3" width="16" height="18" rx="3"/><circle cx="12" cy="13" r="4"/><path d="M8 6.5h.01M11 6.5h.01"/></svg>
                        </span>
                        <span class="text-lg font-extrabold tracking-tight text-slate-900">Laundry<span class="text-blue-600">Map</span></span>
                    </a>
                    <p class="mt-4 max-w-xs text-xs leading-6 text-slate-500">Platform ekosistem laundry multi-tenant digital terpercaya di seluruh Indonesia. Wangi, higienis, dan tepat waktu.</p>
                    <div class="mt-5 flex items-center gap-2">
                        <a href="#" class="grid h-8 w-8 place-items-center rounded-full bg-slate-100 text-slate-500 transition hover:bg-blue-600 hover:text-white" aria-label="Instagram">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4"/><path d="M17.5 6.5h.01"/></svg>
                        </a>
                        <a href="#" class="grid h-8 w-8 place-items-center rounded-full bg-slate-100 text-slate-500 transition hover:bg-blue-600 hover:text-white" aria-label="Facebook">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><path d="M14 9h3V6h-3c-2.2 0-4 1.8-4 4v2H7v3h3v6h3v-6h3l1-3h-4v-2c0-.6.4-1 1-1Z"/></svg>
                        </a>
                        <a href="#" class="grid h-8 w-8 place-items-center rounded-full bg-slate-100 text-slate-500 transition hover:bg-blue-600 hover:text-white" aria-label="TikTok">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><path d="M16 3c.3 2.2 1.8 3.7 4 4v3c-1.6 0-3-.5-4-1.3V15a6 6 0 1 1-6-6c.3 0 .7 0 1 .1v3.2a3 3 0 1 0 2 2.8V3h3Z"/></svg>
                        </a>
                    </div>
                </div>

                <div>
                    <h3 class="text-xs font-extrabold uppercase tracking-[0.15em] text-slate-900">Layanan Digital</h3>
                    <ul class="mt-4 space-y-3 text-xs text-slate-500">
                        <li><a href="{{ route('customer.services') }}" class="transition hover:text-blue-600">Katalog &amp; Layanan</a></li>
                        <li><a href="{{ route('customer.services') }}" class="transition hover:text-blue-600">Cuci Karpet &amp; Bed Cover</a></li>
                        <li><a href="{{ route('customer.services') }}" class="transition hover:text-blue-600">Lacak Langganan Kas</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-xs font-extrabold uppercase tracking-[0.15em] text-slate-900">Mitra &amp; Tenant</h3>
                    <ul class="mt-4 space-y-3 text-xs text-slate-500">
                        <li><a href="{{ route('customer.partner.register') }}" class="transition hover:text-blue-600">Portal Pemilik Outlet</a></li>
                        <li><a href="{{ route('customer.partner.register') }}" class="transition hover:text-blue-600">Pendaftaran Outlet Baru</a></li>
                        <li><a href="{{ route('customer.services') }}" class="transition hover:text-blue-600">Standarisasi SOP</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-xs font-extrabold uppercase tracking-[0.15em] text-slate-900"><a href="{{ route('customer.help') }}" class="transition hover:text-blue-600">Pusat Bantuan</a></h3>
                    <p class="mt-4 text-xs leading-6 text-slate-500">Butuh penanganan cepat pesanan Anda? Tim support LaundryMap siap membantu setiap hari.</p>
                    <a href="tel:{{ preg_replace('/[^0-9+]/', '', $supportPhone) }}" class="mt-4 inline-flex items-center gap-2 text-sm font-extrabold text-blue-600 transition hover:text-blue-700">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 5h4l2 5-2.5 1.5a12 12 0 0 0 5 5L14 14l5 2v4a2 2 0 0 1-2 2A16 16 0 0 1 2 7a2 2 0 0 1 2-2Z"/></svg>
                        {{ $supportPhone }}
                    </a>
                </div>
            </div>
        </div>

        <div class="border-t border-slate-200">
            <div class="mx-auto flex max-w-7xl flex-col gap-3 px-5 py-5 text-[11px] text-slate-500 sm:flex-row sm:items-center sm:justify-between">
                <p>&copy; {{ date('Y') }} LaundryMap Indonesia. Hak Cipta Dilindungi.</p>
                <div class="flex items-center gap-5">
                    <a href="{{ route('customer.home') }}#bantuan" class="transition hover:text-blue-600">Syarat &amp; Ketentuan</a>
                    <a href="{{ route('customer.home') }}#bantuan" class="transition hover:text-blue-600">Kebijakan Privasi</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        mobileMenuButton?.addEventListener('click', () => {
            mobileMenu?.classList.toggle('hidden');
        });
    </script>
</body>
</html>
