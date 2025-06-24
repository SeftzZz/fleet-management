<<<<<<< HEAD
<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $title ?></title>
        <link rel="icon" href="<?php echo base_url(); ?>assets/newstyle/dist/img/favicon.ico.png" type="image/x-icon">
        <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/newstyle/dist/img/favicon.ico.png" type="image/x-icon">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/newstyle/plugins/fontawesome-free/css/all.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/newstyle/dist/css/newtheme.css?v=3.2.0">
    </head>
    
    <body class="hold-transition sidebar-mini">
        <!-- Site wrapper -->
        <div class="wrapper">
            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                    </li>
                </ul>

                <!-- Right navbar links -->
                <ul class="navbar-nav ml-auto">
                    <!-- Navbar Search -->
                    <li class="nav-item">
                        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                            <i class="fas fa-search"></i>
                        </a>
                        <div class="navbar-search-block">
                            <form class="form-inline">
                                <div class="input-group input-group-sm">
                                    <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                                    <div class="input-group-append">
                                        <button class="btn btn-navbar" type="submit">
                                            <i class="fas fa-search"></i>
                                        </button>
                                        <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                            <i class="fas fa-expand-arrows-alt"></i>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <!-- Brand Logo -->
                <a href="../../index3.html" class="brand-link">
                    <img src="<?php echo base_url(); ?>assets/newstyle/dist/img/LogoTruck.png" class="brand-image">
                    <span class="brand-text font-weight-light">FLEETX</span>
                </a>

                <!-- Sidebar -->
                <div class="sidebar">
                    <!-- Sidebar user (optional) -->
                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            <li class="nav-item">
                                <a href="<?php echo site_url() ?>" class="nav-link">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>Dashboard Utama</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo site_url('vehicles') ?>" class="nav-link">
                                    <i class="nav-icon fas fa-truck"></i>
                                    <p>Manajemen Kendaraan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo site_url('drivers') ?>" class="nav-link">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>Manajemen Supir</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo site_url('routes') ?>" class="nav-link <?php if ($nopage==4) echo('active') ?>">
                                    <i class="nav-icon fas fa-map-signs"></i>
                                    <p>Rute & Ritasi</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-wrench"></i>
                                    <p>Pemeliharaan & BBM</p>
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <!-- /.sidebar-menu -->
                </div>
                <!-- /.sidebar -->
            </aside>
=======
<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $title ?></title>
        <link rel="icon" href="<?php echo base_url(); ?>assets/newstyle/dist/img/favicon.ico.png" type="image/x-icon">
        <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/newstyle/dist/img/favicon.ico.png" type="image/x-icon">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/newstyle/plugins/fontawesome-free/css/all.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/newstyle/dist/css/newtheme.css?v=3.2.0">
    </head>
    
    <body class="hold-transition sidebar-mini">
        <!-- Site wrapper -->
        <div class="wrapper">
            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                    </li>
                </ul>

                <!-- Right navbar links -->
                <ul class="navbar-nav ml-auto">
                    <!-- Navbar Search -->
                    <li class="nav-item">
                        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                            <i class="fas fa-search"></i>
                        </a>
                        <div class="navbar-search-block">
                            <form class="form-inline">
                                <div class="input-group input-group-sm">
                                    <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                                    <div class="input-group-append">
                                        <button class="btn btn-navbar" type="submit">
                                            <i class="fas fa-search"></i>
                                        </button>
                                        <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                            <i class="fas fa-expand-arrows-alt"></i>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <!-- Brand Logo -->
                <a href="../../index3.html" class="brand-link">
                    <img src="<?php echo base_url(); ?>assets/newstyle/dist/img/LogoTruck.png" class="brand-image">
                    <span class="brand-text font-weight-light">FLEETX</span>
                </a>

                <!-- Sidebar -->
                <div class="sidebar">
                    <!-- Sidebar user (optional) -->
                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            <li class="nav-item">
                                <a href="<?php echo site_url() ?>" class="nav-link">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>Dashboard Utama</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo site_url('vehicles') ?>" class="nav-link">
                                    <i class="nav-icon fas fa-truck"></i>
                                    <p>Manajemen Kendaraan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo site_url('drivers') ?>" class="nav-link">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>Manajemen Supir</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo site_url('routes') ?>" class="nav-link <?php if ($nopage==4) echo('active') ?>">
                                    <i class="nav-icon fas fa-map-signs"></i>
                                    <p>Rute & Ritasi</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-wrench"></i>
                                    <p>Pemeliharaan & BBM</p>
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <!-- /.sidebar-menu -->
                </div>
                <!-- /.sidebar -->
            </aside>
>>>>>>> 73efc7e9b82e023a3212b22621cfe8b8eff37ad0
