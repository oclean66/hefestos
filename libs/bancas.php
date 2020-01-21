<?php  require_once('../class/conexion.php');
$cn=  Conectar();
session_start();

$listado=  mysql_query("SELECT * from banca ",$cn);
?>
       <script type="text/javascript" language="javascript" src="js/jslistado.js"></script>


            <table cellpadding="0" cellspacing="0" border="0" class="display" id="tabla_lista_bancas">
                <thead>
                    <tr>
                        <th>Cod. Banca</th> 
                        <th>Nombre Banca</th>
                       
                       
                        <th>Accion</th>
                    </tr>
                </thead>
                
                  <tbody>
                    <?php 

     
                   while($reg=  mysql_fetch_array($listado))
                   {
                               echo '<tr>';

                                          
                               echo '<td ><a href="./computador.php?ban='.mb_convert_encoding($reg['idbanca'], "iso-8859-1").'"> '.mb_convert_encoding($reg['idbanca'], "iso-8859-1").'</a></td>';
                               echo '<td ><a href="./computador.php?ban='.mb_convert_encoding($reg['idbanca'], "iso-8859-1").'"> '.mb_convert_encoding($reg['nombre'], "iso-8859-1").'</a></td>';
                               echo '
                                <td><a href="./editbanca.php?reg='.mb_convert_encoding($reg['idbanca'], "iso-8859-1").'"><span class="nowrap"><img src="./images/b_edit.png" title="Editar" alt="Editar" class="icon" width="16" height="16"></span></a>';

                              if ($_SESSION['grupouser']==1 || $_SESSION['grupouser']==2)
                                echo '<a onClick="return confirm(\'Seguro quiere eliminar este registro? \nEsto puede eliminar prestamos asociados en las agencias.\');"  href="./banca.php?del='.mb_convert_encoding($reg['idbanca'], "iso-8859-1").'"><span class="nowrap"><img src="./images/b_drop.png" title="Borrar" alt="Borrar" class="icon" width="16" height="16"></span></a>';
                                echo '</td>'; 


                                 echo '</tr>';
                     
                        }
                    ?>
                <tbody>
            </table>
