<?php 
class grupo {
    var $oracle;
	
    function grupo($link){
 		$this->oracle=$link;
 	}
  //---------------------------------------------------------      
	 function consultaragenciasdegrupo($idg,$idv,$idb) {
       
	$sql = 'select * from agencia where 
	idgrupo="'.$idg.'" 
	and idvendedor = "'.$idv.'"
	and idbanca = "'.$idb.'"';
	
		$res=mysql_query($sql,$this->oracle);
		       
        if($res)
            return $res;
        else
            return false;
    }
	
//-----------------------Insertar-Grupo-------------------------------------------------
    function insertar_grupo($id,$nombre,$idv,$idb) {
       $sql = "INSERT INTO  `grupo`  (`idgrupo`, `nombre`, `idvendedor`, `idbanca`) 
       VALUES ('".strtoupper(str_replace(' ', '', $id))."','".strtoupper($nombre)."', '".$idv."', '".$idb."');";
		$res=mysql_query($sql,$this->oracle); 
		
		$bitacorasql= "INSERT INTO  `bitacora` (
				`idbitacora` ,
				`fecha` ,
				`accion` ,
				`usuario_idusuario`
				)
				VALUES (
				NULL , 
				CURRENT_TIMESTAMP ,  'Inserto grupo ".$id." - ".$nombre." - receptor ".$idv."',  '". $_SESSION['id']."')";   
				
		
		$bita=mysql_query($bitacorasql,$this->oracle); 
        
		return $res;        
    }
	//-----------------------------------------------------------
    function listar_grupos() {
       
		$sql = 'select idvendedor, vendedor.nombre AS nombreven, idgrupo, grupo.nombre AS nombre 
		from grupo, vendedor where idvendedor=vendedor_idvendedor';
		$res=mysql_query($sql,$this->oracle);
		       
        if($res)
            return $res;
        else
            return false;
    }
	//-------------------------------------------
	 function listar_gruposconlimite($limite) {
       
		$sql = 'select idvendedor, vendedor.nombre AS nombreven, idgrupo, grupo.nombre AS nombre 
		from grupo, vendedor where idvendedor=vendedor_idvendedor
ORDER BY idvendedor, idgrupo '.$limite;
		$res=mysql_query($sql,$this->oracle);
		       
        if($res)
            return $res;
        else
            return false;
    }
   //-------------------------Eliminar-Grupo---------------------------------------
    function eliminargrupo($id,$idv,$idb) {
       
		$sql = 'delete from grupo 
		where idgrupo="'.$id.'" 
		and idvendedor="'.$idv.'" 
		and idbanca="'.$idb.'"';
		$res=mysql_query($sql,$this->oracle);
		
		
		
		$bitacorasql= "INSERT INTO  `bitacora` (
				`idbitacora` ,
				`fecha` ,
				`accion` ,
				`usuario_idusuario`
				)
				VALUES (
				NULL , 
				CURRENT_TIMESTAMP ,  'Elimino grupo ".$id." del vendedor ".$idv."',  '". $_SESSION['id']."')";   
				
		
		$bita=mysql_query($bitacorasql,$this->oracle); 
		       
        if($res)
            return $res;
        else
            return false;
    }
    //----------------------Consultar-Grupo----------------------------------------------------------
	 function consultargrupo($id,$idv,$idb) {
       
	$sql = 'select idgrupo,grupo.nombre as nombregr, vendedor.idvendedor, vendedor.nombre as nombreven, banca.idbanca, banca.nombre as nombreban 
	from grupo, vendedor,banca where grupo.idvendedor = vendedor.idvendedor and grupo.idbanca = banca.idbanca and vendedor.idbanca = banca.idbanca and idgrupo = "'.$id.'" and grupo.idvendedor = "'.$idv.'" and grupo.idbanca = "'.$idb.'"';
		$res=mysql_query($sql,$this->oracle);
		       
        if($res)
            return $res;
        else
            return false;
    }
    //------------------------------------------------------------
    function consultaragenciagrupo($id,$idv) {
       
	$sql = 'select agencia.nombre as nombreag, idagencia 
	from grupo, agencia,vendedor 
	where vendedor_idvendedor=idvendedor 
	and grupo_idgrupo=idgrupo
	and grupo_vendedor_idvendedor= idvendedor
	and idvendedor="'.$idv.'" 
	and idgrupo="'.$id.'"';
		$res=mysql_query($sql,$this->oracle);
		       
        if($res)
            return $res;
        else
            return false;
    }
	//------------------------------------------------------------------
	 function consultargruponombre($id,$idv) {
       
	$sql = 'select nombre  from grupo where vendedor_idvendedor="'.$idv.'" and idgrupo="'.$id.'"';
	
		$res=mysql_query($sql,$this->oracle);
		       
        if($res)
            return $res;
        else
            return false;
    }
	//---------------------Guardar-Grupo--------------------------------------------------
	 function guardargrupo($nombre,$id,$idv,$idb) {
       
	$sql = 'UPDATE grupo SET 
	
	nombre =  "'.$nombre.'"
	
	WHERE  grupo.idgrupo ="'.$id.'" and idvendedor= "'.$idv.'" and idbanca = "'.$idb.'"';
	
		$res=mysql_query($sql,$this->oracle);
		
		$bitacorasql= "INSERT INTO  `bitacora` (
				`idbitacora` ,
				`fecha` ,
				`accion` ,
				`usuario_idusuario`
				)
				VALUES (
				NULL , 
				CURRENT_TIMESTAMP ,  'Actualizo grupo ".$id." ".$nombre." vendedor: ".$idv." banca: ".$idb."',  '". $_SESSION['id']."')";   
				
		
		$bita=mysql_query($bitacorasql,$this->oracle); 
		       
        if($res)
            return $res;
        else
            return false;
    }
 //----------------------------------------------------------------------------------	
 	function insertar_agencia($id,$nombre,$idv,$idgrupo) {
       $sql = "INSERT INTO `agencia` (`idagencia`, `nombre`, `grupo_idgrupo`, `grupo_vendedor_idvendedor`) VALUES ('".$id."', '".$nombre."', '".$idgrupo."', '".$idv."');";
		$res=mysql_query($sql,$this->oracle); 
	
        
		return $res;        
    }
    //----------------------------------------------------------------------
    function consultacomputadoragencia($agencia,$grupo,$vendedor,$banca) {
       
		
$sql = 'select * from computador 
where idagencia="'.$agencia.'" 
and idgrupo="'.$grupo.'" 
and idvendedor = "'.$vendedor.'"
and idbanca = "'.$banca.'"';
		$res=mysql_query($sql,$this->oracle);
		       
        if($res)
            return $res;
        else
            return false;
    }
    //----------------------------------------------------------------------
     function eliminaragencia($idagencia,$idgrupo,$idvendedor,$idbanca) {
       
		$sql = 'DELETE from agencia 
		where idagencia="'.$idagencia.'" 
		and idvendedor="'.$idvendedor.'" 
		and idgrupo = "'.$idgrupo.'"
		and idbanca = "'.$idbanca.'"';
		$res=mysql_query($sql,$this->oracle);
		
			
		       
        if($res)
            return $res;
        else
            return false;
    }
    //-------------------------------------------------------------------
     function actualizarcomputador($idagencia,$idgrupo,$idvendedor,$idbanca,$idvendedorold,$idbancaold) {
       
		
	$sql = 'UPDATE computador 
	SET idagencia ="'.$idagencia.'",
	idgrupo = "'.$idgrupo.'",
	idvendedor = "'.$idvendedor.'",
	idbanca = "'.$idbanca.'"
	WHERE idagencia ="'.$idagencia.'"
	and idgrupo = "'.$idgrupo.'"
	and idvendedor = "'.$idvendedorold.'"
	and idbanca = "'.$idbancaold.'"';

		$res=mysql_query($sql,$this->oracle);
		      
        if($res)
            return $res;
        else
            return false;
    }
//-------------------------------------------------------------------
    function movergrupo($idgrupo,$vendedorold,$bancaold,$vendedor,$banca) {
       
	$sql = 'insert into grupo 
	select "'.$idgrupo.'",nombre,"'.$vendedor.'","'.$banca.'" 
	from grupo 
	where idgrupo ="'.$idgrupo.'"
	and idvendedor="'.$vendedorold.'"
	and idbanca="'.$bancaold.'"';
	
	$res=mysql_query($sql,$this->oracle);
	$listaAgencias = $this->consultaragenciasdegrupo($idgrupo,$vendedorold,$bancaold);


	while($fila=mysql_fetch_array($listaAgencias)){

		$sql = 'INSERT INTO agencia VALUES
		("'.$fila['idagencia'].'","'.$idgrupo.'","'.$vendedor.'",
		"'.$banca.'","'.$fila['nombre'].'",
		"'.$fila['responsable'].'", "'.$fila['telefono'].'", 
		"'.$fila['email'].'", "'.$fila['direccion'].'", "'.$fila['ciudad_idciudad'].'")';
	
		$res=mysql_query($sql,$this->oracle);
		$this->actualizarcomputador($fila['idagencia'],$idgrupo,$vendedor,$banca,$vendedorold,$bancaold);

		 
		$this->eliminaragencia($fila['idagencia'],$idgrupo,$vendedorold,$bancaold);
		
		
	}

	$this->eliminargrupo($idgrupo,$vendedorold,$bancaold);

$bitacorasql= "INSERT INTO  `bitacora` (
		`idbitacora` ,
				`fecha` ,
				`accion` ,
				`usuario_idusuario`
				)
				VALUES (
				NULL , 
				CURRENT_TIMESTAMP ,  'Movio grupo desde ".$idgrupo."-".$vendedorold."-".$bancaold." hasta ".$vendedor."-".$banca." ',  '". $_SESSION['id']."')";   
				
		
		$bita=mysql_query($bitacorasql,$this->oracle);     
    }
    
 
}

?>
