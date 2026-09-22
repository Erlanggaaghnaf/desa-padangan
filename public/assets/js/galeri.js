document.addEventListener("DOMContentLoaded", function() {
        // --- LOGIKA PAGINATION ---
        const galeriItems = document.querySelectorAll('.galeri-item');
        const paginationContainer = document.getElementById('pagination-container');
        
        const batasPerHalaman = 9; // Tampilkan 9 foto per halaman
        let halamanAktif = 1;
        const totalHalaman = Math.ceil(galeriItems.length / batasPerHalaman);

        function renderPagination() {
            paginationContainer.innerHTML = '';
            if(totalHalaman <= 1) return; // Sembunyikan pagination jika foto sedikit

            // Tombol Prev
            const btnPrev = document.createElement('button');
            btnPrev.className = "w-10 h-10 rounded-xl border border-gray-200 flex items-center justify-center text-gray-500 hover:bg-gray-50 transition-colors disabled:opacity-50 disabled:cursor-not-allowed";
            btnPrev.innerHTML = "&larr;";
            btnPrev.disabled = halamanAktif === 1;
            btnPrev.onclick = () => { halamanAktif--; updateTampilan(); };
            paginationContainer.appendChild(btnPrev);

            // Tombol Angka
            for (let i = 1; i <= totalHalaman; i++) {
                const btnAngka = document.createElement('button');
                btnAngka.className = i === halamanAktif 
                    ? "w-10 h-10 rounded-xl font-bold bg-[#2F855A] text-white shadow-sm transition-all"
                    : "w-10 h-10 rounded-xl font-medium text-gray-600 border border-gray-200 hover:bg-gray-50 transition-all";
                btnAngka.innerText = i;
                btnAngka.onclick = () => { halamanAktif = i; updateTampilan(); };
                paginationContainer.appendChild(btnAngka);
            }

            // Tombol Next
            const btnNext = document.createElement('button');
            btnNext.className = "w-10 h-10 rounded-xl border border-gray-200 flex items-center justify-center text-gray-500 hover:bg-gray-50 transition-colors disabled:opacity-50 disabled:cursor-not-allowed";
            btnNext.innerHTML = "&rarr;";
            btnNext.disabled = halamanAktif === totalHalaman;
            btnNext.onclick = () => { halamanAktif++; updateTampilan(); };
            paginationContainer.appendChild(btnNext);
        }

        function updateTampilan() {
            const indeksAwal = (halamanAktif - 1) * batasPerHalaman;
            const indeksAkhir = indeksAwal + batasPerHalaman;

            galeriItems.forEach((item, index) => {
                if (index >= indeksAwal && index < indeksAkhir) {
                    item.classList.remove('hidden');
                } else {
                    item.classList.add('hidden');
                }
            });
            renderPagination();
        }
        updateTampilan();
    });

    // --- LOGIKA LIGHTBOX ---
    const modal = document.getElementById('lightbox-modal');
    const modalImg = document.getElementById('lightbox-img');
    const modalCaption = document.getElementById('lightbox-caption');

    function bukaLightbox(src, judul) {
        modalImg.src = src;
        modalCaption.innerText = judul;
        modal.classList.remove('hidden');
        setTimeout(() => {
            modal.classList.remove('opacity-0');
            modalImg.classList.remove('scale-95');
            modalImg.classList.add('scale-100');
        }, 10);
    }

    function tutupLightbox() {
        modal.classList.add('opacity-0');
        modalImg.classList.remove('scale-100');
        modalImg.classList.add('scale-95');
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    }