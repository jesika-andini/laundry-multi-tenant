<div>
    <section class="rounded-2xl border border-slate-200/80 bg-white p-4 shadow-sm sm:p-5">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <span class="grid h-12 w-12 place-items-center rounded-xl bg-gradient-to-br from-blue-600 to-cyan-500 text-white shadow-lg shadow-blue-600/20">
                    <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"><circle cx="12" cy="12" r="8"/><circle cx="12" cy="12" r="3"/><path d="M8 6.5c1.5-1 6.5-1 8 0"/></svg>
                </span>
                <div>
                    <h1 class="text-xl font-extrabold tracking-tight text-slate-950 sm:text-2xl">{{ $tenant->name }}</h1>
                    <p class="mt-0.5 flex flex-wrap items-center gap-2 text-[9px] font-semibold text-slate-500">
                        <span class="inline-flex items-center gap-1 text-blue-600"><svg class="h-3 w-3" viewBox="0 0 24 24" fill="currentColor"><path d="m12 2 2.5 6.5L21 11l-6.5 2.5L12 20l-2.5-6.5L3 11l6.5-2.5L12 2Z"/></svg>Data terisolasi privat</span>
                        <span class="text-slate-300">•</span>
                        <span>Akses Tenant Operasional Aktif</span>
                    </p>
                </div>
            </div>

            <div class="flex flex-wrap items-center gap-2">
                <span class="inline-flex items-center gap-2 rounded-lg border border-slate-200 bg-white px-3 py-2 text-[10px] font-bold text-slate-600">
                    <svg class="h-3.5 w-3.5 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9"><rect x="3" y="5" width="18" height="16" rx="2"/><path d="M16 3v4M8 3v4M3 10h18"/></svg>
                    Hari ini, {{ now()->locale('id')->translatedFormat('d F Y') }}
                </span>
                <a href="{{ route('customer.tenant.show', $tenant) }}" class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-4 py-2 text-[10px] font-extrabold text-white shadow-sm transition hover:bg-blue-700">
                    <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 12s3.5-6 10-6 10 6 10 6-3.5 6-10 6S2 12 2 12Z"/><circle cx="12" cy="12" r="2.5"/></svg>
                    Lihat Outlet
                </a>
            </div>
        </div>
    </section>

    <section id="pendapatan" class="mt-4 grid gap-3 sm:grid-cols-2 xl:grid-cols-4">
        <div class="rounded-2xl border border-slate-200/80 bg-white p-4 shadow-sm">
            <div class="flex items-start justify-between gap-3">
                <div>
                    <p class="text-[9px] font-extrabold uppercase tracking-[0.08em] text-slate-400">Pesanan Baru Hari Ini</p>
                    <p class="mt-2 text-3xl font-extrabold tracking-tight text-slate-950">{{ $newToday }}</p>
                </div>
                <span class="grid h-9 w-9 place-items-center rounded-xl bg-blue-50 text-blue-600">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9"><rect x="3" y="4" width="18" height="16" rx="2"/><path d="M3 9h18M7 13h3M7 16h5"/></svg>
                </span>
            </div>
            <p class="mt-3 inline-flex items-center gap-1.5 text-[9px] font-bold text-amber-600"><span class="h-1.5 w-1.5 rounded-full bg-amber-400"></span>+{{ $pendingConfirmation }} Menunggu Konfirmasi</p>
        </div>

        <div class="rounded-2xl border border-slate-200/80 bg-white p-4 shadow-sm">
            <div class="flex items-start justify-between gap-3">
                <div>
                    <p class="text-[9px] font-extrabold uppercase tracking-[0.08em] text-slate-400">Sedang Diproses</p>
                    <p class="mt-2 text-3xl font-extrabold tracking-tight text-slate-950">{{ $processing }} <span class="text-xs font-bold text-slate-400">cucian</span></p>
                </div>
                <span class="grid h-9 w-9 place-items-center rounded-xl bg-cyan-50 text-cyan-600">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9"><circle cx="12" cy="12" r="8"/><circle cx="12" cy="12" r="3"/></svg>
                </span>
            </div>
            <p class="mt-3 inline-flex items-center gap-1.5 text-[9px] font-bold text-cyan-600"><span class="h-1.5 w-1.5 rounded-full bg-cyan-400"></span>{{ $readyForPickup }} siap diambil</p>
        </div>

        <div class="rounded-2xl border border-slate-200/80 bg-white p-4 shadow-sm">
            <div class="flex items-start justify-between gap-3">
                <div>
                    <p class="text-[9px] font-extrabold uppercase tracking-[0.08em] text-slate-400">Pesanan Selesai (Bulan Ini)</p>
                    <p class="mt-2 text-3xl font-extrabold tracking-tight text-slate-950">{{ $completedThisMonth }}</p>
                </div>
                <span class="grid h-9 w-9 place-items-center rounded-xl bg-emerald-50 text-emerald-600">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 6 9 17l-5-5"/></svg>
                </span>
            </div>
            <p class="mt-3 text-[9px] font-bold {{ $completedGrowth >= 0 ? 'text-emerald-600' : 'text-rose-600' }}">
                {{ $completedGrowth >= 0 ? '↗ +' : '↘ ' }}{{ $completedGrowth }}% <span class="font-semibold text-slate-400">vs bulan lalu</span>
            </p>
        </div>

        <div class="rounded-2xl border border-slate-200/80 bg-white p-4 shadow-sm">
            <div class="flex items-start justify-between gap-3">
                <div class="min-w-0">
                    <p class="text-[9px] font-extrabold uppercase tracking-[0.08em] text-slate-400">Total Pendapatan (Bulan Ini)</p>
                    <p class="mt-2 truncate text-2xl font-extrabold tracking-tight text-slate-950">Rp{{ number_format($revenueThisMonth, 0, ',', '.') }}</p>
                </div>
                <span class="grid h-9 w-9 shrink-0 place-items-center rounded-xl bg-violet-50 text-violet-600">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9"><rect x="3" y="6" width="18" height="13" rx="2"/><path d="M3 10h18M7 15h3"/></svg>
                </span>
            </div>
            <p class="mt-3 text-[9px] font-bold text-violet-600">Net setelah fee platform 5%: Rp{{ number_format($netRevenue, 0, ',', '.') }}</p>
        </div>
    </section>

    <section class="mt-4 grid gap-4 xl:grid-cols-[minmax(0,1.7fr)_minmax(0,1fr)]">
        <div id="antrean" class="rounded-2xl border border-slate-200/80 bg-white p-4 shadow-sm sm:p-5">
            <div class="flex flex-wrap items-start justify-between gap-2">
                <div>
                    <h2 class="text-base font-extrabold tracking-tight text-slate-950">Progress Pesanan</h2>
                    <p class="mt-1 text-[10px] text-slate-500">Pantau posisi cucian pelanggan {{ $tenant->name }} dalam dua tahap utama.</p>
                </div>
                <span class="rounded-full bg-blue-50 px-2.5 py-1 text-[8px] font-extrabold uppercase tracking-wide text-blue-700">Live</span>
            </div>

            <div class="mt-5 grid gap-3 sm:grid-cols-2">
                <div class="rounded-2xl border border-blue-100 bg-gradient-to-br from-blue-50 to-cyan-50 px-4 py-4">
                    <div class="flex items-start justify-between gap-3">
                        <div>
                            <p class="text-[9px] font-extrabold uppercase tracking-[0.08em] text-blue-600">1. Sedang Diproses</p>
                            <p class="mt-2 text-3xl font-extrabold tracking-tight text-blue-950">{{ $processing }}</p>
                            <p class="mt-0.5 text-[9px] font-semibold text-blue-700/70">Pesanan sedang dikonfirmasi dan dikerjakan.</p>
                        </div>
                        <span class="grid h-10 w-10 place-items-center rounded-xl bg-white/80 text-blue-600 shadow-sm">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9"><circle cx="12" cy="12" r="8"/><circle cx="12" cy="12" r="3"/><path d="M8 6.5c1.5-1 6.5-1 8 0"/></svg>
                        </span>
                    </div>
                </div>

                <div class="rounded-2xl border border-emerald-100 bg-gradient-to-br from-emerald-50 to-teal-50 px-4 py-4">
                    <div class="flex items-start justify-between gap-3">
                        <div>
                            <p class="text-[9px] font-extrabold uppercase tracking-[0.08em] text-emerald-600">2. Siap Diambil</p>
                            <p class="mt-2 text-3xl font-extrabold tracking-tight text-emerald-950">{{ $readyForPickup }}</p>
                            <p class="mt-0.5 text-[9px] font-semibold text-emerald-700/70">Cucian selesai dikemas dan menunggu diambil.</p>
                        </div>
                        <span class="grid h-10 w-10 place-items-center rounded-xl bg-white/80 text-emerald-600 shadow-sm">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 6 9 17l-5-5"/></svg>
                        </span>
                    </div>
                </div>
            </div>

            <div class="mt-4 flex flex-wrap items-center justify-between gap-2 rounded-xl bg-slate-50 px-3.5 py-2.5 text-[9px] font-semibold text-slate-500">
                <span>Total antrean aktif: <strong class="text-slate-800">{{ $activeQueue }}</strong> pesanan</span>
                <a href="{{ route('tenant.dashboard') }}#pesanan" class="font-extrabold text-blue-600">Lihat pesanan →</a>
            </div>
        </div>

        <div class="rounded-2xl border border-slate-200/80 bg-white p-4 shadow-sm sm:p-5">
            <div class="flex items-center justify-between gap-2">
                <div>
                    <h2 class="text-base font-extrabold tracking-tight text-slate-950">Layanan Terpopuler</h2>
                    <p class="mt-1 text-[10px] text-slate-500">Porsi kontribusi omzet per paket layanan bulan berjalan.</p>
                </div>
                <span class="grid h-7 w-7 place-items-center rounded-full border border-slate-200 text-slate-400">
                    <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="9"/><path d="M12 8v4l2.5 2.5"/></svg>
                </span>
            </div>

            <div class="mt-4 flex flex-col items-center">
                <div class="relative grid h-36 w-36 place-items-center rounded-full" style="background: {{ $donutGradient }}">
                    <div class="grid h-[104px] w-[104px] place-items-center rounded-full bg-white text-center">
                        <div>
                            <p class="text-lg font-extrabold leading-none text-slate-950">100%</p>
                            <p class="mt-1 text-[7px] font-extrabold uppercase tracking-[0.14em] text-slate-400">Produksi</p>
                        </div>
                    </div>
                </div>
                <p class="mt-2 text-[9px] font-semibold text-slate-400">Total omzet layanan bulan ini: Rp{{ number_format($popularServices ? collect($popularServices)->sum('revenue') : 0, 0, ',', '.') }}</p>
            </div>

            <div class="mt-4 space-y-2">
                @forelse ($popularServices as $service)
                    <div class="rounded-xl border border-slate-100 bg-slate-50/70 px-3 py-2.5">
                        <div class="flex items-center justify-between gap-2">
                            <div class="flex min-w-0 items-center gap-2">
                                <span class="h-2 w-2 shrink-0 rounded-full" style="background: {{ $service['color'] }}"></span>
                                <p class="truncate text-[10px] font-extrabold text-slate-800">{{ $service['name'] }}</p>
                            </div>
                            <p class="shrink-0 text-[10px] font-extrabold text-slate-900">Rp{{ number_format($service['revenue'], 0, ',', '.') }}</p>
                        </div>
                        <div class="mt-1.5 flex items-center justify-between gap-2 text-[8px] font-semibold text-slate-400">
                            <span>{{ $service['orders'] }} pesanan</span>
                            <span>{{ $service['percent'] }}% porsi</span>
                        </div>
                    </div>
                @empty
                    <div class="rounded-xl border border-dashed border-slate-200 px-4 py-6 text-center text-[10px] text-slate-400">Belum ada data layanan bulan ini.</div>
                @endforelse
            </div>
        </div>
    </section>

    <section id="pesanan" class="mt-4 overflow-hidden rounded-2xl border border-slate-200/80 bg-white shadow-sm">
        <div class="flex flex-wrap items-center justify-between gap-3 border-b border-slate-100 px-4 py-4 sm:px-5">
            <div>
                <h2 class="text-base font-extrabold tracking-tight text-slate-950">Pesanan Terbaru Masuk di {{ $tenant->name }}</h2>
                <p class="mt-0.5 text-[10px] text-slate-500">Kelola status produksi dan konfirmasi pesanan pelanggan.</p>
            </div>
            <div class="flex flex-wrap gap-1 rounded-lg bg-slate-50 p-1">
                @foreach ([
                    'semua' => ['Semua', $allOrdersCount],
                    'konfirmasi' => ['Perlu Konfirmasi', $confirmationOrdersCount],
                    'dicuci' => ['Sedang Dicuci', $washingOrdersCount],
                ] as $key => [$label, $count])
                    <button type="button" wire:click="setOrderFilter('{{ $key }}')" class="rounded-md px-3 py-1.5 text-[9px] font-extrabold transition {{ $orderFilter === $key ? 'bg-white text-blue-700 shadow-sm' : 'text-slate-500 hover:text-blue-700' }}">{{ $label }} ({{ $count }})</button>
                @endforeach
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full min-w-[900px] text-left">
                <thead>
                    <tr class="bg-slate-50/80 text-[8px] font-extrabold uppercase tracking-[0.08em] text-slate-400">
                        <th class="px-4 py-3">No. Pesanan</th>
                        <th class="px-4 py-3">Pelanggan</th>
                        <th class="px-4 py-3">Layanan</th>
                        <th class="px-4 py-3">Berat / Qty</th>
                        <th class="px-4 py-3">Total Bayar</th>
                        <th class="px-4 py-3">Status Saat Ini</th>
                        <th class="px-4 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($orders as $order)
                        @php
                            $unit = strtolower((string) ($order->service?->unit ?? 'kg')) === 'kg' ? 'kg' : 'Pcs';
                            $weight = rtrim(rtrim(number_format((float) $order->weight, 2, ',', '.'), '0'), ',');
                            $customerPhone = $order->customer?->phone ?: '-';
                        @endphp
                        <tr wire:key="tenant-order-{{ $order->id }}" class="align-top transition hover:bg-slate-50/60">
                            <td class="px-4 py-4">
                                <p class="text-[10px] font-extrabold text-blue-700">#{{ $order->order_code }}</p>
                                <p class="mt-0.5 text-[9px] font-medium text-slate-400">{{ $order->created_at?->timezone('Asia/Jakarta')->format('H.i') }} WIB</p>
                            </td>
                            <td class="px-4 py-4">
                                <p class="text-[10px] font-extrabold text-slate-900">{{ $order->customer?->name ?? 'Pelanggan' }}</p>
                                <p class="mt-0.5 text-[9px] text-slate-400">{{ $customerPhone }}</p>
                            </td>
                            <td class="px-4 py-4">
                                <div class="flex items-center gap-2">
                                    <span class="grid h-6 w-6 place-items-center rounded-md bg-blue-50 text-blue-600">
                                        <svg class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="8"/><circle cx="12" cy="12" r="3"/></svg>
                                    </span>
                                    <div>
                                        <p class="text-[10px] font-bold text-slate-800">{{ $order->service?->name ?? 'Layanan' }}</p>
                                        <p class="text-[8px] text-slate-400">Estimasi {{ $order->service?->estimated_duration ?? 2 }} hari</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-4 text-[10px] font-bold text-slate-700">{{ $weight }} {{ $unit }}</td>
                            <td class="px-4 py-4">
                                <p class="text-[10px] font-extrabold text-slate-900">Rp{{ number_format((float) ($order->total_price ?? $order->total ?? 0), 0, ',', '.') }}</p>
                                <span class="mt-1 inline-flex rounded px-1.5 py-0.5 text-[8px] font-bold {{ $this->paymentClasses($order->payment_status ?: 'Menunggu Pembayaran') }}">{{ $order->payment_status ?: 'Menunggu Pembayaran' }} • {{ $order->payment_method ?: 'Tunai' }}</span>
                            </td>
                            <td class="px-4 py-4">
                                <span class="inline-flex items-center gap-1 rounded-full px-2.5 py-1 text-[8px] font-extrabold {{ $this->statusClasses($order->status) }}">
                                    <span class="h-1 w-1 rounded-full bg-current"></span>{{ $this->actionLabel($order->status) === 'Lihat Rincian' ? 'Selesai' : $order->status }}
                                </span>
                            </td>
                            <td class="px-4 py-4 text-right">
                                @if ($order->status === 'Selesai')
                                    <button type="button" wire:click="openOrder({{ $order->id }})" class="rounded-lg border border-slate-200 bg-white px-3 py-2 text-[9px] font-extrabold text-slate-600 transition hover:border-blue-200 hover:text-blue-700">Lihat Rincian</button>
                                @elseif ($this->actionLabel($order->status) === 'Terima Pesanan')
                                    <button type="button" wire:click="acceptOrder({{ $order->id }})" class="rounded-lg bg-blue-700 px-3 py-2 text-[9px] font-extrabold text-white transition hover:bg-blue-800">Terima Pesanan</button>
                                @elseif ($order->status === 'Siap Diambil')
                                    <button type="button" wire:click="advanceOrder({{ $order->id }})" class="rounded-lg bg-emerald-600 px-3 py-2 text-[9px] font-extrabold text-white transition hover:bg-emerald-700">Selesai</button>
                                @else
                                    <button type="button" wire:click="advanceOrder({{ $order->id }})" class="rounded-lg bg-blue-50 px-3 py-2 text-[9px] font-extrabold text-blue-700 transition hover:bg-blue-100">{{ $this->actionLabel($order->status) }}</button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-12 text-center">
                                <div class="mx-auto grid h-12 w-12 place-items-center rounded-xl bg-slate-50 text-slate-300">
                                    <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"><path d="M6 2h9l5 5v13a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2Z"/><path d="M14 2v6h6"/></svg>
                                </div>
                                <p class="mt-2 text-xs font-extrabold text-slate-600">Belum ada pesanan pada filter ini</p>
                                <p class="mt-1 text-[10px] text-slate-400">Pesanan baru akan muncul otomatis di sini.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="flex flex-wrap items-center justify-between gap-3 border-t border-slate-100 px-4 py-3 sm:px-5">
            <p class="text-[9px] font-semibold text-slate-400">Menampilkan {{ $orders->count() }} dari {{ $orders->total() }} pesanan di {{ $tenant->name }}.</p>
            @if ($orders->hasPages())
                <div>{{ $orders->links() }}</div>
            @endif
        </div>
    </section>

    @if ($showOrderModal && $selectedOrder)
        <div class="fixed inset-0 z-[100] flex items-end justify-center bg-slate-950/50 p-0 backdrop-blur-sm sm:items-center sm:p-5" wire:key="tenant-order-modal">
            <button type="button" class="absolute inset-0 h-full w-full cursor-default" wire:click="closeOrder" aria-label="Tutup rincian"></button>
            <div class="relative z-10 max-h-[92vh] w-full max-w-xl overflow-y-auto rounded-t-2xl bg-white shadow-2xl sm:rounded-2xl">
                <div class="flex items-start justify-between gap-3 border-b border-slate-100 bg-slate-50/70 px-5 py-4">
                    <div>
                        <p class="text-[8px] font-extrabold uppercase tracking-[0.14em] text-blue-600">Rincian Pesanan</p>
                        <h3 class="mt-0.5 text-base font-extrabold text-slate-950">#{{ $selectedOrder->order_code }}</h3>
                        <span class="mt-1 inline-flex rounded-full px-2 py-0.5 text-[8px] font-extrabold {{ $this->statusClasses($selectedOrder->status) }}">{{ $selectedOrder->status }}</span>
                    </div>
                    <button type="button" wire:click="closeOrder" class="grid h-8 w-8 place-items-center rounded-lg border border-slate-200 bg-white text-slate-500 transition hover:text-slate-900">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 6l12 12M18 6 6 18"/></svg>
                    </button>
                </div>

                <div class="space-y-3 p-5 text-[10px]">
                    @if ($feedback !== '')
                        <div class="rounded-lg border border-emerald-200 bg-emerald-50 px-3 py-2 font-semibold text-emerald-700">{{ $feedback }}</div>
                    @endif

                    <div class="grid grid-cols-2 gap-2">
                        <div class="rounded-lg bg-slate-50 p-2.5"><p class="text-slate-400">Pelanggan</p><p class="mt-0.5 font-extrabold text-slate-800">{{ $selectedOrder->customer?->name ?? '-' }}</p></div>
                        <div class="rounded-lg bg-slate-50 p-2.5"><p class="text-slate-400">Layanan</p><p class="mt-0.5 font-extrabold text-slate-800">{{ $selectedOrder->service?->name ?? '-' }}</p></div>
                        <div class="rounded-lg bg-slate-50 p-2.5"><p class="text-slate-400">Berat / Qty</p><p class="mt-0.5 font-extrabold text-slate-800">{{ rtrim(rtrim(number_format((float) $selectedOrder->weight, 2, ',', '.'), '0'), ',') }} {{ strtolower((string) ($selectedOrder->service?->unit ?? 'kg')) === 'kg' ? 'kg' : 'Pcs' }}</p></div>
                        <div class="rounded-lg bg-slate-50 p-2.5"><p class="text-slate-400">Total Bayar</p><p class="mt-0.5 font-extrabold text-blue-700">Rp{{ number_format((float) ($selectedOrder->total_price ?? $selectedOrder->total ?? 0), 0, ',', '.') }}</p></div>
                    </div>

                    @if ($selectedOrder->customer_note)
                        <div class="rounded-lg border border-amber-100 bg-amber-50 px-3 py-2"><p class="font-extrabold text-amber-700">Catatan pelanggan</p><p class="mt-0.5 leading-4 text-amber-800/80">{{ $selectedOrder->customer_note }}</p></div>
                    @endif

                    @if ($selectedOrder->address)
                        <div class="rounded-lg border border-slate-200 px-3 py-2"><p class="font-extrabold text-slate-700">Alamat penjemputan</p><p class="mt-0.5 leading-4 text-slate-500">{{ $selectedOrder->address }}</p></div>
                    @endif

                    <div class="flex flex-wrap gap-2 border-t border-slate-100 pt-3">
                        @if ($selectedOrder->status === 'Selesai')
                            <button type="button" wire:click="closeOrder" class="rounded-lg bg-slate-900 px-4 py-2 text-[9px] font-extrabold text-white">Tutup</button>
                        @elseif ($this->actionLabel($selectedOrder->status) === 'Terima Pesanan')
                            <button type="button" wire:click="acceptOrder({{ $selectedOrder->id }})" class="rounded-lg bg-blue-700 px-4 py-2 text-[9px] font-extrabold text-white">Terima Pesanan</button>
                        @else
                            <button type="button" wire:click="advanceOrder({{ $selectedOrder->id }})" class="rounded-lg bg-blue-600 px-4 py-2 text-[9px] font-extrabold text-white">{{ $this->actionLabel($selectedOrder->status) }}</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
