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
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">No.</th>
                                        <th scope="col">Loket Antrian</th>
                                        <th scope="col">No Antrian</th>
                                        <th scope="col">Panggil Ulang</th>
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
                                <!-- Membuat tabel dapat digulir -->
                                <table class="table table-striped" style="min-width: 100%; table-layout: fixed;">
                                    <thead>
                                        <tr>
                                            <th scope="col">No.</th>
                                            <th scope="col">Loket Antrian</th>
                                            <th scope="col">No Antrian</th>
                                            <th scope="col">Panggil</th>
                                        </tr>
                                    </thead>
                                    <tbody id="antrian2-body">

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

    // Panggil saat halaman load
    loadAntrian();

    // Refresh otomatis tiap 5 detik
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

    // Jalankan saat halaman pertama kali load
    loadAntrian2();
    setInterval(loadAntrian2, 5000);

    // Fungsi: mainkan audio + update status dengan spinner
    function playAudioAndUpdate(button, id, noAntri) {
        const originalHTML = button.innerHTML;

        // Tampilkan spinner di tombol
        button.innerHTML =
            `<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span> Memanggil...`;
        button.disabled = true;

        // Mainkan audio
        const audioPath = '../dist/assets/audio/' + noAntri + '.mp3';
        const audio = new Audio(audioPath);
        audio.play();

        // Kirim permintaan update ke server
        fetch(`/update-status-antrian/${id}`, {
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
                // Reset tombol setelah beberapa detik (opsional)
                setTimeout(() => {
                    button.innerHTML = originalHTML;
                    button.disabled = false;
                }, 3000);
            });
    }
    </script>





    <script>
    function playAudio(noAntri) {
        var audioPath = '../dist/assets/audio/' + noAntri + '.mp3';

        var audio = new Audio(audioPath);

        audio.play();

        console.log("Memanggil audio untuk antrian: " + noAntri);
    }

    document.getElementById("panggil-btn").addEventListener("click", function() {
        var selectedAntrian = document.getElementById("antrian-select").value;
        playAudio(selectedAntrian);
    });
    </script>


    <?= $this->endSection() ?>