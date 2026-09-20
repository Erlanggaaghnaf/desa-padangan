<!-- HERO SECTION (Rasio proporsional desktop mendekati 1440x800px) -->
<section class="relative w-full h-[60vh] md:h-[75vh] lg:h-[800px] bg-cover bg-center flex items-center justify-center text-center px-4" 
         style="background-image: url('assets/images/Hero.png');">

    <div class="absolute inset-0 bg-black/50 z-10"></div>
    <div class="relative z-20 text-white max-w-3xl">
        <p class="text-sm font-semibold drop-shadow-lg md:text-base uppercase tracking-wider mb-2">Selamat Datang di</p>
        <h2 class="text-3xl md:text-5xl font-extrabold drop-shadow-xl mb-3">Website Resmi Desa Padangan</h2>
        <p class="text-lg md:text-xl text-gray-200 drop-shadow-xl font-semibold">Kecamatan Ngantru, Kabupaten Tulungagung</p>
    </div>

    <!-- Floating Card Statistik Pengunjung (Kiri Bawah dengan margin 120px di desktop) -->
    <div class="absolute bottom-6 md:bottom-12 left-4 md:left-8 lg:left-[120px] z-30">
        <?php include '../app/views/components/visitor_card.php'; ?>
    </div>
    
   <!-- Memanggil Komponen Tombol Pengaduan (Kanan Bawah) -->
    <div class="absolute bottom-6 md:bottom-12 right-4 md:right-8 lg:right-[120px] z-30">
        <?php include '../app/views/components/pengaduan_widget.php'; ?>
    </div>
</section>

<!-- MAIN CONTENT WRAPPER (Padding horizontal responsif dengan target lg:px-[120px]) -->
<main class="px-4 md:px-8 lg:px-[120px] py-12 space-y-20">

    <!-- 4. SAMBUTAN KEPALA DESA -->
    <section class="flex flex-col md:flex-row gap-8 items-center bg-[#F7F9FC] p-6 md:p-10 rounded-3xl border border-gray-100 shadow-sm">
        <div class="w-48 h-48 md:w-64 md:h-64 flex-shrink-0">
            <img src="assets/images/kepala-desa.jpg" alt="Kepala Desa" class="w-full h-full object-cover rounded-2xl shadow-lg border-4 border-white">
        </div>
        <div>
            <h2 class="text-2xl md:text-3xl font-bold text-[#172033] mb-4">Sambutan Kepala Desa</h2>
            <div class="h-1 w-28 bg-[#2F855A] rounded-full mb-4"></div>
            <p class="text-gray-600 leading-relaxed mb-4 text-sm md:text-base">
                Selamat datang di website resmi Desa Padangan. Melalui portal ini, kami berkomitmen untuk memberikan transparansi informasi, mempermudah pelayanan publik, dan memperkenalkan potensi desa kepada masyarakat luas.
            </p>
            <p class="font-bold text-[#172033]">Slamet Riyadi, S.Pd.</p>
        </div>
    </section>

    <!-- 5. SOTK (Struktur Organisasi) -->
    <section>
        <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-6 gap-2">
            <div>
                <h3 class="text-2xl font-bold text-[#172033]">SOTK</h3>
                <p class="text-sm text-gray-500">Profil Struktur Organisasi Tata Kerja Desa Padangan</p>
            </div>
            <a href="#" class="text-sm text-[#2563B8] font-semibold hover:underline">Lihat Semua Perangkat &rarr;</a>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            <div class="bg-white rounded-2xl overflow-hidden border border-gray-200 shadow-sm text-center pb-4 hover:shadow-md transition-shadow">
                <img src="assets/images/perangkat1.jpg" alt="Perangkat" class="w-full h-56 object-cover object-top mb-3">
                <h4 class="font-bold text-[#172033] text-sm md:text-base px-2">Slamet Riyadi, S.Pd</h4>
                <p class="text-xs md:text-sm font-semibold text-[#2F855A] mt-1">Kepala Desa</p>
            </div>
            <div class="bg-white rounded-2xl overflow-hidden border border-gray-200 shadow-sm text-center pb-4 hover:shadow-md transition-shadow">
                <img src="assets/images/perangkat1.jpg" alt="Perangkat" class="w-full h-56 object-cover object-top mb-3">
                <h4 class="font-bold text-[#172033] text-sm md:text-base px-2">Slamet Riyadi, S.Pd</h4>
                <p class="text-xs md:text-sm font-semibold text-[#2F855A] mt-1">Kepala Desa</p>
            </div>
            <div class="bg-white rounded-2xl overflow-hidden border border-gray-200 shadow-sm text-center pb-4 hover:shadow-md transition-shadow">
                <img src="assets/images/perangkat1.jpg" alt="Perangkat" class="w-full h-56 object-cover object-top mb-3">
                <h4 class="font-bold text-[#172033] text-sm md:text-base px-2">Slamet Riyadi, S.Pd</h4>
                <p class="text-xs md:text-sm font-semibold text-[#2F855A] mt-1">Kepala Desa</p>
            </div>
            <div class="bg-white rounded-2xl overflow-hidden border border-gray-200 shadow-sm text-center pb-4 hover:shadow-md transition-shadow">
                <img src="assets/images/perangkat1.jpg" alt="Perangkat" class="w-full h-56 object-cover object-top mb-3">
                <h4 class="font-bold text-[#172033] text-sm md:text-base px-2">Slamet Riyadi, S.Pd</h4>
                <p class="text-xs md:text-sm font-semibold text-[#2F855A] mt-1">Kepala Desa</p>
            </div>
        </div>
    </section>

    <!-- 6. PETA WILAYAH -->
    <section class="flex flex-col lg:flex-row justify-between items-center gap-8">
        <div class="lg:w-1/2">
            <h3 class="text-2xl font-bold text-[#172033] mb-2">PETA WILAYAH</h3>
            <p class="text-sm text-gray-500 leading-relaxed">
                Peta batas wilayah administratif Desa Padangan,<br>
                Kecamatan Ngantru,<br>
                Kabupaten Tulungagung
            </p>
        </div>
        <div class="w-full lg:w-1/2 h-64 md:h-80 rounded-2xl overflow-hidden shadow-sm border border-gray-200 bg-gray-200 flex items-center justify-center">
            <img src="assets/images/peta.jpg" alt="Peta Wilayah" class="w-full h-full object-cover">
        </div>
    </section>

    <!-- 7. BERITA DESA -->
    <section>
        <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-6 gap-2">
            <div>
                <h3 class="text-2xl font-bold text-[#172033]">Berita Desa</h3>
                <p class="text-sm text-gray-500">Simak perkembangan terbaru dari Desa Padangan</p>
            </div>
            <a href="#" class="text-sm text-[#2563B8] font-semibold hover:underline">Lihat Semua Berita &rarr;</a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden flex flex-col h-full hover:shadow-md transition-shadow">
                <img src="assets/images/berita1.jpg" class="w-full h-40 object-cover" alt="Berita">
                <div class="p-4 flex flex-col flex-grow">
                    <div class="flex items-center text-[11px] text-gray-400 mb-2 gap-1">
                        <span>📅 12 Sep 2026</span>
                        <span class="mx-1">•</span>
                        <span>👤 Admin</span>
                    </div>
                    <h4 class="font-bold text-[#172033] text-sm mb-2 line-clamp-2 leading-snug">Rapat Pleno Musrenbangdes Tahun Anggaran 2027</h4>
                    <p class="text-xs text-gray-500 line-clamp-2 mb-4 flex-grow">Pemerintah Desa Padangan melaksanakan rapat pleno untuk menyusun rencana...</p>
                    <a href="#" class="text-xs font-semibold text-[#2F855A] hover:underline mt-auto">Baca selengkapnya &rarr;</a>
                </div>
            </div>
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden flex flex-col h-full hover:shadow-md transition-shadow">
                <img src="assets/images/berita1.jpg" class="w-full h-40 object-cover" alt="Berita">
                <div class="p-4 flex flex-col flex-grow">
                    <div class="flex items-center text-[11px] text-gray-400 mb-2 gap-1">
                        <span>📅 12 Sep 2026</span>
                        <span class="mx-1">•</span>
                        <span>👤 Admin</span>
                    </div>
                    <h4 class="font-bold text-[#172033] text-sm mb-2 line-clamp-2 leading-snug">Rapat Pleno Musrenbangdes Tahun Anggaran 2027</h4>
                    <p class="text-xs text-gray-500 line-clamp-2 mb-4 flex-grow">Pemerintah Desa Padangan melaksanakan rapat pleno untuk menyusun rencana...</p>
                    <a href="#" class="text-xs font-semibold text-[#2F855A] hover:underline mt-auto">Baca selengkapnya &rarr;</a>
                </div>
            </div>
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden flex flex-col h-full hover:shadow-md transition-shadow">
                <img src="assets/images/berita1.jpg" class="w-full h-40 object-cover" alt="Berita">
                <div class="p-4 flex flex-col flex-grow">
                    <div class="flex items-center text-[11px] text-gray-400 mb-2 gap-1">
                        <span>📅 12 Sep 2026</span>
                        <span class="mx-1">•</span>
                        <span>👤 Admin</span>
                    </div>
                    <h4 class="font-bold text-[#172033] text-sm mb-2 line-clamp-2 leading-snug">Rapat Pleno Musrenbangdes Tahun Anggaran 2027</h4>
                    <p class="text-xs text-gray-500 line-clamp-2 mb-4 flex-grow">Pemerintah Desa Padangan melaksanakan rapat pleno untuk menyusun rencana...</p>
                    <a href="#" class="text-xs font-semibold text-[#2F855A] hover:underline mt-auto">Baca selengkapnya &rarr;</a>
                </div>
            </div>
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden flex flex-col h-full hover:shadow-md transition-shadow">
                <img src="assets/images/berita1.jpg" class="w-full h-40 object-cover" alt="Berita">
                <div class="p-4 flex flex-col flex-grow">
                    <div class="flex items-center text-[11px] text-gray-400 mb-2 gap-1">
                        <span>📅 12 Sep 2026</span>
                        <span class="mx-1">•</span>
                        <span>👤 Admin</span>
                    </div>
                    <h4 class="font-bold text-[#172033] text-sm mb-2 line-clamp-2 leading-snug">Rapat Pleno Musrenbangdes Tahun Anggaran 2027</h4>
                    <p class="text-xs text-gray-500 line-clamp-2 mb-4 flex-grow">Pemerintah Desa Padangan melaksanakan rapat pleno untuk menyusun rencana...</p>
                    <a href="#" class="text-xs font-semibold text-[#2F855A] hover:underline mt-auto">Baca selengkapnya &rarr;</a>
                </div>
            </div>
        </div>
    </section>

    <!-- 8. POTENSI DESA -->
    <section>
        <div class="mb-6">
            <h3 class="text-2xl font-bold text-[#172033]">Potensi Desa</h3>
            <p class="text-sm text-gray-500">Ragam potensi ekonomi dan sumber daya alam</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-4 flex gap-4 items-center hover:shadow-md transition-shadow">
                <img src="assets/images/potensi1.jpg" class="w-24 h-24 rounded-xl object-cover flex-shrink-0" alt="Pertanian">
                <div>
                    <h4 class="font-bold text-[#2F855A] flex items-center gap-2 mb-1">
                        <span class="text-lg">🌾</span> Pertanian
                    </h4>
                    <p class="text-xs text-gray-500 line-clamp-3">Desa Padangan dikenal dengan hasil bumi unggulan berupa padi dan jagung yang menjadi sumber utama perekonomian warga.</p>
                </div>
            </div>
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-4 flex gap-4 items-center hover:shadow-md transition-shadow">
                <img src="assets/images/potensi2.jpg" class="w-24 h-24 rounded-xl object-cover flex-shrink-0" alt="Peternakan">
                <div>
                    <h4 class="font-bold text-[#2F855A] flex items-center gap-2 mb-1">
                        <span class="text-lg">🐄</span> Peternakan
                    </h4>
                    <p class="text-xs text-gray-500 line-clamp-3">Sektor peternakan sapi perah dan kambing etawa menjadi salah satu komoditas penyumbang PADes.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- 9. GALERI DESA -->
    <section>
        <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-6 gap-2">
            <div>
                <h3 class="text-2xl font-bold text-[#172033]">Galeri Desa</h3>
                <p class="text-sm text-gray-500">Dokumentasi kegiatan masyarakat dan pembangunan</p>
            </div>
            <a href="#" class="text-sm text-[#2563B8] font-semibold hover:underline">Lihat Semua Foto &rarr;</a>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="relative rounded-2xl overflow-hidden group h-40 shadow-sm">
                <img src="assets/images/galeri1.jpg" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" alt="Galeri">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent flex items-end p-3">
                    <p class="text-white text-xs font-semibold line-clamp-2">Kerja Bakti Pengecoran Jalan</p>
                </div>
            </div>
            <div class="relative rounded-2xl overflow-hidden group h-40 shadow-sm">
                <img src="assets/images/galeri1.jpg" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" alt="Galeri">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent flex items-end p-3">
                    <p class="text-white text-xs font-semibold line-clamp-2">Kerja Bakti Pengecoran Jalan</p>
                </div>
            </div>
            <div class="relative rounded-2xl overflow-hidden group h-40 shadow-sm">
                <img src="assets/images/galeri1.jpg" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" alt="Galeri">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent flex items-end p-3">
                    <p class="text-white text-xs font-semibold line-clamp-2">Kerja Bakti Pengecoran Jalan</p>
                </div>
            </div>
            <div class="relative rounded-2xl overflow-hidden group h-40 shadow-sm">
                <img src="assets/images/galeri1.jpg" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" alt="Galeri">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent flex items-end p-3">
                    <p class="text-white text-xs font-semibold line-clamp-2">Kerja Bakti Pengecoran Jalan</p>
                </div>
            </div>
        </div>
    </section>

</main>