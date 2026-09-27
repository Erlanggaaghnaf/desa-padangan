<!-- 1. TOMBOL PENGADUAN -->
<div class="reveal-right relative">
<button type="button" onclick="toggleModal('pengaduanModal')" class="bg-[#2F855A] hover:bg-green-700 text-white w-12 h-12 md:w-auto md:h-auto md:px-6 md:py-3 rounded-full shadow-xl font-semibold flex items-center justify-center md:gap-2 transform transition-all duration-200 hover:-translate-y-1">
    <span class="flex items-center justify-center">
        <svg width="20" height="20" viewBox="0 0 24 23" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M3 10H6C6.53043 10 7.03914 10.2107 7.41421 10.5858C7.78929 10.9609 8 11.4696 8 12V15C8 15.5304 7.78929 16.0391 7.41421 16.4142 7.03914 16.7893 6.53043 17 6 17H5C4.46957 17 3.96086 16.7893 3.58579 16.4142 3.21071 16.0391 3 15.5304 3 15V10ZM3 10C3 8.8181 3.23279 7.64778 3.68508 6.55585 4.13738 5.46392 4.80031 4.47177 5.63604 3.63604 6.47177 2.80031 7.46392 2.13738 8.55585 1.68508 9.64778 1.23279 10.8181 1 12 1 13.1819 1 14.3522 1.23279 15.4442 1.68508 16.5361 2.13738 17.5282 2.80031 18.364 3.63604 19.1997 4.47177 19.8626 5.46392 20.3149 6.55585 20.7672 7.64778 21 8.8181 21 10M21 10V15M21 10H18C17.4696 10 16.9609 10.2107 16.5858 10.5858 16.2107 10.9609 16 11.4696 16 12V15C16 15.5304 16.2107 16.0391 16.5858 16.4142 16.9609 17 17.4696 17H19C19.5304 17 20.0391 16.7893 20.4142 16.4142 21 15V15M21 15V17C21 18.0609 20.5786 19.0783 19.8284 19.8284 19.0783 20.5786 18.0609 21 17 21H12" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
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
            <p class="text-xs md:text-sm text-gray-500">Sampaikan pengaduan, keluhan, atau masukan kepada Pemerintah Desa Padangan.</p>
        </div>
        
        <!-- Action mengarah ke file proses_pengaduan.php di root folder -->
        <form action="../proses_pengaduan.php" method="POST" enctype="multipart/form-data">
            
            <!-- Nama Lengkap -->
            <div class="mb-4">
                <label class="block text-sm font-bold text-[#172033] mb-1.5 text-start">Nama Lengkap <span class="text-red-500">*</span></label>
                <input type="text" name="nama" required class="w-full border border-gray-200 rounded-xl p-3 focus:ring-2 focus:ring-[#2F855A] outline-none text-sm text-gray-700 bg-white shadow-sm" placeholder="Rafie Firman">
            </div>

            <!-- No. Telp / WhatsApp -->
            <div class="mb-4">
                <label class="block text-sm font-bold text-[#172033] mb-1.5 text-start">No. Telp/WhatsApp <span class="text-red-500">*</span></label>
                <input type="text" name="kontak" required class="w-full border border-gray-200 rounded-xl p-3 focus:ring-2 focus:ring-[#2F855A] outline-none text-sm text-gray-700 bg-white shadow-sm" placeholder="08123456789">
            </div>

            <!-- Kategori & Judul Laporan -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-bold text-[#172033] mb-1.5 text-start">Kategori <span class="text-red-500">*</span></label>
                    <select name="kategori" required class="w-full border border-gray-200 rounded-xl p-3 focus:ring-2 focus:ring-[#2F855A] outline-none text-sm text-gray-700 bg-white shadow-sm">
                        <option value="Infrastruktur">Infrastruktur</option>
                        <option value="Pelayanan">Pelayanan Desa</option>
                        <option value="Keamanan">Keamanan</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-bold text-[#172033] mb-1.5 text-start">Judul Laporan <span class="text-red-500">*</span></label>
                    <input type="text" name="judul" required class="w-full border border-gray-200 rounded-xl p-3 focus:ring-2 focus:ring-[#2F855A] outline-none text-sm text-gray-700 bg-white shadow-sm" placeholder="Contoh: Jalan Berlubang">
                </div>
            </div>

            <!-- Lokasi Kejadian -->
            <div class="mb-4">
                <label class="block text-sm font-bold text-[#172033] mb-1.5 text-start">Lokasi Kejadian</label>
                <input type="text" name="lokasi" class="w-full border border-gray-200 rounded-xl p-3 focus:ring-2 focus:ring-[#2F855A] outline-none text-sm text-gray-700 bg-white shadow-sm" placeholder="Misal: RT 02 / Dusun Krajan">
            </div>

            <!-- Isi Pesan / Pengaduan -->
            <div class="mb-4">
                <label class="block text-sm font-bold text-[#172033] mb-1.5 text-start">Detail Pengaduan <span class="text-red-500">*</span></label>
                <textarea name="isi" required rows="4" class="w-full border border-gray-200 rounded-xl p-3 focus:ring-2 focus:ring-[#2F855A] outline-none text-sm text-gray-700 bg-white shadow-sm resize-none" placeholder="Tuliskan detail laporan Anda"></textarea>
            </div>

            <!-- Lampiran File -->
            <div class="mb-6">
                <label class="block text-sm font-bold text-[#172033] mb-1.5 text-start">Lampiran Foto</label>
                <input type="file" name="foto" class="w-full border border-gray-200 rounded-xl p-2.5 text-sm bg-gray-50 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-[#2F855A] file:text-white hover:file:bg-green-700 cursor-pointer" accept="image/*">
            </div>

            <!-- Tombol Kirim -->
            <div class="flex justify-end">
                <button type="submit" name="kirim_pengaduan" class="bg-[#2F855A] hover:bg-green-700 text-white font-semibold px-6 py-3 rounded-xl transition-colors flex items-center gap-2 shadow-md cursor-pointer">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="22" y1="2" x2="11" y2="13"></line>
                        <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                    </svg>
                    Kirim Laporan
                </button>
            </div>
        </form>
    </div>
</div>