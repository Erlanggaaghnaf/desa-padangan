<?php
$base_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http')
    . '://' . $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
$title = $title ?? 'Akses Ditolak';
$message = $message ?? 'Anda tidak memiliki izin untuk membuka halaman ini.';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?> - Desa Padangan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>body{font-family:'Inter',sans-serif}</style>
</head>
<body class="min-h-screen bg-[#F4F6F9] flex items-center justify-center p-6">
    <div class="max-w-md w-full bg-white rounded-2xl border border-gray-200 shadow-sm p-8 text-center">
        <div class="w-14 h-14 rounded-full bg-red-50 text-[#D92D20] flex items-center justify-center mx-auto mb-4 text-2xl font-bold">!</div>
        <h1 class="text-xl font-extrabold text-[#172033]"><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?></h1>
        <p class="text-sm text-gray-500 mt-2 leading-relaxed"><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?></p>
        <a href="<?= $base_url; ?>/index.php?url=admin/dashboard" class="inline-flex mt-6 items-center justify-center rounded-lg bg-[#2F855A] px-5 py-2.5 text-sm font-semibold text-white hover:bg-[#246946]">Kembali ke Dashboard</a>
    </div>
</body>
</html>
