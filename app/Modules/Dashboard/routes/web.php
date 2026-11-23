<?php

use App\Livewire\TenantComplaints;
use App\Livewire\TenantDashboard;
use Illuminate\Support\Facades\Route;

Route::middleware(['web', 'auth', 'role:tenant,tenant_admin', 'tenant.context'])
    ->prefix('tenant')
    ->name('tenant.')
    ->group(function (): void {
        Route::get('/dashboard', TenantDashboard::class)->name('dashboard');
        Route::get('/complaints', TenantComplaints::class)->name('complaints.index');
    });
