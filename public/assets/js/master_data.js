// ==========================================
        // DUMMY DATA UNTUK PAGINATION & TABEL
        // Sesuai desain image_c07843.png
        // ==========================================
        const dataDokumen = [
            { no: 1, judul: "LAPORAN PEMERIKSAAN PEKERJAAN", tahun: 2026, file: "PDF (2.4MB)", tgl: "17-09-2026" },
            { no: 2, judul: "RKA Semester 1", tahun: 2026, file: "PDF (2.2MB)", tgl: "02-09-2026" },
            { no: 3, judul: "BUKU REALISASI PEMBANGUNAN SEMESTER 1", tahun: 2026, file: "PDF (1.4MB)", tgl: "29-08-2026" },
            { no: 4, judul: "Permendes no.16 Tahun 2025 tentang prioritas penggunaan dana desa tah...", tahun: 2026, file: "PDF (1.9MB)", tgl: "09-07-2026" },
            { no: 5, judul: "KERANGKA ACUAN KERJA PEMBANGUNAN JALAN RT.02-RT.03 DUSUN LUBANG LANDAK", tahun: 2026, file: "PDF (0.4MB)", tgl: "08-07-2026" },
            // Tambahan dummy data untuk simulasi pagination halaman selanjutnya
            { no: 6, judul: "LAPORAN PERTANGGUNGJAWABAN BUMDES 2025", tahun: 2026, file: "PDF (3.1MB)", tgl: "15-06-2026" },
            { no: 7, judul: "DATA STUNTING DESA PADANGAN 2026", tahun: 2026, file: "PDF (1.1MB)", tgl: "10-05-2026" },
            { no: 8, judul: "SK KEPALA DESA TENTANG KEPENGURUSAN KARANG TARUNA", tahun: 2026, file: "PDF (0.8MB)", tgl: "02-04-2026" },
            { no: 9, judul: "PETA BLOK DESA BERDASARKAN RTRW", tahun: 2026, file: "PDF (4.5MB)", tgl: "20-03-2026" },
            { no: 10, judul: "PROFIL DESA PADANGAN TAHUN 2026", tahun: 2026, file: "PDF (2.7MB)", tgl: "15-01-2026" },
            { no: 11, judul: "LAPORAN KEUANGAN DESA TAHUN ANGGARAN 2025", tahun: 2026, file: "PDF (5.2MB)", tgl: "05-01-2026" },
            { no: 12, judul: "DATA KELUARGA PENERIMA MANFAAT BLT DD", tahun: 2026, file: "PDF (1.3MB)", tgl: "03-01-2026" },
        ];

        let currentPage = 1;
        const itemsPerPage = 5;
        let modalAktifYangTutup = '';

        // Render Data ke Tabel
        function renderTable() {
            const tbody = document.getElementById('table-body');
            tbody.innerHTML = ''; // Kosongkan isi tabel

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
                            ${item.file}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-gray-500 whitespace-nowrap">${item.tgl}</td>
                    <td class="px-6 py-4">
                        <div class="flex items-center justify-center gap-2">
                            <!-- Button View -->
                            <button onclick="bukaPreviewDokumen('${item.judul}', '${item.file}')" class="p-2 w-9 h-9 flex items-center justify-center text-gray-400 hover:text-blue-600 border border-gray-200 bg-white rounded-lg transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            </button>
                            <!-- Button Download -->
                            <button onclick="downloadDokumen('${item.judul}.pdf')" class="p-2 w-9 h-9 flex items-center justify-center text-gray-400 hover:text-green-600 border border-gray-200 bg-white rounded-lg transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                            </button>
                            
                            <!-- Container Titik Tiga & Aksi -->
                            <div class="relative action-container w-9 h-9">
                                <!-- Tombol Titik Tiga -->
                                <button id="btn-dots-${item.no}" onclick="toggleMenu(event, 'menu-${item.no}', 'btn-dots-${item.no}')" class="btn-dots w-full h-full flex items-center justify-center text-gray-400 hover:text-gray-800 border border-gray-200 rounded-lg transition-colors focus:outline-none bg-white">
                                    ⋮
                                </button>
                                
                                <!-- Menu Aksi popup (posisi di kanan menutupi titik 3 sesuai desain) -->
                                <div id="menu-${item.no}" class="action-menu hidden absolute top-0 right-0 z-50 bg-white rounded-xl shadow-[0_5px_15px_rgba(0,0,0,0.12)] p-1.5 w-[110px] flex flex-col gap-1.5 border border-gray-100">
                                    <button onclick="bukaEditDokumen('${item.judul}', '${item.tahun}', '...'); sembunyikanMenu();" class="w-full px-2 py-1.5 text-[11px] font-bold text-[#2F855A] bg-white border border-[#2F855A] rounded-lg hover:bg-green-50 flex items-center justify-center gap-1.5 transition-colors shadow-sm">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg> 
                                        Edit
                                    </button>
                                    <button onclick="toggleModal('modalHapus'); sembunyikanMenu();" class="w-full px-2 py-1.5 text-[11px] font-bold text-white bg-[#DC2626] hover:bg-red-700 rounded-lg flex items-center justify-center gap-1.5 transition-colors shadow-sm">
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
            event.stopPropagation(); // Mencegah klik menyebar ke window
            sembunyikanMenu(); // Tutup menu lain

            const menu = document.getElementById(menuId);
            const btn = document.getElementById(btnId);
            if(menu && btn) {
                menu.classList.remove('hidden'); 
                btn.classList.add('opacity-0'); // Buat titik 3 transparan agar seolah digantikan box
            }
        }

        // Sembunyikan semua menu aksi
        function sembunyikanMenu() {
            document.querySelectorAll('.action-menu').forEach(el => el.classList.add('hidden'));
            document.querySelectorAll('.btn-dots').forEach(el => el.classList.remove('opacity-0'));
        }

        // Klik di mana saja menutup menu popup
        window.onclick = function(event) {
            if (!event.target.closest('.action-container')) {
                sembunyikanMenu();
            }
        }
        
        // ==========================================
        // Sisa Fungsi Fungsionalitas Bawaan
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

        function validasiSimpan(modalAsalID, selectorInput) {
            let isEmpty = false;
            if (Array.isArray(selectorInput)) {
                selectorInput.forEach(id => {
                    if (document.getElementById(id).value.trim() === '') isEmpty = true;
                });
            } else {
                document.querySelectorAll(selectorInput).forEach(input => {
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

        function bukaPreviewDokumen(namaFile, ukuran) {
            document.getElementById('previewTitle').innerText = 'Pratinjau: ' + namaFile;
            document.getElementById('previewInfo').innerText = namaFile + '.pdf';
            toggleModal('modalPreview');
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

        function bukaEditDokumen(judul, tahun, desc) {
            document.getElementById('editJudulDoc').value = judul;
            document.getElementById('editTahunDoc').value = tahun;
            document.getElementById('editDescDoc').value = desc;
            toggleModal('modalEditDokumen');
        }

        function tutupKonfirmasi() {
            toggleModal('modalKonfirmasiSimpan');
            if (modalAktifYangTutup) {
                toggleModal(modalAktifYangTutup);
            }
        }

        function eksekusiSimpan() {
            toggleModal('modalKonfirmasiSimpan');
            location.reload();
        }

        function eksekusiHapus() {
            toggleModal('modalHapus');
            // Logika untuk menghapus data dari list juga bisa ditambahkan jika ini sistem dinamis frontend
            location.reload();
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
        
        // Panggil inisialisasi jam dan render data saat halaman dibuka
        updateDateTime();
        setInterval(updateDateTime, 1000);
        renderTable();