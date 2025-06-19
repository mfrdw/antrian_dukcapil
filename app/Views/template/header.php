<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= $title ?> | Antrian Dukcapil Kab. Lamandau</title>

    <!-- CDN (boleh tetap dipakai) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Plugin: CSS Lokal -->
    <link rel="stylesheet" href="<?= base_url('dist/assets/vendors/feather/feather.css') ?>">
    <link rel="stylesheet" href="<?= base_url('dist/assets/vendors/mdi/css/materialdesignicons.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('dist/assets/vendors/ti-icons/css/themify-icons.css') ?>">
    <link rel="stylesheet" href="<?= base_url('dist/assets/vendors/font-awesome/css/font-awesome.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('dist/assets/vendors/typicons/typicons.css') ?>">
    <link rel="stylesheet" href="<?= base_url('dist/assets/vendors/simple-line-icons/css/simple-line-icons.css') ?>">
    <link rel="stylesheet" href="<?= base_url('dist/assets/vendors/css/vendor.bundle.base.css') ?>">
    <link rel="stylesheet"
        href="<?= base_url('dist/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') ?>">

    <!-- DataTables Plugin -->
    <link rel="stylesheet" href="<?= base_url('dist/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('dist/assets/js/select.dataTables.min.css') ?>">

    <!-- Main CSS -->
    <link rel="stylesheet" href="<?= base_url('dist/assets/css/style.css') ?>">

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?= base_url('dist/assets/images/favicon.png') ?>" />
</head>

<body class="with-welcome-text">
    <?= $this->include('template/sidebar'); ?>
    <?= $this->renderSection('content'); ?>
    <?= $this->include('template/footer'); ?>
</body>