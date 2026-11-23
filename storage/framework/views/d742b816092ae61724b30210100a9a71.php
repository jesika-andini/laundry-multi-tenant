<div>
    <section class="bg-gradient-to-b from-[#eef5ff] to-[#f6f8fc]">
        <div class="mx-auto max-w-7xl px-5 pb-8 pt-8">
            <nav class="flex items-center gap-2 text-[11px] font-semibold text-slate-500">
                <a href="<?php echo e(route('customer.home')); ?>" class="transition hover:text-blue-600">Beranda</a>
                <span class="text-slate-300">/</span>
                <span class="text-slate-700">Pesanan Saya</span>
            </nav>

            <div class="mt-5 flex flex-wrap items-end justify-between gap-4">
                <div>
                    <p class="flex items-center gap-2 text-[10px] font-extrabold uppercase tracking-[0.16em] text-blue-600">
                        <span class="h-1.5 w-1.5 rounded-full bg-blue-600"></span>
                        Tracking Portal Pelanggan
                    </p>
                    <h1 class="mt-2 text-3xl font-extrabold tracking-tight text-slate-950 sm:text-4xl">Pesanan Saya</h1>
                    <p class="mt-1 text-sm text-slate-500">Pantau status cucian dan lacak setiap tahap pesananmu secara real-time.</p>
                </div>
                <a href="<?php echo e(route('customer.services')); ?>" class="inline-flex items-center gap-2 rounded-xl bg-blue-600 px-5 py-3 text-xs font-bold text-white shadow-lg shadow-blue-600/20 transition hover:bg-blue-700">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/></svg>
                    Cari Laundry Baru
                </a>
            </div>

            <div class="mt-5 grid gap-3 sm:grid-cols-3">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = [
                    ['Total Pesanan', $totalOrders, 'text-slate-900', 'bg-white'],
                    ['Pesanan Aktif', $activeOrders, 'text-blue-700', 'bg-blue-50/70'],
                    ['Selesai', $completedOrders, 'text-emerald-700', 'bg-emerald-50/70'],
                ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as [$label, $value, $color, $bg]): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <div class="rounded-xl border border-slate-200/70 <?php echo e($bg); ?> px-4 py-3.5 shadow-sm">
                        <p class="text-[10px] font-extrabold uppercase tracking-[0.12em] text-slate-400"><?php echo e($label); ?></p>
                        <p class="mt-1 text-2xl font-extrabold tracking-tight <?php echo e($color); ?>"><?php echo e($value); ?></p>
                    </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-5 pb-16">
        <div class="flex flex-wrap items-center justify-between gap-3 rounded-2xl border border-slate-200/80 bg-white p-2 shadow-sm">
            <div class="flex flex-wrap gap-1">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = ['semua' => 'Semua', 'aktif' => 'Aktif', 'selesai' => 'Selesai']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <button type="button" wire:click="setFilter('<?php echo e($key); ?>')" class="rounded-xl px-4 py-2.5 text-xs font-bold transition <?php echo e($filter === $key ? 'bg-blue-600 text-white shadow-sm' : 'text-slate-500 hover:bg-slate-50 hover:text-blue-600'); ?>"><?php echo e($label); ?></button>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </div>
            <p class="px-3 text-[11px] font-medium text-slate-500">Menampilkan <?php echo e($orders->count()); ?> dari <?php echo e($orders->total()); ?> pesanan</p>
        </div>

        <div class="mt-4 space-y-3.5">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <?php
                    $step = $this->stepForStatus($order->status);
                    $progress = $this->progressForStatus($order->status);
                    $unit = strtolower((string) ($order->service?->unit ?? 'kg')) === 'kg' ? 'kg' : 'item';
                    $weightLabel = rtrim(rtrim(number_format((float) $order->weight, 2, ',', '.'), '0'), ',');
                    $initials = collect(explode(' ', (string) $order->tenant?->name))->filter()->take(2)->map(fn ($word) => mb_strtoupper(mb_substr($word, 0, 1)))->implode('');
                ?>

                <article <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'order-'.e($order->id).''; ?>wire:key="order-<?php echo e($order->id); ?>" class="overflow-hidden rounded-2xl border border-slate-200/80 bg-white shadow-sm transition hover:border-blue-200 hover:shadow-lg hover:shadow-blue-950/5">
                    <div class="flex flex-wrap items-center justify-between gap-3 border-b border-slate-100 bg-slate-50/50 px-4 py-3 sm:px-5">
                        <div class="flex items-center gap-3">
                            <span class="grid h-10 w-10 place-items-center rounded-xl bg-blue-600 text-xs font-extrabold text-white"><?php echo e($initials ?: 'LM'); ?></span>
                            <div>
                                <p class="text-sm font-extrabold text-slate-900"><?php echo e($order->tenant?->name ?? 'Mitra Laundry'); ?></p>
                                <p class="mt-0.5 text-[10px] font-medium text-slate-500">#<?php echo e($order->order_code); ?> <span class="mx-1 text-slate-300">•</span> <?php echo e($order->created_at?->locale('id')->translatedFormat('d M Y, H:i')); ?> WIB</p>
                            </div>
                        </div>
                        <span class="rounded-full px-3 py-1 text-[10px] font-extrabold <?php echo e($this->statusClasses($order->status)); ?>"><?php echo e($this->statusLabel($order->status)); ?></span>
                    </div>

                    <div class="grid gap-4 p-4 sm:p-5 lg:grid-cols-[minmax(0,1fr)_auto]">
                        <div class="min-w-0">
                            <p class="text-base font-extrabold text-slate-900"><?php echo e($order->service?->name ?? 'Layanan Laundry'); ?></p>
                            <div class="mt-2 flex flex-wrap items-center gap-x-4 gap-y-1.5 text-[11px] text-slate-500">
                                <span class="inline-flex items-center gap-1.5"><svg class="h-3.5 w-3.5 text-blue-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 7h16M4 12h10M4 17h7"/></svg><?php echo e($weightLabel); ?> <?php echo e($unit); ?></span>
                                <span class="inline-flex items-center gap-1.5"><svg class="h-3.5 w-3.5 text-blue-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="6" width="18" height="12" rx="2"/><path d="M3 10h18"/></svg><?php echo e($order->payment_method ?: 'Pembayaran belum dipilih'); ?></span>
                                <span class="inline-flex items-center gap-1.5"><svg class="h-3.5 w-3.5 text-blue-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 7h11v8H3zM14 10h4l3 3v2h-7z"/><circle cx="7" cy="18" r="2"/><circle cx="18" cy="18" r="2"/></svg><?php echo e($order->pickup_type === 'dropoff' ? 'Datang langsung' : ($order->pickup_type === 'pickup' ? 'Antar-jemput mitra' : 'Penyerahan belum diatur')); ?></span>
                            </div>

                            <div class="mt-4">
                                <div class="flex items-center justify-between gap-2 text-[10px] font-semibold text-slate-500">
                                    <span><?php echo e($step === 2 ? 'Siap Diambil' : 'Sedang Diproses'); ?></span>
                                    <span class="font-extrabold text-blue-700"><?php echo e($progress); ?>%</span>
                                </div>
                                <div class="mt-1.5 h-2 overflow-hidden rounded-full bg-slate-100">
                                    <div class="h-full rounded-full bg-gradient-to-r from-blue-600 to-cyan-400 transition-all" style="width: <?php echo e($progress); ?>%"></div>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-row items-end justify-between gap-3 border-t border-slate-100 pt-3 lg:w-56 lg:flex-col lg:items-end lg:border-l lg:border-t-0 lg:pl-5 lg:pt-0">
                            <div class="text-right">
                                <p class="text-[10px] font-semibold text-slate-400">Total Pesanan</p>
                                <p class="text-xl font-extrabold tracking-tight text-blue-700">Rp<?php echo e(number_format((float) ($order->total_price ?? $order->total ?? 0), 0, ',', '.')); ?></p>
                            </div>
                            <a href="<?php echo e(route('customer.orders.show', $order->id)); ?>" class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-4 py-2.5 text-[11px] font-bold text-white shadow-sm transition hover:bg-blue-700">
                                <?php echo e($order->status === 'Selesai' ? 'Lihat Detail' : 'Lacak Pesanan'); ?>

                                <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="m9 6 6 6-6 6"/></svg>
                            </a>
                        </div>
                    </div>
                </article>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                <div class="rounded-2xl border border-dashed border-slate-300 bg-white px-6 py-16 text-center">
                    <div class="mx-auto grid h-16 w-16 place-items-center rounded-2xl bg-blue-50 text-blue-600">
                        <svg class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2h9l5 5v13a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2Z"/><path d="M14 2v6h6M8 13h8M8 17h5"/></svg>
                    </div>
                    <h2 class="mt-4 text-lg font-extrabold text-slate-900"><?php echo e($filter === 'semua' ? 'Belum ada pesanan' : 'Tidak ada pesanan di kategori ini'); ?></h2>
                    <p class="mt-2 text-sm text-slate-500">Yuk mulai pesan cucian pertamamu dari mitra laundry terpercaya di sekitarmu.</p>
                    <a href="<?php echo e(route('customer.services')); ?>" class="mt-5 inline-flex rounded-xl bg-blue-600 px-5 py-2.5 text-sm font-bold text-white transition hover:bg-blue-700">Cari Laundry</a>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($orders->hasPages()): ?>
            <div class="mt-6">
                <?php echo e($orders->links()); ?>

            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </section>
</div>
<?php /**PATH D:\laragon\www\Laundry-Multitenant-terintegrasi\Laundry-Multitenant\resources\views\livewire\customer-orders.blade.php ENDPATH**/ ?>