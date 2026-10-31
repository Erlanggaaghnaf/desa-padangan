
<?php

require_once __DIR__ . '/../core/Database.php';

class PengaduanModel
{
    private PDO $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function registerAttempt(string $ipHash): array
    {
        $now = new DateTimeImmutable(
            'now',
            new DateTimeZone('UTC')
        );

        $nowSql = $now->format('Y-m-d H:i:s');

        $this->db->beginTransaction();

        try {

            $insert = $this->db->prepare(
                "INSERT INTO pengaduan_rate_limits (
                    ip_hash,
                    window_15m_started_at,
                    attempts_15m,
                    window_24h_started_at,
                    attempts_24h
                ) VALUES (
                    :ip_hash,
                    :now_15m,
                    0,
                    :now_24h,
                    0
                )
                ON DUPLICATE KEY UPDATE
                    ip_hash = VALUES(ip_hash)"
            );
                        
            $insert->execute([
                ':ip_hash' => $ipHash,
                ':now_15m' => $nowSql,
                ':now_24h' => $nowSql,
            ]);

            $select = $this->db->prepare(
                "SELECT
                    ip_hash,
                    window_15m_started_at,
                    attempts_15m,
                    window_24h_started_at,
                    attempts_24h,
                    last_attempt_at,
                    last_submission_at
                 FROM pengaduan_rate_limits
                 WHERE ip_hash = :ip_hash
                 FOR UPDATE"
            );

            $select->execute([
                ':ip_hash' => $ipHash,
            ]);

            $row = $select->fetch(PDO::FETCH_ASSOC);

            if (!$row) {
                throw new RuntimeException(
                    'Baris rate limit tidak ditemukan.'
                );
            }

            $window15 = new DateTimeImmutable(
                $row['window_15m_started_at'],
                new DateTimeZone('UTC')
            );

            $window24 = new DateTimeImmutable(
                $row['window_24h_started_at'],
                new DateTimeZone('UTC')
            );

            $attempts15 = (int) $row['attempts_15m'];
            $attempts24 = (int) $row['attempts_24h'];

            // Reset penghitung setelah jendela waktu berakhir.
            if ($now->getTimestamp() - $window15->getTimestamp() >= 900) {
                $window15 = $now;
                $attempts15 = 0;
            }

            if ($now->getTimestamp() - $window24->getTimestamp() >= 86400) {
                $window24 = $now;
                $attempts24 = 0;
            }

            $updateState = function (
                int $count15,
                int $count24,
                ?string $lastAttempt
            ) use ($ipHash, $window15, $window24): void {
                $update = $this->db->prepare(
                    "UPDATE pengaduan_rate_limits
                     SET
                        window_15m_started_at = :window15,
                        attempts_15m = :count15,
                        window_24h_started_at = :window24,
                        attempts_24h = :count24,
                        last_attempt_at = :last_attempt,
                        updated_at = UTC_TIMESTAMP()
                     WHERE ip_hash = :ip_hash"
                );

                $update->execute([
                    ':window15' => $window15->format('Y-m-d H:i:s'),
                    ':count15' => $count15,
                    ':window24' => $window24->format('Y-m-d H:i:s'),
                    ':count24' => $count24,
                    ':last_attempt' => $lastAttempt,
                    ':ip_hash' => $ipHash,
                ]);
            };

            // Batas kecepatan untuk permintaan yang terlalu rapat.
            if (!empty($row['last_attempt_at'])) {
                $lastAttempt = new DateTimeImmutable(
                    $row['last_attempt_at'],
                    new DateTimeZone('UTC')
                );

                $elapsed = $now->getTimestamp()
                    - $lastAttempt->getTimestamp();

                if ($elapsed < 5) {
                    $updateState(
                        $attempts15,
                        $attempts24,
                        $row['last_attempt_at']
                    );

                    $this->db->commit();

                    return [
                        'allowed' => false,
                        'reason' => 'rapid',
                        'retry_after' => 5 - $elapsed,
                    ];
                }
            }

            // Batas percobaan 15 menit.
            if ($attempts15 >= 5) {
                $retry = max(
                    1,
                    900 - (
                        $now->getTimestamp()
                        - $window15->getTimestamp()
                    )
                );

                $updateState(
                    $attempts15,
                    $attempts24,
                    $row['last_attempt_at']
                );

                $this->db->commit();

                return [
                    'allowed' => false,
                    'reason' => 'limit_15m',
                    'retry_after' => $retry,
                ];
            }

            // Batas percobaan 24 jam.
            if ($attempts24 >= 15) {
                $retry = max(
                    1,
                    86400 - (
                        $now->getTimestamp()
                        - $window24->getTimestamp()
                    )
                );

                $updateState(
                    $attempts15,
                    $attempts24,
                    $row['last_attempt_at']
                );

                $this->db->commit();

                return [
                    'allowed' => false,
                    'reason' => 'limit_day',
                    'retry_after' => $retry,
                ];
            }

            // Catat percobaan sebelum validasi formulir selanjutnya.
            $attempts15++;
            $attempts24++;

            $updateState(
                $attempts15,
                $attempts24,
                $nowSql
            );

            // Cooldown berdasarkan pengaduan terakhir yang berhasil.
            if (!empty($row['last_submission_at'])) {
                $lastSubmission = new DateTimeImmutable(
                    $row['last_submission_at'],
                    new DateTimeZone('UTC')
                );

                $elapsed = $now->getTimestamp()
                    - $lastSubmission->getTimestamp();

                if ($elapsed < 120) {
                    $this->db->commit();

                    return [
                        'allowed' => false,
                        'reason' => 'cooldown',
                        'retry_after' => 120 - $elapsed,
                    ];
                }
            }

            $this->db->commit();

            // Pembersihan ringan untuk baris limiter yang sudah lama.
            if (mt_rand(1, 100) === 1) {
                try {
                    $cleanup = $this->db->prepare(
                        "DELETE FROM pengaduan_rate_limits
                         WHERE updated_at < NOW() - INTERVAL 7 DAY"
                    );

                    $cleanup->execute();
                } catch (Throwable $cleanupError) {
                    error_log(
                        'Rate-limit cleanup failed: '
                        . $cleanupError->getMessage()
                    );
                }
            }

            return [
                'allowed' => true,
                'reason' => '',
                'retry_after' => 0,
            ];
        } catch (Throwable $e) {
            if ($this->db->inTransaction()) {
                $this->db->rollBack();
            }

            throw $e;
        }
    }

    /**
     * Mencegah pengaduan dengan isi identik dari hash IP yang sama
     * disimpan berulang kali dalam 10 menit.
     */
    public function isDuplicateSubmission(
        string $ipHash,
        string $contentHash
    ): bool {
        $stmt = $this->db->prepare(
            "SELECT id
             FROM pengaduan
             WHERE ip_hash = :ip_hash
               AND content_hash = :content_hash
               AND created_at >= DATE_SUB(NOW(), INTERVAL 10 MINUTE)
             LIMIT 1"
        );

        $stmt->execute([
            ':ip_hash' => $ipHash,
            ':content_hash' => $contentHash,
        ]);

        return (bool) $stmt->fetchColumn();
    }

    /**
     * Parameter hash dibuat opsional supaya tetap kompatibel
     * dengan controller lama selama tahap transisi.
     */
    public function tambahPengaduan(
        $data,
        $string_nama_foto,
        ?string $ipHash = null,
        ?string $contentHash = null
    ): bool {
        $this->db->beginTransaction();

        try {
            if ($ipHash !== null && $contentHash !== null) {
                $sql = "INSERT INTO pengaduan (
                            nama,
                            kontak,
                            judul,
                            isi,
                            foto,
                            status,
                            ip_hash,
                            content_hash
                        ) VALUES (
                            :nama,
                            :kontak,
                            :judul,
                            :isi,
                            :foto,
                            'Belum Ditangani',
                            :ip_hash,
                            :content_hash
                        )";
            } else {
                // Jalur kompatibilitas untuk controller lama.
                $sql = "INSERT INTO pengaduan (
                            nama,
                            kontak,
                            judul,
                            isi,
                            foto,
                            status
                        ) VALUES (
                            :nama,
                            :kontak,
                            :judul,
                            :isi,
                            :foto,
                            'Belum Ditangani'
                        )";
            }

            $stmt = $this->db->prepare($sql);

            $params = [
                ':nama' => $data['nama'],
                ':kontak' => $data['kontak'],
                ':judul' => $data['judul'],
                ':isi' => $data['isi'],
                ':foto' => $string_nama_foto,
            ];

            if ($ipHash !== null && $contentHash !== null) {
                $params[':ip_hash'] = $ipHash;
                $params[':content_hash'] = $contentHash;
            }

            $stmt->execute($params);

            // Perbarui waktu pengaduan terakhir dalam transaksi yang sama.
            if ($ipHash !== null) {
                $update = $this->db->prepare(
                    "UPDATE pengaduan_rate_limits
                     SET
                        last_submission_at = UTC_TIMESTAMP(),
                        updated_at = UTC_TIMESTAMP()
                     WHERE ip_hash = :ip_hash"
                );

                $update->execute([
                    ':ip_hash' => $ipHash,
                ]);
            }

            $this->db->commit();

            return true;
        } catch (Throwable $e) {
            if ($this->db->inTransaction()) {
                $this->db->rollBack();
            }

            throw $e;
        }
    }

    public function getStatistikPengaduan(): array
    {
        $stmtTotal = $this->db->query(
            'SELECT COUNT(*) FROM pengaduan'
        );

        $total = (int) $stmtTotal->fetchColumn();

        $stmtSelesai = $this->db->prepare(
            "SELECT COUNT(*)
             FROM pengaduan
             WHERE status = 'Selesai'"
        );

        $stmtSelesai->execute();
        $selesai = (int) $stmtSelesai->fetchColumn();

        return [
            'total' => $total,
            'selesai' => $selesai,
        ];
    }
}
