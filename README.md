# TDKop-app

TDKop atau Tradevis Koperasi adalah aplikasi koperasi berbasis website yang dirancang untuk memodernisasi sistem koperasi sekolah dari konvensional menjadi serba digital, efisien, dan terintegrasi.

## Fitur
- Login & Register
- Dashboard
- Responsive Design
- CRUD Data

## Teknologi yang digunakan
- **Back-End:** PHP > (v8.4) & Laravel Framework
- **Front-End** Blade, Tailwind CSS & JavaScript
- **Database:** MySQL
- **Environment:** XAMPP / Laragon
- **Code Editor:** Visual Studio Code

## Persyaratan Sistem (Prerequisites)
Sebelum menjalankan proyek ini di komputer lokal, berikut software yang harus di instalasi:
1. **PHP** PHP > (v8.4)
2. **Composer** (PHP Package Manager)
3. **Node.js & NPM** (untuk kompilasi aset Front-End)
4. **Laragon** (direkomendasikan) atau XAMPP
5. **Git**

## Panduan memulai atau menjalankan di local
Ikuti langkah-langkah berikut untuk menjalankan proyek dari GitHub di lingkungan lokal kamu:

 1. Clone Repositori
Buka terminal (Git Bash / VS Code Terminal) dan jalankan:
```bash
git clone [https://github.com/dimasgood691-byte/TDKop.git](https://github.com/dimasgood691-byte/TDKop.git)
cd TDKop
cd TDKop-app

2. Menginstall Dependecy (PHP & Node.js)
### git bash:
composer install -> Menginstall Pustaka PHP (Laravel)
npm install -> Menginstal Pustaka JavaScript & Node.js

3. Konfigurasi Environment (.env)
### git bash:
cp. .env.example .env -> Menyalin file .env.example menjadi .env
php artisan key:generate -> Membuat enkripsi kunci aplikasi Laravel






















