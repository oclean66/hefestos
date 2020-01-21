<?php  

define('INCLUDE_CHECK',true);
include 'class/formato.php';
include 'class/conexion.php';
$link =conectar();

$sql = 'SELECT count(*) from agencia';
$listado=  mysql_query($sql,$link);
$reg=  mysql_fetch_array($listado);
$agencias= $reg['0'];

$sql = 'SELECT count(*) from grupo';
$listado=  mysql_query($sql,$link);
$reg=  mysql_fetch_array($listado);
$grupo= $reg['0'];

$sql = 'SELECT count(*) from vendedor';
$listado=  mysql_query($sql,$link);
$reg=  mysql_fetch_array($listado);
$vendedor= $reg['0'];

$sql = 'SELECT count(*) from item';
$listado=  mysql_query($sql,$link);
$reg=  mysql_fetch_array($listado);
$item= $reg['0'];

$sql = 'SELECT count(*) from conexion';
$listado=  mysql_query($sql,$link);
$reg=  mysql_fetch_array($listado);
$conexion= $reg['0'];

	echo head();
	
?>
<body><?php   echo menu(); ?>
	
<div style="padding: 18px; background: url(./images/logo.png) no-repeat;
width: 410;
height: 127px;">
		
	</div>

<div style="position: absolute;
  right: 46px;background-color: rgba(0, 0, 0, 0.55);
  margin: 0;
  padding:10px;
  text-align: left;
  width: 266px;
  -moz-border-radius:10px;
  -webkit-border-radius:10px;
  -webkit-box-shadow: 0px 0 3px rgba(0,0,0,0.25);
  -moz-box-shadow: 0px 0 3px rgba(0,0,0,0.25);
  box-shadow: 0px 0 3px rgba(255, 255, 255, 1); 
color: white;font-size: 15px;font-style: italic;font-weight: bold;">
	<div style="padding: 18px;">
      Nuevas Opciones: <li>Editar codigos de Agencias</li>
     </div>
</div>

<div class="round">
	<div style="padding: 18px;">
		<?php  echo 'Agencias Agregadas '.$agencias; 
		echo '</br>Grupos Agregados '.$grupo; 
		echo '</br>Receptores Agregados '.$vendedor; 
		echo '</br>Equipos Agregados '.$item; 
		echo '</br>Conexiones Agregados '.$conexion; 
		echo '</br><a href="cuadro.php" style="
    color: rgb(173, 191, 248);
">Mas informacion de salidas </a>'?>
	</div>
</div>

</body>
</html>