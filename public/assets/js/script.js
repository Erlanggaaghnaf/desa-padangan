// --- FITUR MODAL ---
function toggleModal(modalID){
    document.getElementById(modalID).classList.toggle("hidden");
}

// --- FITUR MENANDAI MENU AKTIF (GARIS BAWAH) ---
document.addEventListener('DOMContentLoaded', () => {
    // Ambil nama halaman dari URL (misal: dari ?url=Galeri menjadi "galeri")
    const urlParams = new URLSearchParams(window.location.search);
    let currentPage = urlParams.get('url');
    
    // Jika kosong (hanya localhost:8000), berarti sedang di halaman Home/Beranda
    if (!currentPage) {
        currentPage = 'home';
    }
    currentPage = currentPage.toLowerCase();

    // Ambil semua elemen <a> di dalam navbar desktop dan mobile
    const navLinks = document.querySelectorAll('#navbar a, #mobile-menu a');

    navLinks.forEach(link => {
        const href = link.getAttribute('href');
        if (href) {
            // Cek apakah link ini mengarah ke halaman yang sedang aktif
            const isMatch = href.toLowerCase().includes(currentPage);
            // Cek khusus untuk halaman beranda (jika href hanya "/" atau mengarah ke Home)
            const isHomeMatch = currentPage === 'home' && (href === '/' || href.toLowerCase().includes('home'));

            if (isMatch || isHomeMatch) {
                // Styling garis bawah putih yang sama untuk desktop maupun mobile
                link.classList.add('border-b-2', 'border-white', 'pb-1', 'font-bold');
            }
        }
    });
});

// --- LOGIKA WARNA NAVBAR SAAT DI-SCROLL ---
window.addEventListener('scroll', function() {
    const navbar = document.getElementById('navbar');
    // Cek apakah ini halaman beranda dari atribut data-page yang kita buat di PHP
    const isHome = navbar.getAttribute('data-page') === 'home';
    
    if (window.scrollY > 50) {
        navbar.classList.remove('bg-transparent');
        navbar.classList.add('bg-[#2F855A]', 'shadow-md');
    } else {
        if (isHome) {
            navbar.classList.add('bg-transparent');
            navbar.classList.remove('bg-[#2F855A]', 'shadow-md');
        } else {
            navbar.classList.add('bg-[#2F855A]', 'shadow-md');
            navbar.classList.remove('bg-transparent');
        }
    }
});

// --- LOGIKA HAMBURGER MENU (MOBILE) ---
const hamburgerBtn = document.getElementById('hamburger-btn');
const mobileMenu = document.getElementById('mobile-menu');
const mobileLinks = document.querySelectorAll('.mobile-link');
const navbarMobile = document.getElementById('navbar');

hamburgerBtn.addEventListener('click', () => {
    mobileMenu.classList.toggle('opacity-0');
    mobileMenu.classList.toggle('scale-95');
    mobileMenu.classList.toggle('pointer-events-none');
    
    if (mobileMenu.classList.contains('opacity-0')) {
        hamburgerBtn.innerHTML = '☰';
        if (window.scrollY <= 50) {
            navbarMobile.classList.add('bg-transparent');
            navbarMobile.classList.remove('bg-[#2F855A]', 'shadow-md');
        }
    } else {
        hamburgerBtn.innerHTML = '✕';
        navbarMobile.classList.remove('bg-transparent');
        navbarMobile.classList.add('bg-[#2F855A]', 'shadow-md');
    }
});

mobileLinks.forEach(link => {
    link.addEventListener('click', () => {
        mobileMenu.classList.add('opacity-0', 'scale-95', 'pointer-events-none');
        hamburgerBtn.innerHTML = '☰';
    });
});