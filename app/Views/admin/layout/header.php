<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>

        <title><?= $title; ?></title>

        <meta name="description" content="" />

        <!-- Favicon -->
        <link rel="icon" type="image/x-icon" href="<?= BASE_URL ?>assets/img/logo.png" />

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet"
        />

        <!-- Icons. Uncomment required icon fonts -->
        <link rel="stylesheet" href="<?= BASE_URL ?>assets/vendor/fonts/boxicons.css" />

        <!-- Core CSS -->
        <link rel="stylesheet" href="<?= BASE_URL ?>assets/vendor/css/core.css" class="template-customizer-core-css" />
        <link rel="stylesheet" href="<?= BASE_URL ?>assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
        <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/styles.css?v=1" />

        <!-- Vendors CSS -->
        <link rel="stylesheet" href="<?= BASE_URL ?>assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
        <!-- <link rel="stylesheet" href="<?= BASE_URL ?>assets/vendor/libs/select2/select2.css" /> -->

        <!-- Datatables CSS -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" />
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
        <!-- Helpers -->
        <script src="<?= BASE_URL ?>assets/vendor/js/helpers.js"></script>

        <script src="<?= BASE_URL ?>assets/js/config.js"></script>
    </head>

    <body>
        <?php 
        // Pengecekan role admin di sini
        $session = session()->get('logged_user');
        if(!$session && $id_sales) {
            $session = getSales_permissions();
        }
        $akses = $session['akses'] ?? [];
        $hasPermission = function($permission, $menu) use ($akses) {
            return isset($akses->$menu) && in_array($permission, $akses->$menu);
        };
        ?>
        <!-- Layout wrapper -->
        <div class="layout-wrapper layout-content-navbar">
            <div class="layout-container">