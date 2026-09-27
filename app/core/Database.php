<?php

require_once __DIR__ . '/../config/config.php';

class Database
{
    private PDO $connection;

    public function __construct()
    {
        $dsn = 'mysql:host=' . DB_HOST .
               ';dbname=' . DB_NAME .
               ';charset=' . DB_CHARSET;

        try {
            $this->connection = new PDO(
                $dsn,
                DB_USER,
                DB_PASS,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ]
            );
        } catch (PDOException $e) {
            die('Koneksi database gagal: ' . $e->getMessage());
        }
    }

    public function getConnection(): PDO
    {
        return $this->connection;
    }
}