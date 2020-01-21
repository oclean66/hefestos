<?php  require_once('conexion.php');

session_start();
$cn=  conectar();
     $sql = 'SELECT * from tipoconexion';     

$listado=  mysql_query($sql,$cn);

?>

 <script type="text/javascript" language="javascript" src="js/jslistado.js"></script>



            <table cellpadding="0" cellspacing="0" border="0" class="display" id="tabla_lista_tipoconexion">
                <thead>
                    <tr>
                        
                        
                        <th>Descripcion</th>
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
                              
                            
                              echo '<td >'.mb_convert_encoding($reg['conexionnombre'], "iso-8859-1").'</td>';
                              
                              echo '
                                <td>
                                <a href="./edittipocn.php?it='.mb_convert_encoding($reg['idtipoconexion'], "iso-8859-1").'"><span class="nowrap"><img src="./images/b_edit.png" title="Editar" alt="Editar" class="icon" width="16" height="16"> Editar</span></a>                        
                                <a onClick="return confirm(\'Seguro quiere eliminar este registro?\');"  href="./tipoconexion.php?del='.mb_convert_encoding($reg['idtipoconexion'], "iso-8859-1").'"><span class="nowrap"><img src="./images/b_drop.png" title="Borrar" alt="Borrar" class="icon" width="16" height="16"> Borrar</span></a>
                                
                                </td>'; 

                              echo '</tr>';
                     
                        }
                    $cn=  desconectar();?>
                <tbody>
            </table>
