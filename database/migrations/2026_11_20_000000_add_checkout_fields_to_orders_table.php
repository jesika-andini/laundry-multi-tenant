<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('orders')) {
            return;
        }

        Schema::table('orders', function (Blueprint $table): void {
            if (! Schema::hasColumn('orders', 'pickup_type')) {
                $table->string('pickup_type', 30)->nullable();
            }

            if (! Schema::hasColumn('orders', 'address')) {
                $table->text('address')->nullable();
            }

            if (! Schema::hasColumn('orders', 'payment_method')) {
                $table->string('payment_method', 50)->nullable();
            }

            if (! Schema::hasColumn('orders', 'payment_status')) {
                $table->string('payment_status', 30)->nullable()->default('Menunggu Pembayaran');
            }

            if (! Schema::hasColumn('orders', 'pickup_at')) {
                $table->dateTime('pickup_at')->nullable();
            }

            if (! Schema::hasColumn('orders', 'courier')) {
                $table->string('courier', 100)->nullable();
            }

            if (! Schema::hasColumn('orders', 'delivery_fee')) {
                $table->decimal('delivery_fee', 12, 2)->default(0);
            }

            if (! Schema::hasColumn('orders', 'discount')) {
                $table->decimal('discount', 12, 2)->default(0);
            }

            if (! Schema::hasColumn('orders', 'platform_fee')) {
                $table->decimal('platform_fee', 12, 2)->default(0);
            }

            if (! Schema::hasColumn('orders', 'voucher_code')) {
                $table->string('voucher_code', 50)->nullable();
            }
        });
    }

    public function down(): void
    {
        if (! Schema::hasTable('orders')) {
            return;
        }

        Schema::table('orders', function (Blueprint $table): void {
            $columns = ['pickup_type', 'address', 'payment_method', 'payment_status', 'pickup_at', 'courier', 'delivery_fee', 'discount', 'platform_fee', 'voucher_code'];

            $existing = array_values(array_filter(
                $columns,
                fn (string $column): bool => Schema::hasColumn('orders', $column),
            ));

            if ($existing !== []) {
                $table->dropColumn($existing);
            }
        });
    }
};
