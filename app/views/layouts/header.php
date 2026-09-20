<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Resmi Desa Padangan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body class="bg-gray-50 text-gray-800 antialiased relative" style="font-family: 'Plus Jakarta Sans', sans-serif;">

    <!-- NAVBAR (Padding lg:px-[120px] agar konsisten dengan Figma) -->
    <nav id="main-navbar" class="fixed top-0 left-0 w-full z-50 flex justify-between items-center px-4 md:px-8 lg:px-[120px] py-4 text-white bg-transparent transition-all duration-300">
        <div class="flex items-center gap-2">
            <img src="assets/images/logo.png" alt="Logo" class="w-10 h-10 relative z-50">
            <div class="relative z-50">
                <h1 class="font-bold text-lg leading-none uppercase tracking-wider">Desa Padangan</h1>    
                <p class="text-sm">Kecamatan Ngantru</p>
            </div>
        </div>
        
        <!-- Menu Desktop -->
        <ul class="hidden md:flex gap-8 font-medium text-base">
            <li><a href="#" class="hover:text-green-300 transition-colors">Beranda</a></li>
            <li><a href="#" class="hover:text-green-300 transition-colors">Profil Desa</a></li>
            <li><a href="#" class="hover:text-green-300 transition-colors">SOTK</a></li>
            <li><a href="#" class="hover:text-green-300 transition-colors">Peta Wilayah</a></li>
            <li><a href="#" class="hover:text-green-300 transition-colors">Berita</a></li>
        </ul>
        
        <!-- Hamburger Icon (Mobile) -->
        <button id="hamburger-btn" class="md:hidden text-3xl focus:outline-none relative z-50 transition-colors">
            ☰
        </button>

        <!-- MENU MOBILE -->
        <div id="mobile-menu" class="absolute top-[70px] right-4 w-56 bg-[#2F855A] rounded-xl shadow-2xl flex flex-col gap-3 text-base font-semibold text-white transform opacity-0 scale-95 pointer-events-none transition-all duration-300 md:hidden p-5 z-40 border border-green-700">
            <a href="#" class="mobile-link hover:text-green-300 border-b border-green-700 pb-2">Beranda</a>
            <a href="#" class="mobile-link hover:text-green-300 border-b border-green-700 pb-2">Profil Desa</a>
            <a href="#" class="mobile-link hover:text-green-300 border-b border-green-700 pb-2">SOTK</a>
            <a href="#" class="mobile-link hover:text-green-300 border-b border-green-700 pb-2">Peta Wilayah</a>
            <a href="#" class="mobile-link hover:text-green-300">Berita</a>
        </div>
    </nav>