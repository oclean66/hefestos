<?php  
function Conectar(){
$mysql_host = "localhost";
$mysql_database = "excelencia_mydb";
$mysql_user = "root";
$mysql_password = "jay310887";


 if($link=mysql_connect($mysql_host,$mysql_user,$mysql_password))
 {
     if(mysql_select_db($mysql_database,$link))
	 {
		 mysql_query("SET NAMES 'iso-8859-1'");
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
?>
