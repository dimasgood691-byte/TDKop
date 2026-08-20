<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->index(['status', 'order_date'], 'orders_sales_report_index');
        });

        Schema::table('order_details', function (Blueprint $table) {
            $table->index(['product_id', 'size_id'], 'order_details_sales_report_index');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropIndex('orders_sales_report_index');
        });

        Schema::table('order_details', function (Blueprint $table) {
            $table->dropIndex('order_details_sales_report_index');
        });
    }
};