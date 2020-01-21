<?php 
$mysql_host = "mysql4.000webhost.com";
$mysql_database = "a3219922_excelen";
$mysql_user = "a3219922_root";
$mysql_password = "jay310887";


 if($link=mysql_connect($mysql_host,$mysql_user,$mysql_password))
 {
     if(mysql_select_db($mysql_database,$link))
	 {
		 mysql_query("SET NAMES 'iso-8859-1'");
	    
	}
}
$sql = "SELECT iditem, tipo, agencia.idagencia, agencia.nombre, idcomputador
FROM computador, agencia, grupo, vendedor, banca, item,tipoitem
where computador.idagencia = agencia.idagencia
and computador.idgrupo = grupo.idgrupo
and computador.idvendedor = vendedor.idvendedor
and computador.idbanca = banca.idbanca
and agencia.idgrupo = grupo.idgrupo
and agencia.idvendedor = vendedor.idvendedor
and agencia.idbanca = banca.idbanca
and grupo.idvendedor = vendedor.idvendedor
and grupo.idbanca = banca.idbanca
and vendedor.idbanca = banca.idbanca
and item.serialitem = computador.iditem
and item.idtipoitem = tipoitem.idtipoitem";

		$res=mysql_query($sql,$link);
		


		echo '<script type="text/javascript" language="JavaScript">
		collection =[';
		  while($reg=  mysql_fetch_array($res) ){

		  	echo '\''.$reg[0].' - '.$reg[1].' - '.$reg[2].' - '.$reg[3].' - '.$reg[4].'\',
		  	';
		  }
		  echo '];</script>';

		
?>