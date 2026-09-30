<?php
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
$base_url = $protocol . '://' . $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
?>

<!-- HERO SECTION (Rasio proporsional desktop mendekati 1440x800px) -->
<section id="hero-section" class="relative w-full h-[65vh] md:h-[75vh] lg:h-[800px] bg-cover bg-center flex items-center justify-center text-center px-4 overflow-hidden" 
         style="background-image: url('<?= $base_url; ?>/assets/images/Hero.png');">

    <div class="absolute inset-0 bg-black/50 z-10"></div>
    <div class="relative z-20 text-white max-w-3xl">
        <p class="text-sm font-semibold drop-shadow-lg md:text-base uppercase tracking-wider mb-2 reveal-up">Selamat Datang di</p>
        <h2 class="text-3xl md:text-5xl font-extrabold drop-shadow-xl mb-3 reveal-left">Website Resmi Desa Padangan</h2>
        <p class="text-lg md:text-xl text-gray-200 drop-shadow-xl font-semibold reveal-right">Kecamatan Ngantru, Kabupaten Tulungagung</p>
    </div>
</section>

<!-- MAIN CONTENT WRAPPER (Padding horizontal responsif dengan target lg:px-[120px]) -->
<main class="overflow-hidden px-4 md:px-8 lg:px-[120px] py-12 space-y-20">

    <!-- 4. SAMBUTAN KEPALA DESA -->
    <section class="flex flex-col md:flex-row gap-8 items-center bg-[#F7F9FC] p-6 md:p-10 rounded-3xl border border-gray-100 shadow-sm reveal-up">
        <div class="w-48 h-48 md:w-64 md:h-64 flex-shrink-0">
            <img src="<?= $base_url; ?>/assets/images/kepala-desa.jpg" alt="Kepala Desa" class="w-full h-full object-cover rounded-2xl shadow-lg border-4 border-white reveal-left">
            <div class="mt-3 text-center">
                <p class="font-bold text-[#172033] reveal-left">Slamet Riyadi, S.Pd.</p>
            </div>
        </div>
        <div class="reveal-right">
            <h2 class="text-2xl md:text-3xl font-bold text-[#172033] mb-4">Sambutan Kepala Desa</h2>
            <div class="h-1 w-28 bg-[#2F855A] rounded-full mb-4"></div>
            <p class="text-gray-600 leading-relaxed mb-4 text-sm md:text-base">
                Selamat datang di website resmi Desa Padangan. Melalui portal ini, kami berkomitmen untuk memberikan transparansi informasi, mempermudah pelayanan publik, dan memperkenalkan potensi desa kepada masyarakat luas.
            </p>
            
        </div>
    </section>

    <!-- 5. SOTK (Struktur Organisasi) -->
    <section>
        <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-6 gap-2 reveal-up">
            <div class="reveal-left">
                <h3 class="text-2xl font-bold text-[#172033]">SOTK</h3>
                <p class="text-sm text-gray-500">Profil Struktur Organisasi Tata Kerja Desa Padangan</p>
            </div>
            <a href="<?= $base_url; ?>/index.php?url=informasi#Sotk" class="text-sm text-[#2563B8] font-semibold hover:underline reveal-right">Lihat Semua Perangkat &rarr;</a>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 reveal-up">
            <div class="bg-white rounded-2xl overflow-hidden border border-gray-200 shadow-sm text-center pb-4 hover:shadow-md transition-shadow">
                <img src="<?= $base_url; ?>/assets/images/perangkat1.jpg" alt="Perangkat" class="w-full h-56 object-cover object-top mb-3">
                <h4 class="font-bold text-[#172033] text-sm md:text-base px-2">Slamet Riyadi, S.Pd</h4>
                <p class="text-xs md:text-sm font-semibold text-[#2F855A] mt-1">Kepala Desa</p>
            </div>
            <div class="bg-white rounded-2xl overflow-hidden border border-gray-200 shadow-sm text-center pb-4 hover:shadow-md transition-shadow">
                <img src="<?= $base_url; ?>/assets/images/perangkat1.jpg" alt="Perangkat" class="w-full h-56 object-cover object-top mb-3">
                <h4 class="font-bold text-[#172033] text-sm md:text-base px-2">Slamet Riyadi, S.Pd</h4>
                <p class="text-xs md:text-sm font-semibold text-[#2F855A] mt-1">Kepala Desa</p>
            </div>
            <div class="bg-white rounded-2xl overflow-hidden border border-gray-200 shadow-sm text-center pb-4 hover:shadow-md transition-shadow">
                <img src="<?= $base_url; ?>/assets/images/perangkat1.jpg" alt="Perangkat" class="w-full h-56 object-cover object-top mb-3">
                <h4 class="font-bold text-[#172033] text-sm md:text-base px-2">Slamet Riyadi, S.Pd</h4>
                <p class="text-xs md:text-sm font-semibold text-[#2F855A] mt-1">Kepala Desa</p>
            </div>
            <div class="bg-white rounded-2xl overflow-hidden border border-gray-200 shadow-sm text-center pb-4 hover:shadow-md transition-shadow">
                <img src="<?= $base_url; ?>/assets/images/perangkat1.jpg" alt="Perangkat" class="w-full h-56 object-cover object-top mb-3">
                <h4 class="font-bold text-[#172033] text-sm md:text-base px-2">Slamet Riyadi, S.Pd</h4>
                <p class="text-xs md:text-sm font-semibold text-[#2F855A] mt-1">Kepala Desa</p>
            </div>
        </div>
    </section>

    <!-- 6. PETA WILAYAH -->
    <section class="flex flex-col lg:flex-row justify-between items-center gap-8 reveal-up">
        <div class="lg:w-1/2 reveal-left">
            <h3 class="text-2xl font-bold text-[#172033] mb-2">PETA WILAYAH</h3>
            <p class="text-sm text-gray-500 leading-relaxed">
                Peta batas wilayah administratif Desa Padangan,<br>
                Kecamatan Ngantru,<br>
                Kabupaten Tulungagung
            </p>
        </div>
        <div class="w-full lg:w-1/2 h-64 md:h-80 rounded-2xl overflow-hidden shadow-sm border border-gray-200 relative reveal-right">
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3950.6898594747126!2d111.9543243750075!3d-8.030877891995878!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e78fb59fc34d539%3A0xeb4f5483057548d6!2sBalai%20Desa%20Padangan!5e0!3m2!1sid!2sid!4v1789902686862!5m2!1sid!2sid" 
                class="absolute inset-0 w-full h-full border-0" 
                allowfullscreen="" 
                loading="lazy" 
                referrerpolicy="strict-origin-when-cross-origin">
            </iframe>
        </div>
    </section>

    <!-- 7. BERITA DESA -->
    <section class="reveal-up">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-6 gap-2">
            <div class="reveal-left">
                <h3 class="text-2xl font-bold text-[#172033]">Berita Desa</h3>
                <p class="text-sm text-gray-500">Simak perkembangan terbaru dari Desa Padangan</p>
            </div>
            <a href="<?= $base_url; ?>/index.php?url=berita" class="text-sm text-[#2563B8] font-semibold hover:underline reveal-right">Lihat Semua Berita &rarr;</a>
        </div>

        <?php if (!empty($berita)): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 reveal-up">
                <?php foreach ($berita as $item): ?>
                    <article class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden flex flex-col h-full hover:shadow-md transition-shadow">
                        <img src="<?= $base_url; ?>/uploads/berita/<?= rawurlencode($item['foto']); ?>" class="w-full h-40 object-cover" alt="<?= htmlspecialchars($item['judul'], ENT_QUOTES, 'UTF-8'); ?>" loading="lazy">
                        <div class="p-4 flex flex-col flex-grow">
                            <div class="flex items-center text-[11px] text-gray-400 mb-2 gap-2">
                                <span class="inline-flex items-center gap-1">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#172033" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M8 2v4"/><path d="M16 2v4"/><rect width="18" height="18" x="3" y="4" rx="2"/><path d="M3 10h18"/><path d="M8 14h.01"/><path d="M12 14h.01"/><path d="M16 14h.01"/></svg>
                                    <?= htmlspecialchars(date('d M Y', strtotime($item['created_at'])), ENT_QUOTES, 'UTF-8'); ?>
                                </span>
                                <span class="inline-flex items-center gap-1">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#172033" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/><circle cx="12" cy="12" r="3"/></svg>
                                    <?= number_format((int)$item['views']); ?>
                                </span>
                            </div>
                            <h4 class="font-bold text-[#172033] text-sm mb-2 line-clamp-2 leading-snug"><?= htmlspecialchars($item['judul'], ENT_QUOTES, 'UTF-8'); ?></h4>
                            <p class="text-xs text-gray-500 line-clamp-2 mb-4 flex-grow"><?= htmlspecialchars($item['deskripsi'], ENT_QUOTES, 'UTF-8'); ?></p>
                            <!-- Perbaikan path route detail berita menggunakan base_url -->
                            <a href="<?= $base_url; ?>/index.php?url=berita/detailBerita/<?= (int)$item['id']; ?>" class="text-xs font-semibold text-[#2F855A] hover:underline mt-auto inline-flex items-center gap-1">
                                Baca selengkapnya
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#2F855A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                            </a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="rounded-2xl border border-dashed border-gray-300 bg-white py-12 text-center">
                <p class="text-sm font-semibold text-[#172033]">Belum ada berita untuk ditampilkan.</p>
            </div>
        <?php endif; ?>
    </section>

    <!-- 9. GALERI DESA -->
    <section>
        <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-6 gap-2">
            <div class="reveal-left">
                <h3 class="text-2xl font-bold text-[#172033]">Galeri Desa</h3>
                <p class="text-sm text-gray-500">Dokumentasi kegiatan masyarakat dan pembangunan</p>
            </div>
            <a href="<?= $base_url; ?>/index.php?url=galeri" class="text-sm text-[#2563B8] font-semibold hover:underline reveal-right">Lihat Semua Foto &rarr;</a>
        </div>

        <?php if (!empty($galeri)): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 reveal-up">
                <?php foreach ($galeri as $item): ?>
                    <?php
                    $judul = (string) ($item['judul'] ?? '');
                    $foto = basename((string) ($item['foto'] ?? ''));
                    $fotoUrl = $base_url . '/uploads/galeri/' . rawurlencode($foto);
                    ?>
                    <div class="relative rounded-2xl overflow-hidden group h-72 shadow-sm border border-gray-200">
                        <img src="<?= htmlspecialchars($fotoUrl, ENT_QUOTES, 'UTF-8'); ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" alt="<?= htmlspecialchars($judul, ENT_QUOTES, 'UTF-8'); ?>" loading="lazy">
                        
                        <!-- Overlay gradasi dan teks judul yang diperbesar ukurannya -->
                        <div class="absolute inset-0 bg-black/50 hover:bg-black/60 transition-colors flex items-end justify-center p-6">
                            <p class="text-white text-xl md:text-xl font-bold leading-snug text-center line-clamp-3 drop-shadow-md" style="font-size: 1.25rem !important; line-height: 1.4 !important;"><?= htmlspecialchars($judul, ENT_QUOTES, 'UTF-8'); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="rounded-2xl border border-dashed border-gray-300 bg-white py-12 text-center">
                <p class="text-sm font-semibold text-[#172033]">Belum ada dokumentasi galeri untuk ditampilkan.</p>
            </div>
        <?php endif; ?>
    </section>

</main>