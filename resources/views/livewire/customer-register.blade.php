<section class="mx-auto max-w-5xl px-5 py-12">
    <div class="grid overflow-hidden rounded-3xl border border-slate-200/80 bg-white shadow-xl shadow-blue-950/5 lg:grid-cols-[1fr_1.05fr]">
        <div class="hidden flex-col justify-between bg-gradient-to-br from-[#1e3a8a] via-blue-700 to-cyan-500 p-8 text-white lg:flex">
            <div>
                <span class="grid h-11 w-11 place-items-center rounded-xl bg-white/15">
                    <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="3" width="16" height="18" rx="3"/><circle cx="12" cy="13" r="4"/><path d="M8 6.5h.01M11 6.5h.01"/></svg>
                </span>
                <h2 class="mt-6 text-2xl font-extrabold leading-snug">Satu akun untuk<br>semua kebutuhan laundry.</h2>
                <p class="mt-3 text-sm leading-6 text-blue-50/85">Buat akun pelanggan dan nikmati kemudahan memesan laundry dari puluhan mitra terpercaya.</p>
            </div>
            <ul class="mt-8 space-y-3 text-xs text-blue-50/90">
                @foreach (['Pesan antar-jemput langsung', 'Bandingkan harga & layanan', 'Notifikasi status cucian'] as $item)
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
            <p class="text-[10px] font-extrabold uppercase tracking-[0.16em] text-blue-600">Buat Akun Pelanggan</p>
            <h1 class="mt-2 text-2xl font-extrabold tracking-tight text-slate-950 sm:text-3xl">Daftar akun LaundryHub</h1>
            <p class="mt-2 text-sm text-slate-500">Cukup isi data di bawah, gratis dan cepat.</p>

            <form wire:submit="register" class="mt-7 space-y-4">
                <div>
                    <label for="register-name" class="mb-1.5 block text-xs font-bold text-slate-700">Nama Lengkap</label>
                    <input id="register-name" type="text" wire:model.blur="name" maxlength="100" autocomplete="name" placeholder="Nama kamu" class="w-full rounded-xl border border-slate-200 bg-slate-50/60 px-4 py-3 text-sm font-medium text-slate-800 placeholder:text-slate-400 focus:border-blue-400 focus:bg-white focus:outline-none focus:ring-0">
                    @error('name') <p class="mt-1 text-[11px] font-semibold text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="register-email" class="mb-1.5 block text-xs font-bold text-slate-700">Email</label>
                    <input id="register-email" type="email" wire:model.blur="email" maxlength="255" autocomplete="email" placeholder="nama@email.com" class="w-full rounded-xl border border-slate-200 bg-slate-50/60 px-4 py-3 text-sm font-medium text-slate-800 placeholder:text-slate-400 focus:border-blue-400 focus:bg-white focus:outline-none focus:ring-0">
                    @error('email') <p class="mt-1 text-[11px] font-semibold text-red-600">{{ $message }}</p> @enderror
                </div>

                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <label for="register-password" class="mb-1.5 block text-xs font-bold text-slate-700">Password</label>
                        <input id="register-password" type="password" wire:model="password" autocomplete="new-password" placeholder="Minimal 8 karakter" class="w-full rounded-xl border border-slate-200 bg-slate-50/60 px-4 py-3 text-sm font-medium text-slate-800 placeholder:text-slate-400 focus:border-blue-400 focus:bg-white focus:outline-none focus:ring-0">
                        @error('password') <p class="mt-1 text-[11px] font-semibold text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="register-password-confirmation" class="mb-1.5 block text-xs font-bold text-slate-700">Ulangi Password</label>
                        <input id="register-password-confirmation" type="password" wire:model="password_confirmation" autocomplete="new-password" placeholder="Ketik ulang password" class="w-full rounded-xl border border-slate-200 bg-slate-50/60 px-4 py-3 text-sm font-medium text-slate-800 placeholder:text-slate-400 focus:border-blue-400 focus:bg-white focus:outline-none focus:ring-0">
                    </div>
                </div>

                <button type="submit" wire:loading.attr="disabled" wire:target="register" class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-blue-600 px-5 py-3 text-sm font-bold text-white shadow-lg shadow-blue-600/20 transition hover:bg-blue-700 disabled:cursor-wait disabled:opacity-70">
                    <span wire:loading.remove wire:target="register">Buat Akun</span>
                    <span wire:loading wire:target="register" class="inline-flex items-center gap-2">
                        <svg class="h-4 w-4 animate-spin" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="9" stroke="currentColor" stroke-opacity=".25" stroke-width="3"/><path d="M21 12a9 9 0 0 0-9-9" stroke="currentColor" stroke-width="3" stroke-linecap="round"/></svg>
                        Memproses...
                    </span>
                </button>
            </form>

            <p class="mt-5 text-center text-xs text-slate-500">
                Sudah punya akun? <a href="{{ route('customer.login') }}" class="font-bold text-blue-600 hover:underline">Masuk</a>
            </p>
            <p class="mt-2 text-center text-xs text-slate-500">
                Ingin mendaftarkan laundry? <a href="{{ route('customer.partner.register') }}" class="font-bold text-blue-600 hover:underline">Daftar jadi mitra</a>
            </p>
        </div>
    </div>
</section>
