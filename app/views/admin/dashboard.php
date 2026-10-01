<?php
// Mencegah warning undefined variable di editor
$data = $data ?? ['statistik' => ['total' => 0, 'selesai' => 0]];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Administrator - Desa Padangan</title>
    <!-- Favicon Logo Desa -->
    <link rel="icon" type="image/png" href="/desa-padangan/public/assets/images/logo.png">
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
                        <h3 class="text-4xl font-extrabold text-[#172033]"><?= $data['statistik']['total']; ?></h3>
                        </div>
                        </div>
                        <p class="text-[11px] text-gray-400 mt-5 flex items-center gap-1.5">
                            <span>
                                <svg width="17" height="18" viewBox="0 0 17 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5.00016 0.833008V3.33301M11.6668 0.833008V3.33301M0.833496 6.66634H15.8335M2.50016 1.66634H14.1668C15.0873 1.66634 15.8335 2.41253 15.8335 3.33301V14.9997C15.8335 15.9201 15.0873 16.6663 14.1668 16.6663H2.50016C1.57969 16.6663 0.833496 15.9201 0.833496 14.9997V3.33301C0.833496 2.41253 1.57969 1.66634 2.50016 1.66634Z" stroke="#475467" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                            <!-- Berikan ID khusus di sini agar SVG tidak ikut terhapus -->
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
                        <h3 class="text-4xl font-extrabold text-[#172033]"><?= $data['statistik']['selesai']; ?></h3>
                        </div>
                        </div>
                        <p class="text-[11px] text-gray-400 mt-5 flex items-center gap-1.5">
                            <span>
                                <svg width="17" height="18" viewBox="0 0 17 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5.00016 0.833008V3.33301M11.6668 0.833008V3.33301M0.833496 6.66634H15.8335M2.50016 1.66634H14.1668C15.0873 1.66634 15.8335 2.41253 15.8335 3.33301V14.9997C15.8335 15.9201 15.0873 16.6663 14.1668 16.6663H2.50016C1.57969 16.6663 0.833496 15.9201 0.833496 14.9997V3.33301C0.833496 2.41253 1.57969 1.66634 2.50016 1.66634Z" stroke="#475467" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                            <!-- Berikan ID khusus di sini agar SVG tidak ikut terhapus -->
                            <span id="card-date-text-2">Memuat tanggal...</span>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Baris 2: Kotak Statistik Pengunjung & Grafik -->
            <div class="bg-white p-4 md:p-6 rounded-2xl border border-gray-200 shadow-xs space-y-6">
                
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                    <div class="flex items-center gap-3">
                        <span>
                            <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect width="48" height="48" rx="10" fill="#F2F8F4"/>
                                <path d="M15 15V31C15 31.5304 15.2107 32.0391 15.5858 32.4142C15.9609 32.7893 16.4696 33 17 33H33M19 23H27M19 28H22M19 18H31" stroke="#2F855A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span> 
                        <div>
                        <h4 class="text-base font-bold text-[#172033] flex items-center gap-2">
                            <span>Statistik Pengunjung</span>
                        </h4>
                        <p class="text-xs text-gray-500">Data kunjungan website Desa Padangan.</p>
                        </div>
                    </div>
                    <!-- Dropdown Pilihan Bulan/Semester Interaktif -->
                    <div class="flex items-center gap-2 border border-gray-200 rounded-xl px-3 py-1.5 text-xs font-medium text-gray-600 bg-gray-50">
                        <span>
                            <svg width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M4.16683 0.833008V2.83301M9.50016 0.833008V2.83301M0.833496 5.49967H12.8335M2.16683 1.49967H11.5002C12.2365 1.49967 12.8335 2.09663 12.8335 2.83301V12.1663C12.8335 12.9027 12.2365 13.4997 11.5002 13.4997H2.16683C1.43045 13.4997 0.833496 12.9027 0.833496 12.1663V2.83301C0.833496 2.09663 1.43045 1.49967 2.16683 1.49967Z" stroke="#667085" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                        <select onchange="changeSemester(this)" class="bg-transparent focus:outline-none cursor-pointer">
                            <option value="2" <?= (isset($data['selected_semester']) && $data['selected_semester'] == 2) ? 'selected' : ''; ?>>Juli 2026 - Des 2026</option>
                            <option value="1" <?= (isset($data['selected_semester']) && $data['selected_semester'] == 1) ? 'selected' : ''; ?>>Januari 2026 - Juni 2026</option>
                        </select>
                    </div>
                </div>

                <!-- 4 Sub-Kotak Statistik -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="bg-[#DDEFE4] p-4 rounded-xl border border-gray-100">
                        <p class="text-[14px] font-bold text-[#475467] mb-1">Total Kunjungan</p>
                        <h5 class="text-[28px] font-extrabold text-[#2F855A]"><?= number_format($data['visitor_stats']['total']); ?></h5>
                        <p class="text-[12px] text-gray-400 mt-1">Sepanjang waktu</p>
                    </div>
                    <div class="bg-blue-50 p-4 rounded-xl border border-gray-100">
                        <p class="text-[14px] font-bold text-[#172033] mb-1">Hari Ini</p>
                        <h5 class="text-[28px] font-extrabold text-[#2563B8]"><?= number_format($data['visitor_stats']['hari_ini']); ?></h5>
                        <p class="text-[12px] text-gray-400 mt-1">Kunjungan hari ini</p>
                    </div>
                    <div class="bg-blue-50 p-4 rounded-xl border border-gray-100">
                        <p class="text-[14px] font-bold text-[#172033] mb-1">Minggu Ini</p>
                        <h5 class="text-[28px] font-extrabold text-[#2563B8]"><?= number_format($data['visitor_stats']['minggu_ini']); ?></h5>
                        <p class="text-[12px] text-gray-400 mt-1">Kunjungan minggu ini</p>
                    </div>
                    <div class="bg-[#DDEFE4] p-4 rounded-xl border border-gray-100">
                        <p class="text-[14px] font-bold text-[#475467] mb-1">Bulan Ini</p>
                        <h5 class="text-[28px] font-extrabold text-[#2F855A]"><?= number_format($data['visitor_stats']['bulan_ini']); ?></h5>
                        <p class="text-[12px] text-gray-400 mt-1">Kunjungan bulan ini</p>
                    </div>
                </div>

                <div class="pt-4">
                    <p class="text-[16px] font-bold text-gray-700 mb-4">Tren Kunjungan Bulanan</p>
                    <div class="w-full h-72">
                        <canvas id="visitorChart"></canvas>
                    </div>
                </div>

            </div>

        </div>
    </main>

    <!-- Skrip Interaktif -->
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('admin-sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }

        // Menangkap data dinamis dari Controller PHP
        const chartLabels = <?= json_encode($data['chart_labels']); ?>;
        const chartDataValues = <?= json_encode($data['chart_data']); ?>;

        const ctx = document.getElementById('visitorChart').getContext('2d');
        const visitorChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: chartLabels,
                datasets: [{
                    label: 'Kunjungan',
                    data: chartDataValues,
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
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, grid: { color: '#F1F5F9' }, ticks: { font: { size: 11 } } },
                    x: { grid: { display: false }, ticks: { font: { size: 11 } } }
                }
            }
        });

     // Fungsi saat dropdown semester diubah
     function changeSemester(select) {
            const semester = select.value;
            window.location.href = 'index.php?url=admin/dashboard&semester=' + semester;
        }   

    function updateDateTime() {
                const now = new Date();
                const optionsDate = { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' };
                const optionsTime = { hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false };
                
                const formattedDate = now.toLocaleDateString('id-ID', optionsDate);
                const formattedTime = now.toLocaleTimeString('id-ID', optionsTime) + ' WIB';

                // Header atas
                document.getElementById('current-date').innerText = formattedDate;
                document.getElementById('current-time').innerText = formattedTime;

                // Tanggal di bawah kartu statistik pengaduan (Memperbarui teksnya saja, SVG aman)
                const cardDate1 = document.getElementById('card-date-text-1');
                const cardDate2 = document.getElementById('card-date-text-2');
                
                if (cardDate1) cardDate1.innerText = `Diperbarui ${formattedDate}`;
                if (cardDate2) cardDate2.innerText = `Diperbarui ${formattedDate}`;
            }
            
            updateDateTime();
            setInterval(updateDateTime, 1000);
</script>
</body>
</html>