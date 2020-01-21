<?php  require_once('conexion.php');
session_start();
$cn=  conectar();
$sql = 'SELECT idgrupo, grupo.nombre as nombregr,banca.idbanca, banca.nombre as  nombreban, vendedor.idvendedor , vendedor.nombre as nombreven
  from banca, vendedor, grupo
  where banca.idbanca = grupo.idbanca 
  and vendedor.idvendedor = grupo.idvendedor
  and vendedor.idbanca = banca.idbanca';
$listado=  mysql_query($sql,$cn);
?>

 <script type="text/javascript" language="javascript" src="js/jslistado.js"></script>



            <table cellpadding="0" cellspacing="0" border="0" class="display" id="tabla_lista_grupos">
                <thead>
                    <tr>
                        <th>Cod. Grupo</th> 
                        <th>Nombre Grupo</th>
                        <th>Cod. Receptor</th>
                        <th>Cod. Banca</th>
                       
                        <th>Accion</th>
                    </tr>
                </thead>
                
                  <tbody>
                    <?php 

     
                   while($reg=  mysql_fetch_array($listado))
                   {
                               echo '<tr>';

                                          
                               echo '<td ><a href="./grupo.php?gr='.mb_convert_encoding($reg['idgrupo'], "iso-8859-1").'&ven='.mb_convert_encoding($reg['idvendedor'], "iso-8859-1").'&ban='.mb_convert_encoding($reg['idbanca'], "iso-8859-1").'"> '.mb_convert_encoding($reg['idgrupo'], "iso-8859-1").'</a></td>';
                               echo '<td ><a href="./grupo.php?gr='.mb_convert_encoding($reg['idgrupo'], "iso-8859-1").'&ven='.mb_convert_encoding($reg['idvendedor'], "iso-8859-1").'&ban='.mb_convert_encoding($reg['idbanca'], "iso-8859-1").'"> '.mb_convert_encoding($reg['nombregr'], "utf8").'</a></td>';

                              
                              echo '<td ><a href="./vendedor.php?ven='.mb_convert_encoding($reg['idvendedor'], "iso-8859-1").'&ban='.mb_convert_encoding($reg['idbanca'], "iso-8859-1").'"> '.mb_convert_encoding($reg['idvendedor'], "iso-8859-1").' - '.mb_convert_encoding($reg['nombreven'], "iso-8859-1").'</a></td>';
                              echo '<td ><a href="./banca.php?ban='.mb_convert_encoding($reg['idbanca'], "iso-8859-1").'"> '.mb_convert_encoding($reg['idbanca'], "iso-8859-1").' - '.mb_convert_encoding($reg['nombreban'], "iso-8859-1").'</a></td>';
                              
                                echo '
                                <td>
                                <a href="./editgrupo.php?gr='.mb_convert_encoding($reg['idgrupo'], "iso-8859-1").'&ven='.mb_convert_encoding($reg['idvendedor'], "iso-8859-1").'&ban='.mb_convert_encoding($reg['idbanca'], "iso-8859-1").'"><span class="nowrap"><img src="./images/b_edit.png" title="Editar" alt="Editar" class="icon" width="16" height="16"></span></a>';
                                if ($_SESSION['grupouser']==1 || $_SESSION['grupouser']==2)
                            echo '<a onClick="return confirm(\'Seguro quiere eliminar este registro? \n Esto puede eliminar prestamos asociados en las Agencias.\');"  href="./grupo.php?delgr='.mb_convert_encoding($reg['idgrupo'], "iso-8859-1").'&delven='.mb_convert_encoding($reg['idvendedor'], "iso-8859-1").'&delban='.mb_convert_encoding($reg['idbanca'], "iso-8859-1").'"><span class="nowrap"><img src="./images/b_drop.png" title="Borrar" alt="Borrar" class="icon" width="16" height="16"></span></a>';

                                echo '</td>'; 

                                 echo '</tr>';
                     
                        }
                    ?>
                <tbody>
            </table>
