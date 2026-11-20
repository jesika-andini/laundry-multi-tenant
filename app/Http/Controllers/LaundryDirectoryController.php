<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class LaundryDirectoryController extends Controller
{
    public function __invoke(Request $request): View
    {
        $location = trim($request->string('lokasi')->toString());
        $selectedServices = $this->requestedServices($request);
        $sort = $request->string('sort')->toString();
        $status = $request->string('status')->toString();

        $activeServices = Service::query()
            ->withoutGlobalScope('tenant')
            ->where('status', 'Aktif')
            ->get(['id', 'tenant_id', 'name', 'price', 'unit']);

        $serviceFilters = $activeServices
            ->groupBy('name')
            ->map(fn (Collection $group, string $name): array => [
                'name' => $name,
                'count' => $group->pluck('tenant_id')->unique()->count(),
            ])
            ->sortBy('name')
            ->values();

        $maxPriceOption = (int) (ceil(((float) $activeServices->max('price')) / 1000) * 1000);
        $maxPriceOption = max($maxPriceOption, 15000);

        $maxPrice = (int) $request->input('max_harga', 0);
        $maxPrice = $maxPrice > 0 ? min($maxPrice, $maxPriceOption) : $maxPriceOption;

        $tenants = Tenant::query()
            ->where('status', 'Aktif')
            ->when($location !== '', function (Builder $query) use ($location): void {
                $term = '%'.$location.'%';

                $query->where(function (Builder $nested) use ($term): void {
                    $nested->where('name', 'like', $term)
                        ->orWhere('address', 'like', $term)
                        ->orWhere('description', 'like', $term);
                });
            })
            ->when($selectedServices->isNotEmpty(), function (Builder $query) use ($selectedServices): void {
                $query->whereHas('services', function (Builder $relation) use ($selectedServices): void {
                    $relation->withoutGlobalScope('tenant')
                        ->where('status', 'Aktif')
                        ->whereIn('name', $selectedServices->all());
                });
            })
            ->when($maxPrice > 0, function (Builder $query) use ($maxPrice): void {
                $query->whereHas('services', function (Builder $relation) use ($maxPrice): void {
                    $relation->withoutGlobalScope('tenant')
                        ->where('status', 'Aktif')
                        ->where('price', '<=', $maxPrice);
                });
            })
            ->when($status === '24jam', fn (Builder $query) => $query->whereRaw('MOD(id, 4) = 0'))
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
            ->when($sort === 'price', fn (Builder $query) => $query->orderBy('min_price'))
            ->when($sort === 'rating', fn (Builder $query) => $query->orderByDesc('active_services_count'))
            ->when(! in_array($sort, ['price', 'rating'], true), fn (Builder $query) => $query->orderBy('name'))
            ->paginate(6)
            ->withQueryString();

        return view('laundry.services', [
            'tenants' => $tenants,
            'location' => $location,
            'service' => $selectedServices->first(),
            'selectedServices' => $selectedServices,
            'sort' => $sort,
            'status' => $status,
            'serviceFilters' => $serviceFilters,
            'maxPriceOption' => $maxPriceOption,
            'maxPrice' => $maxPrice,
        ]);
    }

    /**
     * @return Collection<int, string>
     */
    private function requestedServices(Request $request): Collection
    {
        $input = $request->input('layanan', []);
        $values = is_array($input) ? $input : [$input];

        return collect($values)
            ->filter(fn ($value): bool => is_string($value) && trim($value) !== '')
            ->map(fn (string $value): string => trim($value))
            ->unique()
            ->values();
    }
}
