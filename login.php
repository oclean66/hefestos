<?php 

session_start();
define('INCLUDE_CHECK',true);
include 'class/conexion.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Inventario</title>
<link rel="shortcut icon" href="images/favicon.png">

<link href="css/login-box.css" rel="stylesheet" type="text/css" />
<style type="text/css">
body {
	background: url(images/cyan_coffeegrass.jpg);
	background-repeat: repeat;
	
}
</style>
</head>

<body  onload = "document.forms[0]['username'].focus()">
<?php  

// Those two files can be included only if INCLUDE_CHECK is defined


session_name('tzLogin');
// Starting the session

session_set_cookie_params(2*7*24*60*60);
// Making the cookie live for 2 weeks



if(isset($_SESSION['id']) && !isset($_COOKIE['tzRemember']) && !isset($_SESSION['rememberMe']))
{
	// If you are logged in, but you don't have the tzRemember cookie (browser restart)
	// and you have not checked the rememberMe checkbox:

	$_SESSION = array();
	session_destroy();
	
	// Destroy the session
}


if(isset($_GET['logoff']))
{
	$_SESSION = array();
	session_destroy();
	
	header("Location: demo.php");
	exit;
}


//----------------------------------------
if(isset($_POST["login"]))
{

	if(!$_POST['username'] || !$_POST['password'])
		$err = 'Por favor, Rellene los campos!';
	
	if(!isset($err))
	{
		
		$user = ($_POST['username']);
		$clave = ($_POST['password']);
		
		
		// Escaping all input data
		
		$link=Conectar();
		$sql="select idusuario, clave, nombre, grupousr_idgrupousr from usuario
		 where usuario='".$user."' and clave ='".md5($clave)."'";

		$res=mysql_query($sql,$link);
		if($row=mysql_fetch_array($res))
		{
			if($clave==1234){
			?>
				<script language="JavaScript" type="text/javascript">
				document.location='actualizar.php?id=<?php  echo $row['idusuario'] ?>&cl=1234';
				</script>

			<?php 
			}
			// If everything is OK login
			
			$_SESSION['usr']=$row['nombre'];
			$_SESSION['id'] = $row['idusuario'];
			$_SESSION['grupouser'] = $row['grupousr_idgrupousr'];
			$_SESSION['user']=$user;
			
			
			// Store some data in the session
			
			?>
				<script language="JavaScript" type="text/javascript">
				document.location='home.php';
				</script>

			<?php 
		
		
		}else $err='Error en nombre de usuario o contraseña!';
	
	}
	
	
	
 
}
?>

<div style="width:485px; margin-top: 15%; margin-bottom: 15%; margin-left: auto; margin-right: auto; ;background-image: /tio/bh.png;">


<div id="login-box">
 <form id="form1" name="form1" method="post" action="">
<H2>Iniciar Sesion</H2>
Inicie sesion para continuar
<br />
<br />
<div id="login-box-name" style="margin-top:20px;">Usuario:</div><div id="login-box-field" style="margin-top:20px;">
<input name="username" id ="username "  class="form-login" title="Username" value="" size="30" maxlength="2048" /></div>

<div id="login-box-name">Contrase&ntilde;a:</div><div id="login-box-field">
<input name="password" id="password" type="password" class="form-login" title="Password" value="" size="30" maxlength="2048" /></div>

<div id="login-box-name"></div>
<div id="login-box-field">
<input name="login" type="submit" id="login" value="Iniciar Sesion" /></div>
<?php  if(isset($err))
		echo $err;
		?>



</form>
</div>
 
</div>













</body>
</html>
