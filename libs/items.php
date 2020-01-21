<?php  require_once('conexion.php');

session_start();
$cn=  conectar();
if($_SESSION['lista']=='0'){

  $sql = 'SELECT var.idbanca, var.idgrupo, var.idvendedor, fechagregado, 
  idcomputador, var.serialitem, var.idagencia,status,
  var.idestado,tipo, nombremodel, tipoitem.idtipoitem
  from (SELECT idcomputador, item.serialitem,
    fechagregado,idestado,
    item.modelo_idmodelo, computador.idagencia, computador.idvendedor, 
    computador.idgrupo, computador.idbanca
    from item
    left join computador on item.serialitem=computador.iditem) as var,  
modelo, tipoitem, estado
where var.idestado != 6
and var.idestado = estado.idestado
and var.modelo_idmodelo = modelo.idmodelo
and modelo.idtipoitem = tipoitem.idtipoitem';


}elseif ($_SESSION['lista']=='a') {
  $sql = 'SELECT var.idbanca, var.idgrupo, var.idvendedor, fechagregado, 
  idcomputador, var.serialitem, var.idagencia,status,
  var.idestado,tipo, nombremodel, tipoitem.idtipoitem
  from (SELECT idcomputador, item.serialitem,
    fechagregado,idestado,
    item.modelo_idmodelo, computador.idagencia, computador.idvendedor, 
    computador.idgrupo, computador.idbanca
    from item
    left join computador on item.serialitem=computador.iditem) as var,  
modelo, tipoitem, estado
where var.idestado = 1
and var.idestado = estado.idestado
and var.modelo_idmodelo = modelo.idmodelo
and modelo.idtipoitem = tipoitem.idtipoitem';

}elseif ($_SESSION['lista']=='b') {
 $sql = 'SELECT var.idbanca, var.idgrupo, var.idvendedor, fechagregado, 
 idcomputador, var.serialitem, var.idagencia,status,
 var.idestado,tipo, nombremodel, tipoitem.idtipoitem
 from (SELECT idcomputador, item.serialitem,
  fechagregado,idestado,
  item.modelo_idmodelo, computador.idagencia, computador.idvendedor, 
  computador.idgrupo, computador.idbanca
  from item
  left join computador on item.serialitem=computador.iditem) as var,  
modelo, tipoitem, estado
where var.idestado = 2
and var.idestado = estado.idestado
and var.modelo_idmodelo = modelo.idmodelo
and modelo.idtipoitem = tipoitem.idtipoitem';

}elseif ($_SESSION['lista']=='c') {
  $sql = 'SELECT var.idbanca, var.idgrupo, var.idvendedor, fechagregado, 
  idcomputador, var.serialitem, var.idagencia,status,
  var.idestado,tipo, nombremodel, tipoitem.idtipoitem
  from (SELECT idcomputador, item.serialitem,
    fechagregado,idestado,
    item.modelo_idmodelo, computador.idagencia, computador.idvendedor, 
    computador.idgrupo, computador.idbanca
    from item
    left join computador on item.serialitem=computador.iditem) as var,  
modelo, tipoitem, estado
where var.idestado = 3
and var.idestado = estado.idestado
and var.modelo_idmodelo = modelo.idmodelo
and modelo.idtipoitem = tipoitem.idtipoitem';
}elseif ($_SESSION['lista']=='d') {
  $sql = 'SELECT var.idbanca, var.idgrupo, var.idvendedor, fechagregado, 
  idcomputador, var.serialitem, var.idagencia,status,nombre,
  var.idestado,tipo, nombremodel, tipoitem.idtipoitem
  from (SELECT idcomputador, item.serialitem,
    fechagregado,idestado,
    item.modelo_idmodelo, computador.idagencia, computador.idvendedor, 
    computador.idgrupo, computador.idbanca
    from item
    left join computador on item.serialitem=computador.iditem) as var,  
modelo, tipoitem, estado, agencia
where var.idestado = 5
and var.idagencia = agencia.idagencia
and var.idestado = estado.idestado
and var.modelo_idmodelo = modelo.idmodelo
and modelo.idtipoitem = tipoitem.idtipoitem';

}elseif ($_SESSION['lista']=='e') {
 $sql = 'SELECT var.idbanca, var.idgrupo, var.idvendedor, fechagregado, 
 idcomputador, var.serialitem, var.idagencia,status,
 var.idestado,tipo, nombremodel, tipoitem.idtipoitem
 from (SELECT idcomputador, item.serialitem,
  fechagregado,idestado,
  item.modelo_idmodelo, computador.idagencia, computador.idvendedor, 
  computador.idgrupo, computador.idbanca
  from item
  left join computador on item.serialitem=computador.iditem) as var,  
modelo, tipoitem, estado
where var.idestado = 4
and var.idestado = estado.idestado
and var.modelo_idmodelo = modelo.idmodelo
and modelo.idtipoitem = tipoitem.idtipoitem';
}elseif ($_SESSION['lista']=='f') {

  $sql = 'SELECT var.justificacion,var.idbanca, var.idgrupo, var.idvendedor, fechagregado, 
  idcomputador, var.serialitem, var.idagencia,status,
  var.idestado,tipo, nombremodel, tipoitem.idtipoitem
  from (SELECT idcomputador, item_baja.serialitem,item_baja.justificacion,
    fechagregado,idestado,
    item_baja.modelo_idmodelo, computador.idagencia, computador.idvendedor, 
    computador.idgrupo, computador.idbanca
    from item_baja
    left join computador on item_baja.serialitem=computador.iditem) as var,  
modelo, tipoitem, estado
where var.idestado = estado.idestado
and  var.modelo_idmodelo = modelo.idmodelo
and modelo.idtipoitem = tipoitem.idtipoitem';

}else {
  $sql = 'SELECT var.idbanca, var.idgrupo, var.idvendedor, fechagregado, 
  idcomputador, var.serialitem, var.idagencia,status,
  var.idestado,tipo, nombremodel, tipoitem.idtipoitem
  from (SELECT idcomputador, item.serialitem,
    fechagregado,idestado,
    item.modelo_idmodelo, computador.idagencia, computador.idvendedor, 
    computador.idgrupo, computador.idbanca
    from item
    left join computador on item.serialitem=computador.iditem) as var,  
modelo, tipoitem, estado
where  var.idestado = estado.idestado
and var.modelo_idmodelo = modelo.idmodelo
and modelo.idtipoitem = tipoitem.idtipoitem 
and tipoitem.idtipoitem="'.$_SESSION['lista'].'"';


} 

$listado=  mysql_query($sql,$cn);

?>

<script type="text/javascript" language="javascript" src="js/jslistado.js"></script>
<script>
function eliminar(id){
  if(confirm('Seguro quiere Eliminar este registro ? '+id)){
   obj = id;
   cambiar(6);
   return true;
 }else return false;
}
</script>

<table cellpadding="0" cellspacing="0" border="0" class="display" id="tabla_lista_items">
  <thead>
    <tr>

      <th>Nº</th>
      <th>Serial</th> 
      <th>Tipo</th>
      <th>Modelo</th>
      <th>Estado</th>
      <?php  if ($_SESSION['lista']=='f') echo '<th>Justificacion</th>';
      else echo '<th>Agencia</th>';?>

      <th>Accion</th>
    </tr>
  </thead>

  <tbody>
    <?php 
    $j=0;     
    while($reg=  mysql_fetch_array($listado))
    {
      $j++;
      echo '<tr ';
      if($reg['idestado']=='5')echo 'style="background-color: rgb(248, 200, 112)"'; 
      if($reg['idestado']=='6')echo 'style="background-color: #F87070"'; 
      if($reg['idestado']=='3')echo 'style="background-color: #6780FF"'; 
      if($reg['idestado']=='4')echo 'style="background-color: #55F123"'; 
      if($reg['idestado']=='1')echo 'style="background-color: #CFCFCF"'; 
      echo ' >';
      echo '<td >'.$j.'</td>';
      echo '<td >'.mb_convert_encoding($reg['serialitem'], "iso-8859-1").'</td>';
      echo '<td >'.mb_convert_encoding($reg['tipo'], "iso-8859-1").'</td>';           

      echo '<td >'.mb_convert_encoding($reg['nombremodel'], "iso-8859-1").'</td>';
      echo '<td >'.mb_convert_encoding($reg['status'], "iso-8859-1").'</td>';    
       if ($_SESSION['lista']=='f') 
          echo '<td>'.$reg["justificacion"].'</td>';
        else 
          echo '<td ><a href="computador.php?age='.$reg["idagencia"].'&gr='.$reg['idgrupo'].'&ven='.$reg['idvendedor'].'&ban='.$reg['idbanca'].' ">'.mb_convert_encoding($reg['idagencia'], "iso-8859-1").'</a></td>';
        echo '<td>';
      
      if($reg['idestado']!='5'){
        echo '<a href="./edititem.php?it='.mb_convert_encoding($reg['serialitem'], "iso-8859-1").'"><span class="nowrap"><img src="./images/b_edit.png" title="Editar" alt="Editar" class="icon" width="16" height="16"></span></a>';
        echo '<a id="baseDiv" href="#" onclick=\'mostrar("'.mb_convert_encoding($reg['serialitem'], "iso-8859-1").'")\'><span class="nowrap"><img src="./images/b_browse.png" title="Mover" alt="Mover" class="icon" width="16" height="16"></span></a>';                      
 
      } 

      if($reg['idestado']!='6' && $reg['idestado']!='5') 
        echo '<a onClick="return eliminar(\''.mb_convert_encoding($reg['serialitem'], "iso-8859-1").'\')" href="#"><span class="nowrap"><img src="./images/b_drop.png" title="Borrar" alt="Borrar" class="icon" width="16" height="16"></span></a>';

      if($reg['idestado']=='5') echo '

        <a onClick="return confirm(\'Seguro quiere Recibir este registro?\');" href="computador.php?age='.$reg["idagencia"].'&gr='.$reg['idgrupo'].'&ven='.$reg['idvendedor'].'&ban='.$reg['idbanca'].'&del='.mb_convert_encoding($reg['idcomputador'], "iso-8859-1").'&d=1"><span class="nowrap"><img src="./images/recibir.png" title="Recibir" alt="Recibir" class="icon" width="16" height="16"></span></a>

      '; 
      echo '</td>'; 
      echo '</tr>';

    }
    ?>
    <tbody>
    </table>
    <!-- <a onClick="return confirm(\'Seguro quiere eliminar este registro?\');"  href="./item.php?del='.mb_convert_encoding($reg['serialitem'], "iso-8859-1").'"><span class="nowrap"><img src="./images/b_inline_edit.png" title="Borrar" alt="Borrar" class="icon" width="16" height="16">Mover</span></a> -->





  </body>