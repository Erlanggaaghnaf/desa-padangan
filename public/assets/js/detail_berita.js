// 1. Fitur Lightbox Gambar
    const modal = document.getElementById('image-modal');
    const modalImg = document.getElementById('modal-img');

    function bukaModalGambar(src) {
        modalImg.src = src;
        modal.classList.remove('hidden');
        // Sedikit delay agar animasi transisi terlihat
        setTimeout(() => {
            modal.classList.remove('opacity-0');
            modalImg.classList.remove('scale-95');
            modalImg.classList.add('scale-100');
        }, 10);
    }

    function tutupModalGambar() {
        modal.classList.add('opacity-0');
        modalImg.classList.remove('scale-100');
        modalImg.classList.add('scale-95');
        // Tunggu animasi selesai baru sembunyikan elemen
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    }

    // 2. Fitur Salin Tautan
    function salinTautan() {
        const url = window.location.href;
        navigator.clipboard.writeText(url).then(() => {
            const btn = document.getElementById('btn-copy');
            const teksAsli = btn.innerHTML;
            
            // Ubah tampilan tombol sesaat menjadi "Berhasil disalin!"
            btn.innerHTML = `<svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> <span class="text-green-600">Berhasil disalin!</span>`;
            
            setTimeout(() => {
                btn.innerHTML = teksAsli;
            }, 2000);
        });
    }