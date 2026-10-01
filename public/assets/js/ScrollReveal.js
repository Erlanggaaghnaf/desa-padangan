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

document.addEventListener("DOMContentLoaded", function () {
    const heroBg1 = document.getElementById("hero-bg-1");
    const heroBg2 = document.getElementById("hero-bg-2");

    if (!heroBg1 || !heroBg2) return;

    const images = [
        "assets/images/Hero.png",
        "assets/images/galeri1.jpg",
        "assets/images/galeri2.jpg"
    ];

    let currentIndex = 0;
    let activeLayer = 1;

    setInterval(() => {
        currentIndex = (currentIndex + 1) % images.length;

        if (activeLayer === 1) {
            // Siapkan gambar berikutnya di layer kedua
            heroBg2.style.backgroundImage =
                `url('${images[currentIndex]}')`;

            // Fade dari layer 1 ke layer 2
            heroBg2.classList.remove("opacity-0");
            heroBg2.classList.add("opacity-100");

            heroBg1.classList.remove("opacity-100");
            heroBg1.classList.add("opacity-0");

            activeLayer = 2;
        } else {
            // Siapkan gambar berikutnya di layer pertama
            heroBg1.style.backgroundImage =
                `url('${images[currentIndex]}')`;

            // Fade dari layer 2 ke layer 1
            heroBg1.classList.remove("opacity-0");
            heroBg1.classList.add("opacity-100");

            heroBg2.classList.remove("opacity-100");
            heroBg2.classList.add("opacity-0");

            activeLayer = 1;
        }
    }, 5000);
});