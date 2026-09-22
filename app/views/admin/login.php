<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Desa Padangan</title>
    <!-- Memanggil Favicon Logo Desa -->
    <link rel="icon" type="image/png" href="assets/images/logo.png">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="relative min-h-screen flex items-center justify-center bg-cover bg-center bg-no-repeat overflow-hidden" 
      style="background-image: url('assets/images/Hero.png');">
    
    <!-- Overlay Gelap Background -->
    <div class="absolute inset-0 bg-black/60 z-0"></div>

    <!-- KARTU LOGIN -->
    <div class="relative z-10 w-[90%] max-w-md bg-white rounded-2xl shadow-2xl p-8 md:p-10 transform transition-all">
        
        <!-- Header: Logo & Institusi -->
        <div class="text-center mb-6">
            <img src="assets/images/logo.png" alt="Logo Desa Padangan" class="w-12 h-12 mx-auto mb-3">
            <h1 class="text-sm font-bold text-gray-800 tracking-wide">Pemerintah Desa Padangan</h1>
            <p class="text-[11px] text-gray-500 mt-0.5">Kabupaten Tulungagung</p>
        </div>

        <!-- Garis Pemisah -->
        <hr class="border-gray-200 mb-6">

        <!-- Subtitle Dashboard -->
        <div class="text-center mb-8">
            <h2 class="text-[15px] font-bold text-gray-800 leading-snug">Dashboard Admin Website</h2>
            <h2 class="text-[15px] font-bold text-gray-800 leading-snug">Desa Padangan</h2>
            <p class="text-xs text-gray-500 mt-1">login Administrator</p>
        </div>

        <!-- Form Login -->
        <form action="index.php?url=AdminLogin" method="POST" class="space-y-4">
            
            <!-- Input Username -->
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                </div>
                <input type="text" name="username" placeholder="Username" required 
                       value="<?= isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>"
                       class="w-full pl-11 pr-4 py-2.5 border <?= !empty($data['error']) ? 'border-red-500' : 'border-gray-300'; ?> rounded-lg text-sm focus:outline-none focus:border-[#2F855A] focus:ring-1 focus:ring-[#2F855A] text-gray-700 placeholder-gray-400 transition-colors">
            </div>

            <!-- Input Password -->
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                </div>
                <input type="password" id="password" name="password" placeholder="Password" required 
                       class="w-full pl-11 pr-11 py-2.5 border <?= !empty($data['error']) ? 'border-red-500' : 'border-gray-300'; ?> rounded-lg text-sm focus:outline-none focus:border-[#2F855A] focus:ring-1 focus:ring-[#2F855A] text-gray-700 placeholder-gray-400 transition-colors">
                
                <!-- Tombol Mata (Toggle Password) -->
                <button type="button" onclick="togglePassword()" class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-gray-400 hover:text-[#2F855A] transition-colors focus:outline-none">
                    <svg id="eye-icon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                </button>
            </div>

            <!-- PESAN ERROR DI BAWAH PASSWORD (Sesuai contoh) -->
            <?php if (!empty($data['error'])): ?>
                <p class="text-xs text-red-500 text-left px-1 mt-1 font-medium">
                    <?= $data['error']; ?>
                </p>
            <?php endif; ?>

            <!-- Tombol Submit -->
            <button type="submit" 
                    class="w-full bg-[#2F855A] hover:bg-[#246946] text-white font-semibold py-2.5 rounded-lg transition-all duration-300 text-sm mt-4 shadow-md shadow-green-900/20 active:scale-[0.98]">
                Masuk
            </button>
        </form>

        <!-- Footer / Badge Keamanan -->
        <div class="mt-8 flex justify-center items-center gap-2 text-gray-600 bg-gray-50 py-2 rounded-lg border border-gray-100">
            <!-- Ikon Perisai -->
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
            <span class="text-[11px] font-medium tracking-wide">Halaman khusus administrator</span>
        </div>

    </div>

    <!-- Script Logika Toggle Password -->
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                // Ganti ikon menjadi mata dicoret
                eyeIcon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />`;
            } else {
                passwordInput.type = 'password';
                // Kembalikan ke ikon mata normal
                eyeIcon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>`;
            }
        }
    </script>
</body>
</html>