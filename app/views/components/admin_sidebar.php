<?php
// Mendapatkan parameter URL saat ini untuk mendeteksi menu aktif
$current_url = $_GET['url'] ?? 'AdminDashboard';
?>

<!-- SIDEBAR UTAMA (Desktop & Mobile Drawer) -->
<aside id="admin-sidebar" class="fixed inset-y-0 left-0 z-50 w-64 bg-[#1B5E3A] text-white flex flex-col justify-between shadow-lg transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out">
    <div>
        <!-- Header Sidebar: Logo & Instansi -->
        <div class="p-5 flex items-center justify-between border-b border-emerald-800/60">
            <div class="flex items-center gap-3">
                <img src="assets/images/logo.png" alt="Logo" class="w-10 h-10 object-contain bg-white rounded-lg p-1">
                <div>
                    <h2 class="text-xs font-bold tracking-wide">Pemerintah Desa</h2>
                    <h2 class="text-xs font-bold tracking-wide">Padangan</h2>
                    <p class="text-[10px] text-emerald-200/80 mt-0.5">Kec. Ngantru, Kab. Tulungagung</p>
                </div>
            </div>
            <!-- Tombol Tutup Sidebar di Mobile -->
            <button onclick="toggleSidebar()" class="md:hidden text-emerald-200 hover:text-white focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>

        <!-- Menu Navigasi Sidebar (Dilengkapi pengecekan halaman aktif) -->
        <nav class="p-4 space-y-1.5 text-sm font-medium overflow-y-auto max-h-[calc(100vh-180px)]">
            
            <!-- Menu Dashboard Admin -->
            <a href="index.php?url=AdminDashboard" class="flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all <?= ($current_url == 'AdminDashboard') ? 'bg-white/20 text-white shadow-sm font-semibold' : 'text-emerald-100 hover:bg-white/10'; ?>">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                Dashboard Admin
            </a>

            <!-- Menu Manajemen Pengaduan -->
            <a href="index.php?url=AdminPengaduan" class="flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all <?= ($current_url == 'AdminPengaduan') ? 'bg-white/20 text-white shadow-sm font-semibold' : 'text-emerald-100 hover:bg-white/10'; ?>">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                Manajemen Pengaduan
            </a>

            <!-- Menu Manajemen Layanan -->
            <a href="index.php?url=AdminLayanan" class="flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all <?= ($current_url == 'AdminLayanan') ? 'bg-white/20 text-white shadow-sm font-semibold' : 'text-emerald-100 hover:bg-white/10'; ?>">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                Manajemen Layanan
            </a>

            <!-- Menu Manajemen Galeri -->
            <a href="index.php?url=AdminGaleri" class="flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all <?= ($current_url == 'AdminGaleri') ? 'bg-white/20 text-white shadow-sm font-semibold' : 'text-emerald-100 hover:bg-white/10'; ?>">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                Manajemen Galeri
            </a>

            <!-- Menu Manajemen Berita -->
            <a href="index.php?url=AdminBerita" class="flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all <?= ($current_url == 'AdminBerita') ? 'bg-white/20 text-white shadow-sm font-semibold' : 'text-emerald-100 hover:bg-white/10'; ?>">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                Manajemen Berita
            </a>

            <!-- Menu Manajemen Potensi Desa -->
            <a href="index.php?url=AdminPotensi" class="flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all <?= ($current_url == 'AdminPotensi') ? 'bg-white/20 text-white shadow-sm font-semibold' : 'text-emerald-100 hover:bg-white/10'; ?>">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064"></path></svg>
                Manajemen Potensi Desa
            </a>

            <!-- Menu Master Data -->
            <a href="index.php?url=AdminMaster" class="flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all <?= ($current_url == 'AdminMaster') ? 'bg-white/20 text-white shadow-sm font-semibold' : 'text-emerald-100 hover:bg-white/10'; ?>">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                Master Data
            </a>

        </nav>
    </div>

    <!-- Profil Admin & Tombol Keluar di Bawah Sidebar -->
    <div class="p-4 border-t border-emerald-800/60 space-y-3 bg-[#175333]">
        <div class="flex items-center gap-3 px-3 py-2 bg-emerald-900/40 rounded-xl">
            <div class="w-9 h-9 rounded-full bg-white/20 flex items-center justify-center font-bold text-white text-sm">
                A
            </div>
            <div>
                <p class="text-xs font-bold text-white">Admin</p>
                <p class="text-[10px] text-emerald-200">Administrator</p>
            </div>
        </div>
        <a href="index.php?url=AdminLogin" class="flex items-center gap-2 px-4 py-2 rounded-xl text-xs font-medium text-red-200 hover:bg-red-500/20 hover:text-white transition-all">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
            Keluar
        </a>
    </div>
</aside>

<!-- Overlay Gelap saat Sidebar Terbuka di HP -->
<div id="sidebar-overlay" onclick="toggleSidebar()" class="fixed inset-0 bg-black/50 z-40 hidden md:hidden transition-opacity"></div>