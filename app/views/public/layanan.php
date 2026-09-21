<?php include '../app/views/layouts/header.php'; ?>

<!-- HEADER HALAMAN -->
<section class="bg-[#F7F9FC] pt-32 pb-12 px-4 md:px-8 lg:px-[120px] text-center border-b border-gray-200">
    <h1 class="text-3xl md:text-5xl font-extrabold text-[#172033] mb-3">Informasi & Panduan Layanan Administrasi</h1>
    <p class="text-gray-500 text-sm md:text-base max-w-xl mx-auto">Panduan persyaratan dan alur pelayanan administrasi Desa Padangan</p>
    
    <!-- TOMBOL FILTER KATEGORI -->
    <div class="flex flex-wrap justify-center gap-3 mt-8">
        <button onclick="filterLayanan('semua')" class="filter-btn px-6 py-2.5 rounded-full text-sm font-semibold transition-all bg-[#2F855A] text-white shadow-sm">Semua Layanan</button>
        <button onclick="filterLayanan('kependudukan')" class="filter-btn px-6 py-2.5 rounded-full text-sm font-semibold transition-all bg-white text-gray-600 border border-gray-200 hover:bg-gray-50">Kependudukan</button>
        <button onclick="filterLayanan('surat')" class="filter-btn px-6 py-2.5 rounded-full text-sm font-semibold transition-all bg-white text-gray-600 border border-gray-200 hover:bg-gray-50">Surat Keterangan</button>
        <button onclick="filterLayanan('izin')" class="filter-btn px-6 py-2.5 rounded-full text-sm font-semibold transition-all bg-white text-gray-600 border border-gray-200 hover:bg-gray-50">Izin Dagang & Nikah</button>
    </div>
</section>

<!-- KONTEN DAFTAR LAYANAN -->
<main class="px-4 md:px-8 lg:px-[120px] py-12 space-y-10 max-w-5xl mx-auto">

    <!-- KATEGORI 1: KEPENDUDUKAN -->
    <div class="kategori-section" data-kategori="kependudukan">
        <h2 class="text-xl font-bold text-[#172033] mb-2">Kependudukan</h2>
        <p class="text-gray-500 text-sm mb-4">Layanan yang berkaitan dengan dokumen kependudukan.</p>

        <div class="space-y-4">
            <!-- Accordion Item 1: KTP -->
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden transition-all">
                <button onclick="toggleAccordion('ktp-content', 'ktp-icon')" class="w-full flex items-center justify-between p-5 text-left font-semibold text-[#172033] hover:bg-gray-50/50">
                    <div class="flex items-center gap-3">
                        <span class="p-2 bg-green-50 rounded-lg text-[#2F855A]">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8h2m-2 4h2m2-4h2m-2 4h2"></path></svg>
                        </span>
                        <span>Kartu Tanda Penduduk (KTP)</span>
                    </div>
                    <svg id="ktp-icon" class="w-5 h-5 text-gray-400 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                
                <!-- Isi Detail (Hidden by default) -->
                <div id="ktp-content" class="hidden px-6 pb-6 pt-2 border-t border-gray-100 text-sm text-gray-600 space-y-4 bg-gray-50/30">
                    <div>
                        <h4 class="font-bold text-[#172033] mb-2">Persyaratan</h4>
                        <ul class="list-disc list-inside space-y-1 text-gray-500">
                            <li>Fotocopy KK</li>
                            <li>Fotocopy Akta Kelahiran</li>
                            <li>Surat pengantar RT/RW</li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="font-bold text-[#172033] mb-2">Alur Pengajuan</h4>
                        <ol class="list-decimal list-inside space-y-1 text-gray-500">
                            <li><strong>Datangi Kantor Pelayanan:</strong> Datang langsung ke Kantor Kelurahan Desa Padangan dan serahkan berkas kepada petugas untuk diverifikasi.</li>
                            <li><strong>Perekaman Biometrik:</strong> Lakukan proses pengambilan foto, sidik jari, tanda tangan, dan pemindaian iris mata oleh petugas.</li>
                            <li><strong>Tunggu Pencetakan:</strong> Selesai perekaman, Anda akan diberikan surat keterangan atau tanda terima sebagai identitas sementara sambil menunggu e-KTP dicetak (biasanya memakan waktu sekitar 14 hari).</li>
                        </ol>
                    </div>
                </div>
            </div>

            <!-- Accordion Item 2: KK -->
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden transition-all">
                <button onclick="toggleAccordion('kk-content', 'kk-icon')" class="w-full flex items-center justify-between p-5 text-left font-semibold text-[#172033] hover:bg-gray-50/50">
                    <div class="flex items-center gap-3">
                        <span class="p-2 bg-green-50 rounded-lg text-[#2F855A]">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                        </span>
                        <span>Kartu Keluarga (KK)</span>
                    </div>
                    <svg id="kk-icon" class="w-5 h-5 text-gray-400 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <div id="kk-content" class="hidden px-6 pb-6 pt-2 border-t border-gray-100 text-sm text-gray-600 space-y-2 bg-gray-50/30">
                    <p>Persyaratan pembuatan Kartu Keluarga baru melampirkan Surat Pengantar RT/RW, Buku Nikah/Akta Perkawinan, dan Surat Keterangan Pindah (jika dari luar wilayah).</p>
                </div>
            </div>

            <!-- Accordion Item 3: Akta Kelahiran -->
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden transition-all">
                <button onclick="toggleAccordion('akta-content', 'akta-icon')" class="w-full flex items-center justify-between p-5 text-left font-semibold text-[#172033] hover:bg-gray-50/50">
                    <div class="flex items-center gap-3">
                        <span class="p-2 bg-green-50 rounded-lg text-[#2F855A]">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </span>
                        <span>Akta Kelahiran</span>
                    </div>
                    <svg id="akta-icon" class="w-5 h-5 text-gray-400 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <div id="akta-content" class="hidden px-6 pb-6 pt-2 border-t border-gray-100 text-sm text-gray-600 space-y-2 bg-gray-50/30">
                    <p>Melampirkan Surat Kelahiran dari Rumah Sakit/Bidan, Buku Nikah Orang Tua, KK, dan KTP saksi.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- KATEGORI 2: SURAT KETERANGAN -->
    <div class="kategori-section" data-kategori="surat">
        <h2 class="text-xl font-bold text-[#172033] mb-2">Surat Keterangan</h2>
        <p class="text-gray-500 text-sm mb-4">Layanan yang berkaitan dengan surat keterangan.</p>

        <div class="space-y-4">
            <!-- SKTM -->
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden transition-all">
                <button onclick="toggleAccordion('sktm-content', 'sktm-icon')" class="w-full flex items-center justify-between p-5 text-left font-semibold text-[#172033] hover:bg-gray-50/50">
                    <div class="flex items-center gap-3">
                        <span class="p-2 bg-green-50 rounded-lg text-[#2F855A]">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                        </span>
                        <span>Surat Keterangan Tidak Mampu (SKTM)</span>
                    </div>
                    <svg id="sktm-icon" class="w-5 h-5 text-gray-400 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <div id="sktm-content" class="hidden px-6 pb-6 pt-2 border-t border-gray-100 text-sm text-gray-600 bg-gray-50/30">
                    <p>Membawa surat pengantar RT/RW serta Kartu Keluarga (KK) dan KTP pemohon.</p>
                </div>
            </div>

            <!-- Domisili -->
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden transition-all">
                <button onclick="toggleAccordion('domisili-content', 'domisili-icon')" class="w-full flex items-center justify-between p-5 text-left font-semibold text-[#172033] hover:bg-gray-50/50">
                    <div class="flex items-center gap-3">
                        <span class="p-2 bg-green-50 rounded-lg text-[#2F855A]">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                        </span>
                        <span>Surat Domisili</span>
                    </div>
                    <svg id="domisili-icon" class="w-5 h-5 text-gray-400 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <div id="domisili-content" class="hidden px-6 pb-6 pt-2 border-t border-gray-100 text-sm text-gray-600 bg-gray-50/30">
                    <p>Melampirkan pengantar RT/RW dan identitas diri pendukung.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- KATEGORI 3: IZIN DAGANG & NIKAH -->
    <div class="kategori-section" data-kategori="izin">
        <h2 class="text-xl font-bold text-[#172033] mb-2">Surat Lainnya & Perizinan</h2>
        <p class="text-gray-500 text-sm mb-4">Layanan perizinan usaha dan surat nikah.</p>

        <div class="space-y-4">
            <!-- Izin Dagang -->
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden transition-all">
                <button onclick="toggleAccordion('izin-content', 'izin-icon')" class="w-full flex items-center justify-between p-5 text-left font-semibold text-[#172033] hover:bg-gray-50/50">
                    <div class="flex items-center gap-3">
                        <span class="p-2 bg-green-50 rounded-lg text-[#2F855A]">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </span>
                        <span>Surat Perizinan Dagang</span>
                    </div>
                    <svg id="izin-icon" class="w-5 h-5 text-gray-400 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <div id="izin-content" class="hidden px-6 pb-6 pt-2 border-t border-gray-100 text-sm text-gray-600 bg-gray-50/30">
                    <p>Membawa surat pengantar usaha dari RT/RW dan fotocopy KTP pemilik.</p>
                </div>
            </div>

            <!-- Surat Nikah -->
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden transition-all">
                <button onclick="toggleAccordion('nikah-content', 'nikah-icon')" class="w-full flex items-center justify-between p-5 text-left font-semibold text-[#172033] hover:bg-gray-50/50">
                    <div class="flex items-center gap-3">
                        <span class="p-2 bg-green-50 rounded-lg text-[#2F855A]">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                        </span>
                        <span>Surat Pengantar Nikah (N1-N4)</span>
                    </div>
                    <svg id="nikah-icon" class="w-5 h-5 text-gray-400 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <div id="nikah-content" class="hidden px-6 pb-6 pt-2 border-t border-gray-100 text-sm text-gray-600 bg-gray-50/30">
                    <p>Membawa pengantar RT/RW, fotocopy KK, KTP, dan Akta Kelahiran calon pengantin.</p>
                </div>
            </div>
        </div>
    </div>

</main>

<!-- SCRIPT INTERAKTIF (ACCORDION & FILTER) -->
<script src="assets/js/layanan.js"></script>

<?php include '../app/views/layouts/footer.php'; ?>