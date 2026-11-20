<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Service;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        $hasTenantsTable = Schema::hasTable('tenants');
        $hasServicesTable = Schema::hasTable('services');

        if ($hasTenantsTable && $hasServicesTable) {
            $tenants = Tenant::query()
                ->where('status', 'Aktif')
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
                ->orderByDesc('active_services_count')
                ->orderBy('name')
                ->get();
        } elseif ($hasTenantsTable) {
            $tenants = Tenant::query()
                ->where('status', 'Aktif')
                ->orderBy('name')
                ->get()
                ->each(function (Tenant $tenant): void {
                    $tenant->setRelation('services', collect());
                    $tenant->setAttribute('active_services_count', 0);
                    $tenant->setAttribute('min_price', null);
                });
        } else {
            $tenants = collect();
        }

        $serviceNames = $hasServicesTable
            ? Service::query()
                ->withoutGlobalScope('tenant')
                ->where('status', 'Aktif')
                ->orderBy('name')
                ->pluck('name')
                ->unique()
                ->values()
            : collect();

        $activeOrderCount = auth()->check() && Schema::hasTable('orders')
            ? Order::query()
                ->withoutGlobalScope('tenant')
                ->where('customer_id', auth()->id())
                ->whereNotIn('status', ['Selesai'])
                ->count()
            : 0;

        $totalCustomers = Schema::hasTable('users') && Schema::hasColumn('users', 'role')
            ? User::query()->where('role', 'customer')->count()
            : 0;

        return view('laundry.home', [
            'tenants' => $tenants,
            'featuredTenant' => $tenants->first(),
            'serviceNames' => $serviceNames,
            'activeOrderCount' => $activeOrderCount,
            'totalTenants' => $tenants->count(),
            'totalServices' => (int) $tenants->sum('active_services_count'),
            'totalCustomers' => $totalCustomers,
        ]);
    }
}
