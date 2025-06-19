<?= $this->extend('template/header') ?>
<?= $this->section('content') ?>

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-5">
                <div class="home-tab">
                    <div class="card">
                        <div class="card-header">
                            <h4>Daftar Antrian</h4>
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
                                            <th style="width: 120px;">Panggil Ulang</th>
                                        </tr>
                                    </thead>
                                    <tbody id="antrian-body">
                                        <!-- Data akan diisi oleh JS -->
                                    </tbody>
                                </table>

                                <?php else: ?>
                                <p class="text-center">Tidak ada antrian untuk hari ini.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-7">
                <div class="home-tab">
                    <!-- Card Panggil Antrian -->
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
                                            <th style="width: 50px;" scope="col">No.</th>
                                            <th style="width: 150px;" scope="col">Loket Antrian</th>
                                            <th style="width: 150px;" scope="col">No Antrian</th>
                                            <th style="width: 120px;" scope="col">Panggil</th>
                                        </tr>
                                    </thead>
                                    <tbody id="antrian2-body">
                                        <!-- Diisi oleh JS -->
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



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
    function loadAntrian() {
        $.getJSON('/get-antrian', function(data) {
            let rows = '';
            let counter = 1;

            data.forEach(function(antrian, index) {
                rows += `
                <tr>
                    <td>${counter++}</td>
                    <td>${antrian.nama_loket}</td>
                    <td>${antrian.no_antri}</td>
                    <td>`;

                // Hanya tampilkan tombol untuk 2 antrian pertama
                if (index < 2) {
                    rows += `
                    <button class="btn btn-success mt-2" onclick="playAudio('${antrian.no_antri}')">
                        <i class="fas fa-volume-up"></i>
                    </button>`;
                }

                rows += `</td></tr>`;
            });

            $('#antrian-body').html(rows);
        });
    }

    // Fungsi untuk memainkan audio noAntri + role_loket
    function playAudio(noAntri) {
        // 1. Ambil role_loket dari session
        fetch('/get-role-loket')
            .then(response => response.json())
            .then(data => {
                if (data.status !== 'success') {
                    console.error('Gagal mengambil role_loket dari session:', data.message);
                    return;
                }

                const roleLoket = data.role_loket;
                const audioAntri = new Audio(`../dist/assets/audio/${noAntri}.mp3`);
                const audioLoket = new Audio(`../dist/assets/audio/${roleLoket}.mp3`);

                // 2. Mainkan A001/B001 dulu, lalu Loket
                audioAntri.play();
                audioAntri.onended = function() {
                    audioLoket.play();
                };

                console.log(`▶ Memutar: ${noAntri}.mp3 lalu ${roleLoket}.mp3`);
            })
            .catch(error => {
                console.error('❌ Error mengambil role_loket:', error);
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
                    <button class="btn btn-success mt-2" onclick="playAudioAndUpdate(this, ${antrian.id}, '${antrian.no_antri}')">
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

    // Jalankan saat halaman pertama kali load dan setiap 5 detik
    loadAntrian2();
    setInterval(loadAntrian2, 5000);

    // Fungsi: mainkan audio + update status + animasi tombol
    function playAudioAndUpdate(button, id, noAntri) {
        const originalHTML = button.innerHTML;

        button.innerHTML = `
        <span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>`;
        button.disabled = true;

        // 1. Ambil role_loket dari session
        fetch('/get-role-loket')
            .then(response => response.json())
            .then(data => {
                if (data.status !== 'success') {
                    console.error('Gagal ambil role_loket dari session.');
                    button.innerHTML = originalHTML;
                    button.disabled = false;
                    return;
                }

                const roleLoket = data.role_loket;
                const audioPathAntri = `../dist/assets/audio/${noAntri}.mp3`;
                const audioPathLoket = `../dist/assets/audio/${roleLoket}.mp3`;

                // 2. Siapkan audio
                const audioAntri = new Audio(audioPathAntri);
                const audioLoket = new Audio(audioPathLoket);

                // 3. Play nomor antrian, lalu setelah selesai → play nama loket
                audioAntri.play();
                audioAntri.onended = function() {
                    audioLoket.play();
                };

                // 4. Update status ke server
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
                    .finally(() => {
                        setTimeout(() => {
                            button.innerHTML = originalHTML;
                            button.disabled = false;
                        }, 3000);
                    });
            })
            .catch(error => {
                console.error('❌ Gagal ambil role_loket:', error);
                button.innerHTML = originalHTML;
                button.disabled = false;
            });
    }
    </script>



    <?= $this->endSection() ?>