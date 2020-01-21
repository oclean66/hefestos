<?php  require_once('../class/conexion.php');
$cn=  Conectar();
$listado=  mysql_query("SELECT * from suministros ",$cn);
?>
       <script type="text/javascript" language="javascript" src="js/jslistado.js"></script>


            <table cellpadding="0" cellspacing="0" border="0" class="display" id="tabla_lista_suministros">
                <thead>
                    <tr>
                        <th>Cod. suministro</th> 
                        <th>Nombre suministro</th>
                        <th>Cantidad</th>
                       
                       
                        <th>Accion</th>
                    </tr>
                </thead>
                
                  <tbody>
                    <?php 

     
                   while($reg=  mysql_fetch_array($listado))
                   {
                               echo '<tr '; if($reg['cantidad']<5) echo 'style="background-color:rgb(255, 160, 160);"'; echo '>';

                                          
                               echo '<td >'.mb_convert_encoding($reg['idsuministros'], "iso-8859-1").'</a></td>';
                               echo '<td >'.mb_convert_encoding($reg['nombre'], "iso-8859-1").'</a></td>';

                               echo '<td >'.mb_convert_encoding($reg['cantidad'], "iso-8859-1").'</a></td>';

                                echo '
                                <td>
                                  <a href="#" onclick="mostrar('.mb_convert_encoding($reg['idsuministros'], "iso-8859-1").')"><span class="nowrap"><img src="./images/cargar.png" title="Editar" alt="Editar" class="icon" width="16" height="16"> Recargar</span></a>                        
                                  <a href="./editsuministro.php?reg='.mb_convert_encoding($reg['idsuministros'], "iso-8859-1").'"><span class="nowrap"><img src="./images/b_edit.png" title="Editar" alt="Editar" class="icon" width="16" height="16"> Editar</span></a>                        
                                  <a onClick="return confirm(\'Seguro quiere eliminar este registro?\');"  href="./suministro.php?del='.mb_convert_encoding($reg['idsuministros'], "iso-8859-1").'"><span class="nowrap"><img src="./images/b_drop.png" title="Borrar" alt="Borrar" class="icon" width="16" height="16"> Borrar</span></a>
                                </td>'; 

                                 echo '</tr>';
                     
                        }
                    ?>
                <tbody>
            </table>
