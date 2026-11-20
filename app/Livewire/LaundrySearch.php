<?php

namespace App\Livewire;

use App\Models\Service;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.customer')]
#[Title('Cari Laundry — LaundryMap')]
class LaundrySearch extends Component
{
    use WithPagination;

    #[Url(as: 'lokasi', except: '')]
    public string $location = '';

    /**
     * @var array<int, string>
     */
    #[Url(as: 'layanan', except: [])]
    public array $selectedServices = [];

    #[Url(as: 'sort', except: '')]
    public string $sort = '';

    #[Url(as: 'status', except: '')]
    public string $status = '';

    #[Url(as: 'max_harga', except: 0)]
    public int $maxPrice = 0;

    public int $maxPriceOption = 15000;

    public function mount(): void
    {
        $activeServices = Service::query()
            ->withoutGlobalScope('tenant')
            ->where('status', 'Aktif')
            ->get(['price']);

        $this->maxPriceOption = max(
            (int) (ceil(((float) $activeServices->max('price')) / 1000) * 1000),
            15000,
        );

        if ($this->maxPrice <= 0 || $this->maxPrice > $this->maxPriceOption) {
            $this->maxPrice = $this->maxPriceOption;
        }
    }

    public function updated(string $property): void
    {
        if (in_array($property, ['location', 'selectedServices', 'sort', 'status', 'maxPrice'], true)) {
            $this->resetPage();
        }
    }

    public function search(): void
    {
        $this->resetPage();
    }

    public function sortBy(string $sort): void
    {
        $this->sort = $sort;
        $this->resetPage();
    }

    public function removeService(string $service): void
    {
        $this->selectedServices = collect($this->selectedServices)
            ->reject(fn (string $item): bool => $item === $service)
            ->values()
            ->all();

        $this->resetPage();
    }

    public function resetFilters(): void
    {
        $this->location = '';
        $this->selectedServices = [];
        $this->sort = '';
        $this->status = '';
        $this->maxPrice = $this->maxPriceOption;
        $this->resetPage();
    }

    public function render()
    {
        $activeServices = Service::query()
            ->withoutGlobalScope('tenant')
            ->where('status', 'Aktif')
            ->get(['tenant_id', 'name', 'price']);

        $serviceFilters = $activeServices
            ->groupBy('name')
            ->map(fn (Collection $group, string $name): array => [
                'name' => $name,
                'count' => $group->pluck('tenant_id')->unique()->count(),
            ])
            ->sortBy('name')
            ->values();

        $tenants = Tenant::query()
            ->where('status', 'Aktif')
            ->when($this->location !== '', function (Builder $query): void {
                $term = '%'.$this->location.'%';

                $query->where(function (Builder $nested) use ($term): void {
                    $nested->where('name', 'like', $term)
                        ->orWhere('address', 'like', $term)
                        ->orWhere('description', 'like', $term);
                });
            })
            ->when($this->selectedServices !== [], function (Builder $query): void {
                $query->whereHas('services', function (Builder $relation): void {
                    $relation->withoutGlobalScope('tenant')
                        ->where('status', 'Aktif')
                        ->whereIn('name', $this->selectedServices);
                });
            })
            ->when($this->maxPrice < $this->maxPriceOption, function (Builder $query): void {
                $query->whereHas('services', function (Builder $relation): void {
                    $relation->withoutGlobalScope('tenant')
                        ->where('status', 'Aktif')
                        ->where('price', '<=', $this->maxPrice);
                });
            })
            ->when($this->status === '24jam', fn (Builder $query) => $query->whereRaw('MOD(id, 4) = 0'))
            ->with([
                'services' => function (HasMany $query): void {
                    $query->withoutGlobalScope('tenant')
                        ->where('status', 'Aktif')
                        ->orderBy('price')
                        ->select(['id', 'tenant_id', 'name', 'price', 'unit', 'estimated_duration']);
                },
            ])
            ->withCount([
                'services as active_services_count' => function (Builder $query): void {
                    $query->withoutGlobalScope('tenant')->where('status', 'Aktif');
                },
            ])
            ->withMin([
                'services as min_price' => function (Builder $query): void {
                    $query->withoutGlobalScope('tenant')->where('status', 'Aktif');
                },
            ], 'price')
            ->when($this->sort === 'price', fn (Builder $query) => $query->orderBy('min_price'))
            ->when($this->sort === 'rating', fn (Builder $query) => $query->orderByDesc('active_services_count'))
            ->when(! in_array($this->sort, ['price', 'rating'], true), fn (Builder $query) => $query->orderBy('name'))
            ->paginate(6);

        return view('livewire.laundry-search', [
            'tenants' => $tenants,
            'serviceFilters' => $serviceFilters,
            'areaName' => $this->location !== '' ? $this->location : 'Banyuwangi',
        ]);
    }
}
