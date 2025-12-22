<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('transaksi', 'harga_satuan')) {
            Schema::table('transaksi', function (Blueprint $table) {
                $table->decimal('harga_satuan', 12, 2)->default(0)->after('qty');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('transaksi', 'harga_satuan')) {
            Schema::table('transaksi', function (Blueprint $table) {
                $table->dropColumn('harga_satuan');
            });
        }
    }
};
