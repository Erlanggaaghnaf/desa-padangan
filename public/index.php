<?php
// Memuat controller dasar dan controller Home
require_once '../app/core/Controller.php';
require_once '../app/controllers/Home.php';

// Menjalankan halaman beranda
$app = new Home();
$app->index();