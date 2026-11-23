<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\OrderStatusHistory;
use App\Models\Payment;
use App\Models\Service;
use App\Models\Tenant;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.customer')]
#[Title('Buat Pesanan & Checkout — LaundryHub')]
class Checkout extends Component
{
    public int $tenantId;

    public int $serviceId = 0;

    public float $weight = 2.0;

    public string $deliveryMethod = 'pickup';

    public string $address = '';

    public string $pickupDate = '';

    public string $pickupTime = '14:00';

    public string $courier = 'internal';

    public string $notes = '';

    public string $paymentMethod = 'qris';

    public string $voucherCode = 'HEMATBERSIH';

    public string $appliedVoucher = 'HEMATBERSIH';

    public string $draftCode = '';

    public bool $placed = false;

    public string $orderCode = '';

    public int $orderId = 0;

    public float $placedTotal = 0.0;

    public function mount(Tenant $tenant): void
    {
        abort_unless($tenant->status === 'Aktif', 404);

        $this->tenantId = $tenant->id;

        $services = $this->services();

        abort_if($services->isEmpty(), 404, 'Layanan belum tersedia untuk mitra ini.');

        $requestedService = (int) request()->integer('service');
        $service = $services->firstWhere('id', $requestedService) ?? $services->first();

        $this->serviceId = $service->id;
        $this->weight = max($this->weight, $this->minimumWeight());
        $this->pickupDate = now()->toDateString();

        $this->draftCode = 'TRX-'.str_pad(
            (string) (Order::query()->withoutGlobalScope('tenant')->count() + 1),
            3,
            '0',
            STR_PAD_LEFT,
        );
    }

    public function updatedServiceId(): void
    {
        $this->weight = max($this->weight, $this->minimumWeight());
    }

    public function incrementWeight(): void
    {
        $this->weight = min(200, $this->weight + 1);
    }

    public function decrementWeight(): void
    {
        $this->weight = max($this->minimumWeight(), $this->weight - 1);
    }

    public function applyVoucher(): void
    {
        $code = Str::upper(trim($this->voucherCode));

        if ($code !== 'HEMATBERSIH') {
            $this->appliedVoucher = '';
            $this->addError('voucherCode', 'Kode voucher tidak valid. Gunakan HEMATBERSIH.');

            return;
        }

        $this->voucherCode = $code;
        $this->appliedVoucher = $code;
        $this->resetValidation('voucherCode');
    }

    public function removeVoucher(): void
    {
        $this->appliedVoucher = '';
        $this->voucherCode = '';
        $this->resetValidation('voucherCode');
    }

    public function placeOrder()
    {
        if (! Auth::check()) {
            return $this->redirect(route('customer.login'), navigate: true);
        }

        $service = $this->services()->firstWhere('id', $this->serviceId);

        if (! $service) {
            $this->addError('serviceId', 'Layanan yang dipilih tidak tersedia.');

            return null;
        }

        $minimum = $this->minimumWeightFor($service->unit);

        $rules = [
            'serviceId' => [
                'required',
                Rule::exists('services', 'id')->where(
                    fn ($query) => $query->where('tenant_id', $this->tenantId)->where('status', 'Aktif'),
                ),
            ],
            'weight' => ['required', 'numeric', 'min:'.$minimum, 'max:200'],
            'deliveryMethod' => ['required', Rule::in(['pickup', 'dropoff'])],
            'paymentMethod' => ['required', Rule::in(array_keys($this->paymentOptions()))],
            'notes' => ['nullable', 'string', 'max:500'],
            'voucherCode' => ['nullable', 'string', 'max:50'],
        ];

        if ($this->deliveryMethod === 'pickup') {
            $rules['address'] = ['required', 'string', 'min:10', 'max:500'];
            $rules['pickupDate'] = ['required', 'date', 'after_or_equal:today'];
            $rules['pickupTime'] = ['required', Rule::in(array_keys($this->timeSlots()))];
            $rules['courier'] = ['required', Rule::in(array_keys($this->courierOptions()))];
        }

        $this->validate($rules, [
            'weight.min' => 'Berat minimal '.$minimum.' '.$this->unitLabel($service->unit).'.',
            'weight.max' => 'Berat maksimal 200 kg/item per pesanan.',
            'address.required' => 'Alamat penjemputan wajib diisi.',
            'address.min' => 'Alamat terlalu singkat, mohon lengkapi.',
            'pickupDate.required' => 'Tanggal penjemputan wajib dipilih.',
            'pickupDate.after_or_equal' => 'Tanggal penjemputan tidak boleh di masa lalu.',
            'pickupTime.required' => 'Slot waktu penjemputan wajib dipilih.',
            'courier.required' => 'Pilih kurir yang akan menjemput.',
            'paymentMethod.required' => 'Pilih metode pembayaran.',
        ], [
            'serviceId' => 'layanan',
            'deliveryMethod' => 'metode penyerahan',
            'pickupDate' => 'tanggal penjemputan',
            'pickupTime' => 'waktu penjemputan',
            'paymentMethod' => 'metode pembayaran',
        ]);

        $subtotal = round((float) $service->price * $this->weight, 2);
        $deliveryFee = $this->deliveryFee();
        $discount = $this->discount();
        $platformFee = $this->platformFee();
        $total = max(0, round($subtotal + $deliveryFee - $discount + $platformFee, 2));

        $pickupAt = $this->deliveryMethod === 'pickup'
            ? Carbon::parse($this->pickupDate.' '.$this->pickupTime)
            : null;

        $orderCode = $this->generateOrderCode();

        try {
            DB::transaction(function () use ($service, $total, $deliveryFee, $discount, $platformFee, $pickupAt, $orderCode): void {
                $order = Order::create([
                    'tenant_id' => $this->tenantId,                    'customer_id' => Auth::id(),
                    'service_id' => $service->id,
                    'order_code' => $orderCode,
                    'weight' => $this->weight,
                    'total_price' => $total,
                    'status' => 'Menunggu Pembayaran',
                    'customer_note' => $this->notes !== '' ? $this->notes : null,
                    'payment_method' => $this->paymentLabel($this->paymentMethod),
                    'payment_status' => 'Menunggu Pembayaran',
                    'pickup_type' => $this->deliveryMethod,
                    'address' => $this->deliveryMethod === 'pickup' ? $this->address : null,
                    'pickup_at' => $pickupAt,
                    'courier' => $this->deliveryMethod === 'pickup' ? $this->courierOptions()[$this->courier] : null,
                    'delivery_fee' => $deliveryFee,
                    'discount' => $discount,
                    'platform_fee' => $platformFee,
                    'voucher_code' => $this->appliedVoucher !== '' ? $this->appliedVoucher : null,
                ]);

                $this->orderId = $order->id;

                Payment::create([
                    'order_id' => $order->id,
                    'payment_method' => $this->paymentLabel($this->paymentMethod),
                    'amount' => $total,
                    'status' => 'Menunggu Pembayaran',
                ]);

                OrderStatusHistory::create([
                    'order_id' => $order->id,
                    'status' => 'Menunggu Pembayaran',
                    'note' => 'Pesanan dibuat melalui checkout pelanggan.',
                    'changed_by' => Auth::id(),
                ]);
            });
        } catch (\Throwable $exception) {
            report($exception);

            $this->addError('checkout', 'Pesanan gagal dibuat. Silakan coba lagi.');

            return null;
        }

        $this->orderCode = $orderCode;
        $this->placedTotal = $total;
        $this->placed = true;

        $this->dispatch('order-placed', code: $orderCode);

        return null;
    }

    public function services(): Collection
    {
        return Service::query()
            ->withoutGlobalScope('tenant')
            ->where('tenant_id', $this->tenantId)
            ->where('status', 'Aktif')
            ->orderBy('price')
            ->get();
    }

    public function selectedService(): ?Service
    {
        return $this->services()->firstWhere('id', $this->serviceId);
    }

    public function subtotal(): float
    {
        $service = $this->selectedService();

        return $service ? round((float) $service->price * $this->weight, 2) : 0.0;
    }

    public function deliveryFee(): float
    {
        return $this->deliveryMethod === 'pickup' ? 5000.0 : 0.0;
    }

    public function discount(): float
    {
        return $this->appliedVoucher === 'HEMATBERSIH' ? 5000.0 : 0.0;
    }

    public function platformFee(): float
    {
        return 1000.0;
    }

    public function total(): float
    {
        return max(0, round($this->subtotal() + $this->deliveryFee() - $this->discount() + $this->platformFee(), 2));
    }

    public function minimumWeight(): float
    {
        $service = $this->selectedService();

        return $service ? $this->minimumWeightFor($service->unit) : 1.0;
    }

    /**
     * @return array<string, string>
     */
    public function timeSlots(): array
    {
        return [
            '08:00' => '08.00 - 10.00 WIB',
            '10:00' => '10.00 - 12.00 WIB',
            '14:00' => '14.00 - 16.00 WIB',
            '16:00' => '16.00 - 18.00 WIB',
        ];
    }

    /**
     * @return array<string, string>
     */
    public function courierOptions(): array
    {
        $tenant = $this->tenant();

        return [
            'internal' => 'Armada Internal '.($tenant?->name ?? 'Laundry'),
            'mitra' => 'Kurir Mitra LaundryHub',
        ];
    }

    /**
     * @return array<string, string>
     */
    public function paymentOptions(): array
    {
        return [
            'qris' => 'QRIS',
            'va' => 'Virtual Account Bank',
            'ewallet' => 'Dompet Digital',
            'cod' => 'Bayar Tunai (COD)',
        ];
    }

    public function paymentLabel(string $method): string
    {
        return $this->paymentOptions()[$method] ?? 'QRIS';
    }

    public function tenant(): ?Tenant
    {
        return Tenant::query()->find($this->tenantId);
    }

    public function render()
    {
        $tenant = $this->tenant();

        abort_unless($tenant && $tenant->status === 'Aktif', 404);

        return view('livewire.checkout', [
            'tenant' => $tenant,
            'services' => $this->services(),
            'selectedService' => $this->selectedService(),
        ]);
    }

    protected function minimumWeightFor(string $unit): float
    {
        return strtolower($unit) === 'kg' ? 2.0 : 1.0;
    }

    protected function unitLabel(string $unit): string
    {
        return strtolower($unit) === 'kg' ? 'kg' : 'item';
    }

    protected function generateOrderCode(): string
    {
        do {
            $code = 'TRX-'.now()->format('ymd').'-'.Str::upper(Str::random(4));
        } while (Order::query()->withoutGlobalScope('tenant')->where('order_code', $code)->exists());

        return $code;
    }
}
