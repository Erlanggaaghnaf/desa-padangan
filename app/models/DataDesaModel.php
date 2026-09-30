<?php
// Pastikan path file Database ini sesuai dengan struktur project Anda
require_once '../app/core/Database.php'; 
// atau require_once '../app/core/Database.php';

class DataDesaModel {
    private $db;
    private $conn;

    public function __construct() {
        $this->db = new Database();
        $this->conn = $this->db->getConnection();
    }

    // Mengambil seluruh data agregat desa untuk halaman publik & admin
    public function getSemuaDataDesa() {
        return [
            'kependudukan' => $this->getKependudukan(),
            'umur'         => $this->getData('desa_umur', 'rentang'),
            'pekerjaan'    => $this->getData('desa_pekerjaan', 'kategori'),
            'pendidikan'   => $this->getData('desa_pendidikan', 'tingkat'),
            'perkawinan'   => $this->getData('desa_perkawinan', 'status'),
            'agama'        => $this->getData('desa_agama', 'agama')
        ];
    }

    private function getKependudukan() {
        $stmt = $this->conn->prepare("SELECT * FROM desa_kependudukan LIMIT 1");
        $stmt->execute();
        $row = $stmt->fetch();
        if (!$row) return ['laki_laki' => 0, 'perempuan' => 0];
        return $row;
    }

    private function getData($tabel, $kolomNama) {
        $stmt = $this->conn->prepare("SELECT * FROM {$tabel} ORDER BY id ASC");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Menyimpan/Update data kependudukan (Laki-laki & Perempuan)
    public function updateKependudukan($laki, $perempuan, $kk) {
    $stmt = $this->conn->prepare("SELECT COUNT(*) FROM desa_kependudukan");
    $stmt->execute();
    if ($stmt->fetchColumn() == 0) {
        $sql = "INSERT INTO desa_kependudukan (laki_laki, perempuan, kepala_keluarga) VALUES (:l, :p, :kk)";
    } else {
        $sql = "UPDATE desa_kependudukan SET laki_laki = :l, perempuan = :p, kepala_keluarga = :kk";
    }
    $stmt = $this->conn->prepare($sql);
    return $stmt->execute([':l' => $laki, ':p' => $perempuan, ':kk' => $kk]);
}

    // Menyimpan/Update data kategori dinamis (Umur, Pekerjaan, dll)
    public function updateDataKategori($tabel, $kolomNama, $dataArray) {
        $stmt = $this->conn->prepare("TRUNCATE TABLE {$tabel}");
        $stmt->execute();

        $sukses = true;
        $sql = "INSERT INTO {$tabel} ({$kolomNama}, jumlah) VALUES (:nama, :jumlah)";
        $stmt = $this->conn->prepare($sql);

        foreach ($dataArray as $item) {
            $res = $stmt->execute([
                ':nama'   => $item['nama'],
                ':jumlah' => (int)$item['jumlah']
            ]);
            if (!$res) $sukses = false;
        }
        return $sukses;
    }
}