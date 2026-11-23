<?php

namespace App\Livewire;

use App\Models\Complaint;
use App\Models\Tenant;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.tenant')]
#[Title('Pengaduan Komplain — LaundryMap')]
class TenantComplaints extends Component
{
    use WithPagination;

    public string $filter = 'semua';

    public ?int $selectedComplaintId = null;

    public bool $showComplaintModal = false;

    public string $response = '';

    public string $status = 'Diproses';

    public string $feedback = '';

    public function mount(): void
    {
        $this->tenant();
    }

    public function setFilter(string $filter): void
    {
        if (in_array($filter, ['semua', 'menunggu', 'diproses', 'selesai'], true)) {
            $this->filter = $filter;
            $this->resetPage('complaintsPage');
        }
    }

    public function openComplaint(int $complaintId): void
    {
        $complaint = $this->findComplaint($complaintId);

        $this->selectedComplaintId = $complaint->id;
        $this->status = $complaint->status;
        $this->response = (string) ($complaint->response ?? '');
        $this->feedback = '';
        $this->showComplaintModal = true;
    }

    public function closeComplaint(): void
    {
        $this->showComplaintModal = false;
        $this->selectedComplaintId = null;
        $this->response = '';
        $this->feedback = '';
    }

    public function saveComplaint(): void
    {
        $this->validate([
            'status' => ['required', 'in:Menunggu,Diproses,Selesai,Ditutup'],
            'response' => ['nullable', 'string', 'max:1000'],
        ]);

        $complaint = $this->findComplaint($this->selectedComplaintId);

        $complaint->update([
            'status' => $this->status,
            'response' => trim($this->response) !== '' ? trim($this->response) : null,
        ]);

        $this->feedback = 'Tanggapan komplain berhasil disimpan.';
    }

    public function render()
    {
        $tenant = $this->tenant();
        $base = Complaint::query()
            ->withoutGlobalScope('tenant')
            ->where('tenant_id', $tenant->id);

        $complaints = (clone $base)
            ->with([
                'customer',
                'order' => fn ($query) => $query->withoutGlobalScope('tenant'),
            ])
            ->when($this->filter === 'menunggu', fn ($query) => $query->where('status', 'Menunggu'))
            ->when($this->filter === 'diproses', fn ($query) => $query->where('status', 'Diproses'))
            ->when($this->filter === 'selesai', fn ($query) => $query->where('status', 'Selesai'))
            ->latest('created_at')
            ->paginate(8, ['*'], 'complaintsPage');

        $selectedComplaint = $this->selectedComplaintId
            ? (clone $base)
                ->with([
                    'customer',
                    'order' => fn ($query) => $query->withoutGlobalScope('tenant'),
                ])
                ->find($this->selectedComplaintId)
            : null;

        return view('livewire.tenant-complaints', [
            'tenant' => $tenant,
            'complaints' => $complaints,
            'selectedComplaint' => $selectedComplaint,
            'totalComplaints' => (clone $base)->count(),
            'waitingComplaints' => (clone $base)->where('status', 'Menunggu')->count(),
            'processingComplaints' => (clone $base)->where('status', 'Diproses')->count(),
            'finishedComplaints' => (clone $base)->where('status', 'Selesai')->count(),
        ]);
    }

    public function statusClasses(string $status): string
    {
        return match ($status) {
            'Diproses' => 'bg-blue-100 text-blue-700',
            'Selesai' => 'bg-emerald-100 text-emerald-700',
            'Ditutup' => 'bg-slate-100 text-slate-500',
            default => 'bg-amber-100 text-amber-700',
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

    private function findComplaint(?int $complaintId): Complaint
    {
        abort_if($complaintId === null, 404);

        return Complaint::query()
            ->withoutGlobalScope('tenant')
            ->where('tenant_id', $this->tenant()->id)
            ->findOrFail($complaintId);
    }
}
