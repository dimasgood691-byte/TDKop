<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Mengubah status menjadi ENUM dengan pilihan yang lengkap
            $table->enum('status', ['pending', 'processing', 'completed', 'cancelled'])->default('pending')->change();

            // Atau jika ingin lebih fleksibel, ubah menjadi string/varchar(255):
            // $table->string('status', 50)->default('pending')->change();
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('status')->change();
        });
    }
};