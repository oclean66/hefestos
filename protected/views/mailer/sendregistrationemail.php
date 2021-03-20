<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>Metronic | Visual Charts</title>
		<style type="text/css">
			#outlook a{padding:0;} /* Force Outlook to provide a "view in browser" button. */
			body{width:100% !important; margin:0;} 
			body{-webkit-text-size-adjust:none;} /* Prevent Webkit platforms from changing default text sizes. */
			body{margin:0; padding:0;}
			img{border:0; height:auto; line-height:100%; outline:none; text-decoration:none;}
			table td{border-collapse:collapse;}
			#backgroundTable{height:100% !important; margin:0; padding:0; width:100% !important;}
			
			body, #backgroundTable{ background-color:#FFF; }
			.TopbarLogo{
			padding:10px;
			text-align:left;
			vertical-align:middle;
			}
			h1, .h1{
			color:#444444;
			display:block;
			font-family:Open Sans;
			font-size:35px;
			font-weight: 400;
			line-height:100%;
			margin-top:2%;
			margin-right:0;
			margin-bottom:1%;
			margin-left:0;
			text-align:left;
			}
			h2, .h2{
			color:#444444;
			display:block;
			font-family:Open Sans;
			font-size:30px;
			font-weight: 400;
			line-height:100%;
			margin-top:2%;
			margin-right:0;
			margin-bottom:1%;
			margin-left:0;
			text-align:left;
			}
			h3, .h3{
			color:#444444;
			display:block;
			font-family:Open Sans;
			font-size:24px;
			font-weight:400;
			margin-top:2%;
			margin-right:0;
			margin-bottom:1%;
			margin-left:0;
			text-align:left;
			}
			h4, .h4{
			color:#444444;
			display:block;
			font-family:Open Sans;
			font-size:18px;
			font-weight:400;
			line-height:100%;
			margin-top:2%;
			margin-right:0;
			margin-bottom:1%;
			margin-left:0;
			text-align:left;
			}
			h5, .h5{
			color:#444444;
			display:block;
			font-family:Open Sans;
			font-size:14px;
			font-weight:400;
			line-height:100%;
			margin-top:2%;
			margin-right:0;
			margin-bottom:1%;
			margin-left:0;
			text-align:left;
			}
			.textdark { 
			color: #444444;
			font-family: monospace;
			font-size: 13px;
			line-height: 150%;
			text-align: left;
			}
			.textwhite { 
			color: #fff;
			font-family: monospace;
			font-size: 13px;
			line-height: 150%;
			text-align: left;
			}
			.fontwhite { color:#fff; }
			.btn {
			background-color: #e5e5e5;
			background-image: none;
			filter: none;
			border: 0;
			box-shadow: none;
			padding: 7px 14px; 
			text-shadow: none;
			font-family: "Segoe UI", Helvetica, Arial, sans-serif;
			font-size: 14px;  
			color: #333333;
			cursor: pointer;
			outline: none;
			-webkit-border-radius: 0 !important;
			-moz-border-radius: 0 !important;
			border-radius: 0 !important;
			}
			.btn:hover, 
			.btn:focus, 
			.btn:active,
			.btn.active,
			.btn[disabled],
			.btn.disabled {  
			font-family: "Segoe UI", Helvetica, Arial, sans-serif;
			color: #333333;
			box-shadow: none;
			background-color: #d8d8d8;
			}
			.btn.blue   
			{
			color: white;  
			text-shadow: none;
			background-color: #4d90fe;
			}
			.btn.blue:hover, 
			.btn.blue:focus, 
			.btn.blue:active,
			.btn.blue.active,
			.btn.blue[disabled],
			.btn.blue.disabled {  
			background-color: #0362fd !important;
			color: #fff !important;
			}
			.btn.red {
			color: white;
			text-shadow: none;
			background-color: #d84a38;
			}
			.btn.red:hover, 
			.btn.red:focus, 
			.btn.red:active, 
			.btn.red.active,
			.btn.red[disabled], 
			.btn.red.disabled {    
			background-color: #bb2413 !important;
			color: #fff !important;
			}
			.btn.green {
			color: white;
			text-shadow: none; 
			background-color: #35aa47;
			}
			.btn.green:hover, 
			.btn.green:focus, 
			.btn.green:active, 
			.btn.green.active,
			.btn.green.disabled, 
			.btn.green[disabled]{ 
			background-color: #1d943b !important;
			color: #fff !important;
			}
		</style>
	</head>
	<body>
		<table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color:#4aabf9; height:52px;">
			<tr>
				<td align="center">
					<center>
						<table border="0" cellpadding="0" cellspacing="0" width="600px" style="height:100%;">
							<tr>
								
							</tr>
						</table>
					</center>
				</td>
			</tr>
		</table>
		<table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-bottom:1px solid #e7e7e7;">
			<tr>
				<td>
					<center>
						<table border="0" cellpadding="0" cellspacing="0" width="600px" style="height:100%;">
							<tr>
								<td colspan="2" height="20px"></td>
							</tr>
							<tr>
								<td align="left" valign="bottom" style="padding-left:20px; padding-bottom:20px">
									<h1>Bienvenido!</h1>
									<br />
									<div class="textdark">Estimado usuario, este correo se le ha enviado porque se ha creado una cuenta para ud,
                                                                            o se han hecho cambios en su cuenta actual del sistema Siam, 
                                                                            por favor tome nota:</div>
									<br />

									<p><?php echo "usuario: ".$model->username;?></p>
									<p><?php echo "email: ".$model->email;?></p>
									<p><?php echo "su clave es: ".$password;?></p>


									<h3>Debe activar su cuenta:</h3>
									<div class="textdark">Por favor siga este enlace para activar su cuenta:</div>
									<br />
									<a href="<?php echo Yii::app()->user->um->getActivationUrl($model); ?>" class="btn blue">Activar Cuenta</a><br /><br />
								
									<div class="textdark">Por favor tome las precauciones necesarias para guardar esta informacion.
									<a href="www.siamdeportes.com"> www.SiamDeportes.com</a>
									</div>


									
								</td>
								<td align="right" valign="top" width="220px" style="padding-right:20px;">
									<img src="http://siamdeportes.com/siam/themes/abound/img/logo.png"  width="174px" height="174px" alt="Siam logo"/>
								</td>
							</tr>
						</table>
					</center>
				</td>
			</tr>
		</table>




		<table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color:#4aabf9;">
			<tr>
				<td align="center">
					<center>
						<table border="0" cellpadding="0" cellspacing="0" width="600px" style="height:100%;">
							<tr>
								<td align="right" valign="middle" class="textwhite" style="font-size:12px;padding:20px;">
									 
									<br /><br />
									&copy; 2013 SiamDeportes.com
								</td>
							</tr>
						</table>
					</center>
				</td>
			</tr>
		</table>
	</body>
</html>