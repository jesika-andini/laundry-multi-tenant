<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LaundryMap — Laundry Lebih Mudah, Tinggal Pilih</title>
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
    <style>
        html { scroll-behavior: smooth; }
        .hero-grid {
            background-image:
                linear-gradient(rgba(37, 99, 235, .045) 1px, transparent 1px),
                linear-gradient(90deg, rgba(37, 99, 235, .045) 1px, transparent 1px);
            background-size: 42px 42px;
        }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="bg-[#f6f8fc] font-sans text-slate-900 antialiased">
    <?php
        $user = auth()->user();
        $roleLabel = match ($user?->role) {
            'tenant_admin', 'tenant' => 'Mitra Aktif',
            'super_admin', 'admin' => 'Super Admin',
            default => 'Pelanggan Aktif',
        };
        $panelUrl = match ($user?->role) {
            'super_admin', 'admin' => route('admin.dashboard'),
            'tenant_admin', 'tenant' => route('tenant.dashboard'),
            default => null,
        };
        $roleSubtitle = match ($user?->role) {
            'tenant_admin', 'tenant' => 'Mitra',
            'super_admin', 'admin' => 'Super Admin',
            default => 'Customer',
        };
        $ordersUrl = auth()->check() ? route('customer.orders.index') : route('customer.login');
        $supportPhone = $tenants->first(fn ($tenant) => filled($tenant->phone))?->phone ?? '-';
        $supportEmail = $tenants->first(fn ($tenant) => filled($tenant->email))?->email ?? 'cs@laundry.id';
        $laundryPhotos = [
            'https://images.unsplash.com/photo-1545173168-9f1947eebb7f?auto=format&fit=crop&w=900&q=80',
            'https://images.unsplash.com/photo-1517677208171-0bc6725a3e60?auto=format&fit=crop&w=900&q=80',
            'https://images.unsplash.com/photo-1582735689369-4fe89db7114c?auto=format&fit=crop&w=900&q=80',
            'https://images.unsplash.com/photo-1610557892470-55d9e80c0bce?auto=format&fit=crop&w=900&q=80',
        ];
    ?>

    <header class="sticky top-0 z-50 border-b border-slate-200/70 bg-white/95 backdrop-blur-xl">
        <div class="mx-auto flex max-w-7xl items-center gap-5 px-5 py-3.5">
            <a href="<?php echo e(route('customer.home')); ?>" class="flex shrink-0 items-center gap-2.5">
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
                <a href="<?php echo e(route('customer.home')); ?>" class="rounded-lg px-3 py-2 text-sm font-semibold text-blue-600">Beranda</a>
                <a href="<?php echo e(route('customer.services')); ?>" class="rounded-lg px-3 py-2 text-sm font-medium text-slate-600 transition hover:bg-slate-50 hover:text-blue-600">Cari Laundry</a>
                <a href="<?php echo e(auth()->check() ? route('customer.orders.index') : route('customer.login')); ?>" class="rounded-lg px-3 py-2 text-sm font-medium text-slate-600 transition hover:bg-slate-50 hover:text-blue-600">Pesanan Saya</a>
                <a href="<?php echo e(route('customer.help')); ?>" class="rounded-lg px-3 py-2 text-sm font-medium text-slate-600 transition hover:bg-slate-50 hover:text-blue-600">Bantuan</a>
            </nav>

            <div class="ml-auto flex items-center gap-2 sm:gap-2.5">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->check()): ?>
                    <span class="hidden items-center gap-1.5 rounded-full bg-blue-50 px-3 py-1.5 text-xs font-semibold text-blue-700 sm:flex">
                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                        <?php echo e($roleLabel); ?>

                    </span>
                    <button type="button" class="relative hidden h-10 w-10 place-items-center rounded-full border border-slate-200 bg-white text-slate-500 transition hover:border-blue-200 hover:text-blue-600 sm:grid" title="Notifikasi">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 8a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9"/>
                            <path d="M10 21h4"/>
                        </svg>
                        <span class="absolute right-2 top-2 h-2 w-2 rounded-full bg-orange-400 ring-2 ring-white"></span>
                    </button>
                    <a href="<?php echo e($ordersUrl); ?>" class="relative grid h-10 w-10 place-items-center rounded-full border border-slate-200 bg-white text-slate-500 transition hover:border-blue-200 hover:text-blue-600" title="Pesanan aktif">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M6 7h12l1 13H5L6 7Z"/>
                            <path d="M9 7a3 3 0 0 1 6 0"/>
                        </svg>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($activeOrderCount > 0): ?>
                            <span class="absolute -right-1 -top-1 grid h-5 min-w-[1.25rem] place-items-center rounded-full bg-blue-600 px-1 text-[10px] font-bold text-white ring-2 ring-white"><?php echo e($activeOrderCount); ?></span>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </a>
                    <details class="group relative">
                        <summary class="flex cursor-pointer list-none items-center gap-2 rounded-full border border-slate-200 bg-white p-1 pr-2.5 transition hover:border-blue-200 [&::-webkit-details-marker]:hidden">
                            <span class="grid h-8 w-8 place-items-center rounded-full bg-gradient-to-br from-slate-700 to-slate-900 text-xs font-bold uppercase text-white"><?php echo e(mb_substr($user->name, 0, 1)); ?></span>
                            <span class="hidden text-left xl:block">
                                <span class="block max-w-[7rem] truncate text-xs font-bold leading-tight text-slate-800"><?php echo e($user->name); ?></span>
                                <span class="block text-[10px] leading-tight text-slate-400"><?php echo e($roleSubtitle); ?></span>
                            </span>
                            <svg class="h-4 w-4 text-slate-400 transition group-open:rotate-180" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                        </summary>
                        <div class="absolute right-0 mt-2 w-44 overflow-hidden rounded-xl border border-slate-200 bg-white p-1 shadow-xl shadow-slate-900/10">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($panelUrl): ?>
                                <a href="<?php echo e($panelUrl); ?>" class="flex items-center gap-2 rounded-lg px-3 py-2 text-xs font-semibold text-slate-600 transition hover:bg-slate-50 hover:text-blue-600">
                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/></svg>
                                    Panel <?php echo e($roleSubtitle); ?>

                                </a>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <a href="<?php echo e($ordersUrl); ?>" class="flex items-center gap-2 rounded-lg px-3 py-2 text-xs font-semibold text-slate-600 transition hover:bg-slate-50 hover:text-blue-600">
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M6 7h12l1 13H5L6 7Z"/><path d="M9 7a3 3 0 0 1 6 0"/></svg>
                                Pesanan Saya
                            </a>
                            <form method="POST" action="<?php echo e(route('customer.logout')); ?>">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="flex w-full items-center gap-2 rounded-lg px-3 py-2 text-xs font-semibold text-red-600 transition hover:bg-red-50">
                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M10 17l5-5-5-5"/><path d="M15 12H3"/><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/></svg>
                                    Keluar
                                </button>
                            </form>
                        </div>
                    </details>
                <?php else: ?>
                    <a href="<?php echo e(route('customer.login')); ?>" class="hidden rounded-full px-4 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-slate-50 hover:text-blue-600 sm:block">Masuk</a>
                    <a href="<?php echo e(route('customer.register')); ?>" class="rounded-full bg-slate-900 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-slate-800 sm:px-5">Daftar</a>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <button type="button" id="mobile-menu-button" class="grid h-10 w-10 place-items-center rounded-full border border-slate-200 bg-white text-slate-600 lg:hidden" aria-label="Buka menu">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                        <path d="M4 7h16M4 12h16M4 17h16"/>
                    </svg>
                </button>
            </div>
        </div>

        <div id="mobile-menu" class="hidden border-t border-slate-100 bg-white px-5 py-3 lg:hidden">
            <div class="flex flex-col gap-1 text-sm font-semibold text-slate-600">
                <a href="<?php echo e(route('customer.home')); ?>" class="rounded-lg bg-blue-50 px-3 py-2.5 text-blue-600">Beranda</a>
                <a href="<?php echo e(route('customer.services')); ?>" class="rounded-lg px-3 py-2.5 hover:bg-slate-50">Cari Laundry</a>
                <a href="<?php echo e(auth()->check() ? route('customer.orders.index') : route('customer.login')); ?>" class="rounded-lg px-3 py-2.5 hover:bg-slate-50">Pesanan Saya</a>
                <a href="<?php echo e(route('customer.help')); ?>" class="rounded-lg px-3 py-2.5 hover:bg-slate-50">Bantuan</a>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->guest()): ?>
                    <a href="<?php echo e(route('customer.login')); ?>" class="rounded-lg px-3 py-2.5 hover:bg-slate-50">Masuk</a>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
    </header>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
        <div class="mx-auto mt-4 max-w-7xl px-5">
            <div class="rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700"><?php echo e(session('success')); ?></div>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <main>
        <section class="hero-grid relative overflow-hidden bg-gradient-to-br from-[#eff6ff] via-[#f8fbff] to-[#eef7ff]">
            <div class="pointer-events-none absolute -left-32 top-16 h-80 w-80 rounded-full bg-blue-300/20 blur-3xl"></div>
            <div class="pointer-events-none absolute right-0 top-0 h-96 w-96 rounded-full bg-cyan-300/20 blur-3xl"></div>

            <div class="relative mx-auto max-w-7xl px-5 pb-28 pt-14 lg:pt-20">
                <div class="grid items-center gap-12 lg:grid-cols-[1.04fr_0.96fr]">
                    <div>
                        <div class="inline-flex items-center gap-2 rounded-full border border-blue-200/80 bg-white/80 px-4 py-2 text-[11px] font-bold uppercase tracking-[0.14em] text-blue-600 shadow-sm">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <path d="m12 3 1.7 5.3L19 10l-5.3 1.7L12 17l-1.7-5.3L5 10l5.3-1.7L12 3Z"/>
                            </svg>
                            Platform Multi-Tenant Laundry
                        </div>

                        <h1 class="mt-6 max-w-2xl text-4xl font-extrabold leading-[1.08] tracking-tight text-slate-950 sm:text-5xl lg:text-[3.4rem]">
                            Laundry Lebih Mudah,
                            <span class="block text-blue-600">Tinggal Pilih.</span>
                        </h1>
                        <p class="mt-5 max-w-xl text-base leading-7 text-slate-500 sm:text-[17px]">
                            Temukan dan pesan layanan laundry terpercaya di sekitarmu dari berbagai mitra outlet resmi dalam satu aplikasi praktis. Bebas pilih tarif, wangi, dan jenis penanganan.
                        </p>

                        <div class="mt-8 flex flex-wrap gap-3">
                            <a href="#daftar-laundry" class="inline-flex items-center gap-2 rounded-xl bg-blue-600 px-5 py-3.5 text-sm font-bold text-white shadow-lg shadow-blue-600/25 transition hover:-translate-y-0.5 hover:bg-blue-700">
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="11" cy="11" r="7"/>
                                    <path d="m20 20-3.5-3.5"/>
                                </svg>
                                Cari Laundry Terdekat
                            </a>
                            <a href="<?php echo e(auth()->check() ? route('customer.orders.index') : route('customer.login')); ?>" class="inline-flex items-center gap-2 rounded-xl border border-blue-200 bg-white px-5 py-3.5 text-sm font-bold text-blue-700 shadow-sm transition hover:border-blue-300 hover:bg-blue-50">
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M6 7h12l1 13H5L6 7Z"/>
                                    <path d="M9 7a3 3 0 0 1 6 0"/>
                                </svg>
                                Lihat Pesanan Saya
                            </a>
                        </div>

                        <div class="mt-10 grid max-w-lg grid-cols-3 gap-4 border-t border-blue-100 pt-6">
                            <div>
                                <p class="text-2xl font-extrabold tracking-tight text-slate-950 sm:text-3xl"><?php echo e(number_format($totalTenants)); ?><span class="text-blue-600">+</span></p>
                                <p class="mt-1 text-xs font-medium text-slate-500">Mitra Outlet</p>
                            </div>
                            <div class="border-l border-blue-100 pl-4">
                                <p class="text-2xl font-extrabold tracking-tight text-slate-950 sm:text-3xl"><?php echo e(number_format($totalServices)); ?></p>
                                <p class="mt-1 text-xs font-medium text-slate-500">Layanan Aktif</p>
                            </div>
                            <div class="border-l border-blue-100 pl-4">
                                <p class="text-2xl font-extrabold tracking-tight text-slate-950 sm:text-3xl"><?php echo e(number_format($totalCustomers)); ?></p>
                                <p class="mt-1 text-xs font-medium text-slate-500">Pelanggan Terdaftar</p>
                            </div>
                        </div>
                    </div>

                    <div class="relative mx-auto w-full max-w-md lg:ml-auto">
                        <div class="absolute -right-3 -top-3 h-24 w-24 rounded-full bg-blue-300/30 blur-2xl"></div>
                        <article class="relative overflow-hidden rounded-[28px] border-[5px] border-white bg-white shadow-2xl shadow-blue-950/15">
                            <div class="relative h-72 overflow-hidden bg-gradient-to-br from-blue-900 via-blue-700 to-cyan-500">
                                <img src="<?php echo e($laundryPhotos[0]); ?>" alt="Laundry unggulan" class="absolute inset-0 h-full w-full object-cover opacity-90" loading="eager" onerror="this.style.display='none'">
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-slate-950/15 to-slate-950/5"></div>
                                <div class="absolute left-4 right-4 top-4 flex items-center justify-between">
                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-white/95 px-3 py-1.5 text-[11px] font-bold text-slate-700 shadow-sm backdrop-blur">
                                        <svg class="h-3.5 w-3.5 text-blue-600" viewBox="0 0 24 24" fill="currentColor"><path d="m12 3 2.1 5.9L20 11l-5.9 2.1L12 19l-2.1-5.9L4 11l5.9-2.1L12 3Z"/></svg>
                                        <?php echo e($featuredTenant?->active_services_count ?? 0); ?> Layanan Aktif
                                    </span>
                                    <span class="rounded-full bg-emerald-500 px-3 py-1 text-[10px] font-bold uppercase tracking-wide text-white">Aktif</span>
                                </div>
                                <div class="absolute bottom-4 left-4 right-4 text-white">
                                    <p class="text-[10px] font-bold uppercase tracking-[0.22em] text-white/70">Mitra Unggulan</p>
                                    <h2 class="mt-1 text-2xl font-extrabold tracking-tight"><?php echo e($featuredTenant?->name ?? 'LaundryMap Partner'); ?></h2>
                                    <p class="mt-1 line-clamp-1 text-xs text-white/80"><?php echo e($featuredTenant?->address ?? 'Mitra laundry terpercaya di sekitarmu.'); ?></p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3 p-4">
                                <div class="grid h-11 w-11 shrink-0 place-items-center rounded-xl bg-blue-50 text-sm font-extrabold uppercase text-blue-700">
                                    <?php echo e($featuredTenant ? mb_substr($featuredTenant->name, 0, 1) : 'L'); ?>

                                </div>
                                <div class="min-w-0 flex-1">
                                    <p class="truncate text-sm font-bold text-slate-800"><?php echo e($featuredTenant?->owner ?: ($featuredTenant?->name ?? 'Mitra LaundryMap')); ?></p>
                                    <p class="mt-0.5 flex items-center gap-1 text-[11px] text-slate-500">
                                        <svg class="h-3.5 w-3.5 text-blue-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 5-8 11-8 11S4 15 4 10a8 8 0 1 1 16 0Z"/><circle cx="12" cy="10" r="2.5"/></svg>
                                        <?php echo e($featuredTenant?->address ?? 'Lokasi mitra'); ?>

                                    </p>
                                </div>
                                <a href="<?php echo e($featuredTenant ? route('customer.tenant.show', $featuredTenant) : route('customer.services')); ?>" class="rounded-lg bg-blue-600 px-3.5 py-2 text-xs font-bold text-white transition hover:bg-blue-700">Lihat</a>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </section>

        <div class="relative z-20 mx-auto -mt-16 max-w-5xl px-5">
            <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('home-search', ['service-names' => $serviceNames]);

$__keyOuter = $__key ?? null;

$__key = null;
$__componentSlots = [];

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-2441314065-0', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key, $__componentSlots);

echo $__html;

unset($__html);
unset($__key);
$__key = $__keyOuter;
unset($__keyOuter);
unset($__name);
unset($__params);
unset($__componentSlots);
unset($__split);
?>
        </div>

        <section class="mx-auto max-w-7xl px-5 pt-24">
            <div class="flex flex-wrap items-end justify-between gap-5">
                <div>
                    <p class="text-[11px] font-extrabold uppercase tracking-[0.18em] text-blue-600">Alur Pemesanan Simpel</p>
                    <h2 class="mt-2 text-3xl font-extrabold tracking-tight text-slate-950 sm:text-4xl">5 Langkah Mudah Laundry Beres</h2>
                </div>
            </div>

            <div class="mt-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-5">
                <article class="group rounded-2xl border border-slate-200/80 bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:border-blue-200 hover:shadow-lg hover:shadow-blue-950/5">
                    <div class="flex items-center justify-between">
                        <span class="grid h-11 w-11 place-items-center rounded-xl bg-blue-50 text-blue-600">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 5-8 11-8 11S4 15 4 10a8 8 0 1 1 16 0Z"/><circle cx="12" cy="10" r="2.5"/></svg>
                        </span>
                        <span class="text-[10px] font-bold uppercase tracking-wide text-slate-400">Langkah 01</span>
                    </div>
                    <h3 class="mt-4 text-sm font-extrabold text-slate-900">Pilih Outlet</h3>
                    <p class="mt-2 text-xs leading-5 text-slate-500">Bandingkan rating pelanggan, tarif per kg, jarak tempuh, dan opsi mesin cuci higienis mitra terdekat.</p>
                </article>

                <article class="group rounded-2xl border border-slate-200/80 bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:border-blue-200 hover:shadow-lg hover:shadow-blue-950/5">
                    <div class="flex items-center justify-between">
                        <span class="grid h-11 w-11 place-items-center rounded-xl bg-sky-50 text-sky-600">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="m12 3 9 5-9 5-9-5 9-5Z"/><path d="m3 12 9 5 9-5"/><path d="m3 16 9 5 9-5"/></svg>
                        </span>
                        <span class="text-[10px] font-bold uppercase tracking-wide text-slate-400">Langkah 02</span>
                    </div>
                    <h3 class="mt-4 text-sm font-extrabold text-slate-900">Pilih Layanan</h3>
                    <p class="mt-2 text-xs leading-5 text-slate-500">Pilih paket kiloan wangi, cuci setrika, deep-clean seprai, karpet, atau bed cover ekspres sesuai kebutuhan.</p>
                </article>

                <article class="group rounded-2xl border border-slate-200/80 bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:border-blue-200 hover:shadow-lg hover:shadow-blue-950/5">
                    <div class="flex items-center justify-between">
                        <span class="grid h-11 w-11 place-items-center rounded-xl bg-indigo-50 text-indigo-600">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="6" y="4" width="12" height="17" rx="2"/><path d="M9 4.5V3h6v1.5M9 9h6M9 13h6M9 17h4"/></svg>
                        </span>
                        <span class="text-[10px] font-bold uppercase tracking-wide text-slate-400">Langkah 03</span>
                    </div>
                    <h3 class="mt-4 text-sm font-extrabold text-slate-900">Buat Pesanan</h3>
                    <p class="mt-2 text-xs leading-5 text-slate-500">Tentukan metode antar-jemput langsung ke pintu kos atau rumah, atau drop-off mandiri ke outlet terdekat.</p>
                </article>

                <article class="group rounded-2xl border border-slate-200/80 bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:border-blue-200 hover:shadow-lg hover:shadow-blue-950/5">
                    <div class="flex items-center justify-between">
                        <span class="grid h-11 w-11 place-items-center rounded-xl bg-violet-50 text-violet-600">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="M3 10h18M7 15h3"/></svg>
                        </span>
                        <span class="text-[10px] font-bold uppercase tracking-wide text-slate-400">Langkah 04</span>
                    </div>
                    <h3 class="mt-4 text-sm font-extrabold text-slate-900">Bayar Aman</h3>
                    <p class="mt-2 text-xs leading-5 text-slate-500">Konfirmasi timbangan aktual via notifikasi digital, lalu bayar non-tunai dengan QRIS.</p>
                </article>

                <article class="group rounded-2xl border border-slate-200/80 bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:border-blue-200 hover:shadow-lg hover:shadow-blue-950/5">
                    <div class="flex items-center justify-between">
                        <span class="grid h-11 w-11 place-items-center rounded-xl bg-teal-50 text-teal-600">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M3 7h11v10H3z"/><path d="M14 10h4l3 3v4h-7z"/><circle cx="7" cy="18" r="1.7"/><circle cx="17.5" cy="18" r="1.7"/></svg>
                        </span>
                        <span class="text-[10px] font-bold uppercase tracking-wide text-slate-400">Langkah 05</span>
                    </div>
                    <h3 class="mt-4 text-sm font-extrabold text-slate-900">Pantau Live</h3>
                    <p class="mt-2 text-xs leading-5 text-slate-500">Pantau status cucian secara real-time: dicuci, dikeringkan, disetrika, siap diambil, hingga kurir mengantar pesanan.</p>
                </article>
            </div>
        </section>

        <section id="daftar-laundry" class="mx-auto max-w-7xl px-5 pt-16">
            <div class="flex flex-wrap items-center justify-between gap-5">
                <div class="flex items-center gap-3">
                    <span class="grid h-11 w-11 place-items-center rounded-xl bg-blue-600 text-white shadow-lg shadow-blue-600/20">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 5-8 11-8 11S4 15 4 10a8 8 0 1 1 16 0Z"/><circle cx="12" cy="10" r="2.5"/></svg>
                    </span>
                    <div>
                        <p class="text-[10px] font-extrabold uppercase tracking-[0.18em] text-blue-600">Area Mitra Kami</p>
                        <h2 class="mt-1 text-2xl font-extrabold tracking-tight text-slate-950 sm:text-3xl">Pilihan Laundry Terdekat &amp; Populer</h2>
                    </div>
                </div>

                <div class="no-scrollbar flex max-w-full items-center gap-2 overflow-x-auto rounded-full bg-white p-1.5 shadow-sm ring-1 ring-slate-200/70">
                    <a href="<?php echo e(route('customer.services')); ?>" class="shrink-0 rounded-full bg-blue-600 px-4 py-2 text-[11px] font-bold text-white shadow-sm">Semua Mitra (<?php echo e($totalTenants); ?>)</a>
                    <a href="<?php echo e(route('customer.services', ['sort' => 'services'])); ?>" class="shrink-0 rounded-full px-4 py-2 text-[11px] font-semibold text-slate-500 transition hover:bg-slate-50 hover:text-blue-600">Layanan Terbanyak</a>
                    <a href="<?php echo e(route('customer.services', ['sort' => 'price'])); ?>" class="shrink-0 rounded-full px-4 py-2 text-[11px] font-semibold text-slate-500 transition hover:bg-slate-50 hover:text-blue-600">Harga Termurah</a>
                    <a href="<?php echo e(route('customer.services', ['sort' => 'newest'])); ?>" class="shrink-0 rounded-full px-4 py-2 text-[11px] font-semibold text-slate-500 transition hover:bg-slate-50 hover:text-blue-600">Mitra Terbaru</a>
                </div>
            </div>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($tenants->isNotEmpty()): ?>
                <div class="mt-7 grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $tenants->take(4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tenant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <?php
                            $photo = $laundryPhotos[$loop->index % count($laundryPhotos)];
                            $firstService = $tenant->services->first();
                        ?>
                        <article class="group flex flex-col overflow-hidden rounded-2xl border border-slate-200/80 bg-white shadow-sm transition hover:-translate-y-1 hover:border-blue-200 hover:shadow-xl hover:shadow-blue-950/10">
                            <div class="relative h-44 shrink-0 overflow-hidden bg-gradient-to-br from-blue-700 via-blue-500 to-cyan-400">
                                <img src="<?php echo e($photo); ?>" alt="<?php echo e($tenant->name); ?>" class="h-full w-full object-cover transition duration-500 group-hover:scale-105" loading="lazy" onerror="this.style.display='none'">
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/70 via-slate-950/5 to-transparent"></div>
                                <span class="absolute left-3 top-3 inline-flex items-center gap-1 rounded-full bg-white/95 px-2.5 py-1 text-[10px] font-bold text-slate-700 shadow-sm">
                                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                    <?php echo e($tenant->status); ?>

                                </span>
                                <span class="absolute right-3 top-3 rounded-full bg-slate-950/55 px-2.5 py-1 text-[10px] font-bold text-white backdrop-blur"><?php echo e($tenant->active_services_count); ?> layanan</span>
                                <div class="absolute bottom-3 left-3 right-3 flex items-end justify-between gap-2 text-white">
                                    <span class="inline-flex items-center gap-1 text-[10px] font-semibold text-white/85">
                                        <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 5-8 11-8 11S4 15 4 10a8 8 0 1 1 16 0Z"/><circle cx="12" cy="10" r="2.5"/></svg>
                                        <?php echo e($tenant->address); ?>

                                    </span>
                                </div>
                            </div>

                            <div class="flex flex-1 flex-col p-5">
                                <div class="flex items-start justify-between gap-2">
                                    <h3 class="line-clamp-1 text-lg font-extrabold tracking-tight text-slate-950"><?php echo e($tenant->name); ?></h3>
                                    <span class="inline-flex shrink-0 items-center gap-1 rounded-md bg-amber-50 px-2 py-1 text-[10px] font-bold text-amber-700">
                                        <svg class="h-3 w-3" viewBox="0 0 24 24" fill="currentColor"><path d="m12 3 2.1 5.9L20 11l-5.9 2.1L12 19l-2.1-5.9L4 11l5.9-2.1L12 3Z"/></svg>
                                        <?php echo e($tenant->active_services_count); ?>

                                    </span>
                                </div>
                                <p class="mt-1 line-clamp-1 text-xs text-slate-500"><?php echo e($tenant->description ?: 'Mitra laundry resmi LaundryMap.'); ?></p>

                                <div class="mt-3 flex flex-wrap gap-1.5">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $tenant->services->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                        <span class="rounded-md bg-blue-50 px-2 py-1 text-[10px] font-bold text-blue-700"><?php echo e($service->name); ?></span>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                        <span class="rounded-md bg-slate-100 px-2 py-1 text-[10px] font-semibold text-slate-500">Layanan belum tersedia</span>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>

                                <div class="mt-auto flex items-end justify-between gap-3 border-t border-slate-100 pt-4">
                                    <div>
                                        <p class="text-[9px] font-bold uppercase tracking-[0.14em] text-slate-400">Mulai dari</p>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($tenant->min_price !== null): ?>
                                            <p class="mt-0.5 text-lg font-extrabold tracking-tight text-slate-950">
                                                Rp<?php echo e(number_format((float) $tenant->min_price, 0, ',', '.')); ?>

                                                <span class="text-[10px] font-semibold text-slate-400">/<?php echo e($firstService?->unit ?? 'kg'); ?></span>
                                            </p>
                                        <?php else: ?>
                                            <p class="mt-0.5 text-sm font-bold text-slate-500">Hubungi mitra</p>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </div>
                                    <a href="<?php echo e(route('customer.tenant.show', $tenant)); ?>" class="rounded-lg bg-blue-600 px-3.5 py-2 text-[11px] font-bold text-white shadow-sm transition hover:bg-blue-700">Lihat Laundry</a>
                                </div>
                            </div>
                        </article>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </div>
            <?php else: ?>
                <div class="mt-7 rounded-2xl border border-dashed border-slate-300 bg-white px-6 py-14 text-center">
                    <div class="mx-auto grid h-14 w-14 place-items-center rounded-2xl bg-blue-50 text-blue-600">
                        <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4.5 9.5h15l-1.2 8.2a2 2 0 0 1-2 1.8H7.7a2 2 0 0 1-2-1.8L4.5 9.5Z"/><path d="M7 9.5V7a5 5 0 0 1 10 0v2.5"/></svg>
                    </div>
                    <h3 class="mt-4 text-lg font-bold text-slate-900">Belum ada mitra aktif</h3>
                    <p class="mt-2 text-sm text-slate-500">Data laundry yang sudah diaktifkan melalui panel Admin akan tampil otomatis di sini.</p>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </section>

        <section class="mt-16 border-y border-slate-200/70 bg-white py-16">
            <div class="mx-auto max-w-7xl px-5">
                <div class="mx-auto max-w-2xl text-center">
                    <p class="text-[11px] font-extrabold uppercase tracking-[0.18em] text-blue-600">Solusi Ekosistem Terpadu</p>
                    <h2 class="mt-2 text-3xl font-extrabold tracking-tight text-slate-950 sm:text-4xl">Kenapa Menggunakan LaundryMap?</h2>
                    <p class="mt-3 text-sm leading-6 text-slate-500">Standar operasional modern yang memberikan transparansi penuh untuk konsumen dan kemudahan pengelolaan bagi mitra laundry.</p>
                </div>

                <div class="mt-10 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                    <article class="rounded-2xl border border-slate-200/80 bg-gradient-to-b from-white to-slate-50/70 p-6 transition hover:border-blue-200 hover:shadow-lg hover:shadow-blue-950/5">
                        <span class="grid h-12 w-12 place-items-center rounded-xl bg-blue-600 text-white shadow-lg shadow-blue-600/20">
                            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="m15.5 8.5-2 5-5 2 2-5 5-2Z"/></svg>
                        </span>
                        <h3 class="mt-5 text-base font-extrabold text-slate-950">1 Platform, Bebas Pilih</h3>
                        <p class="mt-2 text-xs leading-5 text-slate-500">Akses puluhan gerai laundry lokal dan jaringan profesional hanya dengan satu akun pengguna tanpa registrasi berulang.</p>
                    </article>

                    <article class="rounded-2xl border border-slate-200/80 bg-gradient-to-b from-white to-slate-50/70 p-6 transition hover:border-blue-200 hover:shadow-lg hover:shadow-blue-950/5">
                        <span class="grid h-12 w-12 place-items-center rounded-xl bg-violet-600 text-white shadow-lg shadow-violet-600/20">
                            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="M3 10h18M7 15h3"/></svg>
                        </span>
                        <h3 class="mt-5 text-base font-extrabold text-slate-950">Timbangan &amp; Nota Digital</h3>
                        <p class="mt-2 text-xs leading-5 text-slate-500">Timbangan digital terkalibrasi langsung terhubung ke sistem kasir cloud. Total bayar transparan dengan nota modern per gram.</p>
                    </article>

                    <article class="rounded-2xl border border-slate-200/80 bg-gradient-to-b from-white to-slate-50/70 p-6 transition hover:border-blue-200 hover:shadow-lg hover:shadow-blue-950/5">
                        <span class="grid h-12 w-12 place-items-center rounded-xl bg-sky-600 text-white shadow-lg shadow-sky-600/20">
                            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M4 5h16v12H8l-4 4V5Z"/><path d="M8 9h8M8 12h5"/></svg>
                        </span>
                        <h3 class="mt-5 text-base font-extrabold text-slate-950">Notifikasi Live</h3>
                        <p class="mt-2 text-xs leading-5 text-slate-500">Dapatkan pembaruan instan saat cucian mulai direndam, dikeringkan, disetrika rapi, hingga siap kembali ke tempat Anda.</p>
                    </article>
                </div>
            </div>
        </section>

        <section class="mx-auto max-w-7xl px-5 pt-16">
            <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-[#1e3a8a] via-blue-700 to-cyan-500 px-6 py-8 shadow-2xl shadow-blue-950/20 sm:px-10 sm:py-10">
                <div class="pointer-events-none absolute -right-20 -top-24 h-72 w-72 rounded-full bg-white/10 blur-2xl"></div>
                <div class="pointer-events-none absolute bottom-0 left-1/3 h-40 w-40 rounded-full bg-cyan-300/20 blur-2xl"></div>

                <div class="relative grid items-center gap-8 lg:grid-cols-[1.15fr_0.85fr]">
                    <div>
                        <span class="inline-flex items-center gap-2 rounded-full border border-white/20 bg-white/10 px-3 py-1.5 text-[10px] font-bold uppercase tracking-[0.14em] text-white/90 backdrop-blur">
                            <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M3 21h18M5 21V7l7-4 7 4v14M9 21v-5h6v5"/></svg>
                            Kemitraan Tenant Outlet
                        </span>
                        <h2 class="mt-4 max-w-xl text-2xl font-extrabold leading-tight tracking-tight text-white sm:text-3xl">
                            Punya Usaha Laundry? Gabung Jadi Mitra Tenant &amp; Kelola Bisnis Lebih Modern!
                        </h2>
                        <p class="mt-3 max-w-xl text-sm leading-6 text-blue-50/85">Dapatkan sistem pembukuan digital otomatis, akses ribuan pelanggan di sekitarmu, dan integrasi kurir lokal dalam satu dashboard. Saat ini sudah ada <?php echo e($totalTenants); ?> mitra aktif bersama LaundryMap.</p>
                        <div class="mt-6 flex flex-wrap gap-3">
                            <a href="<?php echo e(route('customer.partner.register')); ?>" class="rounded-xl bg-white px-5 py-3 text-sm font-bold text-blue-700 shadow-lg shadow-blue-950/10 transition hover:-translate-y-0.5 hover:bg-blue-50">Daftar Jadi Mitra Sekarang</a>
                        </div>
                    </div>

                    <div class="rounded-2xl border border-white/15 bg-white/10 p-5 backdrop-blur-md">
                        <h3 class="flex items-center gap-2 text-sm font-extrabold text-white">
                            <span class="grid h-8 w-8 place-items-center rounded-lg bg-white/15">
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="8" r="3"/><path d="M3.5 20a5.5 5.5 0 0 1 11 0"/><path d="M17 11h4M19 9v4"/></svg>
                            </span>
                            Paket Tenant Map
                        </h3>
                        <ul class="mt-4 space-y-2.5 text-xs text-blue-50/90">
                            <li class="flex items-center gap-2"><span class="grid h-4 w-4 place-items-center rounded-full bg-white/15"><svg class="h-2.5 w-2.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="m5 12 5 5L20 7"/></svg></span>Penerimaan Pembayaran QRIS atau Tunai</li>
                            <li class="flex items-center gap-2"><span class="grid h-4 w-4 place-items-center rounded-full bg-white/15"><svg class="h-2.5 w-2.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="m5 12 5 5L20 7"/></svg></span>Notifikasi Otomatis ke Pelanggan</li>
                            <li class="flex items-center gap-2"><span class="grid h-4 w-4 place-items-center rounded-full bg-white/15"><svg class="h-2.5 w-2.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="m5 12 5 5L20 7"/></svg></span>Laporan Omzet Harian &amp; Stok Detergen</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>


        <section id="bantuan" class="mx-auto max-w-7xl px-5 py-16">
            <div class="grid gap-5 lg:grid-cols-2">

                <article class="lg:col-span-2 flex flex-col justify-between gap-6 rounded-2xl border border-slate-200/80 bg-white p-6 shadow-sm sm:flex-row sm:items-center">

                    <!-- Konten Customer Care -->
                    <div class="w-full min-w-0 flex-1">
                        <p class="text-[10px] font-extrabold uppercase tracking-[0.18em] text-blue-600">
                            Bantuan Operasional
                        </p>

                        <h2 class="mt-2 text-xl font-extrabold tracking-tight text-slate-950 sm:text-2xl">
                            Customer Care 24/7 Siaga
                        </h2>

                        <p class="mt-2 w-full text-xs leading-5 text-slate-500">
                            Kendala cucian hilang, rusak, atau telat? Kami beri garansi proteksi penuh dan pendampingan langsung.
                        </p>

                        <div class="mt-5 flex flex-wrap gap-2.5">
                            <a href="tel:<?php echo e(preg_replace('/[^0-9+]/', '', $supportPhone)); ?>"
                            class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-4 py-2.5 text-xs font-bold text-white transition hover:bg-blue-700">
                                <!-- Icon Telepon -->
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M4 5h4l2 5-2.5 1.5a12 12 0 0 0 5 5L14 14l5 2v4a2 2 0 0 1-2 2A16 16 0 0 1 2 7a2 2 0 0 1 2-2Z"/>
                                </svg>
                                Chat WhatsApp
                            </a>

                            <a href="mailto:<?php echo e($supportEmail); ?>"
                            class="inline-flex items-center gap-2 rounded-lg border border-slate-200 bg-white px-4 py-2.5 text-xs font-bold text-slate-700 transition hover:border-blue-200 hover:bg-blue-50 hover:text-blue-700">
                                <!-- Icon Email -->
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="5" width="18" height="14" rx="2"/>
                                    <path d="m3 7 9 6 9-6"/>
                                </svg>
                                Email CS
                            </a>
                        </div>
                    </div>

                    <!-- Ilustrasi Customer Care -->
                    <div class="grid h-32 w-full shrink-0 place-items-center rounded-2xl bg-gradient-to-br from-sky-100 to-blue-50 text-blue-600 sm:h-36 sm:w-36">
                        <svg class="h-16 w-16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 13a8 8 0 0 1 16 0"/>
                            <path d="M4 13v4a2 2 0 0 0 2 2h2v-6H6a2 2 0 0 0-2 2Z"/>
                            <path d="M20 13v4a2 2 0 0 1-2 2h-2v-6h2a2 2 0 0 1 2 2Z"/>
                            <path d="M18 19v.5a2.5 2.5 0 0 1-2.5 2.5H13"/>
                        </svg>
                    </div>

                </article>
            </div>
        </section>
    </main>

    <footer class="border-t border-slate-200 bg-white">
        <div class="mx-auto max-w-7xl px-5 py-12">
            <div class="grid gap-10 md:grid-cols-2 lg:grid-cols-[1.35fr_1fr_1fr_1.2fr]">
                <div>
                    <a href="<?php echo e(route('customer.home')); ?>" class="flex items-center gap-2.5">
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
                        <li><a href="<?php echo e(route('customer.services')); ?>" class="transition hover:text-blue-600">Katalog &amp; Layanan</a></li>
                        <li><a href="<?php echo e(route('customer.services')); ?>" class="transition hover:text-blue-600">Cuci Karpet &amp; Bed Cover</a></li>
                        <li><a href="<?php echo e(route('customer.services')); ?>" class="transition hover:text-blue-600">Lacak Langganan Kas</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-xs font-extrabold uppercase tracking-[0.15em] text-slate-900">Mitra &amp; Tenant</h3>
                    <ul class="mt-4 space-y-3 text-xs text-slate-500">
                        <li><a href="<?php echo e(route('customer.partner.register')); ?>" class="transition hover:text-blue-600">Portal Pemilik Outlet</a></li>
                        <li><a href="<?php echo e(route('customer.partner.register')); ?>" class="transition hover:text-blue-600">Pendaftaran Outlet Baru</a></li>
                        <li><a href="<?php echo e(route('customer.services')); ?>" class="transition hover:text-blue-600">Standarisasi SOP</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-xs font-extrabold uppercase tracking-[0.15em] text-slate-900"><a href="<?php echo e(route('customer.help')); ?>" class="transition hover:text-blue-600">Pusat Bantuan</a></h3>
                    <p class="mt-4 text-xs leading-6 text-slate-500">Butuh penanganan cepat pesanan Anda? Tim support LaundryMap siap membantu setiap hari.</p>
                    <a href="tel:<?php echo e(preg_replace('/[^0-9+]/', '', $supportPhone)); ?>" class="mt-4 inline-flex items-center gap-2 text-sm font-extrabold text-blue-600 transition hover:text-blue-700">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 5h4l2 5-2.5 1.5a12 12 0 0 0 5 5L14 14l5 2v4a2 2 0 0 1-2 2A16 16 0 0 1 2 7a2 2 0 0 1 2-2Z"/></svg>
                        <?php echo e($supportPhone); ?>

                    </a>
                </div>
            </div>
        </div>

        <div class="border-t border-slate-200">
            <div class="mx-auto flex max-w-7xl flex-col gap-3 px-5 py-5 text-[11px] text-slate-500 sm:flex-row sm:items-center sm:justify-between">
                <p>&copy; <?php echo e(date('Y')); ?> LaundryMap Indonesia. Hak Cipta Dilindungi.</p>
                <div class="flex items-center gap-5">
                    <a href="<?php echo e(route('customer.home')); ?>#bantuan" class="transition hover:text-blue-600">Syarat &amp; Ketentuan</a>
                    <a href="<?php echo e(route('customer.home')); ?>#bantuan" class="transition hover:text-blue-600">Kebijakan Privasi</a>
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
<?php /**PATH D:\laragon\www\Laundry-Multitenant-terintegrasi\Laundry-Multitenant\resources\views/laundry/home.blade.php ENDPATH**/ ?>