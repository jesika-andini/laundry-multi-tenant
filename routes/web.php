<?php

use App\Http\Controllers\HomeController;
use App\Livewire\Checkout;
use App\Livewire\CustomerHelp;
use App\Livewire\CustomerLogin;
use App\Livewire\CustomerOrders;
use App\Livewire\CustomerRegister;
use App\Livewire\LaundrySearch;
use App\Livewire\OrderTracking;
use App\Livewire\PartnerRegistration;
use App\Livewire\TenantDetail;
use App\Models\Order;
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

// Daftar pesanan pelanggan dan pelacakan status pesanan.
Route::get('/pesanan', CustomerOrders::class)
    ->middleware('auth')
    ->name('customer.orders.index');

Route::get('/pesanan/{order}/invoice', function (int $order) {
    $orderModel = Order::query()
        ->withoutGlobalScope('tenant')
        ->where('customer_id', auth()->id())
        ->with(['tenant', 'service' => fn ($query) => $query->withoutGlobalScope('tenant')])
        ->findOrFail($order);

    return view('laundry.invoice', ['order' => $orderModel]);
})->middleware('auth')->name('customer.orders.invoice');

Route::get('/pesanan/{order}', OrderTracking::class)
    ->middleware('auth')
    ->whereNumber('order')
    ->name('customer.orders.show');

// Halaman bantuan publik dan formulir komplain pelanggan.
Route::get('/bantuan', CustomerHelp::class)->name('customer.help');

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

// Dashboard mitra dikelola oleh modul Dashboard dengan guard role tenant/tenant_admin.

// Dashboard Admin memakai autentikasi dan role Admin yang sama dengan CRUD tenant.
Route::get('/admin', function () {
    return view('portals.admin');
})->middleware(['auth', 'superadmin'])->name('admin.dashboard');
