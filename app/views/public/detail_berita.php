<?php include '../app/views/layouts/header.php'; ?>

<!-- BACKGROUND UTAMA -->
<div class="bg-[#F7F9FC] pt-32 pb-12 px-4 md:px-8 lg:px-[120px] min-h-screen">
    
    <!-- WADAH ARTIKEL -->
    <main class="max-w-4xl mx-auto bg-white rounded-3xl border border-gray-100 shadow-sm p-6 md:p-10 mb-12">
        
        <!-- Breadcrumb -->
        <nav class="flex items-center text-sm text-gray-500 mb-6 gap-2">
            <a href="/index.php" class="hover:text-[#2F855A] transition-colors flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
            </a>
            <span>/</span>
            <a href="/index.php?url=Berita" class="hover:text-[#2F855A] transition-colors">Berita Desa Padangan</a>
        </nav>

        <!-- Judul & Meta Data -->
        <h1 class="text-3xl md:text-4xl font-extrabold text-[#172033] mb-4 leading-tight">
            UMKM Desa Padangan Tampil di Festival Kecamatan
        </h1>
        <div class="flex items-center gap-4 text-sm text-gray-500 mb-8 pb-6 border-b border-gray-100">
            <span class="flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                30 Mei 2024
            </span>
            <span class="flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                Dilihat 100 kali
            </span>
        </div>

        <!-- Gambar Utama (Interaktif: Bisa di-klik untuk Zoom) -->
        <div class="mb-8 overflow-hidden rounded-2xl group cursor-pointer" onclick="bukaModalGambar(this.querySelector('img').src)">
            <img src="/assets/images/berita_detail.jpg" alt="Ilustrasi Berita" class="w-full h-auto object-cover transform transition-transform duration-500 group-hover:scale-105">
            <p class="text-center text-xs text-gray-400 mt-2 italic">Klik gambar untuk memperbesar</p>
        </div>

        <!-- Isi Konten Artikel -->
        <article class="prose prose-gray max-w-none text-gray-600 leading-relaxed space-y-6 text-justify">
            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            </p>
            <p>
                Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?
            </p>
        </article>

        <!-- Tombol Interaktif Bagikan -->
        <div class="mt-10 pt-6 border-t border-gray-100 flex items-center justify-between">
            <span class="font-semibold text-[#172033]">Bagikan artikel ini:</span>
            <button onclick="salinTautan()" id="btn-copy" class="flex items-center gap-2 px-4 py-2 bg-gray-50 hover:bg-gray-100 text-gray-600 rounded-lg border border-gray-200 transition-colors text-sm font-medium">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                <span>Salin Tautan</span>
            </button>
        </div>

    </main>

    <!-- SECTION BERITA LAINNYA -->
    <section class="max-w-7xl mx-auto mb-12">
        <h2 class="text-2xl font-bold text-[#172033] mb-6">Berita Lainnya</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            
            <!-- Berita 1 -->
            <article class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden flex flex-col justify-between hover:shadow-md transition-shadow">
                <div>
                    <img src="/assets/images/berita1.jpg" alt="Tahun Baru" class="w-full h-40 object-cover">
                    <div class="p-5 space-y-2">
                        <div class="text-[11px] text-gray-400">30 Mei 2024 | 👁️ 100 kali</div>
                        <h3 class="text-base font-bold text-[#172033] leading-snug hover:text-[#2F855A] cursor-pointer line-clamp-2">Warga Merayakan Tahun Baru Bersama</h3>
                    </div>
                </div>
                <div class="px-5 pb-5">
                    <a href="#" class="text-sm font-semibold text-[#2F855A] hover:underline">Baca selengkapnya &rarr;</a>
                </div>
            </article>

            <!-- Berita 2 -->
            <article class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden flex flex-col justify-between hover:shadow-md transition-shadow">
                <div>
                    <img src="/assets/images/berita5.jpg" alt="RKPDes" class="w-full h-40 object-cover">
                    <div class="p-5 space-y-2">
                        <div class="text-[11px] text-gray-400">30 Mei 2024 | 👁️ 100 kali</div>
                        <h3 class="text-base font-bold text-[#172033] leading-snug hover:text-[#2F855A] cursor-pointer line-clamp-2">Musyawarah Desa Bahas RKPDes 2026</h3>
                    </div>
                </div>
                <div class="px-5 pb-5">
                    <a href="#" class="text-sm font-semibold text-[#2F855A] hover:underline">Baca selengkapnya &rarr;</a>
                </div>
            </article>

            <!-- Berita 3 -->
            <article class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden flex flex-col justify-between hover:shadow-md transition-shadow">
                <div>
                    <img src="/assets/images/berita6.jpg" alt="Prestasi" class="w-full h-40 object-cover">
                    <div class="p-5 space-y-2">
                        <div class="text-[11px] text-gray-400">30 Mei 2024 | 👁️ 100 kali</div>
                        <h3 class="text-base font-bold text-[#172033] leading-snug hover:text-[#2F855A] cursor-pointer line-clamp-2">Warga Desa Padangan Meraih Prestasi</h3>
                    </div>
                </div>
                <div class="px-5 pb-5">
                    <a href="#" class="text-sm font-semibold text-[#2F855A] hover:underline">Baca selengkapnya &rarr;</a>
                </div>
            </article>

        </div>
    </section>

    <!-- KOMPONEN WIDGET BAWAH -->
    <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between pt-8 border-t border-gray-200 gap-6">
        <!-- Komponen Visibilitas -->
        <?php include '../app/views/components/visitor_card.php'; ?>
        
        <!-- Komponen Pengaduan -->
        <?php include '../app/views/components/pengaduan_widget.php'; ?>
    </div>

</div>

<!-- MODAL LIGHTBOX UNTUK GAMBAR (Tersembunyi secara default) -->
<div id="image-modal" class="fixed inset-0 z-50 bg-black/90 hidden flex items-center justify-center opacity-0 transition-opacity duration-300" onclick="tutupModalGambar()">
    <span class="absolute top-6 right-8 text-white text-4xl cursor-pointer hover:text-gray-300">&times;</span>
    <img id="modal-img" src="" class="max-w-[90%] max-h-[90vh] object-contain rounded-lg shadow-2xl transform scale-95 transition-transform duration-300">
</div>

<!-- SCRIPT INTERAKTIF (Lightbox & Copy Link) -->
<script src="/assets/js/detail_berita.js"></script>

<?php include '../app/views/layouts/footer.php'; ?>