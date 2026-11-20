<?php

namespace App\Modules\Admin\Services;

use App\Models\Tenant;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;

final class ChangeTenantStatus
{
    /**
     * Status yang diperbolehkan melalui fitur aktivasi.
     */
    public const ALLOWED = [
        'Aktif',
        'Nonaktif',
    ];

    /**
     * Mengubah status tenant.
     */
    public function handle(Tenant $tenant, string $status): Tenant
    {
        if (!in_array($status, self::ALLOWED, true)) {
            throw new InvalidArgumentException(
                'Status tenant tidak valid.'
            );
        }

        return DB::transaction(function () use ($tenant, $status) {

            $lockedTenant = Tenant::query()
                ->lockForUpdate()
                ->findOrFail($tenant->id);

            if ($lockedTenant->status !== $status) {
                $lockedTenant->update([
                    'status' => $status,
                ]);
            }

            return $lockedTenant;
        });
    }
}