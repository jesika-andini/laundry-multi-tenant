<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('tenants')) {
            return;
        }

        Schema::table('tenants', function (Blueprint $table): void {
            if (!Schema::hasColumn('tenants', 'name')) {
                $table->string('name')->nullable();
            }

            if (!Schema::hasColumn('tenants', 'owner')) {
                $table->string('owner')->nullable();
            }

            if (!Schema::hasColumn('tenants', 'email')) {
                $table->string('email')->nullable()->unique();
            }

            if (!Schema::hasColumn('tenants', 'phone')) {
                $table->string('phone', 30)->nullable();
            }

            if (!Schema::hasColumn('tenants', 'address')) {
                $table->text('address')->nullable();
            }

            if (!Schema::hasColumn('tenants', 'description')) {
                $table->text('description')->nullable();
            }

            if (!Schema::hasColumn('tenants', 'status')) {
                $table->string('status', 20)->default('Aktif');
            }
        });

        // Migrasikan data dari nama kolom versi awal tanpa menghapus kolom lama.
        if (Schema::hasColumn('tenants', 'nama') && Schema::hasColumn('tenants', 'name')) {
            DB::table('tenants')->whereNull('name')->update(['name' => DB::raw('nama')]);
        }

        if (Schema::hasColumn('tenants', 'alamat') && Schema::hasColumn('tenants', 'address')) {
            DB::table('tenants')->whereNull('address')->update(['address' => DB::raw('alamat')]);
        }

        if (Schema::hasColumn('tenants', 'no_telepon') && Schema::hasColumn('tenants', 'phone')) {
            DB::table('tenants')->whereNull('phone')->update(['phone' => DB::raw('no_telepon')]);
        }

        if (Schema::hasColumn('tenants', 'jenis_laundry') && Schema::hasColumn('tenants', 'description')) {
            DB::table('tenants')->whereNull('description')->update(['description' => DB::raw('jenis_laundry')]);
        }
    }

    public function down(): void
    {
        if (!Schema::hasTable('tenants')) {
            return;
        }

        $columns = ['name', 'owner', 'email', 'phone', 'address', 'description', 'status'];
        $existing = array_values(array_filter(
            $columns,
            fn (string $column): bool => Schema::hasColumn('tenants', $column),
        ));

        if ($existing !== []) {
            Schema::table('tenants', function (Blueprint $table) use ($existing): void {
                $table->dropColumn($existing);
            });
        }
    }
};
