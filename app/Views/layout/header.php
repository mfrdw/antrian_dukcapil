<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> <?= $title ?> | Antrian Dukcapil Kab. Lamandau</title>

    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <!-- CSS -->
    <link rel="stylesheet" href="<?= base_url('../dist/assets/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('../dist/assets/fonts/Roboto.css') ?>">

    <!-- <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Poppins:wght@400;600&display=swap"
        rel="stylesheet"> -->
</head>

<body>
    <?= $this->include('layout/navbar'); ?>
    <?= $this->renderSection('content'); ?>
    <?= $this->include('layout/footer'); ?>
</body>