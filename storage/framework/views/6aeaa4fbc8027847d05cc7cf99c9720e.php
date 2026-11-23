<?php if (isset($component)) { $__componentOriginala9a83a123d88acdd340fad74fb98f602 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala9a83a123d88acdd340fad74fb98f602 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.tenant','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.tenant'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>
<div class="mt-8 grid sm:grid-cols-2 xl:grid-cols-3 gap-5"><div class="bg-white border rounded-2xl p-6"><p class="text-slate-500 text-sm">Status akun</p><p class="text-xl font-bold mt-2">Aktif</p></div><div class="bg-white border rounded-2xl p-6"><p class="text-slate-500 text-sm">Layanan laundry</p><p class="text-xl font-bold mt-2">Belum tersedia</p></div><div class="bg-white border rounded-2xl p-6"><p class="text-slate-500 text-sm">Pesanan</p><p class="text-xl font-bold mt-2">0</p></div></div><p class="mt-6 text-sm text-slate-500">Panel ini merupakan fondasi Modul 2. Fitur pengelolaan laundry dan pesanan dapat ditambahkan pada modul berikutnya.</p> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala9a83a123d88acdd340fad74fb98f602)): ?>
<?php $attributes = $__attributesOriginala9a83a123d88acdd340fad74fb98f602; ?>
<?php unset($__attributesOriginala9a83a123d88acdd340fad74fb98f602); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala9a83a123d88acdd340fad74fb98f602)): ?>
<?php $component = $__componentOriginala9a83a123d88acdd340fad74fb98f602; ?>
<?php unset($__componentOriginala9a83a123d88acdd340fad74fb98f602); ?>
<?php endif; ?>
<?php /**PATH D:\laragon\www\Laundry-Multitenant-terintegrasi\Laundry-Multitenant\resources\views\portals\tenant.blade.php ENDPATH**/ ?>