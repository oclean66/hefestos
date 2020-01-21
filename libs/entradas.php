<?php  require_once('conexion.php');

session_start();
$cn=  conectar();
if (isset($_SESSION['week1']) && isset($_SESSION['week2']) ){
$sql = '(SELECT idcomputador, idtransaccion, fechadevolucion, reciboscomputador.iditem, usuario.nombre as nombre, agencia.idagencia, agencia.idgrupo,agencia.idvendedor, agencia.idbanca,agencia.nombre as nombreag, grupo.nombre as nombregr, vendedor.nombre as nombreven, banca.nombre as nombreban, tipo, nombremodel
        from reciboscomputador,item,tipoitem,usuario,agencia,grupo,vendedor,banca,modelo
       where reciboscomputador.iditem = item.serialitem
       and reciboscomputador.idusuariorecibo = usuario.idusuario
       and reciboscomputador.idagencia = agencia.idagencia
       and reciboscomputador.idgrupo = grupo.idgrupo
       and reciboscomputador.idvendedor = vendedor.idvendedor
       and reciboscomputador.idbanca = banca.idbanca
       and item.idtipoitem = tipoitem.idtipoitem
       and agencia.idgrupo = grupo.idgrupo
       and agencia.idvendedor = vendedor.idvendedor
       and agencia.idbanca = banca.idbanca
       and grupo.idvendedor = vendedor.idvendedor
       and grupo.idbanca = banca.idbanca
       and vendedor.idbanca = banca.idbanca
       and modelo.idmodelo = item.modelo_idmodelo
       and fechadevolucion >= "'.date("Y-m-d H:i:s",strtotime ($_SESSION['week1'])).'"
       and fechadevolucion <= "'.date("Y-m-d H:i:s",strtotime ($_SESSION['week2'])).'") 
union
(SELECT idcomputador, idtransaccion, fechadevolucion, conexion.IMEI, usuario.nombre as nombre,agencia.idagencia,agencia.idgrupo,agencia.idvendedor, agencia.idbanca, agencia.nombre as nombreag, grupo.nombre as nombregr, vendedor.nombre as nombreven, banca.nombre as nombreban, conexionnombre, modelo
        from reciboscomputador,conexion,tipoconexion,usuario,agencia,grupo,vendedor,banca,modeloconexion
       where reciboscomputador.idconexion = conexion.idconexion
       and reciboscomputador.idusuariorecibo = usuario.idusuario
       and reciboscomputador.idagencia = agencia.idagencia
       and reciboscomputador.idgrupo = grupo.idgrupo
       and reciboscomputador.idvendedor = vendedor.idvendedor
       and reciboscomputador.idbanca = banca.idbanca
       and modeloconexion.idtipoconexion = tipoconexion.idtipoconexion
       and agencia.idgrupo = grupo.idgrupo
       and agencia.idvendedor = vendedor.idvendedor
       and agencia.idbanca = banca.idbanca
       and grupo.idvendedor = vendedor.idvendedor
       and grupo.idbanca = banca.idbanca
       and vendedor.idbanca = banca.idbanca
       and modeloconexion.idmodeloconexion = conexion.idmodeloconexion
       and fechadevolucion >= "'.date("Y-m-d H:i:s",strtotime ($_SESSION['week1'])).'"
       and fechadevolucion <= "'.date("Y-m-d H:i:s",strtotime ($_SESSION['week2'])).'")  ORDER BY fechadevolucion desc';

}
else{

       $sql = '(SELECT idcomputador, idtransaccion, fechadevolucion, reciboscomputador.iditem, usuario.nombre as nombre, agencia.idagencia, agencia.idgrupo,agencia.idvendedor, agencia.idbanca,agencia.nombre as nombreag, grupo.nombre as nombregr, vendedor.nombre as nombreven, banca.nombre as nombreban, tipo, nombremodel
        from reciboscomputador,item,tipoitem,usuario,agencia,grupo,vendedor,banca,modelo
       where reciboscomputador.iditem = item.serialitem
       and reciboscomputador.idusuariorecibo = usuario.idusuario
       and reciboscomputador.idagencia = agencia.idagencia
       and reciboscomputador.idgrupo = grupo.idgrupo
       and reciboscomputador.idvendedor = vendedor.idvendedor
       and reciboscomputador.idbanca = banca.idbanca
       and item.idtipoitem = tipoitem.idtipoitem
       and agencia.idgrupo = grupo.idgrupo
       and agencia.idvendedor = vendedor.idvendedor
       and agencia.idbanca = banca.idbanca
       and grupo.idvendedor = vendedor.idvendedor
       and grupo.idbanca = banca.idbanca
       and vendedor.idbanca = banca.idbanca
       and modelo.idmodelo = item.modelo_idmodelo
       and fechadevolucion >= "'.date("Y-m-d H:i:s",strtotime ("last Monday")).'"
       and fechadevolucion <= "'.date("Y-m-d H:i:s",strtotime ("next Saturday")).'") 
union
(SELECT idcomputador, idtransaccion, fechadevolucion, conexion.IMEI, usuario.nombre as nombre,agencia.idagencia,agencia.idgrupo,agencia.idvendedor, agencia.idbanca, agencia.nombre as nombreag, grupo.nombre as nombregr, vendedor.nombre as nombreven, banca.nombre as nombreban, conexionnombre, modelo
        from reciboscomputador,conexion,tipoconexion,usuario,agencia,grupo,vendedor,banca,modeloconexion
       where reciboscomputador.idconexion = conexion.idconexion
       and reciboscomputador.idusuariorecibo = usuario.idusuario
       and reciboscomputador.idagencia = agencia.idagencia
       and reciboscomputador.idgrupo = grupo.idgrupo
       and reciboscomputador.idvendedor = vendedor.idvendedor
       and reciboscomputador.idbanca = banca.idbanca
       and modeloconexion.idtipoconexion = tipoconexion.idtipoconexion
       and agencia.idgrupo = grupo.idgrupo
       and agencia.idvendedor = vendedor.idvendedor
       and agencia.idbanca = banca.idbanca
       and grupo.idvendedor = vendedor.idvendedor
       and grupo.idbanca = banca.idbanca
       and vendedor.idbanca = banca.idbanca
       and modeloconexion.idmodeloconexion = conexion.idmodeloconexion
       and fechadevolucion >= "'.date("Y-m-d H:i:s",strtotime ("last Monday")).'"
       and fechadevolucion <= "'.date("Y-m-d H:i:s",strtotime ("next Saturday")).'") ORDER BY fechadevolucion desc';
}

$listado=  mysql_query($sql,$cn);
?>

 <script type="text/javascript" language="javascript" src="js/jslistado.js"></script>



            <table cellpadding="0" cellspacing="0" border="0" class="display" id="tabla_lista_entrada">
                <thead>
                    <tr>
                        
                        <th>#</th>
                        <th>Ticket</th>
                         <th>FechaEntrada</th>
                        <th>Serial</th>
                        <th>Tipo</th>
                        <th>Modelo</th>
                        
                        <th>Agencia</th>
                        <th>Grupo</th> 
                        <!-- <th>Vendedor</th>                          
                        <th>Banca</th> -->
                        <th>Usuario</th>
                       
                       
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
                              echo '<td >'.$reg['idtransaccion'].'</td>';
                               echo '<td >'.date("d M y",strtotime ($reg['fechadevolucion'])).'</td>'; 
                              echo '<td >'.mb_convert_encoding($reg['iditem'], "iso-8859-1").'</td>';   
                              echo '<td >'.mb_convert_encoding($reg['tipo'], "iso-8859-1").'</td>';
                              echo '<td >'.mb_convert_encoding($reg['nombremodel'], "iso-8859-1").'</td>';
                               
                               echo '<td ><a href="computador.php?age='.$reg['idagencia'].'&gr='.$reg['idgrupo'].'&ven='.$reg['idvendedor'].'&ban='.$reg['idbanca'].'">'.mb_convert_encoding($reg['idagencia'].' '.$reg['nombreag'], "iso-8859-1").'</a></td>';
                              echo '<td ><a href="computador.php?gr='.$reg['idgrupo'].'&ven='.$reg['idvendedor'].'&ban='.$reg['idbanca'].'">'.mb_convert_encoding($reg['idgrupo'].' '.$reg['nombregr'], "iso-8859-1").'</a></td>';
                           
   // echo '<td >'.mb_convert_encoding($reg['nombreven'], "iso-8859-1").'</td>';
                              // echo '<td >'.mb_convert_encoding($reg['nombreban'], "iso-8859-1").'</td>';
                                echo '<td >'.mb_convert_encoding($reg['nombre'], "iso-8859-1").'</td>';
                              

                              echo '</tr>';
                     
                        }
                    ?>
                <tbody>
            </table>
