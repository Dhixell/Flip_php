# FlipPlay Backend Engine Prototype (PHP OOP)

Prototipe engine backend sederhana berbasis PHP dengan paradigma **Object-Oriented Programming (OOP)** untuk studi kasus **FlipPlay** sesuai spesifikasi Modul 3 Praktikum Pemrograman Web (Universitas Muhammadiyah Malang).

## 📁 Struktur Direktori
```text
flip-php/
├── src/
│   ├── Models/
│   │   ├── Media.php       # Abstract Parent Class
│   │   ├── Movie.php       # Subclass Media untuk entitas Film
│   │   ├── Music.php       # Subclass Media untuk entitas Musik/Lagu
│   │   └── User.php        # Class entitas Pengguna
│   └── Services/
│       └── Library.php     # Service / Engine pengelola katalog FlipPlay
├── index.php               # Entry point simulasi CLI
└── README.md
```

## 🎯 Pemenuhan Ketentuan Demo Modul
| No | Ketentuan | Keterangan Implementasi |
|---|---|---|
| 1 | Minimal 3 Class | Menggunakan 5 class: `Media`, `Movie`, `Music`, `User`, dan `Library`. |
| 2 | Constructor (`__construct`) | Diterapkan pada seluruh class model dan memanggil `parent::__construct()`. |
| 3 | Property & Method | Memiliki property internal dan berbagai method fungsional. |
| 4 | Access Modifier | Menggunakan `private`, `protected`, dan `public` secara tepat sesuai prinsip enkapsulasi. |
| 5 | Inheritance | `Movie` dan `Music` mewarisi properti dan method dari parent `Media`. |
| 6 | Type Hinting & Return Type | Seluruh method dan parameter memiliki deklarasi tipe yang eksplisit (`string`, `int`, `bool`, `void`, dll.). |
| 7 | Namespace | Mengorganisir class ke dalam `FlipPlay\Models` dan `FlipPlay\Services`. |
| 8 | File Utama `index.php` | Sebagai entry point simulasi command-line. |

## 🚀 Cara Menjalankan
Buka terminal pada direktori proyek dan jalankan perintah:
```bash
php index.php
```

