<?php  require_once('Connections/localhost.php'); ?>
<?php 
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE usuario SET nombre=%s, clave=%s, usuario=%s WHERE idusuario=%s",
                       GetSQLValueString($_POST['nombre'], "text"),
                       GetSQLValueString(md5($_POST['clave']), "text"),
                       GetSQLValueString($_POST['usuario'], "text"),
                       GetSQLValueString($_POST['idusuario'], "int"));

  mysql_select_db($database_localhost, $localhost);
  $Result1 = mysql_query($updateSQL, $localhost) or die(mysql_error());
}

mysql_select_db($database_localhost, $localhost);
$query_Recordset1 = "SELECT * FROM usuario where idusuario='".$_GET['id']."' and clave='".md5($_GET['cl'])."'";
$Recordset1 = mysql_query($query_Recordset1, $localhost) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
if($totalRows_Recordset1==0){?>
<script language="JavaScript" type="text/javascript">
document.location='login.php';
</script>

<?php 
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Actualizar Claves</title>
<style type="text/css">
body {
	background-image: url(images/bg2.png);
}
#form1 table {
}
#form1 #nuevo {
	background-image: url(images/login-box-backg.png);
	background-repeat: no-repeat;
	position: static;
	height: 450px;
	width: 480px;
	margin-bottom: 10px;
	padding-top: 120px;
}
#form1 #nuevo {
	color: #CCC;
}
</style>
</head>

<body>
<form action="<?php  echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <div align="center">
    
  </div>
  <div id="nuevo" style="width:485px; margin-top: 15%; margin-bottom: 15%; margin-left: auto; margin-right: auto; ; background-image: /tio/bh.png;text-align: center;">
    <h3>Actualize su informacion para poder utilizar</h3>
    <h3> el sistemas por primera vez </h3>
  <table align="center">
    
    <tr valign="baseline">
      <td width="79" align="right" nowrap="nowrap"><div align="center">Nombre:</div></td>
      <td width="192"><input type="text" name="nombre" value="<?php  echo htmlentities($row_Recordset1['nombre'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
   
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="center">Usuario:</div></td>
      <td><input type="text" name="usuario" value="<?php  echo htmlentities($row_Recordset1['usuario'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
     <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="center">Clave:</div></td>
      <td><input type="password" name="clave" value="<?php  echo htmlentities('', ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Actualizar registro" /></td>
    </tr>
  </table></div>
  <p>
    <input type="hidden" name="MM_update" value="form1" />
    <input type="hidden" name="idusuario" value="<?php  echo $row_Recordset1['idusuario']; ?>" />
  </p>
</form>
<p>&nbsp;</p>
</body>
</html>
<?php 
mysql_free_result($Recordset1);
?>
