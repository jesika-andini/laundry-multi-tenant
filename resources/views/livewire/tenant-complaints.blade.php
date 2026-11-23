<div>
    <section class="rounded-2xl border border-slate-200/80 bg-white p-4 shadow-sm sm:p-5">
        <div class="flex flex-wrap items-start justify-between gap-3">
            <div>
                <p class="flex items-center gap-2 text-[9px] font-extrabold uppercase tracking-[0.14em] text-blue-600">
                    <span class="h-1.5 w-1.5 rounded-full bg-blue-600"></span>Pusat Layanan Pelanggan
                </p>
                <h1 class="mt-2 text-xl font-extrabold tracking-tight text-slate-950 sm:text-2xl">Pengaduan Komplain</h1>
                <p class="mt-1 text-[11px] text-slate-500">Komplain pelanggan {{ $tenant->name }} masuk ke halaman ini secara otomatis.</p>
            </div>
            <a href="{{ route('tenant.dashboard') }}" class="inline-flex items-center gap-2 rounded-lg border border-slate-200 bg-white px-3.5 py-2 text-[10px] font-extrabold text-slate-600 transition hover:border-blue-200 hover:text-blue-700">
                <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="m15 6-6 6 6 6"/></svg>
                Kembali ke Ringkasan
            </a>
        </div>
    </section>

    <section class="mt-4 grid gap-3 sm:grid-cols-2 xl:grid-cols-4">
        @foreach ([
            ['Total Komplain', $totalComplaints, 'bg-slate-50 text-slate-700', 'border-slate-200'],
            ['Menunggu', $waitingComplaints, 'bg-amber-50 text-amber-700', 'border-amber-100'],
            ['Diproses', $processingComplaints, 'bg-blue-50 text-blue-700', 'border-blue-100'],
            ['Selesai', $finishedComplaints, 'bg-emerald-50 text-emerald-700', 'border-emerald-100'],
        ] as [$label, $count, $classes, $border])
            <div class="rounded-2xl border {{ $border }} {{ $classes }} p-4 shadow-sm">
                <p class="text-[9px] font-extrabold uppercase tracking-[0.08em] opacity-70">{{ $label }}</p>
                <p class="mt-2 text-3xl font-extrabold tracking-tight">{{ $count }}</p>
            </div>
        @endforeach
    </section>

    <section class="mt-4 overflow-hidden rounded-2xl border border-slate-200/80 bg-white shadow-sm">
        <div class="flex flex-wrap items-center justify-between gap-3 border-b border-slate-100 px-4 py-4 sm:px-5">
            <div>
                <h2 class="text-base font-extrabold tracking-tight text-slate-950">Daftar Komplain Masuk</h2>
                <p class="mt-0.5 text-[10px] text-slate-500">Tanggapi komplain pelanggan dengan cepat dan jelas.</p>
            </div>
            <div class="flex flex-wrap gap-1 rounded-lg bg-slate-50 p-1">
                @foreach (['semua' => 'Semua', 'menunggu' => 'Menunggu', 'diproses' => 'Diproses', 'selesai' => 'Selesai'] as $key => $label)
                    <button type="button" wire:click="setFilter('{{ $key }}')" class="rounded-md px-3 py-1.5 text-[9px] font-extrabold transition {{ $filter === $key ? 'bg-white text-blue-700 shadow-sm' : 'text-slate-500 hover:text-blue-700' }}">{{ $label }}</button>
                @endforeach
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full min-w-[860px] text-left">
                <thead>
                    <tr class="bg-slate-50/80 text-[8px] font-extrabold uppercase tracking-[0.08em] text-slate-400">
                        <th class="px-4 py-3">Komplain</th>
                        <th class="px-4 py-3">Pelanggan</th>
                        <th class="px-4 py-3">Pesanan</th>
                        <th class="px-4 py-3">Tanggal</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($complaints as $complaint)
                        <tr wire:key="tenant-complaint-{{ $complaint->id }}" class="align-top transition hover:bg-slate-50/60">
                            <td class="max-w-[320px] px-4 py-4">
                                <p class="text-[10px] font-extrabold text-slate-900">{{ $complaint->subject }}</p>
                                <p class="mt-1 line-clamp-2 text-[9px] leading-4 text-slate-500">{{ $complaint->description }}</p>
                                @if ($complaint->response)
                                    <p class="mt-1 inline-flex rounded bg-blue-50 px-1.5 py-0.5 text-[8px] font-bold text-blue-600">Sudah ditanggapi</p>
                                @endif
                            </td>
                            <td class="px-4 py-4">
                                <p class="text-[10px] font-extrabold text-slate-800">{{ $complaint->customer?->name ?? 'Pelanggan' }}</p>
                                <p class="mt-0.5 text-[9px] text-slate-400">{{ $complaint->customer?->email ?? '-' }}</p>
                            </td>
                            <td class="px-4 py-4">
                                <p class="text-[10px] font-extrabold text-blue-700">#{{ $complaint->order?->order_code ?? '-' }}</p>
                                <p class="mt-0.5 text-[9px] text-slate-400">{{ $complaint->order?->status ?? '-' }}</p>
                            </td>
                            <td class="px-4 py-4">
                                <p class="text-[9px] font-semibold text-slate-600">{{ $complaint->created_at?->locale('id')->translatedFormat('d M Y') }}</p>
                                <p class="mt-0.5 text-[9px] text-slate-400">{{ $complaint->created_at?->timezone('Asia/Jakarta')->format('H.i') }} WIB</p>
                            </td>
                            <td class="px-4 py-4">
                                <span class="inline-flex rounded-full px-2.5 py-1 text-[8px] font-extrabold {{ $this->statusClasses($complaint->status) }}">{{ $complaint->status }}</span>
                            </td>
                            <td class="px-4 py-4 text-right">
                                <button type="button" wire:click="openComplaint({{ $complaint->id }})" class="rounded-lg bg-blue-50 px-3 py-2 text-[9px] font-extrabold text-blue-700 transition hover:bg-blue-100">{{ $complaint->status === 'Menunggu' ? 'Tangani' : 'Lihat' }}</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-14 text-center">
                                <div class="mx-auto grid h-12 w-12 place-items-center rounded-xl bg-slate-50 text-slate-300">
                                    <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"><path d="M21 15a4 4 0 0 1-4 4H8l-5 3V6a3 3 0 0 1 3-3h11a4 4 0 0 1 4 4v8Z"/><path d="M8 9h8M8 13h5"/></svg>
                                </div>
                                <p class="mt-2 text-xs font-extrabold text-slate-600">Belum ada komplain pada filter ini</p>
                                <p class="mt-1 text-[10px] text-slate-400">Komplain baru dari pelanggan akan muncul otomatis di sini.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="flex flex-wrap items-center justify-between gap-3 border-t border-slate-100 px-4 py-3 sm:px-5">
            <p class="text-[9px] font-semibold text-slate-400">Menampilkan {{ $complaints->count() }} dari {{ $complaints->total() }} komplain.</p>
            @if ($complaints->hasPages())
                <div>{{ $complaints->links() }}</div>
            @endif
        </div>
    </section>

    @if ($showComplaintModal && $selectedComplaint)
        <div class="fixed inset-0 z-[100] flex items-end justify-center bg-slate-950/50 p-0 backdrop-blur-sm sm:items-center sm:p-5" wire:key="tenant-complaint-modal">
            <button type="button" class="absolute inset-0 h-full w-full cursor-default" wire:click="closeComplaint" aria-label="Tutup komplain"></button>
            <div class="relative z-10 max-h-[92vh] w-full max-w-lg overflow-y-auto rounded-t-2xl bg-white shadow-2xl sm:rounded-2xl">
                <div class="flex items-start justify-between gap-3 border-b border-slate-100 bg-slate-50/70 px-5 py-4">
                    <div>
                        <p class="text-[8px] font-extrabold uppercase tracking-[0.14em] text-blue-600">Detail Komplain</p>
                        <h3 class="mt-0.5 text-base font-extrabold text-slate-950">{{ $selectedComplaint->subject }}</h3>
                        <p class="mt-1 text-[9px] text-slate-500">#{{ $selectedComplaint->order?->order_code ?? '-' }} • {{ $selectedComplaint->created_at?->locale('id')->translatedFormat('d M Y, H:i') }} WIB</p>
                    </div>
                    <button type="button" wire:click="closeComplaint" class="grid h-8 w-8 place-items-center rounded-lg border border-slate-200 bg-white text-slate-500 transition hover:text-slate-900">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 6l12 12M18 6 6 18"/></svg>
                    </button>
                </div>

                <div class="space-y-3 p-5 text-[10px]">
                    @if ($feedback !== '')
                        <div class="rounded-lg border border-emerald-200 bg-emerald-50 px-3 py-2 font-semibold text-emerald-700">{{ $feedback }}</div>
                    @endif

                    @if ($errors->any())
                        <div class="rounded-lg border border-rose-200 bg-rose-50 px-3 py-2 font-semibold text-rose-700">{{ $errors->first() }}</div>
                    @endif

                    <div class="grid grid-cols-2 gap-2">
                        <div class="rounded-lg bg-slate-50 p-2.5"><p class="text-slate-400">Pelanggan</p><p class="mt-0.5 font-extrabold text-slate-800">{{ $selectedComplaint->customer?->name ?? '-' }}</p></div>
                        <div class="rounded-lg bg-slate-50 p-2.5"><p class="text-slate-400">Status saat ini</p><p class="mt-0.5"><span class="inline-flex rounded-full px-2 py-0.5 text-[8px] font-extrabold {{ $this->statusClasses($selectedComplaint->status) }}">{{ $selectedComplaint->status }}</span></p></div>
                    </div>

                    <div class="rounded-lg border border-slate-200 px-3 py-2">
                        <p class="font-extrabold text-slate-700">Isi komplain</p>
                        <p class="mt-1 leading-5 text-slate-500">{{ $selectedComplaint->description }}</p>
                    </div>

                    <div>
                        <label for="complaint-status" class="mb-1 block text-[9px] font-extrabold uppercase tracking-wide text-slate-500">Ubah Status</label>
                        <select id="complaint-status" wire:model="status" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2.5 text-[10px] font-semibold text-slate-700 outline-none focus:border-blue-400 focus:ring-2 focus:ring-blue-100">
                            @foreach (['Menunggu', 'Diproses', 'Selesai', 'Ditutup'] as $option)
                                <option value="{{ $option }}">{{ $option }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="complaint-response" class="mb-1 block text-[9px] font-extrabold uppercase tracking-wide text-slate-500">Tanggapan Admin Tenant</label>
                        <textarea id="complaint-response" wire:model="response" rows="4" maxlength="1000" placeholder="Tuliskan tanggapan atau solusi untuk pelanggan..." class="w-full resize-none rounded-lg border border-slate-200 bg-white px-3 py-2.5 text-[10px] leading-5 text-slate-700 outline-none placeholder:text-slate-400 focus:border-blue-400 focus:ring-2 focus:ring-blue-100"></textarea>
                    </div>

                    <div class="flex justify-end gap-2 border-t border-slate-100 pt-3">
                        <button type="button" wire:click="closeComplaint" class="rounded-lg border border-slate-200 px-4 py-2 text-[9px] font-extrabold text-slate-600">Batal</button>
                        <button type="button" wire:click="saveComplaint" wire:loading.attr="disabled" wire:target="saveComplaint" class="rounded-lg bg-blue-600 px-4 py-2 text-[9px] font-extrabold text-white transition hover:bg-blue-700 disabled:opacity-60">Simpan Tanggapan</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
