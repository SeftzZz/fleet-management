<!DOCTYPE html>
<html lang="id">
  <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>KMP Login</title>
      <link rel="icon" href="<?php echo base_url(); ?>assets/newstyle/dist/img/favicon.ico.png" type="image/x-icon">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">
      <link rel="stylesheet" href="<?php echo base_url(); ?>assets/newstyle/plugins/fontawesome-free/css/all.min.css">
      <link rel="stylesheet" href="<?php echo base_url(); ?>assets/newstyle/code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
      <!-- iCheck -->
      <link rel="stylesheet" href="<?php echo base_url(); ?>assets/newstyle/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    
      <!-- Select2 -->
      <link rel="stylesheet" href="<?php echo base_url(); ?>assets/newstyle/plugins/select2/css/select2.min.css">
      
      <!-- DateRange Picker -->
      <link rel="stylesheet" href="<?php echo base_url(); ?>assets/newstyle/plugins/daterangepicker/daterangepicker.css">
      <link rel="stylesheet" href="<?php echo base_url(); ?>assets/newstyle/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">

      <!-- DataTables -->
      <link rel="stylesheet" href="<?php echo base_url(); ?>assets/newstyle/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
      <link rel="stylesheet" href="<?php echo base_url(); ?>assets/newstyle/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
      <link rel="stylesheet" href="<?php echo base_url(); ?>assets/newstyle/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

      <!-- style -->
      <link rel="stylesheet" href="<?php echo base_url(); ?>assets/newstyle/dist/css/newtheme.css?v=3.2.0">
      <link rel="stylesheet" href="<?php echo base_url(); ?>assets/style.css">
      <!-- overlayScrollbars -->
      <link rel="stylesheet" href="<?php echo base_url(); ?>assets/newstyle/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">

      <!-- SweetAlert2 -->
      <link rel="stylesheet" href="<?php echo base_url(); ?>assets/newstyle/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  </head>
  <body class="hold-transition login-page">
    <div class="login-box">
      <!-- /.login-logo -->
      <div class="card card-outline card-primary">
        <div class="card-header text-center">
          <a href="<?php echo base_url() ?>" class="h1"><b>KMP</b> Login</a>
        </div>
        <div class="card-body">
          <p class="login-box-msg">Sign in to start your session</p>

          <form action="<?php echo base_url('home/auth') ?>" method="post">
            <div class="input-group mb-3">
              <input type="email" class="form-control" placeholder="Email" name="email">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="password" class="form-control" placeholder="Password" name="password_hash">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-8">
                <div class="icheck-primary">
                  <input type="checkbox" id="remember">
                  <label for="remember">
                    Remember Me
                  </label>
                </div>
              </div>
              <!-- /.col -->
              <div class="col-4">
                <button type="submit" class="btn btn-primary btn-block">Sign In</button>
              </div>
              <!-- /.col -->
            </div>
          </form>

          <p class="mb-1">
            <a href="#">I forgot my password</a>
          </p>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.login-box -->
  </body>
</html>