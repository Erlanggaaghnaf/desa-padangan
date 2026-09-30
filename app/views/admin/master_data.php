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
                    
                    <!-- Card 1: Kependudukan -->
                    <div onclick="toggleModal('modalKependudukan')" class="bg-white p-6 rounded-2xl border border-gray-200 shadow-xs hover:border-[#2F855A] cursor-pointer transition-all group">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 rounded-xl bg-emerald-50 text-[#2F855A] flex items-center justify-center group-hover:bg-[#2F855A] group-hover:text-white transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            </div>
                            <span class="text-xs font-bold text-[#2F855A] bg-emerald-50 px-2.5 py-1 rounded-lg">Kelola</span>
                        </div>
                        <h3 class="text-base font-bold text-[#172033] mb-1">Data Kependudukan</h3>
                        <p class="text-xs text-gray-500">Atur jumlah penduduk Laki-laki dan Perempuan.</p>
                    </div>

                    <!-- Card 2: Kelompok Umur -->
                    <div onclick="toggleModal('modalUmur')" class="bg-white p-6 rounded-2xl border border-gray-200 shadow-xs hover:border-[#2F855A] cursor-pointer transition-all group">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 rounded-xl bg-emerald-50 text-[#2F855A] flex items-center justify-center group-hover:bg-[#2F855A] group-hover:text-white transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                            </div>
                            <span class="text-xs font-bold text-[#2F855A] bg-emerald-50 px-2.5 py-1 rounded-lg">Kelola</span>
                        </div>
                        <h3 class="text-base font-bold text-[#172033] mb-1">Kelompok Umur</h3>
                        <p class="text-xs text-gray-500">Atur statistik penduduk berdasarkan rentang usia.</p>
                    </div>

                    <!-- Card 3: Pekerjaan -->
                    <div onclick="toggleModal('modalPekerjaan')" class="bg-white p-6 rounded-2xl border border-gray-200 shadow-xs hover:border-[#2F855A] cursor-pointer transition-all group">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 rounded-xl bg-emerald-50 text-[#2F855A] flex items-center justify-center group-hover:bg-[#2F855A] group-hover:text-white transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </div>
                            <span class="text-xs font-bold text-[#2F855A] bg-emerald-50 px-2.5 py-1 rounded-lg">Kelola</span>
                        </div>
                        <h3 class="text-base font-bold text-[#172033] mb-1">Pekerjaan</h3>
                        <p class="text-xs text-gray-500">Atur statistik jenis mata pencaharian warga.</p>
                    </div>

                    <!-- Card 4: Pendidikan -->
                    <div onclick="toggleModal('modalPendidikan')" class="bg-white p-6 rounded-2xl border border-gray-200 shadow-xs hover:border-[#2F855A] cursor-pointer transition-all group">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 rounded-xl bg-emerald-50 text-[#2F855A] flex items-center justify-center group-hover:bg-[#2F855A] group-hover:text-white transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path></svg>
                            </div>
                            <span class="text-xs font-bold text-[#2F855A] bg-emerald-50 px-2.5 py-1 rounded-lg">Kelola</span>
                        </div>
                        <h3 class="text-base font-bold text-[#172033] mb-1">Pendidikan</h3>
                        <p class="text-xs text-gray-500">Atur data tingkat pendidikan penduduk.</p>
                    </div>

                    <!-- Card 5: Perkawinan -->
                    <div onclick="toggleModal('modalPerkawinan')" class="bg-white p-6 rounded-2xl border border-gray-200 shadow-xs hover:border-[#2F855A] cursor-pointer transition-all group">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 rounded-xl bg-emerald-50 text-[#2F855A] flex items-center justify-center group-hover:bg-[#2F855A] group-hover:text-white transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                            </div>
                            <span class="text-xs font-bold text-[#2F855A] bg-emerald-50 px-2.5 py-1 rounded-lg">Kelola</span>
                        </div>
                        <h3 class="text-base font-bold text-[#172033] mb-1">Status Perkawinan</h3>
                        <p class="text-xs text-gray-500">Atur statistik status pernikahan warga.</p>
                    </div>

                    <!-- Card 6: Agama -->
                    <div onclick="toggleModal('modalAgama')" class="bg-white p-6 rounded-2xl border border-gray-200 shadow-xs hover:border-[#2F855A] cursor-pointer transition-all group">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 rounded-xl bg-emerald-50 text-[#2F855A] flex items-center justify-center group-hover:bg-[#2F855A] group-hover:text-white transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                            </div>
                            <span class="text-xs font-bold text-[#2F855A] bg-emerald-50 px-2.5 py-1 rounded-lg">Kelola</span>
                        </div>
                        <h3 class="text-base font-bold text-[#172033] mb-1">Agama</h3>
                        <p class="text-xs text-gray-500">Atur data pemeluk agama di desa.</p>
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
                <h4 class="font-bold text-sm text-gray-700 mb-4">Jumlah Penduduk & Keluarga</h4>
                <div class="flex items-center justify-between mb-4">
                    <label class="text-sm font-semibold text-gray-600">Laki-laki<span class="text-red-500">*</span></label>
                    <div class="flex items-center gap-3">
                        <input type="number" id="inputLaki" value="<?= $data['desa']['kependudukan']['laki_laki'] ?? 0 ?>" oninput="hitungTotalPenduduk()" class="border border-gray-200 rounded-xl p-2.5 w-32 md:w-48 text-sm focus:ring-[#2F855A] outline-none" placeholder="0">
                        <span class="text-sm text-gray-500">orang</span>
                    </div>
                </div>
                <div class="flex items-center justify-between mb-4">
                    <label class="text-sm font-semibold text-gray-600">Perempuan<span class="text-red-500">*</span></label>
                    <div class="flex items-center gap-3">
                        <input type="number" id="inputPerempuan" value="<?= $data['desa']['kependudukan']['perempuan'] ?? 0 ?>" oninput="hitungTotalPenduduk()" class="border border-gray-200 rounded-xl p-2.5 w-32 md:w-48 text-sm focus:ring-[#2F855A] outline-none" placeholder="0">
                        <span class="text-sm text-gray-500">orang</span>
                    </div>
                </div>
                <!-- Tambahan Input Kepala Keluarga -->
                <div class="flex items-center justify-between mb-6">
                    <label class="text-sm font-semibold text-gray-600">Kepala Keluarga<span class="text-red-500">*</span></label>
                    <div class="flex items-center gap-3">
                        <input type="number" id="inputKK" value="<?= $data['desa']['kependudukan']['kepala_keluarga'] ?? 0 ?>" class="border border-gray-200 rounded-xl p-2.5 w-32 md:w-48 text-sm focus:ring-[#2F855A] outline-none" placeholder="0">
                        <span class="text-sm text-gray-500">KK</span>
                    </div>
                </div>
                <div class="flex items-center justify-between bg-gray-50 p-4 rounded-xl border border-gray-100">
                    <label class="text-sm font-bold text-[#172033]">Total Penduduk</label>
                    <div class="flex items-center gap-3">
                        <?php 
                            $tot = ($data['desa']['kependudukan']['laki_laki'] ?? 0) + ($data['desa']['kependudukan']['perempuan'] ?? 0); 
                        ?>
                        <input type="number" id="inputTotal" class="border-none bg-gray-200 rounded-xl p-2.5 w-32 md:w-48 text-sm font-bold text-gray-600" value="<?= $tot ?>" readonly>
                        <span class="text-sm text-gray-500">orang</span>
                    </div>
                </div>
            </div>
            <div class="flex justify-end gap-3 p-6 border-t border-gray-100 bg-gray-50">
                <button onclick="toggleModal('modalKependudukan')" class="px-5 py-2.5 text-sm font-bold text-red-500 border border-red-200 bg-white rounded-xl hover:bg-red-50">Batal</button>
                <button onclick="validasiSimpan('modalKependudukan')" class="px-5 py-2.5 text-sm font-bold text-white bg-[#2F855A] rounded-xl hover:bg-green-700 shadow-md">Simpan</button>
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
                <?php 
                $defaultUmur = ['< 3', '3 - 6', '7 - 12', '13 - 15', '16 - 18', '19 - 25', '26 - 59', '> 59'];
                $dbUmur = [];
                if(isset($data['desa']['umur'])) {
                    foreach($data['desa']['umur'] as $u) { $dbUmur[$u['rentang']] = $u['jumlah']; }
                }
                foreach($defaultUmur as $item): 
                    $val = $dbUmur[$item] ?? 0;
                ?>
                <div class="grid grid-cols-2 gap-4 items-center item-kategori">
                    <span class="text-sm text-gray-600 kategori-nama" data-nama="<?= $item ?>"><?= $item ?> Tahun</span>
                    <input type="number" class="input-jumlah border border-gray-200 rounded-lg p-2 text-sm focus:ring-[#2F855A] outline-none" value="<?= $val ?>">
                </div>
                <?php endforeach; ?>
            </div>
            <div class="flex justify-end gap-3 p-6 border-t border-gray-100 bg-gray-50">
                <button onclick="toggleModal('modalUmur')" class="px-5 py-2.5 text-sm font-bold text-red-500 border border-red-200 bg-white rounded-xl hover:bg-red-50">Batal</button>
                <button onclick="validasiSimpan('modalUmur')" class="px-5 py-2.5 text-sm font-bold text-white bg-[#2F855A] rounded-xl hover:bg-green-700 shadow-md">Simpan</button>
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
                <?php 
                $defaultKerja = ['Petani', 'PNS', 'Wiraswasta', 'Karyawan Swasta', 'Pelajar/Mahasiswa', 'Mengurus Rumah Tangga', 'Belum/Tidak Bekerja', 'Lain-lain'];
                $dbKerja = [];
                if(isset($data['desa']['pekerjaan'])) {
                    foreach($data['desa']['pekerjaan'] as $p) { $dbKerja[$p['kategori']] = $p['jumlah']; }
                }
                foreach($defaultKerja as $item): 
                    $val = $dbKerja[$item] ?? 0;
                ?>
                <div class="grid grid-cols-2 gap-4 items-center item-kategori">
                    <span class="text-sm text-gray-600 kategori-nama" data-nama="<?= $item ?>"><?= $item ?></span>
                    <input type="number" class="input-jumlah border border-gray-200 rounded-lg p-2 text-sm focus:ring-[#2F855A] outline-none" value="<?= $val ?>">
                </div>
                <?php endforeach; ?>
            </div>
            <div class="flex justify-end gap-3 p-6 border-t border-gray-100 bg-gray-50">
                <button onclick="toggleModal('modalPekerjaan')" class="px-5 py-2.5 text-sm font-bold text-red-500 border border-red-200 bg-white rounded-xl hover:bg-red-50">Batal</button>
                <button onclick="validasiSimpan('modalPekerjaan')" class="px-5 py-2.5 text-sm font-bold text-white bg-[#2F855A] rounded-xl hover:bg-green-700 shadow-md">Simpan</button>
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
                <?php 
                $defaultDidik = ['Belum/Tidak bersekolah', 'SD', 'SMP', 'SMA', 'Diploma', 'S1', 'S2', 'S3'];
                $dbDidik = [];
                if(isset($data['desa']['pendidikan'])) {
                    foreach($data['desa']['pendidikan'] as $p) { $dbDidik[$p['tingkat']] = $p['jumlah']; }
                }
                foreach($defaultDidik as $item): 
                    $val = $dbDidik[$item] ?? 0;
                ?>
                <div class="grid grid-cols-2 gap-4 items-center item-kategori">
                    <span class="text-sm text-gray-600 kategori-nama" data-nama="<?= $item ?>"><?= $item ?></span>
                    <input type="number" class="input-jumlah border border-gray-200 rounded-lg p-2 text-sm focus:ring-[#2F855A] outline-none" value="<?= $val ?>">
                </div>
                <?php endforeach; ?>
            </div>
            <div class="flex justify-end gap-3 p-6 border-t border-gray-100 bg-gray-50">
                <button onclick="toggleModal('modalPendidikan')" class="px-5 py-2.5 text-sm font-bold text-red-500 border border-red-200 bg-white rounded-xl hover:bg-red-50">Batal</button>
                <button onclick="validasiSimpan('modalPendidikan')" class="px-5 py-2.5 text-sm font-bold text-white bg-[#2F855A] rounded-xl hover:bg-green-700 shadow-md">Simpan</button>
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
                <?php 
                $defaultKawin = ['Belum kawin', 'Kawin', 'Cerai hidup', 'Cerai mati'];
                $dbKawin = [];
                if(isset($data['desa']['perkawinan'])) {
                    foreach($data['desa']['perkawinan'] as $p) { $dbKawin[$p['status']] = $p['jumlah']; }
                }
                foreach($defaultKawin as $item): 
                    $val = $dbKawin[$item] ?? 0;
                ?>
                <div class="grid grid-cols-2 gap-4 items-center item-kategori">
                    <span class="text-sm text-gray-600 kategori-nama" data-nama="<?= $item ?>"><?= $item ?></span>
                    <input type="number" class="input-jumlah border border-gray-200 rounded-lg p-2 text-sm focus:ring-[#2F855A] outline-none" value="<?= $val ?>">
                </div>
                <?php endforeach; ?>
            </div>
            <div class="flex justify-end gap-3 p-6 border-t border-gray-100 bg-gray-50">
                <button onclick="toggleModal('modalPerkawinan')" class="px-5 py-2.5 text-sm font-bold text-red-500 border border-red-200 bg-white rounded-xl hover:bg-red-50">Batal</button>
                <button onclick="validasiSimpan('modalPerkawinan')" class="px-5 py-2.5 text-sm font-bold text-white bg-[#2F855A] rounded-xl hover:bg-green-700 shadow-md">Simpan</button>
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
                <?php 
                $defaultAgama = ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'];
                $dbAgama = [];
                if(isset($data['desa']['agama'])) {
                    foreach($data['desa']['agama'] as $p) { $dbAgama[$p['agama']] = $p['jumlah']; }
                }
                foreach($defaultAgama as $item): 
                    $val = $dbAgama[$item] ?? 0;
                ?>
                <div class="grid grid-cols-2 gap-4 items-center item-kategori">
                    <span class="text-sm text-gray-600 kategori-nama" data-nama="<?= $item ?>"><?= $item ?></span>
                    <input type="number" class="input-jumlah border border-gray-200 rounded-lg p-2 text-sm focus:ring-[#2F855A] outline-none" value="<?= $val ?>">
                </div>
                <?php endforeach; ?>
            </div>
            <div class="flex justify-end gap-3 p-6 border-t border-gray-100 bg-gray-50">
                <button onclick="toggleModal('modalAgama')" class="px-5 py-2.5 text-sm font-bold text-red-500 border border-red-200 bg-white rounded-xl hover:bg-red-50">Batal</button>
                <button onclick="validasiSimpan('modalAgama')" class="px-5 py-2.5 text-sm font-bold text-white bg-[#2F855A] rounded-xl hover:bg-green-700 shadow-md">Simpan</button>
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
                    <div class="relative">
                        <div>
                            <input type="number" id="inputTahunDoc" class="w-full border border-gray-200 rounded-xl p-3 text-sm focus:ring-2 focus:ring-[#2F855A] focus:border-[#2F855A] outline-none" placeholder="Contoh: 2026" min="2000" max="2100">
                        </div>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">File Dokumen (PDF)<span class="text-red-500">*</span></label>
                    <input type="file" id="inputFileDoc" accept=".pdf" class="w-full border border-gray-200 rounded-xl p-2.5 text-sm bg-gray-50 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-[#2F855A] file:text-white hover:file:bg-green-700 cursor-pointer">
            </div>

            <div class="flex justify-end gap-3 p-6 border-t border-gray-100 bg-gray-50">
                <button onclick="toggleModal('modalTambahDokumen')" class="px-5 py-2.5 text-sm font-bold text-red-500 border border-red-200 bg-white rounded-xl hover:bg-red-50">Batal</button>
                <button onclick="validasiSimpanDokumen()" class="px-5 py-2.5 text-sm font-bold text-white bg-[#2F855A] rounded-xl hover:bg-green-700 shadow-md">Simpan</button>
            </div>
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
                    <input type="number" id="editTahunDoc" class="w-full border border-gray-200 rounded-xl p-3 text-sm focus:ring-2 focus:ring-[#2F855A] focus:border-[#2F855A] outline-none" placeholder="Contoh: 2026" min="2000" max="2100">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">File Dokumen (PDF Baru)</label>
                    <input type="file" id="editFileDoc" accept=".pdf" class="w-full border border-gray-200 rounded-xl p-2.5 text-sm bg-gray-50 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-[#2F855A] file:text-white hover:file:bg-green-700 cursor-pointer">
                    <p class="text-[11px] text-gray-400 mt-1">Kosongkan jika tidak ingin mengubah file PDF yang lama.</p>
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
        <div class="bg-white w-full max-w-4xl rounded-2xl shadow-xl overflow-hidden relative flex flex-col h-[90vh]">
            <div class="flex justify-between items-center p-4 border-b border-gray-100">
                <h3 id="previewTitle" class="text-lg font-bold text-[#172033]">Pratinjau Dokumen</h3>
                <button onclick="toggleModal('modalPreview')" class="text-gray-400 hover:text-red-500 font-bold text-xl">&times;</button>
            </div>
            <!-- Area Konten PDF -->
            <div class="flex-1 bg-gray-100 p-4 flex items-center justify-center">
                <iframe id="pdfViewer" src="" class="w-full h-full rounded-xl border border-gray-200 bg-white" frameborder="0"></iframe>
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