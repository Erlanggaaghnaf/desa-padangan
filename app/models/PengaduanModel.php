<?php

class PengaduanModel {
    private $db;

    public function __construct() {
        // Memanggil kelas Database core Anda
        require_once '../app/core/Database.php';
        $this->db = new Database();
    }

    // Fungsi khusus untuk memasukkan data ke database
    public function tambahPengaduan($data, $nama_file_foto) {
        $conn = $this->db->getConnection();

        $sql = "INSERT INTO pengaduan (nama, kontak, kategori, judul, isi, foto, lokasi) 
                VALUES (:nama, :kontak, :kategori, :judul, :isi, :foto, :lokasi)";
        
        $stmt = $conn->prepare($sql);
        return $stmt->execute([
            ':nama'     => $data['nama'],
            ':kontak'   => $data['kontak'],
            ':kategori' => $data['kategori'],
            ':judul'    => $data['judul'],
            ':isi'      => $data['isi'],
            ':foto'     => $nama_file_foto,
            ':lokasi'   => $data['lokasi']
        ]);
    }
}