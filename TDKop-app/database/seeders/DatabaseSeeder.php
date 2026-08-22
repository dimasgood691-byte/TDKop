<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Size;
use App\Models\Product;
use App\Models\ProductStock;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Seed Users (Siswa & Admin/Guru)
        $admin = User::create([
            'name'     => 'Guru Pembina Koperasi',
            'username' => 'guru pembina koperasi',
            'email'    => 'smkn8jakarta.sch.id',
            'password' => Hash::make('tradeviskoperasi1965'),
            'role'     => 'admin',
        ]);

        // 2. Seed Categories
        $catSeragam   = Category::create(['name' => 'Seragam Sekolah', 'slug' => 'seragam-sekolah']);
        $catAtribut   = Category::create(['name' => 'Atribut & Badge', 'slug' => 'atribut-badge']);
        $catPerlengkapan = Category::create(['name' => 'Perlengkapan Belajar', 'slug' => 'perlengkapan-belajar']);

        // 3. Seed Sizes
        $sizes = [
            'laki-laki' => ['S', 'M', 'L', 'XL', 'XXL'],
            'perempuan' => ['S', 'M', 'L', 'XL', 'XXL'],
            'umum' => ['Standard'],
        ];
        $sizeModels = [];
        foreach ($sizes as $gender => $genderSizes) {
            foreach ($genderSizes as $sizeName) {
                $sizeModels["{$gender}-{$sizeName}"] = Size::create([
                    'name' => $sizeName,
                    'gender' => $gender,
                ]);
            }
        }

        // 4. Seed Products & Stock Examples
        $p1 = Product::create([
            'category_id' => $catSeragam->id,
            'name'        => 'Seragam Batik SMK 8',
            'slug'        => Str::slug('Seragam Batik SMK 8'),
            'description' => 'Batik resmi identitas siswa SMK 8, bahan katun prima adem dan nyaman digunakan seharian.',
            'price'       => 150000,
            'is_active'   => true,
        ]);

        ProductStock::create(['product_id' => $p1->id, 'size_id' => $sizeModels['laki-laki-S']->id, 'stock' => 12]);
        ProductStock::create(['product_id' => $p1->id, 'size_id' => $sizeModels['laki-laki-M']->id, 'stock' => 4]);
        ProductStock::create(['product_id' => $p1->id, 'size_id' => $sizeModels['laki-laki-L']->id, 'stock' => 15]);
        ProductStock::create(['product_id' => $p1->id, 'size_id' => $sizeModels['laki-laki-XL']->id, 'stock' => 10]);
        ProductStock::create(['product_id' => $p1->id, 'size_id' => $sizeModels['laki-laki-XXL']->id, 'stock' => 7]);
        ProductStock::create(['product_id' => $p1->id, 'size_id' => $sizeModels['perempuan-S']->id, 'stock' => 10]);
        ProductStock::create(['product_id' => $p1->id, 'size_id' => $sizeModels['perempuan-M']->id, 'stock' => 8]);
        ProductStock::create(['product_id' => $p1->id, 'size_id' => $sizeModels['perempuan-L']->id, 'stock' => 15]);
        ProductStock::create(['product_id' => $p1->id, 'size_id' => $sizeModels['perempuan-XL']->id, 'stock' => 10]);
        ProductStock::create(['product_id' => $p1->id, 'size_id' => $sizeModels['perempuan-XXL']->id, 'stock' => 7]);
    }
}
