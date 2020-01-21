<?php  require_once('conexion.php');

session_start();
$cn=  conectar();

       $sql = 'SELECT idcomputador, idtransaccion, fechaprestamo, computador.iditem, 
       usuario.nombre as nombre, agencia.nombre as nombreag, grupo.nombre as nombregr, 
       vendedor.nombre as nombreven, banca.nombre as nombreban, tipo, nombremodel, banca.idbanca,
        vendedor.idvendedor, grupo.idgrupo,agencia.idagencia
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
       and fechaprestamo >= "'.date("Y-m-d H:i:s",strtotime ($_SESSION['week1'])).'"
       and fechaprestamo <= "'.date("Y-m-d H:i:s",strtotime ($_SESSION['week2'])).'"
      order by fechaprestamo desc';
  

$listado=  mysql_query($sql,$cn);

?>

 <script type="text/javascript" language="javascript" src="js/jslistado.js"></script>



            <table cellpadding="0" cellspacing="0" border="0" class="display" 
            id="tabla_lista_computador" 
            style="border-top: 1px solid;
                  border-bottom: 1px solid;
                  font-size: 12px;">
                <thead>
                    <tr>
                        
                        <th>#</th>
                        <th>Ticket</th>
                         <th>FechaSalida</th>
                        <th>Serial</th>
                        <th>Tipo</th>
                        <th>Modelo</th>
                        
                        <th>Agencia</th>
                        <th>Grupo</th> 
                        <!-- <th>Vendedor</th>                          
                        <th>Banca</th> -->
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
                              echo '<td ><a href="pdf/ticket.php?id='.$reg['idtransaccion'].'" TARGET="_new" >'.$reg['idtransaccion'].'</a></td>';
                              echo '<td >'.date("d M y",strtotime ($reg['fechaprestamo'])).'</td>';    
                              echo '<td >'.mb_convert_encoding($reg['iditem'], "iso-8859-1").'</td>';   
                              echo '<td >'.mb_convert_encoding($reg['tipo'], "iso-8859-1").'</td>';
                              echo '<td >'.mb_convert_encoding($reg['nombremodel'], "iso-8859-1").'</td>';
                             
                              echo '<td ><a href="computador.php?age='.$reg['idagencia'].'&gr='.$reg['idgrupo'].'&ven='.$reg['idvendedor'].'&ban='.$reg['idbanca'].'">'.mb_convert_encoding($reg['idagencia'].' '.$reg['nombreag'], "iso-8859-1").'</a></td>';
                              echo '<td ><a href="computador.php?gr='.$reg['idgrupo'].'&ven='.$reg['idvendedor'].'&ban='.$reg['idbanca'].'">'.mb_convert_encoding($reg['idgrupo'].' '.$reg['nombregr'], "iso-8859-1").'</a></td>';
                              // echo '<td >'.mb_convert_encoding($reg['nombreven'], "iso-8859-1").'</td>';
                              // echo '<td >'.mb_convert_encoding($reg['nombreban'], "iso-8859-1").'</td>';
                                echo '<td >'.mb_convert_encoding($reg['nombre'], "iso-8859-1").'</td>';
                              echo '
                                <td>
                                  <a onClick="return confirm(\'Seguro quiere recibir este registro?\');"  href="./computador.php?age='.$reg['idagencia'].'&gr='.$reg['idgrupo'].'&ven='.$reg['idvendedor'].'&ban='.$reg['idbanca'].'&del='.mb_convert_encoding($reg['idcomputador'], "iso-8859-1").'"><span class="nowrap"><img src="./images/recibir.png" title="Borrar" alt="Borrar" class="icon" width="16" height="16"> Recibir</span></a>
                                
                                </td>'; 

                              echo '</tr>';
                     
                        }
                   $cn=  desconectar();
 ?>
                <tbody>
            </table>
            