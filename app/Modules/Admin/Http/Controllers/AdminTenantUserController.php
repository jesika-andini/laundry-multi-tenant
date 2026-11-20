<?php

namespace App\Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use App\Models\User;
use App\Modules\Admin\Http\Requests\StoreTenantAdminRequest;
use App\Modules\Admin\Http\Requests\UpdateTenantAdminRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class AdminTenantUserController extends Controller
{
    /**
     * Menampilkan daftar akun Admin Laundry.
     */
    public function index(): View
    {
        Gate::authorize('viewAny', User::class);

        $users = User::query()
            ->with('tenant')
            ->where('role', 'tenant_admin')
            ->orderBy('name')
            ->paginate(10);

        return view(
            'admin::tenant-admins.index',
            compact('users')
        );
    }

    /**
     * Menampilkan form tambah akun.
     */
    public function create(): View
    {
        Gate::authorize('create', User::class);

        $tenants = Tenant::query()
            ->orderBy('name')
            ->get(['id', 'name', 'status']);

        return view(
            'admin::tenant-admins.create',
            compact('tenants')
        );
    }

    /**
     * Menyimpan akun Admin Laundry baru.
     */
    public function store(
        StoreTenantAdminRequest $request
    ): RedirectResponse {

        $data = $request->validated();

        DB::transaction(function () use ($data) {

            User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'password' => $data['password'],
                'tenant_id' => $data['tenant_id'],
                'role' => 'tenant_admin',
                'status' => 'Aktif',
            ]);

        });

        return redirect()
            ->route('admin.tenant-admins.index')
            ->with('success', 'Akun Admin Laundry berhasil dibuat.');
    }

    /**
     * Menampilkan form edit akun.
     */
    public function edit(User $user): View
    {
        Gate::authorize('view', $user);

        $tenants = Tenant::query()
            ->orderBy('name')
            ->get(['id', 'name', 'status']);

        return view(
            'admin::tenant-admins.edit',
            compact('user', 'tenants')
        );
    }

    /**
     * Memperbarui akun Admin Laundry.
     */
    public function update(
        UpdateTenantAdminRequest $request,
        User $user
    ): RedirectResponse {

        $data = $request->validated();

        // Jika password kosong, gunakan password lama.
        if (empty($data['password'])) {
            unset($data['password']);
        }

        DB::transaction(function () use ($user, $data) {
            $user->update($data);
        });

        return redirect()
            ->route('admin.tenant-admins.index')
            ->with('success', 'Data akun Admin Laundry berhasil diperbarui.');
    }

    /**
     * Mengaktifkan atau menonaktifkan akun.
     */
    public function changeStatus(
        Request $request,
        User $user
    ): RedirectResponse {

        Gate::authorize('update', $user);

        $data = $request->validate([
            'status' => [
                'required',
                Rule::in(['Aktif', 'Nonaktif']),
            ],
        ]);

        DB::transaction(function () use ($user, $data) {
            $user->update([
                'status' => $data['status'],
            ]);
        });

        $message = $data['status'] === 'Aktif'
            ? 'Akun Admin Laundry berhasil diaktifkan.'
            : 'Akun Admin Laundry berhasil dinonaktifkan.';

        return redirect()
            ->route('admin.tenant-admins.index')
            ->with('success', $message);
    }
}
