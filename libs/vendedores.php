<?php  require_once('conexion.php');
$cn=  conectar();
session_start();
$listado=  mysql_query("SELECT banca.idbanca, banca.nombre as nombreban, idvendedor, vendedor.nombre as nombreven
    from banca, vendedor
  where vendedor.idbanca = banca.idbanca",$cn);

?>

 <script type="text/javascript" language="javascript" src="js/jslistado.js"></script>



            <table cellpadding="0" cellspacing="0" border="0" class="display" id="tabla_lista_vendedores">
                <thead>
                    <tr>
                        <th>Cod. Receptor</th> 
                        <th>Nombre Receptor</th>
                        <th>Banca</th>
                       
                        <th>Accion</th>
                    </tr>
                </thead>
                
                  <tbody>
                    <?php 

     
                   while($reg=  mysql_fetch_array($listado))
                   {
                               echo '<tr>';

                                          
                               echo '<td ><a href="./vendedor.php?ven='.mb_convert_encoding($reg['idvendedor'], "iso-8859-1").'&ban='.mb_convert_encoding($reg['idbanca'], "iso-8859-1").'"> '.mb_convert_encoding($reg['idvendedor'], "iso-8859-1").'</a></td>';
                               echo '<td ><a href="./vendedor.php?ven='.mb_convert_encoding($reg['idvendedor'], "iso-8859-1").'&ban='.mb_convert_encoding($reg['idbanca'], "iso-8859-1").'"> '.mb_convert_encoding($reg['nombreven'], "iso-8859-1").'</a></td>';

                              
                                echo '<td ><a href="./banca.php?ban='.mb_convert_encoding($reg['idbanca'], "iso-8859-1").'"> '.mb_convert_encoding($reg['idbanca'], "iso-8859-1").' - '.mb_convert_encoding($reg['nombreban'], "iso-8859-1").'</a></td>';
                                echo '
                                <td>
                                <a href="./editvendedor.php?ven='.mb_convert_encoding($reg['idvendedor'], "iso-8859-1").'&ban='.mb_convert_encoding($reg['idbanca'], "iso-8859-1").'"><span class="nowrap"><img src="./images/b_edit.png" title="Editar" alt="Editar" class="icon" width="16" height="16"></span></a>';                        
                                                                
                              if ($_SESSION['grupouser']==1 || $_SESSION['grupouser']==2)
                                echo '<a onClick="return confirm(\'Seguro quiere eliminar este registro? \nEsto puede eliminar prestamos asociados en las Agencias.\');"  href="./vendedor.php?delven='.mb_convert_encoding($reg['idvendedor'], "iso-8859-1").'&delban='.mb_convert_encoding($reg['idbanca'], "iso-8859-1").'"><span class="nowrap"><img src="./images/b_drop.png" title="Borrar" alt="Borrar" class="icon" width="16" height="16"></span></a>';
                                echo '</td>'; 


                                 echo '</tr>';
                     
                        }
                    ?>
                <tbody>
            </table>
