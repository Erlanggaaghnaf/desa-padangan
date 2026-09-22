// --- LOGIKA SCROLL REVEAL (Animasi Berulang Setiap Di-Scroll) ---
document.addEventListener("DOMContentLoaded", function() {
    const revealElements = document.querySelectorAll('.reveal-up, .reveal-left, .reveal-right');
    
    const revealObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                // Tambahkan class 'active' saat elemen masuk ke dalam layar (Animasi jalan)
                entry.target.classList.add('active');
            } else {
                // Hapus class 'active' saat elemen keluar dari layar (Mereset animasi)
                // Hapus blok 'else' ini jika Anda tidak ingin animasinya hilang tiba-tiba saat di-scroll cepat
                entry.target.classList.remove('active');
            }
        });
    }, {
        root: null,
        rootMargin: '0px',
        threshold: 0.15 // Animasi terpicu saat 15% bagian elemen sudah masuk layar
    });

    revealElements.forEach(el => revealObserver.observe(el));
});

document.addEventListener("DOMContentLoaded", function() {
        // --- LOGIKA SLIDESHOW HERO SECTION ---
        const heroBg = document.getElementById('hero-bg');
        
        // Siapkan array gambar (Pastikan gambar-gambar ini ada di folder Anda)
        // Anda bisa mengganti namanya sesuai foto yang Anda miliki
        const images = [
            'assets/images/Hero.png', 
            'assets/images/galeri1.jpg', 
            'assets/images/potensi1.jpg'
        ];
        
        let currentIndex = 0;

        setInterval(() => {
            // Turunkan opacity (memudar menjadi hitam/gelap)
            heroBg.style.opacity = 0.3;
            
            setTimeout(() => {
                // Pindah ke gambar selanjutnya
                currentIndex = (currentIndex + 1) % images.length;
                heroBg.style.backgroundImage = `url('${images[currentIndex]}')`;
                
                // Naikkan opacity kembali (muncul gambar baru)
                heroBg.style.opacity = 1;
            }, 500); // Tunggu 0.5 detik saat memudar sebelum mengganti gambar
            
        }, 5000); // Ganti gambar setiap 5 detik
    });

    