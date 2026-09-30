// Accordion layanan public.
function toggleAccordion(contentId, iconId) {
    const content = document.getElementById(contentId);
    const icon = document.getElementById(iconId);

    if (!content || !icon) {
        return;
    }

    const isHidden = content.classList.contains('hidden');

    if (isHidden) {
        content.classList.remove('hidden');
        icon.classList.add('rotate-180');
    } else {
        content.classList.add('hidden');
        icon.classList.remove('rotate-180');
    }
}

// Filter kategori layanan berdasarkan data-kategori yang dirender dari database.
function filterLayanan(kategori, trigger = null) {
    const sections = document.querySelectorAll('.kategori-section');
    const buttons = document.querySelectorAll('.filter-btn');

    buttons.forEach((button) => {
        button.classList.remove('bg-[#2F855A]', 'text-white', 'shadow-sm');
        button.classList.add('bg-white', 'text-gray-600', 'border', 'border-gray-200');
    });

    const activeButton = trigger || document.querySelector(`.filter-btn[data-kategori="${kategori}"]`);
    if (activeButton) {
        activeButton.classList.remove('bg-white', 'text-gray-600', 'border', 'border-gray-200');
        activeButton.classList.add('bg-[#2F855A]', 'text-white', 'shadow-sm');
    }

    sections.forEach((section) => {
        const visible = kategori === 'semua' || section.getAttribute('data-kategori') === kategori;
        section.style.display = visible ? 'block' : 'none';
    });
}
