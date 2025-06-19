    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
                <div class="me-3">
                    <button class="navbar-toggler navbar-toggler align-self-center" type="button"
                        data-bs-toggle="minimize">
                        <span class="icon-menu"></span>
                    </button>
                </div>
                <div>
                    <a class="navbar-brand brand-logo" href="index.html">
                        <img src="../dist/assets/images/lamandau.png" alt="logo" />
                    </a>
                    <a class="navbar-brand brand-logo-mini" href="index.html">
                        <img src="../dist/assets/images/lamandau.png" alt="logo" />
                    </a>
                </div>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-top">
                <ul class="navbar-nav">
                    <li class="nav-item fw-semibold d-none d-lg-block ms-0">
                        <h1 class="welcome-text" id="greeting"></h1>
                        <h3 class="welcome-sub-text" id="date-time"></h3>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown d-none d-lg-block user-dropdown">
                        <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                            <img class="img-xs rounded-circle" src="../dist/assets/images/faces/face8.jpg"
                                alt="Profile image"> </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                            <div class="dropdown-header text-center">
                                <img class="img-md rounded-circle" src="../dist/assets/images/faces/face8.jpg"
                                    alt="Profile image">
                                <p class="mb-1 mt-3 fw-semibold">Allen Moreno</p>
                                <p class="fw-light text-muted mb-0">allenmoreno@gmail.com</p>
                            </div>
                            <a class="dropdown-item"><i
                                    class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i> My Profile
                                <span class="badge badge-pill badge-danger">1</span></a>
                            <!-- <a class="dropdown-item"><i class="dropdown-item-icon mdi mdi-message-text-outline text-primary me-2"></i> Messages</a>
                <a class="dropdown-item"><i class="dropdown-item-icon mdi mdi-calendar-check-outline text-primary me-2"></i> Activity</a>
                <a class="dropdown-item"><i class="dropdown-item-icon mdi mdi-help-circle-outline text-primary me-2"></i> FAQ</a> -->
                            <a href="/logout" class="dropdown-item"><i
                                    class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Sign Out</a>
                        </div>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-bs-toggle="offcanvas">
                    <span class="mdi mdi-menu"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('/dashboard') ?>">
                            <i class="mdi mdi-view-dashboard menu-icon"></i>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-item nav-category">Antrian</li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('/nama_antrian') ?>">
                            <i class="mdi mdi-format-list-bulleted menu-icon"></i>
                            <span class="menu-title">Nama Antrian</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('/ambil_antrian') ?>">
                            <i class="mdi mdi-ticket-confirmation menu-icon"></i>
                            <span class="menu-title">Ambil Antrian</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('/panggil_antrian') ?>">
                            <i class="mdi mdi-bullhorn menu-icon"></i>
                            <span class="menu-title">Panggil Antrian</span>
                        </a>
                    </li>

                    <li class="nav-item nav-category">Setting</li>

                    <li class="nav-item">
                        <a class="nav-link" href="index.html">
                            <i class="mdi mdi-account-cog menu-icon"></i>
                            <span class="menu-title">User Management</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="index.html">
                            <i class="mdi mdi-view-quilt menu-icon"></i>
                            <span class="menu-title">Layout</span>
                        </a>
                    </li>
                </ul>
            </nav>


            <script>
            // Fungsi untuk menyesuaikan sapaan berdasarkan waktu
            function getGreeting() {
                const now = new Date();
                const hours = now.getHours();
                let greeting = '';

                if (hours >= 5 && hours < 12) {
                    greeting = 'Selamat Pagi';
                } else if (hours >= 12 && hours < 18) {
                    greeting = 'Selamat Siang';
                } else {
                    greeting = 'Selamat Malam';
                }

                return greeting;
            }

            // Fungsi untuk menampilkan waktu, tanggal, bulan, tahun, dan jam dengan WIB
            function getDateTime() {
                const now = new Date();
                const options = {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                };

                // Format tanggal dan waktu dengan WIB
                const formattedDate = now.toLocaleString('id-ID', options);

                return formattedDate;
            }

            // Mengupdate teks sapaan dan tanggal, waktu
            document.getElementById('greeting').textContent = `${getGreeting()}`;
            document.getElementById('date-time').textContent = getDateTime();
            </script>

            <!-- content-wrapper ends -->