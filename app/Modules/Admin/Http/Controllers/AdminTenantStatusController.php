<?php

namespace App\Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use App\Modules\Admin\Services\ChangeTenantStatus;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rule;

class AdminTenantStatusController extends Controller
{
    public function __invoke(
        Request $request,
        Tenant $tenant,
        ChangeTenantStatus $service
    ): RedirectResponse {

        // Memeriksa hak akses Super Admin.
        $this->authorize('update', $tenant);

        // Memvalidasi status yang dikirim.
        $data = $request->validate([
            'status' => [
                'required',
                Rule::in(ChangeTenantStatus::ALLOWED),
            ],
        ]);

        // Menjalankan service.
        $service->handle($tenant, $data['status']);

        $pesan = $data['status'] === 'Aktif'
            ? 'Tenant berhasil diaktifkan.'
            : 'Tenant berhasil dinonaktifkan.';

        return redirect()
            ->route('admin.tenants.index')
            ->with('success', $pesan);
    }
}