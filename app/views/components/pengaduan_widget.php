<!-- 1. TOMBOL PENGADUAN (Dipanggil di Hero Section atau bagian lain) -->
<button onclick="toggleModal('pengaduanModal')" class="bg-[#2F855A] hover:bg-green-700 text-white px-5 md:px-6 py-3 rounded-full shadow-2xl font-semibold flex items-center gap-2 transform transition-transform hover:-translate-y-1">
    <span class="flex items-center">
        <svg width="20" height="20" viewBox="0 0 24 23" fill="none" xmlns="http://www.w3.org/2000/svg"> 
            <path d="M3 10H6C6.53043 10 7.03914 10.2107 7.41421 10.5858C7.78929 10.9609 8 11.4696 8 12V15C8 15.5304 7.78929 16.0391 7.41421 16.4142C7.03914 16.7893 6.53043 17 6 17H5C4.46957 17 3.96086 16.7893 3.58579 16.4142C3.21071 16.0391 3 15.5304 3 15V10ZM3 10C3 8.8181 3.23279 7.64778 3.68508 6.55585C4.13738 5.46392 4.80031 4.47177 5.63604 3.63604C6.47177 2.80031 7.46392 2.13738 8.55585 1.68508C9.64778 1.23279 10.8181 1 12 1C13.1819 1 14.3522 1.23279 15.4442 1.68508C16.5361 2.13738 17.5282 2.80031 18.364 3.63604C19.1997 4.47177 19.8626 5.46392 20.3149 6.55585C20.7672 7.64778 21 8.8181 21 10M21 10V15M21 10H18C17.4696 10 16.9609 10.2107 16.5858 10.5858C16.2107 10.9609 16 11.4696 16 12V15C16 15.5304 16.2107 16.0391 16.5858 16.4142C16.9609 16.7893 17.4696 17 18 17H19C19.5304 17 20.0391 16.7893 20.4142 16.4142C20.7893 16.0391 21 15.5304 21 15M21 15V17C21 18.0609 20.5786 19.0783 19.8284 19.8284C19.0783 20.5786 18.0609 21 17 21H12" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </span>
    <span class="text-sm md:text-base">Pengaduan Desa</span>
</button>

<!-- 2. MODAL FORM PENGADUAN (Otomatis ikut terbawa saat komponen dipanggil) -->
<div id="pengaduanModal" class="fixed inset-0 z-50 flex items-center justify-end bg-black/60 hidden px-4">
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
        
        <form action="#" method="POST">
            <!-- Nama Lengkap -->
            <div class="mb-4">
                <label class="block text-sm font-bold text-[#172033] mb-1.5 text-start">Nama Lengkap<span class="text-red-500">*</span></label>
                <input type="text" class="w-full border border-gray-200 rounded-xl p-3 focus:ring-2 focus:ring-[#2F855A] outline-none text-sm text-gray-700 bg-white shadow-sm" placeholder="Rafie Firman">
            </div>

            <!-- No. Telp / WhatsApp -->
            <div class="mb-4">
                <label class="block text-sm font-bold text-[#172033] mb-1.5 text-start">No. Telp/WhatsApp <span class="text-red-500">*</span></label>
                <input type="text" class="w-full border border-gray-200 rounded-xl p-3 focus:ring-2 focus:ring-[#2F855A] outline-none text-sm text-gray-700 bg-white shadow-sm" placeholder="+62 811223344556">
            </div>

            <!-- Pesan / Pengaduan -->
            <div class="mb-4">
                <label class="block text-sm font-bold text-[#172033] mb-1.5 text-start">Pengaduan <span class="text-red-500">*</span></label>
                <textarea rows="4" class="w-full border border-gray-200 rounded-xl p-3 focus:ring-2 focus:ring-[#2F855A] outline-none text-sm text-gray-700 bg-white shadow-sm resize-none" placeholder="Tuliskan detail laporan Anda"></textarea>
            </div>

            <!-- Lampiran dengan Pratinjau Kotak File SVG -->
            <div class="mb-6">
                <label class="block text-sm font-bold text-[#172033] mb-1.5 text-start">Lampiran</label>
                <label class="border border-dashed border-gray-300 rounded-2xl p-4 text-center relative bg-gray-50/50 hover:bg-gray-50 transition-colors flex flex-col items-center justify-center cursor-pointer block">
                    <!-- Tombol Hapus File di Pojok Kanan Atas Box -->
                    <button type="button" class="absolute top-3 right-3 text-gray-400 hover:text-red-500 text-sm font-bold">&times;</button>
                    
                    <!-- Input file asli yang disembunyikan tapi aktif -->
                    <input type="file" id="fileInput" class="absolute inset-0 opacity-0 cursor-pointer w-full h-full" accept="image/*,.pdf">

                    <!-- Tampilan Ikon dan Teks di dalam Box -->
                    <div class="flex flex-col items-center justify-center py-2 pointer-events-none">
                        <svg class="w-8 h-8 text-gray-700 mb-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                        </svg>
                        <p id="fileName" class="text-sm font-bold text-gray-800">Pilih foto atau dokumen bukti</p>
                        <p class="text-xs text-gray-400 mt-0.5">Format: JPG, PNG, atau PDF (Maks. 5MB)</p>
                    </div>
                </label>
            </div>

            <!-- Tombol Kirim dengan Ikon SVG Send di Kanan Bawah -->
            <div class="flex justify-end">
                <button type="button" class="bg-[#2F855A] hover:bg-green-700 text-white font-semibold px-6 py-3 rounded-xl transition-colors flex items-center gap-2 shadow-md">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="22" y1="2" x2="11" y2="13"></line>
                        <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                    </svg>
                    Kirim
                </button>
            </div>
        </form>
    </div>
</div>