document.addEventListener("DOMContentLoaded", function() {
    
    // --- 1. GRAFIK KELOMPOK UMUR (Batang Tunggal Dinamis dari Database) ---
    const canvasUmur = document.getElementById('piramidaUmurChart');
    if (canvasUmur) {
        const ctxUmur = canvasUmur.getContext('2d');

        const labelsUmur = typeof dataUmurDatabase !== 'undefined' ? dataUmurDatabase.map(item => item.rentang + ' Tahun') : [];
        const valuesUmur = typeof dataUmurDatabase !== 'undefined' ? dataUmurDatabase.map(item => parseInt(item.jumlah)) : [];

        // Logika otomatis mencari nilai tertinggi dan terendah
        if (typeof dataUmurDatabase !== 'undefined' && dataUmurDatabase.length > 0) {
            let maxObj = dataUmurDatabase.reduce((prev, current) => (parseInt(prev.jumlah) > parseInt(current.jumlah)) ? prev : current);
            let minObj = dataUmurDatabase.reduce((prev, current) => (parseInt(prev.jumlah) < parseInt(current.jumlah)) ? prev : current);

            const summaryEl = document.getElementById('summaryUmurText');
            if (summaryEl) {
                summaryEl.innerHTML = `Berdasarkan data distribusi, kelompok umur dengan jumlah penduduk <strong>tertinggi</strong> berada pada rentang <strong>${maxObj.rentang} Tahun</strong> dengan total <strong>${parseInt(maxObj.jumlah).toLocaleString('id-ID')} jiwa</strong>. Sedangkan jumlah penduduk <strong>terendah</strong> berada pada kelompok umur <strong>${minObj.rentang} Tahun</strong> dengan total <strong>${parseInt(minObj.jumlah).toLocaleString('id-ID')} jiwa</strong>.`;
            }
        }

        new Chart(ctxUmur, {
            type: 'bar',
            data: {
                labels: labelsUmur,
                datasets: [{
                    label: 'Jumlah Penduduk',
                    data: valuesUmur,
                    backgroundColor: '#2F855A',
                    borderRadius: 4,
                    barThickness: 20,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                indexAxis: 'y', // Membuat bar menjadi horizontal agar rapi
                scales: {
                    x: {
                        beginAtZero: true,
                        grid: { color: '#f1f5f9' },
                        ticks: { font: { size: 11 } }
                    },
                    y: {
                        grid: { display: false },
                        ticks: { font: { size: 11, weight: '500' } }
                    }
                },
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            title: function(context) { return 'Kelompok Umur: ' + context[0].label; },
                            label: function(context) {
                                return ' Jumlah: ' + context.raw.toLocaleString('id-ID') + ' Jiwa';
                            }
                        }
                    }
                }
            }
        });
    }

    // --- 2. GRAFIK BERDASARKAN PENDIDIKAN (Dinamis dari Database) ---
    const canvasPendidikan = document.getElementById('pendidikanChart');
    if (canvasPendidikan) {
        const ctxPendidikan = canvasPendidikan.getContext('2d');

        const labelsPendidikan = typeof dataPendidikanDatabase !== 'undefined' ? dataPendidikanDatabase.map(item => item.tingkat) : [];
        const valuesPendidikan = typeof dataPendidikanDatabase !== 'undefined' ? dataPendidikanDatabase.map(item => parseInt(item.jumlah)) : [];

        // Logika otomatis mencari tingkat pendidikan dengan jumlah terbanyak untuk kartu ringkasan
        if (typeof dataPendidikanDatabase !== 'undefined' && dataPendidikanDatabase.length > 0) {
            let maxPendidikan = dataPendidikanDatabase.reduce((prev, current) => (parseInt(prev.jumlah) > parseInt(current.jumlah)) ? prev : current);

            const descEl = document.getElementById('summaryPendidikanDesc');
            const nilaiEl = document.getElementById('summaryPendidikanNilai');

            if (descEl && nilaiEl) {
                descEl.innerHTML = `Sebagian besar warga Desa Padangan berada pada tingkat pendidikan <strong>${maxPendidikan.tingkat}</strong> dengan jumlah`;
                nilaiEl.innerText = parseInt(maxPendidikan.jumlah).toLocaleString('id-ID');
            }
        }

        new Chart(ctxPendidikan, {
            type: 'bar',
            data: {
                labels: labelsPendidikan,
                datasets: [{
                    label: 'Jumlah Penduduk',
                    data: valuesPendidikan,
                    backgroundColor: '#2F855A',
                    borderRadius: 4,
                    barThickness: 18,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                indexAxis: 'y',
                scales: {
                    x: {
                        beginAtZero: true,
                        ticks: { stepSize: 100, font: { size: 11 } },
                        grid: { color: '#f1f5f9' }
                    },
                    y: {
                        grid: { display: false },
                        ticks: { font: { size: 12, weight: '500' }, color: '#374151' }
                    }
                },
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: function(context) { return ' Jumlah: ' + context.raw.toLocaleString('id-ID') + ' Jiwa'; }
                        }
                    }
                }
            }
        });
    }

    // --- 3. GRAFIK JENIS KELAMIN ---
    const canvasJK = document.getElementById('jenisKelaminChart');
    if (canvasJK) {
        const ctxJK = canvasJK.getContext('2d');

        // Ambil nilai langsung dari database, default ke 0 jika kosong
        const jumlahLaki = typeof dataKependudukanDatabase !== 'undefined' ? parseInt(dataKependudukanDatabase.laki_laki || 0) : 0;
        const jumlahPerempuan = typeof dataKependudukanDatabase !== 'undefined' ? parseInt(dataKependudukanDatabase.perempuan || 0) : 0;

        new Chart(ctxJK, {
            type: 'bar',
            data: {
                labels: ['Laki-laki', 'Perempuan'],
                datasets: [{
                    label: 'Jumlah Jiwa',
                    data: [jumlahLaki, jumlahPerempuan],
                    backgroundColor: [
                        '#2563EB', // Biru untuk Laki-laki
                        '#2F855A'  // Hijau untuk Perempuan
                    ],
                    borderRadius: 6,
                    barThickness: 14,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                indexAxis: 'y',
                scales: {
                    x: {
                        beginAtZero: true,
                        grid: { display: false },
                        ticks: { display: false }
                    },
                    y: {
                        grid: { display: false },
                        ticks: {
                            font: { size: 12, weight: '600' },
                            color: '#374151'
                        }
                    }
                },
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let total = jumlahLaki + jumlahPerempuan;
                                let value = context.raw;
                                let percentage = total > 0 ? ((value / total) * 100).toFixed(1) : 0;
                                return ' ' + value.toLocaleString('id-ID') + ' Jiwa (' + percentage + '%)';
                            }
                        }
                    }
                }
            }
        });
    }
    
});