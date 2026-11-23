<div class="bg-[#f7f9ff]">
    <section class="border-b border-slate-200/70 bg-gradient-to-br from-[#f4f1ff] via-[#f8faff] to-[#eef8ff]">
        <div class="mx-auto max-w-7xl px-5 py-6">
            <div class="flex flex-wrap items-center justify-between gap-3">
                <nav class="flex items-center gap-2 text-[11px] font-semibold text-slate-500">
                    <a href="<?php echo e(route('customer.home')); ?>" class="transition hover:text-blue-600">Beranda</a>
                    <span class="text-slate-300">/</span>
                    <span class="text-slate-700">Bantuan &amp; Pusat Komplain</span>
                </nav>

                <span class="inline-flex items-center gap-2 rounded-full border border-blue-200 bg-white/80 px-3.5 py-2 text-[10px] font-bold text-slate-600 shadow-sm">
                    <svg class="h-4 w-4 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9"><path d="M12 3 5 6v5c0 4.5 3 8 7 10 4-2 7-5.5 7-10V6l-7-3Z"/><path d="m9 12 2 2 4-5"/></svg>
                    Escrow Protection: 100% Aktif
                </span>
            </div>

            <div class="mt-8 flex flex-wrap items-end justify-between gap-5">
                <div class="max-w-3xl">
                    <p class="flex flex-wrap items-center gap-2 text-[10px] font-extrabold uppercase tracking-[0.16em] text-blue-600">
                        <span class="rounded-full bg-blue-100 px-2.5 py-1 text-blue-700">Resolusi Transparan Multi-Tenant</span>
                        <span class="text-[9px] font-bold tracking-normal text-slate-400">• Garansi Layanan Indonesia</span>
                    </p>
                    <h1 class="mt-3 text-3xl font-extrabold tracking-tight text-slate-950 sm:text-4xl">Pusat Komplain &amp; Resolusi Pesanan</h1>
                    <p class="mt-3 max-w-2xl text-sm leading-6 text-slate-500">Sampaikan kendala cucian Anda seperti paket tertukar, luntur, rusak, terlambat, atau ketidaksesuaian timbangan. Dana pesanan terlindungi penuh dalam sistem Escrow LaundryMap hingga Anda menyatakan puas.</p>
                </div>

                <a href="#form-komplain" class="inline-flex items-center gap-2 rounded-xl bg-blue-700 px-5 py-3 text-xs font-extrabold text-white shadow-lg shadow-blue-700/20 transition hover:bg-blue-800">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a4 4 0 0 1-4 4H8l-5 3V6a3 3 0 0 1 3-3h11a4 4 0 0 1 4 4v8Z"/><path d="M8 9h8M8 13h5"/></svg>
                    Ajukan Komplain Baru
                </a>
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-5">
        <div class="grid gap-4 py-7 md:grid-cols-3">
            <div class="rounded-2xl border border-slate-200/80 bg-white p-5 shadow-sm">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="text-[10px] font-bold text-slate-500">Tiket Aktif Berjalan</p>
                        <p class="mt-2 text-4xl font-extrabold tracking-tight text-slate-950"><?php echo e($activeTickets); ?></p>
                    </div>
                    <span class="grid h-11 w-11 place-items-center rounded-xl bg-blue-50 text-blue-600">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9"><path d="M8 3h8v4H8zM4 7h16v14H4z"/><path d="M8 11h8M8 15h5"/></svg>
                    </span>
                </div>
                <p class="mt-3 text-[10px] font-semibold text-blue-600">Sedang dimediasi tim LaundryMap</p>
            </div>

            <div class="rounded-2xl border border-slate-200/80 bg-white p-5 shadow-sm">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="text-[10px] font-bold text-slate-500">Menunggu Respon Tenant</p>
                        <p class="mt-2 text-4xl font-extrabold tracking-tight text-rose-600"><?php echo e($waitingTickets); ?></p>
                    </div>
                    <span class="grid h-11 w-11 place-items-center rounded-xl bg-rose-50 text-rose-500">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9"><path d="M21 15a4 4 0 0 1-4 4H8l-5 3V6a3 3 0 0 1 3-3h11a4 4 0 0 1 4 4v8Z"/><path d="M8 9h8M8 13h5"/></svg>
                    </span>
                </div>
                <p class="mt-3 text-[10px] font-semibold text-slate-500"><span class="font-extrabold text-rose-600">SLA Respon:</span> maksimal 24 jam</p>
            </div>

            <div class="rounded-2xl border border-slate-200/80 bg-white p-5 shadow-sm">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="text-[10px] font-bold text-slate-500">Kasus Terselesaikan</p>
                        <p class="mt-2 text-4xl font-extrabold tracking-tight text-slate-950"><?php echo e($resolvedTickets); ?></p>
                    </div>
                    <span class="grid h-11 w-11 place-items-center rounded-xl bg-emerald-50 text-emerald-600">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="8"/><path d="m8.5 12 2.5 2.5 4.5-5"/></svg>
                    </span>
                </div>
                <p class="mt-3 text-[10px] font-semibold text-slate-500">Total solusi: <strong class="text-slate-700">Rp<?php echo e(number_format($resolvedTotal, 0, ',', '.')); ?></strong></p>
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-5 pb-10">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($successMessage !== ''): ?>
            <div class="mb-4 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-[11px] font-semibold leading-5 text-emerald-700"><?php echo e($successMessage); ?></div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <div class="grid items-start gap-5 xl:grid-cols-[minmax(0,0.92fr)_minmax(0,1.18fr)]">
            <div id="form-komplain" class="rounded-2xl border border-slate-200/80 bg-white p-5 shadow-sm sm:p-6">
                <div class="flex flex-wrap items-center justify-between gap-2 border-b border-slate-100 pb-4">
                    <div class="flex items-center gap-2.5">
                        <span class="grid h-9 w-9 place-items-center rounded-xl bg-blue-600 text-white">
                            <svg class="h-4.5 w-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9"><path d="M8 3h8v4H8zM4 7h16v14H4z"/><path d="M8 11h8M8 15h5"/></svg>
                        </span>
                        <div>
                            <h2 class="text-base font-extrabold tracking-tight text-slate-950">Form Pengajuan Komplain</h2>
                            <p class="text-[9px] font-semibold text-slate-400">Lengkapi data agar tim dapat memediasi lebih cepat.</p>
                        </div>
                    </div>
                    <span class="rounded-full bg-blue-50 px-2.5 py-1 text-[8px] font-extrabold uppercase tracking-wide text-blue-700">Multi-Tenant Desk</span>
                </div>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->guest()): ?>
                    <div class="mt-5 rounded-xl border border-dashed border-blue-200 bg-blue-50/60 p-6 text-center">
                        <span class="mx-auto grid h-12 w-12 place-items-center rounded-xl bg-white text-blue-600 shadow-sm">
                            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9"><circle cx="12" cy="8" r="3.5"/><path d="M5 21c0-4 3.5-6 7-6s7 2 7 6"/></svg>
                        </span>
                        <p class="mt-3 text-sm font-extrabold text-blue-950">Masuk untuk mengajukan komplain</p>
                        <p class="mt-1 text-[11px] leading-5 text-blue-700/80">Kami perlu memastikan tiket terhubung dengan pesanan dan dana escrow milikmu.</p>
                        <a href="<?php echo e(route('customer.login')); ?>" class="mt-4 inline-flex rounded-xl bg-blue-600 px-5 py-2.5 text-[11px] font-extrabold text-white transition hover:bg-blue-700">Masuk ke Akun</a>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->check()): ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->role !== 'customer'): ?>
                        <div class="mt-5 rounded-xl border border-slate-200 bg-slate-50 p-5 text-[11px] leading-5 text-slate-500">
                            Formulir komplain hanya tersedia untuk akun pelanggan. Akun mitra dapat menanggapi tiket melalui dashboard tenant.
                        </div>
                    <?php elseif($orders->isEmpty()): ?>
                        <div class="mt-5 rounded-xl border border-dashed border-slate-300 p-6 text-center">
                            <p class="text-sm font-extrabold text-slate-700">Belum ada pesanan</p>
                            <p class="mt-1 text-[11px] leading-5 text-slate-500">Buat pesanan terlebih dahulu sebelum mengajukan komplain.</p>
                            <a href="<?php echo e(route('customer.services')); ?>" class="mt-4 inline-flex rounded-xl bg-blue-600 px-5 py-2.5 text-[11px] font-extrabold text-white transition hover:bg-blue-700">Cari Laundry</a>
                        </div>
                    <?php else: ?>
                        <?php
                            $selectedOrder = $orders->firstWhere('id', (int) $orderId);
                        ?>

                        <div class="mt-4 rounded-xl border border-blue-100 bg-[#f3f6ff] p-4">
                            <div class="flex gap-3">
                                <span class="grid h-9 w-9 shrink-0 place-items-center rounded-lg bg-white text-blue-600 shadow-sm">
                                    <svg class="h-4.5 w-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9"><path d="M12 3 5 6v5c0 4.5 3 8 7 10 4-2 7-5.5 7-10V6l-7-3Z"/><path d="m9 12 2 2 4-5"/></svg>
                                </span>
                                <div>
                                    <p class="text-[11px] font-extrabold text-slate-800">Proteksi Garansi Escrow</p>
                                    <p class="mt-1 text-[10px] leading-4 text-slate-500">Dana pesanan Anda aman tertahan di rekening bersama LaundryMap dan tidak dicairkan ke mitra sampai komplain dinyatakan selesai secara adil.</p>
                                </div>
                            </div>
                        </div>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($errors->any()): ?>
                            <div class="mt-4 rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-[11px] font-semibold leading-5 text-rose-700"><?php echo e($errors->first()); ?></div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        <form wire:submit="submitComplaint" class="mt-5 space-y-5">
                            <div>
                                <label for="complaint-order" class="mb-2 flex items-center gap-1 text-[10px] font-extrabold text-slate-700">Pilih Transaksi / Pesanan Bermasalah <span class="text-rose-500">*</span></label>
                                <select id="complaint-order" wire:model="orderId" class="w-full rounded-xl border border-slate-200 bg-white px-3.5 py-3 text-[11px] font-semibold text-slate-700 outline-none transition focus:border-blue-400 focus:ring-2 focus:ring-blue-100">
                                    <option value="">Pilih pesanan</option>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                        <option value="<?php echo e($order->id); ?>">#<?php echo e($order->order_code); ?> • <?php echo e($order->tenant?->name); ?> • <?php echo e($order->status); ?></option>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                </select>

                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($selectedOrder): ?>
                                    <div class="mt-2 flex flex-wrap items-center justify-between gap-2 rounded-lg bg-slate-50 px-3 py-2 text-[9px] font-semibold text-slate-500">
                                        <span>#<?php echo e($selectedOrder->order_code); ?> • <?php echo e($selectedOrder->tenant?->name); ?></span>
                                        <span><?php echo e($selectedOrder->service?->name ?? 'Layanan'); ?> • <?php echo e(rtrim(rtrim(number_format((float) $selectedOrder->weight, 2, ',', '.'), '0'), ',')); ?> <?php echo e(strtolower((string) ($selectedOrder->service?->unit ?? 'kg')) === 'kg' ? 'kg' : 'Pcs'); ?></span>
                                    </div>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>

                            <div>
                                <p class="mb-2 flex items-center gap-1 text-[10px] font-extrabold text-slate-700">Kategori Kendala Cucian <span class="text-rose-500">*</span></p>
                                <div class="grid gap-2 sm:grid-cols-2">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $categoryLabels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                        <button type="button" wire:click="$set('category', '<?php echo e($key); ?>')" class="flex items-center gap-2 rounded-lg border px-3 py-2.5 text-left text-[10px] font-bold transition <?php echo e($category === $key ? 'border-blue-200 bg-blue-50 text-blue-700 ring-1 ring-blue-100' : 'border-slate-200 bg-white text-slate-600 hover:border-blue-200 hover:text-blue-700'); ?>">
                                            <span class="grid h-6 w-6 shrink-0 place-items-center rounded-md <?php echo e($category === $key ? 'bg-blue-600 text-white' : 'bg-slate-100 text-slate-400'); ?>">
                                                <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 7h16M6 7l1 13h10l1-13M9 7V4h6v3"/></svg>
                                            </span>
                                            <?php echo e($label); ?>

                                        </button>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                </div>
                            </div>

                            <div>
                                <label for="complaint-description" class="mb-2 flex items-center gap-1 text-[10px] font-extrabold text-slate-700">Deskripsi Rinci Kendala <span class="text-rose-500">*</span></label>
                                <textarea id="complaint-description" wire:model="description" rows="4" maxlength="1000" placeholder="Contoh: Kemeja katun putih terdapat noda minyak di bagian kerah yang belum bersih dan kancing nomor 2 atas hilang..." class="w-full resize-none rounded-xl border border-slate-200 bg-white px-3.5 py-3 text-[11px] font-medium leading-5 text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-blue-400 focus:ring-2 focus:ring-blue-100"></textarea>
                                <p class="mt-1 text-[9px] text-slate-400">Sebutkan merek, warna, dan posisi noda/kerusakan untuk verifikasi cepat outlet.</p>
                            </div>

                            <div>
                                <p class="mb-2 flex items-center gap-1 text-[10px] font-extrabold text-slate-700">Unggah Bukti Foto / Video Cucian &amp; Nota Masuk <span class="text-slate-400">(Opsional)</span></p>
                                <div class="rounded-xl border border-dashed border-blue-200 bg-[#f3f6ff] p-3">
                                    <label class="flex cursor-pointer items-center gap-3 rounded-lg bg-white px-3 py-3 transition hover:bg-blue-50/60">
                                        <span class="grid h-9 w-9 shrink-0 place-items-center rounded-lg bg-blue-100 text-blue-600">
                                            <svg class="h-4.5 w-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9"><rect x="3" y="5" width="18" height="14" rx="2"/><circle cx="8.5" cy="10" r="1.5"/><path d="m4 17 5-5 4 4 2-2 5 5"/></svg>
                                        </span>
                                        <span class="min-w-0">
                                            <span class="block truncate text-[10px] font-bold text-slate-700"><?php echo e($evidence ? $evidence->getClientOriginalName() : 'Tambah Foto / Video'); ?></span>
                                            <span class="block text-[9px] text-slate-400">JPG, PNG, WEBP, MP4 • maks. 10 MB</span>
                                        </span>
                                        <input type="file" wire:model="evidence" accept="image/*,video/*" class="sr-only">
                                    </label>
                                    <p wire:loading wire:target="evidence" class="mt-2 px-1 text-[9px] font-semibold text-blue-600">Mengunggah bukti...</p>
                                </div>
                            </div>

                            <div>
                                <p class="mb-2 flex items-center gap-1 text-[10px] font-extrabold text-slate-700">Solusi yang Diharapkan <span class="text-rose-500">*</span></p>
                                <div class="space-y-2">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $solutionLabels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                        <label class="flex cursor-pointer items-center gap-2.5 rounded-lg border border-slate-200 bg-white px-3 py-2.5 text-[10px] font-semibold text-slate-600 transition hover:border-blue-200 hover:bg-blue-50/40">
                                            <input type="radio" wire:model="expectedSolution" value="<?php echo e($key); ?>" class="h-3.5 w-3.5 border-slate-300 text-blue-600 focus:ring-blue-500">
                                            <span><?php echo e($label); ?></span>
                                        </label>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                </div>
                            </div>

                            <button type="submit" wire:loading.attr="disabled" wire:target="submitComplaint,evidence" class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-blue-700 px-5 py-3.5 text-[11px] font-extrabold text-white shadow-sm transition hover:bg-blue-800 disabled:cursor-not-allowed disabled:opacity-60">
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m22 2-7 20-4-9-9-4Z"/><path d="M22 2 11 13"/></svg>
                                Kirim Komplain &amp; Tahan Escrow
                            </button>
                        </form>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            <div class="rounded-2xl border border-slate-200/80 bg-white p-5 shadow-sm sm:p-6">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($selectedComplaint): ?>
                    <?php
                        $ticket = $selectedComplaint;
                        $status = $ticket->status;
                        $hasResponse = filled($ticket->response);
                        $isClosed = in_array($status, ['Selesai', 'Ditutup'], true);
                        $createdAt = $ticket->created_at?->timezone('Asia/Jakarta');
                        $deadline = $createdAt?->copy()->addHours(24);
                        $hoursLeft = $deadline ? max(0, (int) now()->diffInHours($deadline, false)) : 0;
                        $slaLabel = $isClosed ? 'Selesai' : ($deadline && $deadline->isPast() ? 'SLA terlampaui' : 'Sisa '.$hoursLeft.' jam');
                        $ticketCode = 'CMP-'.($createdAt?->format('Y') ?? now()->format('Y')).'-'.str_pad((string) $ticket->id, 4, '0', STR_PAD_LEFT);
                        $statusClasses = match ($status) {
                            'Selesai' => 'bg-emerald-100 text-emerald-700',
                            'Diproses' => 'bg-blue-100 text-blue-700',
                            'Ditutup' => 'bg-slate-100 text-slate-500',
                            default => 'bg-amber-100 text-amber-700',
                        };
                        preg_match('/Solusi diharapkan:\s*(.+)/', $ticket->description, $solutionMatches);
                        $requestedSolution = trim($solutionMatches[1] ?? '');
                        $escrowAmount = (float) ($ticket->order?->total_price ?? 0);
                        $steps = [
                            ['label' => 'Diajukan', 'meta' => $createdAt ? $createdAt->translatedFormat('d M, H:i').' WIB' : '-', 'done' => true, 'active' => false],
                            ['label' => 'Escrow Lock', 'meta' => 'Otomatis Sistem', 'done' => true, 'active' => false],
                            ['label' => 'Tawaran Mitra', 'meta' => $hasResponse ? 'Solusi dikirim' : 'Menunggu', 'done' => $hasResponse, 'active' => false],
                            ['label' => 'Menunggu Anda', 'meta' => $isClosed ? 'Selesai' : ($hasResponse ? 'Perlu keputusan' : 'Menunggu mitra'), 'done' => $isClosed, 'active' => $hasResponse && ! $isClosed],
                        ];
                    ?>

                    <div class="border-b border-slate-100 pb-4">
                        <div class="flex flex-wrap items-start justify-between gap-3">
                            <div>
                                <div class="flex flex-wrap items-center gap-2">
                                    <h2 class="text-lg font-extrabold tracking-tight text-slate-950">Tiket #<?php echo e($ticketCode); ?></h2>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($ticket->order): ?>
                                        <a href="<?php echo e(route('customer.orders.show', $ticket->order->id)); ?>" class="rounded-full bg-blue-50 px-2.5 py-1 text-[8px] font-extrabold text-blue-700">Pesanan #<?php echo e($ticket->order->order_code); ?></a>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                                <p class="mt-1 flex items-center gap-2 text-[10px] font-semibold text-slate-500">
                                    <span class="grid h-5 w-5 place-items-center rounded-full bg-blue-100 text-blue-600">
                                        <svg class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 21V8l8-5 8 5v13"/><path d="M9 21v-6h6v6"/></svg>
                                    </span>
                                    Mitra Tenant: <strong class="text-slate-800"><?php echo e($ticket->tenant?->name ?? 'Mitra Laundry'); ?></strong>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($ticket->tenant?->address): ?>
                                        <span class="hidden text-slate-400 sm:inline">(<?php echo e($ticket->tenant->address); ?>)</span>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </p>
                            </div>
                            <div class="text-right">
                                <span class="inline-flex rounded-full px-3 py-1 text-[9px] font-extrabold <?php echo e($statusClasses); ?>"><?php echo e($status); ?></span>
                                <p class="mt-1 text-[8px] font-bold text-rose-500">SLA Respon Mitra: <?php echo e($slaLabel); ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 rounded-xl border border-slate-100 bg-slate-50/70 p-4">
                        <p class="text-[9px] font-extrabold uppercase tracking-[0.08em] text-slate-500">Kendala Dilaporkan:</p>
                        <p class="mt-2 whitespace-pre-line text-[11px] font-semibold leading-5 text-slate-800"><?php echo e($ticket->description); ?></p>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($requestedSolution !== ''): ?>
                            <p class="mt-2 text-[9px] font-bold text-slate-500">Solusi Diajukan: <span class="text-slate-700"><?php echo e($requestedSolution); ?></span> <span class="mx-1 text-slate-300">•</span> Escrow Ditahan: <span class="text-blue-700">Rp<?php echo e(number_format($escrowAmount, 0, ',', '.')); ?></span></p>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>

                    <div class="mt-3 grid grid-cols-2 gap-2 lg:grid-cols-4">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $steps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $step): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <div class="rounded-lg border px-2.5 py-2 <?php echo e($step['active'] ? 'border-rose-200 bg-rose-50' : ($step['done'] ? 'border-blue-100 bg-blue-50' : 'border-slate-100 bg-slate-50')); ?>">
                                <div class="flex items-center gap-1.5">
                                    <span class="grid h-4 w-4 place-items-center rounded-full <?php echo e($step['done'] ? 'bg-blue-600 text-white' : ($step['active'] ? 'bg-rose-500 text-white' : 'bg-slate-200 text-slate-500')); ?>">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($step['done']): ?>
                                            <svg class="h-2.5 w-2.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="m5 12 4 4L19 6"/></svg>
                                        <?php else: ?>
                                            <span class="text-[7px] font-extrabold"><?php echo e($loop->iteration); ?></span>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </span>
                                    <p class="text-[8px] font-extrabold <?php echo e($step['active'] ? 'text-rose-700' : ($step['done'] ? 'text-blue-700' : 'text-slate-500')); ?>"><?php echo e($step['label']); ?></p>
                                </div>
                                <p class="mt-1.5 text-[7px] font-semibold <?php echo e($step['active'] ? 'text-rose-500' : 'text-slate-400'); ?>"><?php echo e($step['meta']); ?></p>
                            </div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </div>

                    <div class="mt-4 max-h-[420px] space-y-3 overflow-y-auto rounded-xl bg-slate-50/60 p-3">
                        <div class="ml-auto max-w-[92%] rounded-xl rounded-tr-sm bg-blue-700 px-4 py-3 text-white shadow-sm">
                            <p class="text-[8px] font-bold text-blue-100"><?php echo e(auth()->user()?->name ?? 'Pelanggan'); ?> (Pelanggan) • <?php echo e($createdAt?->translatedFormat('d M • H:i')); ?> WIB</p>
                            <p class="mt-1 text-[11px] font-semibold leading-5"><?php echo e($ticket->subject); ?></p>
                            <p class="mt-1 whitespace-pre-line text-[10px] leading-5 text-blue-50"><?php echo e($ticket->description); ?></p>
                        </div>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($ticket->response): ?>
                            <div class="max-w-[92%] rounded-xl rounded-tl-sm border border-slate-200 bg-white px-4 py-3 shadow-sm">
                                <p class="text-[8px] font-bold text-slate-500">Admin <?php echo e($ticket->tenant?->name ?? 'Tenant'); ?> • <?php echo e($ticket->updated_at?->timezone('Asia/Jakarta')->translatedFormat('d M • H:i')); ?> WIB</p>
                                <p class="mt-1 whitespace-pre-line text-[10px] leading-5 text-slate-600"><?php echo e($ticket->response); ?></p>
                            </div>
                        <?php else: ?>
                            <div class="max-w-[92%] rounded-xl border border-dashed border-slate-300 bg-white/70 px-4 py-3">
                                <p class="text-[10px] font-semibold text-slate-500">Menunggu tanggapan dari admin tenant...</p>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(! $isClosed): ?>
                        <form wire:submit="sendReply" class="mt-3 flex gap-2">
                            <input type="text" wire:model="replyMessage" maxlength="1000" placeholder="Tulis balasan untuk mitra dan admin LaundryMap..." class="min-w-0 flex-1 rounded-xl border border-slate-200 bg-white px-3.5 py-3 text-[10px] font-medium text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-blue-400 focus:ring-2 focus:ring-blue-100">
                            <button type="submit" wire:loading.attr="disabled" wire:target="sendReply" class="inline-flex shrink-0 items-center gap-1.5 rounded-xl bg-blue-700 px-4 py-3 text-[10px] font-extrabold text-white transition hover:bg-blue-800 disabled:opacity-60">
                                Kirim
                                <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m22 2-7 20-4-9-9-4Z"/><path d="M22 2 11 13"/></svg>
                            </button>
                        </form>
                    <?php else: ?>
                        <p class="mt-3 rounded-lg bg-slate-100 px-3 py-2 text-center text-[9px] font-semibold text-slate-500">Tiket ini sudah <?php echo e(strtolower($status)); ?>. Ajukan tiket baru jika masih ada kendala.</p>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    <div class="mt-3 grid gap-2 sm:grid-cols-3">
                        <button type="button" wire:click="acceptSolution" <?php if(! $hasResponse || $isClosed): echo 'disabled'; endif; ?> class="rounded-lg border border-blue-200 bg-blue-50 px-3 py-2.5 text-[9px] font-extrabold text-blue-700 transition hover:bg-blue-100 disabled:cursor-not-allowed disabled:opacity-50">Konfirmasi Solusi dari Tenant</button>
                        <button type="button" wire:click="escalateComplaint" <?php if($isClosed): echo 'disabled'; endif; ?> class="rounded-lg border border-rose-200 bg-rose-50 px-3 py-2.5 text-[9px] font-extrabold text-rose-700 transition hover:bg-rose-100 disabled:cursor-not-allowed disabled:opacity-50">Eskalasi ke Super Admin</button>
                        <button type="button" wire:click="closeTicket" <?php if($isClosed): echo 'disabled'; endif; ?> class="rounded-lg bg-blue-800 px-3 py-2.5 text-[9px] font-extrabold text-white transition hover:bg-blue-900 disabled:cursor-not-allowed disabled:opacity-50">Terima Solusi &amp; Tutup Tiket</button>
                    </div>
                <?php else: ?>
                    <div class="flex min-h-[420px] flex-col items-center justify-center rounded-xl border border-dashed border-slate-200 bg-slate-50/50 px-6 text-center">
                        <span class="grid h-14 w-14 place-items-center rounded-2xl bg-white text-blue-500 shadow-sm">
                            <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"><path d="M21 15a4 4 0 0 1-4 4H8l-5 3V6a3 3 0 0 1 3-3h11a4 4 0 0 1 4 4v8Z"/><path d="M8 9h8M8 13h5"/></svg>
                        </span>
                        <h2 class="mt-4 text-base font-extrabold text-slate-800">Belum ada tiket komplain</h2>
                        <p class="mt-1 max-w-sm text-[11px] leading-5 text-slate-500">Tiket yang kamu ajukan akan tampil di sini beserta perkembangan mediasi dan tanggapan tenant.</p>
                        <a href="#form-komplain" class="mt-4 rounded-lg bg-blue-700 px-4 py-2.5 text-[10px] font-extrabold text-white">Ajukan Komplain</a>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>

        <div class="mt-5 grid gap-4 md:grid-cols-3">
            <div class="rounded-2xl border border-slate-200/80 bg-white p-5 shadow-sm">
                <span class="grid h-10 w-10 place-items-center rounded-xl bg-blue-50 text-blue-600">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 3 5 6v5c0 4.5 3 8 7 10 4-2 7-5.5 7-10V6l-7-3Z"/><path d="m9 12 2 2 4-5"/></svg>
                </span>
                <h3 class="mt-3 text-sm font-extrabold text-slate-900">SOP Penanganan Komplain</h3>
                <p class="mt-1.5 text-[10px] leading-5 text-slate-500">Setiap mitra outlet terikat kontrak standar pelayanan LaundryMap dengan kewajiban respon maksimal 24 jam kalender untuk menghindari sanksi penalti rating.</p>
            </div>

            <div class="rounded-2xl border border-slate-200/80 bg-white p-5 shadow-sm">
                <span class="grid h-10 w-10 place-items-center rounded-xl bg-blue-50 text-blue-600">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="5" y="10" width="14" height="10" rx="2"/><path d="M8 10V7a4 4 0 0 1 8 0v3"/></svg>
                </span>
                <h3 class="mt-3 text-sm font-extrabold text-slate-900">Rekening Bersama Escrow</h3>
                <p class="mt-1.5 text-[10px] leading-5 text-slate-500">Pembayaran Anda aman. Jika mitra tidak kooperatif atau gagal memenuhi janji penanganan, dana akan dikembalikan penuh sesuai kebijakan perlindungan pelanggan.</p>
            </div>

            <div class="rounded-2xl border border-slate-200/80 bg-white p-5 shadow-sm">
                <span class="grid h-10 w-10 place-items-center rounded-xl bg-rose-50 text-rose-500">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M21 15a4 4 0 0 1-4 4H8l-5 3V6a3 3 0 0 1 3-3h11a4 4 0 0 1 4 4v8Z"/><path d="M8 9h8M8 13h5"/></svg>
                </span>
                <h3 class="mt-3 text-sm font-extrabold text-slate-900">Layanan Darurat 24/7</h3>
                <p class="mt-1.5 text-[10px] leading-5 text-slate-500">Kapan pun tiket pending? Hubungi hotline darurat intervensi kurir platform di <strong class="text-slate-700">0812-3456-7890</strong> (Bebas Pulsa).</p>
            </div>
        </div>
    </section>
</div>
<?php /**PATH D:\laragon\www\Laundry-Multitenant-terintegrasi\Laundry-Multitenant\resources\views\livewire\customer-help.blade.php ENDPATH**/ ?>