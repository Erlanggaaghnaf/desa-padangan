function toggleModal(modalID){
    document.getElementById(modalID).classList.toggle("hidden");
}

// 1. Perbaikan typo 'wwindow' menjadi 'window'
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

const hamburgerBtn = document.getElementById('hamburger-btn');
const mobileMenu = document.getElementById('mobile-menu');
const mobileLinks = document.querySelectorAll('.mobile-link');
// 2. Perbaikan ID dari 'main-navbar' menjadi 'navbar'
const navbar = document.getElementById('navbar');

hamburgerBtn.addEventListener('click', () => {
    mobileMenu.classList.toggle('opacity-0');
    mobileMenu.classList.toggle('scale-95');
    mobileMenu.classList.toggle('pointer-events-none');
    
    if (mobileMenu.classList.contains('opacity-0')) {
        hamburgerBtn.innerHTML = '☰';
        if (window.scrollY <= 50) {
            navbar.classList.add('bg-transparent');
            navbar.classList.remove('bg-[#2F855A]', 'shadow-md');
        }
    } else {
        hamburgerBtn.innerHTML = '✕';
        navbar.classList.remove('bg-transparent');
        navbar.classList.add('bg-[#2F855A]', 'shadow-md');
    }
});

mobileLinks.forEach(link => {
    link.addEventListener('click', () => {
        mobileMenu.classList.add('opacity-0', 'scale-95', 'pointer-events-none');
        hamburgerBtn.innerHTML = '☰';
    });
});