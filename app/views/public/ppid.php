<!-- HEADER HALAMAN -->
<section class="bg-[#F7F9FC] pt-32 pb-12 px-4 md:px-8 lg:px-[120px] text-center border-b border-gray-200 reveal-up">
    <h1 class="text-3xl md:text-4xl font-extrabold text-[#172033] mb-3 reveal-left">Transparansi Publik & Desa Padangan</h1>
    <p class="text-gray-500 text-sm md:text-base max-w-2xl mx-auto reveal-right">Komitmen penuh Pemerintah Desa Padangan, Kec. Ngantru, Kab. Tulungagung dalam mewujudkan tata kelola pemerintahan yang terbuka, akuntabel, dan partisipatif sesuai amanat UU No. 14 Tahun 2008.</p>
</section>

<!-- KONTEN UTAMA -->
<main class="px-4 md:px-8 lg:px-[120px] py-12 max-w-7xl mx-auto space-y-16 reveal-up">

    <!-- TABEL PERATURAN -->
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
                        <?php if (empty($data['dokumen'])): ?>
                            <tr>
                                <td colspan="5" class="p-8 text-center text-gray-400">Belum ada dokumen PPID yang diunggah.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach($data['dokumen'] as $index => $doc): 
                                $tanggal = !empty($doc['tanggal_upload']) ? date('d-m-Y', strtotime($doc['tanggal_upload'])) : '-';
                                $namaFileAsli = $doc['file'] ?? '';
                                $judul = $doc['judul'] ?? '';
                                $deskripsi = $doc['deskripsi'] ?? 'Informasi tentang Peraturan, Keputusan, dan/atau Kebijakan';
                                $tahun = $doc['tahun'] ?? '-';
                            ?>
                            <tr class="berkas-row border-b border-gray-100 hover:bg-gray-50 transition-colors">
                                <td class="p-4 text-center font-medium"><?= $index + 1 ?></td>
                                <td class="p-4 text-center"><?= $tahun ?></td>
                                <td class="p-4 text-center text-gray-500"><?= $tanggal ?></td>
                                <td class="p-4">
                                    <p class="font-bold text-[#172033] mb-1 uppercase"><?= htmlspecialchars($judul) ?></p>
                                    <?php if (!empty($doc['deskripsi'])): ?>
                                        <p class="text-xs text-gray-400"><?= htmlspecialchars($doc['deskripsi']) ?></p>
                                    <?php else: ?>
                                        <p class="text-xs text-gray-400 italic">Tidak ada deskripsi dokumen.</p>
                                    <?php endif; ?>
                                </td>
                                <td class="p-4">
                                    <div class="flex flex-col gap-2">
                                        <!-- Tombol Lihat Berkas (Membuka Modal PDF dengan file asli) -->
                                        <button onclick="bukaPdfModal('uploads/ppid/<?= $namaFileAsli ?>')" class="flex items-center justify-center gap-1 px-3 py-1.5 border border-blue-200 text-blue-600 rounded-lg hover:bg-blue-50 transition-colors text-xs font-semibold">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                            Lihat Berkas
                                        </button>
                                        <!-- Tombol Download dengan nama file sesuai judul -->
                                        <button onclick="downloadDokumenPublik('<?= $namaFileAsli ?>', '<?= addslashes($judul) ?>')" class="flex items-center justify-center gap-1 px-3 py-1.5 bg-[#2F855A] text-white rounded-lg hover:bg-emerald-700 transition-colors text-xs font-semibold">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                            Download
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
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

<script src="assets/js/ppid.js"></script>