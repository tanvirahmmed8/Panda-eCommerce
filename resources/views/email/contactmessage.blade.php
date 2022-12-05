<!DOCTYPE html>
<html>
<head>

	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="format-detection" content="date=no" />
	<meta name="format-detection" content="address=no" />
	<meta name="format-detection" content="telephone=no" />
	<meta name="x-apple-disable-message-reformatting" />
    <!--[if !mso]><!-->
	<link href="https://fonts.googleapis.com/css?family=Muli:400,400i,700,700i" rel="stylesheet" />
    <!--<![endif]-->
	<title>Email Template</title>
	<style type="text/css" media="screen">
		/* Linked Styles */
		body { padding:0 !important; margin:0 !important; display:block !important; min-width:100% !important; width:100% !important; background:#001736; -webkit-text-size-adjust:none }
		a { color:#66c7ff; text-decoration:none }
		p { padding:0 !important; margin:0 !important }
		img { -ms-interpolation-mode: bicubic; /* Allow smoother rendering of resized image in Internet Explorer */ }
		.mcnPreviewText { display: none !important; }


		/* Mobile styles */
		@media only screen and (max-device-width: 480px), only screen and (max-width: 480px) {
			.mobile-shell { width: 100% !important; min-width: 100% !important; }
			.bg { background-size: 100% auto !important; -webkit-background-size: 100% auto !important; }

			.text-header,
			.m-center { text-align: center !important; }

			.center { margin: 0 auto !important; }
			.container { padding: 20px 10px !important }

			.td { width: 100% !important; min-width: 100% !important; }

			.m-br-15 { height: 15px !important; }
			.p30-15 { padding: 30px 15px !important; }

			.m-td,
			.m-hide { display: none !important; width: 0 !important; height: 0 !important; font-size: 0 !important; line-height: 0 !important; min-height: 0 !important; }

			.m-block { display: block !important; }

			.fluid-img img { width: 100% !important; max-width: 100% !important; height: auto !important; }

			.column,
			.column-top,
			.column-empty,
			.column-empty2,
			.column-dir-top { float: left !important; width: 100% !important; display: block !important; }

			.column-empty { padding-bottom: 10px !important; }
			.column-empty2 { padding-bottom: 30px !important; }

			.content-spacing { width: 15px !important; }
		}
	</style>
</head>
<body class="body" style="padding:0 !important; margin:0 !important; display:block !important; min-width:100% !important; width:100% !important; background:#001736; -webkit-text-size-adjust:none;">
	<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#001736">
		<tr>
			<td align="center" valign="top">
				<table width="650" border="0" cellspacing="0" cellpadding="0" class="mobile-shell">
					<tr>
						<td class="td container" style="width:650px; min-width:650px; font-size:0pt; line-height:0pt; margin:0; font-weight:normal; padding:55px 0px;">
							<!-- Header -->
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td class="p30-15" style="padding: 0px 30px 30px 30px;">
										<table width="100%" border="0" cellspacing="0" cellpadding="0">
											<tr>
												<th class="column-top" width="145" style="font-size:0pt; line-height:0pt; padding:0; margin:0; font-weight:normal; vertical-align:top;">
													<table width="100%" border="0" cellspacing="0" cellpadding="0">
														<tr>
															<td class="img m-center" style="font-size:0pt; line-height:0pt; text-align:left;"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/ce/Coca-Cola_logo.svg/2560px-Coca-Cola_logo.svg.png" width="131" height="38" border="0" alt="" /></td>
														</tr>
													</table>
												</th>
												<th class="column-empty" width="1" style="font-size:0pt; line-height:0pt; padding:0; margin:0; font-weight:normal; vertical-align:top;"></th>
												<th class="column" style="font-size:0pt; line-height:0pt; padding:0; margin:0; font-weight:normal;">
													{{-- <table width="100%" border="0" cellspacing="0" cellpadding="0">
														<tr>
															<td class="text-header" style="color:#475c77; font-family:'Muli', Arial,sans-serif; font-size:12px; line-height:16px; text-align:right;"><a href="#" target="_blank" class="link2" style="color:#475c77; text-decoration:none;"><span class="link2" style="color:#475c77; text-decoration:none;">Open in your browser</span></a></td>
														</tr>
													</table> --}}
												</th>
											</tr>
										</table>
									</td>
								</tr>
							</table>
							<!-- END Header -->

							<!-- Intro -->
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td style="padding-bottom: 10px;">
										<table width="100%" border="0" cellspacing="0" cellpadding="0">
											<tr>
												<td class="tbrr p30-15" style="padding: 60px 30px; border-radius:26px 26px 0px 0px;" bgcolor="#12325c">
													<table width="100%" border="0" cellspacing="0" cellpadding="0">
														<tr>
															<td class="h1 pb25" style="color:#ffffff; font-family:'Muli', Arial,sans-serif; font-size:40px; line-height:46px; text-align:center; padding-bottom:25px;">My name is {{ $info['name'] }}</td>
														</tr>
                                                        <tr>
															<td class="h1 pb25" style="color:#ffffff; font-family:'Muli', Arial,sans-serif; font-size:20px; line-height:16px; text-align:center; padding-bottom:25px;">Subject: {{ $info['subject'] }}</td>
														</tr>
														<tr>
															<td class="text-center pb25" style="color:#c1cddc; font-family:'Muli', Arial,sans-serif; font-size:16px; line-height:10px; text-align:center; padding-bottom:25px;">Email: {{ $info['email'] }}</td>
														</tr>
														<tr>
															<td class="text-center pb25" style="color:#c1cddc; font-family:'Muli', Arial,sans-serif; font-size:16px; line-height:30px; text-align:center; padding-bottom:25px;">{{ $info['message'] }}</td>
														</tr>
														<!-- Button -->
														<tr>
															<td align="center">
																{{-- <table class="center" border="0" cellspacing="0" cellpadding="0" style="text-align:center;">
																	<tr>
																		<td class="pink-button text-button" style="background:#ff6666; color:#c1cddc; font-family:'Muli', Arial,sans-serif; font-size:14px; line-height:18px; padding:12px 30px; text-align:center; border-radius:0px 22px 22px 22px; font-weight:bold;"><a href="#" target="_blank" class="link-white" style="color:#ffffff; text-decoration:none;"><span class="link-white" style="color:#ffffff; text-decoration:none;">CLICK HERE</span></a></td>
																	</tr>
																</table> --}}
															</td>
														</tr>
														<!-- END Button -->
													</table>
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
							<!-- END Intro -->

							<!-- Footer -->
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td class="p30-15 bbrr" style="padding: 50px 30px; border-radius:0px 0px 26px 26px;" bgcolor="#0e264b">
										<table width="100%" border="0" cellspacing="0" cellpadding="0">
											<tr>
												<td align="center" style="padding-bottom: 30px;">
													<table border="0" cellspacing="0" cellpadding="0">
														<tr>
															<td class="img" width="55" style="font-size:0pt; line-height:0pt; text-align:left;"><a href="#" target="_blank"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/05/Facebook_Logo_%282019%29.png/768px-Facebook_Logo_%282019%29.png" width="38" height="38" border="0" alt="" /></a></td>
															<td class="img" width="55" style="font-size:0pt; line-height:0pt; text-align:left;"><a href="#" target="_blank"><img src="https://pnggrid.com/wp-content/uploads/2021/07/Twitter-Logo-Square.png" width="38" height="38" border="0" alt="" /></a></td>
															<td class="img" width="55" style="font-size:0pt; line-height:0pt; text-align:left;"><a href="#" target="_blank"><img src="https://www.freepnglogos.com/uploads/logo-ig-png/logo-ig-stunning-instagram-logo-vector-download-for-new-7.png" width="38" height="38" border="0" alt="" /></a></td>
															<td class="img" width="38" style="font-size:0pt; line-height:0pt; text-align:left;"><a href="#" target="_blank"><img src="https://pnggrid.com/wp-content/uploads/2021/05/Linkedin-logo-Transparent-Image-1024x1024.png" width="38" height="38" border="0" alt="" /></a></td>
														</tr>
													</table>
												</td>
											</tr>
											<tr>
												<td class="text-footer1 pb10" style="color:#c1cddc; font-family:'Muli', Arial,sans-serif; font-size:16px; line-height:20px; text-align:center; padding-bottom:10px;">Bussy - Free HTML Email Template</td>
											</tr>
											<tr>
												<td class="text-footer2" style="color:#8297b3; font-family:'Muli', Arial,sans-serif; font-size:12px; line-height:26px; text-align:center;">East Pixel Bld. 99, Creative City 9000, <br />Republic of Design</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
							<!-- END Footer -->
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</body>
</html>
