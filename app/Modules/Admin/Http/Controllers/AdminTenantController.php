<?php

namespace App\Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use App\Modules\Admin\Http\Requests\StoreTenantRequest;
use App\Modules\Admin\Http\Requests\UpdateTenantRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdminTenantController extends Controller
{
public function index(): View
{
    $this->authorize('viewAny', Tenant::class);

    $tenants = Tenant::query()
        ->orderByDesc('id')
        ->get();

    return view('admin::tenants.index', compact('tenants'));
}
public function create(): View
{
    $this->authorize('create', Tenant::class);

    return view('admin::tenants.create');
}
    public function store(StoreTenantRequest $request): RedirectResponse
    {
        Tenant::create($request->validated());

        return redirect()
            ->route('admin.tenants.index')
            ->with('success', 'Tenant berhasil ditambahkan.');
    }

public function edit(int $id): View
{
    $tenant = Tenant::findOrFail($id);

    $this->authorize('update', $tenant);

    return view('admin::tenants.edit', compact('tenant'));
}
    public function update(UpdateTenantRequest $request, int $id): RedirectResponse
    {
        $tenant = Tenant::findOrFail($id);
        $tenant->update($request->validated());

        return redirect()
            ->route('admin.tenants.index')
            ->with('success', 'Data tenant berhasil diperbarui.');
    }
}
