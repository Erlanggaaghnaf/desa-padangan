document.addEventListener("DOMContentLoaded", function() {
        const beritaItems = document.querySelectorAll('.berita-item');
        const paginationContainer = document.getElementById('pagination-container');
        
        const batasPerHalaman = 6; // Atur jumlah maksimal berita yang tampil per halaman
        let halamanAktif = 1;
        const totalHalaman = Math.ceil(beritaItems.length / batasPerHalaman);

        // Jika jumlah berita kosong, hentikan script
        if(beritaItems.length === 0) return;

        // Fungsi untuk merender/menggambar tombol angka sesuai jumlah total halaman
        function renderPagination() {
            paginationContainer.innerHTML = ''; // Kosongkan dulu

            // Tombol 'Previous' (kiri)
            const btnPrev = document.createElement('button');
            btnPrev.className = "w-10 h-10 rounded-xl border border-gray-200 flex items-center justify-center text-gray-500 hover:bg-gray-50 transition-colors disabled:opacity-50 disabled:cursor-not-allowed";
            btnPrev.innerHTML = "&larr;";
            btnPrev.disabled = halamanAktif === 1;
            btnPrev.onclick = () => { halamanAktif--; updateTampilan(); };
            paginationContainer.appendChild(btnPrev);

            // Tombol Angka (1, 2, 3...)
            for (let i = 1; i <= totalHalaman; i++) {
                const btnAngka = document.createElement('button');
                if (i === halamanAktif) {
                    // Gaya untuk halaman yang sedang aktif
                    btnAngka.className = "w-10 h-10 rounded-xl font-bold bg-[#2F855A] text-white shadow-sm transition-all";
                } else {
                    // Gaya untuk halaman lainnya
                    btnAngka.className = "w-10 h-10 rounded-xl font-medium text-gray-600 border border-gray-200 hover:bg-gray-50 transition-all";
                }
                btnAngka.innerText = i;
                btnAngka.onclick = () => { halamanAktif = i; updateTampilan(); };
                paginationContainer.appendChild(btnAngka);
            }

            // Tombol 'Next' (kanan)
            const btnNext = document.createElement('button');
            btnNext.className = "w-10 h-10 rounded-xl border border-gray-200 flex items-center justify-center text-gray-500 hover:bg-gray-50 transition-colors disabled:opacity-50 disabled:cursor-not-allowed";
            btnNext.innerHTML = "&rarr;";
            btnNext.disabled = halamanAktif === totalHalaman;
            btnNext.onclick = () => { halamanAktif++; updateTampilan(); };
            paginationContainer.appendChild(btnNext);
        }

        // Fungsi untuk mengatur berita mana yang disembunyikan / ditampilkan
        function updateTampilan() {
            const indeksAwal = (halamanAktif - 1) * batasPerHalaman;
            const indeksAkhir = indeksAwal + batasPerHalaman;

            beritaItems.forEach((item, index) => {
                if (index >= indeksAwal && index < indeksAkhir) {
                    item.classList.remove('hidden'); // Tampilkan berita
                } else {
                    item.classList.add('hidden'); // Sembunyikan berita
                }
            });

            // Gambar ulang tombolnya agar warnanya menyesuaikan halaman baru
            renderPagination();
            
            // Opsional: Otomatis scroll ke atas daftar berita setelah pindah halaman
            document.getElementById('berita-container').scrollIntoView({ behavior: 'smooth', block: 'start' });
        }

        // Jalankan fungsi saat halaman pertama kali dimuat
        updateTampilan();
    });