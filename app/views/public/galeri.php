<?php include '../app/views/layouts/header.php'; ?>

<!-- HEADER HALAMAN -->
<section class="bg-[#F7F9FC] pt-32 pb-12 px-4 md:px-8 lg:px-[120px] text-center border-b border-gray-200 reveal-up">
    <h1 class="text-3xl md:text-5xl font-extrabold text-[#172033] mb-3 uppercase tracking-wide reveal-left">Galeri Desa Padangan</h1>
    <p class="text-gray-500 text-sm md:text-base max-w-xl mx-auto reveal-right">Dokumentasi kegiatan masyarakat Desa Padangan</p>
</section>

<!-- KONTEN UTAMA GALERI -->
<main class="px-4 md:px-8 lg:px-[120px] py-12 max-w-7xl mx-auto space-y-12">

    <!-- GRID GALERI (3 Kolom) -->
    <div id="galeri-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 reveal-up">
        
        <?php 
        // Data dummy untuk contoh galeri. Nanti bisa diganti dengan data dari Database.
        $kegiatan = ['Kegiatan Posyandu', 'Memperingati Maulid Nabi', 'Musyawarah Desa', 'Kerja Bakti', 'Kegiatan Posyandu', 'Memperingati Maulid Nabi'];
        $gambar = ['berita1.jpg', 'berita2.jpg', 'berita3.jpg', 'berita4.jpg', 'berita5.jpg', 'berita6.jpg'];
        
        // Looping untuk mencetak 12 kotak galeri (agar pagination bisa dites)
        for($i = 0; $i < 12; $i++): 
            $judul = $kegiatan[$i % 6];
            $imgSrc = "/assets/images/" . $gambar[$i % 6];
        ?>
        
        <!-- Item Galeri -->
        <div class="galeri-item group relative rounded-2xl overflow-hidden cursor-pointer shadow-sm bg-gray-200" onclick="bukaLightbox('<?= $imgSrc ?>', '<?= $judul ?>')">
            <!-- Gambar -->
            <img src="<?= $imgSrc ?>" alt="<?= $judul ?>" class="w-full h-64 object-cover transform transition-transform duration-700 group-hover:scale-110">
            
            <!-- Overlay Gradien Gelap di bawah agar teks terbaca -->
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/10 to-transparent opacity-90 transition-opacity duration-300"></div>
            
            <!-- Teks Judul -->
            <div class="absolute bottom-0 left-0 p-5 transform transition-transform duration-300 group-hover:-translate-y-1">
                <h3 class="text-white font-medium text-sm md:text-base"><?= $judul ?></h3>
            </div>
        </div>

        <?php endfor; ?>
        
    </div>

    <!-- KOMPONEN WIDGET & PAGINATION -->
    <div class="flex flex-col md:flex-row items-center justify-between pt-8 border-t border-gray-200 gap-6">
        
        <!-- Panggil Komponen Widget Visibilitas / Kunjungan -->
        <?php include '../app/views/components/visitor_card.php'; ?>

        <!-- Container untuk Tombol Navigasi Pagination (Di-generate oleh JS) -->
        <div id="pagination-container" class="flex items-center gap-2"></div>

        <!-- Panggil Komponen Widget Tombol Pengaduan -->
        <?php include '../app/views/components/pengaduan_widget.php'; ?>

    </div>

</main>

<!-- MODAL LIGHTBOX UNTUK GALERI -->
<div id="lightbox-modal" class="fixed inset-0 z-[60] bg-black/95 hidden flex flex-col items-center justify-center opacity-0 transition-opacity duration-300">
    <button onclick="tutupLightbox()" class="absolute top-6 right-8 text-white/70 hover:text-white text-4xl font-light transition-colors">&times;</button>
    
    <img id="lightbox-img" src="" class="max-w-[95%] max-h-[80vh] object-contain rounded-lg shadow-2xl transform scale-95 transition-transform duration-300">
    <p id="lightbox-caption" class="text-white mt-6 text-lg font-medium tracking-wide"></p>
</div>

<!-- SCRIPT INTERAKTIF (Pagination & Lightbox) -->
<script src="/assets/js/galeri.js"></script>

<?php include '../app/views/layouts/footer.php'; ?>