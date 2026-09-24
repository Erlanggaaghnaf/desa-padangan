-- Buat Database jika belum ada
CREATE DATABASE IF NOT EXISTS db_padangan;
USE db_padangan;

-- 1. Tabel Users (Untuk Admin Login)
CREATE TABLE IF NOT EXISTS users (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    nama_lengkap VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Masukkan akun admin default (Username: admin, Password: password123)
-- Password di bawah adalah hash dari 'password123'
INSERT INTO users (username, password, nama_lengkap) VALUES 
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Administrator Desa');

-- 2. Tabel Berita
CREATE TABLE IF NOT EXISTS berita (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(255) NOT NULL,
    deskripsi TEXT NOT NULL,
    foto VARCHAR(255) NOT NULL,
    views INT(11) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 3. Tabel Pengaduan Masyarakat
CREATE TABLE IF NOT EXISTS pengaduan (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    nama_pelapor VARCHAR(100) NOT NULL,
    no_hp VARCHAR(20) NOT NULL,
    isi_laporan TEXT NOT NULL,
    foto_bukti VARCHAR(255) DEFAULT NULL,
    status ENUM('Belum Ditangani', 'Sedang Diproses', 'Selesai') DEFAULT 'Belum Ditangani',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 4. Tabel Galeri Desa
CREATE TABLE IF NOT EXISTS galeri (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(255) NOT NULL,
    foto VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 5. Tabel Penduduk (Sesuai PendudukModel Anda)
CREATE TABLE IF NOT EXISTS penduduk (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    nik VARCHAR(20) NOT NULL UNIQUE,
    nama VARCHAR(100) NOT NULL,
    jenis_kelamin ENUM('L', 'P') NOT NULL,
    alamat TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 6. Tabel APBDes (Sesuai ApbdesModel Anda)
CREATE TABLE IF NOT EXISTS apbdes (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    tahun YEAR NOT NULL,
    kategori VARCHAR(100) NOT NULL,
    uraian VARCHAR(255) NOT NULL,
    anggaran DECIMAL(15,2) NOT NULL,
    realisasi DECIMAL(15,2) NOT NULL
);