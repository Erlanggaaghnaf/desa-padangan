
-- Tabel Pengadual
CREATE TABLE pengaduan (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    nama VARCHAR(100) NOT NULL,

    kontak VARCHAR(50) NOT NULL,

    kategori VARCHAR(50) NOT NULL,

    judul VARCHAR(150) NOT NULL,

    isi TEXT NOT NULL,

    foto VARCHAR(255) NULL,

    lokasi VARCHAR(255) NULL,

    status ENUM(
        'Belum Ditangani',
        'Selesai'
    ) NOT NULL DEFAULT 'Belum Ditangani',

    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,

    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP
);