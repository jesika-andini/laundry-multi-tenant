<?php

namespace App\Livewire;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.customer')]
#[Title('Lacak Pesanan — LaundryHub')]
class OrderTracking extends Component
{
    public int $orderId;

    public bool $showDetail = false;

    public function mount(int $order): void
    {
        $this->orderId = $order;

        $this->findOrder();
    }

    public function toggleDetail(): void
    {
        $this->showDetail = ! $this->showDetail;
    }

    public function render()
    {
        $order = $this->findOrder();
        $timeline = $this->timeline($order);
        $payment = $order->payments()->withoutGlobalScope('tenant')->latest('id')->first();

        return view('livewire.order-tracking', [
            'order' => $order,
            'steps' => $timeline['steps'],
            'currentStep' => $timeline['currentStep'],
            'progress' => $timeline['progress'],
            'estimatedReady' => $this->estimatedReady($order),
            'paymentMethod' => $payment?->payment_method ?: ($order->payment_method ?: 'Belum dipilih'),
            'paymentStatus' => $payment?->status ?: ($order->payment_status ?: 'Menunggu Pembayaran'),
            'whatsappUrl' => $this->whatsappUrl($order),
            'courierLabel' => $order->courier ?: 'Armada Internal '.($order->tenant?->name ?? 'Mitra'),
            'courierPhone' => $order->tenant?->phone ?: '-',
            'pickupLabel' => match ($order->pickup_type) {
                'pickup' => 'Antar-jemput mitra',
                'dropoff' => 'Antar sendiri ke outlet',
                default => 'Penyerahan belum diatur',
            },
            'weightLabel' => rtrim(rtrim(number_format((float) $order->weight, 2, ',', '.'), '0'), ','),
            'totalLabel' => number_format((float) ($order->total_price ?? $order->total ?? 0), 0, ',', '.'),
        ]);
    }

    public function statusLabel(string $status): string
    {
        return match ($status) {
            'Pesanan Dibuat' => 'Pesanan Dibuat',
            'Menunggu Pembayaran' => 'Menunggu Pembayaran',
            'Menunggu Konfirmasi' => 'Konfirmasi Mitra',
            'Diterima' => 'Diterima & Ditimbang',
            'Dicuci' => 'Dicuci (Sedang Diproses Mesin)',
            'Dikeringkan' => 'Pengeringan Drum Panas',
            'Disetrika' => 'Disetrika Uap',
            'Siap Diambil' => 'Siap Diantar Kurir',
            'Selesai' => 'Selesai',
            default => $status,
        };
    }

    public function statusClasses(string $status): string
    {
        return match ($status) {
            'Selesai' => 'bg-emerald-100 text-emerald-700 ring-emerald-200',
            'Dicuci', 'Dikeringkan', 'Disetrika', 'Siap Diambil' => 'bg-blue-100 text-blue-700 ring-blue-200',
            'Diterima', 'Menunggu Konfirmasi' => 'bg-indigo-100 text-indigo-700 ring-indigo-200',
            default => 'bg-amber-100 text-amber-700 ring-amber-200',
        };
    }

    public function paymentClasses(string $status): string
    {
        return match (strtolower($status)) {
            'lunas', 'paid', 'settlement', 'success' => 'bg-emerald-100 text-emerald-700',
            'gagal', 'failed', 'expired', 'cancelled' => 'bg-rose-100 text-rose-700',
            default => 'bg-amber-100 text-amber-700',
        };
    }

    private function findOrder(): Order
    {
        return Order::query()
            ->withoutGlobalScope('tenant')
            ->where('customer_id', Auth::id())
            ->with([
                'tenant',
                'service' => fn ($query) => $query->withoutGlobalScope('tenant'),
            ])
            ->findOrFail($this->orderId);
    }

    private function timeline(Order $order): array
    {
        $definitions = [
            1 => ['title' => 'Sedang Diproses', 'description' => 'Cucian sedang diproses oleh mitra: dicuci, dikeringkan, lalu disetrika.'],
            2 => ['title' => 'Siap Diambil', 'description' => 'Cucian sudah rapi dan dikemas. Silakan ambil di outlet atau tunggu kurir mitra.'],
        ];

        $statusPerStep = [
            1 => ['Pesanan Dibuat', 'Menunggu Pembayaran', 'Menunggu Konfirmasi', 'Diterima', 'Dicuci', 'Dikeringkan', 'Disetrika'],
            2 => ['Siap Diambil', 'Selesai'],
        ];

        $currentStep = in_array($order->status, ['Siap Diambil', 'Selesai'], true) ? 2 : 1;
        $finished = $order->status === 'Selesai';
        $histories = $order->statusHistories()
            ->withoutGlobalScope('tenant')
            ->orderBy('created_at')
            ->get();
        $historyByStatus = $histories->keyBy('status');

        $steps = [];

        foreach ($definitions as $number => $definition) {
            $state = $finished || $number < $currentStep
                ? 'done'
                : ($number === $currentStep ? 'active' : 'pending');

            $history = collect($statusPerStep[$number])
                ->map(fn ($status) => $historyByStatus->get($status))
                ->filter()
                ->sortByDesc(fn ($entry) => $entry->created_at)
                ->first();

            if ($history) {
                $time = $history->created_at?->locale('id')->translatedFormat('d M Y, H:i').' WIB';
            } elseif ($number === 1 && $order->created_at) {
                $time = $order->created_at->locale('id')->translatedFormat('d M Y, H:i').' WIB';
            } elseif ($state === 'done') {
                $time = 'Selesai';
            } elseif ($state === 'active' && $number === 2) {
                $time = $order->updated_at
                    ? 'Diperbarui '.$order->updated_at->locale('id')->translatedFormat('d M Y, H:i').' WIB'
                    : 'Siap diambil';
            } elseif ($state === 'active') {
                $time = 'Sedang berjalan';
            } else {
                $time = 'Menunggu proses selesai';
            }

            $steps[] = [
                'number' => $number,
                'title' => $definition['title'],
                'description' => $definition['description'],
                'state' => $state,
                'time' => $time,
            ];
        }

        $progress = $currentStep === 2 ? 100 : 50;

        return compact('steps', 'currentStep', 'progress');
    }

    private function estimatedReady(Order $order): string
    {
        if ($order->status === 'Selesai') {
            return 'Pesanan sudah selesai';
        }

        if (! $order->created_at) {
            return 'Menunggu konfirmasi mitra';
        }

        $days = max(1, (int) ($order->service?->estimated_duration ?? 2));
        $ready = $order->created_at->copy()->addDays($days)->setTime(18, 0);

        if ($ready->isPast()) {
            return 'Menunggu konfirmasi mitra';
        }

        if ($ready->isToday()) {
            return 'Hari ini, 18.00 WIB';
        }

        if ($ready->isTomorrow()) {
            return 'Besok, 18.00 WIB';
        }

        return $ready->locale('id')->translatedFormat('d M Y').', 18.00 WIB';
    }

    private function whatsappUrl(Order $order): string
    {
        $phone = preg_replace('/\D+/', '', (string) $order->tenant?->phone);

        if (str_starts_with($phone, '0')) {
            $phone = '62'.substr($phone, 1);
        }

        if ($phone === '') {
            return route('customer.orders.index');
        }

        $message = 'Halo '.($order->tenant?->name ?? 'Mitra').', saya ingin menanyakan pesanan #'.$order->order_code.'.';

        return 'https://wa.me/'.$phone.'?text='.urlencode($message);
    }
}
