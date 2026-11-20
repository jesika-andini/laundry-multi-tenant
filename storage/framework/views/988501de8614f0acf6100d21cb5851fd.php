<?php if (isset($component)) { $__componentOriginal713903a1ae72dd2a9e62629038144506 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal713903a1ae72dd2a9e62629038144506 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.customer','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.customer'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?><section class="max-w-md mx-auto px-5 py-12"><div class="bg-white border rounded-2xl p-7"><h1 class="text-2xl font-bold">Masuk</h1><p class="text-sm text-slate-500 mt-1">Masuk ke akun LaundryHub.</p><form method="POST" action="<?php echo e(route('customer.login.submit')); ?>" class="mt-6 space-y-4"><?php echo csrf_field(); ?><div><label class="block text-sm mb-1">Email</label><input name="email" type="email" value="<?php echo e(old('email')); ?>" required class="w-full rounded-lg border px-3 py-3"></div><div><label class="block text-sm mb-1">Password</label><input name="password" type="password" required class="w-full rounded-lg border px-3 py-3"></div><?php if($errors->any()): ?><p class="text-sm text-red-600"><?php echo e($errors->first()); ?></p><?php endif; ?><label class="text-sm flex gap-2"><input type="checkbox" name="remember"> Ingat saya</label><button class="w-full rounded-lg bg-blue-600 text-white py-3">Masuk</button></form><p class="text-sm mt-5">Belum punya akun? <a class="text-blue-600" href="<?php echo e(route('customer.register')); ?>">Daftar</a></p></div></section> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal713903a1ae72dd2a9e62629038144506)): ?>
<?php $attributes = $__attributesOriginal713903a1ae72dd2a9e62629038144506; ?>
<?php unset($__attributesOriginal713903a1ae72dd2a9e62629038144506); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal713903a1ae72dd2a9e62629038144506)): ?>
<?php $component = $__componentOriginal713903a1ae72dd2a9e62629038144506; ?>
<?php unset($__componentOriginal713903a1ae72dd2a9e62629038144506); ?>
<?php endif; ?>
<?php /**PATH D:\laragon\www\Laundry-Multitenant-terintegrasi\Laundry-Multitenant\resources\views/account/login.blade.php ENDPATH**/ ?>