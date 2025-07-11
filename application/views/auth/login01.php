<!DOCTYPE html>
<html lang="zxx">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="description" content="Fleet Management KMP">
	    <meta name="keywords" content="Fleet Management KMP">
	    <link rel="icon" href="<?php echo base_url(); ?>assets/newstyle/dist/img/favicon.ico.png" type="image/x-icon">
		<title>Login | Fleet Management</title>
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/newstyle/login/css/bootstrap.min.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/newstyle/login/css/all.min.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/newstyle/login/css/login.css">
		<style>
			
		</style>
	</head>
	<body>
		<div class="wrapper">
			<div id="particles-js"></div>
			<div class="form-section">
				<div class="container">
					<div class="row">
						<div class="col-sm-12 col-md-6 col-lg-6 col-xl-4 mx-auto">
							<form action="<?php echo site_url('auth/login')?>" id="form1" name="form1" data-parsley-validate method="post" accept-charset="utf-8">
								<div class="particles-form">
									<p class="text-light h3">Fleet Management Login</p>
									<div class="input-box m-30">
										<span class="text-white">Email</span>
										<input type="text" name="identity" id="identity" class="form-control" value="" placeholder="user01@gmail.com" required>
									</div>
									<div class="input-box m-10">
										<span class="text-white">Password</span>
										<input type="password" name="password" id="password" class="form-control" value="" placeholder="***********" required>
									</div>
									<div class="submit-button m-20">
										<input type="submit" class="form-control fw-bold submit-button" value="Login">
									</div>
								</div>
							</form>
						</div>
					</div>

					
				</div>
			</div>
		</div>

		<!-- SweetAlert2 -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/newstyle/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
		<script src="<?php echo base_url(); ?>assets/newstyle/plugins/sweetalert2/sweetalert2.all.min.js"></script>
		
		<?php if ($this->session->flashdata('pesanerror')) { ?>
            <script language="javascript" type="text/javascript">
                window.onload = function() {
                    Swal.fire({
                        title: "Error",
                        text: "<?php echo $this->session->flashdata('pesanerror');?>",
                        icon: "error",
                        confirmButtonText: "Tutup"
                    });
                }
            </script>
            <?php $this->session->unset_userdata('pesanerror') ?>
        <?php } else { ?>
            <!-- sengaja dikosongkan -->
        <?php } ?>

		<script src="<?php echo base_url(); ?>assets/newstyle/login/js/bootstrap.bundle.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/newstyle/login/js/particle.js"></script>
		<script src="<?php echo base_url(); ?>assets/newstyle/login/js/app.js"></script>
	</body>
</html>