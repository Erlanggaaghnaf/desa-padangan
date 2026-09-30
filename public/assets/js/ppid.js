document.addEventListener("DOMContentLoaded", function() {
    // --- LOGIKA PAGINATION TABEL ---
    const barisTabel = document.querySelectorAll('.berkas-row');
    const paginationContainer = document.getElementById('pagination-container');
    
    if (barisTabel.length > 0 && paginationContainer) {
        const batasPerHalaman = 5;
        let halamanAktif = 1;
        const totalHalaman = Math.ceil(barisTabel.length / batasPerHalaman);

        function renderPagination() {
            paginationContainer.innerHTML = '';
            if(totalHalaman <= 1) return;

            const btnPrev = document.createElement('button');
            btnPrev.className = "w-8 h-8 rounded-lg border border-gray-200 flex items-center justify-center text-gray-500 hover:bg-gray-50 transition-colors disabled:opacity-50";
            btnPrev.innerHTML = "&larr;";
            btnPrev.disabled = halamanAktif === 1;
            btnPrev.onclick = () => { halamanAktif--; updateTampilan(); };
            paginationContainer.appendChild(btnPrev);

            for (let i = 1; i <= totalHalaman; i++) {
                const btnAngka = document.createElement('button');
                btnAngka.className = i === halamanAktif 
                    ? "w-8 h-8 rounded-lg font-bold bg-[#2F855A] text-white shadow-sm"
                    : "w-8 h-8 rounded-lg font-medium text-gray-600 border border-gray-200 hover:bg-gray-50";
                btnAngka.innerText = i;
                btnAngka.onclick = () => { halamanAktif = i; updateTampilan(); };
                paginationContainer.appendChild(btnAngka);
            }

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
    }
});

// --- LOGIKA MODAL PDF VIEWER (Global Scope) ---
function bukaPdfModal(pdfUrl) {
    const modal = document.getElementById('pdf-modal');
    const modalContent = document.getElementById('pdf-modal-content');
    const pdfViewer = document.getElementById('pdf-viewer');

    if (modal && pdfViewer) {
        pdfViewer.src = pdfUrl;
        modal.classList.remove('hidden');
        setTimeout(() => {
            modal.classList.remove('opacity-0');
            if(modalContent) {
                modalContent.classList.remove('scale-95');
                modalContent.classList.add('scale-100');
            }
        }, 10);
    }
}

function tutupPdfModal() {
    const modal = document.getElementById('pdf-modal');
    const modalContent = document.getElementById('pdf-modal-content');
    const pdfViewer = document.getElementById('pdf-viewer');

    if (modal) {
        modal.classList.add('opacity-0');
        if(modalContent) {
            modalContent.classList.remove('scale-100');
            modalContent.classList.add('scale-95');
        }
        setTimeout(() => {
            modal.classList.add('hidden');
            if(pdfViewer) pdfViewer.src = "";
        }, 300);
    }
}

// --- LOGIKA DOWNLOAD DOKUMEN PUBLIK ---
function downloadDokumenPublik(namaFileAsli, judulDokumen) {
    const fileUrl = 'uploads/ppid/' + namaFileAsli;
    const cleanTitle = judulDokumen.replace(/[^a-zA-Z0-9 aparat]/g, '_').trim();
    const namaFileDownload = cleanTitle + '.pdf';

    fetch(fileUrl)
        .then(response => {
            if (!response.ok) throw new Error('File tidak ditemukan');
            return response.blob();
        })
        .then(blob => {
            const blobUrl = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.style.display = 'none';
            a.href = blobUrl;
            a.download = namaFileDownload;
            document.body.appendChild(a);
            a.click();
            window.URL.revokeObjectURL(blobUrl);
            document.body.removeChild(a);
        })
        .catch(() => alert('Gagal mengunduh dokumen. Pastikan file PDF tersedia di server.'));
}