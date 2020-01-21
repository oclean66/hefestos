<?php
class agencia {
	var $oracle;
	
	function agencia($link){
		$this->oracle=$link;
	}
    //--------------------Insertar-Agencias-----------------------------------------------------------    
	function insertar_agencia($id,$nombre,$idgr,$idv,$idb,$rep,$ced,$tlf,$email,$dire,$ciud) {

		$sql = "INSERT INTO `agencia` (`idagencia`, `idgrupo`, `idvendedor`, `idbanca`, `nombre`, `cedula`,`responsable`, `telefono`, `email`, `direccion`, `ciudad_idciudad`) 
		VALUES ('".strtoupper(str_replace(' ', '', $id))."', '".$idgr."', '".$idv."', '".$idb."',
			'".strtoupper($nombre)."', '".$ced."','".$rep."', '".$tlf."', '".$email."', '".$dire."', '".$ciud."');";
$res=mysql_query($sql,$this->oracle); 

$bitacorasql= "INSERT INTO  `bitacora` (
	`idbitacora` ,
	`fecha` ,
	`accion` ,
	`usuario_idusuario`
	)
VALUES (
	NULL , 
	CURRENT_TIMESTAMP ,  'Inserto agencia ".$id." - ".$nombre." - receptor ".$idv." grupo ".$idgr." banca ".$idb."',  '". $_SESSION['id']."')";   


$bita=mysql_query($bitacorasql,$this->oracle); 

return $res;        
}

function listar_agencias() {

	$sql = 'SELECT idvendedor, vendedor.nombre AS nombre, idagencia, agencia.nombre AS nombreVen, grupo_idgrupo, grupo.nombre as grnom
	FROM agencia, vendedor, grupo
	WHERE grupo_vendedor_idvendedor = idvendedor and idgrupo=grupo_idgrupo AND vendedor_idvendedor = idvendedor';
	$res=mysql_query($sql,$this->oracle);

	if($res)
		return $res;
	else
		return false;
}

function listar_agenciasconlimite($limite) {

	$sql = 'SELECT idvendedor, vendedor.nombre AS nombre, idagencia, agencia.nombre AS nombreVen, grupo_idgrupo, grupo.nombre as grnom
	FROM agencia, vendedor, grupo
	WHERE grupo_vendedor_idvendedor = idvendedor and idgrupo=grupo_idgrupo AND vendedor_idvendedor = idvendedor
	ORDER BY idvendedor, idagencia '.$limite;
	$res=mysql_query($sql,$this->oracle);

	if($res)
		return $res;
	else
		return false;
}
   //-----------------------Eliminar-Agencia--------------------------------------------------------
function eliminaragencia($id,$idg,$idv,$idb) {

	$sql = 'delete from agencia where idagencia="'.$id.'" and idgrupo="'.$idg.'" and idvendedor = "'.$idv.'" and idbanca = "'.$idb.'"';
	$res=mysql_query($sql,$this->oracle);



	$bitacorasql= "INSERT INTO  `bitacora` (
		`idbitacora` ,
		`fecha` ,
		`accion` ,
		`usuario_idusuario`
		)
VALUES (
	NULL , 
	CURRENT_TIMESTAMP ,  'Elimino agencia ".$id."',  '". $_SESSION['id']."')";   


$bita=mysql_query($bitacorasql,$this->oracle); 

if($res)
	return $res;
else
	return false;
}
//------------------------ Cambiar ID de Agencia -----------------------------------------------
function cambiarid($ido,$idd,$grupo,$vendedor,$banca) {

	$sql = 'UPDATE agencia set idagencia = "'.$idd.'" where idagencia = "'.$ido.'" and idgrupo = "'.$grupo.'" and idvendedor = "'.$vendedor.'" and idbanca = "'.$banca.'"';
	$res=mysql_query($sql,$this->oracle);
	

	$sql = 'UPDATE computador set idagencia = "'.$idd.'" where idagencia = "'.$ido.'" and idgrupo = "'.$grupo.'" and idvendedor = "'.$vendedor.'" and idbanca = "'.$banca.'"';
	$res=mysql_query($sql,$this->oracle);



$bitacorasql= "INSERT INTO  `bitacora` (`idbitacora` ,`fecha` ,`accion` ,`usuario_idusuario`) VALUES (NULL , 	CURRENT_TIMESTAMP ,  'Actualizo Codigo agencia de ".$idd."  para ".$ido." vendedor ".$vendedor." grupo ".$grupo."',  '". $_SESSION['id']."')";   
$bita=mysql_query($bitacorasql,$this->oracle); 


if($res){
	return $res;
}
else{
	return false;

}
	
}
    //---------------------- Consultar-Agencia -----------------------------------------------
function consultaragencia($id,$idgr,$idv,$idb) {

	$sql = 'select agencia.idagencia, agencia.nombre as nombre, grupo.idgrupo, grupo.nombre as nombregr,
	 vendedor.idvendedor, vendedor.nombre as nombreven, banca.idbanca, banca.nombre as nombreban,
	  responsable, agencia.email as email, agencia.direccion as direccion, agencia.telefono as telefono,
	   cedula,Estado
	from agencia, grupo,vendedor,banca
	where agencia.idgrupo = grupo.idgrupo and agencia.idvendedor = vendedor.idvendedor and agencia.idbanca = banca.idbanca
	and grupo.idvendedor = vendedor.idvendedor and grupo.idbanca = banca.idbanca 
	and vendedor.idbanca = banca.idbanca
	and agencia.idagencia = "'.$id.'" and agencia.idgrupo = "'.$idgr.'" and agencia.idvendedor = "'.$idv.'" and agencia.idbanca = "'.$idb.'" limit 1';
	$res=mysql_query($sql,$this->oracle);

	if($res)
		return $res;
	else
		return false;
}
function consultaragenciasdegrupo($idg,$idv) {

	$sql = 'select idagencia, agencia.nombre as nombre 
	from agencia, grupo 
	where grupo_idgrupo="'.$idg.'" and grupo_idgrupo = idgrupo and grupo_vendedor_idvendedor= "'.$idv.'" and vendedor_idvendedor= "'.$idv.'"';
	$res=mysql_query($sql,$this->oracle);

	if($res)
		return $res;
	else
		return false;
}

function consultargrupoagencia($id) {

	$sql = 'select idgrupo,grupo.nombre 
	from agencia, grupo where grupo_idgrupo=idgrupo and idagencia="'.$id.'"';
	$res=mysql_query($sql,$this->oracle);

	if($res)
		return $res;
	else
		return false;
}


function consultaragencianombre($id,$idg,$idv) {

	$sql = 'select concat(idagencia," - ",nombre)  from agencia where grupo_vendedor_idvendedor="'.$idv.'" and idagencia="'.$id.'" and grupo_idgrupo= "'.$idg.'"';
	
	$res=mysql_query($sql,$this->oracle);

	if($res)
		return $res;
	else
		return false;
}
	//-----------------------Guardar-Agencia--------------------------------------------
function guardaragencia($id,$nombre,$responsable,$cedula,$telefono,$email,$direccion,$idgr,$idv,$idb) {

	$sql = 'UPDATE agencia SET 
	nombre =  "'.$nombre.'",
	responsable =  "'.$responsable.'",
	cedula = "'.$cedula.'",
	telefono =  "'.$telefono.'",
	email =  "'.$email.'",
	direccion =  "'.$direccion.'"
	
	WHERE  agencia.idagencia ="'.$id.'"
	and idgrupo = "'. $idgr.'"
	and idvendedor = "'.$idv.'"
	and idbanca = "'.$idb.'"';
	
	$res=mysql_query($sql,$this->oracle);

	$bitacorasql= "INSERT INTO  `bitacora` (
		`idbitacora` ,
		`fecha` ,
		`accion` ,
		`usuario_idusuario`
		)
VALUES (
	NULL , 
	CURRENT_TIMESTAMP ,  'Actualizo agencia ".$id."  ".$nombre." ".$idv."',  '". $_SESSION['id']."')";   


$bita=mysql_query($bitacorasql,$this->oracle); 

if($res)
	return $res;
else
	return false;
}
    //------------------------------------------------------------------------------------------

function moveragencia($idagencia,$idgrupoold,$idvendedorold,$idbancaold,$idgrupo,$idvendedor,$idbanca) {

	$sql = 'insert into agencia 
	select "'.$idagencia.'","'.$idgrupo.'","'.$idvendedor.'","'.$idbanca.'",nombre,cedula, responsable, telefono, 
	email, direccion, ciudad_idciudad 
	from agencia 
	where idagencia = "'.$idagencia.'"
	and idgrupo ="'.$idgrupoold.'"
	and idvendedor="'.$idvendedorold.'"
	and idbanca="'.$idbancaold.'"';
	
$res=mysql_query($sql,$this->oracle);

	$sql = 'UPDATE computador 
	SET idagencia ="'.$idagencia.'",
	idgrupo = "'.$idgrupo.'",
	idvendedor = "'.$idvendedor.'",
	idbanca = "'.$idbanca.'"
	WHERE idagencia ="'.$idagencia.'"
	and idgrupo = "'.$idgrupoold.'"
	and idvendedor = "'.$idvendedorold.'"
	and idbanca = "'.$idbancaold.'"';
	
$res=mysql_query($sql,$this->oracle);


	$sql = 'DELETE from agencia 
	WHERE idagencia ="'.$idagencia.'"
	and idgrupo = "'.$idgrupoold.'"
	and idvendedor = "'.$idvendedorold.'"
	and idbanca = "'.$idbancaold.'"';
	
$res=mysql_query($sql,$this->oracle);

	$bitacorasql= "INSERT INTO  `bitacora` (
		`idbitacora` ,
		`fecha` ,
		`accion` ,
		`usuario_idusuario`)VALUES (NULL ,CURRENT_TIMESTAMP ,  
'Movio agencia  desde ".$idagencia." | ".$idgrupoold." | ".$idvendedorold." | ".$idbancaold." 
				hasta ".$idagencia." | ".$idgrupo." | ".$idvendedor." | ".$idbanca."',
				  '". $_SESSION['id']."')";  

$bita=mysql_query($bitacorasql,$this->oracle); 


if($res)
	return $res;
else
	return false;
}


    //-------------------------------------------------------------------------------------------


}

?>
