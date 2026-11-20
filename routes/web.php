<?php

use App\Http\Controllers\HomeController;
use App\Livewire\Checkout;
use App\Livewire\CustomerLogin;
use App\Livewire\CustomerRegister;
use App\Livewire\LaundrySearch;
use App\Livewire\PartnerRegistration;
use App\Livewire\TenantDetail;
use App\Modules\Account\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Beranda utama menampilkan statistik, mitra unggulan, dan layanan dari database.
Route::get('/', HomeController::class)->name('customer.home');

// Halaman pencarian & direktori laundry dikelola oleh komponen Livewire.
Route::get('/layanan', LaundrySearch::class)->name('customer.services');

// Profil mitra beserta katalog layanan dan ringkasan pesanan.
Route::get('/laundry/{tenant}', TenantDetail::class)->name('customer.tenant.show');

// Checkout membutuhkan akun pelanggan yang sudah masuk.
Route::get('/checkout/{tenant}', Checkout::class)
    ->middleware('auth')
    ->name('customer.checkout');

// Alias URL umum agar tautan lama /login dan /register tetap terhubung.
Route::redirect('/login', '/masuk')->name('login');
Route::redirect('/register', '/daftar')->name('register');

Route::middleware('guest')->group(function (): void {
    // Autentikasi pelanggan berbasis Livewire.
    Route::get('/masuk', CustomerLogin::class)->name('customer.login');
    Route::post('/masuk', [AuthController::class, 'login'])->name('customer.login.submit');

    Route::get('/daftar', CustomerRegister::class)->name('customer.register');
    Route::post('/daftar', [AuthController::class, 'register'])->name('customer.register.submit');

    // Pendaftaran mitra/tenant baru beserta akun pemilik outlet.
    Route::get('/daftar-mitra', PartnerRegistration::class)->name('customer.partner.register');
});

Route::post('/keluar', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('customer.logout');

// Dashboard mitra. Fitur pengelolaan layanan/pesanan dapat ditambahkan pada modul berikutnya.
Route::get('/tenant/dashboard', function () {
    return view('portals.tenant');
})->middleware(['auth', 'role:tenant'])->name('tenant.dashboard');

// Dashboard Admin memakai autentikasi dan role Admin yang sama dengan CRUD tenant.
Route::get('/admin', function () {
    return view('portals.admin');
})->middleware(['auth', 'superadmin'])->name('admin.dashboard');
