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
                    <form method="POST" action="<?= base_url('antrian/pelayanan') ?>" id="antrianForm-1">
                        <?= csrf_field() ?>
                        <input type="hidden" name="antrian" value="<?= $antri1 ?>">
                        <div class="antrian-number" id="antrian-1">PELAYANAN</div>
                        <p id="message-1" style="display: none; color: red;">Tunggu sebentar...</p>
                    </form>
                </div>
            </div>
            <div class="col-4 d-flex justify-content-center">
                <div class="loket-card">
                    <form method="POST" action="<?= base_url('antrian/perekaman') ?>" id="antrianForm-2">
                        <?= csrf_field() ?>
                        <input type="hidden" name="antrian" value="<?= $antri2 ?>">
                        <div class="antrian-number" id="antrian-2">PEREKAMAN</div>
                        <p id="message-2" style="display: none; color: red;">Tunggu sebentar...</p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- 
<script>
function disableClickAndSubmit(elementId, formId, messageElementId, message, waitTime, jenisCetak) {
    const element = document.getElementById(elementId);
    const form = document.getElementById(formId);
    const messageElement = document.getElementById(messageElementId);

    // Tampilkan pesan & nonaktifkan klik
    element.style.pointerEvents = 'none';
    messageElement.innerHTML = message;
    messageElement.style.display = 'block';

    const formData = new FormData(form);

    fetch(form.action, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success' && data.id) {
                // ✅ Redirect ke halaman cetak berdasarkan ID
                const url = `<?= base_url() ?>cetak${jenisCetak}/${data.id}`;
                window.open(url, '_blank');
            } else {
                alert('Gagal memproses antrian.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat mengirim data.');
        })
        .finally(() => {
            // Aktifkan kembali klik setelah waktu tunggu
            setTimeout(() => {
                element.style.pointerEvents = 'auto';
                messageElement.style.display = 'none';
            }, waitTime);
        });
}

// Event listener untuk "PELAYANAN"
document.getElementById('antrian-1').addEventListener('click', function() {
    disableClickAndSubmit(
        'antrian-1',
        'antrianForm-1',
        'message-1',
        'Tunggu sebentar...',
        5000,
        'Pelayanan' // Sesuai route: /cetakPelayanan/{id}
    );
});

// Event listener untuk "PEREKAMAN"
document.getElementById('antrian-2').addEventListener('click', function() {
    disableClickAndSubmit(
        'antrian-2',
        'antrianForm-2',
        'message-2',
        'Tunggu sebentar...',
        5000,
        'Perekaman' // Sesuai route: /cetakPerekaman/{id}
    );
});
</script> -->


<script>
// Fungsi untuk menangani klik dan pengiriman data untuk Pelayanan
function handlePelayananSubmit() {
    const form = document.getElementById('antrianForm-1');
    const messageElement = document.getElementById('message-1');
    const element = document.getElementById('antrian-1');

    // Tampilkan pesan dan nonaktifkan tombol
    element.style.pointerEvents = 'none';
    messageElement.innerHTML = 'Tunggu sebentar...';
    messageElement.style.display = 'block';

    const formData = new FormData(form);

    fetch(form.action, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success' && data.id) {
                // Redirect ke halaman cetak Pelayanan
                const url = `<?= base_url() ?>cetakPelayanan/${data.id}`;
                window.open(url, '_blank');
            } else {
                alert('Gagal memproses antrian Pelayanan.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat mengirim data Pelayanan.');
        })
        .finally(() => {
            setTimeout(() => {
                element.style.pointerEvents = 'auto';
                messageElement.style.display = 'none';
            }, 5000);
        });
}

// Event listener untuk "PELAYANAN"
document.getElementById('antrian-1').addEventListener('click', handlePelayananSubmit);
</script>

<script>
// Fungsi untuk menangani klik dan pengiriman data untuk Perekaman
async function handlePerekamanSubmit() {
    const form = document.getElementById('antrianForm-2');
    const messageElement = document.getElementById('message-2');
    const element = document.getElementById('antrian-2');

    // Tampilkan pesan dan nonaktifkan tombol
    element.style.pointerEvents = 'none';
    messageElement.innerHTML = 'Tunggu sebentar...';
    messageElement.style.display = 'block';

    const formData = new FormData(form);

    try {
        // Kirim form menggunakan Fetch API
        const response = await fetch(form.action, {
            method: 'POST',
            body: formData
        });

        const data = await response.json();

        // Cek apakah status dari server adalah success
        if (data.status === 'success' && data.id) {
            // Redirect ke halaman cetak Perekaman berdasarkan ID
            const url = `<?= base_url() ?>cetakPerekaman/${data.id}`;
            window.open(url, '_blank');
        } else {
            // Jika gagal, tampilkan pesan kesalahan
            alert('Gagal memproses antrian Perekaman. Coba lagi.');
        }
    } catch (error) {
        // Tangani error jaringan atau kesalahan pengiriman data
        console.error('Error:', error);
        alert('Terjadi kesalahan saat mengirim data Perekaman.');
    } finally {
        // Aktifkan kembali tombol dan sembunyikan pesan setelah 5 detik
        setTimeout(() => {
            element.style.pointerEvents = 'auto';
            messageElement.style.display = 'none';
        }, 5000);
    }
}

// Event listener untuk "PEREKAMAN"
document.getElementById('antrian-2').addEventListener('click', handlePerekamanSubmit);
</script>




<?= $this->endSection() ?>