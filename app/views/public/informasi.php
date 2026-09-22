<?php include '../app/views/layouts/header.php'; ?>

<!-- HEADER HALAMAN (Diberi padding atas ekstra pt-32 agar tidak tertutup navbar fixed) -->
<section class="bg-[#F7F9FC] pt-32 pb-12 px-4 md:px-8 lg:px-[120px]">
    <h1 class="text-3xl md:text-5xl font-extrabold text-[#172033] mb-4 reveal-left">Informasi Desa</h1>
    <p class="text-gray-500 text-sm md:text-base max-w-2xl reveal-right">Mengenal lebih dekat sejarah, visi misi, letak geografis, dan struktur pemerintahan Desa Padangan.</p>
    <!-- Panggilan Komponen Widget -->

     <div class="flex justify-between items-center w-full mt-8 gap-4">
        <!-- Kunjungan (Kiri Mentok) -->
        <div class="z-20">
            <?php include '../app/views/components/visitor_card.php'; ?>
        </div>

        <!-- Pengaduan (Kanan Mentok) -->
        <div class="z-20 flex-shrink-0">
            <?php include '../app/views/components/pengaduan_widget.php'; ?>
        </div>
    </div>
</section>

<!-- MAIN CONTENT WRAPPER -->
<main class="px-4 md:px-8 lg:px-[120px] py-12 space-y-24">

    <!-- 1. SEJARAH DESA -->
    <section class="flex flex-col md:flex-row gap-10 items-start">
        <div class="w-full md:w-5/12 flex-shrink-0 relative reveal-left">
            <!-- Frame Foto Sejarah -->
            <img src="assets/images/balai desa padangan.webp" alt="Balai Desa Padangan" class="w-full h-auto object-cover rounded-3xl shadow-lg border-4 border-white">
        </div>
        <div class="w-full md:w-7/12 reveal-right">
            <h2 class="text-2xl md:text-3xl font-bold text-[#172033] mb-2">Sejarah Desa</h2>
            
            <div class="text-gray-600 text-sm md:text-base leading-relaxed space-y-4 text-justify">
                <p>
                    Sejarah Desa Padangan memiliki jejak yang panjang dalam perkembangan wilayah Kecamatan Ngantru. Berawal dari pemukiman kecil yang agraris, desa ini terus berkembang menjadi pusat kegiatan ekonomi dan sosial masyarakat setempat.
                </p>
                <p>
                    Nama "Padangan" sendiri diambil dari filosofi lokal yang mencerminkan harapan akan wilayah yang terang (padhang) dan membawa pencerahan serta kesejahteraan bagi seluruh warganya. Hingga kini, Desa Padangan terus melangkah maju dengan tetap mempertahankan nilai-nilai gotong royong dan budaya leluhur.
                </p>
            </div>
        </div>
    </section>

    <!-- 2. VISI & MISI -->
    <section class="bg-[#F7F9FC] py-12 px-6 md:px-12 rounded-3xl border border-gray-100 shadow-sm reveal-up">
        
        <div class="text-center mb-10 reveal-up">
            <h2 class="text-2xl md:text-3xl font-bold text-[#172033] mb-2">Visi & Misi</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Card Visi -->
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-start items-center h-full reveal-left">
                <h3 class="text-2xl font-bold text-[#172033] mb-6 text-center">Visi</h3>
                <p class="text-gray-700 text-center font-semibold italic text-lg leading-relaxed">
                    "Terwujudnya Desa Padangan yang Mandiri, Sejahtera, Berbudaya, dan Agamis Berlandaskan Gotong Royong"
                </p>
            </div>
            
            <!-- Card Misi -->
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 reveal-right">
                <h3 class="text-2xl font-bold text-[#172033] mb-6 text-center">Misi</h3>
                <ul class="text-gray-600 space-y-3 text-sm md:text-base">
                    <li class="flex items-start gap-3">
                        <span class="text-[#2F855A] font-bold">1.</span>
                        Meningkatkan tata kelola pemerintahan desa yang transparan dan akuntabel.
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="text-[#2F855A] font-bold">2.</span>
                        Mendorong pemberdayaan ekonomi masyarakat berbasis potensi lokal (pertanian dan peternakan).
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="text-[#2F855A] font-bold">3.</span>
                        Meningkatkan kualitas infrastruktur desa yang memadai dan berkelanjutan.
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="text-[#2F855A] font-bold">4.</span>
                        Membina kerukunan, ketentraman, dan kegiatan keagamaan masyarakat.
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <!-- 3. PETA LOKASI DESA -->
    <section class="reveal-up">
        <div class="mb-8 reveal-left">
            <h2 class="text-2xl md:text-3xl font-bold text-[#172033] mb-2">Peta Lokasi Desa</h2>
        </div>

        <div class="flex flex-col lg:flex-row gap-8 items-stretch">
            <!-- Informasi Wilayah (Kiri) -->
            <div class="w-full lg:w-1/3 flex flex-col gap-4 reveal-left">
                <h4 class="font-bold text-[#172033] text-xl">Informasi Wilayah</h4>
                
                <!-- Luas Area -->
                <div class="bg-[#2F855A]/10 p-4 rounded-xl border border-gray-100 flex gap-4 items-center reveal-right">
                    <div class="bg-white p-3 rounded-lg shadow-sm text-[#2F855A]">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path></svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 mb-0.5 font-semibold">Luas Area</p>
                        <p class="font-bold text-[#172033]">322.50 Ha</p>
                    </div>
                </div>

                <!-- Populasi -->
                <div class="bg-[#2F855A]/10 p-4 rounded-xl border border-gray-100 flex gap-4 items-center reveal-right">
                    <div class="bg-white p-3 rounded-lg shadow-sm text-[#2F855A]">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 mb-0.5 font-semibold">Populasi</p>
                        <p class="font-bold text-[#172033]">4.523 Jiwa</p>
                    </div>
                </div>

                <!-- Batas Wilayah -->
                <div class="bg-[#2F855A]/10 p-4 rounded-xl border border-gray-100 flex gap-4 items-start reveal-left">
                    <div class="bg-white p-3 rounded-lg shadow-sm text-[#2F855A]">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 mb-1.5 font-semibold">Batas Wilayah</p>
                        <ul class="text-sm font-semibold text-[#172033] space-y-1.5">
                            <li>Utara: Desa Pinggirsari</li>
                            <li>Selatan: Sungai Brantas</li>
                            <li>Timur: Desa Ngantru</li>
                            <li>Barat: Desa Batokan</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Gambar Peta (Kanan) -->
            <div class="w-full lg:w-2/3 min-h-[350px] lg:min-h-[400px] rounded-3xl overflow-hidden shadow-sm border border-gray-200 relative reveal-right">       
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3950.6898594747126!2d111.9543243750075!3d-8.030877891995878!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e78fb59fc34d539%3A0xeb4f5483057548d6!2sBalai%20Desa%20Padangan!5e0!3m2!1sid!2sid!4v1789902686862!5m2!1sid!2sid" 
                    class="absolute inset-0 w-full h-full border-0" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="strict-origin-when-cross-origin">
                </iframe>  
            </div>
        </div>
    </section>

    <!-- 4. SOTK DESA PADANGAN -->
    <section class="reveal-up">
        <div class="text-center mb-10">
            <h2 class="text-2xl md:text-3xl font-bold text-[#172033] mb-2 reveal-left">SOTK DESA PADANGAN</h2>
            <p class="text-gray-500 text-sm md:text-base reveal-right">Struktur Organisasi Tata Kerja Pemerintahan Desa Padangan</p>
        </div>

        <!-- Bagan Struktur (Gambar) -->
        <div class="bg-white p-4 md:p-8 rounded-3xl shadow-sm border border-gray-100 mb-12 flex justify-center reveal-up">
            <img src="assets/images/bagan-sotk.png" alt="Bagan Struktur Organisasi" class="max-w-full h-auto object-contain">
        </div>

        <!-- Grid Perangkat Desa (Sesuai Desain: 4 Kolom) -->
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6 reveal-up">
            <!-- Card 1 (Kepala Desa) -->
            <div class="bg-white rounded-2xl overflow-hidden border border-gray-200 shadow-sm text-center pb-4 hover:shadow-md transition-shadow">
                <img src="assets/images/perangkat1.jpg" alt="Perangkat" class="w-full h-48 md:h-64 object-cover object-top mb-4">
                <h4 class="font-bold text-[#172033] text-sm md:text-base px-2 truncate">Slamet Riyadi, S.Pd</h4>
                <p class="text-[11px] md:text-sm font-semibold text-[#2F855A] mt-1">Kepala Desa</p>
            </div>
            
            <!-- Card 2 -->
            <div class="bg-white rounded-2xl overflow-hidden border border-gray-200 shadow-sm text-center pb-4 hover:shadow-md transition-shadow">
                <img src="assets/images/perangkat2.jpg" alt="Perangkat" class="w-full h-48 md:h-64 object-cover object-top mb-4">
                <h4 class="font-bold text-[#172033] text-sm md:text-base px-2 truncate">Arief Rahman</h4>
                <p class="text-[11px] md:text-sm font-semibold text-[#2F855A] mt-1">Sekretaris Desa</p>
            </div>

            <!-- Card 3 -->
            <div class="bg-white rounded-2xl overflow-hidden border border-gray-200 shadow-sm text-center pb-4 hover:shadow-md transition-shadow">
                <img src="assets/images/perangkat3.jpg" alt="Perangkat" class="w-full h-48 md:h-64 object-cover object-top mb-4">
                <h4 class="font-bold text-[#172033] text-sm md:text-base px-2 truncate">Dwi Santoso</h4>
                <p class="text-[11px] md:text-sm font-semibold text-[#2F855A] mt-1">Kasi Pemerintahan</p>
            </div>

            <!-- Card 4 -->
            <div class="bg-white rounded-2xl overflow-hidden border border-gray-200 shadow-sm text-center pb-4 hover:shadow-md transition-shadow">
                <img src="assets/images/perangkat4.jpg" alt="Perangkat" class="w-full h-48 md:h-64 object-cover object-top mb-4">
                <h4 class="font-bold text-[#172033] text-sm md:text-base px-2 truncate">Budi Santoso</h4>
                <p class="text-[11px] md:text-sm font-semibold text-[#2F855A] mt-1">Kaur Keuangan</p>
            </div>

            <!-- Silakan copy-paste struktur Card di atas untuk menambahkan 4 perangkat desa lainnya di baris bawah -->
        </div>
    </section>

</main>

<?php include '../app/views/layouts/footer.php'; ?>