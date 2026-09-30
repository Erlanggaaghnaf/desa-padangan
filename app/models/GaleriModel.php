<?php

class GaleriModel
{
    private $db;

    public function __construct()
    {
        require_once '../app/core/Database.php';
        $this->db = new Database();
    }

    public function getAll()
    {
        $conn = $this->db->getConnection();
        $stmt = $conn->prepare(
            "SELECT id, judul, foto, created_at, updated_at
             FROM galeri
             ORDER BY created_at DESC, id DESC"
        );
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function getCount()
    {
        $conn = $this->db->getConnection();
        $stmt = $conn->prepare("SELECT COUNT(*) AS total FROM galeri");
        $stmt->execute();

        return (int) $stmt->fetch()['total'];
    }

    public function getPaginated($limit, $offset)
    {
        $conn = $this->db->getConnection();
        $stmt = $conn->prepare(
            "SELECT id, judul, foto, created_at, updated_at
             FROM galeri
             ORDER BY created_at DESC, id DESC
             LIMIT :limit OFFSET :offset"
        );

        $stmt->bindValue(':limit', (int) $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function getById($id)
    {
        $conn = $this->db->getConnection();
        $stmt = $conn->prepare(
            "SELECT id, judul, foto, created_at, updated_at
             FROM galeri
             WHERE id = :id
             LIMIT 1"
        );
        $stmt->execute([':id' => (int) $id]);

        $data = $stmt->fetch();
        return $data ?: null;
    }

    public function create($judul, $foto)
    {
        $conn = $this->db->getConnection();
        $stmt = $conn->prepare(
            "INSERT INTO galeri (judul, foto)
             VALUES (:judul, :foto)"
        );

        $stmt->execute([
            ':judul' => $judul,
            ':foto' => $foto,
        ]);

        return (int) $conn->lastInsertId();
    }

    public function update($id, $judul, $foto = null)
    {
        $conn = $this->db->getConnection();

        if ($foto !== null) {
            $stmt = $conn->prepare(
                "UPDATE galeri
                 SET judul = :judul, foto = :foto
                 WHERE id = :id"
            );

            return $stmt->execute([
                ':judul' => $judul,
                ':foto' => $foto,
                ':id' => (int) $id,
            ]);
        }

        $stmt = $conn->prepare(
            "UPDATE galeri
             SET judul = :judul
             WHERE id = :id"
        );

        return $stmt->execute([
            ':judul' => $judul,
            ':id' => (int) $id,
        ]);
    }

    public function delete($id)
    {
        $conn = $this->db->getConnection();
        $stmt = $conn->prepare("DELETE FROM galeri WHERE id = :id");

        return $stmt->execute([':id' => (int) $id]);
    }
}
