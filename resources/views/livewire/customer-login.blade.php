<section class="mx-auto max-w-5xl px-5 py-12">
    <div class="grid overflow-hidden rounded-3xl border border-slate-200/80 bg-white shadow-xl shadow-blue-950/5 lg:grid-cols-[1fr_1.05fr]">
        <div class="hidden flex-col justify-between bg-gradient-to-br from-[#1e3a8a] via-blue-700 to-cyan-500 p-8 text-white lg:flex">
            <div>
                <span class="grid h-11 w-11 place-items-center rounded-xl bg-white/15">
                    <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="3" width="16" height="18" rx="3"/><circle cx="12" cy="13" r="4"/><path d="M8 6.5h.01M11 6.5h.01"/></svg>
                </span>
                <h2 class="mt-6 text-2xl font-extrabold leading-snug">Cucian bersih,<br>pesanan gampang.</h2>
                <p class="mt-3 text-sm leading-6 text-blue-50/85">Masuk untuk memantau pesanan, menyimpan outlet favorit, dan menikmati promo pelanggan LaundryMap.</p>
            </div>
            <ul class="mt-8 space-y-3 text-xs text-blue-50/90">
                @foreach (['Pantau status cucian real-time', 'Riwayat pesanan tersimpan rapi', 'Pembayaran Transfer Bank atau E-wallet'] as $item)
                    <li class="flex items-center gap-2">
                        <span class="grid h-4 w-4 place-items-center rounded-full bg-white/15">
                            <svg class="h-2.5 w-2.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="m5 12 5 5L20 7"/></svg>
                        </span>
                        {{ $item }}
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="p-7 sm:p-10">
            <p class="text-[10px] font-extrabold uppercase tracking-[0.16em] text-blue-600">Pelanggan LaundryMap</p>
            <h1 class="mt-2 text-2xl font-extrabold tracking-tight text-slate-950 sm:text-3xl">Selamat datang kembali</h1>
            <p class="mt-2 text-sm text-slate-500">Masuk ke akun LaundryMap kamu.</p>

            <form wire:submit="login" class="mt-7 space-y-4">
                <div>
                    <label for="login-email" class="mb-1.5 block text-xs font-bold text-slate-700">Email</label>
                    <input id="login-email" type="email" wire:model.blur="email" autocomplete="email" placeholder="nama@email.com" class="w-full rounded-xl border border-slate-200 bg-slate-50/60 px-4 py-3 text-sm font-medium text-slate-800 placeholder:text-slate-400 focus:border-blue-400 focus:bg-white focus:outline-none focus:ring-0">
                    @error('email') <p class="mt-1 text-[11px] font-semibold text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="login-password" class="mb-1.5 block text-xs font-bold text-slate-700">Password</label>
                    <input id="login-password" type="password" wire:model="password" autocomplete="current-password" placeholder="Masukkan password" class="w-full rounded-xl border border-slate-200 bg-slate-50/60 px-4 py-3 text-sm font-medium text-slate-800 placeholder:text-slate-400 focus:border-blue-400 focus:bg-white focus:outline-none focus:ring-0">
                    @error('password') <p class="mt-1 text-[11px] font-semibold text-red-600">{{ $message }}</p> @enderror
                </div>

                <label class="flex cursor-pointer items-center gap-2 text-xs font-medium text-slate-600">
                    <input type="checkbox" wire:model="remember" class="h-4 w-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                    Ingat saya
                </label>

                <button type="submit" wire:loading.attr="disabled" wire:target="login" class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-blue-600 px-5 py-3 text-sm font-bold text-white shadow-lg shadow-blue-600/20 transition hover:bg-blue-700 disabled:cursor-wait disabled:opacity-70">
                    <span wire:loading.remove wire:target="login">Masuk</span>
                    <span wire:loading wire:target="login" class="inline-flex items-center gap-2">
                        <svg class="h-4 w-4 animate-spin" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="9" stroke="currentColor" stroke-opacity=".25" stroke-width="3"/><path d="M21 12a9 9 0 0 0-9-9" stroke="currentColor" stroke-width="3" stroke-linecap="round"/></svg>
                        Memproses...
                    </span>
                </button>
            </form>

            <p class="mt-5 text-center text-xs text-slate-500">
                Belum punya akun? <a href="{{ route('customer.register') }}" class="font-bold text-blue-600 hover:underline">Daftar sekarang</a>
            </p>
            <p class="mt-2 text-center text-xs text-slate-500">
                Punya usaha laundry? <a href="{{ route('customer.partner.register') }}" class="font-bold text-blue-600 hover:underline">Daftar jadi mitra</a>
            </p>
        </div>
    </div>
</section>
