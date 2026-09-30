document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('lightbox-modal');
    const modalImg = document.getElementById('lightbox-img');
    const modalCaption = document.getElementById('lightbox-caption');

    if (!modal || !modalImg || !modalCaption) {
        return;
    }

    window.bukaLightbox = function (src, judul) {
        modalImg.src = src;
        modalCaption.innerText = judul;
        modal.classList.remove('hidden');

        setTimeout(() => {
            modal.classList.remove('opacity-0');
            modalImg.classList.remove('scale-95');
            modalImg.classList.add('scale-100');
        }, 10);
    };

    window.tutupLightbox = function () {
        modal.classList.add('opacity-0');
        modalImg.classList.remove('scale-100');
        modalImg.classList.add('scale-95');

        setTimeout(() => {
            modal.classList.add('hidden');
            modalImg.src = '';
            modalCaption.innerText = '';
        }, 300);
    };

    modal.addEventListener('click', function (event) {
        if (event.target === modal) {
            window.tutupLightbox();
        }
    });
});
