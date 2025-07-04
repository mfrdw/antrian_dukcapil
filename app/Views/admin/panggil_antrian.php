<?= $this->extend('template/header') ?>
<?= $this->section('content') ?>

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <!-- Kolom Daftar Antrian -->
            <div class="col-12 col-md-5">
                <div class="home-tab">
                    <div class="card">
                        <div class="card-header">
                            <h4>Daftar Antrian</h4>
                        </div>
                        <div class="card-body text-center">
                            <?php if (!empty($data_antrian)): ?>
                            <div style="overflow-x: auto; -webkit-overflow-scrolling: touch;">
                                <table class="table table-striped" style="min-width: 100%; table-layout: fixed;">
                                    <thead>
                                        <tr>
                                            <th style="width: 50px;">No.</th>
                                            <th style="width: 150px;">No Antrian</th>
                                            <th style="width: 120px;">Panggil Ulang</th>
                                        </tr>
                                    </thead>
                                    <tbody id="antrian-body">
                                        <!-- Diisi oleh JavaScript -->
                                    </tbody>
                                </table>
                                <?php else: ?>
                                <p class="text-center small">Tidak ada antrian untuk hari ini.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kolom Panggil Antrian -->
            <div class="col-12 col-md-7">
                <div class="home-tab">
                    <div class="card">
                        <div class="card-header">
                            <h4>Panggil Antrian</h4>
                        </div>
                        <div class="card-body">
                            <?php if (!empty($data_antrian)): ?>
                            <div style="overflow-x: auto; -webkit-overflow-scrolling: touch;">
                                <table class="table table-striped" style="min-width: 100%; table-layout: fixed;">
                                    <thead>
                                        <tr>
                                            <th style="width: 50px;">No.</th>
                                            <th style="width: 150px;">Loket Antrian</th>
                                            <th style="width: 150px;">No Antrian</th>
                                            <th style="width: 120px;">Panggil</th>
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