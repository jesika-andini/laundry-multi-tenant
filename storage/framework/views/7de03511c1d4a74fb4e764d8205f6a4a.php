<div>
    <section class="bg-gradient-to-b from-[#eef5ff] to-[#f6f8fc]">
        <div class="mx-auto max-w-7xl px-5 pb-7 pt-7">
            <nav class="flex items-center gap-2 text-[11px] font-semibold text-slate-500">
                <a href="<?php echo e(route('customer.home')); ?>" class="transition hover:text-blue-600">Beranda</a>
                <span class="text-slate-300">/</span>
                <a href="<?php echo e(route('customer.orders.index')); ?>" class="transition hover:text-blue-600">Pesanan Saya</a>
                <span class="text-slate-300">/</span>
                <span class="text-slate-700">Lacak Pesanan</span>
            </nav>

            <div class="mt-5 overflow-hidden rounded-2xl border border-blue-100 bg-white shadow-lg shadow-blue-950/5">
                <div class="h-1 bg-gradient-to-r from-blue-600 via-cyan-400 to-emerald-400"></div>
                <div class="flex flex-wrap items-start justify-between gap-5 p-5 sm:p-6">
                    <div class="min-w-0">
                        <p class="flex flex-wrap items-center gap-2 text-[9px] font-extrabold uppercase tracking-[0.16em] text-blue-600">
                            <span class="inline-flex items-center gap-1.5"><span class="relative flex h-2 w-2"><span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-emerald-400 opacity-60"></span><span class="relative inline-flex h-2 w-2 rounded-full bg-emerald-500"></span></span>Tracking Portal Pelanggan</span>
                            <span class="text-slate-300">•</span>
                            <span class="text-slate-500"><?php echo e($order->tenant?->name ?? 'Mitra Laundry'); ?> Verified</span>
                        </p>
                        <h1 class="mt-2 break-words text-2xl font-extrabold tracking-tight text-slate-950 sm:text-3xl">Lacak Pesanan <span class="text-blue-700">#<?php echo e($order->order_code); ?></span></h1>
                        <div class="mt-3 flex flex-wrap items-center gap-2">
                            <span class="rounded-full px-3 py-1 text-[10px] font-extrabold ring-1 <?php echo e($this->statusClasses($order->status)); ?>"><?php echo e($this->statusLabel($order->status)); ?></span>
                            <span class="rounded-full bg-slate-100 px-3 py-1 text-[10px] font-bold text-slate-600">Estimasi selesai: <?php echo e($estimatedReady); ?></span>
                        </div>
                        <p class="mt-2 text-[11px] text-slate-500">Data disinkronkan otomatis dari outlet. Terakhir diperbarui <?php echo e($order->updated_at?->locale('id')->diffForHumans() ?? 'baru saja'); ?>.</p>
                    </div>

                    <div class="flex flex-wrap gap-2">
                        <a href="<?php echo e($whatsappUrl); ?>" target="_blank" rel="noopener" class="inline-flex items-center gap-2 rounded-xl bg-emerald-500 px-4 py-2.5 text-[11px] font-bold text-white shadow-sm transition hover:bg-emerald-600">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><path d="M12.04 2a9.9 9.9 0 0 0-8.5 15L2 22l5.15-1.5A9.94 9.94 0 1 0 12.04 2Zm0 1.8a8.14 8.14 0 1 1-4.1 15.15l-.3-.18-3.05.9.9-2.98-.2-.31A8.14 8.14 0 0 1 12.04 3.8Zm-3.1 4.3c-.16 0-.42.06-.64.3-.22.24-.84.82-.84 2s.86 2.32.98 2.48c.12.16 1.65 2.63 4.08 3.58 2.02.8 2.43.64 2.87.6.44-.04 1.42-.58 1.62-1.14.2-.56.2-1.04.14-1.14-.06-.1-.22-.16-.46-.28-.24-.12-1.42-.7-1.64-.78-.22-.08-.38-.12-.54.12-.16.24-.62.78-.76.94-.14.16-.28.18-.52.06-.24-.12-1.01-.37-1.93-1.19-.71-.64-1.19-1.42-1.33-1.66-.14-.24-.02-.37.1-.49.1-.1.24-.28.36-.42.12-.14.16-.24.24-.4.08-.16.04-.3-.02-.42-.06-.12-.54-1.3-.74-1.78-.2-.46-.4-.4-.54-.4h-.46Z"/></svg>
                            Hubungi Mitra
                        </a>
                        <button type="button" wire:click="toggleDetail" class="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-[11px] font-bold text-slate-700 shadow-sm transition hover:border-blue-200 hover:text-blue-700">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 2h9l5 5v13a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2Z"/><path d="M14 2v6h6M8 13h8M8 17h5"/></svg>
                            Rincian Nota Digital
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-5 pb-16">
        <div class="grid gap-5 lg:grid-cols-[minmax(0,1.55fr)_minmax(0,1fr)]">
            <div class="space-y-5">
                <div class="rounded-2xl border border-slate-200/80 bg-white p-5 shadow-sm sm:p-6">
                    <div class="flex flex-wrap items-start justify-between gap-3">
                        <div>
                            <h2 class="text-lg font-extrabold tracking-tight text-slate-950">Tahapan &amp; Progres Cucian</h2>
                            <p class="mt-1 text-[11px] text-slate-500">Pantau status cucianmu dalam dua tahap sederhana.</p>
                        </div>
                        <div class="rounded-xl bg-blue-50 px-3.5 py-2 text-right">
                            <p class="text-[9px] font-extrabold uppercase tracking-[0.12em] text-blue-500">Tahap <?php echo e($currentStep); ?> dari 2</p>
                            <p class="text-lg font-extrabold leading-none text-blue-700"><?php echo e($progress); ?>%</p>
                        </div>
                    </div>

                    <div class="mt-4 h-2 overflow-hidden rounded-full bg-slate-100">
                        <div class="h-full rounded-full bg-gradient-to-r from-blue-600 to-cyan-400 transition-all" style="width: <?php echo e($progress); ?>%"></div>
                    </div>

                    <ol class="mt-6">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $steps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $step): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <?php
                                $circle = match ($step['state']) {
                                    'done' => 'border-emerald-500 bg-emerald-500 text-white',
                                    'active' => 'border-blue-600 bg-blue-600 text-white ring-4 ring-blue-100',
                                    default => 'border-slate-200 bg-white text-slate-300',
                                };
                                $line = $step['state'] === 'done' ? 'bg-emerald-200' : 'bg-slate-200';
                                $title = $step['state'] === 'pending' ? 'text-slate-400' : 'text-slate-900';
                            ?>
                            <li <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'step-'.e($step['number']).''; ?>wire:key="step-<?php echo e($step['number']); ?>" class="relative flex gap-4 pb-6 last:pb-0">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(! $loop->last): ?>
                                    <span class="absolute left-[15px] top-9 h-[calc(100%-1.35rem)] w-0.5 <?php echo e($line); ?>"></span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <span class="relative z-10 mt-0.5 grid h-8 w-8 shrink-0 place-items-center rounded-full border-2 <?php echo e($circle); ?>">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($step['state'] === 'done'): ?>
                                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="m5 12 4 4L19 6"/></svg>
                                    <?php elseif($step['state'] === 'active'): ?>
                                        <span class="h-2.5 w-2.5 rounded-full bg-white"></span>
                                    <?php else: ?>
                                        <span class="text-[10px] font-extrabold"><?php echo e($step['number']); ?></span>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </span>

                                <div class="min-w-0 flex-1 pt-0.5">
                                    <div class="flex flex-wrap items-center gap-2">
                                        <h3 class="text-xs font-extrabold <?php echo e($title); ?>"><?php echo e($step['title']); ?></h3>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($step['state'] === 'active'): ?>
                                            <span class="rounded-full px-2 py-0.5 text-[8px] font-extrabold uppercase tracking-wide <?php echo e($currentStep === 2 ? 'bg-emerald-100 text-emerald-700' : 'bg-blue-100 text-blue-700'); ?>"><?php echo e($currentStep === 2 ? 'Siap diambil' : 'Sedang berjalan'); ?></span>
                                        <?php elseif($step['state'] === 'pending'): ?>
                                            <span class="rounded-full bg-slate-100 px-2 py-0.5 text-[8px] font-extrabold uppercase tracking-wide text-slate-400">Menunggu</span>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </div>
                                    <p class="mt-1 text-[11px] leading-5 <?php echo e($step['state'] === 'pending' ? 'text-slate-400' : 'text-slate-500'); ?>"><?php echo e($step['description']); ?></p>
                                    <p class="mt-1.5 text-[10px] font-semibold <?php echo e($step['state'] === 'active' ? 'text-blue-600' : 'text-slate-400'); ?>"><?php echo e($step['time']); ?></p>

                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($step['state'] === 'active'): ?>
                                        <div class="mt-3 rounded-xl border px-3.5 py-3 <?php echo e($currentStep === 2 ? 'border-emerald-100 bg-emerald-50/70' : 'border-blue-100 bg-blue-50/70'); ?>">
                                            <p class="text-[10px] leading-4 <?php echo e($currentStep === 2 ? 'text-emerald-700' : 'text-blue-700/80'); ?>"><?php echo e($currentStep === 2 ? 'Cucian sudah siap. Silakan ambil di outlet atau tunggu kurir mitra.' : 'Mitra sedang memproses cucianmu. Status akan diperbarui otomatis.'); ?></p>
                                        </div>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                            </li>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </ol>
                </div>

                <div class="rounded-2xl border border-amber-200 bg-amber-50/60 p-5">
                    <div class="flex gap-3">
                        <span class="grid h-9 w-9 shrink-0 place-items-center rounded-xl bg-amber-100 text-amber-600">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m12 3 9 16H3L12 3Z"/><path d="M12 9v4M12 16h.01"/></svg>
                        </span>
                        <div>
                            <h3 class="text-xs font-extrabold text-amber-900">Kebijakan Pembatalan &amp; Garansi</h3>
                            <p class="mt-1 text-[11px] leading-5 text-amber-800/80">Pesanan dapat dibatalkan sebelum status berubah menjadi <strong>Dicuci</strong>. Jika ada kendala hasil cucian, hubungi mitra melalui tombol WhatsApp agar dapat ditindaklanjuti langsung.</p>
                        </div>
                    </div>
                </div>
            </div>

            <aside class="space-y-5">
                <div class="overflow-hidden rounded-2xl border border-slate-200/80 bg-white shadow-sm">
                    <div class="flex items-center justify-between gap-2 border-b border-slate-100 bg-slate-50/60 px-5 py-3.5">
                        <h2 class="text-xs font-extrabold uppercase tracking-[0.12em] text-slate-500">Rincian Paket Cucian</h2>
                        <span class="rounded-full bg-emerald-100 px-2.5 py-1 text-[8px] font-extrabold uppercase tracking-wide text-emerald-700">SOP Higienis</span>
                    </div>

                    <div class="p-5">
                        <div class="flex items-center gap-3">
                            <div class="relative grid h-16 w-16 shrink-0 place-items-center overflow-hidden rounded-xl bg-gradient-to-br from-blue-600 to-cyan-500 text-white shadow-md">
                                <svg class="h-8 w-8 opacity-90" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><circle cx="12" cy="12" r="8"/><circle cx="12" cy="12" r="3"/><path d="M8 6.5c1.5-1 6.5-1 8 0"/></svg>
                                <span class="absolute bottom-1 rounded bg-white/20 px-1 text-[6px] font-extrabold">PREMIUM</span>
                            </div>
                            <div class="min-w-0">
                                <p class="truncate text-sm font-extrabold text-slate-900"><?php echo e($order->service?->name ?? 'Layanan Laundry'); ?></p>
                                <p class="mt-0.5 text-[10px] text-slate-500"><?php echo e($weightLabel); ?> kg × Rp<?php echo e(number_format((float) ($order->service?->price ?? 0), 0, ',', '.')); ?>/kg</p>
                                <p class="mt-1 text-[9px] font-semibold text-blue-600"><?php echo e($order->service?->estimated_duration ?? 2); ?> hari pengerjaan • <?php echo e($pickupLabel); ?></p>
                            </div>
                        </div>

                        <dl class="mt-4 space-y-2 border-t border-dashed border-slate-200 pt-3 text-[11px]">
                            <?php $subtotal = (float) ($order->service?->price ?? 0) * (float) $order->weight; ?>
                            <div class="flex justify-between gap-3"><dt class="text-slate-500">Subtotal cucian</dt><dd class="font-bold text-slate-800">Rp<?php echo e(number_format($subtotal, 0, ',', '.')); ?></dd></div>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if((float) ($order->delivery_fee ?? 0) > 0): ?>
                                <div class="flex justify-between gap-3"><dt class="text-slate-500">Biaya antar-jemput</dt><dd class="font-bold text-slate-800">Rp<?php echo e(number_format((float) $order->delivery_fee, 0, ',', '.')); ?></dd></div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if((float) ($order->platform_fee ?? 0) > 0): ?>
                                <div class="flex justify-between gap-3"><dt class="text-slate-500">Biaya layanan platform</dt><dd class="font-bold text-slate-800">Rp<?php echo e(number_format((float) $order->platform_fee, 0, ',', '.')); ?></dd></div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if((float) ($order->discount ?? 0) > 0): ?>
                                <div class="flex justify-between gap-3"><dt class="text-slate-500">Diskon<?php echo e($order->voucher_code ? ' ('.$order->voucher_code.')' : ''); ?></dt><dd class="font-bold text-emerald-600">−Rp<?php echo e(number_format((float) $order->discount, 0, ',', '.')); ?></dd></div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <div class="flex items-baseline justify-between gap-3 border-t border-slate-200 pt-3">
                                <dt class="text-[10px] font-extrabold uppercase tracking-wide text-slate-500">Total dibayar</dt>
                                <dd class="text-xl font-extrabold tracking-tight text-blue-700">Rp<?php echo e($totalLabel); ?></dd>
                            </div>
                        </dl>

                        <div class="mt-4 rounded-xl bg-slate-50 p-3">
                            <div class="flex flex-wrap items-center justify-between gap-2">
                                <span class="text-[10px] font-semibold text-slate-500"><?php echo e($paymentMethod); ?></span>
                                <span class="rounded-full px-2 py-0.5 text-[8px] font-extrabold uppercase tracking-wide <?php echo e($this->paymentClasses($paymentStatus)); ?>"><?php echo e($paymentStatus); ?></span>
                            </div>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($order->customer_note): ?>
                                <p class="mt-2 border-t border-slate-200 pt-2 text-[10px] leading-4 text-slate-500"><span class="font-extrabold text-slate-700">Catatan:</span> <?php echo e($order->customer_note); ?></p>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>

                        <div class="mt-4 grid gap-2">
                            <a href="<?php echo e(route('customer.orders.invoice', $order->id)); ?>" target="_blank" class="inline-flex items-center justify-center gap-2 rounded-xl border border-blue-200 bg-blue-50 px-4 py-2.5 text-[10px] font-extrabold text-blue-700 transition hover:bg-blue-100">
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 3v12M7 10l5 5 5-5"/><path d="M5 21h14"/></svg>
                                Unduh Invoice PDF
                            </a>

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($order->status === 'Selesai'): ?>
                                <a href="<?php echo e($whatsappUrl); ?>" target="_blank" rel="noopener" class="inline-flex items-center justify-center gap-2 rounded-xl border border-amber-200 bg-amber-50 px-4 py-2.5 text-[10px] font-extrabold text-amber-700 transition hover:bg-amber-100">
                                    <span class="text-amber-400">★★★★★</span> Beri Penilaian via WhatsApp
                                </a>
                            <?php else: ?>
                                <button type="button" disabled class="inline-flex cursor-not-allowed items-center justify-center gap-2 rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-[10px] font-extrabold text-slate-400" title="Tersedia setelah pesanan selesai">
                                    <span class="text-slate-300">★★★★★</span> Beri Penilaian
                                </button>
                                <p class="text-center text-[9px] text-slate-400">Penilaian tersedia setelah pesanan selesai.</p>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="rounded-2xl border border-slate-200/80 bg-white p-5 shadow-sm">
                    <h2 class="text-[10px] font-extrabold uppercase tracking-[0.12em] text-slate-400"><?php echo e($order->pickup_type === 'pickup' ? 'Kurir Penjemput' : 'Info Penyerahan'); ?></h2>
                    <div class="mt-3 flex items-center gap-3">
                        <span class="grid h-11 w-11 shrink-0 place-items-center rounded-full bg-blue-100 text-blue-700">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="8" r="3.5"/><path d="M5 21c0-4 3.5-6 7-6s7 2 7 6"/></svg>
                        </span>
                        <div class="min-w-0">
                            <p class="truncate text-xs font-extrabold text-slate-900"><?php echo e($courierLabel); ?></p>
                            <p class="mt-0.5 text-[10px] text-slate-500"><?php echo e($order->pickup_type === 'pickup' ? 'Armada mitra • Standby' : $pickupLabel); ?></p>
                        </div>
                        <span class="ml-auto rounded-full bg-emerald-100 px-2 py-1 text-[8px] font-extrabold text-emerald-700">Aktif</span>
                    </div>
                    <div class="mt-3 flex items-center justify-between gap-2 border-t border-slate-100 pt-3 text-[10px]">
                        <span class="font-semibold text-slate-500">Kontak mitra</span>
                        <a href="tel:<?php echo e($courierPhone); ?>" class="font-extrabold text-blue-700"><?php echo e($courierPhone); ?></a>
                    </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($order->address): ?>
                        <p class="mt-2 rounded-lg bg-slate-50 px-3 py-2 text-[10px] leading-4 text-slate-500"><?php echo e($order->address); ?></p>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                <div class="overflow-hidden rounded-2xl border border-slate-200/80 bg-white shadow-sm">
                    <div class="relative h-28 overflow-hidden bg-gradient-to-br from-[#dbeafe] via-[#e0f2fe] to-[#dcfce7]">
                        <div class="absolute inset-0 opacity-60" style="background-image: linear-gradient(rgba(255,255,255,.55) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,.55) 1px, transparent 1px); background-size: 26px 26px;"></div>
                        <div class="absolute left-[22%] top-0 h-full w-5 rotate-12 bg-white/70"></div>
                        <div class="absolute left-0 top-[58%] h-4 w-full -rotate-3 bg-white/70"></div>
                        <span class="absolute left-1/2 top-1/2 grid h-9 w-9 -translate-x-1/2 -translate-y-1/2 place-items-center rounded-full border-4 border-white bg-blue-600 text-white shadow-lg">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 10c0 5-8 11-8 11S4 15 4 10a8 8 0 1 1 16 0Z"/><circle cx="12" cy="10" r="2.5"/></svg>
                        </span>
                    </div>
                    <div class="p-5">
                        <p class="text-[9px] font-extrabold uppercase tracking-[0.12em] text-slate-400">Lokasi Outlet Mitra</p>
                        <p class="mt-1 text-xs font-extrabold text-slate-900"><?php echo e($order->tenant?->name ?? 'Mitra Laundry'); ?></p>
                        <p class="mt-1 text-[10px] leading-4 text-slate-500"><?php echo e($order->tenant?->address ?: 'Alamat outlet akan dikonfirmasi oleh mitra.'); ?></p>
                        <div class="mt-2 flex items-center justify-between gap-2 text-[10px]">
                            <span class="font-semibold text-slate-500">Jam operasional</span>
                            <span class="font-extrabold text-emerald-600">Buka • 08.00–21.00</span>
                        </div>
                    </div>
                </div>
            </aside>
        </div>

        <div class="mt-5 flex flex-wrap items-center justify-between gap-3 rounded-2xl border border-slate-200 bg-white px-5 py-4 shadow-sm">
            <a href="<?php echo e(route('customer.orders.index')); ?>" class="inline-flex items-center gap-2 text-[11px] font-extrabold text-slate-500 transition hover:text-blue-700">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="m15 6-6 6 6 6"/></svg>
                Kembali ke Pesanan Saya
            </a>
            <a href="<?php echo e($whatsappUrl); ?>" target="_blank" rel="noopener" class="inline-flex items-center gap-2 rounded-xl bg-slate-900 px-4 py-2.5 text-[10px] font-extrabold text-white transition hover:bg-slate-800">
                Butuh bantuan? Chat mitra
                <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
            </a>
        </div>
    </section>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($showDetail): ?>
        <div class="fixed inset-0 z-[100] flex items-end justify-center bg-slate-950/50 p-0 backdrop-blur-sm sm:items-center sm:p-5" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'invoice-modal'; ?>wire:key="invoice-modal">
            <button type="button" class="absolute inset-0 h-full w-full cursor-default" wire:click="toggleDetail" aria-label="Tutup rincian"></button>
            <div class="relative z-10 max-h-[90vh] w-full max-w-lg overflow-y-auto rounded-t-2xl bg-white shadow-2xl sm:rounded-2xl">
                <div class="flex items-start justify-between gap-3 border-b border-slate-100 bg-slate-50/70 px-5 py-4">
                    <div>
                        <p class="text-[9px] font-extrabold uppercase tracking-[0.14em] text-blue-600">Nota Digital</p>
                        <h3 class="mt-0.5 text-base font-extrabold text-slate-900">#<?php echo e($order->order_code); ?></h3>
                    </div>
                    <button type="button" wire:click="toggleDetail" class="grid h-8 w-8 place-items-center rounded-lg border border-slate-200 bg-white text-slate-500 transition hover:text-slate-900">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 6l12 12M18 6 6 18"/></svg>
                    </button>
                </div>
                <div class="space-y-3 p-5 text-[11px]">
                    <div class="flex justify-between gap-3"><span class="text-slate-500">Mitra</span><span class="text-right font-bold text-slate-900"><?php echo e($order->tenant?->name); ?></span></div>
                    <div class="flex justify-between gap-3"><span class="text-slate-500">Tanggal</span><span class="font-bold text-slate-900"><?php echo e($order->created_at?->locale('id')->translatedFormat('d M Y, H:i')); ?> WIB</span></div>
                    <div class="flex justify-between gap-3"><span class="text-slate-500">Layanan</span><span class="font-bold text-slate-900"><?php echo e($order->service?->name); ?></span></div>
                    <div class="flex justify-between gap-3"><span class="text-slate-500">Berat</span><span class="font-bold text-slate-900"><?php echo e($weightLabel); ?> kg</span></div>
                    <div class="flex justify-between gap-3"><span class="text-slate-500">Metode bayar</span><span class="font-bold text-slate-900"><?php echo e($paymentMethod); ?></span></div>
                    <div class="flex justify-between gap-3"><span class="text-slate-500">Status bayar</span><span class="rounded-full px-2 py-0.5 text-[9px] font-extrabold <?php echo e($this->paymentClasses($paymentStatus)); ?>"><?php echo e($paymentStatus); ?></span></div>
                    <div class="flex items-baseline justify-between gap-3 border-t border-dashed border-slate-200 pt-3"><span class="font-extrabold uppercase tracking-wide text-slate-500">Total</span><span class="text-lg font-extrabold text-blue-700">Rp<?php echo e($totalLabel); ?></span></div>
                    <a href="<?php echo e(route('customer.orders.invoice', $order->id)); ?>" target="_blank" class="mt-2 inline-flex w-full items-center justify-center gap-2 rounded-xl bg-blue-600 px-4 py-2.5 text-[11px] font-bold text-white transition hover:bg-blue-700">Buka Invoice</a>
                </div>
            </div>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div>
<?php /**PATH D:\laragon\www\Laundry-Multitenant-terintegrasi\Laundry-Multitenant\resources\views\livewire\order-tracking.blade.php ENDPATH**/ ?>