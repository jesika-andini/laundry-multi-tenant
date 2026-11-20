<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Admin' }} - LaundryMap</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-slate-100 text-slate-800">
    <header class="bg-slate-900 text-white shadow">
        <nav class="mx-auto flex max-w-7xl flex-wrap items-center justify-between gap-4 px-5 py-4">
            <a href="{{ route('admin.dashboard') }}" class="text-xl font-bold">LaundryMap <span class="font-normal text-teal-300">Admin</span></a>
            <div class="flex flex-wrap items-center gap-4 text-sm">
                <a href="{{ route('customer.home') }}" class="hover:text-teal-200">Lihat website</a>
                <a href="{{ route('admin.dashboard') }}" class="hover:text-teal-200">Dashboard</a>
                <a href="{{ route('admin.tenants.index') }}" class="hover:text-teal-200">Data Tenant</a>
                <span class="hidden text-slate-300 sm:inline">{{ auth()->user()->name }}</span>
                <form method="POST" action="{{ route('customer.logout') }}">
                    @csrf
                    <button type="submit" class="rounded-lg bg-white/10 px-3 py-2 hover:bg-white/20">Keluar</button>
                </form>
            </div>
        </nav>
    </header>

    <main class="mx-auto max-w-7xl px-5 py-8">
        @if (session('success'))
            <div class="mb-5 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-green-800">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-5 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-red-800">
                <p class="font-semibold">Periksa kembali data yang dimasukkan:</p>
                <ul class="mt-2 list-inside list-disc text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{ $slot }}
    </main>
</body>
</html>
