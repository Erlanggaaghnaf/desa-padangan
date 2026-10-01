<?php 
// Mendeteksi Base URL agar variabel $base_url dikenali
$protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http");
$base_url = $protocol . "://" . $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
?>

<!-- 1. TOMBOL PENGADUAN -->
<div class="reveal-right relative">
<button type="button" onclick="toggleModal('pengaduanModal')" class="bg-[#2F855A] hover:bg-green-700 text-white w-12 h-12 md:w-auto md:h-auto md:px-6 md:py-3 rounded-full shadow-xl font-semibold flex items-center justify-center md:gap-2 transform transition-all duration-200 hover:-translate-y-1">
    <span class="flex items-center justify-center">
        <svg width="20" height="20" viewBox="0 0 24 23" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M3 10H6C7.10457 10 8 10.8954 8 12V15C8 16.1046 7.10457 17 6 17H5C3.89543 17 3 16.1046 3 15V10ZM3 10C3 5.02944 7.02944 1 12 1C16.9706 1 21 5.02944 21 10M21 10V15M21 10H18C16.8954 10 16 10.8954 16 12V15C16 16.1046 16.8954 17 18 17H19C20.1046 17 21 16.1046 21 15ZM21 15V17C21 18.0609 20.5786 19.0783 19.8284 19.8284C19.0783 20.5786 18.0609 21 17 21H12" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </span>
    <span class="hidden md:inline text-sm md:text-base">
        Pengaduan Desa
    </span>
</button>
</div>

<!-- 2. MODAL FORM PENGADUAN -->
<div id="pengaduanModal" class="hidden fixed inset-0 z-[60] bg-black/60 flex items-center justify-end p-4 overflow-y-auto pt-24 pb-10 backdrop-blur-sm transition-opacity duration-300">
    <div class="bg-white w-full max-w-lg rounded-2xl shadow-2xl p-6 md:p-8 relative max-h-[90vh] overflow-y-auto">
        
        <!-- Tombol Tutup (X) -->
        <button onclick="toggleModal('pengaduanModal')" class="absolute top-4 right-4 bg-gray-100 hover:bg-gray-200 text-gray-700 w-9 h-9 rounded-xl flex items-center justify-center text-lg font-bold transition-colors">
            &times;
        </button>

        <!-- Header Modal -->
        <div class="text-center mb-6 pr-6 pl-6">
            <h3 class="text-2xl font-bold text-[#172033] mb-1">Pengaduan Desa</h3>
            <p class="text-xs md:text-sm text-gray-500">Sampaikan pengaduan atau keluhan Anda kepada Pemerintah Desa Padangan.</p>
        </div>
        
        <?php 
        $protocol = (isset($_SERVER['HTTPS']) &&$_SERVER['HTTPS'] === 'on' ? "https" : "http");
        $base_url =$protocol . "://" . $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
        ?>

        <form action="<?= $base_url; ?>/index.php?url=pengaduan/store" method="POST" enctype="multipart/form-data" id="formPengaduan">
            
            <!-- Nama Lengkap -->
            <div class="mb-4">
                <label class="block text-sm font-bold text-[#172033] mb-1.5 text-start">Nama Lengkap <span class="text-red-500">*</span></label>
                <input type="text" name="nama" required class="w-full border border-gray-200 rounded-xl p-3 focus:ring-2 focus:ring-[#2F855A] outline-none text-sm text-gray-700 bg-white shadow-sm" placeholder="Nama Lengkap Anda">
            </div>

            <!-- No. Telp / WhatsApp -->
            <div class="mb-4">
                <label class="block text-sm font-bold text-[#172033] mb-1.5 text-start">No. Telp/WhatsApp <span class="text-red-500">*</span></label>
                <input type="text" name="kontak" required class="w-full border border-gray-200 rounded-xl p-3 focus:ring-2 focus:ring-[#2F855A] outline-none text-sm text-gray-700 bg-white shadow-sm" placeholder="08123456789">
            </div>

            <!-- Judul Laporan -->
            <div class="mb-4">
                <label class="block text-sm font-bold text-[#172033] mb-1.5 text-start">Judul Laporan <span class="text-red-500">*</span></label>
                <input type="text" name="judul" required class="w-full border border-gray-200 rounded-xl p-3 focus:ring-2 focus:ring-[#2F855A] outline-none text-sm text-gray-700 bg-white shadow-sm" placeholder="Contoh: Lampu Jalan Mati di RT 02">
            </div>

            <!-- Uraian / Detail Pengaduan -->
            <div class="mb-4">
                <label class="block text-sm font-bold text-[#172033] mb-1.5 text-start">Uraian Pengaduan <span class="text-red-500">*</span></label>
                <textarea name="isi" required rows="4" class="w-full border border-gray-200 rounded-xl p-3 focus:ring-2 focus:ring-[#2F855A] outline-none text-sm text-gray-700 bg-white shadow-sm resize-none" placeholder="Tuliskan detail laporan Anda secara lengkap..."></textarea>
            </div>

            <!-- Lampiran Foto (Maksimal 3 Foto dengan Tombol Silang Hapus) -->
            <div class="mb-6">
                <label class="block text-sm font-bold text-[#172033] mb-1.5 text-start">
                    Lampiran Foto <span class="text-xs font-normal text-gray-500">(Maks. 3 Foto, Maks. 10 MB per foto)</span>
                </label>
                <input type="file" id="inputFoto" name="foto[]" multiple accept="image/*" class="w-full border border-gray-200 rounded-xl p-2.5 text-sm bg-gray-50 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-[#2F855A] file:text-white hover:file:bg-green-700 cursor-pointer">
                
                <!-- Pesan Error Dinamis di dalam Form -->
                <div id="fileErrorMsg" class="hidden mt-2 p-2.5 bg-red-50 border border-red-200 text-red-600 text-xs rounded-xl flex items-center gap-2">
                    <span>⚠️</span> <span id="errorText">Pesan error di sini</span>
                </div>

                <p class="text-[11px] text-gray-400 mt-1">Format yang didukung: JPG, JPEG, PNG.</p>
                
                <!-- Container Preview Foto dengan Tombol Silang -->
                <div id="previewContainer" class="flex gap-3 mt-3 flex-wrap"></div>
            </div>

            <!-- Tombol Kirim -->
            <div class="flex justify-end">
                <button type="submit" class="bg-[#2F855A] hover:bg-green-700 text-white font-semibold px-6 py-3 rounded-xl transition-colors flex items-center gap-2 shadow-md cursor-pointer">
                    <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17.5448 1.12458L8.42817 10.2404M11.4465 17.4071C11.4782 17.486 11.5332 17.5533 11.6042 17.6C11.6753 17.6468 11.7589 17.6706 11.8439 17.6684C11.9289 17.6663 12.0112 17.6381 12.0797 17.5879C12.1482 17.5376 12.1998 17.4675 12.2273 17.3871L17.644 1.55375C17.6707 1.47991 17.6758 1.4 17.6587 1.32338C17.6416 1.24675 17.603 1.17658 17.5475 1.12106C17.492 1.06555 17.4218 1.02699 17.3452 1.00991C17.2686 0.992822 17.1887 0.997911 17.1148 1.02458L1.2815 6.44125C1.20108 6.46883 1.13103 6.52035 1.08073 6.58889C1.03044 6.65744 1.00231 6.73972 1.00014 6.82471C0.99796 6.9097 1.02183 6.99332 1.06855 7.06435C1.11527 7.13538 1.1826 7.19042 1.2615 7.22208L7.86984 9.87208C8.07874 9.95572 8.26855 10.0808 8.42781 10.2398C8.58707 10.3987 8.71249 10.5883 8.7965 10.7971L11.4465 17.4071Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>    
                    <span>Kirim</span>
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Script untuk Preview, Validasi Maksimal 10 MB & Hapus Foto -->
<script>
    let selectedFiles = [];

    document.getElementById('inputFoto').addEventListener('change', function(e) {
        const files = Array.from(e.target.files);
        const errorBox = document.getElementById('fileErrorMsg');
        const errorText = document.getElementById('errorText');

        // Sembunyikan pesan error terlebih dahulu
        errorBox.classList.add('hidden');

        // Batasi total maksimal 3 file
        if (selectedFiles.length + files.length > 3) {
            errorText.innerText = 'Maksimal lampiran adalah 3 foto!';
            errorBox.classList.remove('hidden');
            this.value = ''; 
            return;
        }

        // Validasi ukuran maksimal 10 MB per foto
        const maxSize = 10 * 1024 * 1024; // 10 MB dalam bytes
        let invalidSize = false;

        files.forEach(file => {
            if (file.size > maxSize) {
                invalidSize = true;
            }
        });

        if (invalidSize) {
            errorText.innerText = 'Ukuran foto tidak boleh lebih dari 10 MB per file!';
            errorBox.classList.remove('hidden');
            this.value = ''; 
            selectedFiles = [];
            updateInputFiles();
            renderPreviews();
            return;
        }

        files.forEach(file => {
            selectedFiles.push(file);
        });

        updateInputFiles();
        renderPreviews();
    });

    function removePhoto(index) {
        selectedFiles.splice(index, 1);
        document.getElementById('fileErrorMsg').classList.add('hidden');
        updateInputFiles();
        renderPreviews();
    }

    function updateInputFiles() {
        const dataTransfer = new DataTransfer();
        selectedFiles.forEach(file => {
            dataTransfer.items.add(file);
        });
        document.getElementById('inputFoto').files = dataTransfer.files;
    }

    function renderPreviews() {
        const container = document.getElementById('previewContainer');
        container.innerHTML = '';

        selectedFiles.forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const div = document.createElement('div');
                div.className = 'relative w-20 h-20 rounded-xl border border-gray-200 overflow-hidden shadow-xs group';
                div.innerHTML = `
                    <img src="${e.target.result}" class="w-full h-full object-cover">
                    <button type="button" onclick="removePhoto(${index})" class="absolute top-1 right-1 bg-red-600 hover:bg-red-700 text-white w-5 h-5 rounded-full flex items-center justify-center text-xs font-bold shadow-md cursor-pointer transition-transform transform hover:scale-110">&times;</button>
                `;
                container.appendChild(div);
            }
            reader.readAsDataURL(file);
        });
    }
</script>