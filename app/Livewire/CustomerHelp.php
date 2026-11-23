<?php

namespace App\Livewire;

use App\Models\Complaint;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('components.layouts.customer')]
#[Title('Pusat Komplain & Resolusi Pesanan — LaundryMap')]
class CustomerHelp extends Component
{
    use WithFileUploads;

    public const CATEGORY_LABELS = [
        'pakai-ulang' => 'Pakai Ulang/Rusak',
        'paket-tertukar' => 'Paket Tertukar/Hilang',
        'kurang-bersih' => 'Kurang Bersih/Noda',
        'berat-tidak-sesuai' => 'Ketidaksesuaian Berat / Timbangan',
    ];

    public const SOLUTION_LABELS = [
        'cuci-ulang' => 'Cuci Ulang Gratis (Antar-Jemput Ditanggung Mitra)',
        'kompensasi' => 'Kompensasi / Ganti Rugi Kerusakan Tunai',
        'refund' => 'Pengembalian Penuh Dana Escrow (Refund)',
    ];

    public ?int $orderId = null;

    public ?int $selectedComplaintId = null;

    public string $category = 'kurang-bersih';

    public string $expectedSolution = 'cuci-ulang';

    public string $description = '';

    public string $subject = '';

    public string $replyMessage = '';

    public string $successMessage = '';

    public $evidence;

    public function mount(): void
    {
        $user = Auth::user();

        if (! $user || $user->role !== 'customer') {
            return;
        }

        $requestedTicket = request()->integer('ticket');

        if ($requestedTicket > 0) {
            $complaint = Complaint::query()
                ->withoutGlobalScope('tenant')
                ->where('customer_id', $user->id)
                ->find($requestedTicket);

            if ($complaint) {
                $this->selectedComplaintId = $complaint->id;
            }
        }

        $requestedOrder = request()->integer('order');

        if ($requestedOrder > 0) {
            $order = Order::query()
                ->withoutGlobalScope('tenant')
                ->where('customer_id', $user->id)
                ->find($requestedOrder);

            if ($order) {
                $this->orderId = $order->id;
            }
        }

        if (! $this->orderId) {
            $latestOrder = Order::query()
                ->withoutGlobalScope('tenant')
                ->where('customer_id', $user->id)
                ->latest('created_at')
                ->first();

            $this->orderId = $latestOrder?->id;
        }

        if (! $this->selectedComplaintId) {
            $latestComplaint = Complaint::query()
                ->withoutGlobalScope('tenant')
                ->where('customer_id', $user->id)
                ->latest('created_at')
                ->first();

            $this->selectedComplaintId = $latestComplaint?->id;
        }
    }

    public function submitComplaint(): void
    {
        $user = Auth::user();

        if (! $user) {
            $this->redirect(route('customer.login'), navigate: true);

            return;
        }

        abort_unless($user->role === 'customer', 403);

        $this->successMessage = '';

        $this->validate([
            'orderId' => [
                'required',
                'integer',
                Rule::exists('orders', 'id')->where(fn ($query) => $query->where('customer_id', $user->id)),
            ],
            'category' => ['required', Rule::in(array_keys(self::CATEGORY_LABELS))],
            'expectedSolution' => ['required', Rule::in(array_keys(self::SOLUTION_LABELS))],
            'description' => ['required', 'string', 'min:10', 'max:1000'],
            'evidence' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp,mp4,mov', 'max:10240'],
        ], [
            'orderId.required' => 'Pilih pesanan yang ingin dikomplain.',
            'orderId.exists' => 'Pesanan tidak ditemukan pada akunmu.',
            'category.required' => 'Pilih kategori kendala cucian.',
            'expectedSolution.required' => 'Pilih solusi yang kamu harapkan.',
            'description.required' => 'Jelaskan detail kendala cucianmu.',
            'description.min' => 'Detail komplain minimal 10 karakter.',
            'evidence.mimes' => 'Bukti harus berupa foto atau video yang didukung.',
            'evidence.max' => 'Ukuran bukti maksimal 10 MB.',
        ]);

        $order = Order::query()
            ->withoutGlobalScope('tenant')
            ->where('customer_id', $user->id)
            ->findOrFail($this->orderId);

        $details = trim($this->description);
        $details .= "\n\nKategori: ".self::CATEGORY_LABELS[$this->category];
        $details .= "\nSolusi diharapkan: ".self::SOLUTION_LABELS[$this->expectedSolution];

        if ($this->evidence) {
            $path = $this->evidence->store('complaints/evidence', 'public');
            $details .= "\nLampiran: ".Storage::disk('public')->url($path);
        }

        $complaint = Complaint::create([
            'order_id' => $order->id,
            'customer_id' => $user->id,
            'tenant_id' => $order->tenant_id,
            'subject' => trim($this->subject) !== '' ? trim($this->subject) : self::CATEGORY_LABELS[$this->category],
            'description' => $details,
            'status' => 'Menunggu',
        ]);

        $this->selectedComplaintId = $complaint->id;
        $this->reset(['description', 'subject', 'evidence', 'replyMessage']);
        $this->successMessage = 'Komplain berhasil dikirim. Dana escrow ditahan sampai kamu menyatakan puas.';
    }

    public function sendReply(): void
    {
        $complaint = $this->findCustomerComplaint($this->selectedComplaintId);

        if (! $complaint) {
            $this->successMessage = 'Tiket komplain tidak ditemukan.';

            return;
        }

        $this->validate([
            'replyMessage' => ['required', 'string', 'max:1000'],
        ], [
            'replyMessage.required' => 'Tulis balasan terlebih dahulu.',
        ]);

        $stamp = now()->locale('id')->translatedFormat('d M Y, H:i').' WIB';
        $complaint->update([
            'description' => trim($complaint->description)."\n\n[Balasan pelanggan {$stamp}] ".trim($this->replyMessage),
            'status' => 'Menunggu',
        ]);

        $this->reset('replyMessage');
        $this->successMessage = 'Balasanmu terkirim ke admin tenant.';
    }

    public function acceptSolution(): void
    {
        $complaint = $this->findCustomerComplaint($this->selectedComplaintId);

        if (! $complaint) {
            $this->successMessage = 'Tiket komplain tidak ditemukan.';

            return;
        }

        if (blank($complaint->response)) {
            $this->successMessage = 'Mitra belum mengirim solusi untuk tiket ini.';

            return;
        }

        $complaint->update(['status' => 'Selesai']);
        $this->successMessage = 'Solusi diterima. Tiket komplain ditutup dan escrow diteruskan ke mitra.';
    }

    public function closeTicket(): void
    {
        $complaint = $this->findCustomerComplaint($this->selectedComplaintId);

        if (! $complaint) {
            $this->successMessage = 'Tiket komplain tidak ditemukan.';

            return;
        }

        $complaint->update(['status' => 'Ditutup']);
        $this->successMessage = 'Tiket komplain ditutup. Kamu masih dapat membuat tiket baru bila diperlukan.';
    }

    public function escalateComplaint(): void
    {
        $complaint = $this->findCustomerComplaint($this->selectedComplaintId);

        if (! $complaint) {
            $this->successMessage = 'Tiket komplain tidak ditemukan.';

            return;
        }

        $stamp = now()->locale('id')->translatedFormat('d M Y, H:i').' WIB';
        $complaint->update([
            'description' => trim($complaint->description)."\n\n[Eskalasi pelanggan {$stamp}] Mohon bantuan tim LaundryMap untuk menengahi tiket ini.",
            'status' => 'Diproses',
        ]);

        $this->successMessage = 'Permintaan eskalasi terkirim ke tim LaundryMap.';
    }

    public function render()
    {
        $user = Auth::user();
        $orders = collect();
        $selectedComplaint = null;
        $activeTickets = 0;
        $waitingTickets = 0;
        $resolvedTickets = 0;
        $resolvedTotal = 0.0;

        if ($user && $user->role === 'customer') {
            $orders = Order::query()
                ->withoutGlobalScope('tenant')
                ->where('customer_id', $user->id)
                ->with([
                    'tenant',
                    'service' => fn ($query) => $query->withoutGlobalScope('tenant'),
                ])
                ->latest('created_at')
                ->get();

            $base = Complaint::query()
                ->withoutGlobalScope('tenant')
                ->where('customer_id', $user->id);

            $activeTickets = (clone $base)->whereIn('status', ['Menunggu', 'Diproses'])->count();
            $waitingTickets = (clone $base)->where('status', 'Menunggu')->count();
            $resolvedTickets = (clone $base)->whereIn('status', ['Selesai', 'Ditutup'])->count();

            $resolvedTotal = (float) (clone $base)
                ->whereIn('status', ['Selesai', 'Ditutup'])
                ->with(['order' => fn ($query) => $query->withoutGlobalScope('tenant')])
                ->get()
                ->sum(fn (Complaint $complaint) => (float) ($complaint->order?->total_price ?? 0));

            $selectedComplaint = $this->selectedComplaintId
                ? (clone $base)
                    ->with([
                        'tenant',
                        'order' => fn ($query) => $query->withoutGlobalScope('tenant'),
                    ])
                    ->find($this->selectedComplaintId)
                : null;
        }

        return view('livewire.customer-help', [
            'orders' => $orders,
            'selectedComplaint' => $selectedComplaint,
            'activeTickets' => $activeTickets,
            'waitingTickets' => $waitingTickets,
            'resolvedTickets' => $resolvedTickets,
            'resolvedTotal' => $resolvedTotal,
            'categoryLabels' => self::CATEGORY_LABELS,
            'solutionLabels' => self::SOLUTION_LABELS,
        ]);
    }

    private function findCustomerComplaint(?int $complaintId): ?Complaint
    {
        if ($complaintId === null) {
            return null;
        }

        return Complaint::query()
            ->withoutGlobalScope('tenant')
            ->where('customer_id', Auth::id())
            ->find($complaintId);
    }
}
