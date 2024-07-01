SEA Salon - Sistem Manajemen Salon

Lingkungan Pengembangan (Penting!)
	Proyek ini dikembangkan di macOS menggunakan server MAMP. Untuk pengguna yang menjalankan proyek ini di lingkungan Windows atau menggunakan server lain, mungkin perlu menyesuaikan konfigurasi database, terutama bagian password pada file Fuction/config.php , misalnya menghapus atau mengosongkan “ password=' ' “ jika tidak diperlukan.

Deskripsi
	SEA Salon adalah aplikasi web yang dirancang untuk membantu manajemen salon dalam mengelola layanan dan reservasi. Sistem ini menyediakan dashboard untuk pelanggan dan admin. Pelanggan dapat melakukan reservasi layanan salon, sedangkan admin dapat menambah dan mengelola cabang serta layanan yang ditawarkan.

Fitur
	•	Login/Registrasi Pengguna/Admin:
		⁃	Pengguna dapat mendaftar sebagai pelanggan baru atau masuk ke akun mereka yang sudah ada.
		⁃	Admin dapat melakukan login.
	•	Dashboard Pelanggan:
		⁃	Pelanggan dapat melihat layanan yang tersedia dan membuat reservasi baru.
		⁃	Pelanggan dapat melihat daftar reservasi mereka.
	•	Dashboard Admin:
		⁃	Admin dapat menambah cabang baru
		⁃	Admin dapat mengelola layanan yang akan ditawarkan oleh salon serta mengatur durasinya.
		⁃	Admin dapat melihat daftar reservasi yang telah dibuat oleh pelanggan.
		⁃   Admin dapat menghapus cabang.
		⁃   Admin dapat menghapus layanan.
		⁃   Admin dapat memberi tanda selesai pada reservasi.

	•	Pengambilan Data Asinkron:
		⁃	Menggunakan JSON untuk pengambilan data cabang, layanan, dan reservasi secara asinkron melalui JavaScript.

Teknologi yang Digunakan
	•	HTML5
	•	CSS3
	•	Bootstrap 5
	•	Google Fonts
	•	JavaScript (untuk logika formulir dan pengambilan data asinkron)
	•	PHP (untuk pemrosesan login, registrasi, dan manajemen data)
	•	MySQL (untuk penyimpanan data)
	•	JSON (untuk pengambilan data asinkron dari server)

Catatan Tambahan
Halaman pertama yang akan dilihat pengguna adalah index.php. Pengguna dapat menekan tombol “Click” untuk melakukan login atau registrasi.

Struktur Proyek

project-root(Tugas-PanduNurAfiDewanto)/
│
├── CSS/
│   ├── AdminDashboard.css
│   ├── custDashboard.css
│   ├── loginRegister.css
│   └── style.css
│
├── Function/
│   ├── add_branch.php
│   ├── add_services.php
│   ├── config.php
│   ├── fetch_review.php
│   ├── get_branches.php
│   ├── get_customer_reservations.php
│   ├── get_reservation.php
│   ├── get_services.php
│   ├── process_login.php
│   ├── process_register.php
│   ├── process_reservation.php
│   ├── reserve.php
│   └── submit_review.php
│
├── Image/
│   ├── Facial.webp
│   ├── Haircut.jpg
│   ├── Haircut2.jpg
│   └── Manicure.jpg
│
├── JS/
│   └── JS.js
│
├── admin_dashboard.php
├── customer_dashboard.php
├── index.php
├── login_register.php
├── sea_salon.sql
└── README.md

	•	index.php
	⁃	Halaman pertama yang dibuka pengguna. Pengguna dapat menekan tombol registrasi untuk melakukan registrasi.
	•	login_register.php
	⁃	Halaman utama untuk login dan registrasi.
	•	admin_dashboard.php
	⁃	Halaman dashboard admin untuk mengelola cabang dan layanan.
	•	customer_dashboard.php
	⁃	Halaman dashboard pelanggan untuk melihat dan membuat reservasi. 
	•	Function/config.php
	⁃	Konfigurasi database.
	•	Function/process_login.php
	⁃	Skrip PHP untuk memproses login pengguna.
	•	Function/process_register.php
	⁃	Skrip PHP untuk memproses registrasi pengguna baru.
	•	Function/add_branch.php
	⁃	Skrip PHP untuk menambah cabang baru.
	•	Function/add_services.php
	⁃	Skrip PHP untuk menambah layanan baru.
	•	Function/get_branches.php
	⁃	Skrip PHP untuk mendapatkan daftar cabang.
	•	Function/get_services.php
	⁃	Skrip PHP untuk mendapatkan daftar layanan.
	•	Function/get_reservation.php
	⁃	Skrip PHP untuk mendapatkan daftar reservasi.
	•	CSS/adminDashboard.css
	⁃	File CSS untuk styling halaman dashboard admin.
	•	CSS/custDashboard.css
	⁃	File CSS untuk styling halaman dashboard pelanggan.
	•	CSS/loginRegister.css
	⁃	File CSS untuk styling halaman login dan registrasi.
	•	JS/JS.js
	⁃	File JavaScript untuk logika tambahan yang dibutuhkan.
	•	Image/
	⁃	Folder yang berisi gambar-gambar yang digunakan dalam proyek.

