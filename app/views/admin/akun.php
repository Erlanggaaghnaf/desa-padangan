<?php
$base_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http')
    . '://' . $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
$accounts = $admin_accounts ?? [];
$flash = $admin_flash ?? null;
$currentAdminId = (int) ($_SESSION['admin_auth']['id'] ?? 0);
$csrf = $csrf_token ?? '';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Akun Administrator - Desa Padangan</title>
    <link rel="icon" type="image/png" href="<?= $base_url; ?>/assets/images/logo.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>body{font-family:'Inter',sans-serif}</style>
</head>
<body class="bg-[#F4F6F9] flex h-screen overflow-hidden">
<?php include '../app/views/components/admin/admin_sidebar.php'; ?>
<main class="flex-1 h-screen overflow-y-auto md:ml-64">
    <!-- Header dengan Waktu Realtime -->
    <header class="bg-white border-b border-gray-200 px-4 md:px-8 py-4 flex items-center justify-between sticky top-0 z-30 shadow-sm">
        <div>
            <h1 class="text-xl font-extrabold text-[#172033]">Manajemen Akun Administrator</h1>
            <p class="text-xs text-gray-500 mt-1">Kelola akun administrator dan hak aksesnya.</p>
        </div>
        <div class="text-right hidden sm:block">
            <p id="realtime-date" class="text-xs font-bold text-[#172033]"></p>
            <p id="realtime-clock" class="text-[11px] text-gray-500 mt-0.5"></p>
        </div>
    </header>

    <!-- Alert Kecil Melayang di Tengah Atas -->
    <?php if (!empty($flash['message'])): ?>
        <div id="flash-alert" class="fixed top-6 left-1/2 -translate-x-1/2 z-50 max-w-md w-11/12 md:w-auto rounded-xl border px-5 py-3 text-sm font-semibold shadow-lg transition-all duration-500 text-center <?= ($flash['type'] ?? '') === 'success' ? 'border-emerald-200 bg-emerald-50 text-[#2F855A]' : 'border-red-200 bg-red-50 text-[#D92D20]'; ?>">
            <?= htmlspecialchars($flash['message'], ENT_QUOTES, 'UTF-8'); ?>
        </div>
    <?php endif; ?>

    <div class="p-4 md:p-8 max-w-6xl mx-auto">
        <div class="flex items-center justify-between gap-4 mb-5">
            <div>
                <h2 class="text-base font-bold text-[#172033]">Daftar Administrator</h2>
                <p class="text-xs text-[#475467] mt-1">Password dan password hash tidak pernah ditampilkan.</p>
            </div>
            <a href="<?= $base_url; ?>/index.php?url=admin/tambah-admin" class="inline-flex items-center gap-2 rounded-xl bg-[#2F855A] px-4 py-2.5 text-sm font-semibold text-white hover:bg-[#276f4c] transition-colors">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14"/><path d="M5 12h14"/></svg>
                Tambah Admin
            </a>
        </div>

        <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">
            <div class="overflow-x-auto">
                <table class="min-w-full text-left">
                    <thead class="bg-[#F7F9FC] border-b border-gray-200">
                        <tr>
                            <th class="px-5 py-4 text-xs font-bold text-[#172033]">Username</th>
                            <th class="px-5 py-4 text-xs font-bold text-[#172033]">Role</th>
                            <th class="px-5 py-4 text-xs font-bold text-[#172033]">Dibuat</th>
                            <th class="px-5 py-4 text-xs font-bold text-[#172033]">Status</th>
                            <th class="px-5 py-4 text-xs font-bold text-[#172033]">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <?php foreach ($accounts as $account): ?>
                            <?php $isCurrent = (int) $account['id'] === $currentAdminId; ?>
                            <?php $role = (string) ($account['role'] ?? 'admin'); ?>
                            <tr class="hover:bg-gray-50/70">
                                <td class="px-5 py-4"><p class="text-sm font-semibold text-[#172033]"><?= htmlspecialchars($account['username'], ENT_QUOTES, 'UTF-8'); ?></p></td>
                                <td class="px-5 py-4">
                                    <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold <?= $role === 'superadmin' ? 'bg-emerald-50 text-[#2F855A]' : 'bg-gray-100 text-gray-600'; ?>">
                                        <?= $role === 'superadmin' ? 'Superadmin' : 'Administrator'; ?>
                                    </span>
                                </td>
                                <td class="px-5 py-4 text-sm text-[#475467]"><?= htmlspecialchars(date('d M Y', strtotime($account['created_at'])), ENT_QUOTES, 'UTF-8'); ?></td>
                                <td class="px-5 py-4">
                                    <?php if ($isCurrent): ?>
                                        <span class="inline-flex rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold text-[#2F855A]">Akun Anda</span>
                                    <?php else: ?>
                                        <span class="inline-flex rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-600">Terdaftar</span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-5 py-4">
                                    <div class="flex flex-wrap items-center gap-2">
                                        <?php if ($isCurrent): ?>
                                            <a href="<?= $base_url; ?>/index.php?url=admin/pengaturan-akun" class="inline-flex items-center gap-2 rounded-lg border border-gray-200 px-3 py-2 text-xs font-semibold text-[#2F855A] hover:bg-emerald-50 transition-colors">Pengaturan Akun</a>
                                        <?php else: ?>
                                            <button type="button" onclick='openDeleteAccountModal(<?= (int) $account['id']; ?>,<?= json_encode((string) $account['username'],JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT); ?> )' class="inline-flex items-center gap-2 rounded-lg border border-red-200 px-3 py-2 text-xs font-semibold text-[#D92D20] hover:bg-red-50 transition-colors">
                                                Hapus
                                            </button>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php if (!$accounts): ?>
                            <tr><td colspan="5" class="px-5 py-12 text-center"><p class="text-sm font-semibold text-[#172033]">Belum ada akun administrator.</p></td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<!-- Modal Hapus Akun -->
<div id="deleteAccountModal" class="fixed inset-0 bg-black/60 z-50 flex items-center justify-center p-4 hidden opacity-0 transition-opacity duration-300">
    <div class="bg-white rounded-3xl shadow-2xl max-w-sm w-full p-6 text-center transform scale-95 transition-transform duration-300">
        <form action="<?= $base_url; ?>/index.php?url=admin/hapus-admin" method="POST">
            <input
                type="hidden"
                name="_csrf"
                value="<?= htmlspecialchars($csrf, ENT_QUOTES, 'UTF-8'); ?>"
            >

            <input
                type="hidden"
                name="id"
                id="deleteAccountId"
                value=""
            >

            <div class="w-16 h-16 rounded-full bg-red-50 flex items-center justify-center mx-auto mb-4 text-red-500 border border-red-100">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.5"
                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 01-1 1v3M4 7h16"
                    ></path>
                </svg>
            </div>

            <h3 class="text-lg font-extrabold text-[#172033] mb-2">
                Hapus akun?
            </h3>

            <p class="text-xs text-gray-500 mb-6">
                Apakah Anda yakin ingin menghapus akun
                <strong id="deleteAccountUsername" class="text-[#172033]"></strong>?
                <br>
                Tindakan ini tidak dapat dibatalkan.
            </p>

            <div class="flex items-center justify-center gap-3">
                <button
                    type="button"
                    onclick="closeDeleteAccountModal()"
                    class="flex-1 py-2.5 rounded-xl border border-red-200 text-red-600 font-semibold text-xs hover:bg-red-50"
                >
                    Batal
                </button>

                <button
                    type="submit"
                    class="flex-1 py-2.5 rounded-xl bg-red-600 text-white font-semibold text-xs hover:bg-red-700"
                >
                    Hapus
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Skrip JavaScript untuk Waktu Real-time & Auto-hide Alert -->
<script>
    function openDeleteAccountModal(id, username) {
        const modal = document.getElementById('deleteAccountModal');
        const idInput = document.getElementById('deleteAccountId');
        const usernameEl = document.getElementById('deleteAccountUsername');

        if (!modal || !idInput || !usernameEl) {
            return;
        }

        idInput.value = id;
        usernameEl.textContent = username;

        modal.classList.remove('hidden');

        setTimeout(() => {
            modal.classList.remove('opacity-0');

            if (modal.children[0]) {
                modal.children[0].classList.remove('scale-95');
            }
        }, 10);
    }

    function closeDeleteAccountModal() {
        const modal = document.getElementById('deleteAccountModal');

        if (!modal) {
            return;
        }

        modal.classList.add('opacity-0');

        if (modal.children[0]) {
            modal.children[0].classList.add('scale-95');
        }

        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    }

    // Skrip untuk waktu real-time
    function updateRealtimeClock() {
        const now = new Date();
        const optionsDate = { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' };
        const dateString = now.toLocaleDateString('id-ID', optionsDate);
        const timeString = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' }) + ' WIB';

        const dateEl = document.getElementById('realtime-date');
        const clockEl = document.getElementById('realtime-clock');

        if (dateEl) dateEl.textContent = dateString;
        if (clockEl) clockEl.textContent = timeString;
    }

    setInterval(updateRealtimeClock, 1000);
    updateRealtimeClock();

    // Skrip untuk menghilangkan alert setelah 5 detik
    setTimeout(function() {
        const flashAlert = document.getElementById('flash-alert');
        if (flashAlert) {
            flashAlert.style.opacity = '0';
            setTimeout(function() {
                flashAlert.remove();
            }, 500);
        }
    }, 5000);
</script>
</body>
</html>