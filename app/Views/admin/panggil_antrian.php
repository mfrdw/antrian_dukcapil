<?= $this->extend('template/header') ?>
<?= $this->section('content') ?>

<style>
/* === STYLING UNTUK TABEL ANTRIAN === */

.table-wrapper {
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    background-color: #fff;
    margin-top: 10px;
}

table.table-custom {
    width: 100%;
    border-collapse: collapse;
    font-size: 0.95rem;
}

.table-custom thead {
    background: linear-gradient(to right, #00c6ff, #0072ff);
    color: #fff;
    position: sticky;
    top: 0;
    z-index: 10;
}

.table-custom th,
.table-custom td {
    padding: 12px 15px;
    text-align: center;
    vertical-align: middle;
}

.table-custom tbody tr:hover {
    background-color: #f3faff;
    transition: background-color 0.3s ease;
}

.table-custom td button {
    min-width: 100px;
}
</style>

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <!-- Kolom Daftar Antrian -->
            <div class="col-12 col-md-5">
                <div class="home-tab">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h4 class="mb-0">Daftar Antrian</h4>
                        </div>
                        <div class="card-body text-center">
                            <?php if (!empty($data_antrian)): ?>
                            <div class="table-wrapper">
                                <table class="table table-custom">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>No Antrian</th>
                                            <th>Panggil Ulang</th>
                                        </tr>
                                    </thead>
                                    <tbody id="antrian-body">
                                        <!-- Diisi oleh JavaScript -->
                                    </tbody>
                                </table>
                            </div>
                            <?php else: ?>
                            <p class="text-center small">Tidak ada antrian untuk hari ini.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kolom Panggil Antrian -->
            <div class="col-12 col-md-7">
                <div class="home-tab">
                    <div class="card">
                        <div class="card-header bg-success text-white">
                            <h4 class="mb-0">Panggil Antrian</h4>
                        </div>
                        <div class="card-body">
                            <?php if (!empty($data_antrian)): ?>
                            <div class="table-wrapper">
                                <table class="table table-custom">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Loket Antrian</th>
                                            <th>No Antrian</th>
                                            <th>Panggil</th>
                                        </tr>
                                    </thead>
                                    <tbody id="antrian2-body">
                                        <!-- Diisi oleh JavaScript -->
                                    </tbody>
                                </table>
                            </div>
                            <?php else: ?>
                            <p class="text-center">Tidak ada antrian untuk hari ini.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../dist/assets/js/jquery-3.6.0.min.js"></script>

    <script>
    function loadAntrian() {
        $.getJSON('/get-antrian', function(data) {
            let rows = '';
            let counter = 1;

            data.forEach(function(antrian, index) {
                rows += `
                <tr>
                    <td>${counter++}</td>
                    <td>${antrian.no_antri}</td>
                    <td>`;

                if (index < 5) {
                    rows += `
                    <button class="btn btn-warning btn-sm mt-2" onclick="playAudio(this, '${antrian.no_antri}')">
                        <i class="fas fa-redo"></i>
                    </button>`;
                }

                rows += `</td></tr>`;
            });

            $('#antrian-body').html(rows);
        });
    }

    // Fungsi untuk memainkan audio noAntri + role_loket
    function playAudio(button, noAntri) {
        const originalHTML = button.innerHTML;
        button.innerHTML = `
        <span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span> Memutar...`;
        button.disabled = true;

        fetch('/get-role-loket')
            .then(response => response.json())
            .then(data => {
                if (data.status !== 'success') {
                    console.error('Gagal mengambil role_loket dari session:', data.message);
                    resetButton();
                    return;
                }

                const roleLoket = data.role_loket;
                const audioAntri = new Audio(`../dist/assets/audio/${noAntri}.mp3`);
                const audioLoket = new Audio(`../dist/assets/audio/${roleLoket}.mp3`);

                audioAntri.play();
                audioAntri.onended = function() {
                    audioLoket.play();
                    audioLoket.onended = resetButton;
                };

                // Fungsi untuk reset tombol
                function resetButton() {
                    button.innerHTML = originalHTML;
                    button.disabled = false;
                }

                console.log(`▶ Memutar: ${noAntri}.mp3 lalu ${roleLoket}.mp3`);
            })
            .catch(error => {
                console.error('❌ Error mengambil role_loket:', error);
                button.innerHTML = originalHTML;
                button.disabled = false;
            });
    }

    // Jalankan saat halaman pertama kali load dan refresh setiap 5 detik
    loadAntrian();
    setInterval(loadAntrian, 5000);
    </script>





    <script>
    function loadAntrian2() {
        fetch('/get-antrian2')
            .then(response => response.json())
            .then(data => {
                let rows = '';
                let counter = 1;

                data.forEach(antrian => {
                    rows += `
                <tr>
                    <td>${counter++}</td>
                    <td>${antrian.loket_antri}</td>
                    <td>${antrian.no_antri}</td>
                    <td>
                        <button class="btn btn-sm btn-warning" onclick="playAudioAndUpdate(this, ${antrian.id}, '${antrian.no_antri}')">
                            <i class="fas fa-volume-up"></i>
                        </button>
                    </td>
                </tr>`;
                });

                document.getElementById('antrian2-body').innerHTML = rows;
            })
            .catch(error => {
                console.error('Gagal memuat antrian:', error);
            });
    }

    // Jalankan saat halaman pertama kali load dan refresh setiap 5 detik
    loadAntrian2();
    setInterval(loadAntrian2, 5000);

    // Fungsi: mainkan audio + update status + animasi tombol
    function playAudioAndUpdate(button, id, noAntri) {
        const originalHTML = button.innerHTML;

        button.innerHTML = `
        <span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span> Memutar...`;
        button.disabled = true;

        fetch('/get-role-loket')
            .then(response => response.json())
            .then(data => {
                if (data.status !== 'success') {
                    console.error('Gagal ambil role_loket dari session.');
                    resetButton();
                    return;
                }

                const roleLoket = data.role_loket;
                const audioAntri = new Audio(`../dist/assets/audio/${noAntri}.mp3`);
                const audioLoket = new Audio(`../dist/assets/audio/${roleLoket}.mp3`);

                // Mainkan audio antrian → lalu loket → lalu update tombol
                audioAntri.play();
                audioAntri.onended = function() {
                    audioLoket.play();
                    audioLoket.onended = function() {
                        updateStatus(); // baru update status setelah audio selesai semua
                    };
                };

                function updateStatus() {
                    fetch(`/update_status/${id}`, {
                            method: 'POST'
                        })
                        .then(response => response.json())
                        .then(result => {
                            if (result.status === 'success') {
                                console.log('✅ Antrian berhasil diperbarui.');
                            } else {
                                console.warn('⚠ Gagal update:', result.message);
                            }
                        })
                        .catch(error => {
                            console.error('❌ Error saat update:', error);
                        })
                        .finally(resetButton);
                }

                function resetButton() {
                    button.innerHTML = originalHTML;
                    button.disabled = false;
                }
            })
            .catch(error => {
                console.error('❌ Gagal ambil role_loket:', error);
                button.innerHTML = originalHTML;
                button.disabled = false;
            });
    }
    </script>


    <?= $this->endSection() ?>