<?php
// index.php sekarang hanya bertugas sebagai Bootstrap (Pemanggil Pertama)

// 1. Panggil file inti (Core)
require_once '../app/core/App.php';
require_once '../app/core/Controller.php';

// 2. Jalankan Aplikasi
$app = new App();