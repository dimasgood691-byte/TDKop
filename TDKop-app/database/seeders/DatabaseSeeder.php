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
            'username' => 'admin_tdkop',
            'email'    => 'admin@smk8.sch.id',
            'password' => Hash::make('password123'),
            'role'     => 'admin',
        ]);

        $siswa = User::create([
            'name'     => 'Dimas Febrianto',
            'nis'      => '20268801',
            'class'    => 'XII RPL 1',
            'major'    => 'Rekayasa Perangkat Lunak',
            'username' => 'dimas_rpl',
            'email'    => 'dimas@smk8.sch.id',
            'password' => Hash::make('password123'),
            'role'     => 'siswa',
        ]);

        // 2. Seed Categories
        $catSeragam   = Category::create(['name' => 'Seragam Sekolah', 'slug' => 'seragam-sekolah']);
        $catAtribut   = Category::create(['name' => 'Atribut & Badge', 'slug' => 'atribut-badge']);
        $catPerlengkapan = Category::create(['name' => 'Perlengkapan Belajar', 'slug' => 'perlengkapan-belajar']);

        // 3. Seed Sizes
        $sizes = ['S', 'M', 'L', 'XL', 'XXL', 'Standard'];
        $sizeModels = [];
        foreach ($sizes as $s) {
            $sizeModels[$s] = Size::create(['name' => $s]);
        }

        // 4. Seed Products & Stock Examples
        $p1 = Product::create([
            'category_id' => $catSeragam->id,
            'name'        => 'Seragam Batik SMK 8 Official',
            'slug'        => Str::slug('Seragam Batik SMK 8 Official'),
            'description' => 'Batik resmi identitas siswa SMK 8, bahan katun prima adem dan nyaman digunakan seharian.',
            'price'       => 115000,
            'is_active'   => true,
        ]);

        ProductStock::create(['product_id' => $p1->id, 'size_id' => $sizeModels['S']->id, 'stock' => 12]);
        ProductStock::create(['product_id' => $p1->id, 'size_id' => $sizeModels['M']->id, 'stock' => 4]);  // Stok menipis
        ProductStock::create(['product_id' => $p1->id, 'size_id' => $sizeModels['L']->id, 'stock' => 15]);
        ProductStock::create(['product_id' => $p1->id, 'size_id' => $sizeModels['XL']->id, 'stock' => 0]);  // Stok habis

        $p2 = Product::create([
            'category_id' => $catAtribut->id,
            'name'        => 'Dasi Hitam & Bordir Logo SMK 8',
            'slug'        => Str::slug('Dasi Hitam & Bordir Logo SMK 8'),
            'description' => 'Dasi seragam harian sekolah dengan logo SMK 8 bordir komputer presisi tinggi.',
            'price'       => 25000,
            'is_active'   => true,
        ]);

        ProductStock::create(['product_id' => $p2->id, 'size_id' => $sizeModels['Standard']->id, 'stock' => 3]); // Stok menipis

        $p3 = Product::create([
            'category_id' => $catPerlengkapan->id,
            'name'        => 'Topi Pramuka / Lokasi SMK 8',
            'slug'        => Str::slug('Topi Pramuka / Lokasi SMK 8'),
            'description' => 'Topi sekolah lengkap dengan bordir nama instansi SMK 8.',
            'price'       => 30000,
            'is_active'   => true,
        ]);

        ProductStock::create(['product_id' => $p3->id, 'size_id' => $sizeModels['Standard']->id, 'stock' => 25]);
    }
}