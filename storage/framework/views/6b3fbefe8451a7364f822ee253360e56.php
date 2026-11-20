<div>
    <?php
        $initials = collect(explode(' ', $tenant->name))->filter()->take(2)->map(fn ($word) => mb_strtoupper(mb_substr($word, 0, 1)))->implode('');
        $badges = ['Paling Laris', 'Favorit', 'Super Kilat', 'Premium', 'Hemat'];
        $minimumWeight = $this->minimumWeight();
        $subtotal = $this->subtotal();
    ?>

    <section class="relative">
        <div class="relative h-[260px] overflow-hidden bg-slate-900 sm:h-[320px]">
            <img src="https://images.unsplash.com/photo-1545173168-9f1947eebb7f?auto=format&fit=crop&w=1800&q=80" alt="<?php echo e($tenant->name); ?>" class="h-full w-full object-cover opacity-80">
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/70 via-slate-950/20 to-transparent"></div>
            <div class="absolute left-5 top-5 sm:left-8 sm:top-8">
                <a href="<?php echo e(route('customer.services')); ?>" class="inline-flex items-center gap-2 rounded-lg bg-white/90 px-3 py-2 text-[11px] font-bold text-slate-700 shadow-sm backdrop-blur transition hover:bg-white">
                    <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 6-6 6 6 6"/></svg>
                    Kembali ke Pencarian
                </a>
            </div>
            <div class="absolute bottom-5 left-5 right-5 flex flex-wrap items-end justify-between gap-3 sm:bottom-8 sm:left-8 sm:right-8">
                <div>
                    <span class="inline-flex items-center gap-1.5 rounded-md bg-white/15 px-2.5 py-1 text-[10px] font-bold text-white backdrop-blur">
                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span>
                        Mitra Terverifikasi
                    </span>
                    <h1 class="mt-2 text-3xl font-extrabold tracking-tight text-white sm:text-4xl"><?php echo e($tenant->name); ?></h1>
                    <p class="mt-1 flex flex-wrap items-center gap-1.5 text-xs text-white/80">
                        <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 5-8 11-8 11S4 15 4 10a8 8 0 1 1 16 0Z"/><circle cx="12" cy="10" r="2.5"/></svg>
                        <?php echo e($tenant->address ?: 'Alamat belum tersedia'); ?>

                        <span class="text-white/40">•</span>
                        <span>Radius antar-jemput 2 km</span>
                    </p>
                </div>
                <div class="flex items-center gap-2 rounded-lg bg-white/95 px-3 py-2 shadow-sm">
                    <span class="grid h-8 w-8 place-items-center rounded-lg bg-blue-600 text-[11px] font-extrabold text-white"><?php echo e($initials ?: 'LM'); ?></span>
                    <div class="pr-1">
                        <p class="text-[10px] font-semibold uppercase tracking-wide text-slate-400">Rating Mitra</p>
                        <p class="flex items-center gap-1 text-xs font-extrabold text-slate-800">
                            <svg class="h-3.5 w-3.5 text-amber-400" viewBox="0 0 24 24" fill="currentColor"><path d="m12 3 2.1 5.9L20 11l-5.9 2.1L12 19l-2.1-5.9L4 11l5.9-2.1L12 3Z"/></svg>
                            4.9 <span class="text-[10px] font-semibold text-slate-400">(1.2rb ulasan)</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-5 pb-16">
        <div class="relative z-10 -mt-5 rounded-2xl border border-slate-200/80 bg-white p-2 shadow-lg shadow-blue-950/5">
            <div class="flex flex-wrap gap-1">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = ['tentang' => 'Tentang & Fasilitas', 'ulasan' => 'Ulasan Pelanggan (1.240)', 'kebijakan' => 'Kebijakan Antar-Jemput']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <button type="button" wire:click="setTab('<?php echo e($key); ?>')" class="rounded-xl px-4 py-2.5 text-xs font-bold transition <?php echo e($tab === $key ? 'bg-blue-600 text-white shadow-sm' : 'text-slate-500 hover:bg-slate-50 hover:text-blue-600'); ?>"><?php echo e($label); ?></button>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </div>
        </div>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($tab === 'tentang'): ?>
            <div class="mt-4 rounded-2xl border border-blue-100 bg-white p-4 shadow-sm">
                <div class="flex flex-wrap items-center gap-x-5 gap-y-2 text-xs font-semibold text-slate-600">
                    <span class="flex items-center gap-2"><span class="grid h-7 w-7 place-items-center rounded-lg bg-blue-50 text-blue-600"><svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 6 9 17l-5-5"/></svg></span>Jaminan Higienis <?php echo e($tenant->name); ?></span>
                    <span class="text-slate-400">1 Mesin 1 Pelanggan • Sterilisasi Uap Panas • Garansi Cuci Ulang 100%</span>
                    <span class="ml-auto flex items-center gap-1.5 rounded-md bg-blue-50 px-2.5 py-1 text-[10px] font-bold text-blue-700"><svg class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 7h11v8H3zM14 10h4l3 3v2h-7z"/><circle cx="7" cy="18" r="2"/><circle cx="18" cy="18" r="2"/></svg>Gratis Antar-Jemput</span>
                </div>
            </div>
        <?php elseif($tab === 'ulasan'): ?>
            <div class="mt-4 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex flex-wrap items-center justify-between gap-3">
                    <div>
                        <p class="text-2xl font-extrabold text-slate-900">4.9 <span class="text-sm font-semibold text-slate-400">/ 5.0</span></p>
                        <p class="text-xs text-slate-500">Berdasarkan 1.240 ulasan pelanggan terverifikasi.</p>
                    </div>
                    <div class="flex items-center gap-1 text-amber-400">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php for($star = 1; $star <= 5; $star++): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><path d="m12 3 2.1 5.9L20 11l-5.9 2.1L12 19l-2.1-5.9L4 11l5.9-2.1L12 3Z"/></svg>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endfor; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </div>
                </div>
                <div class="mt-4 grid gap-3 sm:grid-cols-2">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = [['Rina S.', 'Hasil cucian wangi dan rapi. Kurir tepat waktu, packing rapi.'], ['Budi P.', 'Selimut jadi bersih banget, wanginya tahan lama. Recommended!']]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as [$reviewer, $review]): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <div class="rounded-xl border border-slate-100 bg-slate-50/60 p-4">
                            <p class="text-xs font-extrabold text-slate-800"><?php echo e($reviewer); ?></p>
                            <p class="mt-1 text-[11px] leading-5 text-slate-500">“<?php echo e($review); ?>”</p>
                        </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </div>
            </div>
        <?php else: ?>
            <div class="mt-4 rounded-2xl border border-emerald-100 bg-white p-5 shadow-sm">
                <h2 class="text-sm font-extrabold text-slate-900">Kebijakan Antar-Jemput</h2>
                <ul class="mt-3 grid gap-2 text-xs leading-5 text-slate-600 sm:grid-cols-2">
                    <li class="flex gap-2"><span class="text-emerald-500">✓</span> Gratis antar-jemput untuk radius 2 km dari outlet <?php echo e($tenant->name); ?>.</li>
                    <li class="flex gap-2"><span class="text-emerald-500">✓</span> Penjemputan dijadwalkan sesuai slot waktu yang kamu pilih.</li>
                    <li class="flex gap-2"><span class="text-emerald-500">✓</span> Berat aktual ditimbang ulang saat pesanan diterima.</li>
                    <li class="flex gap-2"><span class="text-emerald-500">✓</span> Garansi cuci ulang bila hasil tidak sesuai standar.</li>
                </ul>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <div class="mt-6 grid gap-6 lg:grid-cols-[minmax(0,1fr)_360px]">
            <div class="min-w-0 space-y-6">
                <section>
                    <div class="flex flex-wrap items-end justify-between gap-2">
                        <h2 class="text-2xl font-extrabold tracking-tight text-slate-950">Katalog Layanan Cuci</h2>
                        <p class="text-xs text-slate-500">Pilih paket sesuai kebutuhan pakaian Anda</p>
                    </div>

                    <div class="mt-4 space-y-3">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <?php $selected = $selectedService && $selectedService->id === $service->id; ?>
                            <article <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'detail-service-'.e($service->id).''; ?>wire:key="detail-service-<?php echo e($service->id); ?>" class="rounded-2xl border <?php echo e($selected ? 'border-blue-300 bg-blue-50/30 ring-1 ring-blue-200' : 'border-slate-200 bg-white'); ?> p-4 shadow-sm transition sm:p-5">
                                <div class="flex flex-wrap items-start gap-4">
                                    <div class="grid h-12 w-12 shrink-0 place-items-center rounded-xl <?php echo e($selected ? 'bg-blue-600 text-white' : 'bg-blue-50 text-blue-600'); ?>">
                                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="3" width="16" height="18" rx="3"/><circle cx="12" cy="14" r="4"/><path d="M8 7h.01M11 7h.01"/></svg>
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <div class="flex flex-wrap items-center gap-2">
                                            <h3 class="text-base font-extrabold text-slate-900"><?php echo e($service->name); ?></h3>
                                            <span class="rounded-md <?php echo e($selected ? 'bg-blue-600 text-white' : 'bg-amber-100 text-amber-700'); ?> px-2 py-0.5 text-[9px] font-extrabold"><?php echo e($badges[$loop->index % count($badges)]); ?></span>
                                        </div>
                                        <p class="mt-1 text-[11px] font-medium text-slate-500">
                                            <span class="text-blue-600">◔</span> <?php echo e((int) ($service->estimated_duration ?? 2)); ?> hari kerja
                                            <span class="mx-1 text-slate-300">•</span>
                                            <span class="font-bold text-emerald-600">Tersedia</span>
                                        </p>
                                        <p class="mt-2 text-xs leading-5 text-slate-500"><?php echo e($service->description ?: 'Dicuci bersih, dikeringkan, disetrika rapi, dan dikemas higienis sesuai standar mitra.'); ?></p>
                                        <div class="mt-3 flex flex-wrap gap-2 text-[10px] font-semibold text-slate-500">
                                            <span class="inline-flex items-center gap-1 rounded-md bg-slate-100 px-2 py-1"><span class="text-blue-500">✓</span> Lipat Rapi</span>
                                            <span class="inline-flex items-center gap-1 rounded-md bg-slate-100 px-2 py-1"><span class="text-emerald-500">✓</span> Seal Kedap Udara</span>
                                        </div>
                                    </div>
                                    <div class="flex w-full flex-col items-end gap-3 sm:w-auto">
                                        <p class="text-right">
                                            <span class="text-xl font-extrabold tracking-tight text-blue-700">Rp<?php echo e(number_format((float) $service->price, 0, ',', '.')); ?></span>
                                            <span class="text-[11px] font-semibold text-slate-400">/<?php echo e(strtolower($service->unit) === 'kg' ? 'kg' : 'item'); ?></span>
                                        </p>
                                        <button type="button" wire:click="selectService(<?php echo e($service->id); ?>)" class="inline-flex items-center gap-1.5 rounded-lg px-4 py-2 text-[11px] font-bold transition <?php echo e($selected ? 'bg-blue-700 text-white shadow-sm' : 'border border-slate-300 bg-white text-slate-600 hover:border-blue-300 hover:text-blue-700'); ?>">
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($selected): ?>
                                                <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"><path d="M20 6 9 17l-5-5"/></svg>
                                                Layanan Terpilih
                                            <?php else: ?>
                                                + Pilih Layanan
                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        </button>
                                    </div>
                                </div>
                            </article>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            <div class="rounded-2xl border border-dashed border-slate-300 bg-white px-6 py-14 text-center">
                                <h3 class="text-base font-extrabold text-slate-900">Layanan belum tersedia</h3>
                                <p class="mt-1 text-sm text-slate-500">Mitra ini belum menambahkan katalog layanan. Silakan cek mitra lain.</p>
                                <a href="<?php echo e(route('customer.services')); ?>" class="mt-4 inline-flex rounded-xl bg-blue-600 px-5 py-2.5 text-xs font-bold text-white transition hover:bg-blue-700">Cari Mitra Lain</a>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </section>

                <section class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                    <div class="flex flex-wrap items-end justify-between gap-2">
                        <div>
                            <h2 class="text-xl font-extrabold tracking-tight text-slate-950">Fasilitas Workshop <?php echo e($tenant->name); ?></h2>
                            <p class="mt-1 text-xs text-slate-500">Kondisi riil operasional dan teknologi pencucian kami</p>
                        </div>
                        <span class="rounded-full bg-emerald-50 px-3 py-1 text-[10px] font-bold text-emerald-700">Terverifikasi Lapangan</span>
                    </div>
                    <div class="mt-4 grid gap-3 sm:grid-cols-3">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = [
                            ['https://images.unsplash.com/photo-1517677208171-0bc6725a3e60?auto=format&fit=crop&w=600&q=80', 'Mesin Industri LG Commercial', 'Putaran halus, tidak merusak serat baju'],
                            ['https://images.unsplash.com/photo-1582735689369-4fe89db7114c?auto=format&fit=crop&w=600&q=80', 'Setrika Uap Boiler Gas', 'Anti-gosong dan lipatan tajam presisi'],
                            ['https://images.unsplash.com/photo-1610557892470-55d9e80c0bce?auto=format&fit=crop&w=600&q=80', 'Parfum Grade-A & Eco Soap', 'Aman untuk kulit sensitif dan bayi'],
                        ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as [$image, $title, $caption]): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <figure class="overflow-hidden rounded-xl border border-slate-100 bg-slate-50">
                                <img src="<?php echo e($image); ?>" alt="<?php echo e($title); ?>" class="h-32 w-full object-cover" loading="lazy" onerror="this.style.display='none'">
                                <figcaption class="p-3">
                                    <p class="text-[11px] font-extrabold text-slate-800"><?php echo e($title); ?></p>
                                    <p class="mt-0.5 text-[10px] leading-4 text-slate-500"><?php echo e($caption); ?></p>
                                </figcaption>
                            </figure>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </div>
                </section>

                <section class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                    <h2 class="text-xl font-extrabold tracking-tight text-slate-950">Lokasi &amp; Jangkauan Outlet</h2>
                    <p class="mt-1 text-xs text-slate-500">Outlet <?php echo e($tenant->name); ?> siap melayani penjemputan di area sekitar <?php echo e($tenant->address ?: 'kota Anda'); ?>.</p>
                    <div class="relative mt-4 h-64 overflow-hidden rounded-xl border border-slate-200 bg-[#eef3f1]">
                        <div class="absolute inset-0 opacity-70" style="background-image:linear-gradient(#dbe7e3 1px,transparent 1px),linear-gradient(90deg,#dbe7e3 1px,transparent 1px);background-size:48px 48px"></div>
                        <div class="absolute left-[18%] top-[28%] h-24 w-40 rounded-lg bg-[#cfe3dc]"></div>
                        <div class="absolute right-[12%] top-[18%] h-32 w-36 rounded-lg bg-[#d8e8e4]"></div>
                        <div class="absolute bottom-[10%] left-[38%] h-20 w-52 rounded-lg bg-[#cfe3dc]"></div>
                        <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 text-center">
                            <span class="mx-auto grid h-10 w-10 place-items-center rounded-full border-4 border-white bg-blue-600 text-white shadow-lg">
                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 10c0 5-8 11-8 11S4 15 4 10a8 8 0 1 1 16 0Z"/><circle cx="12" cy="10" r="2.5"/></svg>
                            </span>
                            <span class="mt-1 inline-block rounded-md bg-white px-2 py-1 text-[10px] font-extrabold text-slate-700 shadow"><?php echo e($tenant->name); ?></span>
                        </div>
                    </div>
                </section>
            </div>

            <aside class="min-w-0">
                <div class="sticky top-24 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                    <div class="flex items-center justify-between gap-2">
                        <h2 class="flex items-center gap-2 text-base font-extrabold text-slate-900">
                            <svg class="h-4 w-4 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9"><path d="M4 5h16v14H4z"/><path d="M8 9h8M8 13h5"/></svg>
                            Ringkasan Pilihan
                        </h2>
                        <span class="rounded-md bg-blue-50 px-2 py-1 text-[9px] font-extrabold text-blue-700">Mitra <?php echo e($tenant->name); ?></span>
                    </div>

                    <div class="mt-4 flex items-center gap-3 rounded-xl border border-slate-100 bg-slate-50/70 p-3">
                        <span class="grid h-9 w-9 place-items-center rounded-lg bg-blue-600 text-[11px] font-extrabold text-white"><?php echo e($initials ?: 'LM'); ?></span>
                        <div class="min-w-0">
                            <p class="truncate text-xs font-extrabold text-slate-800"><?php echo e($tenant->name); ?></p>
                            <p class="truncate text-[10px] text-slate-500"><?php echo e($tenant->address ?: 'Alamat belum tersedia'); ?></p>
                        </div>
                    </div>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($selectedService): ?>
                        <div class="mt-4">
                            <p class="text-[10px] font-extrabold uppercase tracking-[0.12em] text-slate-400">Layanan Terpilih:</p>
                            <div class="mt-2 flex items-start justify-between gap-2">
                                <div>
                                    <p class="text-sm font-extrabold text-blue-700"><?php echo e($selectedService->name); ?></p>
                                    <p class="mt-0.5 text-[10px] text-slate-500">Estimasi pengerjaan: <?php echo e((int) ($selectedService->estimated_duration ?? 2)); ?> hari kerja</p>
                                </div>
                                <p class="whitespace-nowrap text-xs font-extrabold text-slate-800">Rp<?php echo e(number_format((float) $selectedService->price, 0, ',', '.')); ?><span class="text-[10px] font-semibold text-slate-400">/<?php echo e(strtolower($selectedService->unit) === 'kg' ? 'kg' : 'item'); ?></span></p>
                            </div>

                            <div class="mt-4 rounded-xl border border-slate-200 p-3">
                                <div class="flex items-center justify-between gap-2">
                                    <p class="text-[10px] font-extrabold text-slate-600">Estimasi Berat / Satuan</p>
                                    <span class="text-[9px] text-slate-400">Bisa diukur ulang di toko</span>
                                </div>
                                <div class="mt-2 flex items-center gap-2">
                                    <button type="button" wire:click="decrementWeight" class="grid h-9 w-9 place-items-center rounded-lg border border-slate-200 bg-white text-slate-500 transition hover:border-blue-300 hover:text-blue-600">−</button>
                                    <span class="min-w-10 rounded-lg bg-slate-50 px-3 py-2 text-center text-lg font-extrabold text-slate-900"><?php echo e(rtrim(rtrim(number_format($weight, 2, ',', '.'), '0'), ',')); ?></span>
                                    <button type="button" wire:click="incrementWeight" class="grid h-9 w-9 place-items-center rounded-lg border border-slate-200 bg-white text-slate-500 transition hover:border-blue-300 hover:text-blue-600">+</button>
                                    <span class="text-xs font-semibold text-slate-500"><?php echo e(strtolower($selectedService->unit) === 'kg' ? 'kilogram (kg)' : 'satuan (item)'); ?></span>
                                </div>
                                <p class="mt-2 text-[10px] text-slate-400">Minimum order <?php echo e($minimumWeight); ?> <?php echo e(strtolower($selectedService->unit) === 'kg' ? 'kg' : 'item'); ?>.</p>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['weight'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-[10px] font-semibold text-red-600"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="mt-4 rounded-xl border border-dashed border-slate-200 bg-slate-50 px-4 py-6 text-center">
                            <p class="text-xs font-semibold text-slate-500">Pilih layanan untuk melihat ringkasan harga.</p>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['selectedServiceId'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-2 text-[10px] font-semibold text-red-600"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    <div class="mt-4 space-y-2 border-t border-dashed border-slate-200 pt-4 text-xs">
                        <div class="flex justify-between gap-2 text-slate-500"><span>Subtotal Layanan (<?php echo e(rtrim(rtrim(number_format($weight, 2, ',', '.'), '0'), ',')); ?> <?php echo e($selectedService && strtolower($selectedService->unit) === 'kg' ? 'kg' : 'item'); ?>)</span><span class="font-bold text-slate-800">Rp<?php echo e(number_format($subtotal, 0, ',', '.')); ?></span></div>
                        <div class="flex justify-between gap-2 text-slate-500"><span>Biaya Penjemputan</span><span class="font-bold text-emerald-600">GRATIS</span></div>
                        <div class="flex justify-between gap-2 text-slate-500"><span>Packing Seal Higienis</span><span class="font-bold text-emerald-600">Termasuk</span></div>
                    </div>

                    <div class="mt-4 flex items-center justify-between gap-2 border-t border-slate-200 pt-4">
                        <span class="text-sm font-extrabold text-slate-900">Total Estimasi</span>
                        <span class="text-2xl font-extrabold tracking-tight text-blue-700">Rp<?php echo e(number_format($subtotal, 0, ',', '.')); ?></span>
                    </div>

                    <button type="button" wire:click="orderNow" wire:loading.attr="disabled" wire:target="orderNow" <?php if(! $selectedService): echo 'disabled'; endif; ?> class="mt-4 inline-flex w-full items-center justify-center gap-2 rounded-xl bg-blue-700 px-4 py-3.5 text-sm font-bold text-white shadow-lg shadow-blue-700/20 transition hover:bg-blue-800 disabled:cursor-not-allowed disabled:bg-slate-300">
                        <span wire:loading.remove wire:target="orderNow">Pesan Sekarang di <?php echo e($tenant->name); ?></span>
                        <span wire:loading wire:target="orderNow">Mengarahkan...</span>
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="m9 6 6 6-6 6"/></svg>
                    </button>

                    <p class="mt-3 flex items-start gap-2 text-[10px] leading-4 text-slate-500">
                        <svg class="mt-0.5 h-3.5 w-3.5 shrink-0 text-blue-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="9"/><path d="M12 8h.01M11 12h1v4h1"/></svg>
                        Hanya melayani pesanan untuk cabang <?php echo e($tenant->name); ?>. Pembayaran aman lewat LaundryHub Pay atau COD.
                    </p>
                </div>

                <div class="mt-3 flex items-center justify-between gap-3 rounded-xl border border-blue-100 bg-blue-50/60 px-4 py-3">
                    <p class="text-[10px] leading-4 text-slate-600"><span class="font-extrabold text-blue-700">Ada paket khusus/bonus?</span><br>Konsultasikan langsung dengan staf <?php echo e($tenant->name); ?>.</p>
                    <a href="tel:<?php echo e($tenant->phone); ?>" class="shrink-0 rounded-lg bg-white px-3 py-2 text-[10px] font-extrabold text-blue-700 shadow-sm">Telepon</a>
                </div>
            </aside>
        </div>
    </section>
</div>
<?php /**PATH D:\laragon\www\Laundry-Multitenant-terintegrasi\Laundry-Multitenant\resources\views/livewire/tenant-detail.blade.php ENDPATH**/ ?>