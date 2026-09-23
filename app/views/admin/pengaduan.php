<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pengaduan - Administrator Desa Padangan</title>
    <!-- Favicon Logo Desa -->
    <link rel="icon" type="image/png" href="assets/images/logo.png">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-[#F4F6F9] flex h-screen overflow-hidden">

    <!-- MEMANGGIL KOMPONEN SIDEBAR -->
    <?php include '../app/views/components/admin_sidebar.php'; ?>

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
            
            <!-- Baris 1: Kartu Ringkasan (Total & Selesai) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Card Total Pengaduan -->
                <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-xs flex justify-between items-center">
                    <div>
                        <p class="text-xs font-semibold text-gray-500 mb-1">Total Pengaduan</p>
                        <h3 id="statTotal" class="text-3xl font-extrabold text-[#172033]">0</h3>
                        <p class="text-[11px] text-gray-400 mt-3 flex items-center gap-1">
                            <span>📅</span> Diperbarui hari ini
                        </p>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-[#2F855A] flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                    </div>
                </div>

                <!-- Card Telah Diselesaikan -->
                <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-xs flex justify-between items-center">
                    <div>
                        <p class="text-xs font-semibold text-gray-500 mb-1">Telah Diselesaikan</p>
                        <h3 id="statSelesai" class="text-3xl font-extrabold text-[#172033]">0</h3>
                        <p class="text-[11px] text-gray-400 mt-3 flex items-center gap-1">
                            <span>📅</span> Diperbarui hari ini
                        </p>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
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
                                <th class="p-3.5">Detail Laporan</th>
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
                    <div class="bg-gray-50/70 border border-gray-200/80 rounded-2xl p-4 space-y-3">
                        <div class="flex items-center gap-2 text-xs font-bold text-gray-700">👤 Identitas Pelapor</div>
                        <div class="text-xs space-y-1.5 text-gray-600 pl-6">
                            <div class="flex justify-between"><span class="text-gray-400">Nama Lengkap</span> <span id="modalName" class="font-semibold text-gray-800">-</span></div>
                            <div class="flex justify-between"><span class="text-gray-400">Nomor HP/WA</span> <span id="modalPhone" class="font-semibold text-gray-800">-</span></div>
                            <div class="flex justify-between"><span class="text-gray-400">Tanggal Pengaduan</span> <span id="modalDate" class="font-semibold text-gray-800">-</span></div>
                        </div>
                    </div>

                    <!-- Box Ubah Status Interaktif -->
                    <div class="bg-gray-50/70 border border-gray-200/80 rounded-2xl p-4 space-y-2">
                        <div class="flex items-center gap-2 text-xs font-bold text-gray-700">🟢 Ubah Status Pengaduan</div>
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
                        <div class="flex items-center gap-2 text-xs font-bold text-gray-700">📝 Uraian Pengaduan</div>
                        <p id="modalDetail" class="text-xs text-gray-600 pl-6 leading-relaxed">-</p>
                    </div>
                </div>

                <div class="bg-gray-50/70 border border-gray-200/80 rounded-2xl p-4 space-y-3 flex flex-col justify-between">
                    <div>
                        <div class="flex justify-between items-center mb-3">
                            <div class="flex items-center gap-2 text-xs font-bold text-gray-700">📎 Lampiran Foto</div>
                            <span class="text-[11px] font-semibold bg-emerald-50 text-[#2F855A] px-2.5 py-0.5 rounded-full border border-emerald-200/60">Foto Bukti</span>
                        </div>
                        <div class="space-y-3 max-h-[360px] overflow-y-auto pr-1">
                            <img src="assets/images/Hero.png" alt="Lampiran Bukti" class="w-full h-44 object-cover rounded-xl border border-gray-200 shadow-xs">
                        </div>
                    </div>
                    <p class="text-[10px] text-gray-400 text-center pt-2">ℹ️ Dokumen foto resmi dari pelapor.</p>
                </div>

            </div>
        </div>
    </div>

    <!-- Skrip Logika Dinamis & Pagination -->
    <script>
        // Data Dummy Pengaduan (Bisa diubah/ditambah untuk menguji pagination)
        let complaintsData = [
            { id: 1, date: '17 Sep 2026', name: 'Siti Muslimah', phone: '+62 8763 4928 8363', detail: 'Jalan di depan balai desa terdapat lubang yang cukup besar dan mengganggu. Aspal sudah terkelupas dengan kedalaman 30 cm, sehingga membahayakan pengguna jalan terutama saat hujan.', status: 'Belum Ditangani' },
            { id: 2, date: '16 Sep 2026', name: 'Budi Santoso', phone: '+62 8123 4567 890', detail: 'Lampu penerangan jalan menuju Dusun Krajan sudah beberapa hari tidak menyala.', status: 'Selesai' },
            { id: 3, date: '05 Sep 2026', name: 'Ahmad Fauzi', phone: '+62 8567 8901 234', detail: 'Saluran air di Dusun Krajan tersumbat sehingga air meluber ke jalan.', status: 'Selesai' },
            { id: 4, date: '27 Agu 2026', name: 'Nur Aini', phone: '+62 8901 2345 678', detail: 'Terdapat tumpukan sampah yang belum diangkut di sekitar pasar desa.', status: 'Selesai' },
            { id: 5, date: '12 Agu 2026', name: 'Dwi Prasetyo', phone: '+62 8345 6789 012', detail: 'Beberapa bagian jalan desa rusak dan menjadi licin setelah hujan deras.', status: 'Belum Ditangani' },
            { id: 6, date: '02 Agu 2026', name: 'Rina Wijaya', phone: '+62 8211 2233 445', detail: 'Fasilitas bermain anak di lapangan desa perlu dicat ulang dan diperbaiki.', status: 'Belum Ditangani' },
            { id: 7, date: '28 Jul 2026', name: 'Joko Widodo', phone: '+62 8112 3344 556', detail: 'Pohon di pinggir jalan utama hampir tumbang dan membahayakan kabel listrik.', status: 'Selesai' }
        ];

        let currentPage = 1;
        let rowsPerPage = 3; // Menampilkan 3 data per halaman agar tombol pagination aktif
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
                const matchesSearch = item.name.toLowerCase().includes(searchVal) || item.detail.toLowerCase().includes(searchVal);
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

                    tbody.innerHTML += `
                        <tr class="hover:bg-gray-50/80 transition-colors">
                            <td class="p-3.5 text-center"><input type="checkbox" class="row-checkbox rounded accent-[#2F855A] cursor-pointer"></td>
                            <td class="p-3.5 whitespace-nowrap text-gray-600 font-medium">${item.date}</td>
                            <td class="p-3.5 font-semibold text-gray-900">${item.name}</td>
                            <td class="p-3.5 text-gray-600 max-w-xs truncate">${item.detail}</td>
                            <td class="p-3.5 whitespace-nowrap">
                                <span class="px-2.5 py-1 rounded-full text-[11px] font-medium border ${badgeClass}">${item.status}</span>
                            </td>
                            <td class="p-3.5 text-center whitespace-nowrap">
                                <button onclick="openModal(${item.id})" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg border border-gray-200 text-gray-700 hover:bg-emerald-50 hover:text-[#2F855A] hover:border-emerald-200 transition-all font-medium cursor-pointer"><span>👁️</span> Lihat Detail</button>
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
            // Hitung total halaman saat ini
            const searchVal = document.getElementById('searchInput').value.toLowerCase();
            const statusVal = document.getElementById('statusFilter').value;
            let filtered = complaintsData.filter(item => {
                const matchesSearch = item.name.toLowerCase().includes(searchVal) || item.detail.toLowerCase().includes(searchVal);
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
                document.getElementById('modalDetail').innerText = complaint.detail;
                document.getElementById('modalStatusSelect').value = complaint.status;
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
                const complaint = complaintsData.find(i => i.id === selectedComplaintId);
                if (complaint) {
                    complaint.status = newStatus;
                    renderTable();
                    closeModal();
                    alert("Status pengaduan berhasil diperbarui!");
                }
            }
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
            
            document.getElementById('current-date').innerText = now.toLocaleDateString('id-ID', optionsDate);
            document.getElementById('current-time').innerText = now.toLocaleTimeString('id-ID', optionsTime) + ' WIB';
        }

        // Inisialisasi awal saat halaman dimuat
        renderTable();
        updateDateTime();
        
        // Panggil ulang setiap detik (1000ms)
        setInterval(updateDateTime, 1000);
    </script>
</body>
</html>