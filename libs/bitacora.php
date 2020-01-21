<?php  require_once('conexion.php');
$cn=  conectar();
$listado=  mysql_query("SELECT fecha, accion, usuario.nombre as usuario from bitacora,usuario where idusuario = usuario_idusuario order by fecha desc",$cn);
?>

 <script type="text/javascript" language="javascript" src="js/jslistado.js"></script>



            <table cellpadding="0" cellspacing="0" border="0" class="display" id="tabla_lista_bitacora">
                <thead>
                    <tr>
                      <th>Id</th> 
                        <th>Fecha</th> 
                        <th>Descripcion</th>
                       
                       
                        <th>Usuario</th>
                    </tr>
                </thead>
                
                  <tbody>
                    <?php 

                    $i=0;
                   while($reg=  mysql_fetch_array($listado))
                   {
                    $i++;
                               echo '<tr>';

                               echo '<td >'.$i.'</td>';           
                               echo '<td >'.date('d M Y', strtotime ($reg['fecha'])).'</td>';
                               echo '<td >'.mb_convert_encoding($reg['accion'], "UTF-8").'</td>';
                               echo '<td >'.mb_convert_encoding($reg['usuario'], "UTF-8").'</td>';
                              
                                 echo '</tr>';
                     
                        }
                    $cn=  desconectar();?>
                <tbody>
            </table>
