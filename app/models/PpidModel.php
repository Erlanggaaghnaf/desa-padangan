<?php
require_once '../app/core/Database.php';

class PpidModel {
    private $db;
    private $conn;

    public function __construct() {
        $this->db = new Database();
        $this->conn = $this->db->getConnection();
    }

    // Mengambil seluruh dokumen PPID
    public function getAllDokumen() {
        $stmt = $this->conn->prepare("SELECT * FROM desa_ppid ORDER BY id DESC");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Menambah dokumen baru
    public function tambahDokumen($judul, $deskripsi, $tahun, $namaFile) {
        $sql = "INSERT INTO desa_ppid (judul, deskripsi, tahun, file) VALUES (:judul, :deskripsi, :tahun, :file)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':judul'     => $judul,
            ':deskripsi' => $deskripsi,
            ':tahun'     => $tahun,
            ':file'      => $namaFile
        ]);
    }

    // Menghapus dokumen berdasarkan ID
    public function hapusDokumen($id) {
        // Ambil nama file terlebih dahulu untuk dihapus dari server
        $stmt = $this->conn->prepare("SELECT file FROM desa_ppid WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch();
        
        if ($row && !empty($row['file'])) {
            $filePath = '../public/uploads/ppid/' . $row['file'];
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        $stmt = $this->conn->prepare("DELETE FROM desa_ppid WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }

    // Memperbarui dokumen PPID
    public function editDokumen($id, $judul, $deskripsi, $tahun, $namaFileBaru = null) {
        if ($namaFileBaru) {
            // Ambil nama file lama untuk dihapus dari server
            $stmt = $this->conn->prepare("SELECT file FROM desa_ppid WHERE id = :id");
            $stmt->execute([':id' => $id]);
            $row = $stmt->fetch();
            if ($row && !empty($row['file'])) {
                $filePath = '../public/uploads/ppid/' . $row['file'];
                if (file_exists($filePath)) { unlink($filePath); }
            }

            $sql = "UPDATE desa_ppid SET judul = :judul, deskripsi = :deskripsi, tahun = :tahun, file = :file WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([
                ':id'        => $id,
                ':judul'     => $judul,
                ':deskripsi' => $deskripsi,
                ':tahun'     => $tahun,
                ':file'      => $namaFileBaru
            ]);
        } else {
            $sql = "UPDATE desa_ppid SET judul = :judul, deskripsi = :deskripsi, tahun = :tahun WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([
                ':id'        => $id,
                ':judul'     => $judul,
                ':deskripsi' => $deskripsi,
                ':tahun'     => $tahun
            ]);
        }
    }
}