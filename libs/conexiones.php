<?php  require_once('../class/conexion.php');

session_start();

$cn=  Conectar();
if($_SESSION['lista']=='0'){
  $listado=  mysql_query("SELECT var.idbanca, var.idgrupo, var.idvendedor, fechacompra, 
    fechagregado,idcomputador, var.idconexion, var.idoperador, diacorte,monto, var.idagencia,
    idestado,servicio,IMEI,numero,conexionnombre, operador.operadornombre, clavemovilmensaje,
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
  and modeloconexion.idtipoconexion = tipoconexion.idtipoconexion",$cn);



}else if($_SESSION['lista']=='a'){
  $listado=  mysql_query("SELECT var.idbanca, var.idgrupo, var.idvendedor, fechacompra, 
    fechagregado,idcomputador, var.idconexion, var.idoperador, diacorte,monto, justificacion,var.idagencia,
    idestado,servicio,IMEI,numero,conexionnombre, operador.operadornombre, clavemovilmensaje,
    clavedatos,modelo, tipoconexion.idtipoconexion 
    from (SELECT idcomputador, conexion_baja.idconexion, conexion_baja.idoperador, 
      fechacompra, clavedatos,clavemovilmensaje,fechagregado,idestado,diacorte,monto,servicio, justificacion,
      conexion_baja.idmodeloconexion, numero, IMEI, computador.idagencia, computador.idvendedor, 
      computador.idgrupo, computador.idbanca
      from conexion_baja
      left join computador on conexion_baja.idconexion=computador.idconexion) as var, operador, 
  modeloconexion, tipoconexion
  where var.idoperador = operador.idoperador
  and var.idestado = 6
  and var.idmodeloconexion = modeloconexion.idmodeloconexion
  and modeloconexion.idtipoconexion = tipoconexion.idtipoconexion",$cn);

}else if($_SESSION['lista']=='z'){
  $listado=  mysql_query("SELECT var.idbanca, var.idgrupo, var.idvendedor, fechacompra, 
    fechagregado,idcomputador, var.idconexion, var.idoperador, diacorte,monto, var.idagencia,
    idestado,servicio,IMEI,numero,conexionnombre, operador.operadornombre, clavemovilmensaje,
    clavedatos,modelo, tipoconexion.idtipoconexion 
    from (SELECT idcomputador, conexion.idconexion, conexion.idoperador, 
      fechacompra, clavedatos,clavemovilmensaje,fechagregado,idestado,diacorte,monto,servicio,
      conexion.idmodeloconexion, numero, IMEI, computador.idagencia, computador.idvendedor, 
      computador.idgrupo, computador.idbanca
      from conexion
      left join computador on conexion.idconexion=computador.idconexion) as var, operador, 
  modeloconexion, tipoconexion
  where var.idoperador = operador.idoperador
  and var.idestado = 5
  and var.idmodeloconexion = modeloconexion.idmodeloconexion
  and modeloconexion.idtipoconexion = tipoconexion.idtipoconexion",$cn);

}else if($_SESSION['lista']=='y'){
  $listado=  mysql_query("SELECT var.idbanca, var.idgrupo, var.idvendedor, fechacompra, 
    fechagregado,idcomputador, var.idconexion, var.idoperador, diacorte,monto, var.idagencia,
    idestado,servicio,IMEI,numero,conexionnombre, operador.operadornombre, clavemovilmensaje,
    clavedatos,modelo, tipoconexion.idtipoconexion 
    from (SELECT idcomputador, conexion.idconexion, conexion.idoperador, 
      fechacompra, clavedatos,clavemovilmensaje,fechagregado,idestado,diacorte,monto,servicio,
      conexion.idmodeloconexion, numero, IMEI, computador.idagencia, computador.idvendedor, 
      computador.idgrupo, computador.idbanca
      from conexion
      left join computador on conexion.idconexion=computador.idconexion) as var, operador, 
  modeloconexion, tipoconexion
  where var.idoperador = operador.idoperador
  and var.idestado = 2
  and var.idmodeloconexion = modeloconexion.idmodeloconexion
  and modeloconexion.idtipoconexion = tipoconexion.idtipoconexion",$cn);


}else{

  $listado=  mysql_query("SELECT var.idbanca, var.idgrupo, var.idvendedor, fechacompra, 
    fechagregado,idcomputador, var.idconexion, var.idoperador, diacorte,monto, var.idagencia,
    idestado,servicio,IMEI,numero,conexionnombre, operador.operadornombre, clavemovilmensaje,
    clavedatos,modelo, tipoconexion.idtipoconexion from (SELECT idcomputador, conexion.idconexion, conexion.idoperador, 
      fechacompra, clavedatos,clavemovilmensaje,fechagregado,idestado,diacorte,monto,servicio,
      conexion.idmodeloconexion, numero, IMEI, computador.idagencia, computador.idvendedor, 
      computador.idgrupo, computador.idbanca
      from conexion
      left join computador on conexion.idconexion=computador.idconexion) as var, operador, modeloconexion, tipoconexion
  where var.idoperador = operador.idoperador
  and var.idmodeloconexion = modeloconexion.idmodeloconexion
  and modeloconexion.idtipoconexion = tipoconexion.idtipoconexion
  and tipoconexion.idtipoconexion=".$_SESSION['lista'],$cn);
}
?>
<script type="text/javascript" language="javascript" src="js/jslistado.js"></script>


<table cellpadding="0" cellspacing="0" border="0" class="display" id="tabla_lista_conexiones">
  <thead>
    <tr style="text-align:center;">
      <th>id</th> 
      <th>Tipo</th> 
      <th>Modelo</th>
      <th>Numero</th> 
      <th>IMEI / SERIAL</th>

      <th>Operador</th>
      
      <th>Renta</th>
      <?php  if($_SESSION['lista']!='a')
           echo '<th>Agencia</th>';
        else
           echo'<th>Justificacion</th>';

      ?>

      
      
      <th>Accion</th>
    </tr>
  </thead>

  <tbody>
    <?php 


    while($reg=  mysql_fetch_array($listado))
    {

      if($reg['fechagregado']){
        $aux = new DateTime($reg['fechagregado']);
        $fecha = $aux->format('d-m-Y');
      }
      else $fecha="";

      echo '<tr '; 
      if($reg['idestado']=='5')echo 'style="background-color: rgb(248, 200, 112)" title="Agregado el '.$fecha.' (Prestado)">';  
      elseif($reg['idestado']=='6')echo 'style="background-color: #F87070" title="Agregado el '.$fecha.' (Eliminado)">';  
      elseif($reg['idestado']=='3')echo 'style="background-color: #6780FF" title="Agregado el '.$fecha.' (Reparacion)">';  
      elseif($reg['idestado']=='4')echo 'style="background-color: #55F123" title="Agregado el '.$fecha.' (Robado)">'; 
      elseif($reg['idestado']=='1')echo 'style="background-color: #CFCFCF" title="Agregado el '.$fecha.' (Almacen)">';  else echo 'title="Agregado el '.$fecha.' (Libre)">'; 

      echo '<td ><a href="#"> '.mb_convert_encoding($reg['idconexion'], "iso-8859-1").'</a></td>';           
      echo '<td ><a href="conexion.php?st='.$reg['idtipoconexion'].'"> '.mb_convert_encoding($reg['conexionnombre'], "iso-8859-1").'</a></td>';           
      echo '<td ><a href="#"> '.mb_convert_encoding($reg['modelo'], "iso-8859-1").'</a></td>';
      echo '<td ><a href="#"> '.mb_convert_encoding($reg['numero'], "iso-8859-1").'</a></td>';


      echo '<td ><a href="#" > '.mb_convert_encoding($reg['IMEI'], "iso-8859-1").'</a></td>';

      echo '<td ><a href="#"> '.mb_convert_encoding($reg['operadornombre'], "iso-8859-1").'</a></td>';

      if($reg['servicio']=='1')
        $service='Pre-Pago';
      if($reg['servicio']=='2')
        $service='Corporativo';
      if($reg['servicio']=='3')
       $service='No tiene';

     if($reg['fechacompra']){
      $fecha2 = new DateTime($reg['fechacompra']);
      $fechacompra = $fecha2->format('d-m-Y');
    }
    else $fechacompra="";

    echo '<td ><a href="#"> '.mb_convert_encoding($reg['monto'], "iso-8859-1").' Bs los dias '.mb_convert_encoding($reg['diacorte'], "iso-8859-1").' ('.$service.')</a></td>';

    if($_SESSION['lista']!='a') echo '<td ><a href="computador.php?age='.$reg["idagencia"].'&gr='.$reg['idgrupo'].'&ven='.$reg['idvendedor'].'&ban='.$reg['idbanca'].' ">'.mb_convert_encoding($reg['idagencia'], "iso-8859-1").'</a></td>';
    else echo '<td >'.mb_convert_encoding($reg['justificacion'], "iso-8859-1").'</td>';
    echo '<td ><a onClick="return alert(\'Clave Movil Mensajes: '.mb_convert_encoding($reg['clavemovilmensaje'], "iso-8859-1").'\nClave de datos: '.mb_convert_encoding($reg['clavedatos'], "iso-8859-1").'\nFecha de compra: '.$fechacompra.' \nTipo de servicio: '.$service.'\');"  href="#"><span class="nowrap"><img src="./images/b_browse.png" title="Detalles" alt="Detalles" class="icon" width="16" height="16"></span></a>';
    
    if($_SESSION['lista']!='a'){
    echo '<a href="./editconexion.php?reg='.mb_convert_encoding($reg['idconexion'], "iso-8859-1").'"><span class="nowrap"><img src="./images/b_edit.png" title="Editar" alt="Editar" class="icon" width="16" height="16"></span></a>';

    if($reg['idestado']!='5') 
      echo '<a id="baseDiv" href="#" onclick=\'mostrar("'.mb_convert_encoding($reg['idconexion'], "iso-8859-1").'")\'><span class="nowrap"><img src="./images/b_drop.png" class="icon" title="Mover" alt="Mover" width="16" height="16"></span></a>';                      

    if($reg['idestado']=='5') 
      echo '<a onClick="return confirm(\'Seguro quiere recibir este registro?\');" href="computador.php?age='.$reg["idagencia"].'&gr='.$reg['idgrupo'].'&ven='.$reg['idvendedor'].'&ban='.$reg['idbanca'].'&del='.mb_convert_encoding($reg['idcomputador'], "iso-8859-1").'&t='.$reg['idconexion'].'"><span class="nowrap"><img src="./images/recibir.png" title="Recibir" alt="Recibir" class="icon" width="16" height="16"></span></a>'; 
}
    echo '</td>'; 
    echo '</tr>';

  }
  ?>
  <tbody>
  </table>
