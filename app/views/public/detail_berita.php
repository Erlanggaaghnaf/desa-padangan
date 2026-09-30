<?php
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
$base_url = $protocol . '://' . $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
$berita = $berita ?? null;
$related = $berita_terkait ?? [];

$formatDate = static function ($date) {
    if (!$date) return '-';
    $months = [1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember'];
    try { $dt = new DateTime($date); return (int)$dt->format('j').' '.$months[(int)$dt->format('n')].' '.$dt->format('Y'); }
    catch (Throwable $e) { return '-'; }
};
?>

<div class="bg-[#F7F9FC] pt-32 pb-12 px-4 md:px-8 lg:px-[120px] min-h-screen">
    <?php if (!$berita): ?>
        <main class="max-w-3xl mx-auto bg-white rounded-3xl border border-gray-100 shadow-sm p-8 md:p-12 text-center">
            <h1 class="text-3xl font-extrabold text-[#172033]">Berita tidak ditemukan</h1>
            <p class="text-gray-500 mt-3">Berita yang Anda cari tidak tersedia atau sudah dihapus.</p>
            <a href="<?= $base_url; ?>/index.php?url=public/berita" class="inline-flex mt-6 items-center justify-center rounded-xl bg-[#2F855A] px-5 py-3 text-sm font-bold text-white">Kembali ke Berita</a>
        </main>
    <?php else: ?>
        <?php $imageUrl = $base_url . '/uploads/berita/' . rawurlencode($berita['foto']); ?>
        <main class="max-w-4xl mx-auto bg-white rounded-3xl border border-gray-100 shadow-sm p-6 md:p-10 mb-12">
            <nav class="flex items-center text-sm text-gray-500 mb-6 gap-2">
                <a href="<?= $base_url; ?>/index.php?url=public/home" class="hover:text-[#2F855A] transition-colors">Beranda</a>
                <span>/</span>
                <a href="<?= $base_url; ?>/index.php?url=public/berita" class="hover:text-[#2F855A] transition-colors">Berita Desa Padangan</a>
                <span>/</span>
                <span class="text-gray-400 line-clamp-1"><?= htmlspecialchars($berita['judul'], ENT_QUOTES, 'UTF-8'); ?></span>
            </nav>

            <h1 class="text-3xl md:text-4xl font-extrabold text-[#172033] mb-4 leading-tight"><?= htmlspecialchars($berita['judul'], ENT_QUOTES, 'UTF-8'); ?></h1>
            <div class="flex items-center gap-5 text-sm text-gray-500 mb-8 pb-6 border-b border-gray-100 flex-wrap">
                <span class="inline-flex items-center gap-2">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#172033" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M8 2v4"/><path d="M16 2v4"/><rect width="18" height="18" x="3" y="4" rx="2"/><path d="M3 10h18"/><path d="M8 14h.01"/><path d="M12 14h.01"/><path d="M16 14h.01"/><path d="M8 18h.01"/><path d="M12 18h.01"/><path d="M16 18h.01"/></svg>
                    <?= $formatDate($berita['created_at']); ?>
                </span>
                <span class="inline-flex items-center gap-2">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#172033" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/><circle cx="12" cy="12" r="3"/></svg>
                    Dilihat <?= number_format((int)$berita['views']); ?> kali
                </span>
            </div>

            <div class="mb-8 overflow-hidden rounded-2xl group cursor-pointer" onclick="bukaModalGambar(document.getElementById('detail-berita-image').src)">
                <img id="detail-berita-image" src="<?= $imageUrl; ?>" alt="<?= htmlspecialchars($berita['judul'], ENT_QUOTES, 'UTF-8'); ?>" class="w-full h-auto object-cover transform transition-transform duration-500 group-hover:scale-[1.02]">
                <p class="text-center text-xs text-gray-400 mt-2 italic">Klik gambar untuk memperbesar</p>
            </div>

            <article class="prose prose-gray max-w-none text-gray-600 leading-relaxed text-justify whitespace-pre-line">
                <?= htmlspecialchars($berita['isi'] ?? ($berita['deskripsi'] ?? ''), ENT_QUOTES, 'UTF-8'); ?>
            </article>

            <div class="mt-10 pt-6 border-t border-gray-100 flex items-center justify-between gap-4">
                <span class="font-semibold text-[#172033]">Bagikan artikel ini:</span>
                <button onclick="salinTautan()" id="btn-copy" class="flex items-center gap-2 px-4 py-2 bg-gray-50 hover:bg-gray-100 text-gray-600 rounded-lg border border-gray-200 transition-colors text-sm font-medium">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                    <span>Salin Tautan</span>
                </button>
            </div>
        </main>

        <?php if ($related): ?>
            <section class="max-w-7xl mx-auto mb-12">
                <h2 class="text-2xl font-bold text-[#172033] mb-6">Berita Lainnya</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <?php foreach ($related as $item): ?>
                        <?php $relatedImage = $base_url . '/uploads/berita/' . rawurlencode($item['foto']); ?>
                        <article class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden flex flex-col hover:shadow-md transition-shadow">
                            <img src="<?= $relatedImage; ?>" alt="<?= htmlspecialchars($item['judul'], ENT_QUOTES, 'UTF-8'); ?>" class="w-full h-40 object-cover" loading="lazy">
                            <div class="p-5 flex flex-col flex-grow">
                                <div class="flex items-center gap-3 text-[11px] text-gray-400 mb-2">
                                    <span><?= $formatDate($item['created_at']); ?></span>
                                    <span>•</span>
                                    <span><?= number_format((int)$item['views']); ?> kali</span>
                                </div>
                                <h3 class="text-base font-bold text-[#172033] leading-snug line-clamp-2 flex-grow"><?= htmlspecialchars($item['judul'], ENT_QUOTES, 'UTF-8'); ?></h3>
                                <a href="<?= $base_url; ?>/index.php?url=public/detail-berita/<?= (int)$item['id']; ?>" class="mt-4 inline-flex items-center gap-2 text-sm font-bold text-[#2F855A] hover:underline">
                                    Baca selengkapnya
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#2F855A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                                </a>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            </section>
        <?php endif; ?>
    <?php endif; ?>
</div>

<div id="image-modal" class="fixed inset-0 z-50 bg-black/90 hidden items-center justify-center opacity-0 transition-opacity duration-300" onclick="tutupModalGambar()">
    <button type="button" class="absolute top-6 right-8 text-white text-4xl cursor-pointer hover:text-gray-300" onclick="tutupModalGambar()" aria-label="Tutup">&times;</button>
    <img id="modal-img" src="" alt="Pratinjau gambar berita" class="max-w-[90%] max-h-[90vh] object-contain rounded-lg shadow-2xl transform scale-95 transition-transform duration-300">
</div>

<script src="<?= $base_url; ?>/assets/js/detail_berita.js"></script>
