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

                // Tampilkan tombol hanya untuk 2 data teratas (index 0 dan 1)
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



    <!-- Tabel 2 -->
    <script>
    function loadAntrian2() {
        $.getJSON('/get-antrian2', function(data) {
            let rows = '';
            let counter = 1;

            data.forEach(function(antrian) {
                rows += `
                <tr>
                    <td>${counter++}</td>
                    <td>${antrian.loket_antri}</td>
                    <td>${antrian.no_antri}</td>
                    <td>
                        <button class="btn btn-success mt-2" onclick="playAudioAndUpdate('${antrian.no_antri}')">
                            <i class="fas fa-volume-up"></i> Panggil
                        </button>
                    </td>
                </tr>`;
            });

            $('#antrian2-body').html(rows);
        });
    }

    // Panggil saat halaman load
    loadAntrian2();

    // Refresh otomatis tiap 5 detik
    setInterval(loadAntrian2, 5000);

    // Fungsi: mainkan audio + update ke database
    function playAudioAndUpdate(noAntri) {
        var audioPath = '../dist/assets/audio/' + noAntri + '.mp3';
        var audio = new Audio(audioPath);
        audio.play();
        console.log("Memanggil audio untuk antrian: " + noAntri);

        // Kirim update ke server
        $.post('/update-status-antrian', {
            no_antri: noAntri
        }, function(response) {
            if (response.status === 'success') {
                console.log('Status berhasil diperbarui.');
            } else {
                console.warn('Gagal memperbarui status:', response.message);
            }
        }).fail(function(xhr) {
            console.error('Request gagal:', xhr.responseText);
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