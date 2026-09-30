<?php
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
$base_url = $protocol . '://' . $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');

$berita = $berita ?? [];
$currentPage = (int) ($berita_current_page ?? 1);
$totalPages = (int) ($berita_total_pages ?? 1);
$flash = $berita_flash ?? null;

$formatDate = static function ($date) {
    if (!$date) {
        return '-';
    }

    $months = [
        1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
        5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
        9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember',
    ];

    try {
        $dt = new DateTime($date);
        return (int) $dt->format('j') . ' ' . $months[(int) $dt->format('n')] . ' ' . $dt->format('Y');
    } catch (Throwable $e) {
        return '-';
    }
};
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Berita - Administrator Desa Padangan</title>
    <link rel="icon" type="image/png" href="<?= $base_url; ?>/assets/images/logo.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .modal-open { overflow: hidden; }
    </style>
</head>
<body class="bg-[#F4F6F9] flex h-screen overflow-hidden" onclick="closeAllDropdowns(event)">

<?php include '../app/views/components/admin/admin_sidebar.php'; ?>

<main class="flex-1 flex flex-col h-screen overflow-y-auto md:ml-64 transition-all relative">
    <header class="bg-white border-b border-gray-200 px-4 md:px-8 py-4 flex justify-between items-center sticky top-0 z-30 shadow-sm">
        <div class="flex items-center gap-3">
            <button onclick="toggleSidebar()" class="md:hidden text-gray-700 hover:text-[#2F855A] focus:outline-none p-1 rounded-lg border border-gray-200">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
            </button>
            <div>
                <h1 class="text-base md:text-xl font-extrabold text-[#172033]">Manajemen Berita</h1>
                <p class="text-[11px] md:text-xs text-gray-500">Kelola dan publikasikan berita Desa Padangan.</p>
            </div>
        </div>
        <div class="text-right">
            <p id="current-date" class="text-xs font-bold text-gray-700">Memuat tanggal...</p>
            <p id="current-time" class="text-[10px] md:text-[11px] text-gray-400 mt-0.5">--:--:-- WIB</p>
        </div>
    </header>

    <?php if (!empty($flash['message'])): ?>
        <div id="berita-toast" class="fixed top-5 left-1/2 -translate-x-1/2 z-[100] min-w-[280px] max-w-[90vw] rounded-2xl border px-5 py-3 shadow-xl <?= ($flash['type'] ?? '') === 'success' ? 'border-emerald-200 bg-emerald-50 text-[#2F855A]' : 'border-red-200 bg-red-50 text-[#D92D20]' ?>">
            <div class="flex items-start gap-3">
                <div class="pt-0.5">
                    <?php if (($flash['type'] ?? '') === 'success'): ?>
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
                    <?php else: ?>
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="m15 9-6 6"/><path d="m9 9 6 6"/></svg>
                    <?php endif; ?>
                </div>
                <p class="text-xs md:text-sm font-semibold leading-relaxed"><?= htmlspecialchars($flash['message'], ENT_QUOTES, 'UTF-8'); ?></p>
            </div>
        </div>
    <?php endif; ?>

    <div class="p-4 md:p-8 max-w-7xl w-full mx-auto pb-20">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-4 md:gap-6">

            <?php if ($currentPage === 1): ?>
                <button type="button" onclick="openModal('addModal')" class="bg-white border-2 border-dashed border-emerald-300 rounded-2xl flex flex-col items-center justify-center p-6 h-[340px] cursor-pointer hover:bg-emerald-50/50 transition-colors group text-center">
                    <div class="w-12 h-12 rounded-full bg-emerald-50 text-[#2F855A] flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    </div>
                    <h4 class="text-xs font-bold text-gray-800">Tambahkan Berita Baru</h4>
                    <p class="text-[10px] text-gray-400 mt-1">Tulis dan publikasikan berita terbaru desa</p>
                </button>
            <?php endif; ?>

            <?php foreach ($berita as $item): ?>
                <?php
                    $imageUrl = $base_url . '/uploads/berita/' . rawurlencode($item['foto']);
                    $escapedJson = htmlspecialchars(json_encode([
                        'id' => (int) $item['id'],
                        'judul' => $item['judul'],
                        'deskripsi' => $item['deskripsi'],
                        'isi' => $item['isi'] ?? '',
                        'foto' => $item['foto'],
                    ], JSON_UNESCAPED_UNICODE | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP), ENT_QUOTES, 'UTF-8');
                ?>
                <article class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden flex flex-col h-[340px] hover:shadow-md transition-shadow relative">
                    <div class="relative h-40 w-full flex-shrink-0">
                        <img src="<?= $imageUrl; ?>" alt="<?= htmlspecialchars($item['judul'], ENT_QUOTES, 'UTF-8'); ?>" class="w-full h-full object-cover" loading="lazy">
                        <div class="absolute top-3 right-3">
                            <button type="button" onclick="toggleDropdown(event, 'dropdown-<?= (int) $item['id']; ?>')" class="w-8 h-8 rounded-full bg-white/90 text-gray-700 flex items-center justify-center hover:bg-white shadow-sm dropdown-btn">
                                <svg class="w-5 h-5 pointer-events-none" fill="currentColor" viewBox="0 0 20 20"><path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"></path></svg>
                            </button>
                            <div id="dropdown-<?= (int) $item['id']; ?>" class="dropdown-menu hidden absolute right-0 mt-2 w-36 bg-white rounded-xl shadow-lg border border-gray-100 z-10 overflow-hidden">
                                <button type="button" onclick='openEditModal(<?= $escapedJson; ?>)' class="w-full text-left px-4 py-2.5 text-xs font-semibold text-[#2F855A] hover:bg-gray-50 flex items-center gap-2">
                                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4Z"/></svg>
                                    Edit
                                </button>
                                <button type="button" onclick="openDeleteModal(<?= (int) $item['id']; ?>)" class="w-full text-left px-4 py-2.5 text-xs font-semibold text-white bg-[#D92D20] hover:bg-[#B42318] flex items-center gap-2 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 11v6"/><path d="M14 11v6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/><path d="M3 6h18"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                                    Hapus
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="p-4 flex flex-col flex-grow">
                        <div class="flex items-center text-[10px] text-gray-500 mb-2 gap-3 font-medium">
                            <span class="inline-flex items-center gap-1">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#172033" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M8 2v4"/><path d="M16 2v4"/><rect width="18" height="18" x="3" y="4" rx="2"/><path d="M3 10h18"/><path d="M8 14h.01"/><path d="M12 14h.01"/><path d="M16 14h.01"/><path d="M8 18h.01"/><path d="M12 18h.01"/><path d="M16 18h.01"/></svg>
                                <?= $formatDate($item['created_at']); ?>
                            </span>
                            <span class="inline-flex items-center gap-1">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#172033" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/><circle cx="12" cy="12" r="3"/></svg>
                                <?= number_format((int) $item['views']); ?>
                            </span>
                        </div>
                        <h4 class="font-bold text-[#172033] text-sm mb-2 line-clamp-2 leading-snug"><?= htmlspecialchars($item['judul'], ENT_QUOTES, 'UTF-8'); ?></h4>
                        <p class="text-[11px] text-gray-500 line-clamp-4 flex-grow leading-relaxed"><?= htmlspecialchars($item['deskripsi'], ENT_QUOTES, 'UTF-8'); ?></p>
                    </div>
                </article>
            <?php endforeach; ?>

            <?php if (!$berita && $currentPage === 1): ?>
                <div class="bg-white rounded-2xl border border-gray-200 h-[340px] flex items-center justify-center text-center p-6">
                    <div>
                        <p class="text-sm font-bold text-[#172033]">Belum ada berita</p>
                        <p class="text-xs text-gray-500 mt-1">Gunakan slot tambah berita untuk membuat publikasi pertama.</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <?php if ($totalPages > 1): ?>
            <nav class="mt-8 flex items-center justify-center gap-2" aria-label="Pagination">
                <?php $prevDisabled = $currentPage <= 1; ?>
                <a href="<?= $prevDisabled ? '#' : $base_url . '/index.php?url=admin/berita&page=' . ($currentPage - 1); ?>" class="w-10 h-10 rounded-xl border flex items-center justify-center transition-colors <?= $prevDisabled ? 'border-gray-200 text-gray-300 pointer-events-none' : 'border-gray-200 text-[#2F855A] hover:bg-emerald-50'; ?>" aria-label="Halaman sebelumnya">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                </a>

                <?php for ($page = 1; $page <= $totalPages; $page++): ?>
                    <a href="<?= $base_url; ?>/index.php?url=admin/berita&page=<?= $page; ?>" class="w-10 h-10 rounded-xl flex items-center justify-center text-sm font-bold <?= $page === $currentPage ? 'bg-[#2F855A] text-white' : 'border border-gray-200 text-gray-600 hover:bg-gray-50'; ?>">
                        <?= $page; ?>
                    </a>
                <?php endfor; ?>

                <?php $nextDisabled = $currentPage >= $totalPages; ?>
                <a href="<?= $nextDisabled ? '#' : $base_url . '/index.php?url=admin/berita&page=' . ($currentPage + 1); ?>" class="w-10 h-10 rounded-xl border flex items-center justify-center transition-colors <?= $nextDisabled ? 'border-gray-200 text-gray-300 pointer-events-none' : 'border-gray-200 text-[#2F855A] hover:bg-emerald-50'; ?>" aria-label="Halaman berikutnya">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                </a>
            </nav>
        <?php endif; ?>
    </div>
</main>

<!-- Add Modal -->
<div id="addModal" class="fixed inset-0 z-[80] hidden items-center justify-center bg-black/50 p-4">
    <div class="flex w-full max-w-6xl max-h-[92vh] flex-col overflow-hidden rounded-3xl bg-white shadow-2xl" onclick="event.stopPropagation()">
        <form action="<?= $base_url; ?>/index.php?url=admin/berita" method="post" enctype="multipart/form-data" class="flex min-h-0 flex-1 flex-col">
            <input type="hidden" name="action" value="store">
            <!-- HEADER -->
            <div class="flex flex-none items-start justify-between gap-6 border-b border-gray-100 px-6 py-5 md:px-8 md:py-6">
                <div>
                    <h2 class="text-xl md:text-2xl font-bold leading-tight text-[#172033]"> Tambahkan Berita Baru</h2>
                    <p class="mt-1 text-sm text-[#475467]">Isi data berita dan unggah foto utama.</p>
                </div>

                <button type="button" onclick="closeModal('addModal')" class="flex h-10 w-10 flex-none items-center justify-center rounded-xl text-2xl leading-none text-[#475467] transition-colors hover:bg-gray-100 hover:text-[#172033]"aria-label="Tutup">
                    &times;
                </button>
            </div>

            <!-- BODY -->
            <div class="min-h-0 flex-1 overflow-y-auto px-6 py-6 md:px-8 md:py-8">
                <div class="grid grid-cols-1 gap-8 md:grid-cols-2">

                    <!-- KOLOM KIRI : FOTO -->
                    <div>
                        <label class="mb-3 block text-sm font-semibold text-[#172033]">Foto Utama</label>
                        <div id="add-preview-wrap" class="relative aspect-square overflow-hidden rounded-2xl border border-gray-200 bg-[#F7F9FC]">
                            <!-- Preview -->
                            <img id="add-preview" src="" alt="Preview foto berita" class="absolute inset-0 hidden h-full w-full object-cover">

                            <!-- Placeholder -->
                            <div id="add-preview-placeholder"class="absolute inset-0 flex flex-col items-center justify-center px-6 text-center">
                                <div class="mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-white text-[#2F855A] shadow-sm ring-1 ring-gray-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
                                        <rect width="18" height="18" x="3" y="3" rx="2"/>
                                        <circle cx="9" cy="9" r="2"/>
                                        <path d="m21 15-4.5-4.5L6 21"/>
                                    </svg>
                                </div>
                                <p class="text-sm font-semibold text-[#172033]">Pilih foto utama</p>
                                <p class="mt-1 text-xs leading-relaxed text-[#475467]">Klik area ini untuk mengunggah foto.</p>
                            </div>
                            <!-- Input file asli -->
                            <input id="add-foto" type="file" name="foto" required accept=".jpg,.jpeg,.png,image/jpeg,image/png" onchange="previewBeritaImage(this, 'add-preview')" class="absolute inset-0 z-10 h-full w-full cursor-pointer opacity-0" aria-label="Pilih foto utama">
                        </div>
                        <p class="mt-3 text-xs text-[#475467]">JPG/JPEG/PNG, maks. 5 MB.</p>
                    </div>

                    <!-- KOLOM KANAN : FORM -->
                    <div class="space-y-5">

                        <!-- JUDUL -->
                        <div>
                            <label for="add-judul" class="mb-2 block text-sm font-semibold text-[#172033]"> Judul Berita</label>

                            <input id="add-judul" name="judul" type="text" required maxlength="255" class="h-12 w-full rounded-xl border border-gray-200 bg-white px-4 text-sm md:text-base text-[#172033] outline-none transition focus:border-[#2F855A] focus:ring-2 focus:ring-emerald-100">
                        </div>
                        <!-- DETAIL BERITA -->
                        <div>
                            <label for="add-isi" class="mb-2 block text-sm font-semibold text-[#172033]">Detail Berita</label>
                            <textarea id="add-isi" name="isi" required rows="10" class="min-h-[270px] w-full resize-y rounded-xl border border-gray-200 bg-white px-4 py-3 text-sm md:text-base leading-relaxed text-[#172033] outline-none transition focus:border-[#2F855A] focus:ring-2 focus:ring-emerald-100" placeholder="Tulis detail berita di sini..."></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- FOOTER -->
            <div class="flex flex-none items-center justify-end gap-3 border-t border-gray-100 px-6 py-5 md:px-8">
                <button type="button" onclick="closeModal('addModal')" class="rounded-xl border border-[#D92D20] bg-white px-6 py-3 text-sm font-semibold text-[#D92D20] transition-colors hover:bg-red-50">Batal</button>
                <button type="submit"class="rounded-xl bg-[#2F855A] px-7 py-3 text-sm font-semibold text-white transition-colors hover:bg-[#276f4c]">Simpan</button>
            </div>
        </form>
    </div>
</div>


<!-- Edit Modal -->
<div id="editModal" class="fixed inset-0 z-[80] hidden items-center justify-center bg-black/50 p-4">
    <div class="flex w-full max-w-6xl max-h-[92vh] flex-col overflow-hidden rounded-3xl bg-white shadow-2xl"
        onclick="event.stopPropagation()"
    >
        <form action="<?= $base_url; ?>/index.php?url=admin/berita" method="post" enctype="multipart/form-data" class="flex min-h-0 flex-1 flex-col">
            <input type="hidden" name="action" value="update">
            <input id="edit-id" type="hidden" name="id">
            <input type="hidden" name="page" value="<?= $currentPage; ?>">

            <!-- HEADER -->
            <div class="flex flex-none items-start justify-between gap-6 border-b border-gray-100 px-6 py-5 md:px-8 md:py-6">
                <div>
                    <h2 class="text-xl md:text-2xl font-bold leading-tight text-[#172033]">Edit Berita</h2>
                    <p class="mt-1 text-sm text-[#475467]">Perbarui informasi berita dan foto utama.</p>
                </div>

                <button type="button" onclick="closeModal('editModal')" class="flex h-10 w-10 flex-none items-center justify-center rounded-xl text-2xl leading-none text-[#475467] transition-colors hover:bg-gray-100 hover:text-[#172033]"aria-label="Tutup">
                    &times;
                </button>
            </div>

            <!-- BODY -->
            <div class="min-h-0 flex-1 overflow-y-auto px-6 py-6 md:px-8 md:py-8">
                <div class="grid grid-cols-1 gap-8 md:grid-cols-2">

                    <!-- KOLOM KIRI : FOTO -->
                    <div>
                        <label class="mb-3 block text-sm font-semibold text-[#172033]">Foto Utama</label>
                        <div id="edit-preview-wrap" class="relative aspect-square overflow-hidden rounded-2xl border border-gray-200 bg-[#F7F9FC]">
                            <!-- Foto lama / foto baru -->
                            <img id="edit-preview"src="" alt="Preview foto berita" class="absolute inset-0 h-full w-full object-cover">

                            <!-- Fallback jika foto tidak tersedia -->
                            <div id="edit-preview-placeholder" class="absolute inset-0 hidden flex-col items-center justify-center px-6 text-center">
                                <div class="mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-white text-[#2F855A] shadow-sm ring-1 ring-gray-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
                                        <rect width="18" height="18" x="3" y="3" rx="2"/>
                                        <circle cx="9" cy="9" r="2"/>
                                        <path d="m21 15-4.5-4.5L6 21"/>
                                    </svg>
                                </div>

                                <p class="text-sm font-semibold text-[#172033]">Pilih foto utama</p>
                                <p class="mt-1 text-xs leading-relaxed text-[#475467]">Klik area ini untuk mengunggah foto baru.</p>
                            </div>

                            <!-- Input file asli -->
                            <input id="edit-foto" type="file" name="foto" accept=".jpg,.jpeg,.png,image/jpeg,image/png" onchange="previewBeritaImage(this, 'edit-preview')"class="absolute inset-0 z-10 h-full w-full cursor-pointer opacity-0" aria-label="Pilih foto baru">
                            <div class="pointer-events-none absolute inset-x-0 bottom-0 z-[11] bg-gradient-to-t from-black/55 to-transparent px-4 pb-4 pt-10">
                                <span class="text-xs font-medium text-white">Klik foto untuk mengganti gambar.</span>
                            </div>
                        </div>
                        <p class="mt-3 text-xs text-[#475467]">Foto baru opsional. JPG/JPEG/PNG, maks. 5 MB.</p>
                    </div>

                    <!-- KOLOM KANAN : FORM -->
                    <div class="space-y-5">

                        <!-- JUDUL -->
                        <div>
                            <label for="edit-judul" class="mb-2 block text-sm font-semibold text-[#172033]">Judul Berita</label>
                            <input id="edit-judul" name="judul" type="text" required maxlength="255" class="h-12 w-full rounded-xl border border-gray-200 bg-white px-4 text-sm md:text-base text-[#172033] outline-none transition focus:border-[#2F855A] focus:ring-2 focus:ring-emerald-100">
                        </div>

                        <!-- DETAIL BERITA -->
                        <div>
                            <label for="edit-isi" class="mb-2 block text-sm font-semibold text-[#172033]">Detail Berita</label>
                            <textarea id="edit-isi" name="isi" required rows="10" class="min-h-[270px] w-full resize-y rounded-xl border border-gray-200 bg-white px-4 py-3 text-sm md:text-base leading-relaxed text-[#172033] outline-none transition focus:border-[#2F855A] focus:ring-2 focus:ring-emerald-100" placeholder="Tulis detail berita di sini..."></textarea>
                        </div>

                    </div>
                </div>
            </div>

            <!-- FOOTER -->
            <div class="flex flex-none items-center justify-end gap-3 border-t border-gray-100 px-6 py-5 md:px-8">
                <button type="button" onclick="closeModal('editModal')" class="rounded-xl border border-[#D92D20] bg-white px-6 py-3 text-sm font-semibold text-[#D92D20] transition-colors hover:bg-red-50">
                    Batal
                </button>

                <button type="submit" class="rounded-xl bg-[#2F855A] px-7 py-3 text-sm font-semibold text-white transition-colors hover:bg-[#276f4c]">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Delete Modal -->
<div id="deleteModal" class="fixed inset-0 z-[90] hidden items-center justify-center bg-black/50 p-4">
    <div class="w-full max-w-md rounded-3xl bg-white shadow-2xl overflow-hidden" onclick="event.stopPropagation()">
        <form action="<?= $base_url; ?>/index.php?url=admin/berita" method="post">
            <input type="hidden" name="action" value="delete">
            <input id="delete-id" type="hidden" name="id">
            <input type="hidden" name="page" value="<?= $currentPage; ?>">
            <div class="p-7"><div class="w-12 h-12 rounded-2xl bg-red-50 text-[#D92D20] flex items-center justify-center mb-4"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 11v6"/><path d="M14 11v6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/><path d="M3 6h18"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg></div><h2 class="text-lg font-extrabold text-[#172033]">Hapus berita?</h2><p class="text-sm text-gray-500 mt-2">Data berita dan file fotonya akan dihapus. Tindakan ini tidak dapat dibatalkan.</p></div>
            <div class="px-7 py-5 bg-gray-50 border-t border-gray-100 flex justify-end gap-3"><button type="button" onclick="closeModal('deleteModal')" class="px-5 py-2.5 rounded-xl border border-gray-200 text-sm font-semibold text-gray-700">Batal</button><button type="submit" class="px-5 py-2.5 rounded-xl bg-[#D92D20] text-white text-sm font-bold hover:bg-[#B42318]">Hapus Berita</button></div>
        </form>
    </div>
</div>

<script>
function openModal(id){const el=document.getElementById(id);if(!el)return;el.classList.remove('hidden');el.classList.add('flex');document.body.classList.add('modal-open');}
function closeModal(id){const el=document.getElementById(id);if(!el)return;el.classList.add('hidden');el.classList.remove('flex');document.body.classList.remove('modal-open');}
function closeAllDropdowns(event){document.querySelectorAll('.dropdown-menu').forEach(menu=>{if(!menu.contains(event.target))menu.classList.add('hidden');});}
function toggleDropdown(event,id){event.stopPropagation();document.querySelectorAll('.dropdown-menu').forEach(menu=>{if(menu.id!==id)menu.classList.add('hidden');});const el=document.getElementById(id);if(el)el.classList.toggle('hidden');}
function openDeleteModal(id){document.getElementById('delete-id').value=id;document.querySelectorAll('.dropdown-menu').forEach(menu=>menu.classList.add('hidden'));openModal('deleteModal');}
function openEditModal(data){
    document.getElementById('edit-id').value = data.id;
    document.getElementById('edit-judul').value = data.judul || '';
    document.getElementById('edit-isi').value = data.isi || data.deskripsi || '';
    document.getElementById('edit-foto').value = '';
    document.getElementById('edit-preview').src = '<?= $base_url; ?>/uploads/berita/' + encodeURIComponent(data.foto || '');
    document.getElementById('edit-preview').classList.remove('hidden');
    document.getElementById('edit-preview-placeholder').classList.add('hidden');
    document.querySelectorAll('.dropdown-menu').forEach(menu => menu.classList.add('hidden'));
    openModal('editModal');
}
function previewBeritaImage(input, imgId) {
    const file = input.files && input.files[0];
    const img = document.getElementById(imgId);
    const wrap = document.getElementById(imgId + '-wrap');
    const placeholder = document.getElementById(imgId + '-placeholder');

    if (!file || !img || !wrap) {
        return;
    }

    if (file.size > 5 * 1024 * 1024) {
        alert('Ukuran file maksimal 5 MB.');
        input.value = '';
        return;
    }

    const allowed = ['image/jpeg', 'image/png'];

    if (!allowed.includes(file.type)) {
        alert('Format file hanya JPG, JPEG, atau PNG.');
        input.value = '';
        return;
    }

    if (window.URL && URL.revokeObjectURL) {
        if (img.dataset.objectUrl) {
            URL.revokeObjectURL(img.dataset.objectUrl);
        }

        img.dataset.objectUrl = URL.createObjectURL(file);
        img.src = img.dataset.objectUrl;
    }

    img.classList.remove('hidden');

    if (placeholder) {
        placeholder.classList.add('hidden');
        placeholder.classList.remove('flex');
    }

    wrap.classList.remove('hidden');
}
function updateClock(){const now=new Date();const date=new Intl.DateTimeFormat('id-ID',{weekday:'long',day:'2-digit',month:'long',year:'numeric'}).format(now);const time=new Intl.DateTimeFormat('id-ID',{hour:'2-digit',minute:'2-digit',second:'2-digit',hour12:false,timeZone:'Asia/Jakarta'}).format(now);document.getElementById('current-date').textContent=date;document.getElementById('current-time').textContent=time+' WIB';}
updateClock();setInterval(updateClock,1000);
setTimeout(()=>{const toast=document.getElementById('berita-toast');if(toast){toast.style.transition='opacity .35s ease, transform .35s ease';toast.style.opacity='0';toast.style.transform='translate(-50%, -10px)';setTimeout(()=>toast.remove(),400);}},3500);
window.addEventListener('click',()=>{});
</script>

</body>
</html>
