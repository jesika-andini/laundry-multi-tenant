<?php if (isset($component)) { $__componentOriginalc8c9fd5d7827a77a31381de67195f0c3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc8c9fd5d7827a77a31381de67195f0c3 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.admin','data' => ['title' => 'Data Tenant']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.admin'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Data Tenant']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

    <div class="mb-6 flex flex-wrap items-end justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold">Data Tenant</h1>
            <p class="mt-2 text-slate-500">Kelola semua usaha laundry yang terdaftar di LaundryMap.</p>
        </div>
        <a href="<?php echo e(route('admin.tenants.create')); ?>" class="rounded-lg bg-teal-700 px-5 py-3 font-semibold text-white hover:bg-teal-800">
            + Tambah Tenant
        </a>
    </div>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
    <div class="mb-4 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
        <?php echo e(session('success')); ?>

    </div>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <section class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
        <div class="mb-4 flex flex-wrap items-center justify-between gap-3">
            <h2 class="text-lg font-semibold">Daftar Laundry</h2>
            <p class="text-sm text-slate-500">Total tenant: <strong class="text-slate-800"><?php echo e($tenants->count()); ?></strong></p>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full min-w-[850px] border-collapse text-left text-sm">
                <thead class="bg-slate-50 text-slate-600">
                    <tr>
                        <th class="px-4 py-3">ID</th>
                        <th class="px-4 py-3">Nama Laundry</th>
                        <th class="px-4 py-3">Pemilik</th>
                        <th class="px-4 py-3">Kontak</th>
                        <th class="px-4 py-3">Alamat</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $tenants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tenant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <tr class="hover:bg-slate-50">
                            <td class="px-4 py-3"><?php echo e($tenant->id); ?></td>
                            <td class="px-4 py-3 font-medium"><?php echo e($tenant->name); ?></td>
                            <td class="px-4 py-3"><?php echo e($tenant->owner ?: '-'); ?></td>
                            <td class="px-4 py-3">
                                <div><?php echo e($tenant->phone ?: '-'); ?></div>
                                <div class="text-xs text-slate-500"><?php echo e($tenant->email ?: '-'); ?></div>
                            </td>
                            <td class="max-w-xs px-4 py-3"><?php echo e($tenant->address ?: '-'); ?></td>
                            <td class="px-4 py-3">
                                <?php
                                    $statusClass = match ($tenant->status) {
                                        'Aktif' => 'bg-green-100 text-green-800',
                                        'Pending' => 'bg-amber-100 text-amber-800',
                                        default => 'bg-red-100 text-red-800',
                                    };
                                ?>
                                <span class="rounded-full px-3 py-1 text-xs font-semibold <?php echo e($statusClass); ?>"><?php echo e($tenant->status ?: 'Pending'); ?></span>
                            </td>
<td class="px-4 py-3">
    <div class="flex flex-wrap items-center gap-3">

        <a href="<?php echo e(route('admin.tenants.edit', $tenant->id)); ?>"
           class="font-semibold text-teal-700 hover:underline">
            Edit
        </a>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($tenant->status === 'Aktif'): ?>

            <form
                method="POST"
                action="<?php echo e(route('admin.tenants.status', $tenant->id)); ?>"
                onsubmit="return confirm('Apakah kamu yakin ingin menonaktifkan tenant ini?')"
            >
                <?php echo csrf_field(); ?>
                <?php echo method_field('PATCH'); ?>

                <input type="hidden" name="status" value="Nonaktif">

                <button
                    type="submit"
                    class="rounded-lg bg-red-100 px-3 py-2 text-xs font-semibold text-red-700 hover:bg-red-200"
                >
                    Nonaktifkan
                </button>
            </form>

        <?php else: ?>

            <form
                method="POST"
                action="<?php echo e(route('admin.tenants.status', $tenant->id)); ?>"
                onsubmit="return confirm('Apakah kamu yakin ingin mengaktifkan tenant ini?')"
            >
                <?php echo csrf_field(); ?>
                <?php echo method_field('PATCH'); ?>

                <input type="hidden" name="status" value="Aktif">

                <button
                    type="submit"
                    class="rounded-lg bg-green-100 px-3 py-2 text-xs font-semibold text-green-700 hover:bg-green-200"
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
                            <td colspan="7" class="px-4 py-12 text-center text-slate-500">
                                Belum ada data tenant. Klik “Tambah Tenant” untuk menambahkan usaha laundry.
                            </td>
                        </tr>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </tbody>
            </table>
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
<?php /**PATH D:\laragon\www\Laundry-Multitenant-terintegrasi\Laundry-Multitenant\app\Modules\Admin\resources\views\tenants\index.blade.php ENDPATH**/ ?>