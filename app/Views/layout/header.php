<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?> | Antrian Dukcapil Kab. Lamandau</title>

    <!-- CSS Offline -->
    <link rel="stylesheet" href="<?= base_url('dist/assets/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('dist/assets/fonts/Roboto.css') ?>">

    <!-- Jika ingin pakai dari CDN bisa uncomment ini -->
    <!-- <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Poppins:wght@400;600&display=swap" rel="stylesheet"> -->
</head>

<body>
    <?= $this->include('layout/navbar'); ?>
    <?= $this->renderSection('content'); ?>
    <?= $this->include('layout/footer'); ?>
</body>