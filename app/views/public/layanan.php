<?php
$daftarLayanan = $layanan ?? [];
$groupedLayanan = [];

function publicKategoriKey($kategori)
{
    $normalized = strtolower(trim((string) $kategori));

    if ($normalized === 'kependudukan') {
        return 'kependudukan';
    }

    if ($normalized === 'surat keterangan') {
        return 'surat';
    }

    return 'lainnya';
}

function publicKategoriLabel($key)
{
    if ($key === 'kependudukan') {
        return 'Kependudukan';
    }

    if ($key === 'surat') {
        return 'Surat Keterangan';
    }

    return 'Surat Lainnya & Perizinan';
}

function publicKategoriDescription($key)
{
    if ($key === 'kependudukan') {
        return 'Layanan yang berkaitan dengan dokumen kependudukan.';
    }

    if ($key === 'surat') {
        return 'Layanan yang berkaitan dengan surat keterangan.';
    }

    return 'Layanan surat, perizinan, dan kategori lainnya.';
}

function publicKategoriIcon($key)
{
    if ($key === 'kependudukan') {
        return '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-id-card"><path d="M13 19a4 4 0 00-8 0"/><path d="M16 10h2"/><path d="M16 14h2"/><circle cx="9" cy="12" r="3"/><rect x="2" y="5" width="20" height="14" rx="2"/></svg>';
    }

    if ($key === 'surat') {
        return '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file"><path d="M6 22a2 2 0 01-2-2V4a2 2 0 012-2h8a2.4 2.4 0 011.704.706l3.588 3.588A2.4 2.4 0 0120 8v12a2 2 0 01-2 2z"/><path d="M14 2v5a1 1 0 001 1h5"/></svg>';
    }

    return '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-scale"><path d="M12 3v18"/><path d="m19 8 3 8a5 5 0 0 1-6 0zV7"/><path d="M3 7h1a17 17 0 0 0 8-2 17 17 0 0 0 8 2h1"/><path d="m5 8 3 8a5 5 0 0 1-6 0zV7"/><path d="M7 21h10"/></svg>';
}

$groupOrder = ['kependudukan', 'surat', 'lainnya'];
foreach ($groupOrder as $key) {
    $groupedLayanan[$key] = [];
}

foreach ($daftarLayanan as $item) {
    $key = publicKategoriKey($item['kategori'] ?? '');
    $groupedLayanan[$key][] = $item;
}

$groupedLayanan = array_filter($groupedLayanan, static function ($items) {
    return !empty($items);
});
?>

<section class="bg-[#F7F9FC] pt-32 pb-12 px-4 md:px-8 lg:px-[120px] text-center border-b border-gray-200">
    <h1 class="text-3xl md:text-5xl font-extrabold text-[#172033] mb-3 reveal-left">Informasi & Panduan Layanan Administrasi</h1>
    <p class="text-gray-500 text-sm md:text-base max-w-xl mx-auto reveal-right">Panduan persyaratan dan alur pelayanan administrasi Desa Padangan</p>

    <div class="flex flex-wrap justify-center gap-3 mt-8 reveal-up">
        <button type="button" onclick="filterLayanan('semua', this)" data-kategori="semua" class="filter-btn px-6 py-2.5 rounded-full text-sm font-semibold transition-all bg-[#2F855A] text-white shadow-sm reveal-up">
            Semua Layanan
        </button>

        <?php foreach ($groupedLayanan as $key => $items): ?>
            <button type="button" onclick="filterLayanan('<?= $key; ?>', this)" data-kategori="<?= $key; ?>" class="filter-btn px-6 py-2.5 rounded-full text-sm font-semibold transition-all bg-white text-gray-600 border border-gray-200 hover:bg-gray-50 reveal-up">
                <?= htmlspecialchars(publicKategoriLabel($key), ENT_QUOTES, 'UTF-8'); ?>
            </button>
        <?php endforeach; ?>
    </div>
</section>

<main class="px-4 md:px-8 lg:px-[120px] py-12 space-y-10 max-w-5xl mx-auto reveal-up">
    <?php if (empty($groupedLayanan)): ?>
        <div class="bg-white border border-gray-200 rounded-2xl p-10 text-center text-sm text-gray-500">
            Informasi layanan administrasi belum tersedia.
        </div>
    <?php endif; ?>

    <?php foreach ($groupedLayanan as $key => $items): ?>
        <div class="kategori-section reveal-up" data-kategori="<?= $key; ?>">
            <h2 class="text-xl font-bold text-[#172033] mb-2 reveal-left"><?= htmlspecialchars(publicKategoriLabel($key), ENT_QUOTES, 'UTF-8'); ?></h2>
            <p class="text-gray-500 text-sm mb-4 reveal-right"><?= htmlspecialchars(publicKategoriDescription($key), ENT_QUOTES, 'UTF-8'); ?></p>

            <div class="space-y-4 reveal-up">
                <?php foreach ($items as $item): ?>
                    <?php
                    $serviceId = (int) $item['id'];
                    $contentId = 'public-layanan-content-' . $serviceId;
                    $iconId = 'public-layanan-icon-' . $serviceId;
                    ?>
                    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden transition-all">
                        <div class="w-full flex items-center justify-between p-5 text-left font-semibold text-[#172033] hover:bg-gray-50/50 cursor-pointer" onclick="toggleAccordion('<?= $contentId; ?>', '<?= $iconId; ?>')">
                            <div class="flex items-center gap-3">
                                <span class="p-2 bg-green-50 rounded-lg text-[#2F855A]">
                                    <?= publicKategoriIcon($key); ?>
                                </span>
                                <div>
                                    <span class="block"><?= htmlspecialchars($item['nama_layanan'], ENT_QUOTES, 'UTF-8'); ?></span>
                                    <span class="block text-[10px] font-medium text-gray-400 mt-0.5"><?= htmlspecialchars($item['kategori'], ENT_QUOTES, 'UTF-8'); ?></span>
                                </div>
                            </div>
                            <button type="button" onclick="event.stopPropagation(); toggleAccordion('<?= $contentId; ?>', '<?= $iconId; ?>')" class="shrink-0 text-gray-400 hover:text-[#2F855A]" aria-label="Buka/tutup layanan">
                                <svg id="<?= $iconId; ?>" class="w-5 h-5 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                        </div>

                        <div id="<?= $contentId; ?>" class="hidden px-6 pb-6 pt-2 border-t border-gray-100 text-sm text-gray-600 space-y-6 bg-gray-50/30">
                            <div>
                                <h4 class="font-bold text-[#172033] mb-2">Persyaratan</h4>
                                <?php if (!empty($item['persyaratan'])): ?>
                                    <ul class="list-disc list-inside space-y-1 text-gray-500">
                                        <?php foreach ($item['persyaratan'] as $syarat): ?>
                                            <li><?= htmlspecialchars($syarat['nama_persyaratan'], ENT_QUOTES, 'UTF-8'); ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php else: ?>
                                    <p class="text-gray-400">Tidak ada persyaratan khusus.</p>
                                <?php endif; ?>
                            </div>

                            <div>
                                <h4 class="font-bold text-[#172033] mb-2">Alur Pengajuan</h4>
                                <?php if (!empty($item['alur'])): ?>
                                    <ol class="space-y-3 text-gray-500">
                                        <?php foreach ($item['alur'] as $step): ?>
                                            <li class="flex items-start gap-3">
                                                <span class="shrink-0 w-6 h-6 rounded-full bg-green-50 text-[#2F855A] border border-green-100 flex items-center justify-center text-[11px] font-bold">
                                                    <?= (int) $step['urutan']; ?>
                                                </span>
                                                <div>
                                                    <strong class="text-gray-700"><?= htmlspecialchars($step['judul_langkah'], ENT_QUOTES, 'UTF-8'); ?></strong>
                                                    <p class="mt-1 leading-relaxed text-gray-500"><?= nl2br(htmlspecialchars($step['deskripsi_langkah'], ENT_QUOTES, 'UTF-8')); ?></p>
                                                </div>
                                            </li>
                                        <?php endforeach; ?>
                                    </ol>
                                <?php else: ?>
                                    <p class="text-gray-400">Belum ada alur pelayanan.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endforeach; ?>
</main>

<script src="assets/js/layanan.js"></script>
