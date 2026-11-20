<?php if (isset($component)) { $__componentOriginalc8c9fd5d7827a77a31381de67195f0c3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc8c9fd5d7827a77a31381de67195f0c3 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.admin','data' => ['title' => 'Dashboard Admin']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.admin'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Dashboard Admin']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

    <div>
        <h1 class="text-3xl font-bold">Dashboard Admin</h1>
        <p class="mt-2 text-slate-500">Pusat pengelolaan website LaundryMap.</p>
    </div>

    <div class="mt-7 grid gap-5 md:grid-cols-2">
        <a href="<?php echo e(route('admin.tenants.index')); ?>" class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
            <div class="text-3xl">🏪</div>
            <h2 class="mt-3 text-xl font-bold">Data Tenant</h2>
            <p class="mt-2 text-sm text-slate-500">Tambah, lihat, dan perbarui data usaha laundry yang tampil pada halaman Layanan.</p>
            <span class="mt-5 inline-block font-semibold text-teal-700">Kelola tenant →</span>
        </a>
        <a href="<?php echo e(route('customer.home')); ?>" class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
            <div class="text-3xl">🌐</div>
            <h2 class="mt-3 text-xl font-bold">Website Publik</h2>
            <p class="mt-2 text-sm text-slate-500">Buka halaman utama LaundryMap seperti yang dilihat pengunjung.</p>
            <span class="mt-5 inline-block font-semibold text-teal-700">Lihat website →</span>
        </a>
    </div>
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
<?php /**PATH D:\laragon\www\Laundry-Multitenant-terintegrasi\Laundry-Multitenant\resources\views/portals/admin.blade.php ENDPATH**/ ?>