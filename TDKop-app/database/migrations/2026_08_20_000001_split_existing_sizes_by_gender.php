<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $sizeNames = ['S', 'M', 'L', 'XL', 'XXL'];

        DB::transaction(function () use ($sizeNames) {
            $genericSizes = DB::table('sizes')
                ->whereIn('name', $sizeNames)
                ->where('gender', 'umum')
                ->get();

            foreach ($genericSizes as $size) {
                $femaleSizeId = DB::table('sizes')->insertGetId([
                    'name' => $size->name,
                    'gender' => 'perempuan',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                $productIds = DB::table('product_stocks')
                    ->where('size_id', $size->id)
                    ->pluck('product_id');

                foreach ($productIds as $productId) {
                    DB::table('product_stocks')->insert([
                        'product_id' => $productId,
                        'size_id' => $femaleSizeId,
                        'stock' => 0,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }

                DB::table('sizes')
                    ->where('id', $size->id)
                    ->update([
                        'gender' => 'laki-laki',
                        'updated_at' => now(),
                    ]);
            }
        });
    }

    public function down(): void
    {
        DB::transaction(function () {
            $femaleSizeIds = DB::table('sizes')
                ->where('gender', 'perempuan')
                ->whereIn('name', ['S', 'M', 'L', 'XL', 'XXL'])
                ->pluck('id');

            DB::table('product_stocks')->whereIn('size_id', $femaleSizeIds)->delete();
            DB::table('sizes')->whereIn('id', $femaleSizeIds)->delete();

            DB::table('sizes')
                ->where('gender', 'laki-laki')
                ->whereIn('name', ['S', 'M', 'L', 'XL', 'XXL'])
                ->update([
                    'gender' => 'umum',
                    'updated_at' => now(),
                ]);
        });
    }
};
