<x-layouts.admin title="Dashboard Admin">
    <div>
        <h1 class="text-3xl font-bold">Dashboard Admin</h1>
        <p class="mt-2 text-slate-500">Pusat pengelolaan website LaundryMap.</p>
    </div>

    <div class="mt-7 grid gap-5 md:grid-cols-2">
        <a href="{{ route('admin.tenants.index') }}" class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
            <div class="text-3xl">🏪</div>
            <h2 class="mt-3 text-xl font-bold">Data Tenant</h2>
            <p class="mt-2 text-sm text-slate-500">Tambah, lihat, dan perbarui data usaha laundry yang tampil pada halaman Layanan.</p>
            <span class="mt-5 inline-block font-semibold text-teal-700">Kelola tenant →</span>
        </a>
        <a href="{{ route('customer.home') }}" class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
            <div class="text-3xl">🌐</div>
            <h2 class="mt-3 text-xl font-bold">Website Publik</h2>
            <p class="mt-2 text-sm text-slate-500">Buka halaman utama LaundryMap seperti yang dilihat pengunjung.</p>
            <span class="mt-5 inline-block font-semibold text-teal-700">Lihat website →</span>
        </a>
    </div>
</x-layouts.admin>
