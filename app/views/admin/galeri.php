<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Galeri - Administrator Desa Padangan</title>
    <!-- Favicon Logo Desa -->
    <link rel="icon" type="image/png" href="assets/images/logo.png">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>
<body class="bg-[#F4F6F9] flex h-screen overflow-hidden" onclick="closeAllDropdowns(event)">

    <!-- MEMANGGIL KOMPONEN SIDEBAR -->
    <?php include '../app/views/components/admin/admin_sidebar.php'; ?>

    <!-- KONTEN UTAMA KANAN -->
    <main class="flex-1 flex flex-col h-screen overflow-y-auto md:ml-64 transition-all relative">
        
        <!-- Header Atas -->
        <header class="bg-white border-b border-gray-200 px-4 md:px-8 py-4 flex justify-between items-center sticky top-0 z-30 shadow-xs">
            <div class="flex items-center gap-3">
                <button onclick="toggleSidebar()" class="md:hidden text-gray-700 hover:text-[#2F855A] focus:outline-none p-1 rounded-lg border border-gray-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>
                <div>
                    <h1 class="text-base md:text-xl font-extrabold text-[#172033]">Manajemen Galeri Desa</h1>
                    <p class="text-[11px] md:text-xs text-gray-500">Kelola galeri dokumentasi kegiatan Desa Padangan.</p>
                </div>
            </div>
            <div class="text-right">
                <p id="current-date" class="text-xs font-bold text-gray-700">Memuat tanggal...</p>
                <p id="current-time" class="text-[10px] md:text-[11px] text-gray-400 mt-0.5">--:--:-- WIB</p>
            </div>
        </header>

        <!-- Area Konten Utama -->
        <div class="p-4 md:p-8 space-y-6 max-w-7xl w-full mx-auto pb-20">
            
            <!-- Grid Galeri -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-4 md:gap-6" id="galleryGrid">
                
                <!-- 1. Card Tambah Foto -->
                <div onclick="openModal('addModal')" class="bg-white border-2 border-dashed border-emerald-300 rounded-2xl flex flex-col items-center justify-center p-6 h-48 md:h-56 cursor-pointer hover:bg-emerald-50/50 transition-colors group">
                    <div class="w-12 h-12 rounded-full bg-emerald-50 text-[#2F855A] flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    </div>
                    <h4 class="text-xs font-bold text-gray-800">Tambahkan Foto Baru</h4>
                    <p class="text-[10px] text-gray-400 mt-1 text-center">Unggah foto dokumentasi<br>kegiatan desa</p>
                </div>

                <!-- 2. Item Galeri (Contoh Data 1) -->
                <div class="relative rounded-2xl overflow-hidden group h-48 md:h-56 shadow-sm border border-gray-200">
                    <img src="https://images.unsplash.com/photo-1522778119026-d647f0596c20?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Kegiatan" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                    
                    <!-- Judul Kiri Bawah -->
                    <div class="absolute bottom-4 left-4 right-4">
                        <h4 class="text-white text-xs md:text-sm font-bold truncate">Kegiatan Posyandu</h4>
                    </div>
                    
                    <!-- Tombol Opsi Kanan Atas -->
                    <div class="absolute top-3 right-3">
                        <button onclick="toggleDropdown(event, 'dropdown-1')" class="w-8 h-8 rounded-full bg-white/90 text-gray-700 flex items-center justify-center hover:bg-white shadow-sm dropdown-btn">
                            <svg class="w-5 h-5 pointer-events-none" fill="currentColor" viewBox="0 0 20 20"><path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"></path></svg>
                        </button>
                        <!-- Menu Dropdown -->
                        <div id="dropdown-1" class="dropdown-menu hidden absolute right-0 mt-2 w-32 bg-white rounded-xl shadow-lg border border-gray-100 z-10 overflow-hidden">
                            <button onclick="openEditModal('Kegiatan Posyandu', 'https://images.unsplash.com/photo-1522778119026-d647f0596c20?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80')" class="w-full text-left px-4 py-2.5 text-xs font-semibold text-gray-700 hover:bg-gray-50 flex items-center gap-2">
                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg> Edit
                            </button>
                            <button onclick="openModal('deleteModal')" class="w-full text-left px-4 py-2.5 text-xs font-semibold text-white bg-red-500 hover:bg-red-600 flex items-center gap-2 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg> Hapus
                            </button>
                        </div>
                    </div>
                </div>

                <!-- 3. Item Galeri (Contoh Data 2) -->
                <div class="relative rounded-2xl overflow-hidden group h-48 md:h-56 shadow-sm border border-gray-200">
                    <img src="https://images.unsplash.com/photo-1541829070764-84a7d30dd3f3?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Kegiatan" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                    <div class="absolute bottom-4 left-4 right-4">
                        <h4 class="text-white text-xs md:text-sm font-bold truncate">Kerja Bakti Warga</h4>
                    </div>
                    <div class="absolute top-3 right-3">
                        <button onclick="toggleDropdown(event, 'dropdown-2')" class="w-8 h-8 rounded-full bg-white/90 text-gray-700 flex items-center justify-center hover:bg-white shadow-sm dropdown-btn">
                            <svg class="w-5 h-5 pointer-events-none" fill="currentColor" viewBox="0 0 20 20"><path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"></path></svg>
                        </button>
                        <div id="dropdown-2" class="dropdown-menu hidden absolute right-0 mt-2 w-32 bg-white rounded-xl shadow-lg border border-gray-100 z-10 overflow-hidden">
                            <button onclick="openEditModal('Kerja Bakti Warga', 'https://images.unsplash.com/photo-1541829070764-84a7d30dd3f3?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80')" class="w-full text-left px-4 py-2.5 text-xs font-semibold text-gray-700 hover:bg-gray-50 flex items-center gap-2">
                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg> Edit
                            </button>
                            <button onclick="openModal('deleteModal')" class="w-full text-left px-4 py-2.5 text-xs font-semibold text-white bg-red-500 hover:bg-red-600 flex items-center gap-2 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg> Hapus
                            </button>
                        </div>
                    </div>
                </div>

                <!-- 4. Item Galeri (Contoh Data 3) -->
                <div class="relative rounded-2xl overflow-hidden group h-48 md:h-56 shadow-sm border border-gray-200">
                    <img src="https://images.unsplash.com/photo-1517457373958-b7bdd4587205?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Kegiatan" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                    <div class="absolute bottom-4 left-4 right-4">
                        <h4 class="text-white text-xs md:text-sm font-bold truncate">Musyawarah Desa</h4>
                    </div>
                    <div class="absolute top-3 right-3">
                        <button onclick="toggleDropdown(event, 'dropdown-3')" class="w-8 h-8 rounded-full bg-white/90 text-gray-700 flex items-center justify-center hover:bg-white shadow-sm dropdown-btn">
                            <svg class="w-5 h-5 pointer-events-none" fill="currentColor" viewBox="0 0 20 20"><path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"></path></svg>
                        </button>
                        <div id="dropdown-3" class="dropdown-menu hidden absolute right-0 mt-2 w-32 bg-white rounded-xl shadow-lg border border-gray-100 z-10 overflow-hidden">
                            <button onclick="openEditModal('Musyawarah Desa', 'https://images.unsplash.com/photo-1517457373958-b7bdd4587205?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80')" class="w-full text-left px-4 py-2.5 text-xs font-semibold text-gray-700 hover:bg-gray-50 flex items-center gap-2">
                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg> Edit
                            </button>
                            <button onclick="openModal('deleteModal')" class="w-full text-left px-4 py-2.5 text-xs font-semibold text-white bg-red-500 hover:bg-red-600 flex items-center gap-2 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg> Hapus
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Tambahkan item dummy lainnya di sini agar grid penuh sesuai screenshot -->

            </div>

            <!-- Pagination -->
            <div class="pt-8 flex items-center justify-center gap-2">
                <button class="w-9 h-9 flex items-center justify-center border border-gray-200 rounded-xl text-gray-400 hover:bg-gray-50 transition-colors cursor-not-allowed">&larr;</button>
                <button class="w-9 h-9 flex items-center justify-center rounded-xl bg-[#2F855A] text-white font-semibold shadow-sm">1</button>
                <button class="w-9 h-9 flex items-center justify-center border border-gray-200 rounded-xl text-gray-700 hover:bg-gray-50 font-semibold transition-colors">2</button>
                <button class="w-9 h-9 flex items-center justify-center border border-gray-200 rounded-xl text-gray-700 hover:bg-gray-50 font-semibold transition-colors">3</button>
                <button class="w-9 h-9 flex items-center justify-center border border-gray-200 rounded-xl text-gray-700 hover:bg-gray-50 font-semibold transition-colors">4</button>
                <button class="w-9 h-9 flex items-center justify-center border border-gray-200 rounded-xl text-gray-600 hover:bg-gray-50 transition-colors cursor-pointer">&rarr;</button>
            </div>

        </div>
    </main>

    <!-- ========================================================== -->
    <!-- LAYER MODAL (Z-INDEX DIATUR AGAR BISA BERTUMPUK) -->
    <!-- ========================================================== -->
    
    <!-- 1. Modal Tambah Foto (z-50) -->
    <div id="addModal" class="fixed inset-0 bg-black/60 z-40 flex items-center justify-center p-4 hidden opacity-0 transition-opacity duration-300">
        <div class="bg-white rounded-3xl shadow-2xl max-w-lg w-full p-6 md:p-8 transform scale-95 transition-transform duration-300 relative">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-extrabold text-[#172033]">Tambah Foto Galeri</h3>
                <button onclick="closeModal('addModal')" class="text-gray-400 hover:text-gray-600"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
            </div>
            
            <div class="space-y-5">
                <!-- Area Upload (Dashed) -->
                <div class="border-2 border-dashed border-gray-300 rounded-2xl flex flex-col items-center justify-center py-10 bg-gray-50 cursor-pointer hover:bg-gray-100 transition-colors">
                    <div class="w-12 h-12 rounded-full bg-white flex items-center justify-center text-gray-400 mb-3 shadow-xs">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    </div>
                    <p class="text-xs font-semibold text-gray-700">Upload Foto</p>
                    <p class="text-[10px] text-gray-400 mt-1">PNG, JPG atau JPEG - Maks. 5 MB</p>
                </div>

                <div>
                    <label class="block text-[11px] font-semibold text-gray-700 mb-1.5">Judul Kegiatan</label>
                    <input type="text" id="addInputJudul" placeholder="Contoh: Kegiatan Musyawarah Desa" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-xs focus:outline-none focus:border-[#2F855A]">
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 mt-8">
                <button onclick="closeModal('addModal')" class="px-5 py-2.5 rounded-xl border border-red-200 text-red-500 font-semibold text-xs hover:bg-red-50 transition-colors">Batal</button>
                <button onclick="validateAdd()" class="px-5 py-2.5 rounded-xl bg-[#2F855A] text-white font-semibold text-xs hover:bg-[#246946] shadow-sm transition-colors">Simpan</button>
            </div>
        </div>
    </div>

    <!-- 2. Modal Edit Foto (z-50) -->
    <div id="editModal" class="fixed inset-0 bg-black/60 z-40 flex items-center justify-center p-4 hidden opacity-0 transition-opacity duration-300">
        <div class="bg-white rounded-3xl shadow-2xl max-w-lg w-full p-6 md:p-8 transform scale-95 transition-transform duration-300 relative">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-extrabold text-[#172033]">Edit Foto Galeri</h3>
                <button onclick="closeModal('editModal')" class="text-gray-400 hover:text-gray-600"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
            </div>
            
            <div class="space-y-5">
                <!-- Preview Image -->
                <div class="relative w-full h-48 rounded-2xl overflow-hidden border border-gray-200 group cursor-pointer">
                    <img id="editImagePreview" src="" alt="Preview" class="w-full h-full object-cover group-hover:brightness-75 transition-all">
                    <!-- Icon Edit on hover overlay -->
                    <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                        <div class="bg-white/90 p-2 rounded-full text-gray-700 shadow-sm">
                           <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path></svg>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-[11px] font-semibold text-gray-700 mb-1.5">Judul Kegiatan</label>
                    <input type="text" id="editInputJudul" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-xs focus:outline-none focus:border-[#2F855A]">
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 mt-8">
                <button onclick="closeModal('editModal')" class="px-5 py-2.5 rounded-xl border border-red-200 text-red-500 font-semibold text-xs hover:bg-red-50 transition-colors">Batal</button>
                <button onclick="validateEdit()" class="px-5 py-2.5 rounded-xl bg-[#2F855A] text-white font-semibold text-xs hover:bg-[#246946] shadow-sm transition-colors">Simpan</button>
            </div>
        </div>
    </div>

    <!-- 3. Modal Hapus Konfirmasi (z-50) -->
    <div id="deleteModal" class="fixed inset-0 bg-black/60 z-50 flex items-center justify-center p-4 hidden opacity-0 transition-opacity duration-300">
        <div class="bg-white rounded-3xl shadow-2xl max-w-sm w-full p-6 text-center transform scale-95 transition-transform duration-300">
            <div class="w-16 h-16 rounded-full bg-red-50 flex items-center justify-center mx-auto mb-4 text-red-500 border border-red-100">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
            </div>
            <h3 class="text-lg font-extrabold text-[#172033] mb-2">Hapus Foto?</h3>
            <p class="text-xs text-gray-500 mb-6">Apakah Anda yakin ingin menghapus Foto ini?<br>Foto yang dihapus tidak dapat dikembalikan.</p>
            <div class="flex items-center justify-center gap-3">
                <button onclick="closeModal('deleteModal')" class="flex-1 py-2.5 rounded-xl border border-red-200 text-red-600 font-semibold text-xs hover:bg-red-50">Batal</button>
                <button onclick="closeModal('deleteModal')" class="flex-1 py-2.5 rounded-xl bg-red-600 text-white font-semibold text-xs hover:bg-red-700">Hapus</button>
            </div>
        </div>
    </div>

    <!-- ========================================================== -->
    <!-- LAYER MODAL KEDUA (z-60) -> OVERLAY DI ATAS MODAL PERTAMA -->
    <!-- ========================================================== -->
    
    <!-- 4. Modal Data Belum Lengkap (Error - z-60) -->
    <div id="errorModal" class="fixed inset-0 bg-black/40 z-[60] flex items-center justify-center p-4 hidden opacity-0 transition-opacity duration-300">
        <div class="bg-white rounded-3xl shadow-2xl max-w-sm w-full p-6 text-center transform scale-95 transition-transform duration-300 relative">
            <button onclick="closeModal('errorModal')" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
            <div class="w-16 h-16 rounded-full bg-red-50 flex items-center justify-center mx-auto mb-4 text-red-500 border border-red-100">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <h3 class="text-lg font-extrabold text-[#172033] mb-2">Data Belum Lengkap</h3>
            <p class="text-xs text-gray-500 mb-2">Silakan lengkapi seluruh data sebelum menyimpan foto.</p>
        </div>
    </div>

    <!-- 5. Modal Konfirmasi Simpan Tambah (z-60) -->
    <div id="confirmSaveModal" class="fixed inset-0 bg-black/40 z-[60] flex items-center justify-center p-4 hidden opacity-0 transition-opacity duration-300">
        <div class="bg-white rounded-3xl shadow-2xl max-w-sm w-full p-6 text-center transform scale-95 transition-transform duration-300">
            <div class="w-16 h-16 rounded-full bg-emerald-50 flex items-center justify-center mx-auto mb-4 text-[#2F855A] border border-emerald-100">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            </div>
            <h3 class="text-lg font-extrabold text-[#172033] mb-2">Simpan Foto?</h3>
            <p class="text-xs text-gray-500 mb-6">Apakah Anda yakin ingin menyimpan Foto ini?<br>Foto yang disimpan akan ditampilkan pada halaman galeri.</p>
            <div class="flex items-center justify-center gap-3">
                <button onclick="closeModal('confirmSaveModal')" class="flex-1 py-2.5 rounded-xl border border-red-200 text-red-600 font-semibold text-xs hover:bg-red-50">Batal</button>
                <button onclick="executeSave('addModal')" class="flex-1 py-2.5 rounded-xl bg-[#2F855A] text-white font-semibold text-xs hover:bg-[#246946]">Simpan</button>
            </div>
        </div>
    </div>

    <!-- 6. Modal Konfirmasi Simpan Perubahan Edit (z-60) -->
    <div id="confirmEditModal" class="fixed inset-0 bg-black/40 z-[60] flex items-center justify-center p-4 hidden opacity-0 transition-opacity duration-300">
        <div class="bg-white rounded-3xl shadow-2xl max-w-sm w-full p-6 text-center transform scale-95 transition-transform duration-300">
            <div class="w-16 h-16 rounded-full bg-emerald-50 flex items-center justify-center mx-auto mb-4 text-[#2F855A] border border-emerald-100">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            </div>
            <h3 class="text-lg font-extrabold text-[#172033] mb-2">Simpan Perubahan?</h3>
            <p class="text-xs text-gray-500 mb-6">Apakah Anda yakin ingin merubah Foto ini?<br>Foto yang disimpan akan ditampilkan pada halaman galeri.</p>
            <div class="flex items-center justify-center gap-3">
                <button onclick="closeModal('confirmEditModal')" class="flex-1 py-2.5 rounded-xl border border-red-200 text-red-600 font-semibold text-xs hover:bg-red-50">Batal</button>
                <button onclick="executeSave('editModal')" class="flex-1 py-2.5 rounded-xl bg-[#2F855A] text-white font-semibold text-xs hover:bg-[#246946]">Simpan</button>
            </div>
        </div>
    </div>


    <!-- SKRIP LOGIKA TAMPILAN -->
    <script>
        // --- 1. TOGGLE SIDEBAR ---
        function toggleSidebar() {
            const sidebar = document.getElementById('admin-sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }

        // --- 2. JAM REAL-TIME ---
        function updateDateTime() {
            const now = new Date();
            const optionsDate = { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' };
            const optionsTime = { hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false };
            
            document.getElementById('current-date').innerText = now.toLocaleDateString('id-ID', optionsDate);
            document.getElementById('current-time').innerText = now.toLocaleTimeString('id-ID', optionsTime) + ' WIB';
        }
        updateDateTime();
        setInterval(updateDateTime, 1000);

        // --- 3. MENU DROPDOWN PADA KARTU FOTO ---
        function toggleDropdown(event, dropdownId) {
            event.stopPropagation(); // Mencegah event merambat ke luar
            closeAllDropdowns(); // Tutup yang lain dulu
            const dropdown = document.getElementById(dropdownId);
            if(dropdown) {
                dropdown.classList.toggle('hidden');
            }
        }
        function closeAllDropdowns() {
            const dropdowns = document.querySelectorAll('.dropdown-menu');
            dropdowns.forEach(menu => menu.classList.add('hidden'));
        }

        // --- 4. ANIMASI BUKA/TUTUP MODAL UMUM ---
        function openModal(modalId) {
            closeAllDropdowns(); // Tutup opsi dropdown kalau ada yg terbuka
            const modal = document.getElementById(modalId);
            modal.classList.remove('hidden');
            setTimeout(() => {
                modal.classList.remove('opacity-0');
                modal.children[0].classList.remove('scale-95');
            }, 10);
        }

        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.classList.add('opacity-0');
            modal.children[0].classList.add('scale-95');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        }

        // --- 5. LOGIKA KHUSUS EDIT MODAL ---
        function openEditModal(judul, imgSrc) {
            closeAllDropdowns();
            document.getElementById('editInputJudul').value = judul;
            document.getElementById('editImagePreview').src = imgSrc;
            openModal('editModal');
        }

        // --- 6. LOGIKA VALIDASI (MUNCULKAN MODAL LAPISAN KEDUA) ---
        function validateAdd() {
            const judul = document.getElementById('addInputJudul').value;
            // Anggap gambar wajib, tapi untuk simulasi kita cek input teksnya saja
            if(judul.trim() === '') {
                openModal('errorModal'); // Modal Error Tampil Tumpang Tindih
            } else {
                openModal('confirmSaveModal'); // Modal Konfirmasi Tampil Tumpang Tindih
            }
        }

        function validateEdit() {
            const judul = document.getElementById('editInputJudul').value;
            if(judul.trim() === '') {
                openModal('errorModal'); 
            } else {
                openModal('confirmEditModal');
            }
        }

        function executeSave(sourceModalId) {
            // Tutup modal konfirmasi
            closeModal('confirmSaveModal');
            closeModal('confirmEditModal');
            
            // Tutup form utama
            closeModal(sourceModalId);

            // Bersihkan input jika dari form Tambah
            if(sourceModalId === 'addModal') {
                document.getElementById('addInputJudul').value = '';
            }
        }
    </script>
</body>
</html>