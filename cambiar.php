<?php 
session_start();


include 'class/conexion.php';
include 'class/item.php';
include 'class/conexiones.php';

$link = Conectar();
$item = new item($link);
$conexion = new conexion($link);



if(isset($_GET['id']) and isset($_GET['lugar']) and !isset($_GET['tipo'])){
	echo '<script type="text/javascript" >
	alert("Recibi item '.$_GET['id'].'")
	</script>';

	if ($_GET['lugar']==6)
		$item->eliminaritem($_GET['id'],$_GET['razon']);
	else
		$item->moveritem($_GET['id'],$_GET['lugar']);
}


if(isset($_GET['id']) and isset($_GET['tipo']) and isset($_GET['lugar'])){
	echo '<script type="text/javascript" >
	alert("Recibi conexion '.$_GET['id'].'")
	</script>';
	if ($_GET['lugar']==6)
		$conexion->eliminarconexion($_GET['id'],$_GET['razon']);
	else
		$conexion->moverconexion($_GET['id'],$_GET['lugar']);
}
?>