<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\OrderStatusHistory;
use App\Models\Service;
use App\Models\Tenant;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.tenant')]
#[Title('Dashboard Tenant — LaundryMap')]
class TenantDashboard extends Component
{
    use WithPagination;

    public string $orderFilter = 'semua';

    public ?int $selectedOrderId = null;

    public bool $showOrderModal = false;

    public string $feedback = '';

    public function mount(): void
    {
        $this->tenant();
    }

    public function setOrderFilter(string $filter): void
    {
        if (in_array($filter, ['semua', 'konfirmasi', 'dicuci'], true)) {
            $this->orderFilter = $filter;
            $this->resetPage('ordersPage');
        }
    }

    public function openOrder(int $orderId): void
    {
        $order = $this->findOrder($orderId);

        $this->selectedOrderId = $order->id;
        $this->showOrderModal = true;
        $this->feedback = '';
    }

    public function closeOrder(): void
    {
        $this->showOrderModal = false;
        $this->selectedOrderId = null;
        $this->feedback = '';
    }

    public function acceptOrder(int $orderId): void
    {
        $order = $this->findOrder($orderId);

        if (! in_array($order->status, ['Pesanan Dibuat', 'Menunggu Pembayaran', 'Menunggu Konfirmasi'], true)) {
            $this->feedback = 'Pesanan ini sudah diproses sebelumnya.';

            return;
        }

        $this->applyTransition($order, 'Diterima', 'Pesanan diterima dan dikonfirmasi oleh admin tenant.');
    }

    public function advanceOrder(int $orderId): void
    {
        $order = $this->findOrder($orderId);
        $nextStatus = $this->nextStatusFor($order->status);

        if (! $nextStatus) {
            $this->feedback = 'Status pesanan ini sudah final.';

            return;
        }

        $this->applyTransition($order, $nextStatus, 'Status pesanan diperbarui oleh admin tenant.');
    }

    public function render()
    {
        $tenant = $this->tenant();
        $base = Order::query()
            ->withoutGlobalScope('tenant')
            ->where('tenant_id', $tenant->id);

        $today = now()->toDateString();
        $monthStart = now()->startOfMonth();
        $monthEnd = now()->endOfMonth();
        $previousMonthStart = now()->subMonthNoOverflow()->startOfMonth();
        $previousMonthEnd = now()->subMonthNoOverflow()->endOfMonth();

        $newToday = (clone $base)->whereDate('created_at', $today)->count();
        $pendingConfirmation = (clone $base)->where('status', 'Menunggu Konfirmasi')->count();
        $washing = (clone $base)->where('status', 'Dicuci')->count();
        $processing = (clone $base)
            ->whereIn('status', ['Pesanan Dibuat', 'Menunggu Pembayaran', 'Menunggu Konfirmasi', 'Diterima', 'Dicuci', 'Dikeringkan', 'Disetrika'])
            ->count();
        $readyForPickup = (clone $base)->where('status', 'Siap Diambil')->count();
        $activeQueue = $processing + $readyForPickup;

        $completedThisMonth = (clone $base)
            ->where('status', 'Selesai')
            ->whereBetween('updated_at', [$monthStart, $monthEnd])
            ->count();

        $completedPreviousMonth = (clone $base)
            ->where('status', 'Selesai')
            ->whereBetween('updated_at', [$previousMonthStart, $previousMonthEnd])
            ->count();

        $completedGrowth = $completedPreviousMonth > 0
            ? (int) round((($completedThisMonth - $completedPreviousMonth) / $completedPreviousMonth) * 100)
            : ($completedThisMonth > 0 ? 100 : 0);

        $revenueThisMonth = (float) (clone $base)
            ->where('status', 'Selesai')
            ->whereBetween('updated_at', [$monthStart, $monthEnd])
            ->sum('total_price');

        $serviceRevenue = (float) (clone $base)
            ->whereBetween('created_at', [$monthStart, $monthEnd])
            ->sum('total_price');

        $popularRows = (clone $base)
            ->whereBetween('created_at', [$monthStart, $monthEnd])
            ->selectRaw('service_id, COUNT(*) as orders_count, COALESCE(SUM(total_price), 0) as revenue')
            ->groupBy('service_id')
            ->orderByDesc('revenue')
            ->take(3)
            ->get();

        $serviceNames = Service::query()
            ->withoutGlobalScope('tenant')
            ->whereIn('id', $popularRows->pluck('service_id')->filter())
            ->pluck('name', 'id');

        $popularServices = $popularRows
            ->map(function ($row, int $index) use ($serviceRevenue, $serviceNames): array {
                $percent = $serviceRevenue > 0 ? (float) round(((float) $row->revenue / $serviceRevenue) * 100, 1) : 0.0;

                return [
                    'name' => $serviceNames[$row->service_id] ?? 'Layanan Laundry',
                    'orders' => (int) $row->orders_count,
                    'revenue' => (float) $row->revenue,
                    'percent' => $percent,
                    'color' => ['#2563eb', '#06b6d4', '#8b5cf6'][$index] ?? '#94a3b8',
                ];
            })
            ->all();

        $donutGradient = $this->donutGradient($popularServices);

        $orders = (clone $base)
            ->with([
                'customer',
                'service' => fn ($query) => $query->withoutGlobalScope('tenant'),
            ])
            ->when($this->orderFilter === 'konfirmasi', fn ($query) => $query->where('status', 'Menunggu Konfirmasi'))
            ->when($this->orderFilter === 'dicuci', fn ($query) => $query->where('status', 'Dicuci'))
            ->latest('created_at')
            ->paginate(4, ['*'], 'ordersPage');

        $selectedOrder = $this->selectedOrderId
            ? (clone $base)
                ->with([
                    'customer',
                    'service' => fn ($query) => $query->withoutGlobalScope('tenant'),
                ])
                ->find($this->selectedOrderId)
            : null;

        return view('livewire.tenant-dashboard', [
            'tenant' => $tenant,
            'newToday' => $newToday,
            'pendingConfirmation' => $pendingConfirmation,
            'processing' => $processing,
            'readyForPickup' => $readyForPickup,
            'activeQueue' => $activeQueue,
            'completedThisMonth' => $completedThisMonth,
            'completedGrowth' => $completedGrowth,
            'revenueThisMonth' => $revenueThisMonth,
            'netRevenue' => $revenueThisMonth * 0.95,
            'popularServices' => $popularServices,
            'donutGradient' => $donutGradient,
            'orders' => $orders,
            'allOrdersCount' => (clone $base)->count(),
            'confirmationOrdersCount' => (clone $base)->where('status', 'Menunggu Konfirmasi')->count(),
            'washingOrdersCount' => (clone $base)->where('status', 'Dicuci')->count(),
            'selectedOrder' => $selectedOrder,
        ]);
    }

    public function statusClasses(string $status): string
    {
        return match ($status) {
            'Selesai', 'Siap Diambil' => 'bg-emerald-100 text-emerald-700',
            'Dicuci' => 'bg-blue-100 text-blue-700',
            'Dikeringkan' => 'bg-violet-100 text-violet-700',
            'Disetrika' => 'bg-indigo-100 text-indigo-700',
            'Diterima' => 'bg-cyan-100 text-cyan-700',
            'Pesanan Dibuat', 'Menunggu Pembayaran', 'Menunggu Konfirmasi' => 'bg-amber-100 text-amber-700',
            default => 'bg-slate-100 text-slate-500',
        };
    }

    public function paymentClasses(string $status): string
    {
        return match (strtolower($status)) {
            'lunas', 'paid', 'settlement', 'success' => 'bg-emerald-50 text-emerald-700',
            'gagal', 'failed', 'expired', 'cancelled' => 'bg-rose-50 text-rose-700',
            default => 'bg-amber-50 text-amber-700',
        };
    }

    public function nextStatusFor(string $status): ?string
    {
        return match ($status) {
            'Pesanan Dibuat', 'Menunggu Pembayaran', 'Menunggu Konfirmasi' => 'Diterima',
            'Diterima' => 'Dicuci',
            'Dicuci' => 'Dikeringkan',
            'Dikeringkan' => 'Disetrika',
            'Disetrika' => 'Siap Diambil',
            'Siap Diambil' => 'Selesai',
            default => null,
        };
    }

    public function actionLabel(string $status): string
    {
        return match ($status) {
            'Pesanan Dibuat', 'Menunggu Pembayaran', 'Menunggu Konfirmasi' => 'Terima Pesanan',
            'Diterima' => 'Mulai Cuci',
            'Dicuci', 'Dikeringkan', 'Disetrika' => 'Perbarui Status',
            'Siap Diambil' => 'Selesai',
            default => 'Lihat Rincian',
        };
    }

    private function tenant(): Tenant
    {
        $user = Auth::user();

        abort_unless($user && in_array($user->role, ['tenant', 'tenant_admin'], true), 403);
        abort_unless($user->tenant_id !== null, 403, 'Akun ini belum terhubung ke tenant.');

        $tenant = $user->tenant;

        abort_unless($tenant && $tenant->status === 'Aktif', 403, 'Tenant tidak aktif.');

        return $tenant;
    }

    private function findOrder(int $orderId): Order
    {
        return Order::query()
            ->withoutGlobalScope('tenant')
            ->where('tenant_id', $this->tenant()->id)
            ->findOrFail($orderId);
    }

    private function applyTransition(Order $order, string $nextStatus, string $note): void
    {
        $allowedNext = $this->nextStatusFor($order->status);

        if ($allowedNext !== $nextStatus) {
            $this->feedback = 'Perubahan status tidak valid.';

            return;
        }

        $order->update(['status' => $nextStatus]);

        OrderStatusHistory::create([
            'order_id' => $order->id,
            'status' => $nextStatus,
            'note' => $note,
            'changed_by' => Auth::id(),
        ]);

        $this->selectedOrderId = $order->id;
        $this->feedback = 'Status pesanan berhasil diperbarui menjadi '.$nextStatus.'.';
    }

    /**
     * @param  array<int, array{percent: float, color: string}>  $popularServices
     */
    private function donutGradient(array $popularServices): string
    {
        if ($popularServices === []) {
            return 'conic-gradient(#e2e8f0 0% 100%)';
        }

        $segments = [];
        $cursor = 0.0;

        foreach ($popularServices as $service) {
            $start = $cursor;
            $end = min(100, $cursor + $service['percent']);
            $segments[] = $service['color'].' '.$start.'% '.$end.'%';
            $cursor = $end;
        }

        if ($cursor < 100) {
            $segments[] = '#e2e8f0 '.$cursor.'% 100%';
        }

        return 'conic-gradient('.implode(', ', $segments).')';
    }
}
