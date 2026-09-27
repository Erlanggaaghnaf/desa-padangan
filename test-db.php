<?php

require_once __DIR__ . '/app/core/Database.php';

try {
    $database = new Database();
    $pdo = $database->getConnection();

    echo "Koneksi database berhasil!";
} catch (Exception $e) {
    echo "Koneksi gagal: " . $e->getMessage();
}