<?php 
define('INCLUDE_CHECK', true);
include 'class/formato.php';
include 'class/conexion.php';
include 'class/agencia.php';
include 'class/grupo.php';
include 'class/vendedor.php';
include 'class/banca.php';
include 'class/relacion.php';


$link = Conectar();
$agencia = new agencia($link);
$grupo = new grupo($link);
$vendedor = new vendedor($link);
$banca = new banca($link);
$relacion = new relacion($link);

$tipo = 0;
//-------------------recoger variables-----------------------------
if (isset($_GET['del'])) {
    $eliminar = $relacion->eliminarrelacion($_GET['del']);
}
if (isset($_GET['del']) && isset($_GET['t'])) {
   
   echo '<script language="JavaScript" type="text/javascript">
         document.location.href="conexion.php?st=z";
      </script>';
}if (isset($_GET['del']) && isset($_GET['d'])) {
   
   echo '<script language="JavaScript" type="text/javascript">
         document.location.href="item.php?st=d";
      </script>';
}
//--------------------------
if (isset($_GET['age']) && isset($_GET['gr']) &&isset($_GET['ven']) && isset($_GET['ban'])) {


  $_SESSION['sql'] = 'and agencia.idbanca = "'.$_GET['ban'].'"
       and agencia.idvendedor = "'.$_GET['ven'].'"
       and agencia.idgrupo = "'.$_GET['gr'].'"
       and agencia.idagencia = "'.$_GET['age'].'"';


    $fila = mysql_fetch_array($agencia->consultaragencia($_GET['age'],$_GET['gr'],$_GET['ven'],$_GET['ban']));
    $titulo = $fila['idagencia'].' | '.$fila['nombre'].' | '.$fila['idgrupo'].' | '.$fila['nombregr'].' | '.$fila['idvendedor'].' | '.$fila['nombreven'].' | '.$fila['idbanca'].' | '.$fila['nombreban'].'';      
                                
}else $_SESSION['sql'] = '';

//------------------------------------------------------------


echo head();
?>


<body><?php  echo menu(); ?>
    <div id='fondo'>
        <div id='wrap'>
            <div id="content">
                <?php  if (isset($eliminar))
    notificacion($eliminar);
if (isset($_GET['edit']))
    notificacion($_GET['edit']);
?>
                <h1>Estado de prestamos</h1>

                <div class="form">
            <h3><?php  echo $titulo; ?></h3>
                    <article id="relacion"><img src="images/loading3.gif" width="120" height="120" style="margin-left: 45%;"></article>
  
                </div><!-- form --> </div>


             <div id="sidebar">
                <div class="portlet" id="yw2">
                    <div class="portlet-decoration">
                        <div class="portlet-title">Operaciones</div>
                    </div>
                    <div class="portlet-content">
                        <ul class="operations" id="yw3">
                            <li><a href="relacion.php">Ver todas</a></li>
                             <li><a href="pdf/sumi.php" target="_blank">Imprimir</a></li>
                        </ul></div>
                </div>  </div> 

        </div>
    </div>



</body>
</html>