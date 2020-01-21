<?php  require_once('../class/conexion.php');
$cn=  Conectar();
session_start();

  $listado=  mysql_query("SELECT * from computador, agencia, item where 
    computador.idagencia = agencia.idagencia 
    and computador.idgrupo = agencia.idgrupo
    and computador.idvendedor = agencia.idvendedor
    and computador.idbanca = agencia.idbanca
    and computador.iditem = item.serialitem
    and item.precio !=1
    group by idtransaccion",$cn);
?>
       <script type="text/javascript" language="javascript" src="js/jslistado.js"></script>


            <table cellpadding="0" cellspacing="0" border="0" class="display" id="tabla_lista_pendientes">
                <thead>
                    <tr>
                        <th>Cod.</th> 
                        <th>Cedula</th>
                        <th>Nombre</th>
                        <th>Agencia</th>
                       
                       
                        <th>Accion</th>
                    </tr>
                </thead>
                
                  <tbody>
                    <?php 

     
                   while($reg=  mysql_fetch_array($listado))
                   {
                               echo '<tr>';

                                          
                               echo '<td ><a style=" 
   color:#384046;
   display:block;
   width:100%;
   height:100%; " href="./pdf/ticket.php?id='.mb_convert_encoding($reg['idtransaccion'], "iso-8859-1").'"> '.mb_convert_encoding($reg['idtransaccion'], "iso-8859-1").'</a></td>';
                               echo '<td >'.mb_convert_encoding($reg['cedula'], "iso-8859-1").'</a></td>
                               <td>'.mb_convert_encoding($reg['responsable'], "iso-8859-1").'</a></td>
                               <td>'.mb_convert_encoding($reg['nombre'], "iso-8859-1").'</a></td>';
                               echo '
                                <td><a style=" 
   color:#384046;
   display:block;
   width:100%;
   height:100%; " href="./editfactura.php?reg='.mb_convert_encoding($reg['idtransaccion'], "iso-8859-1").'"><span class="nowrap"><img src="./images/b_edit.png" title="Editar" alt="Editar" class="icon" width="16" height="16">Actualizar</span></a>';

                              echo '</td>'; 


                                 echo '</tr>';
                     
                        }
                    ?>
                <tbody>
            </table>
