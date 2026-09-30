<?php
$daftarLayanan = $layanan ?? [];
$editLayanan = $edit_layanan ?? null;
$groupedLayanan = [];

function adminKategoriKey($kategori)
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

function adminKategoriLabel($kategori, $key)
{
    if ($key === 'kependudukan') {
        return 'Kependudukan';
    }

    if ($key === 'surat') {
        return 'Surat Keterangan';
    }

    if (trim((string) $kategori) === '') {
        return 'Kategori Lainnya';
    }

    return 'Surat Lainnya & Perizinan';
}

function adminKategoriIcon($kategori)
{
    $key = adminKategoriKey($kategori);

    if ($key === 'kependudukan') {
        return '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-id-card"><path d="M13 19a4 4 0 00-8 0"/><path d="M16 10h2"/><path d="M16 14h2"/><circle cx="9" cy="12" r="3"/><rect x="2" y="5" width="20" height="14" rx="2"/></svg>';
    }

    if ($key === 'surat') {
        return '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file"><path d="M6 22a2 2 0 01-2-2V4a2 2 0 012-2h8a2.4 2.4 0 011.704.706l3.588 3.588A2.4 2.4 0 0120 8v12a2 2 0 01-2 2z"/><path d="M14 2v5a1 1 0 001 1h5"/></svg>';
    }

    return '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-scale"><path d="M12 3v18"/><path d="m19 8 3 8a5 5 0 0 1-6 0zV7"/><path d="M3 7h1a17 17 0 0 0 8-2 17 17 0 0 0 8 2h1"/><path d="m5 8 3 8a5 5 0 0 1-6 0zV7"/><path d="M7 21h10"/></svg>';
}

foreach ($daftarLayanan as $item) {
    $key = adminKategoriKey($item['kategori'] ?? '');

    if (!isset($groupedLayanan[$key])) {
        $groupedLayanan[$key] = [
            'label' => adminKategoriLabel($item['kategori'] ?? '', $key),
            'items' => [],
        ];
    }

    $groupedLayanan[$key]['items'][] = $item;
}

$layananFlash = $layanan_flash ?? null;
$isEditMode = $editLayanan !== null;

$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
    ? 'https'
    : 'http';

$base_url = $protocol . '://' . $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');

$baseLayananUrl = $base_url . '/index.php?url=admin/layanan';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Layanan - Administrator Desa Padangan</title>
    <link rel="icon" type="image/png" href="assets/images/logo.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>
<body class="bg-[#F4F6F9] flex h-screen overflow-hidden">

    <?php include '../app/views/components/admin/admin_sidebar.php'; ?>

    <main class="flex-1 flex flex-col h-screen overflow-y-auto md:ml-64 transition-all">
        <header class="bg-white border-b border-gray-200 px-4 md:px-8 py-4 flex justify-between items-center sticky top-0 z-30 shadow-xs">
            <div class="flex items-center gap-3">
                <button onclick="toggleSidebar()" class="md:hidden text-gray-700 hover:text-[#2F855A] focus:outline-none p-1 rounded-lg border border-gray-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>
                <div>
                    <h1 id="pageTitle" class="text-base md:text-xl font-extrabold text-[#172033]"><?= $isEditMode ? 'Edit Layanan' : 'Manajemen Layanan Desa'; ?></h1>
                    <p id="pageSubtitle" class="text-[11px] md:text-xs text-gray-500"><?= $isEditMode ? 'Perbarui informasi layanan yang tersedia di Desa Padangan.' : 'Kelola informasi daftar layanan Desa Padangan.'; ?></p>
                </div>
            </div>
            <div class="text-right">
                <p id="current-date" class="text-xs font-bold text-gray-700">Memuat tanggal...</p>
                <p id="current-time" class="text-[10px] md:text-[11px] text-gray-400 mt-0.5">--:--:-- WIB</p>
            </div>
        </header>

        <div class="p-4 md:p-8 w-full max-w-5xl mx-auto">
            <?php if (!empty($layananFlash['message'])): ?>
                <?php $flashIsError = ($layananFlash['type'] ?? '') === 'error'; ?>

                <div
                    id="layananToast"
                    role="status"
                    aria-live="polite"
                    class="fixed top-5 left-1/2 -translate-x-1/2 z-[70] max-w-sm rounded-2xl border px-4 py-3 text-xs font-semibold shadow-lg transition-all duration-300 <?= $flashIsError ? 'border-red-200 bg-red-50 text-red-600' : 'border-emerald-200 bg-emerald-50 text-[#2F855A]'; ?>"
                >
                    <?= htmlspecialchars($layananFlash['message'], ENT_QUOTES, 'UTF-8'); ?>
                </div>
            <?php endif; ?>
        </div>

        <div id="view-list" class="p-4 md:p-8 space-y-8 max-w-5xl w-full mx-auto pb-20 <?= $isEditMode ? 'hidden' : 'block'; ?>">
            <button onclick="showForm('tambah')" class="w-full flex items-center justify-center md:justify-start gap-2 bg-white border border-gray-200 p-4 rounded-2xl shadow-sm hover:shadow-md transition-shadow text-[#2F855A] font-semibold text-sm cursor-pointer group">
                <div class="w-8 h-8 rounded-full bg-emerald-50 flex items-center justify-center group-hover:bg-emerald-100 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                </div>
                Tambah Informasi layanan baru
            </button>

            <div>
                <h2 class="text-lg font-bold text-[#172033] mb-6">Layanan Yang Tersedia</h2>

                <?php if (empty($groupedLayanan)): ?>
                    <div class="bg-white border border-gray-200 rounded-2xl p-8 text-center text-sm text-gray-500">
                        Belum ada layanan yang tersimpan.
                    </div>
                <?php endif; ?>

                <?php foreach ($groupedLayanan as $groupKey => $group): ?>
                    <div class="mb-8">
                        <h3 class="text-sm font-bold text-gray-800 mb-4 px-2"><?= htmlspecialchars($group['label'], ENT_QUOTES, 'UTF-8'); ?></h3>
                        <div class="space-y-3">
                            <?php foreach ($group['items'] as $item): ?>
                                <?php
                                $serviceId = (int) $item['id'];
                                $contentId = 'layanan-content-' . $serviceId;
                                $iconId = 'layanan-icon-' . $serviceId;
                                $serviceName = htmlspecialchars($item['nama_layanan'], ENT_QUOTES, 'UTF-8');
                                ?>
                                <div class="bg-white border border-gray-200 rounded-2xl shadow-xs overflow-hidden transition-all duration-300">
                                    <div class="p-4 flex flex-col md:flex-row md:items-center justify-between gap-4 cursor-pointer hover:bg-gray-50/50" onclick="toggleAccordion('<?= $contentId; ?>', '<?= $iconId; ?>')">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 rounded-xl bg-emerald-50 flex items-center justify-center text-[#2F855A]">
                                                <?= adminKategoriIcon($item['kategori'] ?? ''); ?>
                                            </div>
                                            <div>
                                                <h4 class="text-sm font-bold text-gray-800"><?= $serviceName; ?></h4>
                                                <p class="text-[10px] text-gray-400 mt-0.5"><?= htmlspecialchars($item['kategori'] ?? '', ENT_QUOTES, 'UTF-8'); ?></p>
                                            </div>
                                        </div>
                                        <div class="flex items-center gap-2" onclick="event.stopPropagation()">
                                            <a
                                                href="<?= $baseLayananUrl; ?>&edit_id=<?= $serviceId; ?>"
                                                onclick="event.stopPropagation()"
                                                class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg border border-[#BFDBFE] bg-[#EFF6FF] text-[#2563B8] hover:bg-[#DBEAFE] text-xs font-semibold"
                                            >
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    width="24"
                                                    height="24"
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    stroke-width="2"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    class="lucide lucide-square-pen w-4 h-4"
                                                >
                                                    <path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                                    <path d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z"/>
                                                </svg>
                                                Edit
                                            </a>
                                            <button
                                                type="button"
                                                onclick="event.stopPropagation(); openDeleteModal(<?= $serviceId; ?>, '<?= htmlspecialchars($item['nama_layanan'], ENT_QUOTES, 'UTF-8'); ?>')"
                                                class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg border border-[#FDA29B] bg-[rgba(253,162,155,0.20)] text-[#D92D20] hover:bg-[rgba(253,162,155,0.30)] text-xs font-semibold"
                                            >
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    width="24"
                                                    height="24"
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    stroke-width="2"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    class="lucide lucide-trash w-4 h-4"
                                                >
                                                    <path d="M10 11v6"/>
                                                    <path d="M14 11v6"/>
                                                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/>
                                                    <path d="M3 6h18"/>
                                                    <path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                                                </svg>
                                                Hapus
                                            </button>
                                            <button type="button" onclick="event.stopPropagation(); toggleAccordion('<?= $contentId; ?>', '<?= $iconId; ?>')" class="w-8 h-8 flex items-center justify-center text-gray-400" aria-label="Buka/tutup detail">
                                                <svg id="<?= $iconId; ?>" class="w-5 h-5 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7"></path></svg>
                                            </button>
                                        </div>
                                    </div>

                                    <div id="<?= $contentId; ?>" class="hidden px-4 pb-4 md:px-16 border-t border-gray-100 pt-4 bg-gray-50/30">
                                        <div class="mb-5">
                                            <h5 class="text-xs font-bold text-gray-800 mb-2">Persyaratan</h5>
                                            <?php if (!empty($item['persyaratan'])): ?>
                                                <ul class="space-y-1.5 text-xs text-gray-600">
                                                    <?php foreach ($item['persyaratan'] as $syarat): ?>
                                                        <li class="flex items-start gap-2">
                                                            <svg class="w-4 h-4 text-[#2F855A] mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                            <?= htmlspecialchars($syarat['nama_persyaratan'], ENT_QUOTES, 'UTF-8'); ?>
                                                        </li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            <?php else: ?>
                                                <p class="text-xs text-gray-400">Tidak ada persyaratan khusus.</p>
                                            <?php endif; ?>
                                        </div>

                                        <div>
                                            <h5 class="text-xs font-bold text-gray-800 mb-3">Alur Pengajuan</h5>
                                            <?php if (!empty($item['alur'])): ?>
                                                <div class="space-y-4 border-l-2 border-gray-200 ml-3 pl-4">
                                                    <?php foreach ($item['alur'] as $step): ?>
                                                        <div class="relative flex items-start gap-3">
                                                            <div class="absolute -left-[27px] w-6 h-6 rounded-full bg-emerald-100 text-[#2F855A] flex items-center justify-center text-[10px] font-bold ring-4 ring-white">
                                                                <?= (int) $step['urutan']; ?>
                                                            </div>
                                                            <div>
                                                                <h6 class="text-xs font-semibold text-gray-800"><?= htmlspecialchars($step['judul_langkah'], ENT_QUOTES, 'UTF-8'); ?></h6>
                                                                <p class="text-[11px] text-gray-500 mt-1 leading-relaxed"><?= nl2br(htmlspecialchars($step['deskripsi_langkah'], ENT_QUOTES, 'UTF-8')); ?></p>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            <?php else: ?>
                                                <p class="text-xs text-gray-400">Belum ada alur pelayanan.</p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div id="view-form" class="p-4 md:p-8 max-w-4xl w-full mx-auto <?= $isEditMode ? 'block' : 'hidden'; ?> pb-20">
            <form id="layananForm" action="<?= $baseLayananUrl; ?>" method="POST" onsubmit="return validateAndSave();" class="space-y-6">
                <input type="hidden" name="action" id="formAction" value="<?= $isEditMode ? 'update' : 'store'; ?>">
                <input type="hidden" name="id" id="layananId" value="<?= $isEditMode && isset($editLayanan['id']) ? (int) $editLayanan['id'] : ''; ?>">

                <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-xs">
                    <h3 class="text-sm font-bold text-gray-800 flex items-center gap-2 mb-4">
                        <svg class="w-4 h-4 text-[#2F855A]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12h6m-6 4h6m2 5H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5.586a1 1 0 0 1 .707.293l5.414 5.414a1 1 0 0 1 .293.707V19a2 2 0 0 1-2 2z"></path></svg>
                        Informasi Layanan
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1.5">Nama Layanan*</label>
                            <input type="text" id="inputNamaLayanan" name="nama_layanan" required value="<?= ($isEditMode && isset($editLayanan['nama_layanan'])) ? htmlspecialchars($editLayanan['nama_layanan'], ENT_QUOTES, 'UTF-8') : ''; ?>" placeholder="Contoh: Surat Keterangan Pindah" class="w-full px-3 py-2 border border-gray-300 rounded-xl text-xs focus:outline-none focus:border-[#2F855A]">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1.5">Kategori Layanan*</label>
                            <select id="inputKategori" name="kategori" required class="w-full px-3 py-2 border border-gray-300 rounded-xl text-xs focus:outline-none focus:border-[#2F855A] bg-white cursor-pointer appearance-none">
                                <option value="">Pilih Kategori Layanan</option>
                                <?php
                                $kategoriEdit = ($isEditMode && isset($editLayanan['kategori'])) ? $editLayanan['kategori'] : '';
                                $kategoriOptions = ['Kependudukan', 'Surat Keterangan', 'Surat Lainnya'];
                                foreach ($kategoriOptions as $kategoriOption):
                                ?>
                                    <option value="<?= htmlspecialchars($kategoriOption, ENT_QUOTES, 'UTF-8'); ?>" <?= $kategoriEdit === $kategoriOption ? 'selected' : ''; ?>><?= htmlspecialchars($kategoriOption, ENT_QUOTES, 'UTF-8'); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-xs">
                    <h3 class="text-sm font-bold text-gray-800 flex items-center gap-2 mb-4">
                        <svg class="w-4 h-4 text-[#2F855A]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 5H7a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-2M9 5a2 2 0 0 0 0 4h2a2 2 0 0 0 2-2M9 5a2 2 0 0 0 2-2h2a2 2 0 0 0 2 2"></path></svg>
                        Dokumen Persyaratan Layanan
                    </h3>

                    <div id="container-persyaratan" class="space-y-3 mb-4">
                        <?php if ($isEditMode && !empty($editLayanan['persyaratan'])): ?>
                            <?php foreach ($editLayanan['persyaratan'] as $syarat): ?>
                                <div class="flex items-center gap-3 req-row">
                                    <input type="text" name="persyaratan[]" value="<?= htmlspecialchars($syarat['nama_persyaratan'], ENT_QUOTES, 'UTF-8'); ?>" placeholder="Contoh: Foto Copy KTP" class="req-input flex-1 px-3 py-2 border border-gray-300 rounded-xl text-xs focus:outline-none focus:border-[#2F855A]">
                                    <button type="button" onclick="removeRow(this)" class="w-9 h-9 flex items-center justify-center border border-[#FDA29B] bg-[rgba(253,162,155,0.20)] text-[#D92D20] rounded-xl hover:bg-[rgba(253,162,155,0.30)] shrink-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash w-4 h-4"><path d="M10 11v6"/><path d="M14 11v6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/><path d="M3 6h18"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                                    </button>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="flex items-center gap-3 req-row">
                                <input type="text" name="persyaratan[]" placeholder="Contoh: Foto Copy KTP" class="req-input flex-1 px-3 py-2 border border-gray-300 rounded-xl text-xs focus:outline-none focus:border-[#2F855A]">
                                <button type="button" onclick="removeRow(this)" class="w-9 h-9 flex items-center justify-center border border-[#FDA29B] bg-[rgba(253,162,155,0.20)] text-[#D92D20] rounded-xl hover:bg-[rgba(253,162,155,0.30)] shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash w-4 h-4"><path d="M10 11v6"/><path d="M14 11v6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/><path d="M3 6h18"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                                </button>
                            </div>
                        <?php endif; ?>
                    </div>

                    <button type="button" onclick="addPersyaratan()" class="text-xs font-semibold text-gray-600 border border-gray-300 rounded-xl px-4 py-2 hover:bg-gray-50 flex items-center gap-1.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 4v16m8-8H4"></path></svg>
                        Tambah Dokumen Persyaratan
                    </button>
                </div>

                <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-xs">
                    <h3 class="text-sm font-bold text-gray-800 flex items-center gap-2 mb-4">
                        <svg class="w-4 h-4 text-[#2F855A]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12"></path></svg>
                        Alur & Prosedur Pelayanan
                    </h3>

                    <div id="container-alur" class="space-y-4 mb-4">
                        <?php if ($isEditMode && !empty($editLayanan['alur'])): ?>
                            <?php foreach ($editLayanan['alur'] as $index => $step): ?>
                                <div class="alur-row border border-gray-100 bg-gray-50/50 p-4 rounded-xl flex items-start gap-3 relative group">
                                    <div class="w-6 h-6 rounded-full bg-white border border-gray-200 text-gray-500 flex items-center justify-center text-[10px] font-bold shrink-0 alur-number"><?= $index + 1; ?></div>
                                    <div class="flex-1 grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-[10px] font-semibold text-gray-500 mb-1">Judul Langkah</label>
                                            <input type="text" name="alur_judul[]" value="<?= htmlspecialchars($step['judul_langkah'], ENT_QUOTES, 'UTF-8'); ?>" placeholder="Contoh: Datang ke Kantor Kepala Desa" class="alur-judul w-full px-3 py-2 border border-gray-300 rounded-xl text-xs focus:outline-none focus:border-[#2F855A]">
                                        </div>
                                        <div>
                                            <label class="block text-[10px] font-semibold text-gray-500 mb-1">Deskripsi Langkah</label>
                                            <textarea name="alur_deskripsi[]" rows="3" placeholder="Contoh: Datang langsung dan serahkan..." class="alur-desc w-full px-3 py-2 border border-gray-300 rounded-xl text-xs focus:outline-none focus:border-[#2F855A] resize-none"><?= htmlspecialchars($step['deskripsi_langkah'], ENT_QUOTES, 'UTF-8'); ?></textarea>
                                        </div>
                                    </div>
                                    <button type="button" onclick="removeRow(this, true)" class="w-8 h-8 flex items-center justify-center border border-[#FDA29B] bg-[rgba(253,162,155,0.20)] text-[#D92D20] rounded-lg hover:bg-[rgba(253,162,155,0.30)] shrink-0 mt-4 md:mt-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash w-4 h-4"><path d="M10 11v6"/><path d="M14 11v6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/><path d="M3 6h18"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                                    </button>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="alur-row border border-gray-100 bg-gray-50/50 p-4 rounded-xl flex items-start gap-3 relative group">
                                <div class="w-6 h-6 rounded-full bg-white border border-gray-200 text-gray-500 flex items-center justify-center text-[10px] font-bold shrink-0 alur-number">1</div>
                                <div class="flex-1 grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-[10px] font-semibold text-gray-500 mb-1">Judul Langkah</label>
                                        <input type="text" name="alur_judul[]" placeholder="Contoh: Datang ke Kantor Kepala Desa" class="alur-judul w-full px-3 py-2 border border-gray-300 rounded-xl text-xs focus:outline-none focus:border-[#2F855A]">
                                    </div>
                                    <div>
                                        <label class="block text-[10px] font-semibold text-gray-500 mb-1">Deskripsi Langkah</label>
                                        <textarea name="alur_deskripsi[]" rows="3" placeholder="Contoh: Datang langsung dan serahkan..." class="alur-desc w-full px-3 py-2 border border-gray-300 rounded-xl text-xs focus:outline-none focus:border-[#2F855A] resize-none"></textarea>
                                    </div>
                                </div>
                                <button type="button" onclick="removeRow(this, true)" class="w-8 h-8 flex items-center justify-center border border-[#FDA29B] bg-[rgba(253,162,155,0.20)] text-[#D92D20] rounded-lg hover:bg-[rgba(253,162,155,0.30)] shrink-0 mt-4 md:mt-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash w-4 h-4"><path d="M10 11v6"/><path d="M14 11v6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/><path d="M3 6h18"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                                </button>
                            </div>
                        <?php endif; ?>
                    </div>

                    <button type="button" onclick="addAlur()" class="text-xs font-semibold text-gray-600 border border-gray-300 rounded-xl px-4 py-2 hover:bg-gray-50 flex items-center gap-1.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 4v16m8-8H4"></path></svg>
                        Tambah Alur & Prosedur Pelayanan
                    </button>
                </div>

                <div class="flex justify-end gap-3 pt-4 border-t border-gray-200">
                    <button type="button" onclick="hideForm()" class="px-5 py-2.5 rounded-xl border border-gray-300 text-gray-700 text-xs font-semibold hover:bg-gray-50 transition-colors">Batal</button>
                    <button type="submit" id="btnSubmitForm" class="px-5 py-2.5 rounded-xl bg-[#2F855A] text-white text-xs font-semibold hover:bg-[#246946] shadow-sm transition-colors"><?= $isEditMode ? 'Simpan Perubahan' : 'Simpan Layanan'; ?></button>
                </div>
            </form>
        </div>
    </main>

    <div id="deleteModal" class="fixed inset-0 bg-black/60 z-50 flex items-center justify-center p-4 hidden opacity-0 transition-opacity duration-300">
        <div class="bg-white rounded-3xl shadow-2xl max-w-sm w-full p-6 text-center transform scale-95 transition-transform duration-300">
            <div class="w-16 h-16 rounded-full bg-red-50 flex items-center justify-center mx-auto mb-4 text-red-500 border border-red-100">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
            </div>
            <h3 class="text-lg font-extrabold text-[#172033] mb-2">Hapus Layanan?</h3>
            <p id="deleteMessage" class="text-xs text-gray-500 mb-6">Apakah Anda yakin ingin menghapus layanan ini?<br>Data yang dihapus tidak dapat dikembalikan.</p>
            <form action="<?= $baseLayananUrl; ?>" method="POST" class="flex items-center justify-center gap-3">
                <input type="hidden" name="action" value="delete">
                <input type="hidden" name="id" id="deleteLayananId" value="">
                <button type="button" onclick="closeModal('deleteModal')" class="flex-1 py-2.5 rounded-xl border border-red-200 text-red-600 font-semibold text-xs hover:bg-red-50">Batal</button>
                <button type="submit" class="flex-1 py-2.5 rounded-xl bg-red-600 text-white font-semibold text-xs hover:bg-red-700">Hapus</button>
            </form>
        </div>
    </div>

    <div id="errorModal" class="fixed inset-0 bg-black/60 z-50 flex items-center justify-center p-4 hidden opacity-0 transition-opacity duration-300">
        <div class="bg-white rounded-3xl shadow-2xl max-w-sm w-full p-6 text-center transform scale-95 transition-transform duration-300 relative">
            <button onclick="closeModal('errorModal')" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12"></path></svg></button>
            <div class="w-16 h-16 rounded-full bg-red-50 flex items-center justify-center mx-auto mb-4 text-red-500 border border-red-100">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 8v4m0 4h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0z"></path></svg>
            </div>
            <h3 class="text-lg font-extrabold text-[#172033] mb-2">Data Belum Lengkap</h3>
            <p id="errorMessage" class="text-xs text-gray-500 mb-2">Silakan lengkapi data layanan sebelum menyimpan.</p>
            <button onclick="closeModal('errorModal')" class="mt-4 w-full py-2.5 rounded-xl bg-[#2F855A] text-white text-xs font-semibold">OK</button>
        </div>
    </div>

    <div id="saveModal" class="fixed inset-0 bg-black/60 z-50 flex items-center justify-center p-4 hidden opacity-0 transition-opacity duration-300">
        <div class="bg-white rounded-3xl shadow-2xl max-w-sm w-full p-6 text-center transform scale-95 transition-transform duration-300">
            <div class="w-16 h-16 rounded-full bg-emerald-50 flex items-center justify-center mx-auto mb-4 text-[#2F855A] border border-emerald-100">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"></path></svg>
            </div>
            <h3 class="text-lg font-extrabold text-[#172033] mb-2">Simpan Perubahan?</h3>
            <p class="text-xs text-gray-500 mb-6">Data layanan akan disimpan ke database dan ditampilkan pada halaman publik.</p>
            <div class="flex items-center justify-center gap-3">
                <button type="button" onclick="closeModal('saveModal')" class="flex-1 py-2.5 rounded-xl border border-red-200 text-red-600 font-semibold text-xs hover:bg-red-50">Batal</button>
                <button type="button" onclick="confirmAction('saveModal')" class="flex-1 py-2.5 rounded-xl bg-[#2F855A] text-white font-semibold text-xs hover:bg-[#246946]">Simpan</button>
            </div>
        </div>
    </div>

    <script>
        const adminLayananUrl = <?= json_encode($baseLayananUrl); ?>;
        const isEditMode = <?= $isEditMode ? 'true' : 'false'; ?>;

        function showForm(mode) {
            hideLayananToast();

            document.getElementById('view-list').classList.add('hidden');
            document.getElementById('view-form').classList.remove('hidden');

            if (mode === 'tambah') {
                document.getElementById('pageTitle').innerText = 'Tambah Layanan Baru';
                document.getElementById('pageSubtitle').innerText = 'Tambahkan informasi layanan yang tersedia di Desa Padangan.';
                document.getElementById('btnSubmitForm').innerText = 'Simpan Layanan';
                document.getElementById('formAction').value = 'store';
                document.getElementById('layananId').value = '';
                resetFormRows();
                document.getElementById('layananForm').reset();
                document.getElementById('formAction').value = 'store';
                document.getElementById('layananId').value = '';
            }
        }

        function hideForm() {
            window.location.href = adminLayananUrl;
        }

        function resetFormRows() {
            const reqContainer = document.getElementById('container-persyaratan');
            reqContainer.innerHTML = `
                <div class="flex items-center gap-3 req-row">
                    <input type="text" name="persyaratan[]" placeholder="Contoh: Foto Copy KTP" class="req-input flex-1 px-3 py-2 border border-gray-300 rounded-xl text-xs focus:outline-none focus:border-[#2F855A]">
                    <button type="button" onclick="removeRow(this)" class="w-9 h-9 flex items-center justify-center border border-[#FDA29B] bg-[rgba(253,162,155,0.20)] text-[#D92D20] rounded-xl hover:bg-[rgba(253,162,155,0.30)] shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash w-4 h-4"><path d="M10 11v6"/><path d="M14 11v6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/><path d="M3 6h18"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                    </button>
                </div>`;

            const alurContainer = document.getElementById('container-alur');
            alurContainer.innerHTML = `
                <div class="alur-row border border-gray-100 bg-gray-50/50 p-4 rounded-xl flex items-start gap-3 relative group">
                    <div class="w-6 h-6 rounded-full bg-white border border-gray-200 text-gray-500 flex items-center justify-center text-[10px] font-bold shrink-0 alur-number">1</div>
                    <div class="flex-1 grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[10px] font-semibold text-gray-500 mb-1">Judul Langkah</label>
                            <input type="text" name="alur_judul[]" placeholder="Contoh: Datang ke Kantor Kepala Desa" class="alur-judul w-full px-3 py-2 border border-gray-300 rounded-xl text-xs focus:outline-none focus:border-[#2F855A]">
                        </div>
                        <div>
                            <label class="block text-[10px] font-semibold text-gray-500 mb-1">Deskripsi Langkah</label>
                            <textarea name="alur_deskripsi[]" rows="3" placeholder="Contoh: Datang langsung dan serahkan..." class="alur-desc w-full px-3 py-2 border border-gray-300 rounded-xl text-xs focus:outline-none focus:border-[#2F855A] resize-none"></textarea>
                        </div>
                    </div>
                    <button type="button" onclick="removeRow(this, true)" class="w-8 h-8 flex items-center justify-center border border-[#FDA29B] bg-[rgba(253,162,155,0.20)] text-[#D92D20] rounded-lg hover:bg-[rgba(253,162,155,0.30)] shrink-0 mt-4 md:mt-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash w-4 h-4"><path d="M10 11v6"/><path d="M14 11v6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/><path d="M3 6h18"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                    </button>
                </div>`;
        }

        function addPersyaratan() {
            const container = document.getElementById('container-persyaratan');
            const row = document.createElement('div');
            row.className = 'flex items-center gap-3 req-row mt-3';
            row.innerHTML = `
                <input type="text" name="persyaratan[]" placeholder="Contoh: Foto Copy Dokumen" class="req-input flex-1 px-3 py-2 border border-gray-300 rounded-xl text-xs focus:outline-none focus:border-[#2F855A]">
                <button type="button" onclick="removeRow(this)" class="w-9 h-9 flex items-center justify-center border border-[#FDA29B] bg-[rgba(253,162,155,0.20)] text-[#D92D20] rounded-xl hover:bg-[rgba(253,162,155,0.30)] shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash w-4 h-4"><path d="M10 11v6"/><path d="M14 11v6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/><path d="M3 6h18"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                </button>`;
            container.appendChild(row);
        }

        function addAlur() {
            const container = document.getElementById('container-alur');
            const currentCount = container.querySelectorAll('.alur-row').length + 1;
            const row = document.createElement('div');
            row.className = 'alur-row border border-gray-100 bg-gray-50/50 p-4 rounded-xl flex items-start gap-3 relative mt-4';
            row.innerHTML = `
                <div class="w-6 h-6 rounded-full bg-white border border-gray-200 text-gray-500 flex items-center justify-center text-[10px] font-bold shrink-0 alur-number">${currentCount}</div>
                <div class="flex-1 grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[10px] font-semibold text-gray-500 mb-1">Judul Langkah</label>
                        <input type="text" name="alur_judul[]" placeholder="Contoh: Proses di Kecamatan" class="alur-judul w-full px-3 py-2 border border-gray-300 rounded-xl text-xs focus:outline-none focus:border-[#2F855A]">
                    </div>
                    <div>
                        <label class="block text-[10px] font-semibold text-gray-500 mb-1">Deskripsi Langkah</label>
                        <textarea name="alur_deskripsi[]" rows="3" placeholder="Contoh: Bawa berkas ke loket..." class="alur-desc w-full px-3 py-2 border border-gray-300 rounded-xl text-xs focus:outline-none focus:border-[#2F855A] resize-none"></textarea>
                    </div>
                </div>
                <button type="button" onclick="removeRow(this, true)" class="w-8 h-8 flex items-center justify-center border border-[#FDA29B] bg-[rgba(253,162,155,0.20)] text-[#D92D20] rounded-lg hover:bg-[rgba(253,162,155,0.30)] shrink-0 mt-4 md:mt-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash w-4 h-4"><path d="M10 11v6"/><path d="M14 11v6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/><path d="M3 6h18"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                </button>`;
            container.appendChild(row);
        }

        function removeRow(btn, isAlur = false) {
            btn.parentElement.remove();
            if (isAlur) {
                updateAlurNumbers();
            }
        }

        function updateAlurNumbers() {
            document.querySelectorAll('.alur-number').forEach((el, index) => {
                el.innerText = index + 1;
            });
        }

        function validateAndSave() {
            const nama = document.getElementById('inputNamaLayanan').value.trim();
            const kategori = document.getElementById('inputKategori').value.trim();

            if (nama === '' || kategori === '') {
                showValidationError('Nama layanan dan kategori wajib diisi.');
                return false;
            }

            const alurRows = document.querySelectorAll('.alur-row');
            for (const row of alurRows) {
                const judul = row.querySelector('.alur-judul')?.value.trim() || '';
                const deskripsi = row.querySelector('.alur-desc')?.value.trim() || '';

                if ((judul === '') !== (deskripsi === '')) {
                    showValidationError('Setiap langkah harus memiliki judul dan deskripsi.');
                    return false;
                }
            }

            openModal('saveModal');
            return false;
        }

        function showValidationError(message) {
            document.getElementById('errorMessage').innerText = message;
            openModal('errorModal');
        }

        function openModal(modalId) {
            const modal = document.getElementById(modalId);
            if (!modal) return;
            modal.classList.remove('hidden');
            setTimeout(() => {
                modal.classList.remove('opacity-0');
                modal.children[0].classList.remove('scale-95');
            }, 10);
        }

        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            if (!modal) return;
            modal.classList.add('opacity-0');
            modal.children[0].classList.add('scale-95');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        }

        function confirmAction(modalId) {
            if (modalId === 'saveModal') {
                closeModal(modalId);
                document.getElementById('layananForm').submit();
                return;
            }

            closeModal(modalId);
        }

        function openDeleteModal(id, nama) {
            document.getElementById('deleteLayananId').value = id;
            document.getElementById('deleteMessage').innerHTML = `Hapus layanan <strong>${escapeHtml(nama)}</strong>?<br>Data persyaratan dan alurnya juga akan ikut dihapus.`;
            openModal('deleteModal');
        }

        function escapeHtml(value) {
            const div = document.createElement('div');
            div.textContent = value;
            return div.innerHTML;
        }

        function toggleAccordion(contentId, iconId) {
            const content = document.getElementById(contentId);
            const icon = document.getElementById(iconId);

            if (!content || !icon) return;

            const isHidden = content.classList.contains('hidden');

            if (isHidden) {
                content.classList.remove('hidden');
                icon.classList.add('rotate-180');
            } else {
                content.classList.add('hidden');
                icon.classList.remove('rotate-180');
            }
        }

        function toggleSidebar() {
            const sidebar = document.getElementById('admin-sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }

        function updateDateTime() {
            const now = new Date();
            const optionsDate = { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' };
            const optionsTime = { hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false };

            document.getElementById('current-date').innerText = now.toLocaleDateString('id-ID', optionsDate);
            document.getElementById('current-time').innerText = now.toLocaleTimeString('id-ID', optionsTime) + ' WIB';
        }

        function hideLayananToast() {
            const toast = document.getElementById('layananToast');

            if (!toast) {
                return;
            }

            toast.classList.add('opacity-0', 'translate-y-2');

            setTimeout(() => {
                toast.remove();
            }, 300);
        }

        function initLayananToast() {
            const toast = document.getElementById('layananToast');

            if (!toast) {
                return;
            }

            setTimeout(hideLayananToast, 3000);
        }

        initLayananToast();
        updateDateTime();
        setInterval(updateDateTime, 1000);
    </script>
</body>
</html>
