<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

/**
 * Model Tenant tunggal yang dipakai bersama oleh halaman web, modul Admin,
 * API, dan relasi data aplikasi.
 */
class Tenant extends Model
{
    protected $table = 'tenants';

    protected $fillable = [
        // Kolom utama yang dipakai aplikasi.
        'name',
        'owner',
        'email',
        'phone',
        'address',
        'description',
        'status',

        // Kolom lama dipertahankan agar kompatibel dengan database versi awal.
        'nama',
        'alamat',
        'no_telepon',
        'jenis_laundry',
    ];

    protected static function booted(): void
    {
        // Database awal LaundryMap memiliki empat kolom lama yang wajib diisi.
        // Nilainya diselaraskan otomatis dari field baru ketika data dibuat/diubah.
        static::saving(function (Tenant $tenant): void {
            // Jaga kompatibilitas dengan tabel lama tanpa mengasumsikan kolom
            // legacy masih ada pada database yang pernah disesuaikan manual.
            $columns = Schema::getColumnListing($tenant->getTable());

            if (in_array('nama', $columns, true)) {
                $tenant->nama = $tenant->name ?: ($tenant->nama ?: 'Laundry');
            }

            if (in_array('alamat', $columns, true)) {
                $tenant->alamat = Str::limit($tenant->address ?: ($tenant->alamat ?: '-'), 250, '');
            }

            if (in_array('no_telepon', $columns, true)) {
                $tenant->no_telepon = $tenant->phone ?: ($tenant->no_telepon ?: '-');
            }

            if (in_array('jenis_laundry', $columns, true)) {
                $tenant->jenis_laundry = Str::limit(
                    $tenant->description ?: ($tenant->jenis_laundry ?: 'Umum'),
                    250,
                    '',
                );
            }

            $tenant->status = $tenant->status ?: 'Pending';
        });
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function services(): HasMany
    {
        return $this->hasMany(Service::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function complaints(): HasMany
    {
        return $this->hasMany(Complaint::class);
    }
}
