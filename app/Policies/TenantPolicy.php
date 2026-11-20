<?php

namespace App\Policies;

use App\Models\Tenant;
use App\Models\User;

class TenantPolicy
{
    /**
     * Memastikan pengguna adalah Super Admin.
     */
    private function isSuperAdmin(User $user): bool
    {
        return in_array(
            $user->role,
            ['admin', 'super_admin'],
            true
        );
    }

    /**
     * Melihat daftar seluruh tenant.
     */
    public function viewAny(User $user): bool
    {
        return $this->isSuperAdmin($user);
    }

    /**
     * Melihat detail tenant.
     */
    public function view(User $user, Tenant $tenant): bool
    {
        return $this->isSuperAdmin($user);
    }

    /**
     * Menambahkan tenant baru.
     */
    public function create(User $user): bool
    {
        return $this->isSuperAdmin($user);
    }

    /**
     * Mengubah data tenant.
     */
    public function update(User $user, Tenant $tenant): bool
    {
        return $this->isSuperAdmin($user);
    }

    /**
     * Tenant tidak dihapus secara permanen.
     */
    public function delete(User $user, Tenant $tenant): bool
    {
        return false;
    }

    public function restore(User $user, Tenant $tenant): bool
    {
        return false;
    }

    public function forceDelete(User $user, Tenant $tenant): bool
    {
        return false;
    }
}