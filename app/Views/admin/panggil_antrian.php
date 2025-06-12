<?= $this->extend('template/header') ?>
<?= $this->section('content') ?>

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-6">
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
                                        <th scope="col">Loket Antrian</th>
                                        <th scope="col">No Antrian</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data_antrian as $antrian): ?>
                                        <tr>
                                            <td><?= $antrian['loket_antri'] ?></td>
                                            <td><?= $antrian['no_antri'] ?></td>
                                        </tr>
                                     <?php endforeach; ?>
                                </tbody>
                            </table>
                            <?php else: ?>
                                <p class="text-center">Tidak ada antrian untuk hari ini.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="home-tab">
                    <!-- Card Panggil Antrian -->
                    <div class="card">
                        <div class="card-header">
                            <h4>Panggil Antrian</h4>
                        </div>
                        <div class="card-body">
                         <?php if (!empty($data_antrian)): ?>    
                        <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Loket Antrian</th>
                                        <th scope="col">No Antrian</th>
                                        <th scope="col">Panggil</th>
                                        <th scope="col">Panggil Ulang</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data_antrian as $antrian): ?>
                                    <tr>
                                        <td><?= $antrian['loket_antri'] ?></td>
                                        <td><?= $antrian['no_antri'] ?></td>
                                        <td><button class="btn btn-primary mt-2" onclick="playAudio('<?= $antrian['no_antri'] ?>')">Panggil</button></td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <select class="form-control form-control-sm" style="width: auto; height: 20px; border-top-right-radius: 0; border-bottom-right-radius: 0;">
                                                    <option><?= $antrian['no_antri'] ?></option>
                                                </select>
                                                <button class="btn btn-primary" style="border-top-left-radius: 0; border-bottom-left-radius: 0; height: 30px; padding-left: 20px; padding-right: 20px; margin-top: 12px;">Panggil</button>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>

                            </table>
                                <?php else: ?>
                                    <p class="text-center">Tidak ada antrian untuk hari ini.</p>
                                <?php endif; ?>
                        </div>
                    </div>
                    <!-- End Card Panggil-->
                </div>
            </div>
        </div>
    </div>


    <script>
    // Fungsi untuk memutar audio berdasarkan nomor antrian yang dipilih
    function playAudio(antrian) {
        // Membuat path audio berdasarkan nomor antrian yang dipilih
        var audioPath = '../dist/assets/audio/' + antrian + '.mp3';
        
        // Membuat elemen audio baru
        var audio = new Audio(audioPath);

        // Memutar audio
        audio.play();

        // Log untuk memverifikasi bahwa audio sedang diputar
        console.log("Memanggil audio untuk antrian: " + antrian);
    }

    // Event listener untuk tombol panggil menggunakan dropdown
    document.getElementById("panggil-btn").addEventListener("click", function() {
        var selectedAntrian = document.getElementById("antrian-select").value;
        playAudio(selectedAntrian); // Panggil fungsi playAudio dengan nomor antrian yang dipilih
    });
</script>
<?= $this->endSection() ?>
