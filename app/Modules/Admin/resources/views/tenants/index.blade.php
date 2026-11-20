<x-layouts.admin title="Data Tenant">
    <div class="mb-6 flex flex-wrap items-end justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold">Data Tenant</h1>
            <p class="mt-2 text-slate-500">Kelola semua usaha laundry yang terdaftar di LaundryMap.</p>
        </div>
        <a href="{{ route('admin.tenants.create') }}" class="rounded-lg bg-teal-700 px-5 py-3 font-semibold text-white hover:bg-teal-800">
            + Tambah Tenant
        </a>
    </div>

    @if (session('success'))
    <div class="mb-4 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
        {{ session('success') }}
    </div>
@endif

    <section class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
        <div class="mb-4 flex flex-wrap items-center justify-between gap-3">
            <h2 class="text-lg font-semibold">Daftar Laundry</h2>
            <p class="text-sm text-slate-500">Total tenant: <strong class="text-slate-800">{{ $tenants->count() }}</strong></p>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full min-w-[850px] border-collapse text-left text-sm">
                <thead class="bg-slate-50 text-slate-600">
                    <tr>
                        <th class="px-4 py-3">ID</th>
                        <th class="px-4 py-3">Nama Laundry</th>
                        <th class="px-4 py-3">Pemilik</th>
                        <th class="px-4 py-3">Kontak</th>
                        <th class="px-4 py-3">Alamat</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($tenants as $tenant)
                        <tr class="hover:bg-slate-50">
                            <td class="px-4 py-3">{{ $tenant->id }}</td>
                            <td class="px-4 py-3 font-medium">{{ $tenant->name }}</td>
                            <td class="px-4 py-3">{{ $tenant->owner ?: '-' }}</td>
                            <td class="px-4 py-3">
                                <div>{{ $tenant->phone ?: '-' }}</div>
                                <div class="text-xs text-slate-500">{{ $tenant->email ?: '-' }}</div>
                            </td>
                            <td class="max-w-xs px-4 py-3">{{ $tenant->address ?: '-' }}</td>
                            <td class="px-4 py-3">
                                @php
                                    $statusClass = match ($tenant->status) {
                                        'Aktif' => 'bg-green-100 text-green-800',
                                        'Pending' => 'bg-amber-100 text-amber-800',
                                        default => 'bg-red-100 text-red-800',
                                    };
                                @endphp
                                <span class="rounded-full px-3 py-1 text-xs font-semibold {{ $statusClass }}">{{ $tenant->status ?: 'Pending' }}</span>
                            </td>
<td class="px-4 py-3">
    <div class="flex flex-wrap items-center gap-3">

        <a href="{{ route('admin.tenants.edit', $tenant->id) }}"
           class="font-semibold text-teal-700 hover:underline">
            Edit
        </a>

        @if ($tenant->status === 'Aktif')

            <form
                method="POST"
                action="{{ route('admin.tenants.status', $tenant->id) }}"
                onsubmit="return confirm('Apakah kamu yakin ingin menonaktifkan tenant ini?')"
            >
                @csrf
                @method('PATCH')

                <input type="hidden" name="status" value="Nonaktif">

                <button
                    type="submit"
                    class="rounded-lg bg-red-100 px-3 py-2 text-xs font-semibold text-red-700 hover:bg-red-200"
                >
                    Nonaktifkan
                </button>
            </form>

        @else

            <form
                method="POST"
                action="{{ route('admin.tenants.status', $tenant->id) }}"
                onsubmit="return confirm('Apakah kamu yakin ingin mengaktifkan tenant ini?')"
            >
                @csrf
                @method('PATCH')

                <input type="hidden" name="status" value="Aktif">

                <button
                    type="submit"
                    class="rounded-lg bg-green-100 px-3 py-2 text-xs font-semibold text-green-700 hover:bg-green-200"
                >
                    Aktifkan
                </button>
            </form>

        @endif

    </div>
</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-12 text-center text-slate-500">
                                Belum ada data tenant. Klik “Tambah Tenant” untuk menambahkan usaha laundry.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</x-layouts.admin>
