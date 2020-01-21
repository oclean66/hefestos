<?php 
session_start();


include 'class/conexion.php';
include 'class/agencia.php';
include 'class/grupo.php';
include 'class/vendedor.php';

$link = Conectar();
$agencia = new agencia($link);
$grupo = new grupo($link);
$vendedor = new vendedor($link);


//--------------------------Agencia------------------------------------//

if (isset($_GET['idagencia']) and isset($_GET['old']) and isset($_GET['new']) ){

	$chars = preg_split('/,/', $_GET['old']);
	print_r($chars);
	$vector= preg_split('/,/', $_GET['new']);
	print_r($vector);

	$agencia->moveragencia($_GET['idagencia'],$chars[0],$chars[1],$chars[2],$vector[0],$vector[1],$vector[2]);
}else
//---------------------------GRUPO---------------------------
if (isset($_GET['idgrupo']) and isset($_GET['old']) and isset($_GET['new']) ){

	$chars = preg_split('/,/', $_GET['old']);
	print_r($chars);
	$vector= preg_split('/,/', $_GET['new']);
	print_r($vector);

	$grupo->movergrupo($_GET['idgrupo'],$chars[0],$chars[1],$vector[0],$vector[1]);
}else
//---------------------------VENDEDOR----------------------------
if (isset($_GET['idvendedor']) and isset($_GET['old']) and isset($_GET['new']) and isset($_GET['nombre']) ){

	$vendedor->insertar_vendedor($_GET['idvendedor'], $_GET['nombre'], $_GET['new']);

	$listaGrupos = $vendedor->consultargrupovendedor($_GET['idvendedor'],$_GET['old']);
	
	while($fila=mysql_fetch_array($listaGrupos)){
		$grupo->movergrupo($fila['idgrupo'],$fila['idvendedor'],$fila['idbanca'],$fila['idvendedor'],$_GET['new']);
	}

	$listaGrupos = $vendedor->eliminarvendedor($_GET['idvendedor'],$_GET['old']);

}

?>