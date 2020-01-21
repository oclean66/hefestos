<?php 
// Array que vincula los IDs de los selects declarados en el HTML con el nombre de la tabla donde se encuentra su contenido
$listadoSelects=array(
"estado"=>"estado",
"ciudad"=>"ciudad"
);

function validaSelect($selectDestino)
{
	// Se valida que el select enviado via GET exista
	global $listadoSelects;
	if(isset($listadoSelects[$selectDestino])) return true;
	else return false;
}

function validaOpcion($opcionSeleccionada)
{
	// Se valida que la opcion seleccionada por el usuario en el select tenga un valor numerico
	if(($opcionSeleccionada)!="0") return true;
	else return false;
}



$selectDestino=$_GET["select"]; //grupo
$opcionSeleccionada=$_GET["opcion"]; //id grupo

$selectDestino=$_GET["select"]; //banca
$opcionSeleccionada=$_GET["opcion"]; // id banca
if(validaSelect($selectDestino) && validaOpcion($opcionSeleccionada))
{
	$tabla=$listadoSelects[$selectDestino];
	include 'class/conexion.php';
	conectar();
	
	$consulta=mysql_query("SELECT idciudad, nombre FROM ciudad WHERE estadovzla_idestadovzla='$opcionSeleccionada'") or die(mysql_error());
	desconectar();
	
	// Comienzo a imprimir el select
	echo '<label for="ciudad_codigo" class="required">&nbsp;&nbsp;Ciudad <span class="required">* </span></label>';
	echo "<select style=\" width:150px\" name='".$selectDestino."' id='".$selectDestino."' '>";
	echo "<option value='0'>Elige</option>";
	while($registro=mysql_fetch_row($consulta))
	{
		// Convierto los caracteres conflictivos a sus entidades HTML correspondientes para su correcta visualizacion
		$registro[1]=htmlentities($registro[1]);
		// Imprimo las opciones del select
		echo "<option value='".$registro[0]."'>".$registro[1]."</option>";
	}			
	echo "</select>";
}

?>