<div>
    @if ($placed)
        <section class="mx-auto max-w-3xl px-5 py-14">
            <div class="overflow-hidden rounded-3xl border border-emerald-200 bg-white shadow-xl shadow-emerald-950/5">
                <div class="bg-gradient-to-br from-emerald-600 via-emerald-500 to-teal-500 px-6 py-9 text-center text-white">
                    <span class="mx-auto grid h-16 w-16 place-items-center rounded-full bg-white/15 ring-8 ring-white/10">
                        <svg class="h-9 w-9" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
                    </span>
                    <h1 class="mt-4 text-2xl font-extrabold tracking-tight">Pesanan Berhasil Dibuat!</h1>
                    <p class="mt-1 text-sm text-emerald-50">Mitra {{ $tenant->name }} akan segera memproses pesananmu.</p>
                </div>

                <div class="p-6">
                    <div class="rounded-2xl border border-slate-200 bg-slate-50/70 p-4">
                        <div class="flex flex-wrap items-center justify-between gap-2">
                            <div>
                                <p class="text-[10px] font-extrabold uppercase tracking-[0.14em] text-slate-400">Kode Pesanan</p>
                                <p class="mt-1 text-xl font-extrabold tracking-tight text-slate-900">{{ $orderCode }}</p>
                            </div>
                            <span class="rounded-full bg-amber-100 px-3 py-1.5 text-[10px] font-extrabold text-amber-700">Menunggu Pembayaran</span>
                        </div>
                    </div>

                    <div class="mt-4 space-y-2.5 text-sm">
                        <div class="flex justify-between gap-3 text-slate-500"><span>Mitra</span><span class="text-right font-bold text-slate-800">{{ $tenant->name }}</span></div>
                        <div class="flex justify-between gap-3 text-slate-500"><span>Layanan</span><span class="text-right font-bold text-slate-800">{{ $selectedService?->name }}</span></div>
                        <div class="flex justify-between gap-3 text-slate-500"><span>Berat / Jumlah</span><span class="font-bold text-slate-800">{{ rtrim(rtrim(number_format($weight, 2, ',', '.'), '0'), ',') }} {{ $selectedService && strtolower($selectedService->unit) === 'kg' ? 'kg' : 'item' }}</span></div>
                        <div class="flex justify-between gap-3 text-slate-500"><span>Metode Penyerahan</span><span class="font-bold text-slate-800">{{ $deliveryMethod === 'pickup' ? 'Antar-Jemput Mitra' : 'Datang Langsung' }}</span></div>
                        <div class="flex justify-between gap-3 text-slate-500"><span>Metode Pembayaran</span><span class="font-bold text-slate-800">{{ $this->paymentLabel($paymentMethod) }}</span></div>
                        @if ($deliveryMethod === 'pickup')
                            <div class="flex justify-between gap-3 text-slate-500"><span>Alamat Penjemputan</span><span class="max-w-[60%] text-right font-semibold text-slate-700">{{ $address }}</span></div>
                            <div class="flex justify-between gap-3 text-slate-500"><span>Jadwal Penjemputan</span><span class="text-right font-bold text-slate-800">{{ \Illuminate\Support\Carbon::parse($pickupDate)->translatedFormat('d M Y') }} • {{ $this->timeSlots()[$pickupTime] ?? $pickupTime }}</span></div>
                        @endif
                    </div>

                    <div class="mt-5 flex items-center justify-between gap-3 border-t border-dashed border-slate-200 pt-4">
                        <span class="text-sm font-extrabold text-slate-900">Total Pembayaran</span>
                        <span class="text-2xl font-extrabold tracking-tight text-blue-700">Rp{{ number_format($placedTotal, 0, ',', '.') }}</span>
                    </div>

                    <p class="mt-4 rounded-xl bg-blue-50 px-4 py-3 text-[11px] leading-5 text-blue-700">
                        Simpan kode pesanan ini. Tim {{ $tenant->name }} akan memverifikasi pembayaran dan segera memproses cucianmu.
                    </p>

                    <div class="mt-5 flex flex-col gap-2 sm:flex-row">
                        <a href="{{ route('customer.home') }}" class="inline-flex flex-1 items-center justify-center rounded-xl bg-blue-700 px-4 py-3 text-sm font-bold text-white transition hover:bg-blue-800">Kembali ke Beranda</a>
                        <a href="{{ route('customer.tenant.show', $tenant) }}" class="inline-flex flex-1 items-center justify-center rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm font-bold text-slate-700 transition hover:bg-slate-50">Lihat Detail Mitra</a>
                    </div>
                </div>
            </div>
        </section>
    @else
        @php
            $subtotal = $this->subtotal();
            $deliveryFee = $this->deliveryFee();
            $discount = $this->discount();
            $platformFee = $this->platformFee();
            $total = $this->total();
            $unitLabel = $selectedService && strtolower($selectedService->unit) === 'kg' ? 'kg' : 'item';
            $weightLabel = rtrim(rtrim(number_format($weight, 2, ',', '.'), '0'), ',');
        @endphp

        <div class="border-b border-blue-100 bg-[#eef4ff]">
            <div class="mx-auto flex max-w-7xl flex-wrap items-center justify-between gap-3 px-5 py-3.5">
                <div class="flex items-center gap-3">
                    <span class="grid h-9 w-9 place-items-center rounded-lg bg-blue-600 text-white">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9"><rect x="4" y="3" width="16" height="18" rx="3"/><circle cx="12" cy="14" r="4"/><path d="M8 7h.01M11 7h.01"/></svg>
                    </span>
                    <div>
                        <p class="text-xs font-semibold text-slate-500">Anda sedang memesan di: <span class="text-sm font-extrabold text-slate-900">{{ $tenant->name }}</span> <span class="ml-1 rounded bg-blue-100 px-1.5 py-0.5 text-[9px] font-extrabold text-blue-700">Buka • Siap Proses</span></p>
                        <p class="mt-0.5 flex items-center gap-1 text-[10px] text-slate-500">
                            <svg class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 10c0 5-8 11-8 11S4 15 4 10a8 8 0 1 1 16 0Z"/><circle cx="12" cy="10" r="2.5"/></svg>
                            {{ $tenant->address ?: 'Alamat belum tersedia' }} (Jarak ±1.2 km dari lokasi Anda)
                        </p>
                    </div>
                </div>
                <span class="inline-flex items-center gap-1.5 rounded-lg border border-slate-200 bg-white px-3 py-2 text-[10px] font-extrabold text-slate-600">
                    <svg class="h-3.5 w-3.5 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9"><path d="m12 3 2.6 5.3 5.8.8-4.2 4.1 1 5.8L12 16.3 6.8 19l1-5.8L3.6 9.1l5.8-.8L12 3Z"/></svg>
                    Mitra Resmi Super Platinum
                </span>
            </div>
        </div>

        <section class="mx-auto max-w-7xl px-5 pb-16 pt-7">
            <div class="flex flex-wrap items-end justify-between gap-3">
                <div>
                    <h1 class="text-3xl font-extrabold tracking-tight text-slate-950 sm:text-4xl">Formulir Pesanan Laundry</h1>
                    <p class="mt-1 text-sm text-slate-500">Lengkapi rincian cucian untuk penjemputan dan penanganan higienis.</p>
                </div>
                <span class="rounded-full border border-blue-200 bg-white px-3 py-1.5 text-[10px] font-extrabold text-blue-700">Draf ID #{{ $draftCode }}</span>
            </div>

            <div class="mt-6 grid gap-5 lg:grid-cols-[minmax(0,1fr)_410px]">
                <div class="min-w-0 space-y-4">
                    <section class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                        <div class="flex items-center justify-between gap-3">
                            <h2 class="flex items-center gap-2 text-base font-extrabold text-slate-900"><span class="grid h-6 w-6 place-items-center rounded-full bg-blue-100 text-[10px] font-extrabold text-blue-700">1</span> Pilih Layanan Outlet</h2>
                            <span class="inline-flex items-center gap-1 text-[10px] font-semibold text-slate-400">
                                <svg class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="5" y="11" width="14" height="10" rx="2"/><path d="M8 11V7a4 4 0 1 1 8 0v4"/></svg>
                                Outlet Terkunci
                            </span>
                        </div>

                        <div class="mt-4 flex items-center gap-3 rounded-xl border border-blue-100 bg-blue-50/40 p-3.5">
                            <span class="grid h-10 w-10 place-items-center rounded-lg bg-blue-600 text-xs font-extrabold text-white">LM</span>
                            <div class="min-w-0 flex-1">
                                <p class="truncate text-sm font-extrabold text-slate-900">{{ $tenant->name }} — {{ $tenant->address ?: 'Cabang Utama' }}</p>
                                <p class="truncate text-[10px] text-slate-500">{{ $tenant->description ?: 'Spesialis Cuci Higienis, Setrika Uap & Anti Bakteri' }}</p>
                            </div>
                            <span class="flex shrink-0 items-center gap-1 text-[11px] font-extrabold text-slate-800"><span class="text-amber-400">★</span> 4.9 <span class="text-[9px] font-semibold text-slate-400">(1.2k+ Ulasan)</span></span>
                        </div>

                        <div class="mt-4">
                            <label class="text-[10px] font-extrabold uppercase tracking-[0.12em] text-slate-400">Paket Perawatan Pakaian</label>
                            <div class="mt-2 space-y-2">
                                @foreach ($services as $service)
                                    <label class="flex cursor-pointer items-center gap-3 rounded-xl border p-3 transition {{ $serviceId === $service->id ? 'border-blue-400 bg-blue-50/50 ring-1 ring-blue-200' : 'border-slate-200 bg-white hover:border-blue-200' }}">
                                        <input type="radio" wire:model.live="serviceId" value="{{ $service->id }}" class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500">
                                        <div class="grid h-9 w-9 shrink-0 place-items-center rounded-lg {{ $serviceId === $service->id ? 'bg-blue-600 text-white' : 'bg-slate-100 text-slate-500' }}">
                                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9"><rect x="4" y="3" width="16" height="18" rx="3"/><circle cx="12" cy="14" r="4"/><path d="M8 7h.01M11 7h.01"/></svg>
                                        </div>
                                        <div class="min-w-0 flex-1">
                                            <p class="text-sm font-extrabold text-slate-800">{{ $service->name }} <span class="ml-1 rounded bg-blue-600 px-1.5 py-0.5 text-[8px] font-extrabold text-white">Paling Populer</span></p>
                                            <p class="mt-0.5 text-[10px] text-slate-500">Estimasi Pengerjaan: {{ (int) ($service->estimated_duration ?? 2) }} Hari Kerja • Lipat Rapi &amp; Plastik Kedap</p>
                                        </div>
                                        <p class="shrink-0 text-sm font-extrabold text-blue-700">Rp{{ number_format((float) $service->price, 0, ',', '.') }} <span class="text-[9px] font-semibold text-slate-400">/ {{ strtolower($service->unit) === 'kg' ? 'kg' : 'item' }}</span></p>
                                    </label>
                                @endforeach
                            </div>
                            @error('serviceId') <p class="mt-2 text-[10px] font-semibold text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div class="mt-4 rounded-xl border border-slate-200 p-3.5">
                            <div class="flex flex-wrap items-center justify-between gap-2">
                                <p class="text-[10px] font-extrabold uppercase tracking-[0.12em] text-slate-400">Estimasi Berat Laundry</p>
                                <span class="text-[10px] font-semibold text-slate-400">Minimum Order: {{ $this->minimumWeight() }} {{ $unitLabel }}</span>
                            </div>
                            <div class="mt-2 flex flex-wrap items-center gap-3">
                                <div class="flex items-center gap-2">
                                    <button type="button" wire:click="decrementWeight" class="grid h-9 w-9 place-items-center rounded-lg border border-slate-200 bg-white text-lg text-slate-500 transition hover:border-blue-300 hover:text-blue-600">−</button>
                                    <span class="min-w-12 rounded-lg bg-slate-50 px-3 py-2 text-center text-lg font-extrabold text-slate-900">{{ $weightLabel }}</span>
                                    <button type="button" wire:click="incrementWeight" class="grid h-9 w-9 place-items-center rounded-lg border border-slate-200 bg-white text-lg text-slate-500 transition hover:border-blue-300 hover:text-blue-600">+</button>
                                </div>
                                <span class="text-xs font-semibold text-slate-500">{{ $unitLabel === 'kg' ? 'Kilogram (kg)' : 'Satuan (item)' }}</span>
                            </div>
                            @error('weight') <p class="mt-2 text-[10px] font-semibold text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <p class="mt-3 flex items-start gap-2 rounded-xl bg-blue-50/60 px-3.5 py-3 text-[10px] leading-5 text-slate-500">
                            <svg class="mt-0.5 h-3.5 w-3.5 shrink-0 text-blue-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="9"/><path d="M12 8h.01M11 12h1v4h1"/></svg>
                            Berat aktual akan ditimbang ulang oleh kurir/petugas {{ $tenant->name }} saat diterima di timbangan digital terkalibrasi.
                        </p>
                    </section>

                    <section class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                        <h2 class="flex items-center gap-2 text-base font-extrabold text-slate-900"><span class="grid h-6 w-6 place-items-center rounded-full bg-blue-100 text-[10px] font-extrabold text-blue-700">2</span> Metode Penyerahan Laundry</h2>

                        <div class="mt-4 grid gap-3 sm:grid-cols-2">
                            <button type="button" wire:click="$set('deliveryMethod', 'pickup')" class="rounded-xl border p-4 text-left transition {{ $deliveryMethod === 'pickup' ? 'border-blue-400 bg-blue-50/50 ring-1 ring-blue-200' : 'border-slate-200 bg-white hover:border-blue-200' }}">
                                <div class="flex items-center justify-between gap-2">
                                    <span class="grid h-9 w-9 place-items-center rounded-lg bg-blue-600 text-white"><svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9"><path d="M3 7h11v8H3zM14 10h4l3 3v2h-7z"/><circle cx="7" cy="18" r="2"/><circle cx="18" cy="18" r="2"/></svg></span>
                                    <span class="grid h-4 w-4 place-items-center rounded-full border-2 {{ $deliveryMethod === 'pickup' ? 'border-blue-600' : 'border-slate-300' }}"><span class="h-2 w-2 rounded-full {{ $deliveryMethod === 'pickup' ? 'bg-blue-600' : 'bg-transparent' }}"></span></span>
                                </div>
                                <p class="mt-3 text-sm font-extrabold text-slate-900">Antar-Jemput Mitra</p>
                                <p class="mt-1 text-[10px] leading-4 text-slate-500">Kurir resmi {{ $tenant->name }} mengambil &amp; mengantar ke lokasi Anda.</p>
                                <p class="mt-2 text-[10px] font-extrabold text-blue-700">Biaya flat: Rp5.000 (&lt;2 km)</p>
                            </button>

                            <button type="button" wire:click="$set('deliveryMethod', 'dropoff')" class="rounded-xl border p-4 text-left transition {{ $deliveryMethod === 'dropoff' ? 'border-blue-400 bg-blue-50/50 ring-1 ring-blue-200' : 'border-slate-200 bg-white hover:border-blue-200' }}">
                                <div class="flex items-center justify-between gap-2">
                                    <span class="grid h-9 w-9 place-items-center rounded-lg bg-slate-100 text-slate-600"><svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9"><circle cx="12" cy="5" r="2"/><path d="M12 7v6m0 0-3 5m3-5 3 5M6 12h12"/></svg></span>
                                    <span class="grid h-4 w-4 place-items-center rounded-full border-2 {{ $deliveryMethod === 'dropoff' ? 'border-blue-600' : 'border-slate-300' }}"><span class="h-2 w-2 rounded-full {{ $deliveryMethod === 'dropoff' ? 'bg-blue-600' : 'bg-transparent' }}"></span></span>
                                </div>
                                <p class="mt-3 text-sm font-extrabold text-slate-900">Datang Langsung</p>
                                <p class="mt-1 text-[10px] leading-4 text-slate-500">Antar pakaian sendiri ke gerai {{ $tenant->name }}.</p>
                                <p class="mt-2 text-[10px] font-extrabold text-emerald-600">Gratis Biaya Pengiriman</p>
                            </button>
                        </div>

                        @if ($deliveryMethod === 'pickup')
                            <div class="mt-4 space-y-3">
                                <div class="flex items-center justify-between gap-2">
                                    <label class="text-[10px] font-extrabold uppercase tracking-[0.12em] text-slate-400">Alamat Penjemputan</label>
                                    <span class="text-[10px] font-bold text-blue-600">Ganti Alamat</span>
                                </div>
                                <textarea wire:model="address" rows="3" placeholder="Tulis alamat lengkap: jalan, nomor rumah, RT/RW, kelurahan, kota, dan patokan..." class="w-full rounded-xl border border-slate-200 bg-white px-3.5 py-3 text-xs text-slate-700 placeholder:text-slate-400 focus:border-blue-400 focus:outline-none focus:ring-0"></textarea>
                                @error('address') <p class="text-[10px] font-semibold text-red-600">{{ $message }}</p> @enderror

                                <div class="grid gap-3 sm:grid-cols-2">
                                    <div>
                                        <label class="text-[10px] font-extrabold uppercase tracking-[0.12em] text-slate-400">Waktu Penjemputan</label>
                                        <input type="date" wire:model="pickupDate" min="{{ now()->toDateString() }}" class="mt-1.5 w-full rounded-xl border border-slate-200 bg-white px-3 py-2.5 text-xs font-semibold text-slate-700 focus:border-blue-400 focus:outline-none focus:ring-0">
                                        @error('pickupDate') <p class="mt-1 text-[10px] font-semibold text-red-600">{{ $message }}</p> @enderror
                                    </div>
                                    <div>
                                        <label class="text-[10px] font-extrabold uppercase tracking-[0.12em] text-slate-400">Slot Jam</label>
                                        <select wire:model="pickupTime" class="mt-1.5 w-full rounded-xl border border-slate-200 bg-white px-3 py-2.5 text-xs font-semibold text-slate-700 focus:border-blue-400 focus:outline-none focus:ring-0">
                                            @foreach ($this->timeSlots() as $value => $label)
                                                <option value="{{ $value }}">{{ $label }}</option>
                                            @endforeach
                                        </select>
                                        @error('pickupTime') <p class="mt-1 text-[10px] font-semibold text-red-600">{{ $message }}</p> @enderror
                                    </div>
                                </div>

                                <div>
                                    <label class="text-[10px] font-extrabold uppercase tracking-[0.12em] text-slate-400">Kurir Yang Ditugaskan</label>
                                    <select wire:model="courier" class="mt-1.5 w-full rounded-xl border border-slate-200 bg-white px-3 py-2.5 text-xs font-semibold text-slate-700 focus:border-blue-400 focus:outline-none focus:ring-0">
                                        @foreach ($this->courierOptions() as $value => $label)
                                            <option value="{{ $value }}">{{ $label }}</option>
                                        @endforeach
                                    </select>
                                    @error('courier') <p class="mt-1 text-[10px] font-semibold text-red-600">{{ $message }}</p> @enderror
                                </div>
                            </div>
                        @else
                            <div class="mt-4 rounded-xl border border-emerald-100 bg-emerald-50/60 p-4">
                                <p class="text-xs font-extrabold text-emerald-800">Antar sendiri ke outlet</p>
                                <p class="mt-1 text-[11px] leading-5 text-emerald-700">{{ $tenant->address ?: 'Alamat outlet belum tersedia' }}<br>{{ $tenant->phone }}</p>
                            </div>
                        @endif
                    </section>

                    <section class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                        <div class="flex items-center justify-between gap-3">
                            <h2 class="flex items-center gap-2 text-base font-extrabold text-slate-900"><span class="grid h-6 w-6 place-items-center rounded-full bg-blue-100 text-[10px] font-extrabold text-blue-700">3</span> Catatan Khusus untuk {{ $tenant->name }}</h2>
                            <span class="text-[10px] font-semibold text-slate-400">Instruksi Khusus</span>
                        </div>
                        <textarea wire:model="notes" rows="3" placeholder="Contoh: Tolong pisahkan kemeja putih dan baju warna gelap, gunakan pewangi aroma lavender lembut." class="mt-3 w-full rounded-xl border border-slate-200 bg-slate-50/40 px-3.5 py-3 text-xs text-slate-700 placeholder:text-slate-400 focus:border-blue-400 focus:bg-white focus:outline-none focus:ring-0"></textarea>
                        @error('notes') <p class="mt-1 text-[10px] font-semibold text-red-600">{{ $message }}</p> @enderror
                    </section>
                </div>

                <aside class="min-w-0">
                    <div class="sticky top-24 space-y-3">
                        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                            <div class="flex items-center justify-between gap-2">
                                <h2 class="flex items-center gap-2 text-base font-extrabold text-slate-900">
                                    <svg class="h-4 w-4 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9"><path d="M4 5h16v14H4z"/><path d="M8 9h8M8 13h5"/></svg>
                                    Rincian Pembayaran
                                </h2>
                                <span class="rounded-full bg-amber-50 px-2.5 py-1 text-[9px] font-extrabold text-amber-700">Draf Menunggu Checkout</span>
                            </div>

                            <div class="mt-4 flex items-center justify-between gap-2 rounded-lg bg-slate-50 px-3 py-2 text-[10px] font-bold text-slate-600">
                                <span class="flex items-center gap-1.5"><svg class="h-3.5 w-3.5 text-blue-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="4" y="3" width="16" height="18" rx="3"/><circle cx="12" cy="14" r="4"/></svg> Mitra: {{ $tenant->name }}</span>
                                <span class="text-slate-400">#{{ $draftCode }}</span>
                            </div>

                            <div class="mt-3 space-y-2 text-xs">
                                <div class="flex items-start justify-between gap-3 text-slate-600">
                                    <span>Layanan {{ $selectedService?->name }} ({{ $weightLabel }} {{ $unitLabel }} × Rp{{ number_format((float) ($selectedService?->price ?? 0), 0, ',', '.') }})</span>
                                    <span class="shrink-0 font-extrabold text-slate-800">Rp{{ number_format($subtotal, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex items-center justify-between gap-3 text-slate-600">
                                    <span>Ongkos Antar-Jemput</span>
                                    <span class="font-extrabold text-slate-800">{{ $deliveryFee > 0 ? 'Rp'.number_format($deliveryFee, 0, ',', '.') : 'GRATIS' }}</span>
                                </div>
                                <div class="flex items-center justify-between gap-3 text-slate-600">
                                    <span class="flex items-center gap-1"><span class="text-blue-500">◈</span> Voucher Hemat Bersih</span>
                                    <span class="font-extrabold {{ $discount > 0 ? 'text-emerald-600' : 'text-slate-400' }}">{{ $discount > 0 ? '-Rp'.number_format($discount, 0, ',', '.') : '-' }}</span>
                                </div>
                                <div class="flex items-center justify-between gap-3 text-slate-600">
                                    <span class="flex items-center gap-1">Biaya Layanan Platform <span class="grid h-3 w-3 place-items-center rounded-full border border-slate-300 text-[7px]">i</span></span>
                                    <span class="font-extrabold text-slate-800">Rp{{ number_format($platformFee, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex items-center justify-between gap-3 text-slate-600">
                                    <span class="flex items-center gap-1"><span class="text-emerald-500">✓</span> Garansi Perlindungan Pakaian</span>
                                    <span class="font-extrabold text-emerald-600">GRATIS</span>
                                </div>
                            </div>

                            <div class="mt-3 rounded-lg border border-blue-100 bg-blue-50/50 px-3 py-2">
                                @if ($appliedVoucher !== '')
                                    <div class="flex items-center justify-between gap-2 text-[10px] font-extrabold text-blue-700">
                                        <span>✓ Kode {{ $appliedVoucher }} Berhasil Digunakan</span>
                                        <button type="button" wire:click="removeVoucher" class="text-blue-500 underline">Ubah</button>
                                    </div>
                                @else
                                    <div class="flex items-center gap-2">
                                        <input type="text" wire:model="voucherCode" placeholder="Kode voucher" class="min-w-0 flex-1 rounded-md border border-slate-200 bg-white px-2.5 py-1.5 text-[10px] font-semibold uppercase text-slate-700 focus:border-blue-400 focus:outline-none focus:ring-0">
                                        <button type="button" wire:click="applyVoucher" class="rounded-md bg-blue-600 px-2.5 py-1.5 text-[10px] font-extrabold text-white">Pakai</button>
                                    </div>
                                @endif
                                @error('voucherCode') <p class="mt-1 text-[9px] font-semibold text-red-600">{{ $message }}</p> @enderror
                            </div>

                            <div class="mt-4 border-t border-dashed border-slate-200 pt-3">
                                <div class="flex items-end justify-between gap-3">
                                    <div>
                                        <p class="text-xs font-semibold text-slate-500">Total Pembayaran</p>
                                        <p class="text-[10px] text-slate-400">Sudah Termasuk PPN &amp; Jaminan Mutu</p>
                                    </div>
                                    <p class="text-2xl font-extrabold tracking-tight text-blue-700">Rp{{ number_format($total, 0, ',', '.') }}</p>
                                </div>
                            </div>

                            <p class="mt-4 text-[9px] font-extrabold uppercase tracking-[0.12em] text-slate-400">Metode Pembayaran</p>
                            <div class="mt-2 space-y-2">
                                @foreach ($this->paymentOptions() as $value => $label)
                                    <label class="flex cursor-pointer items-center gap-2.5 rounded-lg border px-3 py-2.5 transition {{ $paymentMethod === $value ? 'border-blue-400 bg-blue-50/50' : 'border-slate-200 bg-white hover:border-blue-200' }}">
                                        <input type="radio" wire:model.live="paymentMethod" value="{{ $value }}" class="h-3.5 w-3.5 border-slate-300 text-blue-600 focus:ring-blue-500">
                                        <span class="grid h-6 w-6 shrink-0 place-items-center rounded-md {{ $paymentMethod === $value ? 'bg-blue-600 text-white' : 'bg-slate-100 text-slate-500' }}">
                                            @if ($value === 'qris')
                                                <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="6" height="6"/><rect x="15" y="3" width="6" height="6"/><rect x="3" y="15" width="6" height="6"/><path d="M15 15h2v2h-2zm4 0h2v2h-2zm-4 4h2v2h-2zm4 0h2v2h-2z"/></svg>
                                            @elseif ($value === 'va')
                                                <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="6" width="18" height="12" rx="2"/><path d="M3 10h18"/></svg>
                                            @elseif ($value === 'ewallet')
                                                <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="6" width="18" height="13" rx="3"/><path d="M16 12h.01"/></svg>
                                            @else
                                                <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="6" width="20" height="12" rx="2"/><circle cx="12" cy="12" r="2.5"/></svg>
                                            @endif
                                        </span>
                                        <span class="min-w-0 flex-1">
                                            <span class="block text-[11px] font-extrabold text-slate-800">{{ $label }}</span>
                                            <span class="block text-[9px] text-slate-400">{{ $value === 'qris' ? 'Verifikasi Otomatis Seketika' : ($value === 'cod' ? 'Bayar langsung ke kurir Laundry' : 'Verifikasi otomatis') }}</span>
                                        </span>
                                    </label>
                                @endforeach
                            </div>
                            @error('paymentMethod') <p class="mt-1 text-[10px] font-semibold text-red-600">{{ $message }}</p> @enderror
                            @error('checkout') <p class="mt-2 rounded-lg bg-red-50 px-3 py-2 text-[10px] font-semibold text-red-600">{{ $message }}</p> @enderror

                            <button type="button" wire:click="placeOrder" wire:loading.attr="disabled" wire:target="placeOrder" class="mt-4 inline-flex w-full items-center justify-center gap-2 rounded-xl bg-blue-700 px-4 py-4 text-sm font-extrabold text-white shadow-lg shadow-blue-700/25 transition hover:bg-blue-800 disabled:cursor-wait disabled:opacity-70">
                                <svg wire:loading.remove wire:target="placeOrder" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="5" y="11" width="14" height="10" rx="2"/><path d="M8 11V7a4 4 0 1 1 8 0v4"/></svg>
                                <span wire:loading.remove wire:target="placeOrder">Konfirmasi &amp; Bayar Sekarang<br><span class="text-[11px] font-bold text-blue-100">(Rp{{ number_format($total, 0, ',', '.') }})</span></span>
                                <span wire:loading wire:target="placeOrder">Memproses pesanan...</span>
                            </button>

                            <div class="mt-3 flex items-start gap-2 rounded-lg border border-emerald-100 bg-emerald-50/50 px-3 py-2.5">
                                <span class="mt-0.5 grid h-4 w-4 shrink-0 place-items-center rounded-full bg-emerald-500 text-[8px] text-white">✓</span>
                                <p class="text-[9px] leading-4 text-emerald-800"><span class="font-extrabold">100% Escrow LaundryHub Protection</span><br>Dana aman dan hanya dicairkan ke mitra setelah cucian selesai ditimbang, diproses, dan diterima kembali.</p>
                            </div>
                        </div>

                        <div class="rounded-2xl border border-slate-200 bg-white p-4">
                            <div class="flex items-center justify-around gap-2 text-center">
                                <div>
                                    <span class="mx-auto grid h-7 w-7 place-items-center rounded-full bg-blue-50 text-blue-600"><svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="5" y="3" width="14" height="18" rx="3"/><circle cx="12" cy="14" r="3"/></svg></span>
                                    <p class="mt-1 text-[9px] font-bold text-slate-600">1 Mesin 1 Pelanggan</p>
                                </div>
                                <div>
                                    <span class="mx-auto grid h-7 w-7 place-items-center rounded-full bg-blue-50 text-blue-600"><svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg></span>
                                    <p class="mt-1 text-[9px] font-bold text-slate-600">Tepat Waktu 48 Jam</p>
                                </div>
                                <div>
                                    <span class="mx-auto grid h-7 w-7 place-items-center rounded-full bg-blue-50 text-blue-600"><svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 6 9 17l-5-5"/></svg></span>
                                    <p class="mt-1 text-[9px] font-bold text-slate-600">Garansi Cuci Ulang</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
        </section>
    @endif
</div>
