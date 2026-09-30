<?php
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
$base_url = $protocol . '://' . $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
$berita = $berita ?? [];
$currentPage = (int) ($berita_current_page ?? 1);
$totalPages = (int) ($berita_total_pages ?? 1);

$formatDate = static function ($date) {
    if (!$date) return '-';
    $months = [1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember'];
    try { $dt = new DateTime($date); return (int)$dt->format('j').' '.$months[(int)$dt->format('n')].' '.$dt->format('Y'); }
    catch (Throwable $e) { return '-'; }
};
?>

<section class="bg-[#F7F9FC] pt-32 pb-12 px-4 md:px-8 lg:px-[120px] text-center border-b border-gray-200 reveal-up">
    <h1 class="text-3xl md:text-5xl font-extrabold text-[#172033] mb-3 reveal-left">Berita Desa Padangan</h1>
    <p class="text-gray-500 text-sm md:text-base max-w-xl mx-auto reveal-right">Informasi dan kabar terbaru dari Desa Padangan</p>
</section>

<main id="berita-container" class="px-4 md:px-8 lg:px-[120px] py-12 max-w-7xl mx-auto">
    <?php if ($berita): ?>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach ($berita as $item): ?>
                <?php $imageUrl = $base_url . '/uploads/berita/' . rawurlencode($item['foto']); ?>
                <article class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden flex flex-col hover:shadow-md transition-shadow">
                    <img src="<?= $imageUrl; ?>" alt="<?= htmlspecialchars($item['judul'], ENT_QUOTES, 'UTF-8'); ?>" class="w-full h-48 object-cover" loading="lazy">
                    <div class="p-6 flex flex-col flex-grow">
                        <div class="flex items-center gap-4 text-xs text-gray-400 mb-3 flex-wrap">
                            <span class="inline-flex items-center gap-1">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#172033" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M8 2v4"/><path d="M16 2v4"/><rect width="18" height="18" x="3" y="4" rx="2"/><path d="M3 10h18"/><path d="M8 14h.01"/><path d="M12 14h.01"/><path d="M16 14h.01"/><path d="M8 18h.01"/><path d="M12 18h.01"/><path d="M16 18h.01"/></svg>
                                <?= $formatDate($item['created_at']); ?>
                            </span>
                            <span class="inline-flex items-center gap-1">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#172033" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/><circle cx="12" cy="12" r="3"/></svg>
                                <?= number_format((int)$item['views']); ?>
                            </span>
                        </div>
                        <h2 class="text-lg font-bold text-[#172033] leading-snug line-clamp-2 mb-2"><?= htmlspecialchars($item['judul'], ENT_QUOTES, 'UTF-8'); ?></h2>
                        <p class="text-sm text-gray-500 line-clamp-3 leading-relaxed flex-grow"><?= htmlspecialchars($item['deskripsi'], ENT_QUOTES, 'UTF-8'); ?></p>
                        <a href="<?= $base_url; ?>/index.php?url=berita/detailBerita/<?= (int)$item['id']; ?>" class="mt-5 inline-flex items-center gap-2 text-sm font-bold text-[#2F855A] hover:underline">
                            Baca selengkapnya
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#2F855A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                        </a>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="rounded-3xl border border-dashed border-gray-300 bg-white py-20 px-6 text-center">
            <h2 class="text-lg font-extrabold text-[#172033]">Belum ada berita</h2>
            <p class="text-sm text-gray-500 mt-2">Informasi terbaru Desa Padangan akan tampil di halaman ini.</p>
        </div>
    <?php endif; ?>

    <?php if ($totalPages > 1): ?>
        <nav class="mt-10 flex items-center justify-center gap-2" aria-label="Pagination">
            <?php $prevDisabled = $currentPage <= 1; ?>
            <a href="<?= $prevDisabled ? '#' : $base_url . '/index.php?url=public/berita&page=' . ($currentPage - 1); ?>" class="w-10 h-10 rounded-xl border flex items-center justify-center transition-colors <?= $prevDisabled ? 'border-gray-200 text-gray-300 pointer-events-none' : 'border-gray-200 text-[#2F855A] hover:bg-emerald-50'; ?>" aria-label="Halaman sebelumnya">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
            </a>
            <?php for ($page=1; $page<=$totalPages; $page++): ?>
                <a href="<?= $base_url; ?>/index.php?url=public/berita&page=<?= $page; ?>" class="w-10 h-10 rounded-xl flex items-center justify-center text-sm font-bold <?= $page===$currentPage ? 'bg-[#2F855A] text-white' : 'border border-gray-200 text-gray-600 hover:bg-gray-50'; ?>"><?= $page; ?></a>
            <?php endfor; ?>
            <?php $nextDisabled = $currentPage >= $totalPages; ?>
            <a href="<?= $nextDisabled ? '#' : $base_url . '/index.php?url=public/berita&page=' . ($currentPage + 1); ?>" class="w-10 h-10 rounded-xl border flex items-center justify-center transition-colors <?= $nextDisabled ? 'border-gray-200 text-gray-300 pointer-events-none' : 'border-gray-200 text-[#2F855A] hover:bg-emerald-50'; ?>" aria-label="Halaman berikutnya">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
            </a>
        </nav>
    <?php endif; ?>
</main>
