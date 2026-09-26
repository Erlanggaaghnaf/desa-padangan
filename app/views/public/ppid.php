<?php include '../app/views/layouts/header.php'; ?>

<!-- HEADER HALAMAN -->
<section class="bg-[#F7F9FC] pt-32 pb-12 px-4 md:px-8 lg:px-[120px] text-center border-b border-gray-200 reveal-up">
    <h1 class="text-3xl md:text-4xl font-extrabold text-[#172033] mb-3 reveal-left">Transparansi Publik & Desa Padangan</h1>
    <p class="text-gray-500 text-sm md:text-base max-w-2xl mx-auto reveal-right">Komitmen penuh Pemerintah Desa Padangan, Kec. Ngantru, Kab. Tulungagung dalam mewujudkan tata kelola pemerintahan yang terbuka, akuntabel, dan partisipatif sesuai amanat UU No. 14 Tahun 2008.</p>
</section>

<!-- KONTEN UTAMA -->
<main class="px-4 md:px-8 lg:px-[120px] py-12 max-w-7xl mx-auto space-y-16 reveal-up">

    <!-- SECTION 1: INFOGRAFIS APBDES -->
    <section id="apbdes-section">
        <h2 class="text-2xl font-bold text-center text-[#172033] mb-8 reveal-up">APBDes Tahun Anggaran 2026</h2>
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 reveal-up">
            
            <!-- Card Kiri: Pendapatan -->
            <div class="bg-white p-6 md:p-8 rounded-2xl border border-gray-200 shadow-sm flex flex-col justify-between hover:shadow-md transition-shadow reveal-left">
                <div class="reveal-up">
                    <div class="inline-flex items-center gap-2 bg-[#2F855A] text-white px-3 py-1 rounded-full text-xs font-semibold mb-4">
                        <span class="w-1.5 h-1.5 bg-white rounded-full"></span> Total Pendapatan Desa
                    </div>
                    <!-- Angka Utama -->
                    <h3 class="text-3xl font-extrabold text-[#172033] tracking-tight">Rp 1.545.600.000</h3>
                    <p class="text-xs text-gray-400 mt-1">Realisasi per September 2026: 86.4% (Rp 1,59 Miliar)</p>
                </div>
                
                <div class="mt-8 reveal-up">
                    <p class="text-sm font-medium text-gray-600 mb-2 reveal-up">Sumber Pendapatan</p>
                    <!-- Progress Bar Stacked (Pendapatan) -->
                    <div class="w-full bg-gray-100 rounded-full h-3 mb-4 flex overflow-hidden">
                        <!-- Perhatikan penggunaan style="width: 0%" dan penambahan class 'progress-animate' beserta data-width -->
                        <div class="progress-animate bg-[#2F855A] h-3 transition-all duration-1000 ease-out" style="width: 0%" data-width="55%"></div>
                        <div class="progress-animate bg-blue-500 h-3 transition-all duration-1000 ease-out delay-100" style="width: 0%" data-width="30%"></div>
                        <div class="progress-animate bg-green-300 h-3 transition-all duration-1000 ease-out delay-200" style="width: 0%" data-width="15%"></div>
                    </div>
                    
                    <!-- Legend Cards (Dengan efek Hover) -->
                    <div class="grid grid-cols-3 gap-3 reveal-up">
                        <div class="border border-gray-200 rounded-xl p-3 text-center cursor-pointer hover:-translate-y-1 hover:shadow-md hover:border-[#2F855A] transition-all duration-300 group">
                            <div class="flex items-center justify-center gap-1 text-xs font-semibold text-gray-600 mb-1 group-hover:text-[#2F855A]"><span class="w-2 h-2 rounded-full bg-[#2F855A]"></span> Transfer</div>
                            <div class="text-sm font-bold text-[#172033]">55%</div>
                            <div class="text-[10px] text-gray-400">Rp 0.85M</div>
                        </div>
                        <div class="border border-gray-200 rounded-xl p-3 text-center bg-blue-50/50 cursor-pointer hover:-translate-y-1 hover:shadow-md hover:border-blue-500 transition-all duration-300 group reveal-up">
                            <div class="flex items-center justify-center gap-1 text-xs font-semibold text-gray-600 mb-1 group-hover:text-blue-600"><span class="w-2 h-2 rounded-full bg-blue-500"></span> Asli Desa</div>
                            <div class="text-sm font-bold text-[#172033]">30%</div>
                            <div class="text-[10px] text-gray-400">Rp 0.46M</div>
                        </div>
                        <div class="border border-gray-200 rounded-xl p-3 text-center bg-green-50/50 cursor-pointer hover:-translate-y-1 hover:shadow-md hover:border-green-400 transition-all duration-300 group reveal-up">
                            <div class="flex items-center justify-center gap-1 text-xs font-semibold text-gray-600 mb-1 group-hover:text-green-600"><span class="w-2 h-2 rounded-full bg-green-400"></span> Lain-lain</div>
                            <div class="text-sm font-bold text-[#172033]">15%</div>
                            <div class="text-[10px] text-gray-400">Rp 0.23M</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card Kanan: Pembelanjaan -->
            <div class="bg-white p-6 md:p-8 rounded-2xl border border-gray-200 shadow-sm hover:shadow-md transition-shadow reveal-right">
                <div class="inline-flex items-center gap-2 bg-[#2F855A] text-white px-3 py-1 rounded-full text-xs font-semibold mb-6">
                    <span class="w-1.5 h-1.5 bg-white rounded-full reveal-up"></span> Pembelanjaan Desa
                </div>

                <div class="space-y-6 reveal-up">
                    <!-- Item 1 -->
                    <div class="group">
                        <div class="flex justify-between text-sm font-semibold text-[#172033] mb-1 group-hover:text-[#2F855A] transition-colors">
                            <span>Penyelenggaraan Pemerintahan Desa</span>
                        </div>
                        <div class="flex justify-between text-[11px] text-gray-400 mb-2">
                            <span>Realisasi | Anggaran</span>
                            <span>Rp 723.300.000,00</span>
                        </div>
                        <div class="w-full bg-gray-100 rounded-full h-2.5 relative">
                            <!-- Animasi lebar dimulai dari 0% -->
                            <div class="progress-animate bg-[#2F855A] h-2.5 rounded-full transition-all duration-1000 ease-out" style="width: 0%" data-width="100%"></div>
                            <span class="absolute right-0 -bottom-4 text-[10px] font-bold text-[#2F855A] opacity-0 animate-fade-in delay-1000">100%</span>
                        </div>
                    </div>
                    <!-- Item 2 -->
                    <div class="group">
                        <div class="flex justify-between text-sm font-semibold text-[#172033] mb-1 group-hover:text-blue-600 transition-colors">
                            <span>Pelaksanaan Pembangunan Desa</span>
                        </div>
                        <div class="flex justify-between text-[11px] text-gray-400 mb-2">
                            <span>Realisasi | Anggaran</span>
                            <span>Rp 533.650.000,00</span>
                        </div>
                        <div class="w-full bg-gray-100 rounded-full h-2.5 relative">
                            <div class="progress-animate bg-blue-600 h-2.5 rounded-full transition-all duration-1000 ease-out delay-100" style="width: 0%" data-width="80%"></div>
                            <span class="absolute right-[20%] -bottom-4 text-[10px] font-bold text-blue-600 opacity-0 animate-fade-in delay-1000">80%</span>
                        </div>
                    </div>
                    <!-- Item 3 -->
                    <div class="group">
                        <div class="flex justify-between text-sm font-semibold text-[#172033] mb-1 group-hover:text-green-500 transition-colors">
                            <span>Pembinaan Kemasyarakatan Desa</span>
                        </div>
                        <div class="flex justify-between text-[11px] text-gray-400 mb-2">
                            <span>Realisasi | Anggaran</span>
                            <span>Rp 288.950.000,00</span>
                        </div>
                        <div class="w-full bg-gray-100 rounded-full h-2.5 relative">
                            <div class="progress-animate bg-green-400 h-2.5 rounded-full transition-all duration-1000 ease-out delay-200" style="width: 0%" data-width="100%"></div>
                            <span class="absolute right-0 -bottom-4 text-[10px] font-bold text-green-500 opacity-0 animate-fade-in delay-1000">100%</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- SECTION 2: TABEL PERATURAN -->
    <section class="reveal-up">
        <h2 class="text-2xl font-bold text-center text-[#172033] mb-8 reveal-up">Peraturan Desa Padangan</h2>
        
        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden reveal-up">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse min-w-[800px]">
                    <thead>
                        <tr class="bg-[#2F855A] text-white text-sm">
                            <th class="p-4 font-semibold w-16 text-center">No.</th>
                            <th class="p-4 font-semibold w-20 text-center">Tahun</th>
                            <th class="p-4 font-semibold w-32 text-center">Tanggal Upload</th>
                            <th class="p-4 font-semibold">Judul/Tentang</th>
                            <th class="p-4 font-semibold w-40 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tabel-berkas" class="text-sm text-gray-600">
                        
                        <?php 
                        // Dummy Data untuk Tabel
                        $dokumen = [
                            ['Permendes no.16 Tahun 2025 tentang prioritas penggunaan dana desa tahun 2026', 'Informasi tentang Peraturan, Keputusan, dan/atau Kebijakan', '14-09-2026'],
                            ['RKA smester 1', 'Rencana Kerja Pemerintah Desa', '11-08-2026'],
                            ['LAPORAN PEMERIKSAAN PEKERJAAN', 'Realisasi Pembangunan Desa', '06-08-2026'],
                            ['BUKU REALISASI PEMBANGUNAN SMSTER 1', 'Realisasi Pembangunan Desa', '02-06-2026'],
                            ['KERANGKA ACUAN KERJA PEMBANGUNAN JALAN RT.02-RT.03', 'Rencana Kerja Pemerintah Desa', '29-04-2026'],
                            ['Laporan Kinerja BPD Tahun 2025', 'Laporan Kinerja', '10-02-2026'] // Data ekstra untuk tes halaman 2
                        ];

                        foreach($dokumen as $index => $doc): 
                        ?>
                        <tr class="berkas-row border-b border-gray-100 hover:bg-gray-50 transition-colors">
                            <td class="p-4 text-center font-medium"><?= $index + 1 ?></td>
                            <td class="p-4 text-center">2026</td>
                            <td class="p-4 text-center text-gray-500"><?= $doc[2] ?></td>
                            <td class="p-4">
                                <p class="font-bold text-[#172033] mb-1"><?= $doc[0] ?></p>
                                <p class="text-xs text-gray-400"><?= $doc[1] ?></p>
                            </td>
                            <td class="p-4">
                                <div class="flex flex-col gap-2">
                                    <!-- Tombol Lihat Berkas (Membuka Modal PDF) -->
                                    <button onclick="bukaPdfModal('/assets/dummy.pdf')" class="flex items-center justify-center gap-1 px-3 py-1.5 border border-blue-200 text-blue-600 rounded-lg hover:bg-blue-50 transition-colors text-xs font-semibold">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                        Lihat Berkas
                                    </button>
                                    <!-- Tombol Download -->
                                    <a href="/assets/dummy.pdf" download class="flex items-center justify-center gap-1 px-3 py-1.5 bg-[#2F855A] text-white rounded-lg hover:bg-emerald-700 transition-colors text-xs font-semibold">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                        Download
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>
            </div>
            
            <!-- Pagination Container -->
            <div class="p-6 border-t border-gray-100 flex justify-center">
                <div id="pagination-container" class="flex items-center gap-2"></div>
            </div>
        </div>
    </section>

</main>

<!-- MODAL PDF VIEWER -->
<div id="pdf-modal" class="fixed inset-0 z-[60] bg-black/70 hidden flex items-center justify-center opacity-0 transition-opacity duration-300 backdrop-blur-sm reveal-up">
    <div class="bg-white w-[90%] md:w-[80%] max-w-5xl h-[85vh] rounded-2xl shadow-2xl flex flex-col overflow-hidden transform scale-95 transition-transform duration-300" id="pdf-modal-content">
        <!-- Header Modal -->
        <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50">
            <h3 class="font-bold text-[#172033]">Penampil Dokumen</h3>
            <button onclick="tutupPdfModal()" class="text-gray-400 hover:text-red-500 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
        <!-- Iframe Penampil PDF -->
        <div class="flex-1 bg-gray-200 relative">
            <iframe id="pdf-viewer" src="" class="w-full h-full border-0"></iframe>
        </div>
    </div>
</div>

<script src="/assets/js/ppid.js"></script>

<?php include '../app/views/layouts/footer.php'; ?>