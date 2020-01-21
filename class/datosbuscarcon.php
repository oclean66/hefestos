<?php 
$mysql_host = "localhost";
$mysql_database = "excelencia_mydb";
$mysql_user = "root";
$mysql_password = "jay310887";


 if($link=mysql_connect($mysql_host,$mysql_user,$mysql_password))
 {
     if(mysql_select_db($mysql_database,$link))
	 {
		 mysql_query("SET NAMES 'iso-8859-1'");
	    
	}
}
$sql = "SELECT  var.idconexion,IMEI,numero,operador.operadornombre,conexionnombre,var.idbanca, var.idgrupo, var.idvendedor, fechacompra, 
    fechagregado,idcomputador, var.idoperador, diacorte,monto, var.idagencia,
    idestado,servicio,  clavemovilmensaje,
    clavedatos,modelo, tipoconexion.idtipoconexion 
    from (SELECT idcomputador, conexion.idconexion, conexion.idoperador, 
      fechacompra, clavedatos,clavemovilmensaje,fechagregado,idestado,diacorte,monto,servicio,
      conexion.idmodeloconexion, numero, IMEI, computador.idagencia, computador.idvendedor, 
      computador.idgrupo, computador.idbanca
      from conexion
      left join computador on conexion.idconexion=computador.idconexion) as var, operador, 
  modeloconexion, tipoconexion
  where var.idoperador = operador.idoperador
  and var.idestado != 6
  and var.idmodeloconexion = modeloconexion.idmodeloconexion
  and modeloconexion.idtipoconexion = tipoconexion.idtipoconexion ";

		$res=mysql_query($sql,$link);
		


		echo '<script type="text/javascript" language="JavaScript">
		collection =[';
		  while($reg=  mysql_fetch_array($res) ){

		  	echo '\''.$reg[0].' | '.$reg[4].' | '.$reg[3].' | '.$reg[1].' | '.$reg[2].'\',
		  	';
		  }
		  echo '];</script>';

		
?>