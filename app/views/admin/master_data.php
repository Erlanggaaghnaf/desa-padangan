<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master Data - Desa Padangan</title>
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

    <!-- MEMANGGIL KOMPONEN SIDEBAR GLOBAL -->
    <?php include '../app/views/components/admin/admin_sidebar.php'; ?>

    <!-- KONTEN UTAMA KANAN -->
    <main class="flex-1 flex flex-col h-screen overflow-y-auto md:ml-64 transition-all">
        
        <!-- Header Atas -->
        <header class="bg-white border-b border-gray-200 px-4 md:px-8 py-4 flex justify-between items-center sticky top-0 z-30 shadow-xs">
            <div class="flex items-center gap-3">
                <button onclick="toggleSidebar()" class="md:hidden text-gray-700 hover:text-[#2F855A] focus:outline-none p-1 rounded-lg border border-gray-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>
                <div>
                    <h1 class="text-base md:text-xl font-extrabold text-[#172033]">Master Data</h1>
                    <p class="text-[11px] md:text-xs text-gray-500 hidden sm:block">Kelola data statistik desa dan dokumen PPID.</p>
                </div>
            </div>
            <div class="text-right">
                <p id="current-date" class="text-xs font-bold text-gray-700">Memuat tanggal...</p>
                <p id="current-time" class="text-[10px] md:text-[11px] text-gray-400 mt-0.5">--:--:-- WIB</p>
            </div>
        </header>

        <!-- Area Konten Master Data -->
        <div class="p-4 md:p-8 space-y-8 max-w-7xl w-full mx-auto">
            
            <!-- SECTION 1: DATA DESA (6 KARTU STATISTIK) -->
            <div>
                <h2 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-4">Data Desa</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    
                    <!-- 1. Kependudukan -->
                    <div class="bg-white rounded-2xl border border-gray-200 p-5 shadow-xs flex flex-col justify-between">
                        <div class="flex items-start gap-4 mb-6">
                            <div class="w-10 h-10 rounded-full bg-green-50 flex items-center justify-center text-[#2F855A] flex-shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-[#172033]">Kependudukan</h3>
                                <p class="text-xs text-gray-500 mt-1 leading-relaxed">Jumlah penduduk laki-laki dan perempuan Desa Padangan.</p>
                            </div>
                        </div>
                        <div class="flex justify-between items-end">
                            <span class="text-[11px] text-gray-400">Diperbarui 12 Sep 2026</span>
                            <button onclick="toggleModal('modalKependudukan')" class="bg-[#2F855A] hover:bg-green-700 text-white text-xs font-semibold px-4 py-2 rounded-lg transition-colors">Kelola &rarr;</button>
                        </div>
                    </div>

                    <!-- 2. Berdasarkan Umur -->
                    <div class="bg-white rounded-2xl border border-gray-200 p-5 shadow-xs flex flex-col justify-between">
                        <div class="flex items-start gap-4 mb-6">
                            <div class="w-10 h-10 rounded-full bg-green-50 flex items-center justify-center text-[#2F855A] flex-shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-[#172033]">Berdasarkan Umur</h3>
                                <p class="text-xs text-gray-500 mt-1 leading-relaxed">Jumlah penduduk berdasarkan kelompok umur.</p>
                            </div>
                        </div>
                        <div class="flex justify-between items-end">
                            <span class="text-[11px] text-gray-400">Diperbarui 10 Agu 2026</span>
                            <button onclick="toggleModal('modalUmur')" class="bg-[#2F855A] hover:bg-green-700 text-white text-xs font-semibold px-4 py-2 rounded-lg transition-colors">Kelola &rarr;</button>
                        </div>
                    </div>

                    <!-- 3. Pekerjaan -->
                    <div class="bg-white rounded-2xl border border-gray-200 p-5 shadow-xs flex flex-col justify-between">
                        <div class="flex items-start gap-4 mb-6">
                            <div class="w-10 h-10 rounded-full bg-green-50 flex items-center justify-center text-[#2F855A] flex-shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-[#172033]">Pekerjaan</h3>
                                <p class="text-xs text-gray-500 mt-1 leading-relaxed">Jumlah penduduk berdasarkan jenis pekerjaan.</p>
                            </div>
                        </div>
                        <div class="flex justify-between items-end">
                            <span class="text-[11px] text-gray-400">Diperbarui 12 Sep 2026</span>
                            <button onclick="toggleModal('modalPekerjaan')" class="bg-[#2F855A] hover:bg-green-700 text-white text-xs font-semibold px-4 py-2 rounded-lg transition-colors">Kelola &rarr;</button>
                        </div>
                    </div>

                    <!-- 4. Pendidikan -->
                    <div class="bg-white rounded-2xl border border-gray-200 p-5 shadow-xs flex flex-col justify-between">
                        <div class="flex items-start gap-4 mb-6">
                            <div class="w-10 h-10 rounded-full bg-green-50 flex items-center justify-center text-[#2F855A] flex-shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path></svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-[#172033]">Pendidikan</h3>
                                <p class="text-xs text-gray-500 mt-1 leading-relaxed">Jumlah penduduk berdasarkan tingkat pendidikan.</p>
                            </div>
                        </div>
                        <div class="flex justify-between items-end">
                            <span class="text-[11px] text-gray-400">Diperbarui 12 Sep 2026</span>
                            <button onclick="toggleModal('modalPendidikan')" class="bg-[#2F855A] hover:bg-green-700 text-white text-xs font-semibold px-4 py-2 rounded-lg transition-colors">Kelola &rarr;</button>
                        </div>
                    </div>

                    <!-- 5. Perkawinan -->
                    <div class="bg-white rounded-2xl border border-gray-200 p-5 shadow-xs flex flex-col justify-between">
                        <div class="flex items-start gap-4 mb-6">
                            <div class="w-10 h-10 rounded-full bg-green-50 flex items-center justify-center text-[#2F855A] flex-shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-[#172033]">Perkawinan</h3>
                                <p class="text-xs text-gray-500 mt-1 leading-relaxed">Jumlah penduduk berdasarkan status perkawinan.</p>
                            </div>
                        </div>
                        <div class="flex justify-between items-end">
                            <span class="text-[11px] text-gray-400">Diperbarui 27 Jul 2026</span>
                            <button onclick="toggleModal('modalPerkawinan')" class="bg-[#2F855A] hover:bg-green-700 text-white text-xs font-semibold px-4 py-2 rounded-lg transition-colors">Kelola &rarr;</button>
                        </div>
                    </div>

                    <!-- 6. Agama -->
                    <div class="bg-white rounded-2xl border border-gray-200 p-5 shadow-xs flex flex-col justify-between">
                        <div class="flex items-start gap-4 mb-6">
                            <div class="w-10 h-10 rounded-full bg-green-50 flex items-center justify-center text-[#2F855A] flex-shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"></path></svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-[#172033]">Agama</h3>
                                <p class="text-xs text-gray-500 mt-1 leading-relaxed">Jumlah penduduk berdasarkan agama yang dianut.</p>
                            </div>
                        </div>
                        <div class="flex justify-between items-end">
                            <span class="text-[11px] text-gray-400">Diperbarui 12 Jan 2026</span>
                            <button onclick="toggleModal('modalAgama')" class="bg-[#2F855A] hover:bg-green-700 text-white text-xs font-semibold px-4 py-2 rounded-lg transition-colors">Kelola &rarr;</button>
                        </div>
                    </div>

                </div>
            </div>

            <!-- SECTION 2: DOKUMEN PPID -->
            <div>
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-sm font-bold text-gray-400 uppercase tracking-wider">Dokumen PPID</h2>
                    <button onclick="toggleModal('modalTambahDokumen')" class="bg-[#2F855A] hover:bg-green-700 text-white text-xs font-semibold px-4 py-2.5 rounded-xl transition-colors flex items-center gap-2 shadow-xs">
                        <span>+</span> Tambah Dokumen
                    </button>
                </div>

                <!-- Tabel Dokumen Terintegrasi JavaScript untuk Pagination -->
                <div class="bg-white rounded-2xl border border-gray-200 shadow-xs overflow-x-auto min-h-[350px]">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-[#2F855A] text-white">
                            <tr>
                                <th class="px-6 py-4 font-semibold rounded-tl-2xl whitespace-nowrap">No.</th>
                                <th class="px-6 py-4 font-semibold whitespace-nowrap">Judul Dokumen</th>
                                <th class="px-6 py-4 font-semibold whitespace-nowrap">Tahun</th>
                                <th class="px-6 py-4 font-semibold whitespace-nowrap">File</th>
                                <th class="px-6 py-4 font-semibold whitespace-nowrap">Tanggal Upload</th>
                                <th class="px-6 py-4 font-semibold rounded-tr-2xl text-center whitespace-nowrap w-[150px]">Aksi</th>
                            </tr>
                        </thead>
                        <!-- Data Tabel Akan Dirender Melalui JS (renderTable) -->
                        <tbody id="table-body" class="divide-y divide-gray-100">
                        </tbody>
                    </table>
                </div>

                <!-- Navigasi / Pagination Dinamis -->
                <div id="pagination-container" class="flex items-center justify-center gap-2 mt-6">
                    <!-- Tombol Akan Dirender Melalui JS (renderPaginationUI) -->
                </div>

            </div>
        </div>
    </main>

    <!-- ======================================================================= -->
    <!-- MODAL POP-UP MASTER DATA                                                -->
    <!-- ======================================================================= -->

    <!-- 1. Modal Kependudukan -->
    <div id="modalKependudukan" class="hidden fixed inset-0 z-[100] bg-black/50 items-center justify-center p-4 backdrop-blur-sm">
        <div class="bg-white w-full max-w-lg rounded-2xl shadow-xl overflow-hidden relative">
            <div class="flex justify-between items-center p-6 border-b border-gray-100">
                <h3 class="text-lg font-bold text-[#172033]">Kelola Data Kependudukan</h3>
                <button onclick="toggleModal('modalKependudukan')" class="text-gray-400 hover:text-red-500 font-bold text-xl">&times;</button>
            </div>
            <div class="p-6">
                <h4 class="font-bold text-sm text-gray-700 mb-4">Jumlah Penduduk</h4>
                <div class="flex items-center justify-between mb-4">
                    <label class="text-sm font-semibold text-gray-600">Laki-laki<span class="text-red-500">*</span></label>
                    <div class="flex items-center gap-3">
                        <input type="number" id="inputLaki" oninput="hitungTotalPenduduk()" class="border border-gray-200 rounded-xl p-2.5 w-32 md:w-48 text-sm focus:ring-[#2F855A] outline-none" placeholder="0">
                        <span class="text-sm text-gray-500">orang</span>
                    </div>
                </div>
                <div class="flex items-center justify-between mb-6">
                    <label class="text-sm font-semibold text-gray-600">Perempuan<span class="text-red-500">*</span></label>
                    <div class="flex items-center gap-3">
                        <input type="number" id="inputPerempuan" oninput="hitungTotalPenduduk()" class="border border-gray-200 rounded-xl p-2.5 w-32 md:w-48 text-sm focus:ring-[#2F855A] outline-none" placeholder="0">
                        <span class="text-sm text-gray-500">orang</span>
                    </div>
                </div>
                <div class="flex items-center justify-between bg-gray-50 p-4 rounded-xl border border-gray-100">
                    <label class="text-sm font-bold text-[#172033]">Total Penduduk</label>
                    <div class="flex items-center gap-3">
                        <input type="number" id="inputTotal" class="border-none bg-gray-200 rounded-xl p-2.5 w-32 md:w-48 text-sm font-bold text-gray-600" value="0" readonly>
                        <span class="text-sm text-gray-500">orang</span>
                    </div>
                </div>
            </div>
            <div class="flex justify-end gap-3 p-6 border-t border-gray-100 bg-gray-50">
                <button onclick="toggleModal('modalKependudukan')" class="px-5 py-2.5 text-sm font-bold text-red-500 border border-red-200 bg-white rounded-xl hover:bg-red-50">Batal</button>
                <button onclick="validasiSimpan('modalKependudukan', ['inputLaki', 'inputPerempuan'])" class="px-5 py-2.5 text-sm font-bold text-white bg-[#2F855A] rounded-xl hover:bg-green-700 shadow-md">Simpan</button>
            </div>
        </div>
    </div>

    <!-- 2. Modal Umur -->
    <div id="modalUmur" class="hidden fixed inset-0 z-[100] bg-black/50 items-center justify-center p-4 backdrop-blur-sm">
        <div class="bg-white w-full max-w-lg rounded-2xl shadow-xl overflow-hidden relative max-h-[90vh] flex flex-col">
            <div class="flex justify-between items-center p-6 border-b border-gray-100">
                <h3 class="text-lg font-bold text-[#172033]">Kelola Data Berdasarkan Umur</h3>
                <button onclick="toggleModal('modalUmur')" class="text-gray-400 hover:text-red-500 font-bold text-xl">&times;</button>
            </div>
            <div class="p-6 overflow-y-auto space-y-3">
                <div class="grid grid-cols-2 gap-4 mb-2 border-b pb-2">
                    <h4 class="font-bold text-sm text-gray-700">Kelompok Umur</h4>
                    <h4 class="font-bold text-sm text-gray-700">Jumlah</h4>
                </div>
                <?php foreach(['< 3 Tahun', '3 - 6 Tahun', '7 - 12 Tahun', '13 - 15 Tahun', '16 - 18 Tahun', '19 - 25 Tahun', '26 - 59 Tahun', '> 59 Tahun'] as $item): ?>
                <div class="grid grid-cols-2 gap-4 items-center">
                    <span class="text-sm text-gray-600"><?= $item; ?></span>
                    <input type="number" class="input-umur border border-gray-200 rounded-lg p-2 text-sm focus:ring-[#2F855A] outline-none" placeholder="0">
                </div>
                <?php endforeach; ?>
            </div>
            <div class="flex justify-end gap-3 p-6 border-t border-gray-100 bg-gray-50">
                <button onclick="toggleModal('modalUmur')" class="px-5 py-2.5 text-sm font-bold text-red-500 border border-red-200 bg-white rounded-xl hover:bg-red-50">Batal</button>
                <button onclick="validasiSimpan('modalUmur', '.input-umur')" class="px-5 py-2.5 text-sm font-bold text-white bg-[#2F855A] rounded-xl hover:bg-green-700 shadow-md">Simpan</button>
            </div>
        </div>
    </div>

    <!-- 3. Modal Pekerjaan -->
    <div id="modalPekerjaan" class="hidden fixed inset-0 z-[100] bg-black/50 items-center justify-center p-4 backdrop-blur-sm">
        <div class="bg-white w-full max-w-lg rounded-2xl shadow-xl overflow-hidden relative max-h-[90vh] flex flex-col">
            <div class="flex justify-between items-center p-6 border-b border-gray-100">
                <h3 class="text-lg font-bold text-[#172033]">Kelola Data Pekerjaan</h3>
                <button onclick="toggleModal('modalPekerjaan')" class="text-gray-400 hover:text-red-500 font-bold text-xl">&times;</button>
            </div>
            <div class="p-6 overflow-y-auto space-y-3">
                <div class="grid grid-cols-2 gap-4 mb-2 border-b pb-2">
                    <h4 class="font-bold text-sm text-gray-700">Kategori</h4>
                    <h4 class="font-bold text-sm text-gray-700">Jumlah</h4>
                </div>
                <?php foreach(['Petani', 'PNS', 'Wiraswasta', 'Karyawan Swasta', 'Pelajar/Mahasiswa', 'Mengurus Rumah Tangga', 'Belum/Tidak Bekerja', 'Lain-lain'] as $item): ?>
                <div class="grid grid-cols-2 gap-4 items-center">
                    <span class="text-sm text-gray-600"><?= $item; ?></span>
                    <input type="number" class="input-pekerjaan border border-gray-200 rounded-lg p-2 text-sm focus:ring-[#2F855A] outline-none" placeholder="0">
                </div>
                <?php endforeach; ?>
            </div>
            <div class="flex justify-end gap-3 p-6 border-t border-gray-100 bg-gray-50">
                <button onclick="toggleModal('modalPekerjaan')" class="px-5 py-2.5 text-sm font-bold text-red-500 border border-red-200 bg-white rounded-xl hover:bg-red-50">Batal</button>
                <button onclick="validasiSimpan('modalPekerjaan', '.input-pekerjaan')" class="px-5 py-2.5 text-sm font-bold text-white bg-[#2F855A] rounded-xl hover:bg-green-700 shadow-md">Simpan</button>
            </div>
        </div>
    </div>

    <!-- 4. Modal Pendidikan -->
    <div id="modalPendidikan" class="hidden fixed inset-0 z-[100] bg-black/50 items-center justify-center p-4 backdrop-blur-sm">
        <div class="bg-white w-full max-w-lg rounded-2xl shadow-xl overflow-hidden relative max-h-[90vh] flex flex-col">
            <div class="flex justify-between items-center p-6 border-b border-gray-100">
                <h3 class="text-lg font-bold text-[#172033]">Kelola Data Pendidikan</h3>
                <button onclick="toggleModal('modalPendidikan')" class="text-gray-400 hover:text-red-500 font-bold text-xl">&times;</button>
            </div>
            <div class="p-6 overflow-y-auto space-y-3">
                <div class="grid grid-cols-2 gap-4 mb-2 border-b pb-2">
                    <h4 class="font-bold text-sm text-gray-700">Tingkat Pendidikan</h4>
                    <h4 class="font-bold text-sm text-gray-700">Jumlah</h4>
                </div>
                <?php foreach(['Belum/Tidak bersekolah', 'SD', 'SMP', 'SMA', 'Diploma', 'S1', 'S2', 'S3'] as $item): ?>
                <div class="grid grid-cols-2 gap-4 items-center">
                    <span class="text-sm text-gray-600"><?= $item; ?></span>
                    <input type="number" class="input-pendidikan border border-gray-200 rounded-lg p-2 text-sm focus:ring-[#2F855A] outline-none" placeholder="0">
                </div>
                <?php endforeach; ?>
            </div>
            <div class="flex justify-end gap-3 p-6 border-t border-gray-100 bg-gray-50">
                <button onclick="toggleModal('modalPendidikan')" class="px-5 py-2.5 text-sm font-bold text-red-500 border border-red-200 bg-white rounded-xl hover:bg-red-50">Batal</button>
                <button onclick="validasiSimpan('modalPendidikan', '.input-pendidikan')" class="px-5 py-2.5 text-sm font-bold text-white bg-[#2F855A] rounded-xl hover:bg-green-700 shadow-md">Simpan</button>
            </div>
        </div>
    </div>

    <!-- 5. Modal Perkawinan -->
    <div id="modalPerkawinan" class="hidden fixed inset-0 z-[100] bg-black/50 items-center justify-center p-4 backdrop-blur-sm">
        <div class="bg-white w-full max-w-lg rounded-2xl shadow-xl overflow-hidden relative max-h-[90vh] flex flex-col">
            <div class="flex justify-between items-center p-6 border-b border-gray-100">
                <h3 class="text-lg font-bold text-[#172033]">Kelola Data Perkawinan</h3>
                <button onclick="toggleModal('modalPerkawinan')" class="text-gray-400 hover:text-red-500 font-bold text-xl">&times;</button>
            </div>
            <div class="p-6 overflow-y-auto space-y-3">
                <div class="grid grid-cols-2 gap-4 mb-2 border-b pb-2">
                    <h4 class="font-bold text-sm text-gray-700">Status</h4>
                    <h4 class="font-bold text-sm text-gray-700">Jumlah</h4>
                </div>
                <?php foreach(['Belum kawin', 'Kawin', 'Cerai hidup', 'Cerai mati'] as $item): ?>
                <div class="grid grid-cols-2 gap-4 items-center">
                    <span class="text-sm text-gray-600"><?= $item; ?></span>
                    <input type="number" class="input-perkawinan border border-gray-200 rounded-lg p-2 text-sm focus:ring-[#2F855A] outline-none" placeholder="0">
                </div>
                <?php endforeach; ?>
            </div>
            <div class="flex justify-end gap-3 p-6 border-t border-gray-100 bg-gray-50">
                <button onclick="toggleModal('modalPerkawinan')" class="px-5 py-2.5 text-sm font-bold text-red-500 border border-red-200 bg-white rounded-xl hover:bg-red-50">Batal</button>
                <button onclick="validasiSimpan('modalPerkawinan', '.input-perkawinan')" class="px-5 py-2.5 text-sm font-bold text-white bg-[#2F855A] rounded-xl hover:bg-green-700 shadow-md">Simpan</button>
            </div>
        </div>
    </div>

    <!-- 6. Modal Agama -->
    <div id="modalAgama" class="hidden fixed inset-0 z-[100] bg-black/50 items-center justify-center p-4 backdrop-blur-sm">
        <div class="bg-white w-full max-w-lg rounded-2xl shadow-xl overflow-hidden relative max-h-[90vh] flex flex-col">
            <div class="flex justify-between items-center p-6 border-b border-gray-100">
                <h3 class="text-lg font-bold text-[#172033]">Kelola Data Agama</h3>
                <button onclick="toggleModal('modalAgama')" class="text-gray-400 hover:text-red-500 font-bold text-xl">&times;</button>
            </div>
            <div class="p-6 overflow-y-auto space-y-3">
                <div class="grid grid-cols-2 gap-4 mb-2 border-b pb-2">
                    <h4 class="font-bold text-sm text-gray-700">Agama</h4>
                    <h4 class="font-bold text-sm text-gray-700">Jumlah</h4>
                </div>
                <?php foreach(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'] as $item): ?>
                <div class="grid grid-cols-2 gap-4 items-center">
                    <span class="text-sm text-gray-600"><?= $item; ?></span>
                    <input type="number" class="input-agama border border-gray-200 rounded-lg p-2 text-sm focus:ring-[#2F855A] outline-none" placeholder="0">
                </div>
                <?php endforeach; ?>
            </div>
            <div class="flex justify-end gap-3 p-6 border-t border-gray-100 bg-gray-50">
                <button onclick="toggleModal('modalAgama')" class="px-5 py-2.5 text-sm font-bold text-red-500 border border-red-200 bg-white rounded-xl hover:bg-red-50">Batal</button>
                <button onclick="validasiSimpan('modalAgama', '.input-agama')" class="px-5 py-2.5 text-sm font-bold text-white bg-[#2F855A] rounded-xl hover:bg-green-700 shadow-md">Simpan</button>
            </div>
        </div>
    </div>

    <!-- 7. Modal Tambah Dokumen PPID -->
    <div id="modalTambahDokumen" class="hidden fixed inset-0 z-[100] bg-black/50 items-center justify-center p-4 backdrop-blur-sm">
        <div class="bg-white w-full max-w-xl rounded-2xl shadow-xl overflow-hidden relative">
            <div class="flex justify-between items-center p-6 border-b border-gray-100">
                <h3 class="text-lg font-bold text-[#172033]">Tambah Dokumen PPID</h3>
                <button onclick="toggleModal('modalTambahDokumen')" class="text-gray-400 hover:text-red-500 font-bold text-xl">&times;</button>
            </div>
            
            <div class="p-6 space-y-4">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Judul Dokumen<span class="text-red-500">*</span></label>
                    <input type="text" id="inputJudulDoc" class="w-full border border-gray-200 rounded-xl p-3 text-sm focus:ring-[#2F855A] outline-none" placeholder="Masukkan judul dokumen">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Deskripsi</label>
                    <textarea id="inputDescDoc" rows="3" class="w-full border border-gray-200 rounded-xl p-3 text-sm focus:ring-[#2F855A] outline-none resize-none" placeholder="Masukkan deskripsi"></textarea>
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Tahun Dokumen<span class="text-red-500">*</span></label>
                    <select id="inputTahunDoc" class="w-full border border-gray-200 rounded-xl p-3 text-sm focus:ring-[#2F855A] outline-none bg-white">
                        <option value="" disabled selected>Pilih Tahun</option>
                        <option value="2026">2026</option>
                        <option value="2025">2025</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">File Dokumen (PDF)<span class="text-red-500">*</span></label>
                    <input type="file" id="inputFileDoc" class="w-full border border-gray-200 rounded-xl p-2.5 text-sm bg-gray-50 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-[#2F855A] file:text-white hover:file:bg-green-700 cursor-pointer">
                </div>
            </div>

            <div class="flex justify-end gap-3 p-6 border-t border-gray-100 bg-gray-50">
                <button onclick="toggleModal('modalTambahDokumen')" class="px-5 py-2.5 text-sm font-bold text-red-500 border border-red-200 bg-white rounded-xl hover:bg-red-50">Batal</button>
                <button onclick="validasiSimpanDokumen()" class="px-5 py-2.5 text-sm font-bold text-white bg-[#2F855A] rounded-xl hover:bg-green-700 shadow-md">Simpan</button>
            </div>
        </div>
    </div>

    <!-- 8. Modal Edit Dokumen PPID -->
    <div id="modalEditDokumen" class="hidden fixed inset-0 z-[100] bg-black/50 items-center justify-center p-4 backdrop-blur-sm">
        <div class="bg-white w-full max-w-xl rounded-2xl shadow-xl overflow-hidden relative">
            <div class="flex justify-between items-center p-6 border-b border-gray-100">
                <h3 class="text-lg font-bold text-[#172033]">Edit Dokumen PPID</h3>
                <button onclick="toggleModal('modalEditDokumen')" class="text-gray-400 hover:text-red-500 font-bold text-xl">&times;</button>
            </div>
            
            <div class="p-6 space-y-4">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Judul Dokumen<span class="text-red-500">*</span></label>
                    <input type="text" id="editJudulDoc" class="w-full border border-gray-200 rounded-xl p-3 text-sm focus:ring-[#2F855A] outline-none">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Deskripsi</label>
                    <textarea id="editDescDoc" rows="3" class="w-full border border-gray-200 rounded-xl p-3 text-sm focus:ring-[#2F855A] outline-none resize-none"></textarea>
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Tahun Dokumen<span class="text-red-500">*</span></label>
                    <select id="editTahunDoc" class="w-full border border-gray-200 rounded-xl p-3 text-sm focus:ring-[#2F855A] outline-none bg-white">
                        <option value="2026">2026</option>
                        <option value="2025">2025</option>
                    </select>
                </div>
            </div>

            <div class="flex justify-end gap-3 p-6 border-t border-gray-100 bg-gray-50">
                <button onclick="toggleModal('modalEditDokumen')" class="px-5 py-2.5 text-sm font-bold text-red-500 border border-red-200 bg-white rounded-xl hover:bg-red-50">Batal</button>
                <button onclick="validasiEditDokumen()" class="px-5 py-2.5 text-sm font-bold text-white bg-[#2F855A] rounded-xl hover:bg-green-700 shadow-md">Simpan Perubahan</button>
            </div>
        </div>
    </div>

    <!-- 9. Modal Konfirmasi Simpan -->
    <div id="modalKonfirmasiSimpan" class="hidden fixed inset-0 z-[130] bg-black/50 items-center justify-center p-4 backdrop-blur-sm">
        <div class="bg-white w-full max-w-sm rounded-2xl shadow-xl p-6 text-center">
            <div class="w-16 h-16 bg-green-50 rounded-full flex items-center justify-center mx-auto mb-4 text-[#2F855A]">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            </div>
            <h3 class="text-lg font-bold text-[#172033] mb-2">Simpan Perubahan?</h3>
            <p class="text-sm text-gray-500 mb-6">Apakah Anda yakin ingin menyimpan data ini? Data akan ditampilkan pada halaman website.</p>
            <div class="flex justify-center gap-3">
                <button onclick="tutupKonfirmasi()" class="px-5 py-2.5 text-sm font-bold text-red-500 border border-red-200 bg-white rounded-xl hover:bg-red-50">Batal</button>
                <button onclick="eksekusiSimpan()" class="px-5 py-2.5 text-sm font-bold text-white bg-[#2F855A] rounded-xl hover:bg-green-700">Simpan</button>
            </div>
        </div>
    </div>

    <!-- 10. Modal Konfirmasi Hapus -->
    <div id="modalHapus" class="hidden fixed inset-0 z-[120] bg-black/50 items-center justify-center p-4 backdrop-blur-sm">
        <div class="bg-white w-full max-w-sm rounded-2xl shadow-xl p-6 text-center">
            <div class="w-16 h-16 bg-red-50 rounded-full flex items-center justify-center mx-auto mb-4 text-red-500">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
            </div>
            <h3 class="text-lg font-bold text-[#172033] mb-2">Hapus Dokumen?</h3>
            <p class="text-sm text-gray-500 mb-6">Apakah Anda yakin ingin menghapus dokumen ini?</p>
            <div class="flex justify-center gap-3">
                <button onclick="toggleModal('modalHapus')" class="px-5 py-2.5 text-sm font-bold text-red-500 border border-red-200 bg-white rounded-xl hover:bg-red-50">Batal</button>
                <button onclick="eksekusiHapus()" class="px-5 py-2.5 text-sm font-bold text-white bg-red-600 rounded-xl hover:bg-red-700">Hapus</button>
            </div>
        </div>
    </div>

    <!-- 11. Modal Peringatan Data Belum Lengkap -->
    <div id="modalPeringatan" class="hidden fixed inset-0 z-[140] bg-black/50 items-center justify-center p-4 backdrop-blur-sm">
        <div class="bg-white w-full max-w-sm rounded-2xl shadow-xl p-6 text-center relative">
            <button onclick="toggleModal('modalPeringatan')" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 text-xl">&times;</button>
            <div class="w-16 h-16 bg-red-50 rounded-full flex items-center justify-center mx-auto mb-4 text-red-500">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
            </div>
            <h3 class="text-lg font-bold text-[#172033] mb-2">Data Belum Lengkap</h3>
            <p class="text-sm text-gray-500 mb-6">Silakan lengkapi seluruh data wajib (*) sebelum menyimpan dokumen.</p>
            <button onclick="toggleModal('modalPeringatan')" class="w-full py-2.5 text-sm font-bold text-white bg-[#2F855A] rounded-xl hover:bg-green-700 transition-colors">OK</button>
        </div>
    </div>

    <!-- 12. Modal Preview / View Dokumen PPID -->
    <div id="modalPreview" class="hidden fixed inset-0 z-[120] bg-black/50 items-center justify-center p-4 backdrop-blur-sm">
        <div class="bg-white w-full max-w-2xl rounded-2xl shadow-xl overflow-hidden relative flex flex-col max-h-[90vh]">
            <div class="flex justify-between items-center p-6 border-b border-gray-100">
                <h3 id="previewTitle" class="text-lg font-bold text-[#172033]">Pratinjau Dokumen</h3>
                <button onclick="toggleModal('modalPreview')" class="text-gray-400 hover:text-red-500 font-bold text-xl">&times;</button>
            </div>
            <div class="p-6 flex-1 overflow-y-auto bg-gray-50 flex flex-col items-center justify-center text-center">
                <div class="w-16 h-20 bg-emerald-100 text-[#2F855A] rounded-xl flex items-center justify-center font-bold text-xs mb-3 shadow-sm">PDF</div>
                <p id="previewInfo" class="text-sm font-bold text-gray-800">Laporan Pemeriksaan Pekerjaan.pdf</p>
                <p class="text-xs text-gray-400 mt-1">Ukuran file: 2.4 MB</p>
                <div class="mt-6 w-full h-64 bg-white border border-gray-200 rounded-xl flex items-center justify-center text-gray-400 text-sm">
                    [ Simulasi Tampilan Dokumen PDF ]
                </div>
            </div>
            <div class="flex justify-end gap-3 p-4 border-t border-gray-100 bg-white">
                <button onclick="toggleModal('modalPreview')" class="px-5 py-2 text-sm font-bold text-gray-600 border border-gray-200 bg-white rounded-xl hover:bg-gray-50">Tutup</button>
            </div>
        </div>
    </div>

    <!-- SCRIPT INTERAKTIF & LOGIKA -->
    <script src="assets/js/master_data.js"></script>
</body>
</html>