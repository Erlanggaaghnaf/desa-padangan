-- Buat tabel pengaduan baru sesuai struktur yang disesuaikan
CREATE TABLE `pengaduan` (
  `id` INT(10) NOT NULL AUTO_INCREMENT,
  `nama` VARCHAR(100) NOT NULL,
  `kontak` VARCHAR(50) NOT NULL,
  `judul` VARCHAR(255) NOT NULL,
  `isi` TEXT NOT NULL,
  `foto` TEXT DEFAULT NULL,
  `status` ENUM('Belum Ditangani','Selesai') NOT NULL DEFAULT 'Belum Ditangani',
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Buat tabel visitors untuk statistik kunjungan website
CREATE TABLE IF NOT EXISTS `visitors` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `ip_address` VARCHAR(45) NOT NULL,
  `visit_date` DATE NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 2. LAYANAN
CREATE TABLE IF NOT EXISTS layanan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_layanan VARCHAR(255) NOT NULL,
    kategori VARCHAR(100) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS layanan_persyaratan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    layanan_id INT NOT NULL,
    nama_persyaratan VARCHAR(255) NOT NULL,
    FOREIGN KEY (layanan_id) REFERENCES layanan(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS layanan_alur (
    id INT AUTO_INCREMENT PRIMARY KEY,
    layanan_id INT NOT NULL,
    urutan INT NOT NULL,
    deskripsi_langkah TEXT NOT NULL,
    FOREIGN KEY (layanan_id) REFERENCES layanan(id) ON DELETE CASCADE
);

-- 3. GALERI
CREATE TABLE IF NOT EXISTS galeri (
    id INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(255) NOT NULL,
    foto VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- 4. PPID (Dikelola via Master Data)
CREATE TABLE IF NOT EXISTS ppid (
    id INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(255) NOT NULL,
    deskripsi TEXT NULL,
    tahun INT NOT NULL,
    file_dokumen VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- 5. MASTER DATA DESA (Agregat Kependudukan)
CREATE TABLE IF NOT EXISTS desa_kependudukan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    laki_laki INT DEFAULT 0,
    perempuan INT DEFAULT 0,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS desa_umur (
    id INT AUTO_INCREMENT PRIMARY KEY,
    rentang VARCHAR(20) NOT NULL,
    jumlah INT DEFAULT 0
);

CREATE TABLE IF NOT EXISTS desa_pekerjaan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kategori VARCHAR(100) NOT NULL,
    jumlah INT DEFAULT 0
);

CREATE TABLE IF NOT EXISTS desa_pendidikan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tingkat VARCHAR(100) NOT NULL,
    jumlah INT DEFAULT 0
);

CREATE TABLE IF NOT EXISTS desa_perkawinan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    status VARCHAR(50) NOT NULL,
    jumlah INT DEFAULT 0
);

CREATE TABLE IF NOT EXISTS desa_agama (
    id INT AUTO_INCREMENT PRIMARY KEY,
    agama VARCHAR(50) NOT NULL,
    jumlah INT DEFAULT 0
);

-- Seeder Dasar untuk Rentang Umur (Mengikuti standar aktual desa)
INSERT IGNORE INTO desa_umur (rentang, jumlah) VALUES 
('<3', 0), ('3-6', 0), ('7-12', 0), ('13-15', 0), 
('16-18', 0), ('19-25', 0), ('26-59', 0), ('>59', 0);