<?php 
// Array que vincula los IDs de los selects declarados en el HTML con el nombre de la tabla donde se encuentra su contenido
$listadoSelects=array(
"tipoconexions"=>"tipoconexion",
"modeloconexions"=>"modeloconexion",
"tipoitem"=>"tipoitem",
"modelo"=>"modelo",
"select[]"=>"tipoitem",
"selectmodel[]"=>"modelo"

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
	
	if ($tabla=="modelo") {
		$sql = "SELECT idmodelo, nombremodel FROM modelo WHERE idtipoitem='$opcionSeleccionada'";
			
	
	}else{$sql = "SELECT idmodeloconexion, modelo FROM modeloconexion WHERE idtipoconexion='$opcionSeleccionada'";
			
	}
	$consulta=mysql_query($sql) or die(mysql_error());
	desconectar();
	
	// Comienzo a imprimir el select
	
	echo "<select style=\" width:150px\" name='".$selectDestino."' id='".$selectDestino."' onchange = document.forms[0]['scriptBox'].focus()>";
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