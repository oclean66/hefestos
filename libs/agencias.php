<?php  require_once('conexion.php');
session_start();

$cn=  conectar();
$sql = 'select Estado, responsable,agencia.telefono as agtelefono,agencia.email as agemail,agencia.direccion as dir, ciudad.nombre as ciudad, estadovzla.nombre as estadovzla,agencia.idagencia, agencia.nombre as nombreag, agencia.idgrupo, grupo.nombre as nombregr, agencia.idvendedor, vendedor.nombre as nombreven, agencia.idbanca, banca.nombre as nombreban, cedula
from agencia, grupo,vendedor,banca, ciudad,estadovzla
where agencia.idgrupo = grupo.idgrupo and agencia.idvendedor = vendedor.idvendedor and agencia.idbanca = banca.idbanca
and grupo.idvendedor = vendedor.idvendedor and grupo.idbanca = banca.idbanca
and agencia.ciudad_idciudad = ciudad.idciudad
and ciudad.estadovzla_idestadovzla = estadovzla.idestadovzla
and vendedor.idbanca = banca.idbanca';
$listado=  mysql_query($sql,$cn);
?>
<meta http-equiv="Content-type" content="text/html; charset=iso-8859-1" />
 <script type="text/javascript" language="javascript" src="js/jslistado.js"></script>



            <table cellpadding="0" cellspacing="0" border="0" class="display" id="tabla_lista_agencias">
                <thead>
                    <tr>
                        <th>Cod. Agencia</th>
                        <th>Responsable</th>                  
                            
                        <th>Cod. Grupo</th>
                       
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
                               $text="";
                               if($reg['Estado']=='0'){
                                $text = "(Migrada) - ";
                               }
                                          
                               echo '<td ><a href="./computador.php?age='.mb_convert_encoding($reg['idagencia'], "iso-8859-1").'&gr='.mb_convert_encoding($reg['idgrupo'], "iso-8859-1").'&ven='.mb_convert_encoding($reg['idvendedor'], "iso-8859-1").'&ban='.mb_convert_encoding($reg['idbanca'], "iso-8859-1").'">'.$text.' ('.mb_convert_encoding($reg['idagencia'], "iso-8859-1").') '.mb_convert_encoding($reg['nombreag'], "iso-8859-1").'</a></td>';
                               echo '<td >'.mb_convert_encoding($reg['responsable'], "iso-8859-1").'</td>';
                            
                              
                              echo '<td ><a href="./grupo.php?gr='.mb_convert_encoding($reg['idgrupo'], "iso-8859-1").'&ven='.mb_convert_encoding($reg['idvendedor'], "iso-8859-1").'&ban='.mb_convert_encoding($reg['idbanca'], "iso-8859-1").'"> '.mb_convert_encoding($reg['idgrupo'], "iso-8859-1").' </br> '.mb_convert_encoding($reg['nombregr'], "iso-8859-1").'</a></td>';
                              echo '<td ><a href="./vendedor.php?ven='.mb_convert_encoding($reg['idvendedor'], "iso-8859-1").'&ban='.mb_convert_encoding($reg['idbanca'], "iso-8859-1").'"> '.mb_convert_encoding($reg['idvendedor'], "iso-8859-1").' </br> '.mb_convert_encoding($reg['nombreven'], "iso-8859-1").'</a></td>';
                              echo '<td ><a href="./banca.php?ban='.mb_convert_encoding($reg['idbanca'], "iso-8859-1").'"> '.mb_convert_encoding($reg['idbanca'], "iso-8859-1").' </br> '.mb_convert_encoding($reg['nombreban'], "iso-8859-1").'</a></td>';
                                
                                echo '
                                <td>
                                 <a onClick="return alert(\'Responsable: '.mb_convert_encoding($reg['responsable'], "iso-8859-1").'\nCedula:  '.mb_convert_encoding($reg['cedula'], "iso-8859-1").'\nTelefono: '.mb_convert_encoding($reg['agtelefono'], "iso-8859-1").' \nEmail: '.mb_convert_encoding($reg['agemail'], "iso-8859-1").'\nDireccion:  '.mb_convert_encoding($reg['dir'], "iso-8859-1").'\n'.mb_convert_encoding($reg['ciudad'], "iso-8859-1").', edo. '.mb_convert_encoding($reg['estadovzla'], "iso-8859-1").'\');"  href="#")"><span class="nowrap"><img src="./images/b_browse.png" class="icon" width="16" height="16"></span></a>
                                <a href="./editagencia.php?ag='.mb_convert_encoding($reg['idagencia'], "iso-8859-1").'&gr='.mb_convert_encoding($reg['idgrupo'], "iso-8859-1").'&ven='.mb_convert_encoding($reg['idvendedor'], "iso-8859-1").'&ban='.mb_convert_encoding($reg['idbanca'], "iso-8859-1").'"><span class="nowrap"><img src="./images/b_edit.png" title="Editar" alt="Editar" class="icon" width="16" height="16"></span></a>';                        
                               if ($_SESSION['grupouser']==1 || $_SESSION['grupouser']==2)
                  echo '<a onClick="return confirm(\'Seguro quiere eliminar este registro?\n Esto puede eliminar prestamos Asociados.\');"  href="./agencia.php?delag='.mb_convert_encoding($reg['idagencia'], "iso-8859-1").'&delgr='.mb_convert_encoding($reg['idgrupo'], "iso-8859-1").'&delven='.mb_convert_encoding($reg['idvendedor'], "iso-8859-1").'&delban='.mb_convert_encoding($reg['idbanca'], "iso-8859-1").'"><span class="nowrap"><img src="./images/b_drop.png" title="Borrar" alt="Borrar" class="icon" width="16" height="16"></span></a>';
 

                                echo '</td>'; 
                
                                 echo '</tr>';
                     
                        }
                    ?>
                <tbody>
            </table>
