<?php
$daftarGaleri = $galeri ?? [];
$galeriFlash = $galeri_flash ?? null;
$currentPage = max(1, (int) ($galeri_current_page ?? 1));
$totalPages = max(1, (int) ($galeri_total_pages ?? 1));
$totalGaleri = max(0, (int) ($galeri_total ?? 0));

$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
    ? 'https'
    : 'http';

$baseUrl = $protocol . '://' . $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
$baseGaleriUrl = $baseUrl . '/index.php?url=admin/galeri';

function galeriAdminJson($value)
{
    return htmlspecialchars(
        json_encode($value, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
        ENT_QUOTES,
        'UTF-8'
    );
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Galeri - Administrator Desa Padangan</title>
    <link rel="icon" type="image/png" href="<?= htmlspecialchars($baseUrl . '/assets/images/logo.png', ENT_QUOTES, 'UTF-8'); ?>">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>
<body class="bg-[#F4F6F9] flex h-screen overflow-hidden" onclick="closeAllDropdowns(event)">

    <?php include '../app/views/components/admin/admin_sidebar.php'; ?>

    <main class="flex-1 flex flex-col h-screen overflow-y-auto md:ml-64 transition-all relative">
        <header class="bg-white border-b border-gray-200 px-4 md:px-8 py-4 flex justify-between items-center sticky top-0 z-30 shadow-xs">
            <div class="flex items-center gap-3">
                <button onclick="toggleSidebar()" class="md:hidden text-gray-700 hover:text-[#2F855A] focus:outline-none p-1 rounded-lg border border-gray-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
                <div>
                    <h1 class="text-base md:text-xl font-extrabold text-[#172033]">Manajemen Galeri Desa</h1>
                    <p class="text-[11px] md:text-xs text-gray-500">Kelola galeri dokumentasi kegiatan Desa Padangan.</p>
                </div>
            </div>
            <div class="text-right">
                <p id="current-date" class="text-xs font-bold text-gray-700">Memuat tanggal...</p>
                <p id="current-time" class="text-[10px] md:text-[11px] text-gray-400 mt-0.5">--:--:-- WIB</p>
            </div>
        </header>

        <?php if (!empty($galeriFlash['message'])): ?>
            <?php $flashIsError = ($galeriFlash['type'] ?? '') === 'error'; ?>
            <div
                id="galeriToast"
                role="status"
                aria-live="polite"
                class="fixed top-5 left-1/2 -translate-x-1/2 z-[70] w-[calc(100%-2rem)] max-w-sm rounded-2xl border px-4 py-3 text-xs font-semibold shadow-lg transition-all duration-300 <?= $flashIsError ? 'border-red-200 bg-red-50 text-red-600' : 'border-emerald-200 bg-emerald-50 text-[#2F855A]'; ?>"
            >
                <?= htmlspecialchars($galeriFlash['message'], ENT_QUOTES, 'UTF-8'); ?>
            </div>
        <?php endif; ?>

        <div class="p-4 md:p-8 space-y-6 max-w-7xl w-full mx-auto pb-20">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-4 md:gap-6" id="galleryGrid">

                <?php if ($currentPage === 1): ?>
                    <button
                        type="button"
                        onclick="openModal('addModal')"
                        class="bg-white border-2 border-dashed border-emerald-300 rounded-2xl flex flex-col items-center justify-center p-6 h-48 md:h-56 cursor-pointer hover:bg-emerald-50/50 transition-colors group"
                    >
                        <div class="w-12 h-12 rounded-full bg-emerald-50 text-[#2F855A] flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                        </div>
                        <h4 class="text-xs font-bold text-gray-800">Tambahkan Foto Baru</h4>
                        <p class="text-[10px] text-gray-400 mt-1 text-center">Unggah foto dokumentasi<br>kegiatan desa</p>
                    </button>
                <?php endif; ?>

                <?php foreach ($daftarGaleri as $item): ?>
                    <?php
                    $id = (int) ($item['id'] ?? 0);
                    $judul = (string) ($item['judul'] ?? '');
                    $foto = basename((string) ($item['foto'] ?? ''));
                    $fotoUrl = $baseUrl . '/uploads/galeri/' . rawurlencode($foto);
                    ?>

                    <div class="relative rounded-2xl overflow-hidden group h-48 md:h-56 shadow-sm border border-gray-200">
                        <img
                            src="<?= htmlspecialchars($fotoUrl, ENT_QUOTES, 'UTF-8'); ?>"
                            alt="<?= htmlspecialchars($judul, ENT_QUOTES, 'UTF-8'); ?>"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                        >
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>

                        <div class="absolute bottom-4 left-4 right-4">
                            <h4 class="text-white text-xs md:text-sm font-bold truncate">
                                <?= htmlspecialchars($judul, ENT_QUOTES, 'UTF-8'); ?>
                            </h4>
                        </div>

                        <div class="absolute top-3 right-3">
                            <button
                                id="btn-dots-<?= $id; ?>"
                                type="button"
                                onclick="toggleDropdown(event, 'dropdown-<?= $id; ?>', 'btn-dots-<?= $id; ?>')"
                                class="btn-dots w-9 h-9 flex items-center justify-center text-gray-400 hover:text-gray-800 border border-gray-200 rounded-lg transition-colors focus:outline-none bg-white"
                                aria-label="Opsi foto"
                            >
                                ⋮
                            </button>

                            <div
                                id="dropdown-<?= $id; ?>"
                                class="action-menu hidden absolute top-0 right-0 z-50 bg-white rounded-xl shadow-[0_5px_15px_rgba(0,0,0,0.12)] p-1.5 w-[110px] flex flex-col gap-1.5 border border-gray-100"
                            >
                                <button
                                    type="button"
                                    onclick='openEditModal(<?= $id; ?>, <?= galeriAdminJson($judul); ?>, <?= galeriAdminJson($fotoUrl); ?>)'
                                    class="w-full px-2 py-1.5 text-[11px] font-bold text-[#2F855A] bg-white border border-[#2F855A] rounded-lg hover:bg-green-50 flex items-center justify-center gap-1.5 transition-colors shadow-sm"
                                >
                                    <svg
                                        class="w-3.5 h-3.5"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5"></path>
                                        <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15H9v-3l9.5-9.5z"></path>
                                    </svg>
                                    Edit
                                </button>

                                <button
                                    type="button"
                                    onclick='openDeleteModal(<?= $id; ?>, <?= galeriAdminJson($judul); ?>)'
                                    class="w-full px-2 py-1.5 text-[11px] font-bold text-white bg-[#DC2626] hover:bg-red-700 rounded-lg flex items-center justify-center gap-1.5 transition-colors shadow-sm"
                                >
                                    <svg
                                        class="w-3.5 h-3.5"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7"></path>
                                        <path d="M10 11v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 01-1 1v3M4 7h16"></path>
                                    </svg>
                                    Hapus
                                </button>
                            </div>
                        </div>

                    </div>
                <?php endforeach; ?>

                <?php if ($totalGaleri === 0): ?>
                    <div class="bg-white border border-gray-200 rounded-2xl h-48 md:h-56 flex flex-col items-center justify-center p-6 text-center sm:col-span-2 md:col-span-3 xl:col-span-4">
                        <svg class="w-10 h-10 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                            <circle cx="8.5" cy="8.5" r="1.5"></circle>
                            <path d="M21 15l-5-5L5 21"></path>
                        </svg>
                        <p class="text-sm font-semibold text-gray-600">Belum ada foto galeri.</p>
                        <p class="text-xs text-gray-400 mt-1">Gunakan tombol Tambahkan Foto Baru untuk mengunggah dokumentasi.</p>
                    </div>
                <?php endif; ?>
            </div>

            <?php if ($totalPages >= 1): ?>
                <div class="pt-2 flex items-center justify-center gap-2">
                    <?php if ($currentPage > 1): ?>
                        <a
                            href="<?= htmlspecialchars($baseGaleriUrl . '&page=' . ($currentPage - 1), ENT_QUOTES, 'UTF-8'); ?>"
                            class="w-9 h-9 flex items-center justify-center border border-gray-200 rounded-xl text-[#2F855A] hover:bg-gray-50 transition-colors"
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
                            class="w-9 h-9 flex items-center justify-center border border-gray-200 rounded-xl text-gray-300 cursor-not-allowed"
                            aria-label="Tidak ada halaman sebelumnya"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-left w-5 h-5">
                                <path d="m15 18-6-6 6-6"/>
                            </svg>
                        </button>
                    <?php endif; ?>

                    <?php for ($page = 1; $page <= $totalPages; $page++): ?>
                        <?php if ($page === $currentPage): ?>
                            <span class="w-9 h-9 flex items-center justify-center rounded-xl bg-[#2F855A] text-white font-semibold shadow-sm">
                                <?= $page; ?>
                            </span>
                        <?php else: ?>
                            <a
                                href="<?= htmlspecialchars($baseGaleriUrl . '&page=' . $page, ENT_QUOTES, 'UTF-8'); ?>"
                                class="w-9 h-9 flex items-center justify-center border border-gray-200 rounded-xl text-gray-700 hover:bg-gray-50 font-semibold transition-colors"
                            >
                                <?= $page; ?>
                            </a>
                        <?php endif; ?>
                    <?php endfor; ?>

                    <?php if ($currentPage < $totalPages): ?>
                        <a
                            href="<?= htmlspecialchars($baseGaleriUrl . '&page=' . ($currentPage + 1), ENT_QUOTES, 'UTF-8'); ?>"
                            class="w-9 h-9 flex items-center justify-center border border-gray-200 rounded-xl text-[#2F855A] hover:bg-gray-50 transition-colors"
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
                            class="w-9 h-9 flex items-center justify-center border border-gray-200 rounded-xl text-gray-300 cursor-not-allowed"
                            aria-label="Tidak ada halaman berikutnya"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right w-5 h-5">
                                <path d="m9 18 6-6-6-6"/>
                            </svg>
                        </button>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </main>

    <!-- Modal Tambah Foto -->
    <div id="addModal" class="fixed inset-0 bg-black/60 z-40 flex items-center justify-center p-4 hidden opacity-0 transition-opacity duration-300">
        <div class="bg-white rounded-3xl shadow-2xl max-w-lg w-full p-6 md:p-8 transform scale-95 transition-transform duration-300 relative">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-extrabold text-[#172033]">Tambah Foto Galeri</h3>
                <button type="button" onclick="closeModal('addModal')" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <form id="addForm" action="<?= htmlspecialchars($baseGaleriUrl, ENT_QUOTES, 'UTF-8'); ?>" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="action" value="store">
                <input type="hidden" name="page" value="1">

                <div class="space-y-5">
                    <label for="addInputFoto" class="border-2 border-dashed border-gray-300 rounded-2xl flex flex-col items-center justify-center py-6 px-6 bg-gray-50 cursor-pointer hover:bg-gray-100 transition-colors overflow-hidden">
                        <input type="file" id="addInputFoto" name="foto" class="hidden" accept=".jpg,.jpeg,.png,image/jpeg,image/png">
                        <div id="addUploadPlaceholder" class="flex flex-col items-center justify-center">
                            <div class="w-12 h-12 rounded-full bg-white flex items-center justify-center text-gray-400 mb-3 shadow-xs">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0118.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <p class="text-xs font-semibold text-gray-700">Upload Foto</p>
                            <p id="addFileName" class="text-[10px] text-gray-400 mt-1 text-center">PNG, JPG atau JPEG - Maks. 5 MB</p>
                        </div>
                        <!-- Preview state -->
                        <div id="addImagePreview" class="hidden w-full flex-col items-center justify-center">
                            <div class="relative w-full h-52 rounded-xl overflow-hidden bg-gray-100">
                                <img id="addPreviewImage" src="" alt="Preview foto" class="w-full h-full object-cover">
                            </div>

                            <p id="addPreviewFileName" class="text-[10px] text-gray-500 mt-3 text-center truncate max-w-full px-2"></p>
                            <p class="text-[10px] text-[#2F855A] mt-1 font-semibold"> Klik untuk mengganti foto</p>
                        </div>
                    </label>

                    <div>
                        <label class="block text-[11px] font-semibold text-gray-700 mb-1.5" for="addInputJudul">Judul Kegiatan</label>
                        <input type="text" id="addInputJudul" name="judul" maxlength="255" required placeholder="Contoh: Kegiatan Musyawarah Desa" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-xs focus:outline-none focus:border-[#2F855A]">
                    </div>
                </div>
            </form>

            <div class="flex items-center justify-end gap-3 mt-8">
                <button type="button" onclick="closeModal('addModal')" class="px-5 py-2.5 rounded-xl border border-red-200 text-red-500 font-semibold text-xs hover:bg-red-50 transition-colors">Batal</button>
                <button type="button" onclick="validateAdd()" class="px-5 py-2.5 rounded-xl bg-[#2F855A] text-white font-semibold text-xs hover:bg-[#246946] shadow-sm transition-colors">Simpan</button>
            </div>
        </div>
    </div>

    <!-- Modal Edit Foto -->
    <div id="editModal" class="fixed inset-0 bg-black/60 z-40 flex items-center justify-center p-4 hidden opacity-0 transition-opacity duration-300">
        <div class="bg-white rounded-3xl shadow-2xl max-w-lg w-full p-6 md:p-8 transform scale-95 transition-transform duration-300 relative">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-extrabold text-[#172033]">Edit Foto Galeri</h3>
                <button type="button" onclick="closeModal('editModal')" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <form id="editForm" action="<?= htmlspecialchars($baseGaleriUrl, ENT_QUOTES, 'UTF-8'); ?>" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="action" value="update">
                <input type="hidden" name="id" id="editInputId" value="">
                <input type="hidden" name="page" id="editInputPage" value="<?= $currentPage; ?>">

                <div class="space-y-5">
                    <label for="editInputFoto" class="relative block w-full h-48 rounded-2xl overflow-hidden border border-gray-200 group cursor-pointer">
                        <img id="editImagePreview" src="" alt="Preview" class="w-full h-full object-cover group-hover:brightness-75 transition-all">
                        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                            <div class="bg-white/90 p-2 rounded-full text-gray-700 shadow-sm">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <input type="file" id="editInputFoto" name="foto" class="hidden" accept=".jpg,.jpeg,.png,image/jpeg,image/png">
                    </label>
                    <p id="editFileName" class="text-[10px] text-gray-400 -mt-3">Klik foto untuk mengganti gambar. Maks. 5 MB.</p>

                    <div>
                        <label class="block text-[11px] font-semibold text-gray-700 mb-1.5" for="editInputJudul">Judul Kegiatan</label>
                        <input type="text" id="editInputJudul" name="judul" maxlength="255" required class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-xs focus:outline-none focus:border-[#2F855A]">
                    </div>
                </div>
            </form>

            <div class="flex items-center justify-end gap-3 mt-8">
                <button type="button" onclick="closeModal('editModal')" class="px-5 py-2.5 rounded-xl border border-red-200 text-red-500 font-semibold text-xs hover:bg-red-50 transition-colors">Batal</button>
                <button type="button" onclick="validateEdit()" class="px-5 py-2.5 rounded-xl bg-[#2F855A] text-white font-semibold text-xs hover:bg-[#246946] shadow-sm transition-colors">Simpan</button>
            </div>
        </div>
    </div>

    <!-- Modal Hapus Konfirmasi -->
    <div id="deleteModal" class="fixed inset-0 bg-black/60 z-50 flex items-center justify-center p-4 hidden opacity-0 transition-opacity duration-300">
        <div class="bg-white rounded-3xl shadow-2xl max-w-sm w-full p-6 text-center transform scale-95 transition-transform duration-300">
            <div class="w-16 h-16 rounded-full bg-red-50 flex items-center justify-center mx-auto mb-4 text-red-500 border border-red-100">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                </svg>
            </div>
            <h3 class="text-lg font-extrabold text-[#172033] mb-2">Hapus Foto?</h3>
            <p id="deleteMessage" class="text-xs text-gray-500 mb-6">Apakah Anda yakin ingin menghapus Foto ini?<br>Foto yang dihapus tidak dapat dikembalikan.</p>

            <form action="<?= htmlspecialchars($baseGaleriUrl, ENT_QUOTES, 'UTF-8'); ?>" method="POST" class="flex items-center justify-center gap-3">
                <input type="hidden" name="action" value="delete">
                <input type="hidden" name="id" id="deleteInputId" value="">
                <input type="hidden" name="page" id="deleteInputPage" value="<?= $currentPage; ?>">
                <button type="button" onclick="closeModal('deleteModal')" class="flex-1 py-2.5 rounded-xl border border-red-200 text-red-600 font-semibold text-xs hover:bg-red-50">Batal</button>
                <button type="submit" class="flex-1 py-2.5 rounded-xl bg-red-600 text-white font-semibold text-xs hover:bg-red-700">Hapus</button>
            </form>
        </div>
    </div>

    <!-- Modal Data Belum Lengkap -->
    <div id="errorModal" class="fixed inset-0 bg-black/40 z-[60] flex items-center justify-center p-4 hidden opacity-0 transition-opacity duration-300">
        <div class="bg-white rounded-3xl shadow-2xl max-w-sm w-full p-6 text-center transform scale-95 transition-transform duration-300 relative">
            <button type="button" onclick="closeModal('errorModal')" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
            <div class="w-16 h-16 rounded-full bg-red-50 flex items-center justify-center mx-auto mb-4 text-red-500 border border-red-100">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0z"></path>
                </svg>
            </div>
            <h3 class="text-lg font-extrabold text-[#172033] mb-2">Data Belum Lengkap</h3>
            <p id="errorMessage" class="text-xs text-gray-500 mb-2">Silakan lengkapi seluruh data sebelum menyimpan foto.</p>
            <button type="button" onclick="closeModal('errorModal')" class="mt-4 w-full py-2.5 rounded-xl bg-[#2F855A] text-white text-xs font-semibold">OK</button>
        </div>
    </div>

    <!-- Modal Konfirmasi Simpan Tambah -->
    <div id="confirmSaveModal" class="fixed inset-0 bg-black/40 z-[60] flex items-center justify-center p-4 hidden opacity-0 transition-opacity duration-300">
        <div class="bg-white rounded-3xl shadow-2xl max-w-sm w-full p-6 text-center transform scale-95 transition-transform duration-300">
            <div class="w-16 h-16 rounded-full bg-emerald-50 flex items-center justify-center mx-auto mb-4 text-[#2F855A] border border-emerald-100">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <h3 class="text-lg font-extrabold text-[#172033] mb-2">Simpan Foto?</h3>
            <p class="text-xs text-gray-500 mb-6">Apakah Anda yakin ingin menyimpan Foto ini?<br>Foto yang disimpan akan ditampilkan pada halaman galeri.</p>
            <div class="flex items-center justify-center gap-3">
                <button type="button" onclick="closeModal('confirmSaveModal')" class="flex-1 py-2.5 rounded-xl border border-red-200 text-red-600 font-semibold text-xs hover:bg-red-50">Batal</button>
                <button type="button" onclick="executeSave('addForm', 'confirmSaveModal')" class="flex-1 py-2.5 rounded-xl bg-[#2F855A] text-white font-semibold text-xs hover:bg-[#246946]">Simpan</button>
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi Simpan Perubahan Edit -->
    <div id="confirmEditModal" class="fixed inset-0 bg-black/40 z-[60] flex items-center justify-center p-4 hidden opacity-0 transition-opacity duration-300">
        <div class="bg-white rounded-3xl shadow-2xl max-w-sm w-full p-6 text-center transform scale-95 transition-transform duration-300">
            <div class="w-16 h-16 rounded-full bg-emerald-50 flex items-center justify-center mx-auto mb-4 text-[#2F855A] border border-emerald-100">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <h3 class="text-lg font-extrabold text-[#172033] mb-2">Simpan Perubahan?</h3>
            <p class="text-xs text-gray-500 mb-6">Apakah Anda yakin ingin merubah Foto ini?<br>Perubahan akan ditampilkan pada halaman galeri.</p>
            <div class="flex items-center justify-center gap-3">
                <button type="button" onclick="closeModal('confirmEditModal')" class="flex-1 py-2.5 rounded-xl border border-red-200 text-red-600 font-semibold text-xs hover:bg-red-50">Batal</button>
                <button type="button" onclick="executeSave('editForm', 'confirmEditModal')" class="flex-1 py-2.5 rounded-xl bg-[#2F855A] text-white font-semibold text-xs hover:bg-[#246946]">Simpan</button>
            </div>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('admin-sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            if (sidebar) sidebar.classList.toggle('-translate-x-full');
            if (overlay) overlay.classList.toggle('hidden');
        }

        function updateDateTime() {
            const now = new Date();
            const optionsDate = { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' };
            const optionsTime = { hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false };
            document.getElementById('current-date').innerText = now.toLocaleDateString('id-ID', optionsDate);
            document.getElementById('current-time').innerText = now.toLocaleTimeString('id-ID', optionsTime) + ' WIB';
        }

        function toggleDropdown(event, dropdownId, buttonId) {
            event.stopPropagation();

            closeAllDropdowns();

            const dropdown = document.getElementById(dropdownId);
            const button = document.getElementById(buttonId);

            if (dropdown && button) {
                dropdown.classList.remove('hidden');
                button.classList.add('opacity-0');
            }
        }

        function closeAllDropdowns() {
            document.querySelectorAll('.action-menu').forEach((menu) => {
                menu.classList.add('hidden');
            });

            document.querySelectorAll('.btn-dots').forEach((button) => {
                button.classList.remove('opacity-0');
            });
        }

        function openModal(modalId) {
            closeAllDropdowns();
            const modal = document.getElementById(modalId);
            if (!modal) return;

            modal.classList.remove('hidden');
            setTimeout(() => {
                modal.classList.remove('opacity-0');
                if (modal.children[0]) {
                    modal.children[0].classList.remove('scale-95');
                }
            }, 10);
        }

        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            if (!modal) return;

            modal.classList.add('opacity-0');
            if (modal.children[0]) {
                modal.children[0].classList.add('scale-95');
            }

            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        }

        function openEditModal(id, judul, imgSrc) {
            closeAllDropdowns();
            document.getElementById('editInputId').value = id;
            document.getElementById('editInputPage').value = <?= $currentPage; ?>;
            document.getElementById('editInputJudul').value = judul;
            document.getElementById('editImagePreview').src = imgSrc;
            document.getElementById('editInputFoto').value = '';
            document.getElementById('editFileName').innerText = 'Klik foto untuk mengganti gambar. Maks. 5 MB.';
            openModal('editModal');
        }

        function openDeleteModal(id, judul) {
            closeAllDropdowns();
            document.getElementById('deleteInputId').value = id;
            document.getElementById('deleteInputPage').value = <?= $currentPage; ?>;
            document.getElementById('deleteMessage').innerHTML = `Apakah Anda yakin ingin menghapus <strong>${escapeHtml(judul)}</strong>?<br>Foto yang dihapus tidak dapat dikembalikan.`;
            openModal('deleteModal');
        }

        function escapeHtml(value) {
            const div = document.createElement('div');
            div.textContent = value;
            return div.innerHTML;
        }

        function showValidationError(message) {
            document.getElementById('errorMessage').innerText = message;
            openModal('errorModal');
        }

        function validateClientFile(file) {
            if (!file) {
                return 'File foto wajib dipilih.';
            }

            const allowedTypes = ['image/jpeg', 'image/png'];
            if (!allowedTypes.includes(file.type)) {
                return 'Format file hanya JPG, JPEG, atau PNG.';
            }

            if (file.size > 5 * 1024 * 1024) {
                return 'Ukuran file maksimal 5 MB.';
            }

            return '';
        }

        let addPreviewObjectUrl = null;

function initAddImagePreview() {
    const input = document.getElementById('addInputFoto');

    if (!input) return;

    input.addEventListener('change', function () {
        const file = this.files[0];

        if (!file) {
            resetAddImagePreview();
            return;
        }

        const fileError = validateClientFile(file);

        if (fileError) {
            resetAddImagePreview();
            return;
        }

        const previewImage =
            document.getElementById('addPreviewImage');

        const previewContainer =
            document.getElementById('addImagePreview');

        const placeholder =
            document.getElementById('addUploadPlaceholder');

        const fileName =
            document.getElementById('addPreviewFileName');

        if (!previewImage || !previewContainer || !placeholder) {
            return;
        }

        if (addPreviewObjectUrl) {
            URL.revokeObjectURL(addPreviewObjectUrl);
        }

        addPreviewObjectUrl =
            URL.createObjectURL(file);

        previewImage.src =
            addPreviewObjectUrl;

        fileName.textContent =
            file.name;

        placeholder.classList.add('hidden');

        previewContainer.classList.remove('hidden');
        previewContainer.classList.add('flex');
    });
}

        function resetAddImagePreview() {
            const input =document.getElementById('addInputFoto');
            const previewImage = document.getElementById('addPreviewImage');
            const previewContainer = document.getElementById('addImagePreview');
            const placeholder = document.getElementById('addUploadPlaceholder');
            const fileName = document.getElementById('addPreviewFileName');

            if (addPreviewObjectUrl) {
                URL.revokeObjectURL(addPreviewObjectUrl);
                addPreviewObjectUrl = null;
            }

            if (input) {
                input.value = '';
            }

            if (previewImage) {
                previewImage.src = '';
            }

            if (fileName) {
                fileName.textContent = '';
            }

            if (previewContainer) {
                previewContainer.classList.add('hidden');
                previewContainer.classList.remove('flex');
            }

            if (placeholder) {
                placeholder.classList.remove('hidden');
            }
        }

        initAddImagePreview();

        function validateAdd() {
            const judul = document.getElementById('addInputJudul').value.trim();
            const file = document.getElementById('addInputFoto').files[0];

            if (judul === '') {
                showValidationError('Judul kegiatan wajib diisi.');
                return;
            }

            const fileError = validateClientFile(file);
            if (fileError) {
                showValidationError(fileError);
                return;
            }

            openModal('confirmSaveModal');
        }

        function validateEdit() {
            const judul = document.getElementById('editInputJudul').value.trim();
            const file = document.getElementById('editInputFoto').files[0];

            if (judul === '') {
                showValidationError('Judul kegiatan wajib diisi.');
                return;
            }

            if (file) {
                const fileError = validateClientFile(file);
                if (fileError) {
                    showValidationError(fileError);
                    return;
                }
            }

            openModal('confirmEditModal');
        }

        function executeSave(formId, confirmationModalId) {
            closeModal(confirmationModalId);
            setTimeout(() => {
                const form = document.getElementById(formId);
                if (form) form.submit();
            }, 300);
        }

        function hideGaleriToast() {
            const toast = document.getElementById('galeriToast');
            if (!toast) return;

            toast.classList.add('opacity-0', 'translate-y-2');
            setTimeout(() => toast.remove(), 300);
        }

        function initGaleriToast() {
            if (!document.getElementById('galeriToast')) return;
            setTimeout(hideGaleriToast, 3000);
        }

        document.getElementById('addInputFoto')?.addEventListener('change', function () {
            const file = this.files[0];
            const label = document.getElementById('addFileName');
            label.innerText = file ? file.name : 'PNG, JPG atau JPEG - Maks. 5 MB';
        });

        document.getElementById('editInputFoto')?.addEventListener('change', function () {
            const file = this.files[0];
            const label = document.getElementById('editFileName');
            const preview = document.getElementById('editImagePreview');

            if (!file) {
                label.innerText = 'Klik foto untuk mengganti gambar. Maks. 5 MB.';
                return;
            }

            label.innerText = file.name;
            preview.src = URL.createObjectURL(file);
        });

        updateDateTime();
        setInterval(updateDateTime, 1000);
        initGaleriToast();
    </script>
</body>
</html>
