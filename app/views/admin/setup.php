<?php
$setupEnabled = !empty($setup_enabled);
$setupKeyConfigured = !empty($setup_key_configured);
$setupCompleted = !empty($setup_completed);
$base_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http')
    . '://' . $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
$csrf = $csrf_token ?? '';
$error = $setup_error ?? '';
$allowed = !empty($setup_allowed);
$schemaReady = !empty($schema_ready);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setup Administrator - Desa Padangan</title>
    <link rel="icon" type="image/png" href="<?= $base_url; ?>/assets/images/logo.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>body{font-family:'Inter',sans-serif}</style>
</head>
<body class="relative min-h-screen flex items-center justify-center bg-cover bg-center bg-no-repeat px-4 py-8" style="background-image:url('<?= $base_url; ?>/assets/images/Hero.png');">
<div class="absolute inset-0 bg-black/60"></div>
<main class="relative z-10 w-full max-w-md">
    <div class="bg-white rounded-2xl shadow-2xl p-8 md:p-10">
        <div class="text-center mb-6">
            <img src="<?= $base_url; ?>/assets/images/logo.png" alt="Logo Desa Padangan" class="w-12 h-12 mx-auto mb-3">
            <h1 class="text-sm font-bold text-gray-800">Pemerintah Desa Padangan</h1>
            <p class="text-[11px] text-gray-500 mt-0.5">Setup Administrator</p>
        </div>
        <hr class="border-gray-200 mb-6">
        <div class="text-center mb-8">
            <h2 class="text-[15px] font-bold text-gray-800">Buat Akun Administrator Utama</h2>
            <p class="text-xs text-gray-500 mt-1">Wizard ini hanya dapat digunakan satu kali untuk instalasi ini.</p>
        </div>

        <?php if ($error !== ''): ?>
            <div class="mb-5 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-xs font-semibold text-[#D92D20]">
                <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?>
            </div>
        <?php endif; ?>

        <?php if (!$schemaReady): ?>
            <div class="rounded-xl border border-amber-200 bg-amber-50 px-4 py-3 text-xs font-semibold text-amber-800">
                Struktur database belum siap untuk setup administrator. Terapkan migrasi autentikasi terlebih dahulu melalui phpMyAdmin.
            </div>
        <?php elseif ($setupCompleted): ?>
            <div class="rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-xs font-semibold text-[#2F855A]">
                Setup administrator sudah selesai dan dikunci secara permanen untuk instalasi ini.
            </div>
        <?php elseif (!$setupEnabled): ?>
            <div class="rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-xs font-semibold text-gray-600">
                Wizard setup sedang dinonaktifkan oleh konfigurasi server.
            </div>
        <?php elseif (!$setupKeyConfigured): ?>
            <div class="rounded-xl border border-amber-200 bg-amber-50 px-4 py-3 text-xs font-semibold text-amber-800">
                Kunci setup belum dikonfigurasi. Operator server harus menyiapkan file konfigurasi privat sebelum akun pertama dapat dibuat.
            </div>
        <?php elseif (!$allowed): ?>
            <div class="rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-xs font-semibold text-gray-600">
                Wizard setup belum dapat digunakan pada kondisi instalasi saat ini.
            </div>
        <?php else: ?>
            <form action="<?= $base_url; ?>/index.php?url=admin/setup" method="POST" class="space-y-4">
                <input type="hidden" name="_csrf" value="<?= htmlspecialchars($csrf, ENT_QUOTES, 'UTF-8'); ?>">
                <div>
                    <label class="mb-2 block text-xs font-semibold text-[#172033]">Username</label>
                    <input type="text" name="username" required maxlength="100" autocomplete="username" class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm text-gray-700 outline-none focus:border-[#2F855A] focus:ring-1 focus:ring-[#2F855A]" placeholder="Masukkan username superadmin">
                </div>
                <div>
                    <label class="mb-2 block text-xs font-semibold text-[#172033]">Password</label>
                    <div class="relative">
                        <input id="setup-password" type="password" name="password" required minlength="8" maxlength="255" autocomplete="new-password" class="w-full rounded-lg border border-gray-300 px-4 py-2.5 pr-11 text-sm text-gray-700 outline-none focus:border-[#2F855A] focus:ring-1 focus:ring-[#2F855A]" placeholder="Minimal 8 karakter">
                        <button type="button" onclick="togglePassword('setup-password','setup-password-eye')" class="absolute inset-y-0 right-0 flex items-center pr-3.5 text-gray-400 hover:text-[#2F855A]"><svg id="setup-password-eye" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/><circle cx="12" cy="12" r="3"/></svg></button>
                    </div>
                </div>
                <div>
                    <label class="mb-2 block text-xs font-semibold text-[#172033]">Konfirmasi Password</label>
                    <div class="relative">
                        <input id="setup-password-confirm" type="password" name="password_confirmation" required minlength="8" maxlength="255" autocomplete="new-password" class="w-full rounded-lg border border-gray-300 px-4 py-2.5 pr-11 text-sm text-gray-700 outline-none focus:border-[#2F855A] focus:ring-1 focus:ring-[#2F855A]" placeholder="Ulangi password">
                        <button type="button" onclick="togglePassword('setup-password-confirm','setup-password-confirm-eye')" class="absolute inset-y-0 right-0 flex items-center pr-3.5 text-gray-400 hover:text-[#2F855A]"><svg id="setup-password-confirm-eye" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/><circle cx="12" cy="12" r="3"/></svg></button>
                    </div>
                </div>
                <div>
                    <label class="mb-2 block text-xs font-semibold text-[#172033]">Kunci Setup Rahasia</label>
                    <input type="password" name="setup_key" required autocomplete="off" class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm text-gray-700 outline-none focus:border-[#2F855A] focus:ring-1 focus:ring-[#2F855A]" placeholder="Masukkan kunci setup dari operator server">
                    <p class="text-[10px] text-gray-400 mt-1.5">Kunci tidak dikirim melalui URL dan tidak disimpan ke database sebagai plaintext.</p>
                </div>
                <button type="submit" class="w-full bg-[#2F855A] hover:bg-[#246946] text-white font-semibold py-2.5 rounded-lg transition-all duration-300 text-sm mt-4 shadow-md shadow-green-900/20">Buat Akun Superadmin</button>
            </form>
        <?php endif; ?>

        <div class="mt-8 flex justify-center items-center gap-2 text-gray-600 bg-gray-50 py-2 rounded-lg border border-gray-100">
            <span class="text-[11px] font-medium tracking-wide">Halaman setup khusus instalasi awal</span>
        </div>
    </div>
</main>
<script>
function togglePassword(fieldId, iconId) {
    const input = document.getElementById(fieldId), icon = document.getElementById(iconId);
    if (!input) return;
    if (input.type === 'password') { input.type = 'text'; if (icon) icon.style.opacity = '0.65'; }
    else { input.type = 'password'; if (icon) icon.style.opacity = '1'; }
}
</script>
</body>
</html>
