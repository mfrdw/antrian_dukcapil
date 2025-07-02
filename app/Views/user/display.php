<?= $this->extend('layout/header') ?>
<?= $this->section('content') ?>

<style>
/* Styling untuk Loket Card */
.loket-card {
    border-radius: 15px;
    background: linear-gradient(135deg, #00c6ff, #0072ff);
    /* Gradient background */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    color: white;
    text-align: center;
    padding: 30px;
    /* Padding untuk card */
    transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    height: 300px;
    width: 800px;
    margin-bottom: 20px;
    /* Memberi jarak antar card */
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    /* Menjaga jarak antara header, body, dan footer */
    position: relative;
    animation: slideUp 1s ease-out;
    /* Animasi slideUp pada card */
}

.loket-card:hover {
    transform: translateY(-10px);
    /* Hover effect to lift the card */
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
    /* Hover shadow */
}

/* Card Header */
.loket-card-header {
    font-size: 1.4rem;
    font-weight: bold;
    color: #fff;
    margin-bottom: 20px;
    border-bottom: 2px solid #ffffff;
    /* Garis di bawah card header */
    padding-bottom: 10px;
    /* Memberikan jarak antara teks dan garis */
}

/* Card Footer */
.loket-card-footer {
    font-size: 1.2rem;
    font-weight: bold;
    color: #fff;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-top: 20px;
    border-top: 2px solid #ffffff;
    /* Garis di atas card footer */
    padding-top: 10px;
    /* Memberikan jarak antara teks dan garis */
}

.antrian-number {
    font-size: 4rem;
    font-weight: bold;
    color: #fff;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    margin-top: 20px;
    animation: bounce 2s infinite;
    /* Animasi bounce untuk nomor antrian */
}

/* Animasi untuk Judul Halaman */
h1 {
    font-size: 3.5rem;
    font-weight: bold;
    color: #343a40;
    text-align: center;
    margin-bottom: 30px;
    animation: slideIn 1s ease-in-out;
}

.lead {
    font-size: 1.2rem;
    color: #6c757d;
    text-align: center;
    animation: fadeIn 2s ease-in-out;
}

/* Styling untuk Loket container */
.loket-container {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center;
    /* Menjaga card tetap di tengah */
    animation: fadeIn 1.5s ease-in-out;
}

/* Animasi untuk Loket Row */
.loket-row {
    display: flex;
    justify-content: center;
    /* Memastikan baris card tetap terpusat */
    width: 100%;
    animation: slideIn 1s ease-in-out;
}

/* Animasi FadeIn */
@keyframes fadeIn {
    0% {
        opacity: 0;
    }

    100% {
        opacity: 1;
    }
}

/* Animasi SlideIn */
@keyframes slideIn {
    0% {
        transform: translateX(-100%);
    }

    100% {
        transform: translateX(0);
    }
}

/* Animasi Bounce */
@keyframes bounce {

    0%,
    100% {
        transform: translateY(0);
    }

    50% {
        transform: translateY(-10px);
    }
}
</style>

<div class="container-fluid mt-3">
    <!-- <div class="text-center mb-5">
        <h1 class="display-4 font-weight-bold text-uppercase mb-4">LOKET PELAYANAN</h1>
        <p class="lead mb-4" style="font-size: 1.2rem; font-weight: 600; color: #6c757d;">
            DINAS KEPENDUDUKAN DAN PENCATATAN SIPIL
        </p>
    </div> -->

    <!-- Loket Baris 1-3 -->
    <div class="loket-container">
        <div class="row">
            <div class="col-4 d-flex justify-content-center">
                <div class="loket-card">
                    <div class="loket-card-header">Nomor Antrian</div>
                    <div class="antrian-number" id="antrian-1"></div>
                    <div class="loket-card-footer">Loket 1</div>
                </div>
            </div>
            <div class="col-4 d-flex justify-content-center">
                <div class="loket-card">
                    <div class="loket-card-header">Nomor Antrian</div>
                    <div class="antrian-number" id="antrian-2"></div>
                    <div class="loket-card-footer">Loket 2</div>
                </div>
            </div>
            <div class="col-4 d-flex justify-content-center">
                <div class="loket-card">
                    <div class="loket-card-header">Nomor Antrian</div>
                    <div class="antrian-number" id="antrian-3"></div>
                    <div class="loket-card-footer">Loket 3</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Loket Baris 4-6 -->
    <div class="loket-container mt-4">
        <div class="row">
            <div class="col-4 d-flex justify-content-center">
                <div class="loket-card">
                    <div class="loket-card-header">Nomor Antrian</div>
                    <div class="antrian-number" id="antrian-4"></div>
                    <div class="loket-card-footer">Loket 4</div>
                </div>
            </div>
            <div class="col-4 d-flex justify-content-center">
                <div class="loket-card">
                    <div class="loket-card-header">Nomor Antrian</div>
                    <div class="antrian-number" id="antrian-5"></div> <!-- ✅ Sudah diperbaiki -->
                    <div class="loket-card-footer">Loket 5</div>
                </div>
            </div>
            <div class="col-4 d-flex justify-content-center">
                <div class="loket-card">
                    <div class="loket-card-header">Nomor Antrian</div>
                    <div class="antrian-number" id="antrian-6"></div>
                    <div class="loket-card-footer">Loket 6</div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
async function fetchAntrian() {
    try {
        const response = await fetch('<?= base_url("get-data") ?>');
        const data = await response.json();

        data.forEach(item => {
            // Ambil nomor dari "Loket 1", "Loket 2", dst
            const match = item.loket.match(/Loket\s+(\d+)/i);
            if (match) {
                const nomor = match[1]; // hasil: 1, 2, ..., 6
                const target = document.getElementById(`antrian-${nomor}`);
                if (target) {
                    target.textContent = item.no_antri;
                }
            }
        });
    } catch (err) {
        console.error("Gagal mengambil data antrian:", err);
    }
}

// Jalankan pertama kali dan refresh setiap 3 detik
fetchAntrian();
setInterval(fetchAntrian, 3000);
</script>



<?= $this->endSection() ?>