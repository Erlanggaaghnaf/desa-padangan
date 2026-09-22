document.addEventListener("DOMContentLoaded", function() {
        // --- LOGIKA PAGINATION TABEL ---
        const barisTabel = document.querySelectorAll('.berkas-row');
        const paginationContainer = document.getElementById('pagination-container');
        
        const batasPerHalaman = 5;
        let halamanAktif = 1;
        const totalHalaman = Math.ceil(barisTabel.length / batasPerHalaman);

        function renderPagination() {
            paginationContainer.innerHTML = '';
            if(totalHalaman <= 1) return;

            // Tombol Prev
            const btnPrev = document.createElement('button');
            btnPrev.className = "w-8 h-8 rounded-lg border border-gray-200 flex items-center justify-center text-gray-500 hover:bg-gray-50 transition-colors disabled:opacity-50";
            btnPrev.innerHTML = "&larr;";
            btnPrev.disabled = halamanAktif === 1;
            btnPrev.onclick = () => { halamanAktif--; updateTampilan(); };
            paginationContainer.appendChild(btnPrev);

            // Tombol Angka
            for (let i = 1; i <= totalHalaman; i++) {
                const btnAngka = document.createElement('button');
                btnAngka.className = i === halamanAktif 
                    ? "w-8 h-8 rounded-lg font-bold bg-[#2F855A] text-white shadow-sm"
                    : "w-8 h-8 rounded-lg font-medium text-gray-600 border border-gray-200 hover:bg-gray-50";
                btnAngka.innerText = i;
                btnAngka.onclick = () => { halamanAktif = i; updateTampilan(); };
                paginationContainer.appendChild(btnAngka);
            }

            // Tombol Next
            const btnNext = document.createElement('button');
            btnNext.className = "w-8 h-8 rounded-lg border border-gray-200 flex items-center justify-center text-gray-500 hover:bg-gray-50 transition-colors disabled:opacity-50";
            btnNext.innerHTML = "&rarr;";
            btnNext.disabled = halamanAktif === totalHalaman;
            btnNext.onclick = () => { halamanAktif++; updateTampilan(); };
            paginationContainer.appendChild(btnNext);
        }

        function updateTampilan() {
            const indeksAwal = (halamanAktif - 1) * batasPerHalaman;
            const indeksAkhir = indeksAwal + batasPerHalaman;

            barisTabel.forEach((row, index) => {
                if (index >= indeksAwal && index < indeksAkhir) {
                    row.style.display = 'table-row';
                } else {
                    row.style.display = 'none';
                }
            });
            renderPagination();
        }
        updateTampilan();
    });

    // --- LOGIKA MODAL PDF VIEWER ---
    const modal = document.getElementById('pdf-modal');
    const modalContent = document.getElementById('pdf-modal-content');
    const pdfViewer = document.getElementById('pdf-viewer');

    function bukaPdfModal(pdfUrl) {
        pdfViewer.src = pdfUrl; // Setel sumber PDF ke Iframe
        modal.classList.remove('hidden');
        setTimeout(() => {
            modal.classList.remove('opacity-0');
            modalContent.classList.remove('scale-95');
            modalContent.classList.add('scale-100');
        }, 10);
    }

    function tutupPdfModal() {
        modal.classList.add('opacity-0');
        modalContent.classList.remove('scale-100');
        modalContent.classList.add('scale-95');
        setTimeout(() => {
            modal.classList.add('hidden');
            pdfViewer.src = ""; // Bersihkan memori iframe saat ditutup
        }, 300);
    }


    // --- LOGIKA ANIMASI PROGRESS BAR APBDES ---
    // Menggunakan IntersectionObserver agar animasi berjalan HANYA saat elemen terlihat di layar
    const progressBars = document.querySelectorAll('.progress-animate');
    const apbdesSection = document.getElementById('apbdes-section');

    const observerOptions = {
        root: null,
        rootMargin: '0px',
        threshold: 0.3 // Animasi berjalan ketika 30% dari bagian APBDes terlihat di layar
    };

    const progressObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                // Ambil semua progress bar di dalam section
                progressBars.forEach(bar => {
                    // Ambil target lebar dari atribut data-width
                    const targetWidth = bar.getAttribute('data-width');
                    // Terapkan lebar tersebut sehingga transisi CSS memainkannya
                    bar.style.width = targetWidth;
                });
                // Hentikan pantauan setelah animasi selesai agar tidak berulang terus
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    if (apbdesSection) {
        progressObserver.observe(apbdesSection);
    }