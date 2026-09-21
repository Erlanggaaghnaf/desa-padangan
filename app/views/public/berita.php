<?php include '../app/views/layouts/header.php'; ?>

<!-- HEADER HALAMAN -->
<section class="bg-[#F7F9FC] pt-32 pb-12 px-4 md:px-8 lg:px-[120px] text-center border-b border-gray-200">
    <h1 class="text-3xl md:text-5xl font-extrabold text-[#172033] mb-3">Berita Desa Padangan</h1>
    <p class="text-gray-500 text-sm md:text-base max-w-xl mx-auto">Informasi dan kabar terbaru dari Desa Padangan</p>
</section>

<!-- KONTEN UTAMA BERITA -->
<main class="px-4 md:px-8 lg:px-[120px] py-12 max-w-7xl mx-auto space-y-12">

    <!-- GRID KARTU BERITA (Tambahkan class 'berita-item' pada setiap article) -->
    <div id="berita-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        
        <!-- Nanti bagian ini bisa Anda ganti dengan perulangan foreach dari Database -->
        <!-- Berita Item 1 -->
        <article class="berita-item bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden flex flex-col justify-between hover:shadow-md transition-shadow">
            <div>
                <img src="/assets/images/berita1.jpg" alt="Musyawarah" class="w-full h-48 object-cover">
                <div class="p-6 space-y-3">
                    <div class="flex items-center gap-4 text-xs text-gray-400">
                        <span>📅 30 Mei 2024</span><span>👁️ Dilihat 100 kali</span>
                    </div>
                    <h3 class="text-lg font-bold text-[#172033] leading-snug hover:text-[#2F855A] cursor-pointer">Musyawarah Desa Bahas RKPDes 2027</h3>
                    <p class="text-sm text-gray-500 line-clamp-2">Pemerintah Desa Padangan melakukan musyawarah desa untuk membahas RKPDes...</p>
                </div>
            </div>
            <div class="px-6 pb-6">
                <a href="/index.php?url=DetailBerita" class="text-sm font-semibold text-[#2F855A] hover:underline flex items-center gap-1">Baca selengkapnya &rarr;</a>
            </div>
        </article>

        <!-- Berita Item 2 -->
        <article class="berita-item bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden flex flex-col justify-between hover:shadow-md transition-shadow">
            <div>
                <img src="/assets/images/berita2.jpg" alt="Jalan" class="w-full h-48 object-cover">
                <div class="p-6 space-y-3">
                    <div class="flex items-center gap-4 text-xs text-gray-400">
                        <span>📅 30 Mei 2024</span><span>👁️ Dilihat 100 kali</span>
                    </div>
                    <h3 class="text-lg font-bold text-[#172033] leading-snug hover:text-[#2F855A] cursor-pointer">Pembangunan Jalan Desa Tahap II Dimulai</h3>
                    <p class="text-sm text-gray-500 line-clamp-2">Pemerintah Desa Padangan terus berkomitmen untuk menunjang aktivitas masyarakat...</p>
                </div>
            </div>
            <div class="px-6 pb-6">
                <a href="#" class="text-sm font-semibold text-[#2F855A] hover:underline flex items-center gap-1">Baca selengkapnya &rarr;</a>
            </div>
        </article>

        <!-- Berita Item 3 -->
        <article class="berita-item bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden flex flex-col justify-between hover:shadow-md transition-shadow">
            <div>
                <img src="/assets/images/berita3.jpg" alt="UMKM" class="w-full h-48 object-cover">
                <div class="p-6 space-y-3">
                    <div class="flex items-center gap-4 text-xs text-gray-400">
                        <span>📅 30 Mei 2024</span><span>👁️ Dilihat 100 kali</span>
                    </div>
                    <h3 class="text-lg font-bold text-[#172033] leading-snug hover:text-[#2F855A] cursor-pointer">UMKM Desa Padangan Tampil di Festival Kecamatan</h3>
                    <p class="text-sm text-gray-500 line-clamp-2">Produk olahan pangan Desa Padangan ikut serta dalam festival UMKM tingkat kecamatan...</p>
                </div>
            </div>
            <div class="px-6 pb-6">
                <a href="#" class="text-sm font-semibold text-[#2F855A] hover:underline flex items-center gap-1">Baca selengkapnya &rarr;</a>
            </div>
        </article>

        <!-- Berita Item 4 -->
        <article class="berita-item bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden flex flex-col justify-between hover:shadow-md transition-shadow">
            <div>
                <img src="/assets/images/berita4.jpg" alt="Tahun Baru" class="w-full h-48 object-cover">
                <div class="p-6 space-y-3">
                    <div class="flex items-center gap-4 text-xs text-gray-400">
                        <span>📅 30 Mei 2024</span><span>👁️ Dilihat 100 kali</span>
                    </div>
                    <h3 class="text-lg font-bold text-[#172033] leading-snug hover:text-[#2F855A] cursor-pointer">Warga Merayakan Tahun Baru Bersama</h3>
                    <p class="text-sm text-gray-500 line-clamp-2">Dalam rangka merayakan tahun baru 2026, warga desa berkumpul dan merayakan kegiatan...</p>
                </div>
            </div>
            <div class="px-6 pb-6">
                <a href="#" class="text-sm font-semibold text-[#2F855A] hover:underline flex items-center gap-1">Baca selengkapnya &rarr;</a>
            </div>
        </article>

        <!-- Berita Item 5 -->
        <article class="berita-item bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden flex flex-col justify-between hover:shadow-md transition-shadow">
            <div>
                <img src="/assets/images/berita5.jpg" alt="RKPDes" class="w-full h-48 object-cover">
                <div class="p-6 space-y-3">
                    <div class="flex items-center gap-4 text-xs text-gray-400">
                        <span>📅 30 Mei 2024</span><span>👁️ Dilihat 100 kali</span>
                    </div>
                    <h3 class="text-lg font-bold text-[#172033] leading-snug hover:text-[#2F855A] cursor-pointer">Musyawarah Desa Bahas RKPDes 2026</h3>
                    <p class="text-sm text-gray-500 line-clamp-2">Melalui serangkaian musyawarah desa untuk menyusun rencana pembangunan...</p>
                </div>
            </div>
            <div class="px-6 pb-6">
                <a href="#" class="text-sm font-semibold text-[#2F855A] hover:underline flex items-center gap-1">Baca selengkapnya &rarr;</a>
            </div>
        </article>

        <!-- Berita Item 6 -->
        <article class="berita-item bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden flex flex-col justify-between hover:shadow-md transition-shadow">
            <div>
                <img src="/assets/images/berita6.jpg" alt="Prestasi" class="w-full h-48 object-cover">
                <div class="p-6 space-y-3">
                    <div class="flex items-center gap-4 text-xs text-gray-400">
                        <span>📅 30 Mei 2024</span><span>👁️ Dilihat 100 kali</span>
                    </div>
                    <h3 class="text-lg font-bold text-[#172033] leading-snug hover:text-[#2F855A] cursor-pointer">Warga Desa Padangan Meraih Prestasi</h3>
                    <p class="text-sm text-gray-500 line-clamp-2">Putra-putri warga Desa Padangan menorehkan prestasi membanggakan dalam ajang...</p>
                </div>
            </div>
            <div class="px-6 pb-6">
                <a href="#" class="text-sm font-semibold text-[#2F855A] hover:underline flex items-center gap-1">Baca selengkapnya &rarr;</a>
            </div>
        </article>
        
        <!-- Berita Item 7 (Contoh untuk menguji fitur pindah ke Halaman 2) -->
        <article class="berita-item bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden flex flex-col justify-between hover:shadow-md transition-shadow">
            <div>
                <img src="/assets/images/berita7.jpg" alt="Panen Raya" class="w-full h-48 object-cover bg-gray-200">
                <div class="p-6 space-y-3">
                    <div class="flex items-center gap-4 text-xs text-gray-400">
                        <span>📅 01 Juni 2024</span><span>👁️ Dilihat 85 kali</span>
                    </div>
                    <h3 class="text-lg font-bold text-[#172033] leading-snug hover:text-[#2F855A] cursor-pointer">Panen Raya Petani Desa Padangan</h3>
                    <p class="text-sm text-gray-500 line-clamp-2">Hasil panen tahun ini mengalami peningkatan signifikan berkat penyuluhan pertanian modern...</p>
                </div>
            </div>
            <div class="px-6 pb-6">
                <a href="#" class="text-sm font-semibold text-[#2F855A] hover:underline flex items-center gap-1">Baca selengkapnya &rarr;</a>
            </div>
        </article>

    </div>

    <!-- KOMPONEN WIDGET & PAGINATION -->
    <div class="flex flex-col md:flex-row items-center justify-between pt-8 border-t border-gray-200 gap-6">
        
        <!-- Panggil Komponen Widget Visibilitas / Kunjungan Hari Ini -->
        <?php include '../app/views/components/visitor_card.php'; ?>

        <!-- Container untuk Tombol Navigasi Pagination (Di-generate oleh JS) -->
        <div id="pagination-container" class="flex items-center gap-2">
            <!-- Tombol angka akan muncul secara dinamis di sini -->
        </div>

        <!-- Panggil Komponen Widget Tombol Pengaduan -->
        <?php include '../app/views/components/pengaduan_widget.php'; ?>

    </div>

</main>

<!-- SCRIPT INTERAKTIF PAGINATION (TERHUBUNG DENGAN KARTU BERITA) -->
<script src="/assets/js/berita.js"></script>

<?php include '../app/views/layouts/footer.php'; ?>