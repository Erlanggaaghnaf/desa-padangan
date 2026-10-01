<?php
// Panggil koneksi database menggunakan core/Database.php dari folder app/views/admin/ (naik dua tingkat)
require_once __DIR__ . '/../../core/Database.php';

$db = new Database();
$conn =$db->getConnection();

// --- PROSES UPDATE STATUS ---
if (isset($_GET['update_id']) && isset($_GET['status'])) {
    $id_update = (int)$_GET['update_id'];
    $status_baru =$_GET['status'];
    
    $stmt_update =$conn->prepare("UPDATE pengaduan SET status = :status WHERE id = :id");
    $stmt_update->execute([':status' => $status_baru, ':id' =>$id_update]);
    
    // Mendeteksi base_url secara dinamis
    $protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http");
    $base_url = $protocol . "://" . $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');

    // Redirect kembali menggunakan sistem rute admin
    header("Location: " . $base_url . "/index.php?url=admin/pengaduan");
    exit();
}

// --- AMBIL DATA DARI DATABASE ---
$stmt =$conn->prepare("SELECT * FROM pengaduan ORDER BY created_at DESC");
$stmt->execute();
$rows =$stmt->fetchAll();

$data_array = [];
foreach ($rows as $row) {$tanggal_formatted = date('d M Y', strtotime($row['created_at']));$data_array[] = [
        'id'     => $row['id'],
        'date'   => $tanggal_formatted,
        'name'   => $row['nama'],
        'phone'  => $row['kontak'],
        'title'  => $row['judul'],
        'detail' => $row['isi'],
        'status' => $row['status'],
        'foto'   => $row['foto']
    ];
}

$json_data = json_encode($data_array);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pengaduan - Administrator Desa Padangan</title>
    <!-- Favicon Logo Desa (Path disesuaikan ke public/assets/images/logo.png) -->
    <link rel="icon" type="image/png" href="/desa-padangan/public/assets/images/logo.png">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-[#F4F6F9] flex h-screen overflow-hidden">

    <!-- MEMANGGIL KOMPONEN SIDEBAR (Path: app/views/components/admin/admin_sidebar.php) -->
    <?php include __DIR__ . '/../components/admin/admin_sidebar.php'; ?>

    <!-- KONTEN UTAMA KANAN -->
    <main class="flex-1 flex flex-col h-screen overflow-y-auto md:ml-64 transition-all">
        
        <!-- Header Atas -->
        <header class="bg-white border-b border-gray-200 px-4 md:px-8 py-4 flex justify-between items-center sticky top-0 z-30 shadow-xs">
            <div class="flex items-center gap-3">
                <button onclick="toggleSidebar()" class="md:hidden text-gray-700 hover:text-[#2F855A] focus:outline-none p-1 rounded-lg border border-gray-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>
                <div>
                    <h1 class="text-base md:text-xl font-extrabold text-[#172033]">Manajemen Pengaduan</h1>
                    <p class="text-[11px] md:text-xs text-gray-500">Kelola dan pantau pengaduan masyarakat Desa Padangan.</p>
                </div>
            </div>
            <div class="text-right">
                <p id="current-date" class="text-xs font-bold text-gray-700">Memuat tanggal...</p>
                <p id="current-time" class="text-[10px] md:text-[11px] text-gray-400 mt-0.5">--:--:-- WIB</p>
            </div>
        </header>

        <!-- Area Konten Utama -->
        <div class="p-4 md:p-8 space-y-6 max-w-7xl w-full mx-auto">
            
            <!-- Baris 1: Kartu Ringkasan (Total & Selesai) disamakan seperti Dashboard -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Card 1: Total Pengaduan -->
                <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm flex justify-between items-center">
                    <div>
                        <div class="flex items-center gap-5 mb-2">
                            <div class="w-16 h-16 rounded-xl bg-emerald-50 text-[#2F855A] flex items-center justify-center">
                                <svg width="34" height="36" viewBox="0 0 34 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.64286 20.3571C6.64286 24.8082 8.08652 29.1392 10.7571 32.7C11.3027 33.4275 12.115 33.9084 13.0151 34.037C13.9153 34.1656 14.8297 33.9313 15.5571 33.3857C16.2846 32.8401 16.7655 32.0279 16.8941 31.1277C17.0227 30.2276 16.7884 29.3132 16.2429 28.5857C14.4624 26.2118 13.5 23.3245 13.5 20.3571M10.0714 6.64286V20.3571M15.2143 6.64286C20.4281 6.77717 25.5238 5.07858 29.6143 1.84286C29.869 1.65184 30.1718 1.53552 30.4889 1.50693C30.806 1.47834 31.1248 1.53861 31.4095 1.68098C31.6943 1.82336 31.9337 2.04222 32.1011 2.31303C32.2685 2.58385 32.3571 2.89592 32.3571 3.21429V23.7857C32.3571 24.1041 32.2685 24.4162 32.1011 24.687C31.9337 24.9578 31.6943 25.1766 31.4095 25.319C31.1248 25.4614 30.806 25.5217 30.4889 25.4931C30.1718 25.4645 29.869 25.3482 29.6143 25.1571C25.5238 21.9214 20.4281 20.2228 15.2143 20.3571H4.92857C4.01926 20.3571 3.14719 19.9959 2.50421 19.3529C1.86122 18.71 1.5 17.8379 1.5 16.9286V10.0714C1.5 9.16212 1.86122 8.29005 2.50421 7.64706C3.14719 7.00408 4.01926 6.64286 4.92857 6.64286H15.2143Z" stroke="#2F855A" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-gray-500 mb-1">Total Pengaduan</p>
                                <h3 id="statTotal" class="text-4xl font-extrabold text-[#172033]">0</h3>
                            </div>
                        </div>
                        <p class="text-[11px] text-gray-400 mt-5 flex items-center gap-1.5">
                            <span>
                                <svg width="17" height="18" viewBox="0 0 17 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5.00016 0.833008V3.33301M11.6668 0.833008V3.33301M0.833496 6.66634H15.8335M2.50016 1.66634H14.1668C15.0873 1.66634 15.8335 2.41253 15.8335 3.33301V14.9997C15.8335 15.9201 15.0873 16.6663 14.1668 16.6663H2.50016C1.57969 16.6663 0.833496 15.9201 0.833496 14.9997V3.33301C0.833496 2.41253 1.57969 1.66634 2.50016 1.66634Z" stroke="#475467" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                            <span id="card-date-text-1">Memuat tanggal...</span>
                        </p>
                    </div>
                </div>

                <!-- Card 2: Telah Diselesaikan -->
                <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm flex justify-between items-center">
                    <div>
                        <div class="flex items-center gap-5 mb-2">
                            <div class="w-16 h-16 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">
                                <svg width="37" height="35" viewBox="0 0 37 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M33 14.898V29.5C33 30.4283 32.6313 31.3185 31.9749 31.9749C31.3185 32.6312 30.4283 33 29.5 33H5C4.07174 33 3.1815 32.6312 2.52513 31.9749C1.86875 31.3185 1.5 30.4283 1.5 29.5V5C1.5 4.07174 1.86875 3.1815 2.52513 2.52513C3.1815 1.86875 4.07174 1.5 5 1.5H26.602M12 15.5L17.25 20.75L34.75 3.25" stroke="#2563B8" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-gray-500 mb-1">Telah Diselesaikan</p>
                                <h3 id="statSelesai" class="text-4xl font-extrabold text-[#172033]">0</h3>
                            </div>
                        </div>
                        <p class="text-[11px] text-gray-400 mt-5 flex items-center gap-1.5">
                            <span>
                                <svg width="17" height="18" viewBox="0 0 17 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5.00016 0.833008V3.33301M11.6668 0.833008V3.33301M0.833496 6.66634H15.8335M2.50016 1.66634H14.1668C15.0873 1.66634 15.8335 2.41253 15.8335 3.33301V14.9997C15.8335 15.9201 15.0873 16.6663 14.1668 16.6663H2.50016C1.57969 16.6663 0.833496 15.9201 0.833496 14.9997V3.33301C0.833496 2.41253 1.57969 1.66634 2.50016 1.66634Z" stroke="#475467" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                            <span id="card-date-text-2">Memuat tanggal...</span>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Baris 2: Tabel Manajemen Pengaduan -->
            <div class="bg-white p-4 md:p-6 rounded-2xl border border-gray-200 shadow-xs space-y-4">
                
                <!-- Filter Pencarian dan Status -->
                <div class="flex flex-col md:flex-row justify-between items-center gap-3">
                    <div class="relative w-full md:w-96">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </span>
                        <input type="text" id="searchInput" oninput="handleSearch()" placeholder="Cari berdasarkan nama pelapor atau isi pengaduan..." 
                               class="w-full pl-10 pr-4 py-2 border border-gray-200 rounded-xl text-xs focus:outline-none focus:border-[#2F855A] text-gray-700 placeholder-gray-400">
                    </div>

                    <div class="relative w-full md:w-48">
                        <select id="statusFilter" onchange="handleFilter()" class="w-full appearance-none bg-white border border-gray-200 rounded-xl px-3 py-2 text-xs font-medium text-gray-700 focus:outline-none focus:border-[#2F855A] cursor-pointer">
                            <option value="">Status (Semua)</option>
                            <option value="Selesai">Selesai</option>
                            <option value="Belum Ditangani">Belum Ditangani</option>
                        </select>
                        <span class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </span>
                    </div>
                </div>

                <!-- Tabel Data Dinamis -->
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-[#2F855A] text-white text-xs font-semibold">
                                <th class="p-3.5 rounded-l-xl w-12 text-center">
                                    <input type="checkbox" id="selectAll" onclick="toggleSelectAll(this)" class="rounded accent-[#2F855A] cursor-pointer">
                                </th>
                                <th class="p-3.5">Tanggal</th>
                                <th class="p-3.5">Nama Pelapor</th>
                                <th class="p-3.5">Judul / Detail Laporan</th>
                                <th class="p-3.5">Status</th>
                                <th class="p-3.5 rounded-r-xl text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="complaintTableBody" class="text-xs text-gray-700 divide-y divide-gray-100">
                            <!-- Data dimuat secara dinamis via JavaScript -->
                        </tbody>
                    </table>
                </div>

                <!-- Pagination Dinamis -->
                <div class="pt-4 flex items-center justify-center gap-2" id="paginationContainer">
                    <button onclick="prevPage()" class="w-9 h-9 flex items-center justify-center border border-gray-200 rounded-xl text-gray-600 hover:bg-gray-50 transition-colors cursor-pointer">&larr;</button>
                    <div id="pageNumbers" class="flex gap-1.5 items-center">
                        <!-- Nomor halaman digenerate otomatis -->
                    </div>
                    <button onclick="nextPage()" class="w-9 h-9 flex items-center justify-center border border-gray-200 rounded-xl text-gray-600 hover:bg-gray-50 transition-colors cursor-pointer">&rarr;</button>
                </div>

            </div>

        </div>
    </main>

    <!-- ========================================== -->
    <!-- MODAL POPUP: DETAIL & UBAH STATUS PENGADUAN -->
    <!-- ========================================== -->
    <div id="detailModal" class="fixed inset-0 bg-black/60 z-50 flex items-center justify-center p-4 hidden">
        <div class="bg-white rounded-3xl shadow-2xl max-w-4xl w-full max-h-[90vh] overflow-y-auto p-6 md:p-8 transform transition-all relative">
            
            <div class="flex justify-between items-center pb-4 border-b border-gray-100">
                <h3 class="text-lg font-extrabold text-[#172033]">Detail Pengaduan Masyarakat</h3>
                <button onclick="closeModal()" class="w-8 h-8 flex items-center justify-center text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-full transition-colors cursor-pointer">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                
                <div class="space-y-4">
                    <div class="bg-gray-50/70 border border-gray-200/80 rounded-2xl p-4 space-y-2">
                        <!-- Header Ikon dan Judul -->
                        <div class="flex items-center gap-3">
                            <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg" class="shrink-0">
                                <rect width="40" height="40" rx="8" fill="#E8F5EE"/>
                                <path d="M25.8334 27.5V25.8333C25.8334 24.9493 25.4822 24.1014 24.8571 23.4763C24.232 22.8512 23.3841 22.5 22.5001 22.5H17.5001C16.616 22.5 15.7682 22.8512 15.1431 23.4763C14.5179 24.1014 14.1667 24.9493 14.1667 25.8333V27.5M23.3334 15.8333C23.3334 17.6743 21.841 19.1667 20.0001 19.1667C18.1591 19.1667 16.6667 17.6743 16.6667 15.8333C16.6667 13.9924 18.1591 12.5 20.0001 12.5C21.841 12.5 23.3334 13.9924 23.3334 15.8333Z" stroke="#2F855A" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span class="text-xs font-bold text-gray-700">Identitas Pelapor</span>
                        </div>

                        <!-- Detail Informasi dengan jarak atas yang lebih rapat -->
                        <div class="text-xs space-y-1.5 text-gray-600 pl-[52px]">
                            <div class="flex justify-between">
                                <span class="text-gray-400">Nama Lengkap</span> 
                                <span id="modalName" class="font-semibold text-gray-800">-</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-400">Nomor HP/WA</span> 
                                <span id="modalPhone" class="font-semibold text-gray-800">-</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-400">Tanggal Pengaduan</span> 
                                <span id="modalDate" class="font-semibold text-gray-800">-</span>
                            </div>
                        </div>
                    </div>

                    <!-- Box Ubah Status Interaktif -->
                    <div class="bg-gray-50/70 border border-gray-200/80 rounded-2xl p-4 space-y-2">
                        <div class="flex items-center gap-2 text-xs font-bold text-gray-700">
                            <span>
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_1353_1635)">
                                <path d="M13.3334 7.49935L8.75008 12.0827L6.66675 9.99935M18.3334 9.99935C18.3334 14.6017 14.6025 18.3327 10.0001 18.3327C5.39771 18.3327 1.66675 14.6017 1.66675 9.99935C1.66675 5.39698 5.39771 1.66602 10.0001 1.66602C14.6025 1.66602 18.3334 5.39698 18.3334 9.99935Z" stroke="#2F855A" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                                </g>
                                <defs>
                                <clipPath id="clip0_1353_1635">
                                <rect width="20" height="20" fill="white"/>
                                </clipPath>
                                </defs>
                                </svg>
                            </span> Ubah Status Pengaduan</div>
                        <div class="pl-6 flex items-center gap-3">
                            <select id="modalStatusSelect" class="bg-white border border-gray-300 rounded-xl px-3 py-1.5 text-xs font-medium text-gray-700 focus:outline-none focus:border-[#2F855A]">
                                <option value="Belum Ditangani">Belum Ditangani</option>
                                <option value="Selesai">Selesai</option>
                            </select>
                            <button onclick="saveStatusChange()" class="bg-[#2F855A] hover:bg-[#246946] text-white text-xs font-semibold px-4 py-1.5 rounded-xl shadow-sm transition-all cursor-pointer">
                                Simpan Status
                            </button>
                        </div>
                    </div>

                    <div class="bg-gray-50/70 border border-gray-200/80 rounded-2xl p-4 space-y-2">
                        <!-- Header Ikon dan Judul -->
                        <div class="flex items-center gap-3">
                            <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg" class="shrink-0">
                                <rect width="40" height="40" rx="8" fill="#E8F5EE"/>
                                <path d="M25.8334 27.5V25.8333C25.8334 24.9493 25.4822 24.1014 24.8571 23.4763C24.232 22.8512 23.3841 22.5 22.5001 22.5H17.5001C16.616 22.5 15.7682 22.8512 15.1431 23.4763C14.5179 24.1014 14.1667 24.9493 14.1667 25.8333V27.5M23.3334 15.8333C23.3334 17.6743 21.841 19.1667 20.0001 19.1667C18.1591 19.1667 16.6667 17.6743 16.6667 15.8333C16.6667 13.9924 18.1591 12.5 20.0001 12.5C21.841 12.5 23.3334 13.9924 23.3334 15.8333Z" stroke="#2F855A" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span class="text-xs font-bold text-gray-700">Uraian Pengaduan</span>
                        </div>

                        <!-- Konten Teks Uraian (Tepat di bawah dengan padding kiri pl-[52px]) -->
                        <div class="space-y-1.5 pl-[52px]">
                            <p id="modalTitle" class="text-xs font-bold text-gray-800"></p>
                            <p id="modalDetail" class="text-xs text-gray-600 leading-relaxed">-</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50/70 border border-gray-200/80 rounded-2xl p-4 space-y-3 flex flex-col justify-between">
                    <div>
                        <div class="flex justify-between items-center mb-3">
                            <div class="flex items-center gap-2 text-xs font-bold text-gray-700">
                                 <span class="flex items-center gap-2">
                                    <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect width="40" height="40" rx="8" fill="#E4E2F0"/>
                                    <path d="M23.3333 15.001L16.3216 22.156C16.009 22.4686 15.8334 22.8926 15.8334 23.3347C15.8334 23.7768 16.009 24.2008 16.3216 24.5135C16.6342 24.8261 17.0582 25.0017 17.5004 25.0017C17.9425 25.0017 18.3665 24.8261 18.6791 24.5135L25.6908 17.3585C26.3159 16.7333 26.6671 15.8855 26.6671 15.0014C26.6671 14.1173 26.3159 13.2694 25.6908 12.6443C25.0656 12.0192 24.2178 11.668 23.3337 11.668C22.4496 11.668 21.6017 12.0192 20.9766 12.6443L13.9941 19.7701C13.5236 20.233 13.1494 20.7845 12.8931 21.3927C12.6368 22.001 12.5035 22.654 12.5008 23.314C12.4981 23.974 12.6261 24.628 12.8774 25.2384C13.1288 25.8487 13.4985 26.4032 13.9652 26.8699C14.4319 27.3366 14.9864 27.7063 15.5967 27.9576C16.207 28.209 16.8611 28.337 17.5211 28.3343C18.1811 28.3316 18.8341 28.1983 19.4423 27.942C20.0506 27.6857 20.602 27.3115 21.0649 26.841L28.0474 19.7151" stroke="#2563B8" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    Lampiran Foto
                                </span>
                            </div>
                            <span class="text-[11px] font-semibold bg-emerald-50 text-[#2F855A] px-2.5 py-0.5 rounded-full border border-emerald-200/60">Foto Bukti</span>
                        </div>
                        <div class="space-y-3 max-h-[360px] overflow-y-auto pr-2 flex flex-col gap-3 items-center bg-white rounded-xl border border-gray-200 p-4 pt-4">
                            <div id="modalImageBukti" class="flex flex-col gap-3 w-full items-center"></div>
                        </div>
                    </div>
                    <p class="text-[10px] text-gray-400 text-center pt-2 justify-center flex items-center gap-1.5">
                        <span>
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10.0003 13.3346V10.0013M10.0003 6.66797H10.0087M18.3337 10.0013C18.3337 14.6037 14.6027 18.3346 10.0003 18.3346C5.39795 18.3346 1.66699 14.6037 1.66699 10.0013C1.66699 5.39893 5.39795 1.66797 10.0003 1.66797C14.6027 1.66797 18.3337 5.39893 18.3337 10.0013Z" stroke="#2563B8" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>Dokumen foto resmi dari pelapor.</p>
                </div>

            </div>
        </div>
    </div>

    <!-- Skrip Logika Dinamis & Pagination -->
    <script>
        // Data dari Database PHP
        let complaintsData = <?php echo $json_data; ?>;

        let currentPage = 1;
        let rowsPerPage = 5; 
        let selectedComplaintId = null;

        function toggleSidebar() {
            const sidebar = document.getElementById('admin-sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }

        function renderTable() {
            const tbody = document.getElementById('complaintTableBody');
            const searchVal = document.getElementById('searchInput').value.toLowerCase();
            const statusVal = document.getElementById('statusFilter').value;

            // Filter data berdasarkan pencarian & status
            let filtered = complaintsData.filter(item => {
                const matchesSearch = item.name.toLowerCase().includes(searchVal) || item.detail.toLowerCase().includes(searchVal) || item.title.toLowerCase().includes(searchVal);
                const matchesStatus = (statusVal === "" || item.status === statusVal);
                return matchesSearch && matchesStatus;
            });

            // Update Statistik Atas
            document.getElementById('statTotal').innerText = complaintsData.length;
            document.getElementById('statSelesai').innerText = complaintsData.filter(i => i.status === 'Selesai').length;

            // Hitung Pagination
            let totalPages = Math.ceil(filtered.length / rowsPerPage) || 1;
            if (currentPage > totalPages) currentPage = totalPages;

            let start = (currentPage - 1) * rowsPerPage;
            let paginatedData = filtered.slice(start, start + rowsPerPage);

            // Render Baris Tabel
            tbody.innerHTML = '';
            if (paginatedData.length === 0) {
                tbody.innerHTML = `<tr><td colspan="6" class="p-6 text-center text-gray-400">Tidak ada data pengaduan ditemukan.</td></tr>`;
            } else {
                paginatedData.forEach(item => {
                let badgeClass = item.status === 'Selesai' 
                    ? 'bg-emerald-50 text-[#2F855A] border-emerald-200/60' 
                    : 'bg-amber-50 text-amber-700 border-amber-200/60';

                let isChecked = item.status === 'Selesai' ? 'checked' : '';

                tbody.innerHTML += `
                    <tr class="hover:bg-gray-50/80 transition-colors">
                        <!-- Checkbox interaktif untuk mengubah status secara langsung -->
                        <td class="p-3.5 text-center">
                            <input type="checkbox" class="row-checkbox rounded accent-[#2F855A] cursor-pointer" ${isChecked} onchange="ubahStatusCheckbox(${item.id}, this)">
                        </td>
                        <td class="p-3.5 whitespace-nowrap text-gray-600 font-medium">${item.date}</td>
                        <td class="p-3.5 font-semibold text-gray-900">${item.name}</td>
                        <td class="p-3.5 text-gray-600 max-w-xs">
                            <span class="font-bold text-gray-800 block truncate">${item.title}</span>
                            <span class="truncate block text-gray-500">${item.detail}</span>
                        </td>
                        <td class="p-3.5 whitespace-nowrap">
                            <span class="px-2.5 py-1 rounded-full text-[11px] font-medium border ${badgeClass}">${item.status}</span>
                        </td>
                        <td class="p-3.5 text-center  whitespace-nowrap">
                            <button onclick="openModal(${item.id})" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg border border-[#2F855A] text-[#2F855A] hover:bg-emerald-50 hover:text-[#2F855A] hover:border-emerald-200 transition-all font-medium cursor-pointer">
                            <span>
                            <svg width="15" height="11" viewBox="0 0 15 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0.875044 5.26824C0.819484 5.41792 0.819484 5.58256 0.875044 5.73224C1.41618 7.04434 2.33472 8.16621 3.51422 8.95564C4.69373 9.74507 6.08107 10.1665 7.50038 10.1665C8.91968 10.1665 10.307 9.74507 11.4865 8.95564C12.666 8.16621 13.5846 7.04434 14.1257 5.73224C14.1813 5.58256 14.1813 5.41792 14.1257 5.26824C13.5846 3.95614 12.666 2.83427 11.4865 2.04484C10.307 1.25541 8.91968 0.833984 7.50038 0.833984C6.08107 0.833984 4.69373 1.25541 3.51422 2.04484C2.33472 2.83427 1.41618 3.95614 0.875044 5.26824Z" stroke="#2F855A" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M7.50038 7.50024C8.60495 7.50024 9.50038 6.60481 9.50038 5.50024C9.50038 4.39567 8.60495 3.50024 7.50038 3.50024C6.39581 3.50024 5.50038 4.39567 5.50038 5.50024C5.50038 6.60481 6.39581 7.50024 7.50038 7.50024Z" stroke="#2F855A" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            </span> Lihat Detail
                            </button>
                        </td>
                    </tr>
                `;
            });
            }

            renderPaginationNumbers(totalPages);
        }

        function renderPaginationNumbers(totalPages) {
            const container = document.getElementById('pageNumbers');
            container.innerHTML = '';
            for (let i = 1; i <= totalPages; i++) {
                let activeClass = i === currentPage 
                    ? "bg-[#2F855A] text-white font-semibold shadow-sm" 
                    : "border border-gray-200 text-gray-700 hover:bg-gray-50 font-semibold";
                
                container.innerHTML += `<button onclick="goToPage(${i})" class="w-9 h-9 flex items-center justify-center rounded-xl transition-colors cursor-pointer ${activeClass}">${i}</button>`;
            }
        }

        function goToPage(page) {
            currentPage = page;
            renderTable();
        }

        function prevPage() {
            if (currentPage > 1) {
                currentPage--;
                renderTable();
            }
        }

        function nextPage() {
            const searchVal = document.getElementById('searchInput').value.toLowerCase();
            const statusVal = document.getElementById('statusFilter').value;
            let filtered = complaintsData.filter(item => {
                const matchesSearch = item.name.toLowerCase().includes(searchVal) || item.detail.toLowerCase().includes(searchVal) || item.title.toLowerCase().includes(searchVal);
                const matchesStatus = (statusVal === "" || item.status === statusVal);
                return matchesSearch && matchesStatus;
            });
            let totalPages = Math.ceil(filtered.length / rowsPerPage) || 1;

            if (currentPage < totalPages) {
                currentPage++;
                renderTable();
            }
        }

        function handleSearch() {
            currentPage = 1;
            renderTable();
        }

        function handleFilter() {
            currentPage = 1;
            renderTable();
        }

        // Modal Interaksi
        function openModal(id) {
            selectedComplaintId = id;
            const complaint = complaintsData.find(i => i.id === id);
            if (complaint) {
                document.getElementById('modalName').innerText = complaint.name;
                document.getElementById('modalPhone').innerText = complaint.phone;
                document.getElementById('modalDate').innerText = complaint.date;
                document.getElementById('modalTitle').innerText = complaint.title;
                document.getElementById('modalDetail').innerText = complaint.detail;
                document.getElementById('modalStatusSelect').value = complaint.status;
                
                // Menampilkan lampiran foto (bisa lebih dari satu)
                const containerFoto = document.getElementById('modalImageBukti'); // Ubah wadah jadi container
                containerFoto.innerHTML = '';

                if (complaint.foto && complaint.foto !== '') {
                    const fotoArray = complaint.foto.split(',');
                    // Di dalam fungsi openModal() pada bagian perulangan foto:
                    fotoArray.forEach(namaFoto => {
                        const img = document.createElement('img');
                        img.src = '/desa-padangan/public/uploads/pengaduan/' + namaFoto.trim();
                        // Ubah ukuran lebar menjadi w-full atau batasi max-w-sm agar rapi ke bawah
                        img.className = 'w-full max-w-xs h-48 object-cover rounded-xl shadow-xs border border-gray-200';
                        containerFoto.appendChild(img);
                    });
                } else {
                    containerFoto.innerHTML = '<span class="text-xs text-gray-400">Tidak ada lampiran foto.</span>';
                }

                document.getElementById('detailModal').classList.remove('hidden');
            }
        }

        function closeModal() {
            document.getElementById('detailModal').classList.add('hidden');
            selectedComplaintId = null;
        }

        function saveStatusChange() {
            if (selectedComplaintId !== null) {
                const newStatus = document.getElementById('modalStatusSelect').value;
                window.location.href = 'index.php?url=admin/pengaduan&update_id=' + selectedComplaintId + '&status=' + encodeURIComponent(newStatus);
            }
        }

        function ubahStatusCheckbox(id, checkbox) {
            const newStatus = checkbox.checked ? 'Selesai' : 'Belum Ditangani';
            window.location.href = 'index.php?url=admin/pengaduan&update_id=' + id + '&status=' + encodeURIComponent(newStatus);
        }

        function toggleSelectAll(source) {
            const checkboxes = document.querySelectorAll('.row-checkbox');
            checkboxes.forEach(cb => cb.checked = source.checked);
        }

       // --- SKRIP WAKTU REAL-TIME ---
        function updateDateTime() {
            const now = new Date();
            const optionsDate = { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' };
            const optionsTime = { hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false };
            
            const formattedDate = now.toLocaleDateString('id-ID', optionsDate);
            const formattedTime = now.toLocaleTimeString('id-ID', optionsTime) + ' WIB';

            // Header atas
            document.getElementById('current-date').innerText = formattedDate;
            document.getElementById('current-time').innerText = formattedTime;

            const cardDate1 = document.getElementById('card-date-text-1');
            const cardDate2 = document.getElementById('card-date-text-2');
            
            if (cardDate1) cardDate1.innerText = `Diperbarui ${formattedDate}`;
            if (cardDate2) cardDate2.innerText = `Diperbarui ${formattedDate}`;
        }

        // Inisialisasi awal saat halaman dimuat
        renderTable();
        updateDateTime();
        setInterval(updateDateTime, 1000);
    </script>
</body>
</html>