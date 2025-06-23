<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $title ?></title>
        <link rel="icon" href="<?php echo base_url(); ?>assets/newstyle/dist/img/favicon.ico.png" type="image/x-icon">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/newstyle/plugins/fontawesome-free/css/all.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/newstyle/code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- iCheck -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/newstyle/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
        
        <?php if ($nopage==4||$nopage==1001||$nopage==1011||$nopage==1021||$nopage==1031) { ?>
        <!-- Select2 -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/newstyle/plugins/select2/css/select2.min.css">
        
        <!-- DateRange Picker -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/newstyle/plugins/daterangepicker/daterangepicker.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/newstyle/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">

        <!-- DataTables -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/newstyle/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/newstyle/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/newstyle/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
        <?php } ?>

        <!-- style -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/newstyle/dist/css/newtheme.css?v=3.2.0">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/style.css">
        <!-- overlayScrollbars -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/newstyle/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">

        <!-- SweetAlert2 -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/newstyle/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    </head>
    
    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">
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

            <!-- Main Sidebar Container -->
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <a href="index3.html" class="brand-link">
                    <img src="<?php echo base_url(); ?>assets/newstyle/dist/img/LogoTruck.png" class="brand-image">
                    <span class="brand-text font-weight-light">FLEETX</span>
                </a>

                <!-- Sidebar -->
                <div class="sidebar">
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
                                <a href="<?php echo site_url('vehicles') ?>" class="nav-link <?php if ($nopage==1051) echo ('active') ?>" />
                                    <i class="nav-icon fas fa-truck"></i>
                                    <p>Manajemen Kendaraan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo site_url('drivers') ?>" class="nav-link <?php if ($nopage==1041) echo ('active') ?>" />
                                    <i class="nav-icon fas fa-user"></i>
                                    <p>Manajemen Supir</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo site_url('timmgmt') ?>" class="nav-link <?php if ($nopage==1031) echo ('active') ?>" />
                                    <i class="nav-icon fas fa-sitemap"></i>
                                    <p>Manajemen Anggota Tim</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo site_url('routes') ?>" class="nav-link <?php if ($nopage==4) echo ('active') ?>" />
                                    <i class="nav-icon fas fa-map-signs"></i>
                                    <p>Rekapitulasi Ritasi</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-wrench"></i>
                                    <p>Pemeliharaan & BBM</p>
                                </a>
                            </li>
                            <?php if ($nopage==1001||$nopage==1011||$nopage==1021) { ?>
                            <li class="nav-item menu-open">
                            <?php } else { ?>
                            <li class="nav-item">
                            <?php } ?>
                                <a href="#" class="nav-link <?php if ($nopage==1001||$nopage==1011||$nopage==1021) echo ('active') ?>">
                                    <i class="nav-icon fas fa-database"></i>
                                    <p>Manajemen Data<i class="fas fa-angle-left right"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?php echo site_url('proyek') ?>" class="nav-link <?php if ($nopage==1011) echo('active') ?>" />
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Proyek</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo site_url('lokasigalian') ?>" class="nav-link <?php if ($nopage==1021) echo('active') ?>" />
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Lokasi Galian</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo site_url('uangjalan') ?>" class="nav-link <?php if ($nopage==1001) echo('active') ?>" />
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Uang Jalan</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo site_url('reimbursement') ?>" class="nav-link <?php if ($nopage==1061) echo('active') ?>" />
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Reimbursement</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Kendaraan</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                    <!-- /.sidebar-menu -->
                </div>
                <!-- /.sidebar -->
            </aside>

            
