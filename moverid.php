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

if (isset($_GET['old']) and isset($_GET['data']) and isset($_GET['new']) ){

	$chars = preg_split('/,/', $_GET['data']);
	print_r($chars);
	

	$agencia->cambiarid($_GET['old'],$_GET['new'],$chars[0],$chars[1],$chars[2]);
}

?>