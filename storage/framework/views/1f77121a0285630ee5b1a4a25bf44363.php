<?php
    $photos = [
        'https://images.unsplash.com/photo-1545173168-9f1947eebb7f?auto=format&fit=crop&w=600&q=80',
        'https://images.unsplash.com/photo-1517677208171-0bc6725a3e60?auto=format&fit=crop&w=600&q=80',
        'https://images.unsplash.com/photo-1582735689369-4fe89db7114c?auto=format&fit=crop&w=600&q=80',
        'https://images.unsplash.com/photo-1610557892470-55d9e80c0bce?auto=format&fit=crop&w=600&q=80',
        'https://images.unsplash.com/photo-1604335399105-a0c585fd81a1?auto=format&fit=crop&w=600&q=80',
        'https://images.unsplash.com/photo-1626806819282-2c1dc01a5e0c?auto=format&fit=crop&w=600&q=80',
    ];
    $ratingFor = fn ($tenant) => number_format(4.4 + (($tenant->id * 3) % 6) / 10, 1, ',', '.');
    $reviewsFor = fn ($tenant) => number_format(310 + (($tenant->id * 97) % 1200), 0, ',', '.');
    $distanceFor = fn ($tenant) => number_format(0.8 + (($tenant->id * 7) % 42) / 10, 1, ',', '');
    $badgeFor = fn ($tenant) => collect(['Terverifikasi', 'Layanan Kilat', 'Spesialis Sepatu', 'Premium Laundry', '24 Jam Non-Stop'])->get($tenant->id % 5);
    $openLabelFor = fn ($tenant) => $tenant->id % 4 === 0 ? 'Buka 24 Jam' : 'Buka 08.00 - 21.00';
    $hasFilters = $location !== '' || $selectedServices !== [] || $maxPrice < $maxPriceOption || $status !== '';
?>

<div>
    <section class="bg-gradient-to-b from-[#eef5ff] via-[#f6faff] to-[#f6f8fc] pb-1">
        <div class="mx-auto max-w-7xl px-5 pt-6">
            <nav class="flex items-center gap-2 text-[11px] font-semibold text-slate-500">
                <a href="<?php echo e(route('customer.home')); ?>" class="inline-flex items-center gap-1.5 transition hover:text-blue-600">
                    <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round"><path d="m3 10 9-7 9 7v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-9Z"/><path d="M9 21v-7h6v7"/></svg>
                    Beranda
                </a>
                <svg class="h-3.5 w-3.5 text-slate-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 6 6 6-6 6"/></svg>
                <span class="text-slate-700">Cari Laundry</span>
            </nav>

            <div class="mt-6 flex flex-wrap items-end justify-between gap-4">
                <div>
                    <p class="flex items-center gap-2 text-[10px] font-extrabold uppercase tracking-[0.16em] text-blue-600">
                        <span class="h-1.5 w-1.5 rounded-full bg-blue-600"></span>
                        Area <?php echo e($areaName); ?> &amp; Sekitarnya
                    </p>
                    <h1 class="mt-2 text-3xl font-extrabold tracking-tight text-slate-950 sm:text-[2.6rem]">Cari Laundry Terdekat &amp; Terbaik</h1>
                    <p class="mt-2 flex items-center gap-1.5 text-sm text-slate-500">
                        <svg class="h-4 w-4 text-blue-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 5-8 11-8 11S4 15 4 10a8 8 0 1 1 16 0Z"/><circle cx="12" cy="10" r="2.5"/></svg>
                        Ditemukan <?php echo e(number_format($tenants->total())); ?> Mitra Laundry tervalidasi di sekitarmu
                    </p>
                </div>

                <div class="flex items-center gap-2">
                    <span class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-4 py-2.5 text-xs font-bold text-white shadow-sm">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M8 6h13M8 12h13M8 18h13"/><path d="M3 6h.01M3 12h.01M3 18h.01"/></svg>
                        Daftar
                    </span>
                    <a href="#peta-sekitar" class="inline-flex items-center gap-2 rounded-lg border border-slate-200 bg-white px-4 py-2.5 text-xs font-bold text-slate-600 shadow-sm transition hover:border-blue-200 hover:text-blue-600">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="m9 4-6 2v14l6-2 6 2 6-2V4l-6 2-6-2Z"/><path d="M9 4v14M15 6v14"/></svg>
                        Peta Interaktif
                    </a>
                </div>
            </div>

            <form wire:submit="search" class="mt-6 rounded-2xl border border-white bg-white p-2.5 shadow-xl shadow-blue-950/5">
                <div class="flex flex-col gap-2 sm:flex-row sm:items-center">
                    <label class="flex min-w-0 flex-1 items-center gap-3 rounded-xl px-3 py-2.5">
                        <svg class="h-5 w-5 shrink-0 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/></svg>
                        <input wire:model="location" placeholder="Area Banyuwangi" class="w-full min-w-0 border-0 bg-transparent p-0 text-sm font-medium text-slate-800 placeholder:text-slate-400 focus:outline-none focus:ring-0">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(filled($location)): ?>
                            <button type="button" wire:click="$set('location', '')" class="grid h-6 w-6 shrink-0 place-items-center rounded-full text-slate-400 transition hover:bg-slate-100 hover:text-slate-600" title="Hapus lokasi">
                                <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M6 6l12 12M18 6 6 18"/></svg>
                            </button>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </label>

                    <div class="flex items-center justify-between gap-2 sm:justify-end">
                        <span class="inline-flex items-center gap-1.5 rounded-lg px-2 text-[11px] font-semibold text-slate-500">
                            <svg class="h-4 w-4 text-blue-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="m3 11 19-9-9 19-2-8-8-2Z"/></svg>
                            Peta Aktif <span class="text-slate-400">(2.5 km)</span>
                        </span>
                        <button type="submit" wire:loading.attr="disabled" wire:target="search" class="inline-flex items-center gap-2 rounded-xl bg-blue-600 px-5 py-3 text-xs font-bold text-white shadow-lg shadow-blue-600/20 transition hover:bg-blue-700 disabled:cursor-wait disabled:opacity-70">
                            Perbarui Pencarian
                            <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 6 6 6-6 6"/></svg>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-5 pb-16 pt-6">
        <div class="grid gap-5 lg:grid-cols-[290px_minmax(0,1fr)]">
            <aside class="space-y-5">
                <div class="rounded-2xl border border-slate-200/80 bg-white p-5 shadow-sm">
                    <div class="flex items-center justify-between gap-3">
                        <h2 class="flex items-center gap-2 text-sm font-extrabold text-slate-900">
                            <svg class="h-4 w-4 text-slate-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round"><path d="M4 6h16M7 12h10M10 18h4"/></svg>
                            Filter Pencarian
                        </h2>
                        <button type="button" wire:click="resetFilters" class="text-[11px] font-bold text-blue-600 hover:underline">Reset Semua</button>
                    </div>

                    <div class="mt-5 space-y-5">
                        <div>
                            <p class="flex items-center gap-1.5 text-[10px] font-extrabold uppercase tracking-[0.12em] text-slate-400">
                                <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 6h10M8 12h9M12 18h6"/></svg>
                                Urutkan Menurut
                            </p>
                            <div class="mt-2 grid grid-cols-3 gap-1 rounded-xl bg-slate-100 p-1">
                                <button type="button" wire:click="sortBy('terdekat')" class="rounded-lg px-2 py-2 text-center text-[11px] font-bold transition <?php echo e(! in_array($sort, ['price', 'rating'], true) ? 'bg-white text-blue-600 shadow-sm' : 'text-slate-500 hover:text-slate-700'); ?>">Terdekat</button>
                                <button type="button" wire:click="sortBy('rating')" class="rounded-lg px-2 py-2 text-center text-[11px] font-bold transition <?php echo e($sort === 'rating' ? 'bg-white text-blue-600 shadow-sm' : 'text-slate-500 hover:text-slate-700'); ?>">Rating</button>
                                <button type="button" wire:click="sortBy('price')" class="rounded-lg px-2 py-2 text-center text-[11px] font-bold transition <?php echo e($sort === 'price' ? 'bg-white text-blue-600 shadow-sm' : 'text-slate-500 hover:text-slate-700'); ?>">Termurah</button>
                            </div>
                        </div>

                        <div>
                            <p class="text-[10px] font-extrabold uppercase tracking-[0.12em] text-slate-400">Pilih Area Layanan</p>
                            <select wire:model.live="location" class="mt-2 w-full cursor-pointer rounded-xl border border-slate-200 bg-white px-3 py-2.5 text-xs font-semibold text-slate-700 focus:border-blue-400 focus:outline-none focus:ring-0">
                                <option value="">Semua Area</option>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = array_unique(array_filter([$location, 'Ketapang & Sekitarnya', 'Banyuwangi'])); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $areaOption): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                    <option value="<?php echo e($areaOption); ?>"><?php echo e($areaOption); ?></option>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            </select>
                        </div>

                        <div>
                            <p class="text-[10px] font-extrabold uppercase tracking-[0.12em] text-slate-400">Status Operasional</p>
                            <div class="mt-2 flex flex-wrap gap-1.5">
                                <label class="cursor-pointer">
                                    <input type="radio" wire:model.live="status" value="" class="peer sr-only">
                                    <span class="inline-flex rounded-full border border-slate-200 bg-white px-3 py-1.5 text-[10px] font-bold text-slate-500 peer-checked:border-blue-600 peer-checked:bg-blue-600 peer-checked:text-white">Semua</span>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="radio" wire:model.live="status" value="buka" class="peer sr-only">
                                    <span class="inline-flex rounded-full border border-slate-200 bg-white px-3 py-1.5 text-[10px] font-bold text-slate-500 peer-checked:border-blue-600 peer-checked:bg-blue-600 peer-checked:text-white">Buka Sekarang</span>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="radio" wire:model.live="status" value="24jam" class="peer sr-only">
                                    <span class="inline-flex rounded-full border border-slate-200 bg-white px-3 py-1.5 text-[10px] font-bold text-slate-500 peer-checked:border-blue-600 peer-checked:bg-blue-600 peer-checked:text-white">Buka 24 Jam</span>
                                </label>
                            </div>
                        </div>

                        <div>
                            <p class="text-[10px] font-extrabold uppercase tracking-[0.12em] text-slate-400">Layanan yang Dibutuhkan</p>
                            <div class="mt-2 space-y-2">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $serviceFilters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $serviceFilter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                    <label class="flex cursor-pointer items-center gap-2.5 text-xs font-semibold text-slate-600">
                                        <input type="checkbox" wire:model.live="selectedServices" value="<?php echo e($serviceFilter['name']); ?>" class="h-4 w-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                                        <span class="flex-1 leading-5"><?php echo e($serviceFilter['name']); ?></span>
                                        <span class="text-[11px] font-bold text-slate-400"><?php echo e($serviceFilter['count']); ?></span>
                                    </label>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                    <p class="text-xs text-slate-400">Belum ada layanan aktif.</p>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        </div>

                        <div>
                            <div class="flex items-center justify-between">
                                <p class="text-[10px] font-extrabold uppercase tracking-[0.12em] text-slate-400">Maksimal Harga Kiloan</p>
                                <p id="max-price-label" class="text-[11px] font-extrabold text-blue-600">Rp<?php echo e(number_format($maxPrice, 0, ',', '.')); ?>/kg</p>
                            </div>
                            <input
                                type="range"
                                wire:model.live.debounce.400ms="maxPrice"
                                min="6000"
                                max="<?php echo e($maxPriceOption); ?>"
                                step="500"
                                oninput="document.getElementById('max-price-label').textContent = 'Rp' + new Intl.NumberFormat('id-ID').format(this.value) + '/kg'"
                                class="mt-3 h-1.5 w-full cursor-pointer appearance-none rounded-full bg-slate-200 accent-blue-600"
                            >
                            <div class="mt-1.5 flex items-center justify-between text-[10px] font-semibold text-slate-400">
                                <span>Rp4.000</span>
                                <span>Rp<?php echo e(number_format((int) (($maxPriceOption + 4000) / 2), 0, ',', '.')); ?></span>
                                <span>Rp<?php echo e(number_format($maxPriceOption, 0, ',', '.')); ?>+</span>
                            </div>
                        </div>

                        <button type="button" wire:click="search" class="w-full rounded-xl bg-blue-600 px-4 py-3 text-xs font-bold text-white shadow-lg shadow-blue-600/20 transition hover:bg-blue-700">Terapkan Filter</button>
                    </div>
                </div>

                <div id="peta-sekitar" class="overflow-hidden rounded-2xl border border-slate-200/80 bg-white shadow-sm">
                    <div class="flex items-center justify-between gap-2 px-4 pt-4">
                        <h2 class="flex items-center gap-1.5 text-xs font-extrabold text-slate-900">
                            <svg class="h-4 w-4 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="m15.5 8.5-2 5-5 2 2-5 5-2Z"/></svg>
                            Peta Sekitar <?php echo e(filled($location) ? $location : 'Banyuwangi'); ?>

                        </h2>
                        <span class="rounded-full bg-slate-100 px-2 py-1 text-[10px] font-bold text-slate-500"><?php echo e($tenants->total()); ?> Titik</span>
                    </div>
                    <div class="relative mt-3 h-44 overflow-hidden bg-[#dfe9f3]">
                        <div class="absolute inset-0 opacity-70" style="background-image: linear-gradient(rgba(148,163,184,.35) 1px, transparent 1px), linear-gradient(90deg, rgba(148,163,184,.35) 1px, transparent 1px); background-size: 28px 28px;"></div>
                        <div class="absolute inset-0 bg-[radial-gradient(circle_at_30%_40%,rgba(59,130,246,.22),transparent_45%),radial-gradient(circle_at_75%_65%,rgba(14,165,233,.18),transparent_40%)]"></div>
                        <div class="absolute left-8 top-8 h-24 w-24 rounded-full border-2 border-dashed border-blue-400/50"></div>
                        <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 rounded-full bg-blue-600 px-2.5 py-1 text-[10px] font-bold text-white shadow-lg">Laundry terdekat</div>
                        <span class="absolute left-10 top-10 grid h-6 w-6 place-items-center rounded-full border-2 border-white bg-emerald-500 text-white shadow"><svg class="h-3 w-3" viewBox="0 0 24 24" fill="currentColor"><path d="m12 3 2.1 5.9L20 11l-5.9 2.1L12 19l-2.1-5.9L4 11l5.9-2.1L12 3Z"/></svg></span>
                        <span class="absolute right-12 top-16 grid h-6 w-6 place-items-center rounded-full border-2 border-white bg-rose-500 text-white shadow"><svg class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"><path d="M6 6l12 12M18 6 6 18"/></svg></span>
                        <span class="absolute bottom-10 left-16 grid h-6 w-6 place-items-center rounded-full border-2 border-white bg-blue-600 text-white shadow"><svg class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"><path d="M12 5v14M5 12h14"/></svg></span>
                        <a href="#" class="absolute bottom-3 right-3 grid h-8 w-8 place-items-center rounded-lg border border-slate-200 bg-white text-slate-500 shadow-sm transition hover:text-blue-600" title="Perbesar peta">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round"><path d="M4 9V4h5M20 9V4h-5M4 15v5h5M20 15v5h-5"/></svg>
                        </a>
                    </div>
                    <div class="flex flex-wrap gap-3 px-4 py-3 text-[10px] font-semibold text-slate-500">
                        <span class="inline-flex items-center gap-1.5"><span class="h-2 w-2 rounded-full bg-emerald-500"></span>Buka Sekarang</span>
                        <span class="inline-flex items-center gap-1.5"><span class="h-2 w-2 rounded-full bg-rose-500"></span>Tutup</span>
                    </div>
                </div>
            </aside>

            <div class="min-w-0">
                <div class="flex flex-wrap items-center justify-between gap-3">
                    <div class="flex flex-wrap items-center gap-1.5">
                        <span class="text-[10px] font-extrabold uppercase tracking-[0.12em] text-slate-400">Filter Aktif:</span>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(filled($location)): ?>
                            <button type="button" wire:click="$set('location', '')" class="inline-flex items-center gap-1.5 rounded-full border border-blue-200 bg-blue-50 px-3 py-1 text-[10px] font-bold text-blue-700">
                                <?php echo e($location); ?>

                                <svg class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"><path d="M6 6l12 12M18 6 6 18"/></svg>
                            </button>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $selectedServices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $selected): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <button type="button" wire:click="removeService(<?php echo \Illuminate\Support\Js::from($selected)->toHtml() ?>)" class="inline-flex items-center gap-1.5 rounded-full border border-sky-200 bg-sky-50 px-3 py-1 text-[10px] font-bold text-sky-700">
                                <?php echo e($selected); ?>

                                <svg class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"><path d="M6 6l12 12M18 6 6 18"/></svg>
                            </button>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($status === '24jam'): ?>
                            <button type="button" wire:click="$set('status', '')" class="inline-flex items-center gap-1.5 rounded-full border border-emerald-200 bg-emerald-50 px-3 py-1 text-[10px] font-bold text-emerald-700">
                                Buka 24 Jam
                                <svg class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"><path d="M6 6l12 12M18 6 6 18"/></svg>
                            </button>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($maxPrice < $maxPriceOption): ?>
                            <button type="button" wire:click="$set('maxPrice', <?php echo e($maxPriceOption); ?>)" class="inline-flex items-center gap-1.5 rounded-full border border-amber-200 bg-amber-50 px-3 py-1 text-[10px] font-bold text-amber-700">
                                Maks. Rp<?php echo e(number_format($maxPrice, 0, ',', '.')); ?>/kg
                                <svg class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"><path d="M6 6l12 12M18 6 6 18"/></svg>
                            </button>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(! $hasFilters): ?>
                            <span class="text-[10px] font-medium text-slate-400">Belum ada filter dipilih</span>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                    <p class="text-[11px] font-medium text-slate-500">
                        Menampilkan <?php echo e($tenants->firstItem() ?? 0); ?> - <?php echo e($tenants->lastItem() ?? 0); ?> dari <?php echo e($tenants->total()); ?> Mitra
                    </p>
                </div>

                <div class="mt-4 space-y-3.5">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $tenants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tenant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <?php
                            $photo = $photos[$loop->index % count($photos)];
                            $firstService = $tenant->services->first();
                            $unit = $firstService?->unit ?? 'kg';
                        ?>
                        <article <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'tenant-'.e($tenant->id).''; ?>wire:key="tenant-<?php echo e($tenant->id); ?>" class="overflow-hidden rounded-2xl border border-slate-200/80 bg-white shadow-sm transition hover:border-blue-200 hover:shadow-lg hover:shadow-blue-950/5">
                            <div class="flex flex-col sm:flex-row">
                                <div class="relative h-48 shrink-0 overflow-hidden bg-gradient-to-br from-blue-700 via-blue-500 to-cyan-400 sm:h-auto sm:w-56">
                                    <img src="<?php echo e($photo); ?>" alt="<?php echo e($tenant->name); ?>" class="h-full w-full object-cover" loading="lazy" onerror="this.style.display='none'">
                                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/70 via-transparent to-transparent"></div>
                                    <span class="absolute left-3 top-3 inline-flex items-center gap-1 rounded-md bg-slate-950/70 px-2 py-1 text-[9px] font-bold text-white backdrop-blur">
                                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span>
                                        <?php echo e($badgeFor($tenant)); ?>

                                    </span>
                                    <span class="absolute bottom-3 left-3 inline-flex items-center gap-1 rounded-md bg-slate-950/65 px-2 py-1 text-[10px] font-semibold text-white backdrop-blur">
                                        <svg class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg>
                                        <?php echo e($openLabelFor($tenant)); ?>

                                    </span>
                                </div>

                                <div class="flex min-w-0 flex-1 flex-col p-4 sm:p-5">
                                    <div class="flex items-start justify-between gap-3">
                                        <div class="min-w-0">
                                            <h2 class="flex items-center gap-1.5 truncate text-lg font-extrabold tracking-tight text-slate-950">
                                                <?php echo e($tenant->name); ?>

                                                <svg class="h-4 w-4 shrink-0 text-blue-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" title="Terverifikasi"><circle cx="12" cy="12" r="9"/><path d="m9 12 2 2 4-4"/></svg>
                                            </h2>
                                            <p class="mt-1 flex items-center gap-1.5 truncate text-[11px] text-slate-500">
                                                <svg class="h-3.5 w-3.5 shrink-0 text-blue-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 5-8 11-8 11S4 15 4 10a8 8 0 1 1 16 0Z"/><circle cx="12" cy="10" r="2.5"/></svg>
                                                <?php echo e($tenant->address ?: 'Alamat belum tersedia'); ?>

                                                <span class="text-slate-300">•</span>
                                                <span class="shrink-0"><?php echo e($distanceFor($tenant)); ?> km dari lokasimu</span>
                                            </p>
                                        </div>
                                        <span class="inline-flex shrink-0 items-center gap-1 text-xs font-extrabold text-slate-800">
                                            <svg class="h-4 w-4 text-amber-400" viewBox="0 0 24 24" fill="currentColor"><path d="m12 3 2.1 5.9L20 11l-5.9 2.1L12 19l-2.1-5.9L4 11l5.9-2.1L12 3Z"/></svg>
                                            <?php echo e($ratingFor($tenant)); ?>

                                            <span class="text-[10px] font-semibold text-slate-400">(<?php echo e($reviewsFor($tenant)); ?>)</span>
                                        </span>
                                    </div>

                                    <div class="mt-3 flex flex-wrap gap-1.5">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $tenant->services->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tenantService): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                            <span class="inline-flex items-center gap-1 rounded-md border border-blue-100 bg-blue-50 px-2 py-1 text-[10px] font-bold text-blue-700">
                                                <svg class="h-2.5 w-2.5" viewBox="0 0 24 24" fill="currentColor"><path d="m12 3 2.1 5.9L20 11l-5.9 2.1L12 19l-2.1-5.9L4 11l5.9-2.1L12 3Z"/></svg>
                                                <?php echo e($tenantService->name); ?>

                                            </span>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($tenant->services->isEmpty()): ?>
                                            <span class="rounded-md bg-slate-100 px-2 py-1 text-[10px] font-semibold text-slate-500">Layanan belum tersedia</span>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </div>

                                    <div class="mt-auto flex flex-wrap items-end justify-between gap-3 border-t border-slate-100 pt-4">
                                        <div>
                                            <p class="text-[10px] font-semibold text-slate-400">Mulai dari</p>
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($tenant->min_price !== null): ?>
                                                <p class="text-xl font-extrabold tracking-tight text-blue-700">
                                                    Rp<?php echo e(number_format((float) $tenant->min_price, 0, ',', '.')); ?>

                                                    <span class="text-[11px] font-semibold text-slate-400">/ <?php echo e($unit); ?></span>
                                                </p>
                                            <?php else: ?>
                                                <p class="text-sm font-bold text-slate-500">Hubungi mitra</p>
                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        </div>
                                        <a href="<?php echo e(route('customer.tenant.show', $tenant)); ?>" class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-4 py-2.5 text-[11px] font-bold text-white shadow-sm transition hover:bg-blue-700">
                                            Lihat Detail &amp; Menu
                                            <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 6 6 6-6 6"/></svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </article>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        <div class="rounded-2xl border border-dashed border-slate-300 bg-white px-6 py-16 text-center">
                            <div class="mx-auto grid h-14 w-14 place-items-center rounded-2xl bg-blue-50 text-blue-600">
                                <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/></svg>
                            </div>
                            <h2 class="mt-4 text-lg font-bold text-slate-900">Laundry tidak ditemukan</h2>
                            <p class="mt-2 text-sm text-slate-500">Coba ubah kata kunci lokasi, layanan, atau atur ulang filter pencarian.</p>
                            <button type="button" wire:click="resetFilters" class="mt-5 inline-flex rounded-xl bg-blue-600 px-5 py-2.5 text-sm font-bold text-white transition hover:bg-blue-700">Reset Pencarian</button>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($tenants->total() > 0): ?>
                    <div class="mt-6 flex flex-col items-center justify-between gap-4 sm:flex-row">
                        <p class="text-[11px] font-medium text-slate-500">Menampilkan <?php echo e($tenants->firstItem()); ?> sampai <?php echo e($tenants->lastItem()); ?> dari total <?php echo e($tenants->total()); ?> Mitra</p>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($tenants->hasPages()): ?>
                            <nav class="flex items-center gap-1">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($tenants->onFirstPage()): ?>
                                    <span class="grid h-8 w-8 place-items-center rounded-lg border border-slate-200 bg-white text-slate-300">
                                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 6-6 6 6 6"/></svg>
                                    </span>
                                <?php else: ?>
                                    <button type="button" wire:click="previousPage" class="grid h-8 w-8 place-items-center rounded-lg border border-slate-200 bg-white text-slate-500 transition hover:border-blue-200 hover:text-blue-600">
                                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 6-6 6 6 6"/></svg>
                                    </button>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $tenants->getUrlRange(max(1, $tenants->currentPage() - 1), min($tenants->lastPage(), $tenants->currentPage() + 2)); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($page === $tenants->currentPage()): ?>
                                        <span class="grid h-8 w-8 place-items-center rounded-lg bg-blue-600 text-xs font-bold text-white"><?php echo e($page); ?></span>
                                    <?php else: ?>
                                        <button type="button" wire:click="gotoPage(<?php echo e($page); ?>)" class="grid h-8 w-8 place-items-center rounded-lg border border-slate-200 bg-white text-xs font-bold text-slate-500 transition hover:border-blue-200 hover:text-blue-600"><?php echo e($page); ?></button>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>

                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($tenants->hasMorePages()): ?>
                                    <button type="button" wire:click="nextPage" class="grid h-8 w-8 place-items-center rounded-lg border border-slate-200 bg-white text-slate-500 transition hover:border-blue-200 hover:text-blue-600">
                                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 6 6 6-6 6"/></svg>
                                    </button>
                                <?php else: ?>
                                    <span class="grid h-8 w-8 place-items-center rounded-lg border border-slate-200 bg-white text-slate-300">
                                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 6 6 6-6 6"/></svg>
                                    </span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </nav>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
    </section>
</div>
<?php /**PATH D:\laragon\www\Laundry-Multitenant-terintegrasi\Laundry-Multitenant\resources\views\livewire\laundry-search.blade.php ENDPATH**/ ?>