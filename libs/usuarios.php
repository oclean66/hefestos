<?php  require_once('../class/conexion.php');
$cn=  Conectar();
session_start();

$listado=  mysql_query("SELECT * from usuario order by clave ",$cn);
?>
       <script type="text/javascript" language="javascript" src="js/jslistado.js"></script>


            <table cellpadding="0" cellspacing="0" border="0" class="display" id="tabla_lista_user">
                <thead>
                    <tr>
                        <th style="width:20px;">Id</th> 
                        <th>Usuario</th>
                        <th >Nombre Completo</th>                   
                       
                        <th style="width:80px;">Accion</th>
                    </tr>
                </thead>
                
                  <tbody>
                    <?php 

     
                   while($reg=  mysql_fetch_array($listado))
                   {
                               if($reg[2]=="BLOQUEADO")echo '<tr style="background-color:rgb(241, 144, 144);">';
                               else if($reg[2]=="81dc9bdb52d04dc20036dbd8313ed055")echo '<tr style="background-color:rgb(170, 226, 252);">';
                               else echo '<tr>';

                                          
                               echo '<td ><a href="#"> '.mb_convert_encoding($reg[0], "iso-8859-1").'</a></td>';
                               echo '<td ><a href="#"> '.mb_convert_encoding($reg[3], "iso-8859-1").'</a></td>';
                               echo '<td ><a href="#"> '.mb_convert_encoding($reg[1], "iso-8859-1").'</a></td>';
                               echo '<td ><a href="./editusuario.php?id='.mb_convert_encoding($reg[0], "iso-8859-1").'"><span class="nowrap"><img src="./images/b_edit.png" title="Editar" alt="Editar" class="icon" width="16" height="16"></span></a>';
                               echo '
                                <a onClick="return confirm(\'Seguro quiere reiniciar la clave de este usuario?\');" href="./usuario.php?id='.mb_convert_encoding($reg[0], "iso-8859-1").'"><span class="nowrap"><img src="./images/s_reload.png" title="Editar" alt="Editar" class="icon" width="16" height="16"></span></a>';

                              if ($_SESSION['grupouser']==1 || $_SESSION['grupouser']==2)
                                echo '<a onClick="return confirm(\'Seguro quiere bloquear este usuario?\');"  href="./usuario.php?del='.mb_convert_encoding($reg[0], "iso-8859-1").'"><span class="nowrap"><img src="./images/b_drop.png" title="Bloquear" alt="Bloquear" class="icon" width="16" height="16"></span></a>';
                                echo '</td>'; 
                                echo '</tr>';
                     
                        }
                    ?>
                <tbody>
            </table>
