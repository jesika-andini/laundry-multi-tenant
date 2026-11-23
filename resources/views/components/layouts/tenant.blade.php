@php
    $portalUser = auth()->user();
    $portalTenant = $portalUser?->tenant;
    $pendingComplaints = $portalUser?->tenant_id
        ? \App\Models\Complaint::query()
            ->withoutGlobalScope('tenant')
            ->where('tenant_id', $portalUser->tenant_id)
            ->where('status', 'Menunggu')
            ->count()
        : 0;
    $outletCode = 'LNDR-TBT-'.str_pad((string) ($portalTenant?->id ?? 0), 2, '0', STR_PAD_LEFT);
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Dashboard Tenant' }} — LaundryMap</title>
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
<body class="bg-[#f5f7fb] font-sans text-slate-800 antialiased">
    <div class="min-h-screen lg:flex">
        <aside class="w-full shrink-0 border-b border-slate-200 bg-white lg:sticky lg:top-0 lg:h-screen lg:w-[268px] lg:border-b-0 lg:border-r">
            <div class="flex h-full flex-col">
                <div class="flex items-center gap-3 px-5 py-5">
                    <span class="grid h-10 w-10 place-items-center rounded-xl bg-blue-600 text-white shadow-lg shadow-blue-600/20">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="3" width="16" height="18" rx="3"/><circle cx="12" cy="13" r="4"/><path d="M8 6.5h.01M11 6.5h.01"/></svg>
                    </span>
                    <div>
                        <p class="text-base font-extrabold tracking-tight text-slate-950">Laundry<span class="text-blue-600">MAP</span></p>
                        <p class="text-[8px] font-extrabold uppercase tracking-[0.18em] text-slate-400">Multi-Tenant Laundry</p>
                    </div>
                </div>

                <div class="px-4">
                    <div class="rounded-xl border border-slate-200 bg-slate-50/70 px-3.5 py-3">
                        <p class="text-[8px] font-extrabold uppercase tracking-[0.14em] text-slate-400">Outlet Aktif</p>
                        <div class="mt-1 flex items-center justify-between gap-2">
                            <div class="min-w-0">
                                <p class="truncate text-xs font-extrabold text-slate-900">{{ $portalTenant?->name ?? 'Tenant Laundry' }}</p>
                                <p class="mt-0.5 truncate text-[9px] text-slate-500">{{ $portalTenant?->address ?: 'Alamat outlet belum diisi' }}</p>
                            </div>
                            <svg class="h-4 w-4 shrink-0 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m7 15 5 5 5-5M7 9l5-5 5 5"/></svg>
                        </div>
                    </div>
                </div>

                <nav class="mt-4 space-y-1 px-3">
                    <a href="{{ route('tenant.dashboard') }}" class="flex items-center gap-3 rounded-lg px-3.5 py-3 text-xs font-bold transition {{ request()->routeIs('tenant.dashboard') ? 'bg-blue-600 text-white shadow-md shadow-blue-600/20' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-700' }}">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9"><rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/></svg>
                        Ringkasan
                    </a>
                    <a href="{{ route('tenant.dashboard') }}#kasir" class="flex items-center gap-3 rounded-lg px-3.5 py-3 text-xs font-semibold text-slate-600 transition hover:bg-slate-50 hover:text-blue-700">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9"><rect x="3" y="4" width="18" height="16" rx="2"/><path d="M3 9h18M8 14h3"/></svg>
                        Kasir POS
                        <span class="ml-auto rounded-full bg-slate-100 px-1.5 py-0.5 text-[7px] font-extrabold uppercase tracking-wide text-slate-400">Segera</span>
                    </a>
                    <a href="{{ route('tenant.dashboard') }}#antrean" class="flex items-center gap-3 rounded-lg px-3.5 py-3 text-xs font-semibold text-slate-600 transition hover:bg-slate-50 hover:text-blue-700">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9"><path d="M4 7h16M4 12h10M4 17h7"/><path d="m17 15 2 2 3-3"/></svg>
                        Proses Cuci &amp; Setrika
                    </a>
                    <a href="{{ route('tenant.dashboard') }}#pendapatan" class="flex items-center gap-3 rounded-lg px-3.5 py-3 text-xs font-semibold text-slate-600 transition hover:bg-slate-50 hover:text-blue-700">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9"><path d="M4 19V9M10 19V5M16 19v-7M22 19H2"/></svg>
                        Laporan Omzet
                    </a>
                    <a href="{{ route('tenant.complaints.index') }}" class="flex items-center gap-3 rounded-lg px-3.5 py-3 text-xs font-bold transition {{ request()->routeIs('tenant.complaints.*') ? 'bg-blue-600 text-white shadow-md shadow-blue-600/20' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-700' }}">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9"><path d="M21 15a4 4 0 0 1-4 4H8l-5 3V6a3 3 0 0 1 3-3h11a4 4 0 0 1 4 4v8Z"/><path d="M8 9h8M8 13h5"/></svg>
                        Pengaduan Komplain
                        @if ($pendingComplaints > 0)
                            <span class="ml-auto grid h-5 min-w-[1.25rem] place-items-center rounded-full bg-amber-400 px-1 text-[9px] font-extrabold text-amber-950">{{ $pendingComplaints }}</span>
                        @endif
                    </a>
                </nav>

                <div class="mt-auto p-4">
                    <div class="flex items-center gap-2 rounded-lg bg-slate-50 px-3 py-2.5 text-[10px] font-semibold text-slate-600">
                        <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                        Status: Kasir Siap
                    </div>
                    <form method="POST" action="{{ route('customer.logout') }}" class="mt-2">
                        @csrf
                        <button type="submit" class="flex w-full items-center gap-2 rounded-lg px-3 py-2.5 text-[10px] font-bold text-rose-600 transition hover:bg-rose-50">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10 17l5-5-5-5"/><path d="M15 12H3"/><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/></svg>
                            Keluar Portal
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <div class="min-w-0 flex-1">
            <header class="sticky top-0 z-40 border-b border-slate-200 bg-white/95 backdrop-blur-xl">
                <div class="flex flex-wrap items-center justify-between gap-3 px-4 py-3 sm:px-6 lg:px-8">
                    <div class="flex items-center gap-2">
                        <span class="rounded-full border border-blue-100 bg-blue-50 px-3 py-1.5 text-[9px] font-extrabold uppercase tracking-[0.08em] text-blue-700">ID Outlet: {{ $outletCode }}</span>
                        <span class="hidden rounded-full bg-emerald-50 px-2.5 py-1.5 text-[8px] font-extrabold uppercase tracking-wide text-emerald-700 sm:inline">Tenant Aktif</span>
                    </div>

                    <div class="flex items-center gap-2 sm:gap-3">
                        <span class="hidden items-center gap-2 rounded-lg border border-slate-200 bg-white px-3 py-2 text-[10px] font-bold text-slate-600 sm:flex">
                            <svg class="h-3.5 w-3.5 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9"><path d="M4 21V8l8-5 8 5v13"/><path d="M9 21v-6h6v6"/></svg>
                            Operator / Tenant
                        </span>
                        <a href="{{ route('tenant.complaints.index') }}" class="relative grid h-9 w-9 place-items-center rounded-full border border-slate-200 bg-white text-slate-500 transition hover:border-blue-200 hover:text-blue-600" title="Pengaduan komplain">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M18 8a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9"/><path d="M10 21h4"/></svg>
                            @if ($pendingComplaints > 0)
                                <span class="absolute -right-0.5 -top-0.5 grid h-4 min-w-[1rem] place-items-center rounded-full bg-amber-400 px-1 text-[8px] font-extrabold text-amber-950 ring-2 ring-white">{{ $pendingComplaints }}</span>
                            @endif
                        </a>
                        <details class="group relative">
                            <summary class="flex cursor-pointer list-none items-center gap-2 rounded-full border border-slate-200 bg-white p-1 pr-2 [&::-webkit-details-marker]:hidden">
                                <span class="grid h-7 w-7 place-items-center rounded-full bg-gradient-to-br from-slate-700 to-slate-900 text-[10px] font-bold uppercase text-white">{{ mb_substr($portalUser?->name ?? 'T', 0, 1) }}</span>
                                <span class="hidden text-left sm:block">
                                    <span class="block max-w-[9rem] truncate text-[10px] font-extrabold leading-tight text-slate-800">{{ $portalUser?->name }}</span>
                                    <span class="block text-[8px] leading-tight text-slate-400">Admin Tenant</span>
                                </span>
                                <svg class="h-3.5 w-3.5 text-slate-400 transition group-open:rotate-180" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m6 9 6 6 6-6"/></svg>
                            </summary>
                            <div class="absolute right-0 mt-2 w-44 overflow-hidden rounded-xl border border-slate-200 bg-white p-1 shadow-xl shadow-slate-900/10">
                                <a href="{{ route('customer.home') }}" class="flex items-center gap-2 rounded-lg px-3 py-2 text-[10px] font-semibold text-slate-600 transition hover:bg-slate-50 hover:text-blue-600">Lihat situs pelanggan</a>
                                <form method="POST" action="{{ route('customer.logout') }}">
                                    @csrf
                                    <button type="submit" class="flex w-full items-center gap-2 rounded-lg px-3 py-2 text-[10px] font-semibold text-rose-600 transition hover:bg-rose-50">Keluar</button>
                                </form>
                            </div>
                        </details>
                    </div>
                </div>
            </header>

            <main class="mx-auto max-w-[1600px] px-4 py-5 sm:px-6 lg:px-8">
                @if (session('success'))
                    <div class="mb-4 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-xs font-semibold text-emerald-700">{{ session('success') }}</div>
                @endif
                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>
