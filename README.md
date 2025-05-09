📚 Management Perpustakaan
Sistem Manajemen Perpustakaan berbasis Laravel dan Filament Admin Panel. Proyek ini memungkinkan pengelolaan data buku, anggota, dan transaksi peminjaman dengan tampilan dashboard yang responsif dan mudah digunakan.

📌 Daftar Isi
Dibangun Dengan

Fitur

Flowchart Instalasi

Langkah Instalasi

Konfigurasi Environment

Migrasi & Seeder Database

Instalasi Filament

Membuat User Admin

Menjalankan Aplikasi

Kontribusi

Lisensi

Kontak

🔧 Dibangun Dengan
Laravel – Framework PHP

Filament – Admin Panel Laravel

MySQL / PostgreSQL – Basis Data

Composer – Manajer Dependency PHP

Node.js & NPM – Kompilasi Aset Frontend

✨ Fitur
📚 Manajemen Buku: Tambah, ubah, dan hapus data buku

👤 Manajemen Anggota: Kelola data anggota perpustakaan

🔁 Transaksi Peminjaman: Peminjaman dan pengembalian buku

🔐 Autentikasi Admin: Login aman dengan Filament

📱 UI Responsif: Tampilan dashboard yang mendukung perangkat mobile

📈 Flowchart Instalasi
mermaid
Salin
Edit
flowchart LR
    A[Clone Repository] --> B[Install Dependency PHP]
    B --> C[Salin & Konfigurasi .env]
    C --> D[Generate App Key]
    D --> E[Migrasi & Seed Database]
    E --> F[Install Filament]
    F --> G[Buat User Admin]
    G --> H[Jalankan Server]
    H --> I[Akses Dashboard /admin]
🚀 Langkah Instalasi
Clone repository

bash
Salin
Edit
git clone https://github.com/adidarma24/ManagementPerpustakaan.git
cd ManagementPerpustakaan
Install dependency PHP

bash
Salin
Edit
composer install
Install dependency NodeJS (jika menggunakan aset frontend)

bash
Salin
Edit
npm install
npm run dev
⚙️ Konfigurasi Environment
Salin file .env

bash
Salin
Edit
cp .env.example .env
Edit file .env sesuai konfigurasi lokal kamu:

env
Salin
Edit
APP_NAME=Perpustakaan
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=perpustakaan
DB_USERNAME=root
DB_PASSWORD=
Generate application key

bash
Salin
Edit
php artisan key:generate
🧪 Migrasi & Seeder Database
Jalankan migrasi database

bash
Salin
Edit
php artisan migrate
(Opsional) Jika terdapat seeder:

bash
Salin
Edit
php artisan db:seed
🧩 Instalasi Filament
Jika Filament belum terpasang, jalankan:

bash
Salin
Edit
composer require filament/filament
php artisan filament:install
👤 Membuat User Admin
bash
Salin
Edit
php artisan make:filament-user
Masukkan nama, email, dan password sesuai instruksi terminal.

▶️ Menjalankan Aplikasi
bash
Salin
Edit
php artisan serve
Akses aplikasi melalui browser:

bash
Salin
Edit
http://localhost:8000/admin
Login menggunakan akun admin yang sudah dibuat.

🤝 Kontribusi
Kontribusi sangat terbuka!
Silakan fork repositori ini, buat branch baru, dan kirimkan pull request.

📄 Lisensi
Proyek ini dilisensikan di bawah MIT License – lihat file LICENSE untuk detail.
