<?php

use App\Modules\Admin\Http\Controllers\AdminTenantUserController;
use App\Modules\Admin\Http\Controllers\AdminTenantController;
use Illuminate\Support\Facades\Route;
use App\Modules\Admin\Http\Controllers\AdminTenantStatusController;

// Route modul harus berada dalam grup web agar session, CSRF, flash message,
// dan variabel validasi ($errors) tersedia pada setiap halaman.

Route::middleware(['web', 'auth', 'superadmin'])
    ->prefix('admin/tenant-admins')
    ->name('admin.tenant-admins.')
    ->group(function (): void {

        Route::get('/', [
            AdminTenantUserController::class,
            'index'
        ])->name('index');

        Route::get('/create', [
            AdminTenantUserController::class,
            'create'
        ])->name('create');

        Route::post('/', [
            AdminTenantUserController::class,
            'store'
        ])->name('store');

        Route::get('/{user}/edit', [
            AdminTenantUserController::class,
            'edit'
        ])->name('edit');

        Route::put('/{user}', [
            AdminTenantUserController::class,
            'update'
        ])->name('update');

        Route::patch('/{user}/status', [
            AdminTenantUserController::class,
            'changeStatus'
        ])->name('status');

    });
