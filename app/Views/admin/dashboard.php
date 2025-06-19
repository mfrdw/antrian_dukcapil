<?= $this->extend('template/header') ?>
<?= $this->section('content') ?>


<style>
body {
    background-color: #f8f9fa;
}

.stat-card {
    border-radius: 1rem;
    padding: 1.5rem;
    color: white;
}

.loket-card {
    border-left: 5px solid #0d6efd;
    border-radius: 0.75rem;
    padding: 1rem;
    background-color: white;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
}

.table th,
.table td {
    vertical-align: middle;
}
</style>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12">
                <div class="home-tab">
                    <div class="container py-4">
                        <h2 class="mb-4 text-primary fw-bold">Dashboard Antrian - DISDUKCAPIL Kab. Lamandau</h2>

                        <!-- Statistik Ringkasan -->
                        <div class="row g-3 mb-4">
                            <div class="col-md-3">
                                <div class="stat-card bg-primary">
                                    <h5>Total Antrian Hari Ini</h5>
                                    <h2>126</h2>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="stat-card bg-success">
                                    <h5>Sudah Dipanggil</h5>
                                    <h2>97</h2>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="stat-card bg-warning">
                                    <h5>Menunggu</h5>
                                    <h2>21</h2>
                                </div>
                            </div>
                            <!-- <div class="col-md-3">
                                <div class="stat-card bg-danger">
                                    <h5>Tidak Hadir</h5>
                                    <h2>8</h2>
                                </div>
                            </div> -->
                        </div>

                        <!-- Grafik Antrian Harian -->
                        <div class="card mb-4">
                            <div class="card-header bg-info text-white">Grafik Antrian 7 Hari Terakhir</div>
                            <div class="card-body">
                                <canvas id="chartAntrian" height="100"></canvas>
                            </div>
                        </div>

                        <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const ctx = document.getElementById('chartAntrian').getContext('2d');
                            if (ctx) {
                                new Chart(ctx, {
                                    type: 'bar',
                                    data: {
                                        labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
                                        datasets: [{
                                            label: 'Jumlah Antrian',
                                            data: [23, 45, 30, 51, 40, 20, 10],
                                            backgroundColor: 'rgba(13, 110, 253, 0.8)',
                                            borderRadius: 6
                                        }]
                                    },
                                    options: {
                                        responsive: true,
                                        maintainAspectRatio: false,
                                        scales: {
                                            y: {
                                                beginAtZero: true,
                                                ticks: {
                                                    stepSize: 10
                                                }
                                            }
                                        },
                                        plugins: {
                                            legend: {
                                                display: false
                                            },
                                            tooltip: {
                                                enabled: true
                                            }
                                        }
                                    }
                                });
                            } else {
                                console.error('Canvas grafik tidak ditemukan.');
                            }
                        });
                        </script>


                        <!-- Status Loket -->
                        <div class="row g-3 mb-4">
                            <div class="col-md-4">
                                <div class="loket-card">
                                    <h5 class="fw-bold">Loket 1</h5>
                                    <p>Status: <span class="badge bg-success">Aktif</span></p>
                                    <p>No Antrian: <strong>A012</strong></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="loket-card">
                                    <h5 class="fw-bold">Loket 2</h5>
                                    <p>Status: <span class="badge bg-secondary">Idle</span></p>
                                    <p>No Antrian: <strong>-</strong></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="loket-card">
                                    <h5 class="fw-bold">Loket 3</h5>
                                    <p>Status: <span class="badge bg-danger">Offline</span></p>
                                    <p>No Antrian: <strong>-</strong></p>
                                </div>
                            </div>
                        </div>

                        <!-- Daftar Antrian Hari Ini -->
                        <div class="card mb-4">
                            <div class="card-header bg-primary text-white">
                                Daftar Antrian Hari Ini
                            </div>
                            <div class="card-body p-0">
                                <div style="overflow-x: auto">
                                    <table class="table table-striped m-0">
                                        <thead>
                                            <tr>
                                                <th style="width: 60px">No</th>
                                                <th style="width: 150px">No Antrian</th>
                                                <th style="width: 180px">Layanan</th>
                                                <th style="width: 150px">Loket</th>
                                                <th style="width: 180px">Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>A005</td>
                                                <td>Pindah Domisili</td>
                                                <td>Loket 6</td>
                                                <td><span class="badge bg-warning">Menunggu</span></td>
                                                <td><button class="btn btn-sm btn-success"><i
                                                            class="fas fa-volume-up"></i> Panggil</button></td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>A004</td>
                                                <td>Kartu Keluarga</td>
                                                <td>Loket 3</td>
                                                <td><span class="badge bg-success">Dilayani</span></td>
                                                <td><button class="btn btn-sm btn-outline-secondary"><i
                                                            class="fas fa-redo"></i> Ulang</button></td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>A003</td>
                                                <td>Akta Kelahiran</td>
                                                <td>Loket 2</td>
                                                <td><span class="badge bg-secondary">Selesai</span></td>
                                                <td><button class="btn btn-sm btn-outline-info"><i
                                                            class="fas fa-check"></i> Selesai</button></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Pengumuman -->
                        <div class="card">
                            <div class="card-header bg-dark text-white">
                                Pengumuman dan Informasi Operasional
                            </div>
                            <div class="card-body">
                                <ul>
                                    <li>Pelayanan hari ini dibuka hingga pukul 14:30.</li>
                                    <li>Silakan ambil nomor antrian sebelum pukul 14:00.</li>
                                    <li>Gunakan masker selama berada di area layanan.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    // Contoh data dummy grafik
    const ctx = document.getElementById('chartAntrian');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
            datasets: [{
                label: 'Jumlah Antrian',
                data: [23, 45, 30, 51, 40, 20, 10],
                backgroundColor: '#0d6efd'
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    enabled: true
                }
            }
        }
    });
    </script>
    <?= $this->endSection() ?>