<?php include '../app/views/layouts/header.php'; ?>

<?php
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
$base_url = $protocol . '://' . $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
$daftarGaleri = $galeri ?? [];
$currentPage = max(1, (int) ($galeri_current_page ?? 1));
$totalPages = max(1, (int) ($galeri_total_pages ?? 1));
$totalGaleri = max(0, (int) ($galeri_total ?? 0));
$baseGaleriUrl = $base_url . '/index.php?url=public/galeri';

function galeriPublicJson($value)
{
    return htmlspecialchars(
        json_encode($value, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
        ENT_QUOTES,
        'UTF-8'
    );
}
?>

<!-- HEADER HALAMAN -->
<section class="bg-[#F7F9FC] pt-32 pb-12 px-4 md:px-8 lg:px-[120px] text-center border-b border-gray-200 reveal-up">
    <h1 class="text-3xl md:text-5xl font-extrabold text-[#172033] mb-3 uppercase tracking-wide reveal-left">Galeri Desa Padangan</h1>
    <p class="text-gray-500 text-sm md:text-base max-w-xl mx-auto reveal-right">Dokumentasi kegiatan masyarakat Desa Padangan</p>
</section>

<!-- KONTEN UTAMA GALERI -->
<main class="px-4 md:px-8 lg:px-[120px] py-12 max-w-7xl mx-auto space-y-12">
    <?php if ($totalGaleri > 0): ?>
        <div id="galeri-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 reveal-up">
            <?php foreach ($daftarGaleri as $item): ?>
                <?php
                $judul = (string) ($item['judul'] ?? '');
                $foto = basename((string) ($item['foto'] ?? ''));
                $fotoUrl = $base_url . '/uploads/galeri/' . rawurlencode($foto);
                ?>

                <div
                    class="galeri-item group relative rounded-2xl overflow-hidden cursor-pointer shadow-sm bg-gray-200"
                    onclick='bukaLightbox(<?= galeriPublicJson($fotoUrl); ?>, <?= galeriPublicJson($judul); ?>)'
                >
                    <img
                        src="<?= htmlspecialchars($fotoUrl, ENT_QUOTES, 'UTF-8'); ?>"
                        alt="<?= htmlspecialchars($judul, ENT_QUOTES, 'UTF-8'); ?>"
                        class="w-full h-64 object-cover transform transition-transform duration-700 group-hover:scale-110"
                    >

                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/10 to-transparent opacity-90 transition-opacity duration-300"></div>

                    <div class="absolute bottom-0 left-0 p-5 transform transition-transform duration-300 group-hover:-translate-y-1">
                        <h3 class="text-white font-medium text-sm md:text-base">
                            <?= htmlspecialchars($judul, ENT_QUOTES, 'UTF-8'); ?>
                        </h3>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <?php if ($totalPages > 1): ?>
            <div class="pt-2 flex items-center justify-center gap-2">
                <?php if ($currentPage > 1): ?>
                    <a
                        href="<?= htmlspecialchars($baseGaleriUrl . '&page=' . ($currentPage - 1), ENT_QUOTES, 'UTF-8'); ?>"
                        class="w-10 h-10 rounded-xl border border-gray-200 flex items-center justify-center text-[#2F855A] hover:bg-gray-50 transition-colors"
                        aria-label="Halaman sebelumnya"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-left w-5 h-5">
                            <path d="m15 18-6-6 6-6"/>
                        </svg>
                    </a>
                <?php else: ?>
                    <button
                        type="button"
                        disabled
                        class="w-10 h-10 rounded-xl border border-gray-200 flex items-center justify-center text-gray-300 cursor-not-allowed"
                        aria-label="Tidak ada halaman sebelumnya"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-left w-5 h-5">
                            <path d="m15 18-6-6 6-6"/>
                        </svg>
                    </button>
                <?php endif; ?>

                <?php for ($page = 1; $page <= $totalPages; $page++): ?>
                    <?php if ($page === $currentPage): ?>
                        <span class="w-10 h-10 rounded-xl font-bold bg-[#2F855A] text-white shadow-sm flex items-center justify-center">
                            <?= $page; ?>
                        </span>
                    <?php else: ?>
                        <a
                            href="<?= htmlspecialchars($baseGaleriUrl . '&page=' . $page, ENT_QUOTES, 'UTF-8'); ?>"
                            class="w-10 h-10 rounded-xl font-medium text-gray-600 border border-gray-200 hover:bg-gray-50 transition-all flex items-center justify-center"
                        >
                            <?= $page; ?>
                        </a>
                    <?php endif; ?>
                <?php endfor; ?>

                <?php if ($currentPage < $totalPages): ?>
                    <a
                        href="<?= htmlspecialchars($baseGaleriUrl . '&page=' . ($currentPage + 1), ENT_QUOTES, 'UTF-8'); ?>"
                        class="w-10 h-10 rounded-xl border border-gray-200 flex items-center justify-center text-[#2F855A] hover:bg-gray-50 transition-colors"
                        aria-label="Halaman berikutnya"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right w-5 h-5">
                            <path d="m9 18 6-6-6-6"/>
                        </svg>
                    </a>
                <?php else: ?>
                    <button
                        type="button"
                        disabled
                        class="w-10 h-10 rounded-xl border border-gray-200 flex items-center justify-center text-gray-300 cursor-not-allowed"
                        aria-label="Tidak ada halaman berikutnya"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right w-5 h-5">
                            <path d="m9 18 6-6-6-6"/>
                        </svg>
                    </button>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    <?php else: ?>
        <div class="rounded-2xl border border-gray-200 bg-white p-10 text-center reveal-up">
            <div class="w-16 h-16 rounded-full bg-[#F2F8F4] text-[#2F855A] flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                    <circle cx="8.5" cy="8.5" r="1.5"></circle>
                    <path d="M21 15l-5-5L5 21"></path>
                </svg>
            </div>
            <h2 class="text-base font-bold text-[#172033]">Belum ada dokumentasi galeri.</h2>
            <p class="text-sm text-gray-500 mt-1">Dokumentasi kegiatan Desa Padangan akan ditampilkan di sini.</p>
        </div>
    <?php endif; ?>
</main>

<!-- MODAL LIGHTBOX UNTUK GALERI -->
<div id="lightbox-modal" class="fixed inset-0 z-[60] bg-black/95 hidden flex flex-col items-center justify-center opacity-0 transition-opacity duration-300">
    <button type="button" onclick="tutupLightbox()" class="absolute top-6 right-8 text-white/70 hover:text-white text-4xl font-light transition-colors">&times;</button>

    <img id="lightbox-img" src="" alt="Preview galeri" class="max-w-[95%] max-h-[80vh] object-contain rounded-lg shadow-2xl transform scale-95 transition-transform duration-300">
    <p id="lightbox-caption" class="text-white mt-6 text-lg font-medium tracking-wide text-center px-4"></p>
</div>

<script src="<?= htmlspecialchars($base_url . '/assets/js/galeri.js', ENT_QUOTES, 'UTF-8'); ?>"></script>

<?php include '../app/views/layouts/footer.php'; ?>
