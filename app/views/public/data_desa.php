
<?php include '../app/views/layouts/header.php'; ?>

<!-- HEADER HALAMAN -->
<section class="bg-[#F7F9FC] pt-32 pb-12 px-4 md:px-8 lg:px-[120px] relative border-b border-gray-200">
    <div class="max-w-3xl">
        <h1 class="text-3xl md:text-5xl font-extrabold text-[#172033] mb-4">Data Desa</h1>
        <p class="text-gray-500 text-sm md:text-base">Menyajikan data statistik demografi penduduk Desa Padangan meliputi jumlah penduduk, usia, pekerjaan, pendidikan, status perkawinan, dan agama.</p>
    </div>
</section>

<!-- MAIN CONTENT WRAPPER -->
<main class="px-4 md:px-8 lg:px-[120px] py-12 space-y-16">

    <!-- NAVIGASI TAB MENU STATISTIK -->
    <div class="flex justify-start lg:justify-center overflow-x-auto border-b border-gray-200 gap-6 md:gap-10 text-sm md:text-base font-semibold whitespace-nowrap hide-scrollbar px-4 lg:px-0">
        
        <a href="#kependudukan" class="pb-4 border-b-2 border-[#2F855A] text-[#2F855A] flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            Kependudukan
        </a>
        <a href="#umur" class="pb-4 border-b-2 border-transparent text-gray-500 hover:text-[#2F855A] flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            Umur
        </a>
        <a href="#pekerjaan" class="pb-4 border-b-2 border-transparent text-gray-500 hover:text-[#2F855A] flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
            Pekerjaan
        </a>
        <a href="#pendidikan" class="pb-4 border-b-2 border-transparent text-gray-500 hover:text-[#2F855A] flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path></svg>
            Pendidikan
        </a>
        <a href="#perkawinan" class="pb-4 border-b-2 border-transparent text-gray-500 hover:text-[#2F855A] flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
            Perkawinan
        </a>
        <a href="#agama" class="pb-4 border-b-2 border-transparent text-gray-500 hover:text-[#2F855A] flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"></path></svg>
            Agama
        </a>
    </div>

    <!-- 1. DATA KEPENDUDUKAN -->
    <section id="kependudukan" class="scroll-mt-32">
        <h2 class="text-2xl font-bold text-[#172033] mb-6">Data Kependudukan</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Total Penduduk -->
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4">
                <div class="p-4 bg-green-50 rounded-xl text-[#2F855A]">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500 mb-1">Total Penduduk</p>
                    <h3 class="text-3xl font-bold text-[#172033]">6.775 <span class="text-base font-medium text-gray-500">Jiwa</span></h3>
                </div>
            </div>

            <!-- Kepala Keluarga -->
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4">
                <div class="p-4 bg-green-50 rounded-xl text-[#2F855A]">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500 mb-1">Kepala Keluarga</p>
                    <h3 class="text-3xl font-bold text-[#172033]">1.382 <span class="text-base font-medium text-gray-500">Keluarga</span></h3>
                </div>
            </div>

            <!-- Jenis Kelamin Chart Card -->
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm lg:col-span-2 flex flex-col justify-between">
                <h4 class="text-sm text-gray-500 font-semibold mb-2">Jenis Kelamin</h4>
                
                <!-- Wadah Canvas Chart.js -->
                <div class="w-full h-32 relative">
                    <canvas id="jenisKelaminChart"></canvas>
                </div>
            </div>
        </div>
    </section>

    <!-- 2. KELOMPOK UMUR -->
    <section id="umur" class="scroll-mt-32">
        <h2 class="text-2xl font-bold text-[#172033] mb-1">Kelompok Umur</h2>
        <p class="text-gray-500 text-sm mb-6">Distribusi penduduk Desa Padangan berdasarkan umur dan jenis kelamin</p>
        
        <div class="bg-white p-6 md:p-10 rounded-3xl border border-gray-100 shadow-sm">
            
            <!-- Wadah Canvas Chart.js -->
            <div class="w-full max-w-4xl mx-auto h-[420px] md:h-[480px] mb-8 relative">
                <canvas id="piramidaUmurChart"></canvas>
            </div>

            <!-- Legend Manual (Indikator Laki-laki & Perempuan) -->
            <div class="flex justify-center items-center gap-8 mb-10 text-sm font-semibold text-gray-700">
                <div class="flex items-center gap-2">
                    <span class="w-3.5 h-3.5 bg-[#2F855A] rounded-full"></span> Laki-laki
                </div>
                <div class="flex items-center gap-2">
                    <span class="w-3.5 h-3.5 bg-[#2563EB] rounded-full"></span> Perempuan
                </div>
            </div>

            <!-- Summary Text Sesuai Desain -->
            <div class="space-y-4">
                <div class="bg-[#F7F9FC] p-5 rounded-2xl border border-gray-100 text-sm md:text-base text-gray-700 leading-relaxed">
                    <p>Untuk jenis kelamin <strong>laki-laki</strong>, kelompok umur <strong>15–19</strong>, dan <strong>20–24</strong> adalah kelompok umur tertinggi dengan jumlah <strong>299 orang atau 4.41%</strong>. Sedangkan, kelompok umur <strong>65+</strong> adalah yang terendah dengan jumlah <strong>80 orang atau 1.18%</strong>.</p>
                </div>
                <div class="bg-[#F7F9FC] p-5 rounded-2xl border border-gray-100 text-sm md:text-base text-gray-700 leading-relaxed">
                    <p>Untuk jenis kelamin <strong>perempuan</strong>, kelompok umur <strong>10–14, 15–19, 20–24, 25–29, 30–34, dan 35–39</strong> adalah kelompok umur tertinggi dengan jumlah <strong>299 orang atau 4.41%</strong>. Sedangkan, kelompok umur <strong>65+</strong> adalah yang terendah dengan jumlah <strong>141 orang atau 2.08%</strong>.</p>
                </div>
            </div>
        </div>
    </section>

   <!-- 3. BERDASARKAN PENDIDIKAN -->
    <section id="pendidikan" class="scroll-mt-32">
        <h2 class="text-2xl font-bold text-[#172033] mb-1">Berdasarkan Pendidikan</h2>
        <p class="text-gray-500 text-sm mb-6">Tingkat pendidikan warga Desa Padangan</p>

        <div class="bg-white p-6 md:p-10 rounded-3xl border border-gray-100 shadow-sm grid grid-cols-1 lg:grid-cols-4 gap-8 items-center">
            
            <!-- Wadah Canvas Chart.js (Mengambil 3 kolom di layar besar) -->
            <div class="lg:col-span-3 h-[360px] md:h-[400px] relative">
                <canvas id="pendidikanChart"></canvas>
            </div>

            <!-- Kartu Ringkasan Informasi (Mengambil 1 kolom di kanan) -->
            <div class="bg-[#2F855A]/10 p-6 rounded-2xl border border-gray-100 flex flex-col items-center text-center justify-center h-full">
                <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center shadow-sm text-[#2F855A] mb-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path></svg>
                </div>
                <p class="text-xs md:text-sm text-gray-600 leading-relaxed mb-3">
                    Sebagian besar warga Desa Padangan belum/tidak bersekolah dengan jumlah
                </p>
                <h4 class="text-2xl font-extrabold text-[#2F855A]">684</h4>
                <span class="text-sm font-bold text-[#172033]">Jiwa</span>
            </div>

        </div>
    </section>

    <!-- 4. BERDASARKAN PEKERJAAN -->
    <section id="pekerjaan" class="scroll-mt-32">
        <h2 class="text-2xl font-bold text-[#172033] mb-2">Berdasarkan Pekerjaan</h2>
        <p class="text-gray-500 text-sm mb-6">Jumlah penduduk berdasarkan profesi / pekerjaan utama.</p>

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
            <!-- Pekerjaan Cards -->
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm text-center flex flex-col items-center justify-center">
                <div class="w-10 h-10 bg-green-50 rounded-lg text-[#2F855A] flex items-center justify-center mb-4">
                    <svg width="30" height="25" viewBox="0 0 30 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12.1667 10.8333L26.8333 12.0333C27.1633 12.0982 27.4566 12.2854 27.6544 12.5574C27.8522 12.8294 27.94 13.1661 27.9 13.5L27.0133 19.044C26.9632 19.3573 26.803 19.6424 26.5616 19.8481C26.3201 20.0539 26.0132 20.1668 25.696 20.1667H25.5M25.5 20.1667C25.5 21.6394 24.3061 22.8333 22.8333 22.8333C21.3606 22.8333 20.1667 21.6394 20.1667 20.1667M25.5 20.1667C25.5 18.6939 24.3061 17.5 22.8333 17.5C21.3606 17.5 20.1667 18.6939 20.1667 20.1667M20.1667 20.1667H13.5M22.8333 2.83333C22.4797 2.83333 22.1406 2.97381 21.8905 3.22386C21.6405 3.47391 21.5 3.81304 21.5 4.16667V11.5973M2.83333 1.5H13.672C13.9938 1.50018 14.3048 1.61678 14.5474 1.82826C14.79 2.03975 14.9479 2.33185 14.992 2.65067L16.1667 11.1613M4.16667 10.8333V1.5M8.16667 16.1667H8.18M9.5 9.63333V1.5M14.8333 16.1667C14.8333 19.8486 11.8486 22.8333 8.16667 22.8333C4.48477 22.8333 1.5 19.8486 1.5 16.1667C1.5 12.4848 4.48477 9.5 8.16667 9.5C11.8486 9.5 14.8333 12.4848 14.8333 16.1667Z" stroke="#2F855A" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-[#172033]">892</h3>
                <p class="text-sm text-gray-500 mt-1">Petani</p>
            </div>
            
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm text-center flex flex-col items-center justify-center">
                <div class="w-10 h-10 bg-green-50 rounded-lg text-[#2F855A] flex items-center justify-center mb-4">
                    <svg width="30" height="28" viewBox="0 0 30 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12.0002 13.333H17.3335M12.0002 25.333V21.333C12.0002 20.8583 12.127 20.3923 12.3673 19.983C12.6076 19.5737 12.9529 19.2359 13.3674 19.0046C13.7819 18.7733 14.2506 18.6569 14.7251 18.6672C15.1997 18.6776 15.6628 18.8145 16.0668 19.0637M12.0002 7.99967H17.3335M20.0002 22.6663H28.0002M22.6668 6.66634H25.3335C26.0407 6.66634 26.719 6.94729 27.2191 7.44739C27.7192 7.94749 28.0002 8.62576 28.0002 9.33301V15.1397M24.0002 18.6663V26.6663M6.66683 10.6663H4.00016C3.29292 10.6663 2.61464 10.9473 2.11454 11.4474C1.61445 11.9475 1.3335 12.6258 1.3335 13.333V22.6663C1.3335 23.3736 1.61445 24.0519 2.11454 24.552C2.61464 25.0521 3.29292 25.333 4.00016 25.333H15.3802M6.66683 25.333V3.99967C6.66683 3.29243 6.94778 2.61415 7.44788 2.11406C7.94798 1.61396 8.62625 1.33301 9.3335 1.33301H20.0002C20.7074 1.33301 21.3857 1.61396 21.8858 2.11406C22.3859 2.61415 22.6668 3.29243 22.6668 3.99967V13.501" stroke="#2F855A" stroke-width="2.66667" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-[#172033]">194</h3>
                <p class="text-sm text-gray-500 mt-1">PNS</p>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm text-center flex flex-col items-center justify-center">
                <div class="w-10 h-10 bg-green-50 rounded-lg text-[#2F855A] flex items-center justify-center mb-4">
                    <svg width="30" height="28" viewBox="0 0 30 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18.6681 26.6663V19.9997C18.6681 19.6461 18.5276 19.3069 18.2775 19.0569C18.0275 18.8068 17.6884 18.6663 17.3347 18.6663H12.0014C11.6478 18.6663 11.3086 18.8068 11.0586 19.0569C10.8085 19.3069 10.6681 19.6461 10.6681 19.9997V26.6663M22.3667 12.413C22.0888 12.1469 21.7189 11.9984 21.3341 11.9984C20.9493 11.9984 20.5794 12.1469 20.3014 12.413C19.6814 13.0044 18.8575 13.3343 18.0007 13.3343C17.1439 13.3343 16.3201 13.0044 15.7001 12.413C15.4222 12.1473 15.0525 11.999 14.6681 11.999C14.2836 11.999 13.914 12.1473 13.6361 12.413C13.016 13.0048 12.1918 13.3349 11.3347 13.3349C10.4776 13.3349 9.65346 13.0048 9.0334 12.413C8.75545 12.1469 8.38552 11.9984 8.00073 11.9984C7.61595 11.9984 7.24602 12.1469 6.96807 12.413C6.36919 12.9845 5.5791 13.3127 4.75157 13.3337C3.92404 13.3548 3.11829 13.0672 2.49114 12.5268C1.864 11.9865 1.46033 11.2322 1.35871 10.4107C1.2571 9.58913 1.4648 8.75917 1.9414 8.08234L5.7934 2.50367C6.03781 2.14302 6.36686 1.84775 6.75177 1.64367C7.13668 1.43959 7.56573 1.33293 8.0014 1.33301H21.3347C21.7691 1.33284 22.197 1.4388 22.5811 1.64166C22.9652 1.84452 23.294 2.13815 23.5387 2.49701L27.3987 8.08634C27.8754 8.76371 28.0829 9.5943 27.9806 10.4163C27.8784 11.2382 27.4738 11.9927 26.8456 12.5326C26.2175 13.0725 25.4108 13.3592 24.5828 13.3369C23.7548 13.3145 22.9648 12.9847 22.3667 12.4117M4.0014 13.2663V23.9997C4.0014 24.7069 4.28235 25.3852 4.78245 25.8853C5.28255 26.3854 5.96082 26.6663 6.66807 26.6663H22.6681C23.3753 26.6663 24.0536 26.3854 24.5537 25.8853C25.0538 25.3852 25.3347 24.7069 25.3347 23.9997V13.2663" stroke="#2F855A" stroke-width="2.66667" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-[#172033]">452</h3>
                <p class="text-sm text-gray-500 mt-1">Wiraswasta</p>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm text-center flex flex-col items-center justify-center">
                <div class="w-10 h-10 bg-green-50 rounded-lg text-[#2F855A] flex items-center justify-center mb-4">
                    <svg width="27" height="27" viewBox="0 0 27 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M13.3335 18.6663H13.3468M18.6668 18.6663H18.6802M8.00016 18.6663H8.0135M1.3335 22.6663C1.3335 23.3736 1.61445 24.0519 2.11454 24.552C2.61464 25.0521 3.29292 25.333 4.00016 25.333H22.6668C23.3741 25.333 24.0524 25.0521 24.5524 24.552C25.0525 24.0519 25.3335 23.3736 25.3335 22.6663V8.66634C25.3336 8.54674 25.3016 8.42931 25.2407 8.32636C25.1798 8.22341 25.0924 8.13873 24.9876 8.08119C24.8827 8.02365 24.7643 7.99538 24.6448 7.99934C24.5252 8.00329 24.409 8.03933 24.3082 8.10367L18.3588 11.8957C18.258 11.96 18.1417 11.9961 18.0222 12C17.9027 12.004 17.7843 11.9757 17.6794 11.9182C17.5746 11.8606 17.4872 11.7759 17.4263 11.673C17.3654 11.57 17.3334 11.4526 17.3335 11.333V8.66634C17.3336 8.54674 17.3016 8.42931 17.2407 8.32636C17.1798 8.22341 17.0924 8.13873 16.9876 8.08119C16.8827 8.02365 16.7643 7.99538 16.6448 7.99934C16.5252 8.00329 16.409 8.03933 16.3082 8.10367L10.3602 11.8957C10.2593 11.9604 10.1429 11.9967 10.0232 12.0008C9.90346 12.005 9.78482 11.9768 9.67976 11.9192C9.57469 11.8616 9.48709 11.7768 9.42616 11.6736C9.36523 11.5705 9.33322 11.4528 9.3335 11.333V3.99967C9.3335 3.29243 9.05254 2.61415 8.55245 2.11406C8.05235 1.61396 7.37407 1.33301 6.66683 1.33301H4.00016C3.29292 1.33301 2.61464 1.61396 2.11454 2.11406C1.61445 2.61415 1.3335 3.29243 1.3335 3.99967V22.6663Z" stroke="#2F855A" stroke-width="2.66667" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-[#172033]">296</h3>
                <p class="text-sm text-gray-500 mt-1">Karyawan Swasta</p>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm text-center flex flex-col items-center justify-center">
                <div class="w-10 h-10 bg-green-50 rounded-lg text-[#2F855A] flex items-center justify-center mb-4">
                    <svg width="30" height="22" viewBox="0 0 30 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M27.9986 8.00015V16.0002M6.66526 11.3335V16.0002C6.66526 17.061 7.50811 18.0784 9.0084 18.8286C10.5087 19.5787 12.5435 20.0002 14.6653 20.0002C16.787 20.0002 18.8218 19.5787 20.3221 18.8286C21.8224 18.0784 22.6653 17.061 22.6653 16.0002V11.3335M27.2253 9.22948C27.4639 9.12419 27.6665 8.95118 27.8078 8.73189C27.9492 8.5126 28.0231 8.25667 28.0204 7.9958C28.0177 7.73493 27.9385 7.48058 27.7927 7.26426C27.6468 7.04794 27.4407 6.87916 27.1999 6.77882L15.7719 1.57348C15.4245 1.41502 15.0471 1.33301 14.6653 1.33301C14.2834 1.33301 13.906 1.41502 13.5586 1.57348L2.13192 6.77348C1.89455 6.87745 1.69261 7.04833 1.55081 7.26524C1.40901 7.48214 1.3335 7.73567 1.3335 7.99482C1.3335 8.25396 1.40901 8.50749 1.55081 8.7244C1.69261 8.9413 1.89455 9.11219 2.13192 9.21615L13.5586 14.4268C13.906 14.5853 14.2834 14.6673 14.6653 14.6673C15.0471 14.6673 15.4245 14.5853 15.7719 14.4268L27.2253 9.22948Z" stroke="#2F855A" stroke-width="2.66667" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-[#172033]">1.368</h3>
                <p class="text-sm text-gray-500 mt-1">Pelajar / Mahasiswa</p>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm text-center flex flex-col items-center justify-center">
                <div class="w-10 h-10 bg-green-50 rounded-lg text-[#2F855A] flex items-center justify-center mb-4">
                    <svg width="27" height="28" viewBox="0 0 27 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17.3335 26.667V16.0003C17.3335 15.6467 17.193 15.3076 16.943 15.0575C16.6929 14.8075 16.3538 14.667 16.0002 14.667H10.6668C10.3132 14.667 9.97407 14.8075 9.72402 15.0575C9.47397 15.3076 9.3335 15.6467 9.3335 16.0003V26.667M1.3335 12.0003C1.3334 11.6124 1.41794 11.2291 1.58121 10.8773C1.74449 10.5254 1.98256 10.2134 2.27883 9.96298L11.6122 1.96298C12.0935 1.55619 12.7033 1.33301 13.3335 1.33301C13.9637 1.33301 14.5735 1.55619 15.0548 1.96298L24.3882 9.96298C24.6844 10.2134 24.9225 10.5254 25.0858 10.8773C25.2491 11.2291 25.3336 11.6124 25.3335 12.0003V24.0003C25.3335 24.7076 25.0525 25.3858 24.5524 25.8859C24.0524 26.386 23.3741 26.667 22.6668 26.667H4.00016C3.29292 26.667 2.61464 26.386 2.11454 25.8859C1.61445 25.3858 1.3335 24.7076 1.3335 24.0003V12.0003Z" stroke="#2F855A" stroke-width="2.66667" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-[#172033]">1.100</h3>
                <p class="text-sm text-gray-500 mt-1">Mengurus Rumah Tangga</p>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm text-center flex flex-col items-center justify-center">
                <div class="w-10 h-10 bg-green-50 rounded-lg text-[#2F855A] flex items-center justify-center mb-4">
                    <svg width="30" height="28" viewBox="0 0 30 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1.3335 25.333C1.33365 23.6543 1.73002 21.9993 2.49037 20.5027C3.25072 19.006 4.35358 17.71 5.70926 16.7199C7.06494 15.7299 8.63516 15.0737 10.2922 14.805C11.9493 14.5362 13.6464 14.6623 15.2455 15.173M28.0002 26.6663L25.4668 24.133M18.6668 7.99967C18.6668 11.6816 15.6821 14.6663 12.0002 14.6663C8.31826 14.6663 5.3335 11.6816 5.3335 7.99967C5.3335 4.31778 8.31826 1.33301 12.0002 1.33301C15.6821 1.33301 18.6668 4.31778 18.6668 7.99967ZM26.6668 21.333C26.6668 23.5421 24.876 25.333 22.6668 25.333C20.4577 25.333 18.6668 23.5421 18.6668 21.333C18.6668 19.1239 20.4577 17.333 22.6668 17.333C24.876 17.333 26.6668 19.1239 26.6668 21.333Z" stroke="#2F855A" stroke-width="2.66667" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-[#172033]">402</h3>
                <p class="text-sm text-gray-500 mt-1">Belum / Tidak Bekerja</p>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm text-center flex flex-col items-center justify-center">
                <div class="w-10 h-10 bg-green-50 rounded-lg text-[#2F855A] flex items-center justify-center mb-4">
                    <svg width="32" height="8" viewBox="0 0 32 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="4" cy="4" r="4" fill="#2F855A"/>
                        <circle cx="16" cy="4" r="4" fill="#2F855A"/>
                        <circle cx="28" cy="4" r="4" fill="#2F855A"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-[#172033]">365</h3>
                <p class="text-sm text-gray-500 mt-1">Lainnya</p>
            </div>
        </div>
    </section>

    <!-- 5. STATUS PERKAWINAN -->
    <section id="perkawinan" class="scroll-mt-32">
        <h2 class="text-2xl font-bold text-[#172033] mb-2">Status Perkawinan</h2>
        <p class="text-gray-500 text-sm mb-6">Jumlah penduduk berdasarkan status perkawinan.</p>

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm text-center flex flex-col items-center justify-center">
                <div class="w-10 h-10 bg-green-50 rounded-lg text-[#2F855A] flex items-center justify-center mb-4">
                    <svg width="22" height="27" viewBox="0 0 22 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20.0002 25.333V22.6663C20.0002 21.2519 19.4383 19.8953 18.4381 18.8951C17.4379 17.8949 16.0813 17.333 14.6668 17.333H6.66683C5.25234 17.333 3.89579 17.8949 2.89559 18.8951C1.8954 19.8953 1.3335 21.2519 1.3335 22.6663V25.333M16.0002 6.66634C16.0002 9.61186 13.6123 11.9997 10.6668 11.9997C7.72131 11.9997 5.3335 9.61186 5.3335 6.66634C5.3335 3.72082 7.72131 1.33301 10.6668 1.33301C13.6123 1.33301 16.0002 3.72082 16.0002 6.66634Z" stroke="#2563B8" stroke-width="2.66667" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-[#172033]">1.728</h3>
                <p class="text-sm text-gray-500 mt-1">Belum Kawin</p>
            </div>
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm text-center flex flex-col items-center justify-center">
                <div class="w-10 h-10 bg-green-50 rounded-lg text-[#2F855A] flex items-center justify-center mb-4">
                    <svg width="30" height="26" viewBox="0 0 30 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M15.2122 3.76487L11.4482 7.44754C10.9482 7.94762 10.6674 8.62577 10.6674 9.33288C10.6674 10.04 10.9482 10.7181 11.4482 11.2182C11.9482 11.7181 12.6264 11.999 13.3335 11.999C14.0406 11.999 14.7188 11.7181 15.2188 11.2182L17.4988 8.93821C17.7972 8.63967 18.1515 8.40286 18.5415 8.24128C18.9314 8.07971 19.3494 7.99655 19.7715 7.99655C20.1936 7.99655 20.6116 8.07971 21.0015 8.24128C21.3915 8.40286 21.7458 8.63967 22.0442 8.93821L24.5522 11.4475C25.0521 11.9476 25.3329 12.6258 25.3329 13.3329C25.3329 14.04 25.0521 14.7181 24.5522 15.2182C26.6668 13.1035 28.0002 11.3329 28.0002 8.66621C28.0001 7.18248 27.55 5.73365 26.7093 4.51109C25.8686 3.28853 24.6768 2.34975 23.2914 1.81874C21.9059 1.28773 20.392 1.18947 18.9495 1.53693C17.507 1.8844 16.2039 2.66125 15.2122 3.76487ZM24.5522 15.2182C24.2892 15.4812 23.977 15.6899 23.6333 15.8322C23.2897 15.9746 22.9214 16.0478 22.5495 16.0478C22.1776 16.0478 21.8093 15.9746 21.4656 15.8322C21.1659 15.7081 20.8901 15.5335 20.6501 15.3164M15.2122 3.76487C15.0643 3.90302 14.8695 3.97996 14.6671 3.98021C14.4647 3.98046 14.2697 3.90399 14.1215 3.76621C13.1299 2.66267 11.8269 1.88585 10.3845 1.53834C8.94216 1.19084 7.42833 1.28899 6.04293 1.81983C4.65753 2.35068 3.46573 3.28925 2.62491 4.5116C1.78408 5.73395 1.33379 7.18259 1.3335 8.66621C1.3335 11.7329 3.3335 13.9995 5.3335 15.9995L12.7135 23.1489C12.9575 23.4113 13.252 23.6218 13.5792 23.7679C13.9065 23.914 14.2598 23.9926 14.6181 23.9991C14.9764 24.0056 15.3323 23.9398 15.6646 23.8056C15.9969 23.6714 16.2988 23.4717 16.5522 23.2182C16.8147 22.9553 17.0228 22.6433 17.1646 22.2999C17.3064 21.9566 17.3792 21.5886 17.3787 21.2171C17.3782 20.8456 17.3044 20.4778 17.1617 20.1349C17.0379 19.8374 16.8643 19.5636 16.6487 19.3251M16.6487 19.3251C16.6157 19.2886 16.5817 19.253 16.5468 19.2182C16.5799 19.2548 16.6139 19.2904 16.6487 19.3251ZM16.6487 19.3251C16.8852 19.5607 17.1618 19.7529 17.4658 19.8925C17.8147 20.0527 18.1925 20.1402 18.5763 20.1499C18.96 20.1595 19.3417 20.091 19.6982 19.9486C20.0547 19.8062 20.3785 19.5927 20.6499 19.3213C20.9214 19.0499 21.1348 18.7261 21.2772 18.3696C21.4197 18.0131 21.4881 17.6314 21.4785 17.2476C21.4689 16.8639 21.3813 16.4861 21.2211 16.1372C21.0808 15.8316 20.8873 15.5537 20.6501 15.3164M20.6501 15.3164C20.6165 15.2828 20.5821 15.2501 20.5468 15.2182C20.5804 15.2518 20.6149 15.2846 20.6501 15.3164Z" stroke="#2F855A" stroke-width="2.66667" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-[#172033]">2.164</h3>
                <p class="text-sm text-gray-500 mt-1">Kawin</p>
            </div>
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm text-center flex flex-col items-center justify-center">
                <div class="w-10 h-10 bg-green-50 rounded-lg text-[#2F855A] flex items-center justify-center mb-4">
                    <svg width="30" height="26" viewBox="0 0 30 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M15.2122 3.76621C14.2762 4.82221 13.6788 5.76087 13.3255 6.65421L16.1962 9.52887C16.3211 9.65389 16.3914 9.82343 16.3914 10.0002C16.3914 10.177 16.3211 10.3465 16.1962 10.4715L13.1388 13.5289C13.0138 13.6539 12.9436 13.8234 12.9436 14.0002C12.9436 14.177 13.0138 14.3465 13.1388 14.4715L14.6668 16.0009M15.2122 3.76621C15.0639 3.90399 14.869 3.98046 14.6666 3.98021C14.4642 3.97996 14.2694 3.90302 14.1215 3.76488C13.1297 2.66116 11.8265 1.88428 10.3839 1.53685C8.94126 1.18943 7.4272 1.2878 6.04169 1.81898C4.65617 2.35016 3.46439 3.28915 2.62377 4.51192C1.78316 5.73468 1.33325 7.1837 1.3335 8.66754C1.3335 11.7342 3.3335 14.0009 5.3335 16.0009L12.6775 23.1102C12.9295 23.3924 13.2387 23.6177 13.5845 23.7712C13.9304 23.9247 14.3049 24.0028 14.6832 24.0004C15.0616 23.998 15.435 23.9151 15.7789 23.7573C16.1227 23.5994 16.4291 23.3702 16.6775 23.0849L24.0002 16.0009C26.0002 14.0009 28.0002 11.7209 28.0002 8.66754C28.0001 7.18381 27.55 5.73499 26.7093 4.51243C25.8686 3.28987 24.6768 2.35109 23.2914 1.82007C21.9059 1.28906 20.392 1.1908 18.9495 1.53827C17.507 1.88573 16.2039 2.66258 15.2122 3.76621Z" stroke="#2563B8" stroke-width="2.66667" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-[#172033]">312</h3>
                <p class="text-sm text-gray-500 mt-1">Cerai Hidup</p>
            </div>
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm text-center flex flex-col items-center justify-center">
                <div class="w-10 h-10 bg-green-50 rounded-lg text-[#2F855A] flex items-center justify-center mb-4">
                    <svg width="22" height="30" viewBox="0 0 22 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10.6668 5.33301C10.6668 4.54188 10.9014 3.76853 11.341 3.11073C11.7805 2.45293 12.4052 1.94024 13.1361 1.63749C13.867 1.33474 14.6713 1.25553 15.4472 1.40987C16.2231 1.56421 16.9358 1.94517 17.4953 2.50458C18.0547 3.06399 18.4356 3.77672 18.59 4.55265C18.7443 5.32857 18.6651 6.13284 18.3623 6.86374C18.0596 7.59465 17.5469 8.21936 16.8891 8.65889C16.2313 9.09841 15.458 9.33301 14.6668 9.33301M10.6668 5.33301C10.6668 4.54188 10.4322 3.76853 9.99271 3.11073C9.55318 2.45293 8.92847 1.94024 8.19756 1.63749C7.46666 1.33474 6.66239 1.25553 5.88647 1.40987C5.11054 1.56421 4.39781 1.94517 3.8384 2.50458C3.27899 3.06399 2.89803 3.77672 2.74369 4.55265C2.58935 5.32857 2.66856 6.13284 2.97131 6.86374C3.27406 7.59465 3.78675 8.21936 4.44455 8.65889C5.10235 9.09841 5.8757 9.33301 6.66683 9.33301M10.6668 5.33301V6.66634M14.6668 9.33301C15.458 9.33301 16.2313 9.56761 16.8891 10.0071C17.5469 10.4467 18.0596 11.0714 18.3623 11.8023C18.6651 12.5332 18.7443 13.3374 18.59 14.1134C18.4356 14.8893 18.0547 15.602 17.4953 16.1614C16.9358 16.7208 16.2231 17.1018 15.4472 17.2562C14.6713 17.4105 13.867 17.3313 13.1361 17.0285C12.4052 16.7258 11.7805 16.2131 11.341 15.5553C10.9014 14.8975 10.6668 14.1241 10.6668 13.333M14.6668 9.33301H13.3335M6.66683 9.33301C5.8757 9.33301 5.10235 9.56761 4.44455 10.0071C3.78675 10.4467 3.27406 11.0714 2.97131 11.8023C2.66856 12.5332 2.58935 13.3374 2.74369 14.1134C2.89803 14.8893 3.27899 15.602 3.8384 16.1614C4.39781 16.7208 5.11054 17.1018 5.88647 17.2562C6.66239 17.4105 7.46666 17.3313 8.19756 17.0285C8.92847 16.7258 9.55318 16.2131 9.99271 15.5553C10.4322 14.8975 10.6668 14.1241 10.6668 13.333M6.66683 9.33301H8.00016M10.6668 6.66634C9.19407 6.66634 8.00016 7.86025 8.00016 9.33301M10.6668 6.66634C12.1396 6.66634 13.3335 7.86025 13.3335 9.33301M10.6668 13.333V11.9997M8.00016 9.33301C8.00016 10.8058 9.19407 11.9997 10.6668 11.9997M13.3335 9.33301C13.3335 10.8058 12.1396 11.9997 10.6668 11.9997M10.6668 11.9997V27.9997M10.6668 27.9997C16.2668 27.9997 20.0002 25.777 20.0002 21.333C14.4002 21.333 10.6668 23.5557 10.6668 27.9997ZM10.6668 27.9997C5.06683 27.9997 1.3335 25.777 1.3335 21.333C6.9335 21.333 10.6668 23.5557 10.6668 27.9997Z" stroke="#2F855A" stroke-width="2.66667" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-[#172033]">156</h3>
                <p class="text-sm text-gray-500 mt-1">Cerai Mati</p>
            </div>
        </div>
    </section>

    <!-- 6. BERDASARKAN AGAMA -->
    <section id="agama" class="scroll-mt-32">
        <h2 class="text-2xl font-bold text-[#172033] mb-2">Berdasarkan Agama</h2>
        <p class="text-gray-500 text-sm mb-6">Jumlah penduduk berdasarkan agama yang dianut.</p>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 md:gap-6">
            
            <!-- Islam -->
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm text-center flex flex-col items-center justify-center">
                <div class="w-10 h-10 bg-green-50 rounded-lg text-[#2F855A] flex items-center justify-center mb-4">
                    <svg width="27" height="30" viewBox="0 0 27 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M13.6908 1.33398C13.3372 1.94663 13.2414 2.67467 13.4246 3.35793C13.6078 4.04118 14.0548 4.6237 14.6675 4.97732C15.2801 5.33094 16.0082 5.4267 16.6914 5.24354C17.3747 5.06038 17.9572 4.6133 18.3108 4.00065M16.0002 5.33398V9.33398M6.66683 28.0007H22.6668C23.3741 28.0007 24.0524 27.7197 24.5524 27.2196C25.0525 26.7195 25.3335 26.0412 25.3335 25.334V16.0007C24.4508 14.0047 23.1122 12.33 21.4668 11.1607C19.7668 9.96065 17.8962 9.33398 16.0002 9.33398M16.0002 9.33398C14.1042 9.33398 12.2322 9.96065 10.5335 11.1607C8.89083 12.3313 7.55083 14.006 6.66683 16.0007H25.3335M18.6668 28.0007V24.0007C18.6668 23.2934 18.3859 22.6151 17.8858 22.115C17.3857 21.6149 16.7074 21.334 16.0002 21.334C15.2929 21.334 14.6146 21.6149 14.1145 22.115C13.6144 22.6151 13.3335 23.2934 13.3335 24.0007V28.0007M1.3335 10.6673H6.66683M6.66683 28.0007V6.66732C6.66683 5.63235 6.42586 4.6116 5.96301 3.68589C5.50016 2.76019 4.82814 1.95496 4.00016 1.33398C3.17219 1.95496 2.50017 2.76019 2.03731 3.68589C1.57446 4.6116 1.3335 5.63235 1.3335 6.66732V25.334C1.3335 26.0412 1.61445 26.7195 2.11454 27.2196C2.61464 27.7197 3.29292 28.0007 4.00016 28.0007H6.66683Z" stroke="#2F855A" stroke-width="2.66667" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-[#172033]">4.721</h3>
                <p class="text-sm text-gray-500 mt-1">Islam</p>
            </div>

            <!-- Kristen -->
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm text-center flex flex-col items-center justify-center">
                <div class="w-10 h-10 bg-green-50 rounded-lg text-[#2F855A] flex items-center justify-center mb-4">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                </div>
                <h3 class="text-2xl font-bold text-[#172033]">102</h3>
                <p class="text-sm text-gray-500 mt-1">Kristen</p>
            </div>

            <!-- Katolik -->
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm text-center flex flex-col items-center justify-center">
                <div class="w-10 h-10 bg-green-50 rounded-lg text-[#2F855A] flex items-center justify-center mb-4">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2v20M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"></path></svg>
                </div>
                <h3 class="text-2xl font-bold text-[#172033]">42</h3>
                <p class="text-sm text-gray-500 mt-1">Katolik</p>
            </div>

            <!-- Hindu -->
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm text-center flex flex-col items-center justify-center">
                <div class="w-10 h-10 bg-green-50 rounded-lg text-[#2F855A] flex items-center justify-center mb-4">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
                <h3 class="text-2xl font-bold text-[#172033]">6</h3>
                <p class="text-sm text-gray-500 mt-1">Hindu</p>
            </div>

            <!-- Budha -->
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm text-center flex flex-col items-center justify-center">
                <div class="w-10 h-10 bg-green-50 rounded-lg text-[#2F855A] flex items-center justify-center mb-4">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
                <h3 class="text-2xl font-bold text-[#172033]">3</h3>
                <p class="text-sm text-gray-500 mt-1">Budha</p>
            </div>

        </div>
    </section>

    <script src="assets/js/GrafikChart.js"></script>

</main>

<?php include '../app/views/layouts/footer.php'; ?>