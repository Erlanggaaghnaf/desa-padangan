const baseUrl = window.location.origin + window.location.pathname.replace('/public/index.php', '').split('/index.php')[0] + '/public';

let dataDokumen = [];
let currentPage = 1;
const itemsPerPage = 5;
let modalAktifYangTutup = '';
let idDokumenYangAkanDihapus = null;
let idDokumenYangAkanDiedit = null;

function ambilDataDokumen() {
    fetch(baseUrl + '/index.php?url=admin/masterData/getDokumenPpid')
    .then(res => res.json())
    .then(response => {
        if (response.status === 'success') {
            dataDokumen = response.data.map((item, index) => ({
                no: index + 1,
                id: item.id,
                judul: item.judul,
                deskripsi: item.deskripsi,
                tahun: item.tahun,
                file: 'PDF',
                namaFileAsli: item.file,
                tgl: item.tanggal_upload ? item.tanggal_upload.split(' ')[0] : '-'
            }));
            renderTable();
        }
    })
    .catch(err => console.error('Gagal memuat dokumen PPID:', err));
}

// Render Data ke Tabel
function renderTable() {
    const tbody = document.getElementById('table-body');
    tbody.innerHTML = ''; 

    if (dataDokumen.length === 0) {
        tbody.innerHTML = `<tr><td colspan="6" class="px-6 py-8 text-center text-gray-400">Belum ada dokumen PPID yang diunggah.</td></tr>`;
        document.getElementById('pagination-container').innerHTML = '';
        return;
    }

    const start = (currentPage - 1) * itemsPerPage;
    const end = start + itemsPerPage;
    const paginatedData = dataDokumen.slice(start, end);

    paginatedData.forEach(item => {
        const tr = document.createElement('tr');
        tr.className = "hover:bg-gray-50 transition-colors";
        tr.innerHTML = `
            <td class="px-6 py-4 font-medium text-gray-900">${item.no}.</td>
            <td class="px-6 py-4 text-gray-700 uppercase font-medium max-w-sm truncate" title="${item.judul}">${item.judul}</td>
            <td class="px-6 py-4 text-gray-500">${item.tahun}</td>
            <td class="px-6 py-4">
                <span class="flex items-center gap-2 text-gray-600 whitespace-nowrap">
                    <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                    PDF
                </span>
            </td>
            <td class="px-6 py-4 text-gray-500 whitespace-nowrap">${item.tgl}</td>
            <td class="px-6 py-4">
                <div class="flex items-center justify-center gap-2">
                    <!-- Button View Berdasarkan ID -->
                    <button onclick="bukaPreviewDokumenById(${item.id})" class="p-2 w-9 h-9 flex items-center justify-center text-gray-400 hover:text-blue-600 border border-gray-200 bg-white rounded-lg transition-colors" title="Pratinjau PDF">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                    </button>
                    <!-- Button Download -->
                    <button onclick="downloadDokumenFile('${item.namaFileAsli}', '${item.judul.replace(/'/g, "\\'")}')" class="p-2 w-9 h-9 flex items-center justify-center text-gray-400 hover:text-green-600 border border-gray-200 bg-white rounded-lg transition-colors" title="Download PDF">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                    </button>
                    
                    <!-- Container Titik Tiga & Aksi -->
                    <div class="relative action-container w-9 h-9">
                        <button id="btn-dots-${item.id}" onclick="toggleMenu(event, 'menu-${item.id}', 'btn-dots-${item.id}')" class="btn-dots w-full h-full flex items-center justify-center text-gray-400 hover:text-gray-800 border border-gray-200 rounded-lg transition-colors focus:outline-none bg-white">
                            ⋮
                        </button>
                        
                        <div id="menu-${item.id}" class="action-menu hidden absolute top-0 right-0 z-50 bg-white rounded-xl shadow-[0_5px_15px_rgba(0,0,0,0.12)] p-1.5 w-[110px] flex flex-col gap-1.5 border border-gray-100">
                            <!-- Button Edit Berdasarkan ID -->
                            <button onclick="bukaEditDokumenById(${item.id}); sembunyikanMenu();" class="w-full px-2 py-1.5 text-[11px] font-bold text-[#2F855A] bg-white border border-[#2F855A] rounded-lg hover:bg-green-50 flex items-center justify-center gap-1.5 transition-colors shadow-sm">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg> 
                                Edit
                            </button>
                            
                            <!-- Button Hapus -->
                            <button onclick="idDokumenYangAkanDihapus = ${item.id}; toggleModal('modalHapus'); sembunyikanMenu();" class="w-full px-2 py-1.5 text-[11px] font-bold text-white bg-[#DC2626] hover:bg-red-700 rounded-lg flex items-center justify-center gap-1.5 transition-colors shadow-sm">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg> 
                                Hapus
                            </button>
                        </div>
                    </div>
                </div>
            </td>
        `;
        tbody.appendChild(tr);
    });
    renderPaginationUI();
}

// Render Tombol Pagination Interaktif di Bawah Tabel
function renderPaginationUI() {
    const totalPages = Math.ceil(dataDokumen.length / itemsPerPage);
    const container = document.getElementById('pagination-container');
    let html = '';

    // Prev Button
    html += `<button onclick="changePage(${currentPage - 1})" class="w-8 h-8 flex items-center justify-center rounded-lg font-bold transition-colors ${currentPage === 1 ? 'text-gray-300 cursor-not-allowed' : 'text-[#2F855A] hover:bg-green-50'}"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"></path></svg></button>`;

    // Numbered Buttons
    for (let i = 1; i <= totalPages; i++) {
        if (i === currentPage) {
            html += `<button class="w-8 h-8 flex items-center justify-center text-white bg-[#2F855A] rounded-lg text-sm font-bold shadow-md">${i}</button>`;
        } else {
            html += `<button onclick="changePage(${i})" class="w-8 h-8 flex items-center justify-center text-gray-500 bg-white border border-gray-200 hover:bg-gray-50 rounded-lg text-sm font-bold transition-colors">${i}</button>`;
        }
    }

    // Next Button
    html += `<button onclick="changePage(${currentPage + 1})" class="w-8 h-8 flex items-center justify-center rounded-lg font-bold transition-colors ${currentPage === totalPages ? 'text-gray-300 cursor-not-allowed' : 'text-[#2F855A] hover:bg-green-50'}"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path></svg></button>`;

    container.innerHTML = html;
}

// Ubah Halaman dan Refresh Tabel
function changePage(page) {
    const totalPages = Math.ceil(dataDokumen.length / itemsPerPage);
    if (page >= 1 && page <= totalPages) {
        currentPage = page;
        renderTable();
        sembunyikanMenu(); 
    }
}

// ==========================================
// Logika Menampilkan Menu Edit & Hapus (Menggantikan Titik Tiga)
// ==========================================
function toggleMenu(event, menuId, btnId) {
    event.stopPropagation();
    sembunyikanMenu();

    const menu = document.getElementById(menuId);
    const btn = document.getElementById(btnId);
    if(menu && btn) {
        menu.classList.remove('hidden'); 
        btn.classList.add('opacity-0');
    }
}

function sembunyikanMenu() {
    document.querySelectorAll('.action-menu').forEach(el => el.classList.add('hidden'));
    document.querySelectorAll('.btn-dots').forEach(el => el.classList.remove('opacity-0'));
}

window.onclick = function(event) {
    if (!event.target.closest('.action-container')) {
        sembunyikanMenu();
    }
}

// ==========================================
// Fungsionalitas Bawaan & Modal
// ==========================================
function toggleSidebar() {
    const sidebar = document.getElementById('admin-sidebar');
    const overlay = document.getElementById('sidebar-overlay');
    if(sidebar) sidebar.classList.toggle('-translate-x-full');
    if(overlay) overlay.classList.toggle('hidden');
}

function toggleModal(modalID) {
    const modal = document.getElementById(modalID);
    if(modal) {
        modal.classList.toggle('hidden');
        modal.classList.toggle('flex');
    }
}

function hitungTotalPenduduk() {
    const laki = parseInt(document.getElementById('inputLaki').value) || 0;
    const perempuan = parseInt(document.getElementById('inputPerempuan').value) || 0;
    document.getElementById('inputTotal').value = laki + perempuan;
}

function validasiSimpan(modalAsalID) {
    let isEmpty = false;
    const modalElement = document.getElementById(modalAsalID);

    if (modalAsalID === 'modalKependudukan') {
        const laki = document.getElementById('inputLaki').value.trim();
        const perempuan = document.getElementById('inputPerempuan').value.trim();
        if (laki === '' || perempuan === '') isEmpty = true;
    } else {
        const inputs = modalElement.querySelectorAll('.input-jumlah');
        inputs.forEach(input => {
            if (input.value.trim() === '') isEmpty = true;
        });
    }

    if (isEmpty) {
        toggleModal('modalPeringatan');
    } else {
        modalAktifYangTutup = modalAsalID;
        toggleModal(modalAsalID);
        toggleModal('modalKonfirmasiSimpan');
    }
}

function validasiSimpanDokumen() {
    const judul = document.getElementById('inputJudulDoc').value.trim();
    const tahun = document.getElementById('inputTahunDoc').value;
    const file = document.getElementById('inputFileDoc').value;

    if (judul === '' || tahun === '' || file === '') {
        toggleModal('modalPeringatan');
    } else {
        modalAktifYangTutup = 'modalTambahDokumen';
        toggleModal('modalTambahDokumen');
        toggleModal('modalKonfirmasiSimpan');
    }
}

function validasiEditDokumen() {
    const judul = document.getElementById('editJudulDoc').value.trim();
    const tahun = document.getElementById('editTahunDoc').value;

    if (judul === '' || tahun === '') {
        toggleModal('modalPeringatan');
    } else {
        modalAktifYangTutup = 'modalEditDokumen';
        toggleModal('modalEditDokumen');
        toggleModal('modalKonfirmasiSimpan');
    }
}

function bukaPreviewDokumen(namaFile, namaFileAsli) {
    document.getElementById('previewTitle').innerText = 'Pratinjau: ' + namaFile;
    const pdfUrl = '../public/uploads/ppid/' + namaFileAsli;
    document.getElementById('pdfViewer').src = pdfUrl;
    toggleModal('modalPreview');
}

function bukaPreviewDokumenById(id) {
    const item = dataDokumen.find(d => d.id == id);
    if (item) {
        bukaPreviewDokumen(item.judul, item.namaFileAsli);
    }
}

function downloadDokumen(namaFile) {
    const element = document.createElement('a');
    element.setAttribute('href', '#');
    element.setAttribute('download', namaFile);
    element.style.display = 'none';
    document.body.appendChild(element);
    element.click();
    document.body.removeChild(element);
}

function downloadDokumenFile(namaFileAsli, judulDokumen) {
    const fileUrl = '../public/uploads/ppid/' + namaFileAsli;
    const cleanTitle = judulDokumen.replace(/[^a-zA-Z0-9 aparat]/g, '_').trim();
    const namaFileDownload = cleanTitle + '.pdf';

    fetch(fileUrl)
        .then(response => response.blob())
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
        .catch(() => alert('Gagal mengunduh dokumen.'));
}

function bukaEditDokumen(judul, tahun, id, desc = '') {
    idDokumenYangAkanDiedit = id;
    document.getElementById('editJudulDoc').value = judul;
    document.getElementById('editTahunDoc').value = tahun;
    document.getElementById('editDescDoc').value = desc;
    document.getElementById('editFileDoc').value = '';
    toggleModal('modalEditDokumen');
}

function bukaEditDokumenById(id) {
    const item = dataDokumen.find(d => d.id == id);
    if (item) {
        bukaEditDokumen(item.judul, item.tahun, item.id, item.deskripsi || '');
    }
}

function tutupKonfirmasi() {
    toggleModal('modalKonfirmasiSimpan');
    if (modalAktifYangTutup) {
        toggleModal(modalAktifYangTutup);
    }
}

function eksekusiSimpan() {
    toggleModal('modalKonfirmasiSimpan');

    if (modalAktifYangTutup === 'modalTambahDokumen') {
        const judul = document.getElementById('inputJudulDoc').value;
        const deskripsi = document.getElementById('inputDescDoc').value;
        const tahun = document.getElementById('inputTahunDoc').value;
        const fileInput = document.getElementById('inputFileDoc').files[0];

        let formData = new FormData();
        formData.append('judul', judul);
        formData.append('deskripsi', deskripsi);
        formData.append('tahun', tahun);
        formData.append('file', fileInput);

        fetch(baseUrl + '/index.php?url=admin/masterData/simpanDokumen', {
            method: 'POST',
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === 'success') {
                location.reload();
            } else {
                alert(data.message || 'Gagal menyimpan dokumen.');
            }
        });
    }
    else if (modalAktifYangTutup === 'modalEditDokumen') {
        const judul = document.getElementById('editJudulDoc').value;
        const deskripsi = document.getElementById('editDescDoc').value;
        const tahun = document.getElementById('editTahunDoc').value;
        const fileInput = document.getElementById('editFileDoc').files[0];

        let formData = new FormData();
        formData.append('id', idDokumenYangAkanDiedit);
        formData.append('judul', judul);
        formData.append('deskripsi', deskripsi);
        formData.append('tahun', tahun);
        
        if (fileInput) {
            formData.append('file', fileInput);
        }

        fetch(baseUrl + '/index.php?url=admin/masterData/updateDokumen', {
            method: 'POST',
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === 'success') {
                location.reload();
            } else {
                alert(data.message || 'Gagal menyimpan perubahan.');
            }
        });
    }
    else if (modalAktifYangTutup === 'modalKependudukan') {
        const laki = document.getElementById('inputLaki').value || 0;
        const perempuan = document.getElementById('inputPerempuan').value || 0;
        const kk = document.getElementById('inputKK').value || 0;

        fetch(baseUrl + '/index.php?url=admin/masterData/simpanKependudukan', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ laki_laki: laki, perempuan: perempuan, kepala_keluarga: kk })
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === 'success') {
                location.reload();
            } else {
                alert('Terjadi kesalahan saat menyimpan data.');
            }
        });
    }
    else if (['modalUmur', 'modalPekerjaan', 'modalPendidikan', 'modalPerkawinan', 'modalAgama'].includes(modalAktifYangTutup)) {
        const kategoriString = modalAktifYangTutup.replace('modal', '').toLowerCase();
        let itemsArray = [];
        
        const formRows = document.getElementById(modalAktifYangTutup).querySelectorAll('.item-kategori');
        formRows.forEach(row => {
            const namaKategori = row.querySelector('.kategori-nama').getAttribute('data-nama');
            const jumlah = row.querySelector('.input-jumlah').value || 0;
            itemsArray.push({ nama: namaKategori, jumlah: parseInt(jumlah) });
        });

        fetch(baseUrl + '/index.php?url=admin/masterData/simpanKategori', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ kategori: kategoriString, items: itemsArray })
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === 'success') {
                location.reload();
            } else {
                alert('Terjadi kesalahan saat menyimpan data.');
            }
        });
    } else {
        location.reload();
    }
}

function eksekusiHapus() {
    toggleModal('modalHapus');
    if (idDokumenYangAkanDihapus) {
        fetch(baseUrl + '/index.php?url=admin/masterData/hapusDokumen', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id: idDokumenYangAkanDihapus })
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === 'success') {
                location.reload();
            } else {
                alert('Gagal menghapus dokumen.');
            }
        });
    }
}

function updateDateTime() {
    const now = new Date();
    const optionsDate = { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' };
    const optionsTime = { hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false };
    
    const dateEl = document.getElementById('current-date');
    const timeEl = document.getElementById('current-time');
    
    if(dateEl) dateEl.innerText = now.toLocaleDateString('id-ID', optionsDate);
    if(timeEl) timeEl.innerText = now.toLocaleTimeString('id-ID', optionsTime) + ' WIB';
}

updateDateTime();
setInterval(updateDateTime, 1000);
ambilDataDokumen();