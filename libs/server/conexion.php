<?php  

function Conectar(){
$mysql_host = "mysql4.000webhost.com";
$mysql_database = "a3219922_excelen";
$mysql_user = "a3219922_root";
$mysql_password = "jay310887";


 if($link=mysql_connect($mysql_host,$mysql_user,$mysql_password))
 {
     if(mysql_select_db($mysql_database,$link))
	 {
		 mysql_query("SET NAMES 'utf8'");
	    return $link;
	 }
	 else
	    echo '<script language="JavaScript" type="text/javascript">
	     alert("Imposible seleccionar BD");
		 </script>'; 
 }
 else
 {
  echo '<script language="JavaScript" type="text/javascript">
	     alert("No se pudo conectar con BD");
		 </script>';
 }
 
}

function desconectar()
{
	mysql_close();
}
function get()
{
	return $link;
}

?>
