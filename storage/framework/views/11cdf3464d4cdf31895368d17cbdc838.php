<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo e($title ?? 'Admin'); ?> - LaundryMap</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-slate-100 text-slate-800">
    <header class="bg-slate-900 text-white shadow">
        <nav class="mx-auto flex max-w-7xl flex-wrap items-center justify-between gap-4 px-5 py-4">
            <a href="<?php echo e(route('admin.dashboard')); ?>" class="text-xl font-bold">LaundryMap <span class="font-normal text-teal-300">Admin</span></a>
            <div class="flex flex-wrap items-center gap-4 text-sm">
                <a href="<?php echo e(route('customer.home')); ?>" class="hover:text-teal-200">Lihat website</a>
                <a href="<?php echo e(route('admin.dashboard')); ?>" class="hover:text-teal-200">Dashboard</a>
                <a href="<?php echo e(route('admin.tenants.index')); ?>" class="hover:text-teal-200">Data Tenant</a>
                <span class="hidden text-slate-300 sm:inline"><?php echo e(auth()->user()->name); ?></span>
                <form method="POST" action="<?php echo e(route('customer.logout')); ?>">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="rounded-lg bg-white/10 px-3 py-2 hover:bg-white/20">Keluar</button>
                </form>
            </div>
        </nav>
    </header>

    <main class="mx-auto max-w-7xl px-5 py-8">
        <?php if(session('success')): ?>
            <div class="mb-5 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-green-800">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <?php if($errors->any()): ?>
            <div class="mb-5 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-red-800">
                <p class="font-semibold">Periksa kembali data yang dimasukkan:</p>
                <ul class="mt-2 list-inside list-disc text-sm">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <?php echo e($slot); ?>

    </main>
</body>
</html>
<?php /**PATH D:\laragon\www\Laundry-Multitenant-terintegrasi\Laundry-Multitenant\resources\views\components\layouts\admin.blade.php ENDPATH**/ ?>