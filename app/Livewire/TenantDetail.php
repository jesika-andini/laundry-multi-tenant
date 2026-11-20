<?php

namespace App\Livewire;

use App\Models\Service;
use App\Models\Tenant;
use Illuminate\Support\Collection;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.customer')]
#[Title('Detail Laundry — LaundryHub')]
class TenantDetail extends Component
{
    public int $tenantId;

    public int $selectedServiceId = 0;

    public float $weight = 2.0;

    public string $tab = 'tentang';

    public function mount(Tenant $tenant): void
    {
        abort_unless($tenant->status === 'Aktif', 404);

        $this->tenantId = $tenant->id;

        $firstService = $this->services()->first();

        if ($firstService) {
            $this->selectService($firstService->id);
        }
    }

    public function selectService(int $serviceId): void
    {
        $service = $this->services()->firstWhere('id', $serviceId);

        if (! $service) {
            $this->addError('selectedServiceId', 'Layanan tidak tersedia untuk mitra ini.');

            return;
        }

        $this->selectedServiceId = $service->id;
        $this->weight = max($this->weight, $this->minimumWeightFor($service->unit));
        $this->resetValidation('selectedServiceId');
    }

    public function incrementWeight(): void
    {
        $this->weight = min(200, $this->weight + 1);
    }

    public function decrementWeight(): void
    {
        $this->weight = max($this->minimumWeight(), $this->weight - 1);
    }

    public function setTab(string $tab): void
    {
        if (in_array($tab, ['tentang', 'ulasan', 'kebijakan'], true)) {
            $this->tab = $tab;
        }
    }

    public function orderNow()
    {
        $service = $this->selectedService();

        if (! $service) {
            $this->addError('selectedServiceId', 'Pilih layanan terlebih dahulu.');

            return null;
        }

        if ($this->weight < $this->minimumWeightFor($service->unit)) {
            $this->addError('weight', 'Berat minimal '.$this->minimumWeightFor($service->unit).' '.$this->unitLabel($service->unit).'.');

            return null;
        }

        return $this->redirect(route('customer.checkout', [
            'tenant' => $this->tenantId,
            'service' => $service->id,
            'weight' => $this->weight,
        ]), navigate: true);
    }

    public function selectedService(): ?Service
    {
        if ($this->selectedServiceId === 0) {
            return null;
        }

        return $this->services()->firstWhere('id', $this->selectedServiceId);
    }

    public function subtotal(): float
    {
        $service = $this->selectedService();

        return $service ? round((float) $service->price * $this->weight, 2) : 0.0;
    }

    public function minimumWeight(): float
    {
        $service = $this->selectedService();

        return $service ? $this->minimumWeightFor($service->unit) : 1.0;
    }

    public function render()
    {
        $tenant = Tenant::query()->findOrFail($this->tenantId);

        abort_unless($tenant->status === 'Aktif', 404);

        return view('livewire.tenant-detail', [
            'tenant' => $tenant,
            'services' => $this->services(),
            'selectedService' => $this->selectedService(),
        ]);
    }

    /**
     * @return Collection<int, Service>
     */
    protected function services(): Collection
    {
        return Service::query()
            ->withoutGlobalScope('tenant')
            ->where('tenant_id', $this->tenantId)
            ->where('status', 'Aktif')
            ->orderBy('price')
            ->get();
    }

    protected function minimumWeightFor(string $unit): float
    {
        return strtolower($unit) === 'kg' ? 2.0 : 1.0;
    }

    protected function unitLabel(string $unit): string
    {
        return strtolower($unit) === 'kg' ? 'kg' : 'satuan';
    }
}
