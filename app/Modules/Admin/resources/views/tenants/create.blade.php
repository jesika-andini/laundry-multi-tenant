<x-layouts.admin title="Tambah Tenant">
    <div class="mx-auto max-w-3xl">
        <div class="mb-6">
            <a href="{{ route('admin.tenants.index') }}" class="text-sm font-medium text-teal-700 hover:underline">&larr; Kembali ke Data Tenant</a>
            <h1 class="mt-3 text-3xl font-bold">Tambah Tenant</h1>
            <p class="mt-2 text-slate-500">Masukkan informasi usaha laundry yang akan didaftarkan.</p>
        </div>

        <form method="POST" action="{{ route('admin.tenants.store') }}" class="space-y-5 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            @csrf

            <div>
                <label for="name" class="mb-2 block text-sm font-semibold">Nama Laundry</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required maxlength="100" class="w-full rounded-lg border border-slate-300 px-4 py-3 focus:border-teal-600 focus:outline-none" placeholder="Masukkan nama laundry">
                @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="owner" class="mb-2 block text-sm font-semibold">Nama Pemilik</label>
                <input id="owner" type="text" name="owner" value="{{ old('owner') }}" required maxlength="100" class="w-full rounded-lg border border-slate-300 px-4 py-3 focus:border-teal-600 focus:outline-none" placeholder="Masukkan nama pemilik">
                @error('owner') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div class="grid gap-5 md:grid-cols-2">
                <div>
                    <label for="email" class="mb-2 block text-sm font-semibold">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required maxlength="100" class="w-full rounded-lg border border-slate-300 px-4 py-3 focus:border-teal-600 focus:outline-none" placeholder="contoh@email.com">
                    @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="phone" class="mb-2 block text-sm font-semibold">Nomor Telepon</label>
                    <input id="phone" type="text" name="phone" value="{{ old('phone') }}" required maxlength="30" class="w-full rounded-lg border border-slate-300 px-4 py-3 focus:border-teal-600 focus:outline-none" placeholder="08xxxxxxxxxx">
                    @error('phone') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label for="address" class="mb-2 block text-sm font-semibold">Alamat</label>
                <textarea id="address" name="address" rows="3" required class="w-full rounded-lg border border-slate-300 px-4 py-3 focus:border-teal-600 focus:outline-none" placeholder="Masukkan alamat laundry">{{ old('address') }}</textarea>
                @error('address') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="description" class="mb-2 block text-sm font-semibold">Deskripsi</label>
                <textarea id="description" name="description" rows="3" class="w-full rounded-lg border border-slate-300 px-4 py-3 focus:border-teal-600 focus:outline-none" placeholder="Jenis layanan atau deskripsi laundry">{{ old('description') }}</textarea>
                @error('description') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="status" class="mb-2 block text-sm font-semibold">Status Tenant</label>
                <select id="status" name="status" required class="w-full rounded-lg border border-slate-300 px-4 py-3 focus:border-teal-600 focus:outline-none">
                    <option value="Pending" @selected(old('status', 'Pending') === 'Pending')>Pending</option>
                    <option value="Aktif" @selected(old('status') === 'Aktif')>Aktif</option>
                    <option value="Nonaktif" @selected(old('status') === 'Nonaktif')>Nonaktif</option>
                </select>
                @error('status') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div class="flex flex-wrap justify-end gap-3 border-t border-slate-100 pt-5">
                <a href="{{ route('admin.tenants.index') }}" class="rounded-lg border border-slate-300 px-5 py-3 font-semibold text-slate-700 hover:bg-slate-50">Batal</a>
                <button type="submit" class="rounded-lg bg-teal-700 px-5 py-3 font-semibold text-white hover:bg-teal-800">Simpan Tenant</button>
            </div>
        </form>
    </div>
</x-layouts.admin>
