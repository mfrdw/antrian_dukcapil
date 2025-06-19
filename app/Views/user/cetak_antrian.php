<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Cetak Antrian</title>
    <style>
    @media print {
        @page {
            size: 57.5mm auto;
            margin: 0;
        }

        body {
            margin: 0;
            padding: 0;
            background: white;
            font-family: 'Courier New', monospace;
            font-weight: bold;
            /* Semua tulisan menjadi bold */
        }

        .ticket {
            width: 57.5mm;
            margin-left: 1mm;
            padding: 6mm 3mm;
            box-sizing: border-box;
            text-align: center;
            page-break-after: avoid;
            border-top: 1px dashed #000;
            border-bottom: 1px dashed #000;
        }

        .title {
            font-size: 3.6mm;
            text-transform: uppercase;
            line-height: 1.5;
            margin-bottom: 3mm;
        }

        .sub-title {
            font-size: 3.2mm;
            margin-bottom: 4mm;
            color: #000;
        }

        .antrian {
            font-size: 14mm;
            border: 2px dashed #000;
            padding: 5mm 0;
            margin: 4mm 0;
            border-radius: 2mm;
        }

        .msg {
            font-size: 3.5mm;
            margin-top: 4mm;
            margin-bottom: 3mm;
        }

        .time {
            font-size: 3mm;
            color: #000;
            border-top: 1px dashed #000;
            padding-top: 2mm;
        }
    }
    </style>
</head>

<body>
    <div class="ticket">
        <div class="title">DINAS KEPENDUDUKAN DAN PENCATATAN SIPIL</div>
        <div class="sub-title">KABUPATEN LAMANDAU</div>

        <div class="antrian"><?= $antri ?></div>

        <div class="msg">
            Silakan menunggu hingga nomor Anda dipanggil
        </div>

        <div class="time">
            <script>
            const now = new Date();
            const hari = new Intl.DateTimeFormat('id-ID', {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            }).format(now);

            const jam = String(now.getHours()).padStart(2, '0');
            const menit = String(now.getMinutes()).padStart(2, '0');
            const detik = String(now.getSeconds()).padStart(2, '0');
            const waktu = `${jam}:${menit}:${detik}`;

            document.write(`${hari} ${waktu} WIB`);
            </script>
        </div>
    </div>

    <script>
    window.onload = () => window.print();
    </script>
</body>

</html>