<?php 
// Array que vincula los IDs de los selects declarados en el HTML con el nombre de la tabla donde se encuentra su contenido
$listadoSelects=array(
"banca"=>"banca",
"vendedor"=>"vendedor",
"grupo"=>"grupo",
"agencia"=>"agencia"
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



if(isset($_GET['ban']) && isset($_GET['ven']) ){
$selectDestino=$_GET["select"]; //grupo
$opcionSeleccionada=$_GET["opcion"]; //id grupo
$banca=$_GET['ban']; //banca
$vendedor = $_GET['ven']; //vendedor

if(validaSelect($selectDestino) && validaOpcion($opcionSeleccionada))
{
	$tabla=$listadoSelects[$selectDestino];
	include 'class/conexion.php';
	conectar();
	
	$consulta=mysql_query("SELECT idagencia, nombre FROM agencia WHERE idgrupo ='$opcionSeleccionada' and idvendedor='$vendedor' and idbanca='$banca' order by idagencia") or die(mysql_error());
	desconectar();
	
	// Comienzo a imprimir el select
	echo '<label for="agencia_codigo" class="required">&nbsp;&nbsp;Codigo Agencia <span class="required">* </span></label>';
	echo "<select style=\" width:150px\" name='".$selectDestino."' id='".$selectDestino."'>";
	echo "<option value='0'>Elige</option>";
	while($registro=mysql_fetch_row($consulta))
	{
		// Convierto los caracteres conflictivos a sus entidades HTML correspondientes para su correcta visualizacion
		$registro[1]=htmlentities($registro[1]);
		// Imprimo las opciones del select
		echo "<option value='".$registro[0]."'>".$registro[0]." - ".$registro[1]."</option>";
	}			
	echo "</select>";
}

}else if(isset($_GET['ban'])){
$selectDestino=$_GET["select"]; //vendedor
$opcionSeleccionada=$_GET["opcion"]; //id vendedor
$banca=$_GET['ban']; //banca

if(validaSelect($selectDestino) && validaOpcion($opcionSeleccionada))
{
	$tabla=$listadoSelects[$selectDestino];
	include 'class/conexion.php';
	conectar();
	
	$consulta=mysql_query("SELECT idgrupo, nombre FROM grupo WHERE idvendedor='$opcionSeleccionada' and idbanca='$banca' order by idgrupo") or die(mysql_error());
	desconectar();
	
	// Comienzo a imprimir el select
	echo '<label for="grupo_codigo" class="required">&nbsp;&nbsp;Codigo Grupo <span class="required">* </span></label>';
	echo "<select style=\" width:150px\" name='".$selectDestino."' id='".$selectDestino."' onChange='cargarAgencia(this.id)'>";
	echo "<option value='0'>Elige</option>";
	while($registro=mysql_fetch_row($consulta))
	{
		// Convierto los caracteres conflictivos a sus entidades HTML correspondientes para su correcta visualizacion
		$registro[1]=htmlentities($registro[1]);
		// Imprimo las opciones del select
		echo "<option value='".$registro[0]."'>".$registro[0]." - ".$registro[1]."</option>";
	}			
	echo "</select>";
}

}else{
$selectDestino=$_GET["select"]; //banca
$opcionSeleccionada=$_GET["opcion"]; // id banca
if(validaSelect($selectDestino) && validaOpcion($opcionSeleccionada))
{
	$tabla=$listadoSelects[$selectDestino];
	include 'class/conexion.php';
	conectar();
	
	$consulta=mysql_query("SELECT idvendedor, nombre FROM vendedor WHERE idbanca='$opcionSeleccionada' order by idvendedor") or die(mysql_error());
	desconectar();
	
	// Comienzo a imprimir el select
	echo '<label for="vendedor_codigo" class="required">&nbsp;&nbsp;Codigo Receptor <span class="required">* </span></label>';
	echo "<select style=\" width:150px\" name='".$selectDestino."' id='".$selectDestino."' onChange='cargarGrupo(this.id)'>";
	echo "<option value='0'>Elige</option>";
	while($registro=mysql_fetch_row($consulta))
	{
		// Convierto los caracteres conflictivos a sus entidades HTML correspondientes para su correcta visualizacion
		$registro[1]=htmlentities($registro[1]);
		// Imprimo las opciones del select
		echo "<option value='".$registro[0]."'>".$registro[0]." - ".$registro[1]."</option>";
	}			
	echo "</select>";
}
}
?>