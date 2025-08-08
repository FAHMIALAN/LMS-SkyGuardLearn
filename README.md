# SkyGuardLearn - Learning Management System (LMS)

Selamat datang di **SkyGuardLearn**, sebuah platform Learning Management System (LMS) modern yang dibangun menggunakan **Laravel 12**. 
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

**Backend:** Laravel 12, PHP 8.3  
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

