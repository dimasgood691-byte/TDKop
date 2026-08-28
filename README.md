# TDKop-app

**TDKop** (Tradevis Koperasi) adalah aplikasi manajemen koperasi berbasis web yang dirancang untuk mentransformasi sistem operasional koperasi sekolah dari konvensional menjadi platform digital yang efisien dan terintegrasi.

---

## Fitur Utama

- Autentikasi (Login & Register)
- Dashboard interaktif
- Desain responsif
- Operasi CRUD untuk manajemen data

---

## Teknologi yang Digunakan

| Komponen                    | Teknologi                        |
|-----------------------------|----------------------------------|
| **Back-End**                | PHP 8.4+ & Laravel Framework     |
| **Front-End**               | Blade, Tailwind CSS & JavaScript |
| **Database**                | MySQL                            |
| **Development Environment** | XAMPP / Laragon                  |
| **Code Editor**             | Visual Studio Code               |

---

## Persyaratan Sistem

Sebelum menjalankan proyek ini, pastikan perangkat Anda telah menginstal software berikut:

1. **PHP** (v8.4 atau lebih tinggi)
2. **Composer** (PHP Package Manager)
3. **Node.js & NPM** (untuk kompilasi aset front-end)
4. **Laragon** (direkomendasikan) atau XAMPP
5. **Git**

---

## Panduan Instalasi dan Menjalankan Aplikasi

Ikuti langkah-langkah berikut untuk menjalankan proyek di lingkungan lokal:

### 1. Klonkan Repository

Buka terminal atau Git Bash dan jalankan perintah berikut:

```bash
git clone https://github.com/dimasgood691-byte/TDKop.git
cd TDKop
cd TDKop-app
```

### 2. Instal Dependensi (PHP & Node.js)

Jalankan perintah berikut di terminal:

```bash
composer install
npm install
```

### 3. Konfigurasi Environment

Salin file `.env.example` dan generate kunci aplikasi:

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Konfigurasi Database

1. Pastikan layanan Apache dan MySQL telah berjalan di Laragon/XAMPP
2. Buka phpMyAdmin melalui browser: `http://localhost/phpmyadmin`
3. Buat database baru bernama `tdkop_db`
4. Buka file `.env` di editor kode dan sesuaikan konfigurasi database berikut:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=tdkop_db
DB_USERNAME=root
DB_PASSWORD=
```

**Catatan:** Sesuaikan `DB_PORT` jika MySQL Anda menggunakan port berbeda (misalnya 3307)

### 5. Jalankan Migrasi dan Seeder Database

Jalankan perintah berikut di terminal:

```bash
php artisan config:clear
php artisan migrate
php artisan db:seed
```

**Catatan:** Perintah `db:seed` bersifat opsional dan digunakan untuk mengisi data awal/admin

### 6. Buat Storage Link

Hubungkan folder storage ke folder public agar file yang diunggah dapat diakses melalui browser:

```bash
php artisan storage:link
```

---

### 7. Instalasi Semua Library Sekaligus

Jika package belum tersedia, seluruh library frontend dapat diinstall sekaligus menggunakan:
```bash
npm install tailwindcss @tailwindcss/vite chart.js aos axios alpinejs
```
Kemudian jalankan:
```bash
npm install
```

Jika project sudah memiliki package.json yang berisi dependency tersebut, cukup jalankan:
```bash
npm install
```

## Menjalankan Aplikasi

Buka dua terminal terpisah dan jalankan perintah berikut:

**Terminal 1 – Server Laravel:**

```bash
php artisan serve
```

Akses aplikasi melalui browser: `http://127.0.0.1:8000`

**Terminal 2 – Compiler Vite (Asset Front-End):**

```bash
npm run dev
```

---

## Catatan Penting

- Pastikan kedua terminal tetap berjalan selama pengembangan
- Jika mengalami masalah koneksi database, periksa konfigurasi `.env`
- Untuk perubahan aset front-end, terminal Vite harus aktif untuk kompilasi otomatis

---

## Kontribusi

Untuk kontribusi atau melaporkan masalah, silakan buat issue atau pull request di repository ini.

---

## Dokumentasi Penggunaan Artificial Intelligence (AI)

Proyek **TDKop** dikembangkan secara terstruktur menggunakan metodologi *AI-Assisted Software Engineering*. Dokumentasi ini mencatat peran, strategi *prompting*, serta alur kolaborasi antara pengembang dan AI dari tahap perancangan hingga implementasi akhir.

---

### 1. Peran AI dalam Pengembangan
AI (Gemini) dimanfaatkan sebagai **Senior Full-Stack Web Developer & Architectural Consultant** dengan tugas utama:
* Merancang Arsitektur Basis Data (ERD, Skema Migration & Relasi Eloquent).
* Menyusun Alur Bisnis (*Use Case* & *Activity Diagram*).
* Membantu Pembuatan Kode (*Code Generation*) bertahap (Model, Migration, Controller, & UI Blade).
* Mengimplementasikan Best Practices Laravel & Styling Tailwind CSS.

---

### 2. Strategi & System Prompt (Mega Prompting)
Pengembangan tidak dilakukan dengan membuat seluruh kode sekaligus, melainkan menggunakan teknik **Mega Prompt System** berbasis roadmap bertahap. 

#### Aturan & System Prompt Utama:
* **Incremental Development:** AI dilarang menghasilkan seluruh basis kode sekaligus. Pengerjaan dibagi menjadi 10 tahap *roadmap* independen (Setup → Database → Auth → Landing Page → User/Admin Dashboard → Testing).
* **Konvensi Kode Laravel:** Setiap kode yang dihasilkan wajib mencantumkan nama dan jalur file secara spesifik (contoh: `app/Http/Controllers/Siswa/ProductController.php`).
* **Prinsip Desain UI/UX (Aturan 60-30-10):** AI diinstruksikan menerapkan aturan rasio warna UI:
  * **60% (Dominan):** Putih / Abu-abu sangat terang (Background).
  * **30% (Sekunder):** Biru Navy / Royal Blue (Navbar, Sidebar, Header).
  * **10% (Aksen):** Biru Terang / Kuning Tipis (CTA Button, Badge Status, Highlight).
* **Interaktivitas Wajib:** Penerapan library pendukung seperti **SweetAlert2** (ganti alert native), **Lucide Icons**, **Chart.js** (grafik dashboard), dan **AOS (Animate On Scroll)**.

---

### 3. Tahapan Implementasi Berbasis Roadmap AI

Proyek diselesaikan mengikuti 10 fase perintah secara berurutan:

| No | Tahap / Modules | Deskripsi Peran AI |
|:--:|-----------------|--------------------|
| **1** | **Setup Awal** | Konfigurasi Laravel, Tailwind CSS, serta integrasi pustaka AOS, Lucide, Chart.js, dan SweetAlert2. |
| **2** | **Struktur Data** | Pembuatan migration, relasi Eloquent (`users`, `categories`, `products`, `sizes`, `product_stock`, `orders`, `order_details`), dan *Database Seeder*. |
| **3** | **Autentikasi & Authorization** | Pembuatan fitur Register/Login Siswa & Admin yang diproteksi menggunakan **Laravel Middleware** berbasis Role. |
| **4** | **Landing Page** | Penyusunan halaman depan publik yang responsif (mobile-first) lengkap dengan section Produk Populer & Jam Operasional. |
| **5** | **Dashboard Siswa** | Pengembangan alur transaksi siswa: Katalog Produk, Filter Kategori, Cek Stok Real-Time, Keranjang Belanja, dan Checkout. |
| **6** | **Dashboard Admin** | Pengembangan panel manajemen: CRUD Produk & Stok, Pemrosesan Status Pesanan, Grafik Penjualan (Chart.js), dan Log Aktivitas Admin. |
| **7** | **Notifikasi & Pengumuman** | Sistem notifikasi status pesanan (menunggu/diproses/siap diambil/selesai) dan fitur pengumuman koperasi. |
| **8** | **Fitur Laporan** | Modul pencetakan dan ekspor laporan transaksi penjualan serta produk terlaris. |
| **9** | **Refactoring & Polish UI** | Penerapan micro-interaction, skeleton loading, responsivitas layar, dan evaluasi kontras warna (WCAG AA). |
| **10**| **Testing & Bug Fixing** | Pengujian alur transaksi, penanganan error validasi Form Request, dan pembersihan cache sistem. |

---

### 4. Pustaka & Tools Pendukung Pengembangan AI

* **AI Model:** Google Gemini AI
* **Development Tools:** Visual Studio Code (dengan ekstensi pembantu AI), Git Bash, Laragon local server.