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
<div id="pengaduanModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 hidden px-4">
    <div class="bg-white w-full max-w-lg rounded-2xl shadow-2xl p-6 relative">
        <button onclick="toggleModal('pengaduanModal')" class="absolute top-4 right-4 text-gray-400 hover:text-red-500 text-2xl leading-none">&times;</button>
        <h3 class="text-2xl font-bold mb-6 text-center text-[#172033]">Pengaduan Desa</h3>
        
        <form action="#" method="POST">
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                <input type="text" class="w-full border border-gray-300 rounded-xl p-3 focus:ring-2 focus:ring-[#2F855A] outline-none text-sm" placeholder="Masukkan nama Anda">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">NIK (Nomor Induk Kependudukan)</label>
                <input type="number" class="w-full border border-gray-300 rounded-xl p-3 focus:ring-2 focus:ring-[#2F855A] outline-none text-sm" placeholder="16 digit NIK">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Pesan / Laporan</label>
                <textarea rows="4" class="w-full border border-gray-300 rounded-xl p-3 focus:ring-2 focus:ring-[#2F855A] outline-none text-sm" placeholder="Tuliskan detail laporan Anda"></textarea>
            </div>
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-1">Unggah Bukti Foto (Opsional)</label>
                <input type="file" class="w-full border border-gray-300 rounded-xl file:mr-4 file:py-2 file:px-4 file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-[#2F855A] hover:file:bg-green-100 text-sm">
            </div>
            <button type="button" class="w-full bg-[#2F855A] hover:bg-green-700 text-white font-bold py-3 rounded-xl transition-colors">
                Kirim Laporan
            </button>
        </form>
    </div>
</div>