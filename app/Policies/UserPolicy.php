<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Memeriksa hak akses Super Admin.
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
     * Melihat daftar akun Admin Laundry.
     */
    public function viewAny(User $user): bool
    {
        return $this->isSuperAdmin($user);
    }

    /**
     * Melihat detail akun Admin Laundry.
     */
    public function view(User $user, User $target): bool
    {
        return $this->isSuperAdmin($user)
            && $target->role === 'tenant_admin';
    }

    /**
     * Membuat akun Admin Laundry.
     */
    public function create(User $user): bool
    {
        return $this->isSuperAdmin($user);
    }

    /**
     * Mengubah akun Admin Laundry.
     */
    public function update(User $user, User $target): bool
    {
        return $this->isSuperAdmin($user)
            && $target->role === 'tenant_admin';
    }

    /**
     * Penghapusan akun permanen tidak diperbolehkan.
     */
    public function delete(User $user, User $target): bool
    {
        return false;
    }

    public function restore(User $user, User $target): bool
    {
        return false;
    }

    public function forceDelete(User $user, User $target): bool
    {
        return false;
    }
}
