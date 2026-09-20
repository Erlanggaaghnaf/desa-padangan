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
    <div class="absolute bottom-6 md:bottom-12 left-4 md:left-8 lg:left-[120px] z-30 bg-white px-4 md:px-5 py-3 rounded-2xl shadow-2xl flex items-center gap-3 border border-gray-100 transform transition-transform hover:-translate-y-1">
        <div class="bg-blue-50 p-2 rounded-xl text-blue-600">
            <svg width="22" height="16" viewBox="0 0 22 16" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M1.06251 7.65138C0.979165 7.8759 0.979165 8.12287 1.06251 8.34738C1.87421 10.3155 3.25202 11.9983 5.02128 13.1825C6.79053 14.3666 8.87155 14.9988 11.0005 14.9988C13.1295 14.9988 15.2105 14.3666 16.9797 13.1825C18.749 11.9983 20.1268 10.3155 20.9385 8.34738C21.0218 8.12287 21.0218 7.8759 20.9385 7.65138C20.1268 5.68324 18.749 4.00042 16.9797 2.81628C15.2105 1.63214 13.1295 1 11.0005 1C8.87155 1 6.79053 1.63214 5.02128 2.81628C3.25202 4.00042 1.87421 5.68324 1.06251 7.65138Z" stroke="#2563EB" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M11.0005 10.9994C12.6574 10.9994 14.0005 9.65624 14.0005 7.99938C14.0005 6.34253 12.6574 4.99938 11.0005 4.99938C9.34365 4.99938 8.00051 6.34253 8.00051 7.99938C8.00051 9.65624 9.34365 10.9994 11.0005 10.9994Z" stroke="#2563EB" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>
        <div class="text-left">
            <p class="text-[10px] md:text-xs text-gray-400 font-semibold uppercase tracking-wider mb-0.5">Kunjungan Hari Ini</p>
            <p class="font-bold text-gray-900 text-sm md:text-lg leading-none">1,245</p>
        </div>
    </div>
    
    <!-- Floating Button Pengaduan (Kanan Bawah dengan margin 120px di desktop) -->
    <button onclick="toggleModal('pengaduanModal')" class="absolute bottom-6 md:bottom-12 right-4 md:right-8 lg:right-[120px] z-30 bg-[#2F855A] hover:bg-green-700 text-white px-5 md:px-6 py-3 rounded-full shadow-2xl font-semibold flex items-center gap-2 transform transition-transform hover:-translate-y-1">
        <span class="flex items-center">
            <svg width="20" height="20" viewBox="0 0 24 23" fill="none" xmlns="http://www.w3.org/2000/svg"> 
                <path d="M3 10H6C6.53043 10 7.03914 10.2107 7.41421 10.5858C7.78929 10.9609 8 11.4696 8 12V15C8 15.5304 7.78929 16.0391 7.41421 16.4142C7.03914 16.7893 6.53043 17 6 17H5C4.46957 17 3.96086 16.7893 3.58579 16.4142C3.21071 16.0391 3 15.5304 3 15V10ZM3 10C3 8.8181 3.23279 7.64778 3.68508 6.55585C4.13738 5.46392 4.80031 4.47177 5.63604 3.63604C6.47177 2.80031 7.46392 2.13738 8.55585 1.68508C9.64778 1.23279 10.8181 1 12 1C13.1819 1 14.3522 1.23279 15.4442 1.68508C16.5361 2.13738 17.5282 2.80031 18.364 3.63604C19.1997 4.47177 19.8626 5.46392 20.3149 6.55585C20.7672 7.64778 21 8.8181 21 10M21 10V15M21 10H18C17.4696 10 16.9609 10.2107 16.5858 10.5858C16.2107 10.9609 16 11.4696 16 12V15C16 15.5304 16.2107 16.0391 16.5858 16.4142C16.9609 16.7893 17.4696 17 18 17H19C19.5304 17 20.0391 16.7893 20.4142 16.4142C20.7893 16.0391 21 15.5304 21 15M21 15V17C21 18.0609 20.5786 19.0783 19.8284 19.8284C19.0783 20.5786 18.0609 21 17 21H12" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </span>
        <span class="text-sm md:text-base">Pengaduan Desa</span>
    </button>
</section>

<!-- MODAL FORM PENGADUAN -->
<div id="pengaduanModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 hidden px-4">
    <div class="bg-white w-full max-w-lg rounded-2xl shadow-2xl p-6 relative">
        <button onclick="toggleModal('pengaduanModal')" class="absolute top-4 right-4 text-gray-400 hover:text-red-500 text-2xl leading-none">&times;</button>
        <h3 class="text-2xl font-bold mb-6 text-center text-[#172033]">Pengaduan Desa</h3>
        
        <form action="#" method="POST">
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                <input type="text" class="w-full border border-gray-300 rounded-xl p-3 focus:ring-2 focus:ring-[#2F855A] outline-none text-sm" placeholder="Masukkan nama Anda">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">NIK (Nomor Induk Kependudukan)</label>
                <input type="number" class="w-full border border-gray-300 rounded-xl p-3 focus:ring-2 focus:ring-[#2F855A] outline-none text-sm" placeholder="16 digit NIK">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Pesan / Laporan</label>
                <textarea rows="4" class="w-full border border-gray-300 rounded-xl p-3 focus:ring-2 focus:ring-[#2F855A] outline-none text-sm" placeholder="Tuliskan detail laporan Anda"></textarea>
            </div>
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-1">Unggah Bukti Foto (Opsional)</label>
                <input type="file" class="w-full border border-gray-300 rounded-xl file:mr-4 file:py-2 file:px-4 file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-[#2F855A] hover:file:bg-green-100 text-sm">
            </div>
            <button type="button" class="w-full bg-[#2F855A] hover:bg-green-700 text-white font-bold py-3 rounded-xl transition-colors">
                Kirim Laporan
            </button>
        </form>
    </div>
</div>

<!-- MAIN CONTENT WRAPPER (Padding horizontal responsif dengan target lg:px-[120px]) -->
<main class="px-4 md:px-8 lg:px-[120px] py-12 space-y-20">

    <!-- 4. SAMBUTAN KEPALA DESA -->
    <section class="flex flex-col md:flex-row gap-8 items-center bg-[#F7F9FC] p-6 md:p-10 rounded-3xl border border-gray-100 shadow-sm">
        <div class="w-48 h-48 md:w-64 md:h-64 flex-shrink-0">
            <img src="assets/images/kepala-desa.jpg" alt="Kepala Desa" class="w-full h-full object-cover rounded-full shadow-lg border-4 border-white">
        </div>
        <div>
            <h3 class="text-xs md:text-sm font-bold text-[#2F855A] uppercase tracking-wider mb-2">Sambutan Kepala Desa</h3>
            <h2 class="text-2xl md:text-3xl font-bold text-[#172033] mb-4">Mewujudkan Desa Padangan yang Maju dan Sejahtera</h2>
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
            <a href="#" class="text-sm text-[#2F855A] font-semibold hover:underline">Lihat Semua Perangkat &rarr;</a>
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
            <a href="#" class="text-sm text-[#2F855A] font-semibold hover:underline">Lihat Semua Berita &rarr;</a>
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
            <a href="#" class="text-sm text-[#2F855A] font-semibold hover:underline">Lihat Semua Foto &rarr;</a>
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