<?php
define('INCLUDE_CHECK', true);
include 'class/formato.php';
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
if (isset($_GET['del']) && isset($_GET['t'])) {
   
   echo '<script language="JavaScript" type="text/javascript">
         document.location.href="bconexion.php?id='.$_GET['t'].'";
      </script>';
}
if (isset($_GET['del']) && isset($_GET['b'])) {
   
   echo '<script language="JavaScript" type="text/javascript">
          alert("Se Recibio 1 elemento");
         document.location.href="bconexion.php?id='.$_GET['b'].'";
      </script>';
}if (isset($_GET['del']) && isset($_GET['d'])) {
   
   echo '<script language="JavaScript" type="text/javascript">
         document.location.href="item.php?st=d";
      </script>';
}else if (isset($_GET['del']) && isset($_GET['bi'])) {
   
   echo '<script language="JavaScript" type="text/javascript">
         document.location.href="bitem.php?id='.$_GET['bi'].'";
      </script>';
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
    $estado = $fila['Estado']=='0'?"(Migrada) - ":"";
    $titulo = $estado.$fila['idagencia'].' | '.$fila['nombre'].' | <a href="./computador.php?gr='.$fila['idgrupo'].'&amp;ven='.$fila['idvendedor'].'&amp;ban='.$fila['idbanca'].'">'.$fila['idgrupo'].' | '.$fila['nombregr'].'</a> | <a href="./computador.php?ven='.$fila['idvendedor'].'&amp;ban='.$fila['idbanca'].'">'.$fila['idvendedor'].' | '.$fila['nombreven'].'</a> | <a href="./computador.php?ban='.$fila['idbanca'].'">'.$fila['idbanca'].' | '.$fila['nombreban'].'</a>';      
                                
}

if ($tipo==3) {


    $fila = mysql_fetch_array($grupo->consultargrupo($_GET['gr'],$_GET['ven'],$_GET['ban']));

    $titulo =$fila['idgrupo'].' | '.$fila['nombregr'].' | <a href="./computador.php?ven='.$fila['idvendedor'].'&amp;ban='.$fila['idbanca'].'">'.$fila['idvendedor'].' | '.$fila['nombreven'].'</a> | <a href="./computador.php?ban='.$fila['idbanca'].'">'.$fila['idbanca'].' | '.$fila['nombreban'].'</a>';      
                                
}

if ($tipo==2) {


    $fila = mysql_fetch_array($vendedor->consultarvendedor($_GET['ven'],$_GET['ban']));
    $titulo = $fila['idvendedor'].' | '.$fila['nombreven'].' | '.$fila['idbanca'].' | '.$fila['nombreban'];      
                                
}

if ($tipo==1) {


    $fila = mysql_fetch_array($banca->consultarbanca($_GET['ban']));
    $titulo = $fila['idbanca'].' | '.$fila['nombre'];      
                                
}
//------------------------------------------------------------


echo head();
?>


<body><?php echo menu(); ?>
    <div id='fondo'>
        <div id='wrap'>
            <div id="content">
                <?php if (isset($eliminar))
    notificacion($eliminar);
if (isset($_GET['edit']))
    notificacion($_GET['edit']);
?>
                <h1>Estado de prestamos</h1>

                <div class="form">
            <h3><?php echo $titulo; ?></h3>
                    <article id="asignacion"><img src="images/loading3.gif" width="120" height="120" style="margin-left: 45%;"></article>
  
                </div><!-- form -->	</div>


           <!--  <div id="sidebar">
                <div class="portlet" id="yw2">
                    <div class="portlet-decoration">
                        <div class="portlet-title">Operaciones</div>
                    </div>
                    <div class="portlet-content">
                        <ul class="operations" id="yw3">
                            <li><a href="aggbanca.php">Agregar</a></li>
                        </ul></div>
                </div>	</div> -->

        </div>
    </div>



</body>
</html>