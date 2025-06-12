<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nomor Antrian</title>
    <link rel="stylesheet" href="styles.css">

    <style>
        /* styles.css */
        body {
            font-family: 'Courier New', Courier, monospace;  /* Font Monospace untuk tampilan seperti tiket */
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            width: 300px;  /* Lebar container sesuai dengan ukuran tiket */
            height: 400px; /* Tinggi tiket */
            padding: 20px;
            border: 2px solid #000;
            background-color: white;
            text-align: center;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            font-size: 14px; /* Ukuran font agar sesuai dengan tiket */
            border-radius: 10px;
        }

        /* Logo dan Header */
        .header-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 2px solid #000; /* Garis pemisah di bawah header */
        }

        .logo {
            width: 50px;
            height: auto;
            margin-right: 10px;
        }

        .header {
            font-size: 18px;
            font-weight: bold;
            color: #333;
            text-align: left;
        }

        /* Nomor Antrian */
        .queue-number {
            font-size: 50px;  /* Ukuran font besar untuk nomor antrian */
            font-weight: bold;
            color: #000;
            background-color: #fff;
            padding: 20px;
            margin: 20px 0;
            border: 3px solid #000;
            border-radius: 10px;
            width: 250px;
        }

        /* Pesan */
        .message {
            font-size: 14px;
            color: #555;
            margin-top: 30px;
        }

        /* Tanggal dan Waktu (footer) */
        .datetime {
            font-size: 14px;
            color: #888;
            margin-top: 10px;
            text-align: center;
        }

        /* Media Query untuk menyesuaikan tampilan saat print */
        @media print {
            body {
                margin: 0;
                padding: 0;
            }

            .container {
                width: 300px;  /* Ukuran lebar kertas tiket */
                height: 400px; /* Ukuran tinggi kertas tiket */
                padding: 20px;
                font-size: 12px; /* Menyesuaikan font saat dicetak */
            }

            .logo {
                width: 50px;
            }

            .queue-number {
                font-size: 50px;
            }

            .message, .datetime {
                font-size: 12px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header dengan logo -->
        <div class="header-container">
            <img src="../dist/assets/images/lamandau.png" alt="Logo" class="logo">
            <div class="header">
                Dinas Kependudukan dan Pencatatan Sipil<br>
                Kabupaten Lamandau
            </div>
        </div>

        <!-- Nomor Antrian -->
        <div class="queue-number">
            <span id="queue-number"><?= $antri ?></span>
        </div>

        <div class="message">
            Silakan menunggu nomor antrian Anda dipanggil.
        </div>

        <div class="datetime">
            <script>
                var today = new Date();

                // Mendapatkan hari dalam bahasa Indonesia
                var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false };
                var formattedDate = new Intl.DateTimeFormat('id-ID', options).format(today);

                // Menambahkan "WIB" di akhir
                var finalDate = formattedDate + ' WIB';

                // Menampilkan hasil
                document.write(finalDate);
            </script>
        </div>
    </div>

    <script>
        window.print();
    </script>
</body>
</html>
