<?php

namespace App\Livewire;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.customer')]
#[Title('Pesanan Saya — LaundryHub')]
class CustomerOrders extends Component
{
    use WithPagination;

    #[Url(as: 'status', except: 'semua')]
    public string $filter = 'semua';

    public function setFilter(string $filter): void
    {
        if (in_array($filter, ['semua', 'aktif', 'selesai'], true)) {
            $this->filter = $filter;
            $this->resetPage();
        }
    }

    public function render()
    {
        $base = Order::query()
            ->withoutGlobalScope('tenant')
            ->where('customer_id', Auth::id());

        $orders = (clone $base)
            ->with([
                'tenant',
                'service' => fn ($query) => $query->withoutGlobalScope('tenant'),
            ])
            ->when($this->filter === 'aktif', fn ($query) => $query->where('status', '!=', 'Selesai'))
            ->when($this->filter === 'selesai', fn ($query) => $query->where('status', 'Selesai'))
            ->latest('created_at')
            ->paginate(8);

        return view('livewire.customer-orders', [
            'orders' => $orders,
            'totalOrders' => (clone $base)->count(),
            'activeOrders' => (clone $base)->where('status', '!=', 'Selesai')->count(),
            'completedOrders' => (clone $base)->where('status', 'Selesai')->count(),
        ]);
    }

    public function statusLabel(string $status): string
    {
        return match ($status) {
            'Pesanan Dibuat' => 'Pesanan Dibuat',
            'Menunggu Pembayaran' => 'Menunggu Pembayaran',
            'Menunggu Konfirmasi' => 'Konfirmasi Mitra',
            'Diterima' => 'Diterima Outlet',
            'Dicuci' => 'Sedang Dicuci',
            'Dikeringkan' => 'Pengeringan',
            'Disetrika' => 'Disetrika',
            'Siap Diambil' => 'Siap Diantar',
            'Selesai' => 'Selesai',
            default => $status,
        };
    }

    public function statusClasses(string $status): string
    {
        return match ($status) {
            'Selesai' => 'bg-emerald-100 text-emerald-700',
            'Dicuci', 'Dikeringkan', 'Disetrika', 'Siap Diambil' => 'bg-blue-100 text-blue-700',
            'Diterima', 'Menunggu Konfirmasi' => 'bg-indigo-100 text-indigo-700',
            default => 'bg-amber-100 text-amber-700',
        };
    }

    public function stepForStatus(string $status): int
    {
        return in_array($status, ['Siap Diambil', 'Selesai'], true) ? 2 : 1;
    }

    public function progressForStatus(string $status): int
    {
        return $this->stepForStatus($status) === 2 ? 100 : 50;
    }
}
