
<?php if (isset($component)) { $__componentOriginalc8c9fd5d7827a77a31381de67195f0c3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc8c9fd5d7827a77a31381de67195f0c3 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.admin','data' => ['title' => 'Akun Admin Laundry']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.admin'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Akun Admin Laundry']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>


    
    <div class="mb-6 flex flex-wrap items-end justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold">
                Akun Admin Laundry
            </h1>

            <p class="mt-2 text-slate-500">
                Kelola akun administrator untuk masing-masing usaha laundry.
            </p>
        </div>

        <a
            href="<?php echo e(route('admin.tenant-admins.create')); ?>"
            class="rounded-lg bg-teal-700 px-5 py-3 font-semibold text-white hover:bg-teal-800"
        >
            + Tambah Akun Admin
        </a>
    </div>

    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
        <div class="mb-5 rounded-lg border border-green-200 bg-green-50 px-5 py-4 text-sm text-green-700">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($errors->any()): ?>
        <div class="mb-5 rounded-lg border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-700">
            <p class="font-semibold">Terjadi kesalahan:</p>

            <ul class="mt-2 list-inside list-disc">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <li><?php echo e($error); ?></li>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </ul>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    
    <div class="mb-5 grid gap-4 sm:grid-cols-2">

        <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-sm text-slate-500">
                Total Akun Admin
            </p>

            <p class="mt-2 text-3xl font-bold text-slate-900">
                <?php echo e($users->total()); ?>

            </p>
        </div>

        <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-sm text-slate-500">
                Akun Aktif
            </p>

            <p class="mt-2 text-3xl font-bold text-green-600">
                <?php echo e($users->getCollection()->where('status', 'Aktif')->count()); ?>

            </p>
        </div>

    </div>

    
    <section class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">

        <div class="mb-4 flex flex-wrap items-center justify-between gap-3">
            <h2 class="text-lg font-semibold">
                Daftar Admin Laundry
            </h2>

            <p class="text-sm text-slate-500">
                Menampilkan <?php echo e($users->count()); ?> dari
                <?php echo e($users->total()); ?> akun
            </p>
        </div>

        <div class="overflow-x-auto">

            <table class="w-full min-w-[900px] border-collapse text-left text-sm">

                <thead class="bg-slate-50 text-slate-600">
                    <tr>
                        <th class="px-4 py-3">No</th>
                        <th class="px-4 py-3">Nama Admin</th>
                        <th class="px-4 py-3">Kontak</th>
                        <th class="px-4 py-3">Tenant Laundry</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100">

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>

                        <tr class="hover:bg-slate-50">

                            
                            <td class="px-4 py-4 text-slate-500">
                                <?php echo e($users->firstItem() + $loop->index); ?>

                            </td>

                            
                            <td class="px-4 py-4">
                                <div class="font-semibold text-slate-800">
                                    <?php echo e($user->name); ?>

                                </div>

                                <div class="mt-1 text-xs text-slate-500">
                                    ID: <?php echo e($user->id); ?>

                                </div>
                            </td>

                            
                            <td class="px-4 py-4">
                                <div><?php echo e($user->email); ?></div>

                                <div class="mt-1 text-xs text-slate-500">
                                    <?php echo e($user->phone ?: '-'); ?>

                                </div>
                            </td>

                            
                            <td class="px-4 py-4">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($user->tenant): ?>
                                    <div class="font-medium text-slate-800">
                                        <?php echo e($user->tenant->name); ?>

                                    </div>

                                    <div class="mt-1 text-xs text-slate-500">
                                        Tenant ID: <?php echo e($user->tenant_id); ?>

                                    </div>
                                <?php else: ?>
                                    <span class="text-red-500">
                                        Belum terhubung
                                    </span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </td>

                            
                            <td class="px-4 py-4">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($user->status === 'Aktif'): ?>

                                    <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                        Aktif
                                    </span>

                                <?php else: ?>

                                    <span class="rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">
                                        Nonaktif
                                    </span>

                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </td>

                            
                            <td class="px-4 py-4">

                                <div class="flex flex-wrap items-center gap-3">

                                    <a
                                        href="<?php echo e(route('admin.tenant-admins.edit', $user->id)); ?>"
                                        class="font-semibold text-teal-700 hover:underline"
                                    >
                                        Edit
                                    </a>

                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($user->status === 'Aktif'): ?>

                                        <form
                                            method="POST"
                                            action="<?php echo e(route('admin.tenant-admins.status', $user->id)); ?>"
                                            onsubmit="return confirm('Yakin ingin menonaktifkan akun ini?')"
                                        >
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('PATCH'); ?>

                                            <input
                                                type="hidden"
                                                name="status"
                                                value="Nonaktif"
                                            >

                                            <button
                                                type="submit"
                                                class="font-semibold text-red-600 hover:underline"
                                            >
                                                Nonaktifkan
                                            </button>
                                        </form>

                                    <?php else: ?>

                                        <form
                                            method="POST"
                                            action="<?php echo e(route('admin.tenant-admins.status', $user->id)); ?>"
                                            onsubmit="return confirm('Yakin ingin mengaktifkan akun ini?')"
                                        >
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('PATCH'); ?>

                                            <input
                                                type="hidden"
                                                name="status"
                                                value="Aktif"
                                            >

                                            <button
                                                type="submit"
                                                class="font-semibold text-green-600 hover:underline"
                                            >
                                                Aktifkan
                                            </button>
                                        </form>

                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                </div>

                            </td>

                        </tr>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>

                        <tr>
                            <td
                                colspan="6"
                                class="px-4 py-12 text-center text-slate-500"
                            >
                                Belum ada akun Admin Laundry.

                                <div class="mt-2">
                                    Klik tombol Tambah Akun Admin untuk membuat akun baru.
                                </div>
                            </td>
                        </tr>

                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                </tbody>

            </table>

        </div>

        
        <div class="mt-5">
            <?php echo e($users->links()); ?>

        </div>

    </section>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc8c9fd5d7827a77a31381de67195f0c3)): ?>
<?php $attributes = $__attributesOriginalc8c9fd5d7827a77a31381de67195f0c3; ?>
<?php unset($__attributesOriginalc8c9fd5d7827a77a31381de67195f0c3); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc8c9fd5d7827a77a31381de67195f0c3)): ?>
<?php $component = $__componentOriginalc8c9fd5d7827a77a31381de67195f0c3; ?>
<?php unset($__componentOriginalc8c9fd5d7827a77a31381de67195f0c3); ?>
<?php endif; ?>
<?php /**PATH D:\laragon\www\Laundry-Multitenant-terintegrasi\Laundry-Multitenant\app\Modules\Admin\resources\views\tenant-admins\index.blade.php ENDPATH**/ ?>