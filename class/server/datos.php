<?php 

$mysql_host = "mysql4.000webhost.com";
$mysql_database = "a3219922_excelen";
$mysql_user = "a3219922_root";
$mysql_password = "jay310887";


 if($link=mysql_connect($mysql_host,$mysql_user,$mysql_password))
 {
     if(mysql_select_db($mysql_database,$link))
	 {
		 mysql_query("SET NAMES 'utf8'");
	    
	}
}
$sql = "Select serialitem, nombreitem from item where not exists (select 1 from computador where computador.iditem = item.serialitem  and fechadevolucion = null ) and idestado = 2";

		$res=mysql_query($sql,$link);
		


		echo '<script type="text/javascript" language="JavaScript">
		collection =[';
		  while($reg=  mysql_fetch_array($res) ){

		  	echo '\''.$reg[0].' - '.$reg[1].'\',
		  	';
		  }
		  echo '];</script>';

		
?>