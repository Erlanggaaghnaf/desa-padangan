<?php
// Memuat controller dasar
require_once '../app/core/Controller.php';

// 1. Menangkap URL yang diminta pengunjung (jika kosong, default ke 'home')
$url = isset($_GET['url']) ? $_GET['url'] : 'home';

// Membersihkan URL
$url = rtrim($url, '/');
$url = filter_var($url, FILTER_SANITIZE_URL);
$url = explode('/', $url);

// 2. Format nama Controller (Huruf pertama wajib kapital, contoh: 'informasi' -> 'Informasi')
$controllerName = ucfirst($url[0]);

// 3. Cek apakah file Controller tersebut benar-benar ada di folder
if (file_exists('../app/controllers/' . $controllerName . '.php')) {
    // Jika ada, muat dan jalankan controllernya
    require_once '../app/controllers/' . $controllerName . '.php';
    $app = new $controllerName();
    $app->index();
} else {
    // Jika file tidak ditemukan (error 404), paksa kembali ke halaman Home
    require_once '../app/controllers/Home.php';
    $app = new Home();
    $app->index();
}