<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Resmi Desa Padangan</title>
    
    <?php 
    $protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http");
    $base_url = $protocol . "://" . $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
    ?>

    <link rel="icon" type="image/png" href="<?= $base_url; ?>/assets/images/logo.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= $base_url; ?>/assets/css/style.css?v=<?php echo time(); ?>">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
</head>
<body class="bg-gray-50 text-gray-800 antialiased relative " style="font-family: 'Plus Jakarta Sans', sans-serif;">

   <?php 
    // Deteksi halaman aktif secara akurat
    $current_page = isset($_GET['url']) ? rtrim($_GET['url'], '/') : 'home';
    $is_home = ($current_page === 'home' || $current_page === '');
    $nav_bg = $is_home ? 'bg-transparent' : 'bg-[#2F855A] shadow-md';
    ?>  

    <nav id="navbar" data-page="<?= $current_page; ?>" class="flex justify-between items-center fixed top-0 left-0 w-full z-50 transition-all duration-300 <?= $nav_bg; ?> px-4 py-4 md:px-8 lg:px-[120px] text-white">
        <div class="flex items-center gap-2">
            <img src="<?= $base_url; ?>/assets/images/logo.png" alt="Logo" class="w-10 h-10 relative z-50">
            <div class="relative z-50">
                <h1 class="font-bold text-lg leading-none uppercase tracking-wider">Desa Padangan</h1>    
                <p class="text-sm">Kecamatan Ngantru</p>
            </div>
        </div>
        
        <!-- Menu Desktop: Penghapusan prefiks "public/" -->
        <ul class="hidden md:flex gap-8 font-medium text-base">
            <li><a href="<?= $base_url; ?>/index.php?url=home" class="hover:text-green-300 transition-colors">Beranda</a></li>
            <li><a href="<?= $base_url; ?>/index.php?url=informasi" class="hover:text-green-300 transition-colors">Informasi Desa</a></li>
            <li><a href="<?= $base_url; ?>/index.php?url=data-desa" class="hover:text-green-300 transition-colors">Data Desa</a></li>
            <li><a href="<?= $base_url; ?>/index.php?url=layanan" class="hover:text-green-300 transition-colors">Layanan</a></li>
            <li><a href="<?= $base_url; ?>/index.php?url=berita" class="hover:text-green-300 transition-colors">Berita</a></li>
            <li><a href="<?= $base_url; ?>/index.php?url=galeri" class="hover:text-green-300 transition-colors">Galeri</a></li>
            <li><a href="<?= $base_url; ?>/index.php?url=ppid" class="hover:text-green-300 transition-colors">PPID</a></li>
        </ul>
        
        <button id="hamburger-btn" class="md:hidden text-3xl focus:outline-none relative z-50 transition-colors">☰</button>

        <!-- MENU MOBILE -->
        <div id="mobile-menu" class="absolute top-[70px] right-4 w-56 bg-[#2F855A] rounded-xl shadow-2xl flex flex-col gap-3 text-base font-semibold text-white transform opacity-0 scale-95 pointer-events-none transition-all duration-300 md:hidden p-5 z-40 border border-green-700">
            <a href="<?= $base_url; ?>/index.php?url=home" class="mobile-link hover:text-green-300 border-b border-green-700 pb-2">Beranda</a>
            <a href="<?= $base_url; ?>/index.php?url=informasi" class="mobile-link hover:text-green-300 border-b border-green-700 pb-2">Informasi Desa</a>
            <a href="<?= $base_url; ?>/index.php?url=data-desa" class="mobile-link hover:text-green-300 border-b border-green-700 pb-2">Data Desa</a>
            <a href="<?= $base_url; ?>/index.php?url=layanan" class="mobile-link hover:text-green-300 border-b border-green-700 pb-2">Layanan</a>
            <a href="<?= $base_url; ?>/index.php?url=berita" class="mobile-link hover:text-green-300 border-b border-green-700 pb-2">Berita</a>
            <a href="<?= $base_url; ?>/index.php?url=galeri" class="mobile-link hover:text-green-300 border-b border-green-700 pb-2">Galeri</a>
            <a href="<?= $base_url; ?>/index.php?url=ppid" class="mobile-link hover:text-green-300">PPID</a>
        </div>
    </nav>