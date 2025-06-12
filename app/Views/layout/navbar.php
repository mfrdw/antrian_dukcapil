<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-lg">
    <div class="container-fluid">
        <!-- Sisi Kiri: Logo dan Nama Dinas -->
        <a class="navbar-brand d-flex align-items-center" href="#">
            <img src="../dist/assets/images/lamandau.png" class="logo-image" style="width: auto; height: 70px;">
            <div class="ms-2">
                <span class="navbar-text d-block" style="font-family: 'Poppins', sans-serif; font-size: 1.7rem; font-weight: 600; line-height: 1.2; color: white;">Dinas Kependudukan dan Pencatatan Sipil</span>
                <span class="navbar-text" style="font-family: 'Poppins', sans-serif; font-size: 1.4rem; font-weight: 400; line-height: 1.2; color: white;">Kab. Lamandau</span>
            </div>
        </a>

        <!-- Navbar Toggle Button for Mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Sisi Kanan: Waktu dan Tanggal -->
        <div class="d-flex flex-column align-items-end ms-3">
            <span class="datetime" id="date" style="font-family: 'Poppins', sans-serif; font-size: 1rem; font-weight: 400; color: white;"></span>
            <span class="datetime" id="time" style="font-family: 'Poppins', sans-serif; font-size: 1.2rem; font-weight: 700; color: white;"></span>
        </div>
    </div>
</nav>

<script>
    function updateDateTime() {
        const dayNames = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
        const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September",
            "Oktober", "November", "Desember"
        ];

        const now = new Date();
        const day = dayNames[now.getDay()];
        const date = `${now.getDate()} ${monthNames[now.getMonth()]} ${now.getFullYear()}`;
        const time = now.toLocaleTimeString("en-US", {
            timeZone: "Asia/Jakarta"
        });

        document.getElementById("date").textContent = date;
        document.getElementById("time").textContent = time;
    }

    setInterval(updateDateTime, 1000);
    updateDateTime();
</script>
