<?php  
define('INCLUDE_CHECK', true);
include 'class/conexion.php';
include 'class/agencia.php';
include 'class/grupo.php';
include 'class/vendedor.php';
include 'class/banca.php';
include 'class/computador.php';


$link = Conectar();
$agencia = new agencia($link);
$grupo = new grupo($link);
$vendedor = new vendedor($link);
$banca = new banca($link);
$computador = new computador($link);

$tipo = 0;
//-------------------recoger variables-----------------------------
if (isset($_GET['del'])) {
    $eliminar = $computador->eliminarcomputador($_GET['del']);
}
//--------------------------
if (isset($_GET['age'])) {
    $tipo++;
    $_SESSION['agencia'] = $_GET['age'];
}
if (isset($_GET['gr'])) {
     $tipo++;
    $_SESSION['grupo'] = $_GET['gr'];
}
if (isset($_GET['ven'])) {
     $tipo++;
    $_SESSION['vendedor'] = $_GET['ven'];
}
if (isset($_GET['ban'])) {
     $tipo++;
    $_SESSION['banca'] = $_GET['ban'];
}
$_SESSION['tipo'] = $tipo;

if ($tipo==4) {


    $fila = mysql_fetch_array($agencia->consultaragencia($_GET['age'],$_GET['gr'],$_GET['ven'],$_GET['ban']));
    
    $titulo = $fila['idagencia'].' | '.$fila['nombre'].' | '.$fila['idgrupo'].' | '.$fila['nombregr'].' | '.$fila['idvendedor'].' | '.$fila['nombreven'].' | '.$fila['idbanca'].' | '.$fila['nombreban'].' ';      
    $sql = '(SELECT idcomputador, idtransaccion, fechaprestamo, computador.iditem, 
       usuario.nombre as nombre, agencia.nombre as nombreag, grupo.nombre as nombregr, 
       vendedor.nombre as nombreven, banca.nombre as nombreban,banca.idbanca,
        vendedor.idvendedor, grupo.idgrupo,agencia.idagencia, nombremodel, tipo, agencia.estado as estadoa
        from computador,item,tipoitem,usuario,agencia,grupo,vendedor,banca,modelo
       where computador.iditem = item.serialitem
       and computador.idusuario = usuario.idusuario
       and computador.idagencia = agencia.idagencia
       and computador.idgrupo = grupo.idgrupo
       and computador.idvendedor = vendedor.idvendedor
       and computador.idbanca = banca.idbanca
       and item.idtipoitem = tipoitem.idtipoitem 
       and agencia.idgrupo = grupo.idgrupo
       and agencia.idvendedor = vendedor.idvendedor
       and agencia.idbanca = banca.idbanca
       and grupo.idvendedor = vendedor.idvendedor
       and grupo.idbanca = banca.idbanca
       and vendedor.idbanca = banca.idbanca
       and modelo.idmodelo = item.modelo_idmodelo 
        and agencia.idagencia = "'.$_GET['age'].'"
       and grupo.idgrupo = "'.$_GET['gr'].'"
       and vendedor.idvendedor = "'.$_GET['ven'].'"
       and banca.idbanca = "'.$_GET['ban'].'"  order by tipo desc) 
union 
(SELECT idcomputador, idtransaccion, fechaprestamo, conexion.IMEI, 
       usuario.nombre as nombre, agencia.nombre as nombreag, grupo.nombre as nombregr, 
       vendedor.nombre as nombreven, banca.nombre as nombreban,banca.idbanca,
        vendedor.idvendedor, grupo.idgrupo,agencia.idagencia,modelo, conexionnombre, agencia.estado as estadoa
        from computador,conexion,usuario,agencia,grupo,vendedor,banca,modeloconexion,tipoconexion
       where computador.idconexion= conexion.idconexion
and conexion.idmodeloconexion = modeloconexion.idmodeloconexion
and modeloconexion.idtipoconexion = tipoconexion.idtipoconexion
       and computador.idusuario = usuario.idusuario
       and computador.idagencia = agencia.idagencia
       and computador.idgrupo = grupo.idgrupo
       and computador.idvendedor = vendedor.idvendedor
       and computador.idbanca = banca.idbanca

       and agencia.idgrupo = grupo.idgrupo
       and agencia.idvendedor = vendedor.idvendedor
       and agencia.idbanca = banca.idbanca
       and grupo.idvendedor = vendedor.idvendedor
       and grupo.idbanca = banca.idbanca
       and vendedor.idbanca = banca.idbanca
       and agencia.idagencia = "'.$_GET['age'].'"
       and grupo.idgrupo = "'.$_GET['gr'].'"
       and vendedor.idvendedor = "'.$_GET['ven'].'"
       and banca.idbanca = "'.$_GET['ban'].'"  order by tipo desc) order by tipo';
                                
}

if ($tipo==3) {


    $fila = mysql_fetch_array($grupo->consultargrupo($_GET['gr'],$_GET['ven'],$_GET['ban']));

    $titulo =$fila['idgrupo'].' | '.$fila['nombregr'].' | '.$fila['idvendedor'].' | '.$fila['nombreven'].' | '.$fila['idbanca'].' | '.$fila['nombreban'].' '; 

    $sql = '(SELECT idcomputador, idtransaccion, fechaprestamo, computador.iditem, 
       usuario.nombre as nombre, agencia.nombre as nombreag, grupo.nombre as nombregr, 
       vendedor.nombre as nombreven, banca.nombre as nombreban,banca.idbanca,
        vendedor.idvendedor, grupo.idgrupo,agencia.idagencia, nombremodel, tipo,agencia.estado as estadoa
        from computador,item,tipoitem,usuario,agencia,grupo,vendedor,banca,modelo
       where computador.iditem = item.serialitem
       and computador.idusuario = usuario.idusuario
       and computador.idagencia = agencia.idagencia
       and computador.idgrupo = grupo.idgrupo
       and computador.idvendedor = vendedor.idvendedor
       and computador.idbanca = banca.idbanca
       and item.idtipoitem = tipoitem.idtipoitem 
       and agencia.idgrupo = grupo.idgrupo
       and agencia.idvendedor = vendedor.idvendedor
       and agencia.idbanca = banca.idbanca
       and grupo.idvendedor = vendedor.idvendedor
       and grupo.idbanca = banca.idbanca
       and vendedor.idbanca = banca.idbanca
       and modelo.idmodelo = item.modelo_idmodelo 
       and grupo.idgrupo = "'.$_GET['gr'].'"
       and vendedor.idvendedor = "'.$_GET['ven'].'"
       and banca.idbanca = "'.$_GET['ban'].'"
       order by tipo desc) 
union 
(SELECT idcomputador, idtransaccion, fechaprestamo, conexion.IMEI, 
       usuario.nombre as nombre, agencia.nombre as nombreag, grupo.nombre as nombregr, 
       vendedor.nombre as nombreven, banca.nombre as nombreban,banca.idbanca,
        vendedor.idvendedor, grupo.idgrupo,agencia.idagencia,modelo, conexionnombre,agencia.estado as estadoa
        from computador,conexion,usuario,agencia,grupo,vendedor,banca,modeloconexion,tipoconexion
       where computador.idconexion= conexion.idconexion
and conexion.idmodeloconexion = modeloconexion.idmodeloconexion
and modeloconexion.idtipoconexion = tipoconexion.idtipoconexion
       and computador.idusuario = usuario.idusuario
       and computador.idagencia = agencia.idagencia
       and computador.idgrupo = grupo.idgrupo
       and computador.idvendedor = vendedor.idvendedor
       and computador.idbanca = banca.idbanca

       and agencia.idgrupo = grupo.idgrupo
       and agencia.idvendedor = vendedor.idvendedor
       and agencia.idbanca = banca.idbanca
       and grupo.idvendedor = vendedor.idvendedor
       and grupo.idbanca = banca.idbanca
       and vendedor.idbanca = banca.idbanca
       and grupo.idgrupo = "'.$_GET['gr'].'"
       and vendedor.idvendedor = "'.$_GET['ven'].'"
       and banca.idbanca = "'.$_GET['ban'].'" 
       order by tipo desc) order by tipo';
                                
}

if ($tipo==2) {


    $fila = mysql_fetch_array($vendedor->consultarvendedor($_GET['ven'],$_GET['ban']));
    $titulo = $fila['idvendedor'].' | '.$fila['nombreven'].' | '.$fila['idbanca'].' | '.$fila['nombreban'];  

    $sql = '(SELECT idcomputador, idtransaccion, fechaprestamo, computador.iditem, 
       usuario.nombre as nombre, agencia.nombre as nombreag, grupo.nombre as nombregr, 
       vendedor.nombre as nombreven, banca.nombre as nombreban,banca.idbanca,
        vendedor.idvendedor, grupo.idgrupo,agencia.idagencia, nombremodel, tipo
        from computador,item,tipoitem,usuario,agencia,grupo,vendedor,banca,modelo
       where computador.iditem = item.serialitem
       and computador.idusuario = usuario.idusuario
       and computador.idagencia = agencia.idagencia
       and computador.idgrupo = grupo.idgrupo
       and computador.idvendedor = vendedor.idvendedor
       and computador.idbanca = banca.idbanca
       and item.idtipoitem = tipoitem.idtipoitem 
       and agencia.idgrupo = grupo.idgrupo
       and agencia.idvendedor = vendedor.idvendedor
       and agencia.idbanca = banca.idbanca
       and grupo.idvendedor = vendedor.idvendedor
       and grupo.idbanca = banca.idbanca
       and vendedor.idbanca = banca.idbanca
       and modelo.idmodelo = item.modelo_idmodelo 
       and vendedor.idvendedor = "'.$_GET['ven'].'"
       and banca.idbanca = "'.$_GET['ban'].'"
       order by tipo desc) 
union 
(SELECT idcomputador, idtransaccion, fechaprestamo, conexion.IMEI, 
       usuario.nombre as nombre, agencia.nombre as nombreag, grupo.nombre as nombregr, 
       vendedor.nombre as nombreven, banca.nombre as nombreban,banca.idbanca,
        vendedor.idvendedor, grupo.idgrupo,agencia.idagencia,modelo, conexionnombre
        from computador,conexion,usuario,agencia,grupo,vendedor,banca,modeloconexion,tipoconexion
       where computador.idconexion= conexion.idconexion
and conexion.idmodeloconexion = modeloconexion.idmodeloconexion
and modeloconexion.idtipoconexion = tipoconexion.idtipoconexion
       and computador.idusuario = usuario.idusuario
       and computador.idagencia = agencia.idagencia
       and computador.idgrupo = grupo.idgrupo
       and computador.idvendedor = vendedor.idvendedor
       and computador.idbanca = banca.idbanca

       and agencia.idgrupo = grupo.idgrupo
       and agencia.idvendedor = vendedor.idvendedor
       and agencia.idbanca = banca.idbanca
       and grupo.idvendedor = vendedor.idvendedor
       and grupo.idbanca = banca.idbanca
       and vendedor.idbanca = banca.idbanca
       and vendedor.idvendedor = "'.$_GET['ven'].'"
       and banca.idbanca = "'.$_GET['ban'].'" 
       order by tipo desc) order by tipo, fechaprestamo';
                                
}

if ($tipo==1) {


    $fila = mysql_fetch_array($banca->consultarbanca($_GET['ban']));
    $titulo = $fila['idbanca'].' | '.$fila['nombre'];    
   
    $sql = '(SELECT idcomputador, idtransaccion, fechaprestamo, computador.iditem, 
       usuario.nombre as nombre, agencia.nombre as nombreag, grupo.nombre as nombregr, 
       vendedor.nombre as nombreven, banca.nombre as nombreban,banca.idbanca,
        vendedor.idvendedor, grupo.idgrupo,agencia.idagencia, nombremodel, tipo
        from computador,item,tipoitem,usuario,agencia,grupo,vendedor,banca,modelo
       where computador.iditem = item.serialitem
       and computador.idusuario = usuario.idusuario
       and computador.idagencia = agencia.idagencia
       and computador.idgrupo = grupo.idgrupo
       and computador.idvendedor = vendedor.idvendedor
       and computador.idbanca = banca.idbanca
       and item.idtipoitem = tipoitem.idtipoitem 
       and agencia.idgrupo = grupo.idgrupo
       and agencia.idvendedor = vendedor.idvendedor
       and agencia.idbanca = banca.idbanca
       and grupo.idvendedor = vendedor.idvendedor
       and grupo.idbanca = banca.idbanca
       and vendedor.idbanca = banca.idbanca
       and modelo.idmodelo = item.modelo_idmodelo 
       and banca.idbanca = "'.$_GET['ban'].'"
       order by tipo desc) 
union 
(SELECT idcomputador, idtransaccion, fechaprestamo, conexion.IMEI, 
       usuario.nombre as nombre, agencia.nombre as nombreag, grupo.nombre as nombregr, 
       vendedor.nombre as nombreven, banca.nombre as nombreban,banca.idbanca,
        vendedor.idvendedor, grupo.idgrupo,agencia.idagencia,modelo, conexionnombre
        from computador,conexion,usuario,agencia,grupo,vendedor,banca,modeloconexion,tipoconexion
       where computador.idconexion= conexion.idconexion
and conexion.idmodeloconexion = modeloconexion.idmodeloconexion
and modeloconexion.idtipoconexion = tipoconexion.idtipoconexion
       and computador.idusuario = usuario.idusuario
       and computador.idagencia = agencia.idagencia
       and computador.idgrupo = grupo.idgrupo
       and computador.idvendedor = vendedor.idvendedor
       and computador.idbanca = banca.idbanca

       and agencia.idgrupo = grupo.idgrupo
       and agencia.idvendedor = vendedor.idvendedor
       and agencia.idbanca = banca.idbanca
       and grupo.idvendedor = vendedor.idvendedor
       and grupo.idbanca = banca.idbanca
       and vendedor.idbanca = banca.idbanca
       and banca.idbanca = "'.$_GET['ban'].'" 
       order by tipo desc) order by tipo, fechaprestamo';  
                                
}
  
  

$listado=  mysql_query($sql,$link);
//------------------------------------------------------------

?>

<style type="text/css">
td a{text-decoration: none;}
table{
   width: 100%;
   font-size: 75%;

}
td{
   padding-left: 7 px;
   padding-right: 7 px;
   border-left: 1px solid;
   border-top: 1px solid;

   display: table-cell;
  vertical-align: inherit;
  text-align: center;
}
​
  </style>
<body

    <div id='fondo'>
        <div id='wwrap'>
            <div id="contewnt">
                <?php  if (isset($eliminar))
    notificacion($eliminar);
if (isset($_GET['edit']))
    notificacion($_GET['edit']);
?>
                <h1>Estado de prestamos</h1>

                <div class="fowrm" id ="fowrm">
            <h3><?php  echo $titulo; ?></h3></br></br>
            <table cellpadding="0" 
            cellspacing="0"  
            class="display" id="tabla_lista_computador" style="
    border-top: 1px solid; border-bottom: 1px solid;
">
                <thead>
                    <tr id="cabeceras" style="background-color: black; ">
                        
                        <th  style="border-left: 1px solid;">#</th>
                        <th id='cticket'  style="border-left: 1px solid;">Ticket</th>
                         <th style="border-left: 1px solid; width: 47px;">Fecha</th>
                        <th style="border-left: 1px solid;">Serial</th>
                        <th style="border-left: 1px solid;">Tipo</th>
                        <th style="border-left: 1px solid;">Modelo</th>
                        
                        <th style="border-left: 1px solid;">Agencia</th>
                        <th style="border-left: 1px solid;">Grupo</th> 
                        <!-- <th>Vendedor</th>                          
                        <th>Banca</th> -->
                        <th id='cusuario' style="border-left: 1px solid;">Usuario</th>
                       
                        <th id='caccion' style="border-left: 1px solid;"> </th>
                    </tr>
                </thead>
                
                  <tbody>
                    <?php 
                    $j=0;     
                   while($reg=  mysql_fetch_array($listado))
                   {
                    $v = $reg['estadoa']=='0'?'<strike>':'';
                              $j++;
                              echo '<tr id="lresul'.$j.'">';
                              echo '<td >'.$j.'</td>';
                              echo '<td id="lticket'.$j.'" ><a href="pdf/ticket.php?id='.$reg['idtransaccion'].'" TARGET="_new">'.$reg['idtransaccion'].'</a></td>';
                              $fecha = new DateTime($reg['fechaprestamo']);
                              echo '<td >'.mb_convert_encoding( $fecha->format('d-m-Y'), "iso-8859-1").'</td>';    
                              echo '<td >'.$v.mb_convert_encoding($reg['iditem'], "iso-8859-1").'</td>';   
                              echo '<td >'.mb_convert_encoding($reg['tipo'], "iso-8859-1").'</td>';
                              echo '<td >'.mb_convert_encoding($reg['nombremodel'], "iso-8859-1").'</td>';
                             
                              echo '<td ><a href="computador.php?age='.$reg['idagencia'].'&gr='.$reg['idgrupo'].'&ven='.$reg['idvendedor'].'&ban='.$reg['idbanca'].'">'.mb_convert_encoding($reg['idagencia'].' '.$reg['nombreag'], "iso-8859-1").'</a></td>';
                              echo '<td ><a href="computador.php?gr='.$reg['idgrupo'].'&ven='.$reg['idvendedor'].'&ban='.$reg['idbanca'].'">'.mb_convert_encoding($reg['idgrupo'].' '.$reg['nombregr'], "iso-8859-1").'</a></td>';
                              // echo '<td >'.mb_convert_encoding($reg['nombreven'], "iso-8859-1").'</td>';
                              // echo '<td >'.mb_convert_encoding($reg['nombreban'], "iso-8859-1").'</td>';
                                echo '<td  id="lusuario'.$j.'" >'.mb_convert_encoding($reg['nombre'], "iso-8859-1").'</td>';
                              echo '
                                <td  id="laccion'.$j.'" >
                                  <a onClick="return confirm(\'Seguro quiere recibir este registro?\');"  href="./computador.php?age='.$reg['idagencia'].'&gr='.$reg['idgrupo'].'&ven='.$reg['idvendedor'].'&ban='.$reg['idbanca'].'&del='.mb_convert_encoding($reg['idcomputador'], "iso-8859-1").'"><span class="nowrap"><img src="./images/recibir.png" title="Recibir" alt="Recibir" class="icon" width="16" height="16"></span></a>
                                
                                </td>'; 

                              echo '</tr>';
                     
                        }
                    echo '<div id="total" >'.$j.'</div><div id="totalr"> Resultados</div>';?>
                <tbody>
            </table>
<input type="button" value="Imprimir" id="Guardar" onclick="printer()" style="padding: 5px;">

<input type="button" onclick="location.href='computador.php?age=<?php echo $_GET['age'];?>&gr=<?php echo $_GET['gr'];?>&ven=<?php echo $_GET['ven'];?>&ban=<?php echo $_GET['ban'];?>';" value="Detalle" />
                </div><!-- form -->	</div>

        </div>
    </div>



</body>
</html>