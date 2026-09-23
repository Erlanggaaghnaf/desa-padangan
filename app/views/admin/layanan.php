<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Layanan - Administrator Desa Padangan</title>
    <link rel="icon" type="image/png" href="assets/images/logo.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>
<body class="bg-[#F4F6F9] flex h-screen overflow-hidden">

    <!-- MEMANGGIL KOMPONEN SIDEBAR -->
    <?php include '../app/views/components/admin_sidebar.php'; ?>

    <main class="flex-1 flex flex-col h-screen overflow-y-auto md:ml-64 transition-all">
        
        <!-- Header Atas -->
        <header class="bg-white border-b border-gray-200 px-4 md:px-8 py-4 flex justify-between items-center sticky top-0 z-30 shadow-xs">
            <div class="flex items-center gap-3">
                <button onclick="toggleSidebar()" class="md:hidden text-gray-700 hover:text-[#2F855A] focus:outline-none p-1 rounded-lg border border-gray-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>
                <div>
                    <h1 id="pageTitle" class="text-base md:text-xl font-extrabold text-[#172033]">Manajemen Layanan Desa</h1>
                    <p id="pageSubtitle" class="text-[11px] md:text-xs text-gray-500">Kelola informasi daftar layanan Desa Padangan.</p>
                </div>
            </div>
            <div class="text-right">
                <p id="current-date" class="text-xs font-bold text-gray-700">Memuat tanggal...</p>
                <p id="current-time" class="text-[10px] md:text-[11px] text-gray-400 mt-0.5">--:--:-- WIB</p>
            </div>
        </header>

        <!-- ========================================================== -->
        <!-- VIEW 1: DAFTAR LAYANAN -->
        <!-- ========================================================== -->
        <div id="view-list" class="p-4 md:p-8 space-y-8 max-w-5xl w-full mx-auto pb-20 block">
            
            <button onclick="showForm('tambah')" class="w-full flex items-center justify-center md:justify-start gap-2 bg-white border border-gray-200 p-4 rounded-2xl shadow-sm hover:shadow-md transition-shadow text-[#2F855A] font-semibold text-sm cursor-pointer group">
                <div class="w-8 h-8 rounded-full bg-emerald-50 flex items-center justify-center group-hover:bg-emerald-100 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                </div>
                Tambah Informasi layanan baru
            </button>

            <div>
                <h2 class="text-lg font-bold text-[#172033] mb-6">Layanan Yang Tersedia</h2>
                
                <div class="mb-8">
                    <h3 class="text-sm font-bold text-gray-800 mb-4 px-2">Kependudukan</h3>
                    <div class="space-y-3">
                        
                        <!-- ITEM LAYANAN: KTP -->
                        <div class="bg-white border border-gray-200 rounded-2xl shadow-xs overflow-hidden transition-all duration-300">
                            <div class="p-4 flex flex-col md:flex-row md:items-center justify-between gap-4 cursor-pointer hover:bg-gray-50/50" onclick="toggleAccordion('ktp-content', 'ktp-icon')">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-emerald-50 flex items-center justify-center text-[#2F855A]">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"></path></svg>
                                    </div>
                                    <h4 class="text-sm font-bold text-gray-800">Kartu Tanda Penduduk (KTP)</h4>
                                </div>
                                <div class="flex items-center gap-2" onclick="event.stopPropagation()">
                                    <button onclick="openModal('deleteModal')" class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg border border-red-200 text-red-600 hover:bg-red-50 text-xs font-semibold">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg> Hapus
                                    </button>
                                    <button onclick="showForm('edit', 'Kartu Tanda Penduduk (KTP)')" class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg border border-blue-200 text-blue-600 hover:bg-blue-50 text-xs font-semibold">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg> Edit
                                    </button>
                                    <button class="w-8 h-8 flex items-center justify-center text-gray-400">
                                        <svg id="ktp-icon" class="w-5 h-5 transition-transform duration-300 transform rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                    </button>
                                </div>
                            </div>
                            
                            <!-- Konten Expandable -->
                            <div id="ktp-content" class="px-4 pb-4 md:px-16 block border-t border-gray-100 pt-4 bg-gray-50/30">
                                <div class="mb-5">
                                    <h5 class="text-xs font-bold text-gray-800 mb-2">Persyaratan</h5>
                                    <ul class="space-y-1.5 text-xs text-gray-600">
                                        <li class="flex items-start gap-2"><svg class="w-4 h-4 text-[#2F855A] mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg> Fotocopy KK</li>
                                        <li class="flex items-start gap-2"><svg class="w-4 h-4 text-[#2F855A] mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg> Surat pengantar RT</li>
                                    </ul>
                                </div>
                                <div>
                                    <h5 class="text-xs font-bold text-gray-800 mb-3">Alur Pengajuan</h5>
                                    <div class="space-y-4 border-l-2 border-gray-200 ml-3 pl-4">
                                        <div class="relative flex items-start gap-3">
                                            <div class="absolute -left-[27px] w-6 h-6 rounded-full bg-emerald-100 text-[#2F855A] flex items-center justify-center text-[10px] font-bold ring-4 ring-white">1</div>
                                            <div>
                                                <h6 class="text-xs font-semibold text-gray-800">Datangi Kantor Pelayanan</h6>
                                                <p class="text-[11px] text-gray-500 mt-1">Datang langsung ke Kantor Kelurahan Desa Padangan.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>

        <!-- ========================================================== -->
        <!-- VIEW 2: FORM TAMBAH / EDIT LAYANAN (Dinamis) -->
        <!-- ========================================================== -->
        <div id="view-form" class="p-4 md:p-8 max-w-4xl w-full mx-auto hidden pb-20">
            
            <form id="layananForm" onsubmit="event.preventDefault(); validateAndSave();" class="space-y-6">
                
                <!-- Box 1: Informasi Layanan -->
                <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-xs">
                    <h3 class="text-sm font-bold text-gray-800 flex items-center gap-2 mb-4">
                        <svg class="w-4 h-4 text-[#2F855A]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg> 
                        Informasi Layanan
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1.5">Nama Layanan*</label>
                            <input type="text" id="inputNamaLayanan" placeholder="Contoh: Surat Keterangan Pindah" class="w-full px-3 py-2 border border-gray-300 rounded-xl text-xs focus:outline-none focus:border-[#2F855A]">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1.5">Kategori Layanan*</label>
                            <select id="inputKategori" class="w-full px-3 py-2 border border-gray-300 rounded-xl text-xs focus:outline-none focus:border-[#2F855A] bg-white cursor-pointer appearance-none">
                                <option value="">Pilih Kategori Layanan</option>
                                <option value="Kependudukan">Kependudukan</option>
                                <option value="Surat Keterangan">Surat Keterangan</option>
                                <option value="Surat Lainnya">Surat Lainnya</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Box 2: Dokumen Persyaratan (Dinamis) -->
                <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-xs">
                    <h3 class="text-sm font-bold text-gray-800 flex items-center gap-2 mb-4">
                        <svg class="w-4 h-4 text-[#2F855A]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                        Dokumen Persyaratan Layanan
                    </h3>
                    
                    <div id="container-persyaratan" class="space-y-3 mb-4">
                        <!-- Baris Input Persyaratan 1 -->
                        <div class="flex items-center gap-3 req-row">
                            <input type="text" placeholder="Contoh: Foto Copy KTP" class="req-input flex-1 px-3 py-2 border border-gray-300 rounded-xl text-xs focus:outline-none focus:border-[#2F855A]">
                            <button type="button" onclick="removeRow(this)" class="w-9 h-9 flex items-center justify-center border border-red-200 text-red-500 rounded-xl hover:bg-red-50 shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </div>
                    </div>
                    
                    <button type="button" onclick="addPersyaratan()" class="text-xs font-semibold text-gray-600 border border-gray-300 rounded-xl px-4 py-2 hover:bg-gray-50 flex items-center gap-1.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Tambah Dokumen Persyaratan
                    </button>
                </div>

                <!-- Box 3: Alur & Prosedur (Dinamis) -->
                <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-xs">
                    <h3 class="text-sm font-bold text-gray-800 flex items-center gap-2 mb-4">
                        <svg class="w-4 h-4 text-[#2F855A]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12"></path></svg>
                        Alur & Prosedur Pelayanan
                    </h3>
                    
                    <div id="container-alur" class="space-y-4 mb-4">
                        <!-- Baris Input Alur 1 -->
                        <div class="alur-row border border-gray-100 bg-gray-50/50 p-4 rounded-xl flex items-start gap-3 relative group">
                            <div class="w-6 h-6 rounded-full bg-white border border-gray-200 text-gray-500 flex items-center justify-center text-[10px] font-bold shrink-0 alur-number">1</div>
                            <div class="flex-1 grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-[10px] font-semibold text-gray-500 mb-1">Judul Langkah</label>
                                    <input type="text" placeholder="Contoh: Datang ke Kantor Kepala Desa" class="alur-judul w-full px-3 py-2 border border-gray-300 rounded-xl text-xs focus:outline-none focus:border-[#2F855A]">
                                </div>
                                <div>
                                    <label class="block text-[10px] font-semibold text-gray-500 mb-1">Deskripsi Langkah</label>
                                    <input type="text" placeholder="Contoh: Datang langsung dan serahkan..." class="alur-desc w-full px-3 py-2 border border-gray-300 rounded-xl text-xs focus:outline-none focus:border-[#2F855A]">
                                </div>
                            </div>
                            <button type="button" onclick="removeRow(this, true)" class="w-8 h-8 flex items-center justify-center border border-red-200 text-red-500 rounded-lg hover:bg-red-50 shrink-0 mt-4 md:mt-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </div>
                    </div>
                    
                    <button type="button" onclick="addAlur()" class="text-xs font-semibold text-gray-600 border border-gray-300 rounded-xl px-4 py-2 hover:bg-gray-50 flex items-center gap-1.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Tambah Alur & Prosedur Pelayanan
                    </button>
                </div>

                <!-- Tombol Bawah -->
                <div class="flex justify-end gap-3 pt-4 border-t border-gray-200">
                    <button type="button" onclick="hideForm()" class="px-5 py-2.5 rounded-xl border border-gray-300 text-gray-700 text-xs font-semibold hover:bg-gray-50 transition-colors">Batal</button>
                    <button type="submit" id="btnSubmitForm" class="px-5 py-2.5 rounded-xl bg-[#2F855A] text-white text-xs font-semibold hover:bg-[#246946] shadow-sm transition-colors">Simpan Layanan</button>
                </div>
            </form>
        </div>
    </main>

    <!-- ========================================================== -->
    <!-- MODALS (Konfirmasi Hapus, Error, Sukses) -->
    <!-- ========================================================== -->
    
    <!-- Modal Hapus -->
    <div id="deleteModal" class="fixed inset-0 bg-black/60 z-50 flex items-center justify-center p-4 hidden opacity-0 transition-opacity duration-300">
        <div class="bg-white rounded-3xl shadow-2xl max-w-sm w-full p-6 text-center transform scale-95 transition-transform duration-300">
            <div class="w-16 h-16 rounded-full bg-red-50 flex items-center justify-center mx-auto mb-4 text-red-500 border border-red-100">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
            </div>
            <h3 class="text-lg font-extrabold text-[#172033] mb-2">Hapus Layanan?</h3>
            <p class="text-xs text-gray-500 mb-6">Apakah Anda yakin ingin menghapus layanan ini?<br>Data yang dihapus tidak dapat dikembalikan.</p>
            <div class="flex items-center justify-center gap-3">
                <button onclick="closeModal('deleteModal')" class="flex-1 py-2.5 rounded-xl border border-red-200 text-red-600 font-semibold text-xs hover:bg-red-50">Batal</button>
                <button onclick="confirmAction('deleteModal')" class="flex-1 py-2.5 rounded-xl bg-red-600 text-white font-semibold text-xs hover:bg-red-700">Hapus</button>
            </div>
        </div>
    </div>

    <!-- Modal Data Belum Lengkap (Error) -->
    <div id="errorModal" class="fixed inset-0 bg-black/60 z-50 flex items-center justify-center p-4 hidden opacity-0 transition-opacity duration-300">
        <div class="bg-white rounded-3xl shadow-2xl max-w-sm w-full p-6 text-center transform scale-95 transition-transform duration-300 relative">
            <button onclick="closeModal('errorModal')" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
            <div class="w-16 h-16 rounded-full bg-red-50 flex items-center justify-center mx-auto mb-4 text-red-500 border border-red-100">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <h3 class="text-lg font-extrabold text-[#172033] mb-2">Data Belum Lengkap</h3>
            <p class="text-xs text-gray-500 mb-2">Silakan lengkapi seluruh data wajib (Nama & Kategori) sebelum menyimpan layanan.</p>
        </div>
    </div>

    <!-- Modal Konfirmasi Simpan -->
    <div id="saveModal" class="fixed inset-0 bg-black/60 z-50 flex items-center justify-center p-4 hidden opacity-0 transition-opacity duration-300">
        <div class="bg-white rounded-3xl shadow-2xl max-w-sm w-full p-6 text-center transform scale-95 transition-transform duration-300">
            <div class="w-16 h-16 rounded-full bg-emerald-50 flex items-center justify-center mx-auto mb-4 text-[#2F855A] border border-emerald-100">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            </div>
            <h3 class="text-lg font-extrabold text-[#172033] mb-2">Simpan Perubahan?</h3>
            <p class="text-xs text-gray-500 mb-6">Apakah Anda yakin ingin menyimpan layanan ini?<br>Data yang disimpan akan ditampilkan pada halaman.</p>
            <div class="flex items-center justify-center gap-3">
                <button onclick="closeModal('saveModal')" class="flex-1 py-2.5 rounded-xl border border-red-200 text-red-600 font-semibold text-xs hover:bg-red-50">Batal</button>
                <button onclick="confirmAction('saveModal')" class="flex-1 py-2.5 rounded-xl bg-[#2F855A] text-white font-semibold text-xs hover:bg-[#246946]">Simpan</button>
            </div>
        </div>
    </div>

    <!-- SKRIP LOGIKA SINGLE PAGE & FORM DINAMIS -->
    <script>
        // --- 1. TOGGLE VIEWS (List vs Form) ---
        function showForm(mode, dataName = '') {
            document.getElementById('view-list').classList.add('hidden');
            document.getElementById('view-form').classList.remove('hidden');
            
            // Ubah Header & Tombol sesuai mode
            if (mode === 'tambah') {
                document.getElementById('pageTitle').innerText = 'Tambah Layanan Baru';
                document.getElementById('pageSubtitle').innerText = 'Tambahkan informasi layanan yang tersedia di Desa Padangan.';
                document.getElementById('btnSubmitForm').innerText = 'Simpan Layanan';
                document.getElementById('layananForm').reset(); // Kosongkan form
            } else if (mode === 'edit') {
                document.getElementById('pageTitle').innerText = 'Edit Layanan';
                document.getElementById('pageSubtitle').innerText = 'Perbarui informasi layanan yang tersedia di Desa Padangan.';
                document.getElementById('btnSubmitForm').innerText = 'Simpan Perubahan';
                document.getElementById('inputNamaLayanan').value = dataName; // Isi dummy data
            }
        }

        function hideForm() {
            document.getElementById('view-form').classList.add('hidden');
            document.getElementById('view-list').classList.remove('hidden');
            document.getElementById('pageTitle').innerText = 'Manajemen Layanan Desa';
            document.getElementById('pageSubtitle').innerText = 'Kelola informasi daftar layanan Desa Padangan.';
        }

        // --- 2. LOGIKA TAMBAH/HAPUS BARIS DINAMIS ---
        function addPersyaratan() {
            const container = document.getElementById('container-persyaratan');
            const row = document.createElement('div');
            row.className = 'flex items-center gap-3 req-row mt-3';
            row.innerHTML = `
                <input type="text" placeholder="Contoh: Foto Copy Dokumen" class="req-input flex-1 px-3 py-2 border border-gray-300 rounded-xl text-xs focus:outline-none focus:border-[#2F855A]">
                <button type="button" onclick="removeRow(this)" class="w-9 h-9 flex items-center justify-center border border-red-200 text-red-500 rounded-xl hover:bg-red-50 shrink-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                </button>
            `;
            container.appendChild(row);
        }

        function addAlur() {
            const container = document.getElementById('container-alur');
            const currentCount = container.querySelectorAll('.alur-row').length + 1;
            const row = document.createElement('div');
            row.className = 'alur-row border border-gray-100 bg-gray-50/50 p-4 rounded-xl flex items-start gap-3 relative mt-4';
            row.innerHTML = `
                <div class="w-6 h-6 rounded-full bg-white border border-gray-200 text-gray-500 flex items-center justify-center text-[10px] font-bold shrink-0 alur-number">${currentCount}</div>
                <div class="flex-1 grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[10px] font-semibold text-gray-500 mb-1">Judul Langkah</label>
                        <input type="text" placeholder="Contoh: Proses di Kecamatan" class="alur-judul w-full px-3 py-2 border border-gray-300 rounded-xl text-xs focus:outline-none focus:border-[#2F855A]">
                    </div>
                    <div>
                        <label class="block text-[10px] font-semibold text-gray-500 mb-1">Deskripsi Langkah</label>
                        <input type="text" placeholder="Contoh: Bawa berkas ke loket..." class="alur-desc w-full px-3 py-2 border border-gray-300 rounded-xl text-xs focus:outline-none focus:border-[#2F855A]">
                    </div>
                </div>
                <button type="button" onclick="removeRow(this, true)" class="w-8 h-8 flex items-center justify-center border border-red-200 text-red-500 rounded-lg hover:bg-red-50 shrink-0 mt-4 md:mt-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                </button>
            `;
            container.appendChild(row);
        }

        function removeRow(btn, isAlur = false) {
            btn.parentElement.remove();
            if (isAlur) updateAlurNumbers();
        }

        function updateAlurNumbers() {
            const numbers = document.querySelectorAll('.alur-number');
            numbers.forEach((el, index) => {
                el.innerText = index + 1;
            });
        }

        // --- 3. LOGIKA VALIDASI & MODAL ---
        function validateAndSave() {
            const nama = document.getElementById('inputNamaLayanan').value;
            const kategori = document.getElementById('inputKategori').value;
            
            if (nama.trim() === '' || kategori === '') {
                openModal('errorModal');
            } else {
                openModal('saveModal');
            }
        }

        function openModal(modalId) {
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

        function confirmAction(modalId) {
            closeModal(modalId);
            if (modalId === 'saveModal') hideForm(); // Kembali ke list setelah simpan
        }

        function toggleAccordion(contentId, iconId) {
            const content = document.getElementById(contentId);
            const icon = document.getElementById(iconId);
            if (content.classList.contains('hidden')) {
                content.classList.remove('hidden', 'opacity-0');
                content.classList.add('block');
                icon.classList.add('rotate-180');
            } else {
                content.classList.remove('block');
                content.classList.add('hidden');
                icon.classList.remove('rotate-180');
            }
        }
        
        function toggleSidebar() {
            const sidebar = document.getElementById('admin-sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }

        // --- 4. JAM & TANGGAL REAL-TIME ---
        function updateDateTime() {
            const now = new Date();
            // Format Tanggal (Misal: Kamis, 24 September 2026)
            const optionsDate = { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' };
            // Format Waktu dengan detik
            const optionsTime = { hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false };
            
            document.getElementById('current-date').innerText = now.toLocaleDateString('id-ID', optionsDate);
            document.getElementById('current-time').innerText = now.toLocaleTimeString('id-ID', optionsTime) + ' WIB';
        }

        // Panggil saat halaman pertama kali dimuat
        updateDateTime();
        
        // Panggil ulang setiap 1000ms (1 detik) agar real-time
        setInterval(updateDateTime, 1000);
    </script>
</body>
</html>