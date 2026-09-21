document.addEventListener("DOMContentLoaded", function() {
    
    // --- 1. GRAFIK KELOMPOK UMUR ---
    const canvasUmur = document.getElementById('piramidaUmurChart');
    if (canvasUmur) {
        const ctxUmur = canvasUmur.getContext('2d');
        const labelsUmur = ['0-4', '5-9', '10-14', '15-19', '20-24', '25-29', '30-34', '35-39', '40-44', '45-49', '50-54', '55-59', '60-64', '65+'];

        new Chart(ctxUmur, {
            type: 'bar',
            data: {
                labels: labelsUmur,
                datasets: [
                    {
                        label: 'Laki-laki',
                        data: [-180, -211, -280, -299, -299, -296, -285, -270, -260, -220, -190, -160, -120, -80],
                        backgroundColor: '#2F855A',
                        borderRadius: 2,
                        barThickness: 16,
                    },
                    {
                        label: 'Perempuan',
                        data: [246, 277, 299, 299, 299, 299, 299, 299, 297, 266, 236, 206, 171, 141],
                        backgroundColor: '#2563EB',
                        borderRadius: 2,
                        barThickness: 16,
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                indexAxis: 'y',
                scales: {
                    x: {
                        stacked: false,
                        min: -300,
                        max: 300,
                        ticks: {
                            callback: function(value) { return Math.abs(value); },
                            stepSize: 50,
                            font: { size: 11 }
                        },
                        grid: { color: '#f1f5f9' }
                    },
                    y: {
                        stacked: true,
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
                                let value = Math.abs(context.raw);
                                return ' ' + context.dataset.label + ': ' + value + ' Orang';
                            }
                        }
                    }
                }
            }
        });
    }

    // --- 2. GRAFIK BERDASARKAN PENDIDIKAN ---
    const canvasPendidikan = document.getElementById('pendidikanChart');
    if (canvasPendidikan) {
        const ctxPendidikan = canvasPendidikan.getContext('2d');

        new Chart(ctxPendidikan, {
            type: 'bar',
            data: {
                labels: ['Belum/Tidak Sekolah', 'SD', 'SMP', 'SMA', 'Diploma', 'S1', 'S2', 'S3'],
                datasets: [{
                    label: 'Jumlah Penduduk',
                    data: [684, 491, 405, 340, 96, 132, 12, 0],
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
                        max: 700,
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
                            label: function(context) { return ' Jumlah: ' + context.raw + ' Jiwa'; }
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

        new Chart(ctxJK, {
            type: 'bar',
            data: {
                labels: ['Laki-laki', 'Perempuan'],
                datasets: [{
                    label: 'Jumlah Jiwa',
                    data: [3291, 3484],
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
                indexAxis: 'y', // Membuat bar horizontal
                scales: {
                    x: {
                        beginAtZero: true,
                        max: 4000,
                        grid: { display: false },
                        ticks: { display: false } // Sembunyikan angka sumbu X agar bersih
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
                                let total = 6775;
                                let value = context.raw;
                                let percentage = ((value / total) * 100).toFixed(1);
                                return ' ' + value.toLocaleString('id-ID') + ' Jiwa (' + percentage + '%)';
                            }
                        }
                    }
                }
            }
        });
    }
    
});