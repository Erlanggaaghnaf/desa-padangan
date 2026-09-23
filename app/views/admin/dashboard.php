<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Administrator - Desa Padangan</title>
    <!-- Favicon Logo Desa -->
    <link rel="icon" type="image/png" href="assets/images/logo.png">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Chart.js untuk Grafik Tren Kunjungan -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-[#F4F6F9] flex h-screen overflow-hidden">

    <!-- MEMANGGIL KOMPONEN SIDEBAR -->
    <?php include '../app/views/components/admin_sidebar.php'; ?>

    <!-- KONTEN UTAMA KANAN (Diberi md:ml-64 agar ada ruang untuk sidebar di desktop) -->
    <main class="flex-1 flex flex-col h-screen overflow-y-auto md:ml-64 transition-all">
        
        <!-- Header Atas: Tombol Hamburger Mobile, Judul, & Tanggal -->
        <header class="bg-white border-b border-gray-200 px-4 md:px-8 py-4 flex justify-between items-center sticky top-0 z-30 shadow-xs">
            <div class="flex items-center gap-3">
                <!-- Tombol Hamburger untuk Membuka Sidebar di HP -->
                <button onclick="toggleSidebar()" class="md:hidden text-gray-700 hover:text-[#2F855A] focus:outline-none p-1 rounded-lg border border-gray-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>
                <div>
                    <h1 class="text-base md:text-xl font-extrabold text-[#172033]">Dashboard Administrator</h1>
                    <p class="text-[11px] md:text-xs text-gray-500 hidden sm:block">Pantau dan Kelola informasi Website Desa Padangan</p>
                </div>
            </div>
            <div class="text-right">
                <p id="current-date" class="text-xs font-bold text-gray-700">Memuat tanggal...</p>
                <p id="current-time" class="text-[10px] md:text-[11px] text-gray-400 mt-0.5">--:--:-- WIB</p>
            </div>
        </header>

        <!-- Area Kartu & Statistik -->
        <div class="p-4 md:p-8 space-y-6 max-w-7xl w-full mx-auto">
            
            <!-- Baris 1: Kartu Pengaduan & Selesai -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Card 1: Total Pengaduan -->
                <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-xs flex justify-between items-center">
                    <div>
                        <p class="text-xs font-semibold text-gray-500 mb-1">Total Pengaduan</p>
                        <h3 class="text-3xl font-extrabold text-[#172033]">150</h3>
                        <p class="text-[11px] text-gray-400 mt-3 flex items-center gap-1">
                            <span>📅</span> Diperbarui 12 September 2026
                        </p>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-[#2F855A] flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                    </div>
                </div>

                <!-- Card 2: Telah Diselesaikan -->
                <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-xs flex justify-between items-center">
                    <div>
                        <p class="text-xs font-semibold text-gray-500 mb-1">Telah Diselesaikan</p>
                        <h3 class="text-3xl font-extrabold text-[#172033]">12</h3>
                        <p class="text-[11px] text-gray-400 mt-3 flex items-center gap-1">
                            <span>📅</span> Diperbarui 12 September 2026
                        </p>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                </div>
            </div>

            <!-- Baris 2: Kotak Besar Statistik Pengunjung & Grafik -->
            <div class="bg-white p-4 md:p-6 rounded-2xl border border-gray-200 shadow-xs space-y-6">
                
                <!-- Header Statistik & Dropdown Bulan -->
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                    <div>
                        <h4 class="text-base font-bold text-[#172033] flex items-center gap-2">
                            <span>📊</span> Statistik Pengunjung
                        </h4>
                        <p class="text-xs text-gray-500">Data kunjungan website Desa Padangan.</p>
                    </div>
                    <!-- Dropdown Pilihan Bulan -->
                    <div class="flex items-center gap-2 border border-gray-200 rounded-xl px-3 py-1.5 text-xs font-medium text-gray-600 bg-gray-50">
                        <span>📅</span>
                        <select class="bg-transparent focus:outline-none cursor-pointer">
                            <option>Juli 2026 - Des 2026</option>
                            <option>Januari 2026 - Juni 2026</option>
                        </select>
                    </div>
                </div>

                <!-- 4 Sub-Kotak Statistik -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="bg-[#F8FAFC] p-4 rounded-xl border border-gray-100">
                        <p class="text-[11px] font-semibold text-gray-500 mb-1">Total Kunjungan</p>
                        <h5 class="text-xl font-bold text-[#172033]">12.581</h5>
                        <p class="text-[10px] text-gray-400 mt-1">Sepanjang waktu</p>
                    </div>
                    <div class="bg-[#F8FAFC] p-4 rounded-xl border border-gray-100">
                        <p class="text-[11px] font-semibold text-gray-500 mb-1">Hari Ini</p>
                        <h5 class="text-xl font-bold text-[#172033]">81</h5>
                        <p class="text-[10px] text-gray-400 mt-1">Kunjungan hari ini</p>
                    </div>
                    <div class="bg-[#F8FAFC] p-4 rounded-xl border border-gray-100">
                        <p class="text-[11px] font-semibold text-gray-500 mb-1">Minggu Ini</p>
                        <h5 class="text-xl font-bold text-[#172033]">320</h5>
                        <p class="text-[10px] text-gray-400 mt-1">Kunjungan minggu ini</p>
                    </div>
                    <div class="bg-[#F8FAFC] p-4 rounded-xl border border-gray-100">
                        <p class="text-[11px] font-semibold text-gray-500 mb-1">Bulan Ini</p>
                        <h5 class="text-xl font-bold text-[#172033]">1.024</h5>
                        <p class="text-[10px] text-gray-400 mt-1">Kunjungan bulan ini</p>
                    </div>
                </div>

                <!-- Grafik Kurva Bulanan -->
                <div class="pt-4">
                    <p class="text-xs font-bold text-gray-700 mb-4">Tren Kunjungan Bulanan</p>
                    <div class="w-full h-72">
                        <canvas id="visitorChart"></canvas>
                    </div>
                </div>

            </div>

        </div>
    </main>

    <!-- Skrip Interaktif: Toggle Sidebar Mobile & Grafik -->
    <script>
        // Fungsi Buka/Tutup Sidebar di HP
        function toggleSidebar() {
            const sidebar = document.getElementById('admin-sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }

        // Script Grafik Kurva Pengunjung (Chart.js)
        const ctx = document.getElementById('visitorChart').getContext('2d');
        const visitorChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                datasets: [{
                    label: 'Kunjungan',
                    data: [5000, 6200, 1024, 15800, 9000, 20000],
                    borderColor: '#2F855A',
                    backgroundColor: 'rgba(47, 133, 90, 0.05)',
                    borderWidth: 2.5,
                    fill: true,
                    tension: 0.35,
                    pointBackgroundColor: '#2F855A',
                    pointRadius: 4,
                    pointHoverRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: '#F1F5F9' },
                        ticks: { font: { size: 11 } }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { font: { size: 11 } }
                    }
                }
            }
        });

        // Script Waktu Nyata (Real-time dengan Detik)
        function updateDateTime() {
            const now = new Date();
            const optionsDate = { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' };
            // Menambahkan second: '2-digit' agar detik muncul
            const optionsTime = { hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false };
            
            document.getElementById('current-date').innerText = now.toLocaleDateString('id-ID', optionsDate);
            document.getElementById('current-time').innerText = now.toLocaleTimeString('id-ID', optionsTime) + ' WIB';
        }
        
        // Panggil fungsi saat pertama dimuat
        updateDateTime();
        
        // Perbarui setiap 1000 milidetik (1 detik)
        setInterval(updateDateTime, 1000);
    </script>
</body>
</html>