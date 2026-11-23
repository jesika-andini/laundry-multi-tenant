<?php if (isset($component)) { $__componentOriginal713903a1ae72dd2a9e62629038144506 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal713903a1ae72dd2a9e62629038144506 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.customer','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.customer'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>
<section class="max-w-md mx-auto px-5 py-12"><div class="bg-white border rounded-2xl p-7"><h1 class="text-2xl font-bold">Buat akun</h1><form method="POST" action="<?php echo e(route('customer.register.submit')); ?>" class="mt-6 space-y-4"><?php echo csrf_field(); ?><div><label class="block text-sm mb-1">Nama</label><input name="name" value="<?php echo e(old('name')); ?>" required class="w-full rounded-lg border px-3 py-3"><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-sm text-red-600"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?></div><div><label class="block text-sm mb-1">Email</label><input name="email" type="email" value="<?php echo e(old('email')); ?>" required class="w-full rounded-lg border px-3 py-3"><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-sm text-red-600"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?></div><div><label class="block text-sm mb-1">Password (minimal 8 karakter)</label><input name="password" type="password" required class="w-full rounded-lg border px-3 py-3"><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-sm text-red-600"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?></div><div><label class="block text-sm mb-1">Ulangi password</label><input name="password_confirmation" type="password" required class="w-full rounded-lg border px-3 py-3"></div><button class="w-full rounded-lg bg-blue-600 text-white py-3">Daftar</button></form><p class="text-sm mt-5">Sudah punya akun? <a class="text-blue-600" href="<?php echo e(route('customer.login')); ?>">Masuk</a></p></div></section> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal713903a1ae72dd2a9e62629038144506)): ?>
<?php $attributes = $__attributesOriginal713903a1ae72dd2a9e62629038144506; ?>
<?php unset($__attributesOriginal713903a1ae72dd2a9e62629038144506); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal713903a1ae72dd2a9e62629038144506)): ?>
<?php $component = $__componentOriginal713903a1ae72dd2a9e62629038144506; ?>
<?php unset($__componentOriginal713903a1ae72dd2a9e62629038144506); ?>
<?php endif; ?>
<?php /**PATH D:\laragon\www\Laundry-Multitenant-terintegrasi\Laundry-Multitenant\resources\views\account\register.blade.php ENDPATH**/ ?>