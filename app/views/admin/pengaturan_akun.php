<?php
$base_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http')
    . '://' . $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
$flash = $admin_flash ?? null;
$admin = $admin_account ?? [];
$csrf = $csrf_token ?? '';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan Akun Saya - Desa Padangan</title>
    <link rel="icon" type="image/png" href="<?= $base_url; ?>/assets/images/logo.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>body{font-family:'Inter',sans-serif}</style>
</head>
<body class="relative min-h-screen flex items-center justify-center bg-cover bg-center bg-no-repeat px-4 py-8" style="background-image:url('<?= $base_url; ?>/assets/images/Hero.png');">
<div class="absolute inset-0 bg-black/60"></div>
<main class="relative z-10 w-full max-w-lg">
    <div class="bg-white rounded-2xl shadow-2xl p-8 md:p-10">
        <div class="text-center mb-6">
            <img src="<?= $base_url; ?>/assets/images/logo.png" alt="Logo Desa Padangan" class="w-12 h-12 mx-auto mb-3">
            <h1 class="text-sm font-bold text-gray-800">Pemerintah Desa Padangan</h1>
            <p class="text-[11px] text-gray-500 mt-0.5">Manajemen Akun Administrator</p>
        </div>
        <hr class="border-gray-200 mb-6">
        <div class="text-center mb-8">
            <h2 class="text-[15px] font-bold text-gray-800">Pengaturan Akun Saya</h2>
            <p class="text-xs text-gray-500 mt-1">Perbarui username atau password akun Anda</p>
        </div>

        <?php if (!empty($flash['message'])): ?>
            <div class="mb-5 rounded-xl border px-4 py-3 text-xs font-semibold <?= ($flash['type'] ?? '') === 'success' ? 'border-emerald-200 bg-emerald-50 text-[#2F855A]' : 'border-red-200 bg-red-50 text-[#D92D20]'; ?>">
                <?= htmlspecialchars($flash['message'], ENT_QUOTES, 'UTF-8'); ?>
            </div>
        <?php endif; ?>

        <form action="<?= $base_url; ?>/index.php?url=admin/pengaturan-akun" method="POST" class="space-y-4">
            <input type="hidden" name="_csrf" value="<?= htmlspecialchars($csrf, ENT_QUOTES, 'UTF-8'); ?>">

            <div>
                <label class="mb-2 block text-xs font-semibold text-[#172033]">Username Baru</label>
                <input type="text" name="username" required maxlength="100" value="<?= htmlspecialchars($admin['username'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm text-gray-700 outline-none focus:border-[#2F855A] focus:ring-1 focus:ring-[#2F855A]">
            </div>

            <div class="rounded-xl border border-gray-200 bg-[#F7F9FC] p-4">
                <p class="text-xs font-semibold text-[#172033] mb-3">Ubah Password</p>

                <label class="mb-2 block text-xs font-semibold text-[#172033]">Password Saat Ini</label>
                <div class="relative mb-4">
                    <input id="current-password" type="password" name="current_password" autocomplete="current-password"
                        class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 pr-11 text-sm text-gray-700 outline-none focus:border-[#2F855A] focus:ring-1 focus:ring-[#2F855A]" placeholder="Isi jika ingin mengganti password">
                    <button type="button" onclick="togglePassword('current-password','current-password-eye')" class="absolute inset-y-0 right-0 flex items-center pr-3.5 text-gray-400 hover:text-[#2F855A]" aria-label="Tampilkan password saat ini">
                        <svg id="current-password-eye" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/><circle cx="12" cy="12" r="3"/></svg>
                    </button>
                </div>

                <label class="mb-2 block text-xs font-semibold text-[#172033]">Password Baru</label>
                <div class="relative mb-4">
                    <input id="settings-password" type="password" name="password" minlength="8" maxlength="255" autocomplete="new-password"
                        class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 pr-11 text-sm text-gray-700 outline-none focus:border-[#2F855A] focus:ring-1 focus:ring-[#2F855A]" placeholder="Minimal 8 karakter">
                    <button type="button" onclick="togglePassword('settings-password','settings-password-eye')" class="absolute inset-y-0 right-0 flex items-center pr-3.5 text-gray-400 hover:text-[#2F855A]">
                        <svg id="settings-password-eye" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/><circle cx="12" cy="12" r="3"/></svg>
                    </button>
                </div>

                <label class="mb-2 block text-xs font-semibold text-[#172033]">Konfirmasi Password Baru</label>
                <div class="relative">
                    <input id="settings-password-confirm" type="password" name="password_confirmation" minlength="8" maxlength="255" autocomplete="new-password"
                        class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 pr-11 text-sm text-gray-700 outline-none focus:border-[#2F855A] focus:ring-1 focus:ring-[#2F855A]" placeholder="Ulangi password baru">
                    <button type="button" onclick="togglePassword('settings-password-confirm','settings-password-confirm-eye')" class="absolute inset-y-0 right-0 flex items-center pr-3.5 text-gray-400 hover:text-[#2F855A]" aria-label="Tampilkan konfirmasi password baru">
                        <svg id="settings-password-confirm-eye" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/><circle cx="12" cy="12" r="3"/></svg>
                    </button>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-3 pt-2">
                <a href="<?= $base_url; ?>/index.php?url=admin/dashboard" class="text-center rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-semibold text-gray-700 hover:bg-gray-50">Kembali</a>
                <button type="submit" class="rounded-lg bg-[#2F855A] px-4 py-2.5 text-sm font-semibold text-white hover:bg-[#246946]">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</main>

<script>
function togglePassword(fieldId, iconId) {
    const input = document.getElementById(fieldId);
    const icon = document.getElementById(iconId);
    if (!input) return;
    if (input.type === 'password') {
        input.type = 'text';
        if (icon) icon.innerHTML = '<path d="M3 3l18 18"/><path d="M10.6 10.6a2 2 0 0 0 2.8 2.8"/><path d="M9.9 5.1A10.6 10.6 0 0 1 12 5c5 0 9.3 3.2 10.5 7a10.7 10.7 0 0 1-4.1 5.2"/><path d="M6.6 6.6C4.8 7.8 3.5 9.4 1.5 12c1.6 3.5 5.3 7 10.5 7 1.3 0 2.5-.2 3.6-.6"/>';
    } else {
        input.type = 'password';
        if (icon) icon.innerHTML = '<path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/><circle cx="12" cy="12" r="3"/>';
    }
}
</script>
</body>
</html>
