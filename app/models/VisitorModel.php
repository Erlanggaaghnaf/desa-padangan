<?php

class VisitorModel {
    private $db;

    public function __construct() {
        require_once '../app/core/Database.php';
        $this->db = new Database();
    }

    /**
     * Catat kunjungan baru (mencegah duplikasi IP di hari yang sama)
     */
    public function recordVisitor() {
        $conn = $this->db->getConnection();
        
        // Ambil alamat IP pengunjung
        $ip = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
        $today = date('Y-m-d');

        // Cek apakah IP ini sudah tercatat hari ini
        $stmt = $conn->prepare("SELECT id FROM visitors WHERE ip_address = :ip AND visit_date = :today");
        $stmt->execute([':ip' => $ip, ':today' => $today]);

        if ($stmt->rowCount() === 0) {
            // Jika belum ada, masukkan sebagai kunjungan baru hari ini
            $insert = $conn->prepare("INSERT INTO visitors (ip_address, visit_date) VALUES (:ip, :today)");
            $insert->execute([':ip' => $ip, ':today' => $today]);
        }
    }

    /**
     * Ambil seluruh statistik kunjungan untuk Dashboard Admin & Visitor Card
     */
    public function getVisitorStats() {
        $conn = $this->db->getConnection();
        $today = date('Y-m-d');
        $startOfWeek = date('Y-m-d', strtotime('monday this week'));
        $startOfMonth = date('Y-m-01');

        // 1. Kunjungan Hari Ini
        $stmt_today = $conn->prepare("SELECT COUNT(DISTINCT ip_address) as total FROM visitors WHERE visit_date = :today");
        $stmt_today->execute([':today' => $today]);
        $hari_ini = $stmt_today->fetch()['total'];

        // 2. Kunjungan Minggu Ini
        $stmt_week = $conn->prepare("SELECT COUNT(DISTINCT ip_address) as total FROM visitors WHERE visit_date >= :start_week");
        $stmt_week->execute([':start_week' => $startOfWeek]);
        $minggu_ini = $stmt_week->fetch()['total'];

        // 3. Kunjungan Bulan Ini
        $stmt_month = $conn->prepare("SELECT COUNT(DISTINCT ip_address) as total FROM visitors WHERE visit_date >= :start_month");
        $stmt_month->execute([':start_month' => $startOfMonth]);
        $bulan_ini = $stmt_month->fetch()['total'];

        // 4. Total Keseluruhan (Sepanjang Waktu)
        $stmt_total = $conn->prepare("SELECT COUNT(*) as total FROM visitors");
        $stmt_total->execute();
        $total_sepanjang_waktu = $stmt_total->fetch()['total'];

        return [
            'hari_ini'   => $hari_ini,
            'minggu_ini' => $minggu_ini,
            'bulan_ini'  => $bulan_ini,
            'total'      => $total_sepanjang_waktu
        ];
    }

    /**
     * Ambil data statistik bulanan untuk grafik berdasarkan semester
     */
    public function getMonthlyStats($year = 2026, $semester = 2) {
        $conn = $this->db->getConnection();
        
        // Tentukan rentang bulan (Semester 1 atau Semester 2)
        $months = ($semester == 1) ? [1, 2, 3, 4, 5, 6] : [7, 8, 9, 10, 11, 12];
        $dataCounts = [];

        foreach ($months as $m) {
            $monthFormatted = str_pad($m, 2, '0', STR_PAD_LEFT);
            $stmt = $conn->prepare("SELECT COUNT(DISTINCT ip_address) as total FROM visitors WHERE YEAR(visit_date) = :year AND MONTH(visit_date) = :month");
            $stmt->execute([':year' => $year, ':month' => $monthFormatted]);
            $row = $stmt->fetch();
            $dataCounts[] = (int)($row['total'] ?? 0);
        }

        return $dataCounts;
    }
}