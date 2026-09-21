// 1. Fungsi Accordion (Buka-tutup detail layanan)
    function toggleAccordion(contentId, iconId) {
        const content = document.getElementById(contentId);
        const icon = document.getElementById(iconId);
        
        content.classList.toggle('hidden');
        icon.classList.toggle('rotate-180');
    }

    // 2. Fungsi Filter Kategori Layanan
    function filterLayanan(kategori) {
        const sections = document.querySelectorAll('.kategori-section');
        const buttons = document.querySelectorAll('.filter-btn');

        // Ubah warna tombol aktif
        buttons.forEach(btn => {
            btn.classList.remove('bg-[#2F855A]', 'text-white', 'shadow-sm');
            btn.classList.add('bg-white', 'text-gray-600', 'border', 'border-gray-200');
        });
        event.target.classList.remove('bg-white', 'text-gray-600', 'border', 'border-gray-200');
        event.target.classList.add('bg-[#2F855A]', 'text-white', 'shadow-sm');

        // Tampilkan/Sembunyikan section berdasarkan kategori
        sections.forEach(sec => {
            if (kategori === 'semua' || sec.getAttribute('data-kategori') === kategori) {
                sec.style.display = 'block';
            } else {
                sec.style.display = 'none';
            }
        });
    }