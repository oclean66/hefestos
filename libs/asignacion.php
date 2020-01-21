<?php  require_once('conexion.php');

session_start();
$cn=  conectar();
if($_SESSION['tipo']==4){

       $sql = '(SELECT idcomputador, idtransaccion, fechaprestamo, computador.iditem,agencia.idagencia,
            agencia.idgrupo,agencia.idvendedor,agencia.idbanca,
            usuario.nombre as nombre, agencia.nombre as nombreag, grupo.nombre as nombregr,
            vendedor.nombre as nombreven, banca.nombre as nombreban, tipo, nombremodel as modelo,"" as operador
      from computador,item,tipoitem,usuario,agencia,grupo,vendedor,banca,modelo
       where computador.iditem = item.serialitem
       and computador.idusuario = usuario.idusuario
       and computador.idagencia = agencia.idagencia
       and computador.idgrupo = grupo.idgrupo
       and computador.idvendedor = vendedor.idvendedor
       and computador.idbanca = banca.idbanca
       and item.idtipoitem = tipoitem.idtipoitem
       and agencia.idgrupo = grupo.idgrupo
       and agencia.idvendedor = vendedor.idvendedor
       and agencia.idbanca = banca.idbanca
       and grupo.idvendedor = vendedor.idvendedor
       and grupo.idbanca = banca.idbanca
       and vendedor.idbanca = banca.idbanca
       and modelo.idmodelo = item.modelo_idmodelo 
       and agencia.idbanca = "'.$_SESSION["banca"].'"
       and agencia.idvendedor = "'.$_SESSION['vendedor'].'"
       and agencia.idgrupo = "'.$_SESSION['grupo'].'"
       and agencia.idagencia = "'.$_SESSION['agencia'].'"
       order by fechaprestamo desc)
union 
(SELECT idcomputador, idtransaccion, fechaprestamo, conexion.IMEI,agencia.idagencia,
            agencia.idgrupo,agencia.idvendedor,agencia.idbanca,
            usuario.nombre as nombre, agencia.nombre as nombreag, grupo.nombre as nombregr,
            vendedor.nombre as nombreven, banca.nombre as nombreban, conexionnombre as tipo, modelo,concat("(",operadornombre,")") as operador
      from computador,conexion,tipoconexion,usuario,agencia,grupo,vendedor,banca,modeloconexion,operador 
       where computador.idconexion = conexion.idconexion
       and computador.idusuario = usuario.idusuario
       and computador.idagencia = agencia.idagencia
       and computador.idgrupo = grupo.idgrupo
       and computador.idvendedor = vendedor.idvendedor
       and computador.idbanca = banca.idbanca
       and modeloconexion.idtipoconexion = tipoconexion.idtipoconexion
       and agencia.idgrupo = grupo.idgrupo
       and agencia.idvendedor = vendedor.idvendedor
       and agencia.idbanca = banca.idbanca
       and grupo.idvendedor = vendedor.idvendedor
       and grupo.idbanca = banca.idbanca
       and conexion.idoperador = operador.idoperador
       and vendedor.idbanca = banca.idbanca
       and modeloconexion.idmodeloconexion = conexion.idmodeloconexion
       and agencia.idbanca = "'.$_SESSION["banca"].'"
       and agencia.idvendedor = "'.$_SESSION['vendedor'].'"
       and agencia.idgrupo = "'.$_SESSION['grupo'].'"
       and agencia.idagencia = "'.$_SESSION['agencia'].'"
       order by fechaprestamo desc) order by fechaprestamo desc';

       $url='?age='.$_SESSION['agencia'].'&gr='.$_SESSION['grupo'].'&ven='.$_SESSION['vendedor'].'&ban='.$_SESSION['banca'];

     }else
       if($_SESSION['tipo']==3){
       $sql = '(SELECT idcomputador, idtransaccion, fechaprestamo, computador.iditem,agencia.idagencia,
            agencia.idgrupo,agencia.idvendedor,agencia.idbanca,
            usuario.nombre as nombre, agencia.nombre as nombreag, grupo.nombre as nombregr,
            vendedor.nombre as nombreven, banca.nombre as nombreban, tipo, nombremodel as modelo,"" as operador
      from computador,item,tipoitem,usuario,agencia,grupo,vendedor,banca,modelo
       where computador.iditem = item.serialitem
       and computador.idusuario = usuario.idusuario
       and computador.idagencia = agencia.idagencia
       and computador.idgrupo = grupo.idgrupo
       and computador.idvendedor = vendedor.idvendedor
       and computador.idbanca = banca.idbanca
       and item.idtipoitem = tipoitem.idtipoitem
       and agencia.idgrupo = grupo.idgrupo
       and agencia.idvendedor = vendedor.idvendedor
       and agencia.idbanca = banca.idbanca
       and grupo.idvendedor = vendedor.idvendedor
       and grupo.idbanca = banca.idbanca
       and vendedor.idbanca = banca.idbanca
       and modelo.idmodelo = item.modelo_idmodelo 
       and agencia.idbanca = "'.$_SESSION["banca"].'"
       and agencia.idvendedor = "'.$_SESSION['vendedor'].'"
       and agencia.idgrupo = "'.$_SESSION['grupo'].'"
       order by fechaprestamo desc)
union 
(SELECT idcomputador, idtransaccion, fechaprestamo, conexion.IMEI,agencia.idagencia,
            agencia.idgrupo,agencia.idvendedor,agencia.idbanca,
            usuario.nombre as nombre, agencia.nombre as nombreag, grupo.nombre as nombregr,
            vendedor.nombre as nombreven, banca.nombre as nombreban, conexionnombre as tipo, modelo,concat("(",operadornombre,")") as operador
      from computador,conexion,tipoconexion,usuario,agencia,grupo,vendedor,banca,modeloconexion,operador
       where computador.idconexion = conexion.idconexion
       and computador.idusuario = usuario.idusuario
       and computador.idagencia = agencia.idagencia
       and computador.idgrupo = grupo.idgrupo
       and conexion.idoperador = operador.idoperador
       and computador.idvendedor = vendedor.idvendedor
       and computador.idbanca = banca.idbanca
       and modeloconexion.idtipoconexion = tipoconexion.idtipoconexion
       and agencia.idgrupo = grupo.idgrupo
       and agencia.idvendedor = vendedor.idvendedor
       and agencia.idbanca = banca.idbanca
       and grupo.idvendedor = vendedor.idvendedor
       and grupo.idbanca = banca.idbanca
       and vendedor.idbanca = banca.idbanca
       and modeloconexion.idmodeloconexion = conexion.idmodeloconexion
       and agencia.idbanca = "'.$_SESSION["banca"].'"
       and agencia.idvendedor = "'.$_SESSION['vendedor'].'"
       and agencia.idgrupo = "'.$_SESSION['grupo'].'"
       order by fechaprestamo desc)';

       $url='?gr='.$_SESSION['grupo'].'&ven='.$_SESSION['vendedor'].'&ban='.$_SESSION['banca'];
     }else

           if($_SESSION['tipo']==2){
        $sql = '(SELECT idcomputador, idtransaccion, fechaprestamo, computador.iditem,agencia.idagencia,
            agencia.idgrupo,agencia.idvendedor,agencia.idbanca,
            usuario.nombre as nombre, agencia.nombre as nombreag, grupo.nombre as nombregr,
            vendedor.nombre as nombreven, banca.nombre as nombreban, tipo, nombremodel as modelo,"" as operador
      from computador,item,tipoitem,usuario,agencia,grupo,vendedor,banca,modelo
       where computador.iditem = item.serialitem
       and computador.idusuario = usuario.idusuario
       and computador.idagencia = agencia.idagencia
       and computador.idgrupo = grupo.idgrupo
       and computador.idvendedor = vendedor.idvendedor
       and computador.idbanca = banca.idbanca
       and item.idtipoitem = tipoitem.idtipoitem
       and agencia.idgrupo = grupo.idgrupo
       and agencia.idvendedor = vendedor.idvendedor
       and agencia.idbanca = banca.idbanca
       and grupo.idvendedor = vendedor.idvendedor
       and grupo.idbanca = banca.idbanca
       and vendedor.idbanca = banca.idbanca
       and modelo.idmodelo = item.modelo_idmodelo 
       and agencia.idbanca = "'.$_SESSION["banca"].'"
       and agencia.idvendedor = "'.$_SESSION['vendedor'].'"
       order by fechaprestamo desc)
union 
(SELECT idcomputador, idtransaccion, fechaprestamo, conexion.IMEI,agencia.idagencia,
            agencia.idgrupo,agencia.idvendedor,agencia.idbanca,
            usuario.nombre as nombre, agencia.nombre as nombreag, grupo.nombre as nombregr,
            vendedor.nombre as nombreven, banca.nombre as nombreban, conexionnombre as tipo, modelo,
            concat("(",operadornombre,")") as operador
      from computador,conexion,tipoconexion,usuario,agencia,grupo,vendedor,banca,modeloconexion,operador
       where computador.idconexion = conexion.idconexion
       and computador.idusuario = usuario.idusuario
       and computador.idagencia = agencia.idagencia
       and computador.idgrupo = grupo.idgrupo
       and computador.idvendedor = vendedor.idvendedor
       and computador.idbanca = banca.idbanca
       and operador.idoperador = conexion.idoperador
       and modeloconexion.idtipoconexion = tipoconexion.idtipoconexion
       and agencia.idgrupo = grupo.idgrupo
       and agencia.idvendedor = vendedor.idvendedor
       and agencia.idbanca = banca.idbanca
       and grupo.idvendedor = vendedor.idvendedor
       and grupo.idbanca = banca.idbanca
       and vendedor.idbanca = banca.idbanca
       and modeloconexion.idmodeloconexion = conexion.idmodeloconexion
       and agencia.idbanca = "'.$_SESSION["banca"].'"
       and agencia.idvendedor = "'.$_SESSION['vendedor'].'"
       order by fechaprestamo desc)';

       $url='?ven='.$_SESSION['vendedor'].'&ban='.$_SESSION['banca'];
     }else
       if($_SESSION['tipo']==1){
        $sql = '(SELECT idcomputador, idtransaccion, fechaprestamo, computador.iditem,agencia.idagencia,
            agencia.idgrupo,agencia.idvendedor,agencia.idbanca,
            usuario.nombre as nombre, agencia.nombre as nombreag, grupo.nombre as nombregr,
            vendedor.nombre as nombreven, banca.nombre as nombreban, tipo, nombremodel as modelo,"" as operador
      from computador,item,tipoitem,usuario,agencia,grupo,vendedor,banca,modelo
       where computador.iditem = item.serialitem
       and computador.idusuario = usuario.idusuario
       and computador.idagencia = agencia.idagencia
       and computador.idgrupo = grupo.idgrupo
       and computador.idvendedor = vendedor.idvendedor
       and computador.idbanca = banca.idbanca
       and item.idtipoitem = tipoitem.idtipoitem
       and agencia.idgrupo = grupo.idgrupo
       and agencia.idvendedor = vendedor.idvendedor
       and agencia.idbanca = banca.idbanca
       and grupo.idvendedor = vendedor.idvendedor
       and grupo.idbanca = banca.idbanca
       and vendedor.idbanca = banca.idbanca
       and modelo.idmodelo = item.modelo_idmodelo 
       and agencia.idbanca = "'.$_SESSION["banca"].'"
       order by fechaprestamo desc)
union 
(SELECT idcomputador, idtransaccion, fechaprestamo, conexion.IMEI,agencia.idagencia,
            agencia.idgrupo,agencia.idvendedor,agencia.idbanca,
            usuario.nombre as nombre, agencia.nombre as nombreag, grupo.nombre as nombregr,
            vendedor.nombre as nombreven, banca.nombre as nombreban, conexionnombre as tipo, modelo,concat("(",operadornombre,")") as operador
      from computador,conexion,tipoconexion,usuario,agencia,grupo,vendedor,banca,modeloconexion,operador
       where computador.idconexion = conexion.idconexion
       and computador.idusuario = usuario.idusuario
       and computador.idagencia = agencia.idagencia
       and computador.idgrupo = grupo.idgrupo
       and computador.idvendedor = vendedor.idvendedor
       and computador.idbanca = banca.idbanca
       and modeloconexion.idtipoconexion = tipoconexion.idtipoconexion
       and agencia.idgrupo = grupo.idgrupo
       and conexion.idoperador = operador.idoperador
       and agencia.idvendedor = vendedor.idvendedor
       and agencia.idbanca = banca.idbanca
       and grupo.idvendedor = vendedor.idvendedor
       and grupo.idbanca = banca.idbanca
       and vendedor.idbanca = banca.idbanca
       and modeloconexion.idmodeloconexion = conexion.idmodeloconexion
       and agencia.idbanca = "'.$_SESSION["banca"].'"
       order by fechaprestamo desc)';
      $url='?ban='.$_SESSION['banca'];

     }
  
$listado=  mysql_query($sql,$cn);

?>

 <script type="text/javascript" language="javascript" src="js/jslistado.js"></script>



            <table cellpadding="0" cellspacing="0" border="0" class="display" id="tabla_lista_asignacion">
                <thead>
                    <tr>
                        
                        <th>#</th>
                        <th>Ticket</th>
                         <th>Fecha</th>
                        <th>Serial</th>
                        <th>Tipo</th>
                        <th>Modelo</th>
                        <?php  if($_SESSION['tipo']==3)echo " <th>Agencia</th>";  ?>
                        <th>Usuario</th>
                       
                        <th>Accion</th>
                    </tr>
                </thead>
                
                  <tbody>
                    <?php 
                    $j=0;     
                   while($reg=  mysql_fetch_array($listado))
                   {
                    
                              $j++;
                              echo '<tr>';
                              echo '<td >'.$j.'</td>';
                              echo '<td ><a href="pdf/ticket.php?id='.$reg['idtransaccion'].'" TARGET="_new">'.$reg['idtransaccion'].'</a></td>';
                              echo '<td >'.date("d-m-y",strtotime ($reg['fechaprestamo'])).'</td>';    
                              echo '<td >'.mb_convert_encoding($reg['iditem'], "iso-8859-1").'</td>';   
                              echo '<td >'.mb_convert_encoding($reg['tipo'].' '.$reg['operador'], "iso-8859-1").'</td>';
                              echo '<td >'.mb_convert_encoding($reg['modelo'], "iso-8859-1").'</td>';
                             
                               if($_SESSION['tipo']==3) echo '<td >'.mb_convert_encoding($reg['idagencia'].' - '.$reg['nombreag'], "iso-8859-1").'</td>';
  
                              echo '<td >'.mb_convert_encoding($reg['nombre'], "iso-8859-1").'</td>';
                              echo '
                                <td>
                                  <a onClick="return confirm(\'Seguro quiere recibir este registro?\');"  href="./computador.php'.$url.'&del='.mb_convert_encoding($reg['idcomputador'], "iso-8859-1").'"><span class="nowrap"><img src="./images/recibir.png" title="Borrar" alt="Borrar" class="icon" width="16" height="16"> Recibir</span></a>
                                
                                </td>'; 

                              echo '</tr>';
                     
                        }
                         
                     $cn=  desconectar();?>
                <tbody>
            </table>
