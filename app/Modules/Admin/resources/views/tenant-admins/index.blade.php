
<x-layouts.admin title="Akun Admin Laundry">

    {{-- Header halaman --}}
    <div class="mb-6 flex flex-wrap items-end justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold">
                Akun Admin Laundry
            </h1>

            <p class="mt-2 text-slate-500">
                Kelola akun administrator untuk masing-masing usaha laundry.
            </p>
        </div>

        <a
            href="{{ route('admin.tenant-admins.create') }}"
            class="rounded-lg bg-teal-700 px-5 py-3 font-semibold text-white hover:bg-teal-800"
        >
            + Tambah Akun Admin
        </a>
    </div>

    {{-- Pesan berhasil --}}
    @if (session('success'))
        <div class="mb-5 rounded-lg border border-green-200 bg-green-50 px-5 py-4 text-sm text-green-700">
            {{ session('success') }}
        </div>
    @endif

    {{-- Pesan error --}}
    @if ($errors->any())
        <div class="mb-5 rounded-lg border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-700">
            <p class="font-semibold">Terjadi kesalahan:</p>

            <ul class="mt-2 list-inside list-disc">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Ringkasan --}}
    <div class="mb-5 grid gap-4 sm:grid-cols-2">

        <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-sm text-slate-500">
                Total Akun Admin
            </p>

            <p class="mt-2 text-3xl font-bold text-slate-900">
                {{ $users->total() }}
            </p>
        </div>

        <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-sm text-slate-500">
                Akun Aktif
            </p>

            <p class="mt-2 text-3xl font-bold text-green-600">
                {{ $users->getCollection()->where('status', 'Aktif')->count() }}
            </p>
        </div>

    </div>

    {{-- Tabel akun --}}
    <section class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">

        <div class="mb-4 flex flex-wrap items-center justify-between gap-3">
            <h2 class="text-lg font-semibold">
                Daftar Admin Laundry
            </h2>

            <p class="text-sm text-slate-500">
                Menampilkan {{ $users->count() }} dari
                {{ $users->total() }} akun
            </p>
        </div>

        <div class="overflow-x-auto">

            <table class="w-full min-w-[900px] border-collapse text-left text-sm">

                <thead class="bg-slate-50 text-slate-600">
                    <tr>
                        <th class="px-4 py-3">No</th>
                        <th class="px-4 py-3">Nama Admin</th>
                        <th class="px-4 py-3">Kontak</th>
                        <th class="px-4 py-3">Tenant Laundry</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100">

                    @forelse ($users as $user)

                        <tr class="hover:bg-slate-50">

                            {{-- Nomor --}}
                            <td class="px-4 py-4 text-slate-500">
                                {{ $users->firstItem() + $loop->index }}
                            </td>

                            {{-- Identitas --}}
                            <td class="px-4 py-4">
                                <div class="font-semibold text-slate-800">
                                    {{ $user->name }}
                                </div>

                                <div class="mt-1 text-xs text-slate-500">
                                    ID: {{ $user->id }}
                                </div>
                            </td>

                            {{-- Kontak --}}
                            <td class="px-4 py-4">
                                <div>{{ $user->email }}</div>

                                <div class="mt-1 text-xs text-slate-500">
                                    {{ $user->phone ?: '-' }}
                                </div>
                            </td>

                            {{-- Tenant --}}
                            <td class="px-4 py-4">
                                @if ($user->tenant)
                                    <div class="font-medium text-slate-800">
                                        {{ $user->tenant->name }}
                                    </div>

                                    <div class="mt-1 text-xs text-slate-500">
                                        Tenant ID: {{ $user->tenant_id }}
                                    </div>
                                @else
                                    <span class="text-red-500">
                                        Belum terhubung
                                    </span>
                                @endif
                            </td>

                            {{-- Status --}}
                            <td class="px-4 py-4">
                                @if ($user->status === 'Aktif')

                                    <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                        Aktif
                                    </span>

                                @else

                                    <span class="rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">
                                        Nonaktif
                                    </span>

                                @endif
                            </td>

                            {{-- Aksi --}}
                            <td class="px-4 py-4">

                                <div class="flex flex-wrap items-center gap-3">

                                    <a
                                        href="{{ route('admin.tenant-admins.edit', $user->id) }}"
                                        class="font-semibold text-teal-700 hover:underline"
                                    >
                                        Edit
                                    </a>

                                    @if ($user->status === 'Aktif')

                                        <form
                                            method="POST"
                                            action="{{ route('admin.tenant-admins.status', $user->id) }}"
                                            onsubmit="return confirm('Yakin ingin menonaktifkan akun ini?')"
                                        >
                                            @csrf
                                            @method('PATCH')

                                            <input
                                                type="hidden"
                                                name="status"
                                                value="Nonaktif"
                                            >

                                            <button
                                                type="submit"
                                                class="font-semibold text-red-600 hover:underline"
                                            >
                                                Nonaktifkan
                                            </button>
                                        </form>

                                    @else

                                        <form
                                            method="POST"
                                            action="{{ route('admin.tenant-admins.status', $user->id) }}"
                                            onsubmit="return confirm('Yakin ingin mengaktifkan akun ini?')"
                                        >
                                            @csrf
                                            @method('PATCH')

                                            <input
                                                type="hidden"
                                                name="status"
                                                value="Aktif"
                                            >

                                            <button
                                                type="submit"
                                                class="font-semibold text-green-600 hover:underline"
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
                            <td
                                colspan="6"
                                class="px-4 py-12 text-center text-slate-500"
                            >
                                Belum ada akun Admin Laundry.

                                <div class="mt-2">
                                    Klik tombol Tambah Akun Admin untuk membuat akun baru.
                                </div>
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        {{-- Pagination --}}
        <div class="mt-5">
            {{ $users->links() }}
        </div>

    </section>

</x-layouts.admin>
