<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).


# SkyGuardLearn - Learning Management System (LMS)

Selamat datang di **SkyGuardLearn**, sebuah platform Learning Management System (LMS) modern yang dibangun menggunakan **Laravel 11**. 
Aplikasi ini dirancang untuk memfasilitasi proses belajar mengajar antara pengajar dan siswa secara online, dilengkapi dengan fitur interaktif 
seperti manajemen materi, tugas, penilaian, dan forum diskusi real-time per materi.

---

## 🗺️ Peta Konsep & Fitur Utama

Aplikasi ini memiliki dua peran utama dengan fitur yang berbeda: **Pengajar** dan **Siswa**.

### Untuk Pengajar (`role: pengajar`)
- **Dasbor Pengajar**  
  Menampilkan ringkasan statistik (total materi, siswa, tugas) dan feed aktivitas terbaru seperti diskusi dan pengumpulan tugas.

- **Manajemen Materi (CRUD):**
  - Membuat, membaca, memperbarui, dan menghapus materi pembelajaran.
  - Mengunggah file pendukung (PDF, DOCX, dll).
  - Menyematkan video YouTube dari berbagai format link secara otomatis.

- **Manajemen Tugas (CRUD):**
  - Membuat, membaca, memperbarui, dan menghapus tugas.
  - Mengunggah file soal.

- **Penilaian Tugas:**
  - Melihat daftar siswa yang telah mengumpulkan tugas.
  - Mengunduh file jawaban dari setiap siswa.
  - Memberikan nilai (termasuk nilai desimal) untuk setiap pengumpulan.

- **Forum Diskusi per Materi:**
  - Masuk ke dalam ruang diskusi di setiap materi untuk berinteraksi dan membalas pertanyaan siswa secara real-time.

### Untuk Siswa (`role: siswa`)
- **Dasbor Siswa**  
  Menampilkan daftar materi dan tugas terbaru.

- **Materi Pembelajaran:**
  - Melihat daftar semua materi.
  - Membuka halaman detail materi untuk menonton video yang disematkan dan mengunduh file pendukung.
  - Menandai materi sebagai "selesai" untuk melacak progres belajar.

- **Sistem Tugas:**
  - Melihat daftar semua tugas yang diberikan.
  - Mengunggah file jawaban (PDF, DOCX, ZIP, dll).
  - Mengirim ulang tugas jika diperlukan.
  - Melihat nilai yang telah diberikan oleh pengajar.

- **Forum Diskusi per Materi:**
  - Berpartisipasi dalam forum diskusi di bawah setiap halaman materi.
  - Mengirim pertanyaan dan menerima balasan dari pengajar atau siswa lain secara real-time.

---

## 🏗️ Struktur Proyek & Teknologi

Proyek ini dibangun dengan tumpukan teknologi modern untuk memastikan performa dan interaktivitas yang tinggi.

**Backend:** Laravel 11, PHP 8.3  
**Frontend:** Blade, Tailwind CSS, Alpine.js  
**Database:** MySQL (atau database SQL lainnya yang didukung Laravel)  
**Fitur Real-Time:** Laravel Reverb (WebSocket Server)  
**Autentikasi:** Laravel Breeze

**Struktur Direktori Penting:**
```
/
├── app/
│   ├── Console/Commands/       # Perintah untuk hapus komentar otomatis
│   ├── Events/                 # Event 'PesanBaru' untuk broadcast chat
│   ├── Http/Controllers/       # Logika utama aplikasi
│   │   ├── Pengajar/           # Controller khusus untuk pengajar
│   │   └── Siswa/              # Controller khusus untuk siswa
│   └── Models/                 # Model Eloquent untuk interaksi database
├── database/
│   ├── factories/
│   └── migrations/             # Struktur tabel database
├── resources/
│   ├── css/
│   ├── js/
│   │   └── bootstrap.js        # Konfigurasi Laravel Echo & Reverb
│   └── views/                  # Semua file tampilan Blade
│       ├── layouts/
│       ├── pengajar/
│       └── siswa/
├── routes/
│   ├── web.php                 # Rute utama aplikasi
│   └── channels.php            # Definisi channel untuk broadcast
└── .env.example                # Template untuk konfigurasi environment
```

---

## 🚀 Instalasi dan Menjalankan Aplikasi

### **Prasyarat**
- PHP >= 8.2
- Composer
- Node.js & NPM
- Database Server (MySQL/MariaDB)
- Git

### **1. Clone Repository**
```bash
git clone https://github.com/username/skyguardlearn.git
cd skyguardlearn
```

### **2. Instalasi Dependensi**
```bash
# Instal dependensi PHP
composer install

# Instal dependensi JavaScript
npm install
```

### **3. Konfigurasi Environment**
```bash
cp .env.example .env
```
Sesuaikan konfigurasi database pada `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_skyguardlearn
DB_USERNAME=root
DB_PASSWORD=
```

### **4. Setup Aplikasi Laravel**
```bash
php artisan key:generate
php artisan migrate --seed
```

### **5. Konfigurasi Reverb (Real-Time)**
Pastikan `.env` memiliki pengaturan berikut:
```env
BROADCAST_DRIVER=reverb
REVERB_APP_ID=skyguardlearn
REVERB_APP_KEY=skyguardlearn_key
REVERB_APP_SECRET=skyguardlearn_secret
REVERB_HOST="127.0.0.1"
REVERB_PORT=8080
REVERB_SCHEME=http
```

Lalu jalankan:
```bash
php artisan install:broadcasting
```

### **6. Menjalankan Server**
Jalankan di terminal terpisah:
```bash
npm run dev      # Terminal 1 - Frontend
php artisan reverb:start   # Terminal 2 - Real-Time
php artisan serve          # Terminal 3 - Backend
```

### **7. Akses Aplikasi**
```
http://127.0.0.1:8000
```
**Akun Pengajar:**  
Email: `pengajar@gmail.com`  
Password: `password`  

**Akun Siswa:**  
Email: `siswa@gmail.com`  
Password: `password`

