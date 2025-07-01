<html>
	<body>
		<table style='box-sizing: border-box; font-size: 14px; width: 100%; margin: 0;'>
			<tr style='box-sizing: border-box; font-size: 14px; margin: 0;'>
				<td>&nbsp;</td>
				<td style='box-sizing: border-box; font-size: 14px; vertical-align: top; display: block !important; max-width: 600px !important; clear: both !important; margin: 0 auto;' valign='top' width='600'>
					<div style='box-sizing: border-box; font-size: 14px; max-width: 600px; display: block; margin: 0 auto; padding: 20px;'>
						<table style='box-sizing: border-box; font-size: 14px; border-radius: 3px; background-color: #fff; margin: 0; border: 1px solid #e9e9e9;' width='100%' cellspacing='0' cellpadding='0' bgcolor='#fff'>
							<tr style='box-sizing: border-box; font-size: 14px; margin: 0;'>
								<td style='box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 20px;' valign='top'>
									<table style='box-sizing: border-box; font-size: 14px; margin: 0;' width='100%' cellspacing='0' cellpadding='0'>
										<tr style='box-sizing: border-box; font-size: 14px; margin: 0;'>
											<td style='box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;' valign='top'>
												Reset Password untuk username <?php echo $identity; ?>
											</td>
										</tr>
										<tr style='box-sizing: border-box; font-size: 14px; margin: 0;'>
											<td style='box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;' valign='top'>
												Silakan klik link berikut untuk <?php echo anchor('auth/reset_password/'. $forgotten_password_code, 'Reset Password');?>
												<br/> Link ini hanya berlaku selama 30 menit.
											</td>
										</tr>
										<tr style='box-sizing: border-box; font-size: 14px; margin: 0;'>
											<td style='box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;' valign='top'>
												&mdash; Admin PMO reCOnsult &mdash;
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</div>
				</td>
				<td>&nbsp;</td>
			</tr>
		</table>
	</body>
</html>