
<x-layouts.admin title="Edit Tenant">
    <div class="mx-auto max-w-3xl">

        {{-- Header --}}
        <div class="mb-6">
            <a href="{{ route('admin.tenants.index') }}"
               class="text-sm font-medium text-teal-700 hover:underline">
                &larr; Kembali ke Data Tenant
            </a>

            <h1 class="mt-3 text-3xl font-bold">Edit Tenant</h1>

            <p class="mt-2 text-slate-500">
                Ubah informasi usaha laundry yang terdaftar di LaundryMap.
            </p>
        </div>

        {{-- Informasi Tenant --}}
        <div class="mb-5 rounded-lg border border-slate-200 bg-white px-5 py-4">
            <div class="flex flex-wrap items-center justify-between gap-3">

                <div class="text-sm text-slate-600">
                    ID Tenant:
                    <strong class="text-slate-900">
                        {{ $tenant->id }}
                    </strong>
                </div>

                <div class="text-sm">
                    <span class="text-slate-500">Status:</span>

                    @if ($tenant->status === 'Aktif')
                        <span class="ml-2 rounded-full bg-green-100 px-3 py-1 font-semibold text-green-700">
                            Aktif
                        </span>
                    @elseif ($tenant->status === 'Nonaktif')
                        <span class="ml-2 rounded-full bg-red-100 px-3 py-1 font-semibold text-red-700">
                            Nonaktif
                        </span>
                    @else
                        <span class="ml-2 rounded-full bg-yellow-100 px-3 py-1 font-semibold text-yellow-700">
                            Pending
                        </span>
                    @endif
                </div>

            </div>

            <p class="mt-3 text-xs text-slate-500">
                Status tenant hanya dapat diubah melalui tombol
                Aktifkan atau Nonaktifkan pada halaman daftar tenant.
            </p>
        </div>

        {{-- Pesan Error --}}
        @if ($errors->any())
            <div class="mb-5 rounded-lg border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-700">
                <p class="font-semibold">Terdapat kesalahan pada input:</p>

                <ul class="mt-2 list-inside list-disc">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form Edit Tenant --}}
        <form
            method="POST"
            action="{{ route('admin.tenants.update', $tenant->id) }}"
            class="space-y-5 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm"
        >
            @csrf
            @method('PUT')

            {{-- Nama Laundry --}}
            <div>
                <label for="name" class="mb-2 block text-sm font-semibold">
                    Nama Laundry
                </label>

                <input
                    id="name"
                    type="text"
                    name="name"
                    value="{{ old('name', $tenant->name) }}"
                    required
                    maxlength="100"
                    class="w-full rounded-lg border border-slate-300 px-4 py-3 focus:border-teal-600 focus:outline-none"
                >

                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Nama Pemilik --}}
            <div>
                <label for="owner" class="mb-2 block text-sm font-semibold">
                    Nama Pemilik
                </label>

                <input
                    id="owner"
                    type="text"
                    name="owner"
                    value="{{ old('owner', $tenant->owner) }}"
                    required
                    maxlength="100"
                    class="w-full rounded-lg border border-slate-300 px-4 py-3 focus:border-teal-600 focus:outline-none"
                >

                @error('owner')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Email dan Nomor Telepon --}}
            <div class="grid gap-5 md:grid-cols-2">

                <div>
                    <label for="email" class="mb-2 block text-sm font-semibold">
                        Email
                    </label>

                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email', $tenant->email) }}"
                        required
                        maxlength="100"
                        class="w-full rounded-lg border border-slate-300 px-4 py-3 focus:border-teal-600 focus:outline-none"
                    >

                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="phone" class="mb-2 block text-sm font-semibold">
                        Nomor Telepon
                    </label>

                    <input
                        id="phone"
                        type="text"
                        name="phone"
                        value="{{ old('phone', $tenant->phone) }}"
                        required
                        maxlength="30"
                        class="w-full rounded-lg border border-slate-300 px-4 py-3 focus:border-teal-600 focus:outline-none"
                    >

                    @error('phone')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            {{-- Alamat --}}
            <div>
                <label for="address" class="mb-2 block text-sm font-semibold">
                    Alamat
                </label>

                <textarea
                    id="address"
                    name="address"
                    rows="3"
                    required
                    class="w-full rounded-lg border border-slate-300 px-4 py-3 focus:border-teal-600 focus:outline-none"
                >{{ old('address', $tenant->address) }}</textarea>

                @error('address')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Deskripsi --}}
            <div>
                <label for="description" class="mb-2 block text-sm font-semibold">
                    Deskripsi
                </label>

                <textarea
                    id="description"
                    name="description"
                    rows="3"
                    class="w-full rounded-lg border border-slate-300 px-4 py-3 focus:border-teal-600 focus:outline-none"
                >{{ old('description', $tenant->description) }}</textarea>

                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tombol Aksi --}}
            <div class="flex flex-wrap justify-end gap-3 border-t border-slate-100 pt-5">

                <a
                    href="{{ route('admin.tenants.index') }}"
                    class="rounded-lg border border-slate-300 px-5 py-3 font-semibold text-slate-700 hover:bg-slate-50"
                >
                    Batal
                </a>

                <button
                    type="submit"
                    class="rounded-lg bg-teal-700 px-5 py-3 font-semibold text-white hover:bg-teal-800"
                >
                    Simpan Perubahan
                </button>

            </div>

        </form>
    </div>
</x-layouts.admin>
