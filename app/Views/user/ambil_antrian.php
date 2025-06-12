<?= $this->extend('layout/header') ?>
<?= $this->section('content') ?>


    <style>
        body {
            background: linear-gradient(to right, #4facfe, #00f2fe);
            height: 100vh;
            background-size: cover;
            background-position: center; 
            color: white; 
            font-family: 'Arial', sans-serif;
        }

        .loket-container {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 30px;
            margin-top: 30px;
        }

        .loket-card {
            width: 100%;
            max-width: 450px;
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            padding: 80px;
            text-align: center;
            transition: transform 0.3s ease-in-out;
        }

        .loket-card:hover {
            transform: translateY(-15px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
        }

        .antrian-number {
            font-size: 32px;
            font-weight: bold;
            color: #007bff;
            padding: 40px;
            border: 4px solid #007bff;
            border-radius: 10px;
            background-color: #f0f8ff;
            text-transform: uppercase;
        }

        .row {
            justify-content: center;
        }

        .col-4 {
            flex: 1 1 30%;
        }

        .col-3 {
            flex: 1 1 22%;
        }

        h1 {
            color: #ffffff;
            font-size: 48px;
            font-weight: bold;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.4);
        }

        @media (max-width: 768px) {
            .col-4 {
                flex: 1 1 45%;
            }

            .col-3 {
                flex: 1 1 45%;
            }
        }
    </style>

<div class="container-fluid mt-5">
    <div class="text-center mb-5">
        <h1 class="display-4 font-weight-bold text-uppercase mb-4">Ambil Antrian</h1>
    </div>
    <div class="loket-container" id="loket-container">
        <div class="row">
            <div class="col-4 d-flex justify-content-center">
                <div class="loket-card">
                    <!-- Form for Pelayanan -->
                    <form method="POST" action="<?= base_url('antrian/pelayanan') ?>" id="antrianForm-1">
                        <?= csrf_field() ?> 
                        <input type="hidden" name="antrian" value="<?= $antri1 ?>"> <!-- Menggunakan hidden input untuk data antrian -->       
                        <div class="antrian-number" id="antrian-1">PELAYANAN</div>
                        <p id="message-1" style="display: none; color: red;">Tunggu sebentar...</p> <!-- Keterangan untuk Pelayanan -->
                    </form>
                </div>
            </div>
            <div class="col-4 d-flex justify-content-center">
                <div class="loket-card">
                    <!-- Form for Perekaman -->
                    <form method="POST" action="<?= base_url('antrian/perekaman') ?>" id="antrianForm-2">
                        <?= csrf_field() ?> 
                        <input type="hidden" name="antrian" value="<?= $antri2 ?>"> <!-- Menggunakan hidden input untuk data antrian -->       
                        <div class="antrian-number" id="antrian-2">PEREKAMAN</div>
                        <p id="message-2" style="display: none; color: red;">Tunggu sebentar...</p> <!-- Keterangan untuk Perekaman -->
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    // Fungsi untuk menonaktifkan klik dan menampilkan keterangan
    function disableClick(elementId, formId, messageElementId, message, waitTime) {
        const element = document.getElementById(elementId);
        const form = document.getElementById(formId);
        const messageElement = document.getElementById(messageElementId);

        // Menonaktifkan interaksi dan menampilkan pesan
        element.style.pointerEvents = 'none';  // Menonaktifkan klik
        messageElement.innerHTML = message;  // Menampilkan keterangan
        messageElement.style.display = 'block';  // Menampilkan pesan

        // Setelah jeda waktu (5000 ms = 5 detik), aktifkan kembali klik
        setTimeout(function() {
            element.style.pointerEvents = 'auto';  // Mengaktifkan kembali klik
            messageElement.style.display = 'none';  // Menyembunyikan pesan
        }, waitTime);

        // Kirim form
        form.submit();  
    }

    // Event listener untuk "PELAYANAN"
    document.getElementById('antrian-1').addEventListener('click', function() {
        disableClick('antrian-1', 'antrianForm-1', 'message-1', 'Tunggu sebentar...', 5000); // 5 detik
    });

    // Event listener untuk "PEREKAMAN"
    document.getElementById('antrian-2').addEventListener('click', function() {
        disableClick('antrian-2', 'antrianForm-2', 'message-2', 'Tunggu sebentar...', 5000); // 5 detik
    });
</script>


<?= $this->endSection() ?>
