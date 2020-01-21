<?php  require_once('conexion.php');

session_start();
$cn=  conectar();
     $sql = 'SELECT * from modelo, tipoitem where modelo.idtipoitem = tipoitem.idtipoitem';     

$listado=  mysql_query($sql,$cn);

?>

 <script type="text/javascript" language="javascript" src="js/jslistado.js"></script>



            <table cellpadding="0" cellspacing="0" border="0" class="display" id="tabla_lista_modelos">
                <thead>
                    <tr>
                        
                        
                        <th>Descripcion</th>
                         <th>Tipo</th>
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
                              
                             
                              echo '<td >'.mb_convert_encoding($reg['nombremodel'], "iso-8859-1").'</td>';
                              echo '<td >'.mb_convert_encoding($reg['tipo'], "iso-8859-1").'</td>';
                              
                              echo '
                                <td>
                                <a href="./editmodel.php?it='.mb_convert_encoding($reg['idmodelo'], "iso-8859-1").'"><span class="nowrap"><img src="./images/b_edit.png" title="Editar" alt="Editar" class="icon" width="16" height="16"> Editar</span></a>                        
                                <a onClick="return confirm(\'Seguro quiere eliminar este registro?\');"  href="./modelo.php?del='.mb_convert_encoding($reg['idmodelo'], "iso-8859-1").'"><span class="nowrap"><img src="./images/b_drop.png" title="Borrar" alt="Borrar" class="icon" width="16" height="16"> Borrar</span></a>
                                
                                </td>'; 

                              echo '</tr>';
                     
                        }
                    $cn=  desconectar();?>
                <tbody>
            </table>
