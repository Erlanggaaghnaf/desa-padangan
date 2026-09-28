<?php

class PengaduanModel {
    private $db;

    public function __construct() {
        require_once '../app/core/Database.php';
        $this->db = new Database();
    }

    public function tambahPengaduan($data, $string_nama_foto) {
        $conn = $this->db->getConnection();
        
        $sql = "INSERT INTO pengaduan (nama, kontak, judul, isi, foto, status) 
                VALUES (:nama, :kontak, :judul, :isi, :foto, 'Belum Ditangani')";
        
        $stmt = $conn->prepare($sql);
        return $stmt->execute([
            ':nama'   => $data['nama'],
            ':kontak' => $data['kontak'],
            ':judul'  => $data['judul'],
            ':isi'    => $data['isi'],
            ':foto'   => $string_nama_foto, // Menyimpan string foto yang digabung koma
        ]);
    }

    public function getStatistikPengaduan() {
        $conn = $this->db->getConnection();
        
        // Hitung total pengaduan
        $stmt_total = $conn->prepare("SELECT COUNT(*) as total FROM pengaduan");
        $stmt_total->execute();
        $total = $stmt_total->fetch()['total'];

        // Hitung pengaduan selesai
        $stmt_selesai = $conn->prepare("SELECT COUNT(*) as selesai FROM pengaduan WHERE status = 'Selesai'");
        $stmt_selesai->execute();
        $selesai = $stmt_selesai->fetch()['selesai'];

        return [
            'total' => $total,
            'selesai' => $selesai
        ];
    }
}