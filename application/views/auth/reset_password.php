<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Lupa Password</title>

		<!-- Global stylesheets -->
		<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
		<link href="<?php echo base_url(); ?>assets/presensi/global_assets/css/icons/icomoon/styles.min.css" rel="stylesheet" type="text/css">
		<link href="<?php echo base_url(); ?>assets/presensi/css/bootstrap.min.css" rel="stylesheet" type="text/css">
		<link href="<?php echo base_url(); ?>assets/presensi/css/bootstrap_limitless.min.css" rel="stylesheet" type="text/css">
		<link href="<?php echo base_url(); ?>assets/presensi/css/layout.min.css" rel="stylesheet" type="text/css">
		<link href="<?php echo base_url(); ?>assets/presensi/css/components.min.css" rel="stylesheet" type="text/css">
		<link href="<?php echo base_url(); ?>assets/presensi/css/colors.min.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/sweetalert/sweetalert.css">
		<!-- /global stylesheets -->

		<!-- Core JS files -->
		<script src="<?php echo base_url(); ?>assets/presensi/global_assets/js/main/jquery.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/presensi/global_assets/js/main/bootstrap.bundle.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/presensi/global_assets/js/plugins/loaders/blockui.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/presensi/global_assets/js/plugins/ui/ripple.min.js"></script>
		<!-- /core JS files -->

		<!-- Theme JS files -->
		<script src="<?php echo base_url(); ?>assets/presensi/js/app.js"></script>
		<script src="<?php echo base_url(); ?>assets/sweetalert/sweetalert.min.js" type="text/javascript"></script>
		<!-- /theme JS files -->

		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=G-R5D43WNHP8"></script>
		<script>
		  	window.dataLayer = window.dataLayer || [];
		  	function gtag(){dataLayer.push(arguments);}
		  	gtag('js', new Date());

		  	gtag('config', 'G-R5D43WNHP8');
		</script>
	</head>

	<body>

		<!-- Main navbar -->
		<div class="navbar navbar-expand-md navbar-dark bg-primary navbar-static">
			<div class="navbar-brand">
				<a href="#">
					<img src="<?php echo base_url(); ?>assets/img/LogoCO.png" alt="" style="height:22px;margin-left:15px;">
				</a>
			</div>
		</div>
		<!-- /main navbar -->

		<!-- Page content -->
		<div class="page-content">
			<!-- Main content -->
			<div class="content-wrapper">
				<!-- Content area -->
				<div class="content d-flex justify-content-center align-items-center">

					<!-- Password recovery form -->
					<form id="form1" name="form1" action="<?php echo site_url('auth/reset_password/'.$code)?>" method="post" enctype="multipart/form-data">
						<div class="card mb-0">
							<div class="card-body">
								<div class="text-center mb-3">
									<i class="icon-lock icon-2x text-indigo border-indigo border-3 rounded-round p-3 mb-3 mt-1"></i>
									<h5 class="mb-0">Ganti Password</h5>
									<span class="d-block text-muted">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Password harus 8 karakter atau lebih &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
								</div>

								<div class="form-group">
									<input type="password" class="form-control" name="new" required="" placeholder="Passowrd Baru" />

									<input type="password" class="form-control" name="new_confirm" required="" placeholder="Konfirmasi Passowrd Baru" />
								</div>

								<?php echo form_input($user_id);?>
								<?php echo form_hidden($csrf); ?>
								<input type="submit" name="submit" class="btn bg-blue btn-block" value="&nbsp;&nbsp;&nbsp;Kirim&nbsp;&nbsp;&nbsp;">
							</div>
						</div>
					</form>
					<!-- /password recovery form -->

					<?php if ($this->session->flashdata('message')) { ?>	
						<script language="javascript" type="text/javascript">
							window.onload = function(){
								swal({
									title: "Gagal!",
									text: "<?php echo $this->session->flashdata('message'); ?>",
									type: "error",
									confirmButtonText: "Close"
								});
							}
						</script>	
					<?php } elseif (strlen($message) == 71) { ?>	
						<script language="javascript" type="text/javascript">
							window.onload = function(){
								swal({
									title: "Gagal!",
									text: "Password kurang dari 8 karakter",
									type: "error",
									confirmButtonText: "Close"
								});
							}
						</script>	
					<?php } elseif (strlen($message) == 77) { ?>	
						<script language="javascript" type="text/javascript">
							window.onload = function(){
								swal({
									title: "Gagal!",
									text: "Password tidak sama",
									type: "error",
									confirmButtonText: "Close"
								});
							}
						</script>	
					<?php } else { ?>	
						&nbsp;
					<?php } ?>
				</div>
				<!-- /content area -->


				<!-- Footer -->
				<div class="navbar navbar-expand-lg navbar-light">
					<div class="text-center d-lg-none w-100">
						<button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse" data-target="#navbar-footer">
							<i class="icon-unfold mr-2"></i>
							Footer
						</button>
					</div>

					<div class="navbar-collapse collapse" id="navbar-footer">
					<span class="navbar-text">
						&copy; 2020. <a href="http://www.reconsult.co.id" target="_blank">reCOnsult</a>
					</span>
				</div>
				</div>
				<!-- /footer -->

			</div>
			<!-- /main content -->

		</div>
		<!-- /page content -->

	</body>
</html>
