<div>
    <section class="relative overflow-hidden bg-gradient-to-b from-[#eef5ff] via-[#f6faff] to-[#f6f8fc]">
        <div class="pointer-events-none absolute -left-24 top-10 h-72 w-72 rounded-full bg-blue-300/20 blur-3xl"></div>
        <div class="pointer-events-none absolute right-0 top-0 h-80 w-80 rounded-full bg-cyan-300/20 blur-3xl"></div>

        <div class="relative mx-auto max-w-7xl px-5 pb-16 pt-8">
            <nav class="flex items-center gap-2 text-[11px] font-semibold text-slate-500">
                <a href="<?php echo e(route('customer.home')); ?>" class="inline-flex items-center gap-1.5 transition hover:text-blue-600">
                    <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round"><path d="m3 10 9-7 9 7v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-9Z"/><path d="M9 21v-7h6v7"/></svg>
                    Beranda
                </a>
                <svg class="h-3.5 w-3.5 text-slate-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 6 6 6-6 6"/></svg>
                <span class="text-slate-700">Daftar Mitra</span>
            </nav>

            <div class="mt-8 max-w-2xl">
                <p class="flex items-center gap-2 text-[10px] font-extrabold uppercase tracking-[0.16em] text-blue-600">
                    <span class="h-1.5 w-1.5 rounded-full bg-blue-600"></span>
                    Kemitraan Tenant Outlet
                </p>
                <h1 class="mt-3 text-3xl font-extrabold tracking-tight text-slate-950 sm:text-[2.75rem] sm:leading-[1.1]">
                    Daftarkan Laundry Kamu,<br>
                    <span class="text-blue-600">Tumbuh Bareng LaundryHub.</span>
                </h1>
                <p class="mt-4 max-w-xl text-sm leading-7 text-slate-500">
                    Isi data usaha laundry kamu di bawah ini. Tim LaundryHub akan memverifikasi data dalam 1×24 jam kerja sebelum outlet tampil di halaman pencarian.
                </p>
            </div>

            <div class="mt-8 grid gap-6 lg:grid-cols-[minmax(0,1fr)_360px]">
                <div class="rounded-3xl border border-slate-200/80 bg-white p-6 shadow-xl shadow-blue-950/5 sm:p-8">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($submitted): ?>
                        <div class="flex flex-col items-center px-2 py-10 text-center">
                            <span class="grid h-16 w-16 place-items-center rounded-2xl bg-emerald-50 text-emerald-600">
                                <svg class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="m8.5 12.5 2.5 2.5 4.5-5"/></svg>
                            </span>
                            <h2 class="mt-5 text-2xl font-extrabold tracking-tight text-slate-950">Pendaftaran Terkirim!</h2>
                            <p class="mt-2 max-w-md text-sm leading-6 text-slate-500">
                                Terima kasih telah mendaftarkan laundry kamu. Data sedang ditinjau tim LaundryHub. Setelah disetujui, outlet akan otomatis tampil pada halaman Cari Laundry dan kamu bisa masuk ke portal mitra menggunakan email serta password yang tadi dibuat.
                            </p>
                            <div class="mt-6 flex flex-wrap justify-center gap-3">
                                <a href="<?php echo e(route('customer.login')); ?>" class="inline-flex items-center gap-2 rounded-xl bg-blue-600 px-5 py-3 text-sm font-bold text-white shadow-lg shadow-blue-600/20 transition hover:bg-blue-700">
                                    Masuk ke Portal Mitra
                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 6 6 6-6 6"/></svg>
                                </a>
                                <a href="<?php echo e(route('customer.home')); ?>" class="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-5 py-3 text-sm font-bold text-slate-600 transition hover:border-blue-200 hover:text-blue-600">Kembali ke Beranda</a>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="flex items-center justify-between gap-3">
                            <div>
                                <h2 class="text-xl font-extrabold tracking-tight text-slate-950">Formulir Pendaftaran Mitra</h2>
                                <p class="mt-1 text-xs text-slate-500">Lengkapi data usaha dan akun pemilik outlet.</p>
                            </div>
                            <span class="hidden rounded-full bg-blue-50 px-3 py-1.5 text-[10px] font-bold uppercase tracking-wide text-blue-700 sm:inline">Gratis</span>
                        </div>

                        <form wire:submit="submit" class="mt-6 space-y-5">
                            <div>
                                <p class="text-[10px] font-extrabold uppercase tracking-[0.14em] text-slate-400">Informasi Usaha</p>
                                <div class="mt-3 grid gap-4 sm:grid-cols-2">
                                    <div class="sm:col-span-2">
                                        <label for="partner-name" class="mb-1.5 block text-xs font-bold text-slate-700">Nama Laundry <span class="text-red-500">*</span></label>
                                        <input id="partner-name" type="text" wire:model.blur="name" maxlength="100" placeholder="Contoh: Laundry Mawar" class="w-full rounded-xl border border-slate-200 bg-slate-50/60 px-4 py-3 text-sm font-medium text-slate-800 placeholder:text-slate-400 focus:border-blue-400 focus:bg-white focus:outline-none focus:ring-0">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-[11px] font-semibold text-red-600"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </div>

                                    <div>
                                        <label for="partner-owner" class="mb-1.5 block text-xs font-bold text-slate-700">Nama Pemilik <span class="text-red-500">*</span></label>
                                        <input id="partner-owner" type="text" wire:model.blur="owner" maxlength="100" placeholder="Nama lengkap pemilik" class="w-full rounded-xl border border-slate-200 bg-slate-50/60 px-4 py-3 text-sm font-medium text-slate-800 placeholder:text-slate-400 focus:border-blue-400 focus:bg-white focus:outline-none focus:ring-0">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['owner'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-[11px] font-semibold text-red-600"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </div>

                                    <div>
                                        <label for="partner-phone" class="mb-1.5 block text-xs font-bold text-slate-700">No. Telepon / WhatsApp <span class="text-red-500">*</span></label>
                                        <input id="partner-phone" type="text" wire:model.blur="phone" maxlength="30" placeholder="08xxxxxxxxxx" class="w-full rounded-xl border border-slate-200 bg-slate-50/60 px-4 py-3 text-sm font-medium text-slate-800 placeholder:text-slate-400 focus:border-blue-400 focus:bg-white focus:outline-none focus:ring-0">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-[11px] font-semibold text-red-600"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </div>

                                    <div class="sm:col-span-2">
                                        <label for="partner-address" class="mb-1.5 block text-xs font-bold text-slate-700">Alamat Outlet <span class="text-red-500">*</span></label>
                                        <textarea id="partner-address" wire:model.blur="address" rows="3" maxlength="500" placeholder="Alamat lengkap outlet laundry" class="w-full rounded-xl border border-slate-200 bg-slate-50/60 px-4 py-3 text-sm font-medium text-slate-800 placeholder:text-slate-400 focus:border-blue-400 focus:bg-white focus:outline-none focus:ring-0"></textarea>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-[11px] font-semibold text-red-600"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </div>

                                    <div class="sm:col-span-2">
                                        <label for="partner-description" class="mb-1.5 block text-xs font-bold text-slate-700">Deskripsi &amp; Layanan <span class="font-normal text-slate-400">(opsional)</span></label>
                                        <textarea id="partner-description" wire:model.blur="description" rows="3" maxlength="1000" placeholder="Contoh: Cuci kiloan, cuci setrika, bed cover, antar jemput area Tebet." class="w-full rounded-xl border border-slate-200 bg-slate-50/60 px-4 py-3 text-sm font-medium text-slate-800 placeholder:text-slate-400 focus:border-blue-400 focus:bg-white focus:outline-none focus:ring-0"></textarea>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-[11px] font-semibold text-red-600"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <div class="border-t border-slate-100 pt-5">
                                <p class="text-[10px] font-extrabold uppercase tracking-[0.14em] text-slate-400">Akun Pemilik Outlet</p>
                                <div class="mt-3 grid gap-4 sm:grid-cols-2">
                                    <div class="sm:col-span-2">
                                        <label for="partner-email" class="mb-1.5 block text-xs font-bold text-slate-700">Email <span class="text-red-500">*</span></label>
                                        <input id="partner-email" type="email" wire:model.blur="email" maxlength="100" placeholder="nama@email.com" class="w-full rounded-xl border border-slate-200 bg-slate-50/60 px-4 py-3 text-sm font-medium text-slate-800 placeholder:text-slate-400 focus:border-blue-400 focus:bg-white focus:outline-none focus:ring-0">
                                        <p class="mt-1 text-[10px] text-slate-400">Email ini dipakai untuk masuk ke portal mitra.</p>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-[11px] font-semibold text-red-600"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </div>

                                    <div>
                                        <label for="partner-password" class="mb-1.5 block text-xs font-bold text-slate-700">Password <span class="text-red-500">*</span></label>
                                        <input id="partner-password" type="password" wire:model="password" placeholder="Minimal 8 karakter" class="w-full rounded-xl border border-slate-200 bg-slate-50/60 px-4 py-3 text-sm font-medium text-slate-800 placeholder:text-slate-400 focus:border-blue-400 focus:bg-white focus:outline-none focus:ring-0">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-[11px] font-semibold text-red-600"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </div>

                                    <div>
                                        <label for="partner-password-confirmation" class="mb-1.5 block text-xs font-bold text-slate-700">Ulangi Password <span class="text-red-500">*</span></label>
                                        <input id="partner-password-confirmation" type="password" wire:model="password_confirmation" placeholder="Ketik ulang password" class="w-full rounded-xl border border-slate-200 bg-slate-50/60 px-4 py-3 text-sm font-medium text-slate-800 placeholder:text-slate-400 focus:border-blue-400 focus:bg-white focus:outline-none focus:ring-0">
                                    </div>
                                </div>
                            </div>

                            <label class="flex cursor-pointer items-start gap-2.5 rounded-xl bg-slate-50 px-4 py-3">
                                <input type="checkbox" wire:model="agree" class="mt-0.5 h-4 w-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                                <span class="text-[11px] leading-5 text-slate-500">Saya menyetujui <a href="<?php echo e(route('customer.home')); ?>#bantuan" class="font-bold text-blue-600 hover:underline">Syarat &amp; Ketentuan</a> serta <a href="<?php echo e(route('customer.home')); ?>#bantuan" class="font-bold text-blue-600 hover:underline">Kebijakan Privasi</a> LaundryHub.</span>
                            </label>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['agree'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="-mt-2 text-[11px] font-semibold text-red-600"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                            <div class="flex flex-col-reverse gap-3 border-t border-slate-100 pt-5 sm:flex-row sm:items-center sm:justify-between">
                                <p class="text-[10px] text-slate-400">Data akan diverifikasi admin sebelum outlet aktif.</p>
                                <button type="submit" wire:loading.attr="disabled" wire:target="submit" class="inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-6 py-3 text-sm font-bold text-white shadow-lg shadow-blue-600/20 transition hover:bg-blue-700 disabled:cursor-wait disabled:opacity-70">
                                    <span wire:loading.remove wire:target="submit">Kirim Pendaftaran</span>
                                    <span wire:loading wire:target="submit" class="inline-flex items-center gap-2">
                                        <svg class="h-4 w-4 animate-spin" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="9" stroke="currentColor" stroke-opacity=".25" stroke-width="3"/><path d="M21 12a9 9 0 0 0-9-9" stroke="currentColor" stroke-width="3" stroke-linecap="round"/></svg>
                                        Mengirim...
                                    </span>
                                    <svg wire:loading.remove wire:target="submit" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 6 6 6-6 6"/></svg>
                                </button>
                            </div>
                        </form>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                <aside class="space-y-5">
                    <div class="rounded-3xl bg-gradient-to-br from-[#1e3a8a] via-blue-700 to-cyan-500 p-6 text-white shadow-xl shadow-blue-950/15">
                        <span class="inline-flex items-center gap-2 rounded-full border border-white/20 bg-white/10 px-3 py-1.5 text-[10px] font-bold uppercase tracking-[0.12em] backdrop-blur">
                            <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M3 21h18M5 21V7l7-4 7 4v14M9 21v-5h6v5"/></svg>
                            Paket Tenant Hub
                        </span>
                        <h2 class="mt-4 text-xl font-extrabold leading-snug">Kenapa bergabung jadi mitra?</h2>
                        <ul class="mt-4 space-y-3 text-xs text-blue-50/90">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = [
                                'Penerimaan pembayaran QRIS instan',
                                'Notifikasi otomatis ke pelanggan',
                                'Laporan omzet harian & stok detergen',
                                'Outlet tampil di direktori LaundryHub',
                            ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $benefit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                <li class="flex items-start gap-2">
                                    <span class="mt-0.5 grid h-4 w-4 shrink-0 place-items-center rounded-full bg-white/15">
                                        <svg class="h-2.5 w-2.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="m5 12 5 5L20 7"/></svg>
                                    </span>
                                    <?php echo e($benefit); ?>

                                </li>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </ul>
                    </div>

                    <div class="rounded-2xl border border-slate-200/80 bg-white p-5 shadow-sm">
                        <h3 class="flex items-center gap-2 text-sm font-extrabold text-slate-900">
                            <span class="grid h-8 w-8 place-items-center rounded-lg bg-blue-50 text-blue-600">
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 5h4l2 5-2.5 1.5a12 12 0 0 0 5 5L14 14l5 2v4a2 2 0 0 1-2 2A16 16 0 0 1 2 7a2 2 0 0 1 2-2Z"/></svg>
                            </span>
                            Butuh bantuan?
                        </h3>
                        <p class="mt-2 text-xs leading-6 text-slate-500">Tim kemitraan kami siap membantu proses pendaftaran outlet kamu.</p>
                        <a href="tel:081234567890" class="mt-3 inline-flex items-center gap-2 text-sm font-extrabold text-blue-600 hover:text-blue-700">0812-3456-7890</a>
                        <p class="mt-1 text-[10px] text-slate-400">Senin–Sabtu, 08.00–20.00 WIB</p>
                    </div>
                </aside>
            </div>
        </div>
    </section>
</div>
<?php /**PATH D:\laragon\www\Laundry-Multitenant-terintegrasi\Laundry-Multitenant\resources\views/livewire/partner-registration.blade.php ENDPATH**/ ?>