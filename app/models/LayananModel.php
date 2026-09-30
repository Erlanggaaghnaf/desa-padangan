<?php

class LayananModel
{
    private $db;

    public function __construct()
    {
        require_once '../app/core/Database.php';
        $this->db = new Database();
    }

    /**
     * Ambil seluruh layanan beserta persyaratan dan alur.
     */
    public function getAllLayanan()
    {
        $conn = $this->db->getConnection();

        $stmtLayanan = $conn->prepare(
            "SELECT id, nama_layanan, kategori, created_at, updated_at
             FROM layanan
             ORDER BY kategori ASC, nama_layanan ASC, id ASC"
        );
        $stmtLayanan->execute();
        $layanan = $stmtLayanan->fetchAll();

        if (empty($layanan)) {
            return [];
        }

        $stmtPersyaratan = $conn->prepare(
            "SELECT id, layanan_id, nama_persyaratan
             FROM layanan_persyaratan
             ORDER BY layanan_id ASC, id ASC"
        );
        $stmtPersyaratan->execute();
        $persyaratanRows = $stmtPersyaratan->fetchAll();

        $stmtAlur = $conn->prepare(
            "SELECT id, layanan_id, urutan, judul_langkah, deskripsi_langkah
             FROM layanan_alur
             ORDER BY layanan_id ASC, urutan ASC, id ASC"
        );
        $stmtAlur->execute();
        $alurRows = $stmtAlur->fetchAll();

        return $this->attachChildren($layanan, $persyaratanRows, $alurRows);
    }

    /**
     * Ambil satu layanan berdasarkan ID beserta seluruh child data.
     */
    public function getLayananById($id)
    {
        $conn = $this->db->getConnection();

        $stmtLayanan = $conn->prepare(
            "SELECT id, nama_layanan, kategori, created_at, updated_at
             FROM layanan
             WHERE id = :id
             LIMIT 1"
        );
        $stmtLayanan->execute([':id' => (int) $id]);
        $layanan = $stmtLayanan->fetch();

        if (!$layanan) {
            return null;
        }

        $stmtPersyaratan = $conn->prepare(
            "SELECT id, layanan_id, nama_persyaratan
             FROM layanan_persyaratan
             WHERE layanan_id = :layanan_id
             ORDER BY id ASC"
        );
        $stmtPersyaratan->execute([':layanan_id' => (int) $id]);

        $stmtAlur = $conn->prepare(
            "SELECT id, layanan_id, urutan, judul_langkah, deskripsi_langkah
             FROM layanan_alur
             WHERE layanan_id = :layanan_id
             ORDER BY urutan ASC, id ASC"
        );
        $stmtAlur->execute([':layanan_id' => (int) $id]);

        $layanan['persyaratan'] = $stmtPersyaratan->fetchAll();
        $layanan['alur'] = $stmtAlur->fetchAll();

        return $layanan;
    }

    /**
     * Buat layanan sekaligus persyaratan dan alur dalam satu transaksi.
     */
    public function tambahLayanan($namaLayanan, $kategori, array $persyaratan, array $alur)
    {
        $conn = $this->db->getConnection();

        try {
            $conn->beginTransaction();

            $stmtLayanan = $conn->prepare(
                "INSERT INTO layanan (nama_layanan, kategori)
                 VALUES (:nama_layanan, :kategori)"
            );
            $stmtLayanan->execute([
                ':nama_layanan' => $namaLayanan,
                ':kategori' => $kategori,
            ]);

            $layananId = (int) $conn->lastInsertId();

            $this->insertPersyaratan($conn, $layananId, $persyaratan);
            $this->insertAlur($conn, $layananId, $alur);

            $conn->commit();

            return $layananId;
        } catch (Throwable $e) {
            if ($conn->inTransaction()) {
                $conn->rollBack();
            }

            throw $e;
        }
    }

    /**
     * Update layanan beserta child data.
     * Child lama dihapus lalu diganti dengan data hasil form terbaru.
     */
    public function ubahLayanan($id, $namaLayanan, $kategori, array $persyaratan, array $alur)
    {
        $conn = $this->db->getConnection();
        $id = (int) $id;

        try {
            $conn->beginTransaction();

            $stmtLayanan = $conn->prepare(
                "UPDATE layanan
                 SET nama_layanan = :nama_layanan,
                     kategori = :kategori
                 WHERE id = :id"
            );
            $stmtLayanan->execute([
                ':nama_layanan' => $namaLayanan,
                ':kategori' => $kategori,
                ':id' => $id,
            ]);

            if ($stmtLayanan->rowCount() === 0) {
                $cek = $conn->prepare("SELECT id FROM layanan WHERE id = :id LIMIT 1");
                $cek->execute([':id' => $id]);

                if (!$cek->fetch()) {
                    throw new RuntimeException('Layanan tidak ditemukan.');
                }
            }

            $hapusPersyaratan = $conn->prepare(
                "DELETE FROM layanan_persyaratan WHERE layanan_id = :layanan_id"
            );
            $hapusPersyaratan->execute([':layanan_id' => $id]);

            $hapusAlur = $conn->prepare(
                "DELETE FROM layanan_alur WHERE layanan_id = :layanan_id"
            );
            $hapusAlur->execute([':layanan_id' => $id]);

            $this->insertPersyaratan($conn, $id, $persyaratan);
            $this->insertAlur($conn, $id, $alur);

            $conn->commit();

            return true;
        } catch (Throwable $e) {
            if ($conn->inTransaction()) {
                $conn->rollBack();
            }

            throw $e;
        }
    }

    /**
     * Hapus layanan. Foreign key ON DELETE CASCADE akan menghapus child data.
     */
    public function hapusLayanan($id)
    {
        $conn = $this->db->getConnection();

        $stmt = $conn->prepare("DELETE FROM layanan WHERE id = :id");
        $stmt->execute([':id' => (int) $id]);

        return $stmt->rowCount() > 0;
    }

    private function insertPersyaratan(PDO $conn, $layananId, array $persyaratan)
    {
        if (empty($persyaratan)) {
            return;
        }

        $stmt = $conn->prepare(
            "INSERT INTO layanan_persyaratan (layanan_id, nama_persyaratan)
             VALUES (:layanan_id, :nama_persyaratan)"
        );

        foreach ($persyaratan as $namaPersyaratan) {
            $stmt->execute([
                ':layanan_id' => (int) $layananId,
                ':nama_persyaratan' => $namaPersyaratan,
            ]);
        }
    }

    private function insertAlur(PDO $conn, $layananId, array $alur)
    {
        if (empty($alur)) {
            return;
        }

        $stmt = $conn->prepare(
            "INSERT INTO layanan_alur
                (layanan_id, urutan, judul_langkah, deskripsi_langkah)
             VALUES
                (:layanan_id, :urutan, :judul_langkah, :deskripsi_langkah)"
        );

        foreach ($alur as $index => $langkah) {
            $stmt->execute([
                ':layanan_id' => (int) $layananId,
                ':urutan' => $index + 1,
                ':judul_langkah' => $langkah['judul_langkah'],
                ':deskripsi_langkah' => $langkah['deskripsi_langkah'],
            ]);
        }
    }

    private function attachChildren(array $layanan, array $persyaratanRows, array $alurRows)
    {
        $byId = [];

        foreach ($layanan as &$item) {
            $item['persyaratan'] = [];
            $item['alur'] = [];
            $byId[(int) $item['id']] = &$item;
        }
        unset($item);

        foreach ($persyaratanRows as $row) {
            $layananId = (int) $row['layanan_id'];

            if (isset($byId[$layananId])) {
                $byId[$layananId]['persyaratan'][] = $row;
            }
        }

        foreach ($alurRows as $row) {
            $layananId = (int) $row['layanan_id'];

            if (isset($byId[$layananId])) {
                $byId[$layananId]['alur'][] = $row;
            }
        }

        return $layanan;
    }
}
