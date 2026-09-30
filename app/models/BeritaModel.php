<?php

class BeritaModel
{
    private $db;

    public function __construct()
    {
        require_once '../app/core/Database.php';
        $this->db = new Database();
    }

    /**
     * Ambil jumlah seluruh berita.
     */
    public function getCount()
    {
        $conn = $this->db->getConnection();

        $stmt = $conn->prepare(
            "SELECT COUNT(*) AS total
             FROM berita"
        );

        $stmt->execute();

        $row = $stmt->fetch();

        return (int) ($row['total'] ?? 0);
    }

    /**
     * Ambil berita berdasarkan pagination.
     * Berita terbaru berada di depan.
     */
    public function getPaginated($limit, $offset)
    {
        $conn = $this->db->getConnection();

        $limit = max(1, (int) $limit);
        $offset = max(0, (int) $offset);

        $sql = "
            SELECT
                id,
                judul,
                deskripsi,
                isi,
                foto,
                views,
                created_at,
                updated_at
            FROM berita
            ORDER BY created_at DESC, id DESC
            LIMIT :limit OFFSET :offset
        ";

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll();
    }

    /**
     * Ambil satu berita berdasarkan ID.
     */
    public function getById($id)
    {
        $conn = $this->db->getConnection();

        $stmt = $conn->prepare(
            "SELECT
                id,
                judul,
                deskripsi,
                isi,
                foto,
                views,
                created_at,
                updated_at
             FROM berita
             WHERE id = :id
             LIMIT 1"
        );

        $stmt->execute([
            ':id' => (int) $id
        ]);

        $result = $stmt->fetch();

        return $result ?: null;
    }

    /**
     * Ambil berita terbaru untuk Beranda.
     */
    public function getLatest($limit = 4)
    {
        $conn = $this->db->getConnection();

        $limit = max(1, (int) $limit);

        $stmt = $conn->prepare(
            "SELECT
                id,
                judul,
                deskripsi,
                isi,
                foto,
                views,
                created_at,
                updated_at
             FROM berita
             ORDER BY created_at DESC, id DESC
             LIMIT :limit"
        );

        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    /**
     * Ambil berita lainnya selain ID tertentu.
     */
    public function getLatestExcept($excludeId, $limit = 3)
    {
        $conn = $this->db->getConnection();

        $limit = max(1, (int) $limit);

        $stmt = $conn->prepare(
            "SELECT
                id,
                judul,
                deskripsi,
                isi,
                foto,
                views,
                created_at,
                updated_at
             FROM berita
             WHERE id <> :exclude_id
             ORDER BY created_at DESC, id DESC
             LIMIT :limit"
        );

        $stmt->bindValue(
            ':exclude_id',
            (int) $excludeId,
            PDO::PARAM_INT
        );

        $stmt->bindValue(
            ':limit',
            $limit,
            PDO::PARAM_INT
        );

        $stmt->execute();

        return $stmt->fetchAll();
    }

    /**
     * Tambah berita baru.
     */
    public function create($judul, $deskripsi, $isi, $foto)
    {
        $conn = $this->db->getConnection();

        $stmt = $conn->prepare(
            "INSERT INTO berita
                (judul, deskripsi, isi, foto, views)
             VALUES
                (:judul, :deskripsi, :isi, :foto, 0)"
        );

        return $stmt->execute([
            ':judul' => $judul,
            ':deskripsi' => $deskripsi,
            ':isi' => $isi,
            ':foto' => $foto
        ]);
    }

    /**
     * Update berita.
     *
     * Jika $foto null, foto lama dipertahankan.
     */
    public function update(
        $id,
        $judul,
        $deskripsi,
        $isi,
        $foto = null
    ) {
        $conn = $this->db->getConnection();

        if ($foto !== null) {
            $stmt = $conn->prepare(
                "UPDATE berita
                 SET
                    judul = :judul,
                    deskripsi = :deskripsi,
                    isi = :isi,
                    foto = :foto
                 WHERE id = :id"
            );

            return $stmt->execute([
                ':id' => (int) $id,
                ':judul' => $judul,
                ':deskripsi' => $deskripsi,
                ':isi' => $isi,
                ':foto' => $foto
            ]);
        }

        $stmt = $conn->prepare(
            "UPDATE berita
             SET
                judul = :judul,
                deskripsi = :deskripsi,
                isi = :isi
             WHERE id = :id"
        );

        return $stmt->execute([
            ':id' => (int) $id,
            ':judul' => $judul,
            ':deskripsi' => $deskripsi,
            ':isi' => $isi
        ]);
    }

    /**
     * Hapus berita berdasarkan ID.
     */
    public function delete($id)
    {
        $conn = $this->db->getConnection();

        $stmt = $conn->prepare(
            "DELETE FROM berita
             WHERE id = :id"
        );

        $stmt->execute([
            ':id' => (int) $id
        ]);

        return $stmt->rowCount() > 0;
    }

    /**
     * Tambah jumlah views satu berita.
     */
    public function incrementViews($id)
    {
        $conn = $this->db->getConnection();

        $stmt = $conn->prepare(
            "UPDATE berita
             SET views = views + 1
             WHERE id = :id"
        );

        return $stmt->execute([
            ':id' => (int) $id
        ]);
    }
}