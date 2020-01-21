<?php  require_once('../class/conexion.php');
$cn=  Conectar();
$listado=  mysql_query("SELECT * from factura ",$cn);
?>
       <script type="text/javascript" language="javascript" src="js/jslistado.js"></script>


            <table cellpadding="0" cellspacing="0" border="0" class="display" id="tabla_lista_compras">
                <thead>
                    <tr>
                        <th>Cod. Factura</th> 
                        <th>Fecha de compra</th>
                         <th>Fecha de registro</th>
                         <th>Proveedor</th>
                       
                       
                        <!-- <th>Accion</th> -->
                    </tr>
                </thead>
                
                  <tbody>
                    <?php 

     
                   while($reg=  mysql_fetch_array($listado))
                   {
                               echo '<tr>';

                                          
                               echo '<td ><a href="./pdf/factura.php?id='.$reg['idfactura'].'" TARGET="_new">'.mb_convert_encoding($reg['idfactura'], "iso-8859-1").'</a></td>';
                                echo '<td >'.mb_convert_encoding($reg['fecha'], "iso-8859-1").'</td>';
                                 echo '<td >'.mb_convert_encoding($reg['fecharegistro'], "iso-8859-1").'</td>';
                                  echo '<td >'.mb_convert_encoding($reg['proveedor'], "iso-8859-1").'</td>';
                              
                                // echo '
                                // <td><a href="./editcompra.php?reg='.mb_convert_encoding($reg['idfactura'], "iso-8859-1").'"><span class="nowrap"><img src="./images/b_edit.png" title="Editar" alt="Editar" class="icon" width="16" height="16"> Editar</span></a>                        
                                //   <a onClick="return confirm(\'Seguro quiere eliminar este registro?\');"  href="./banca.php?del='.mb_convert_encoding($reg['idfactura'], "iso-8859-1").'"><span class="nowrap"><img src="./images/b_drop.png" title="Borrar" alt="Borrar" class="icon" width="16" height="16"> Borrar</span></a>
                                // </td>'; 

                                 echo '</tr>';
                     
                        }
                    ?>
                <tbody>
            </table>
