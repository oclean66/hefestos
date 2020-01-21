<?php 

class suministro {

    var $oracle;

    function suministro($link) {
        $this->oracle = $link;
    }

  
//--------------------INSERTAR-suministro---------------------------------------
    function insertar_suministro($id, $nombre) {
        $sql = "INSERT INTO  `suministros` (`idsuministros`, `nombre`, `cantidad`) VALUES (NULL,'" . $id . "', '" . $nombre . "');";



        $bitacorasql = "INSERT INTO  `bitacora` (
				`idbitacora` ,
				`fecha` ,
				`accion` ,
				`usuario_idusuario`
				)
				VALUES (
				NULL , 
				CURRENT_TIMESTAMP ,  'Inserto suministro " . $id . " - cantidad " . $nombre . " ',  '" . $_SESSION['id'] . "')";
        
        $res = mysql_query($sql, $this->oracle);

    if($res) $bita = mysql_query($bitacorasql, $this->oracle);


        
        return $res;
    }
//---------------Listas-suministros-------------------------------
    function listar_suministroes() {

        $sql = 'select * from suministro';
        $res = mysql_query($sql, $this->oracle);

        if ($res)
            return $res;
        else
            return false;
    }
//--------------------Eliminar-----------------------------------------
  

    function eliminarsuministro($id) {

        $sql = 'delete from suministros where idsuministros ="' . $id . '"';
        $res = mysql_query($sql, $this->oracle);

        $bitacorasql = "INSERT INTO  `bitacora` (
				`idbitacora` ,
				`fecha` ,
				`accion` ,
				`usuario_idusuario`
				)
				VALUES (
				NULL , 
				CURRENT_TIMESTAMP ,  'Elimino suministro id " . $id . "  ',  '" . $_SESSION['id'] . "')";
        $bita = mysql_query($bitacorasql, $this->oracle);
        if ($res)
            return $res;
        else
            return false;
    }
//---------------Consultar-suministro-----------------------------------------
    function consultarsuministro($id) {

        $sql = 'select * from suministros where idsuministros="' . $id . '" limit 1';
        $res = mysql_query($sql, $this->oracle);

        if ($res)
            return $res;
        else
            return false;
    }
//---------------Cargar-suministro-----------------------------------------
    function cargarsuministro($id,$cantidad) {

         $sql = 'UPDATE suministros SET   
        cantidad = cantidad + '.$cantidad.'  
        WHERE  suministros.idsuministros =' . $id;
        echo $sql;

        $res = mysql_query($sql, $this->oracle);

        if ($res)
            return $res;
        else
            return false;
    }
//-------------------------------Guardar-suministro------------------------------
    function guardarsuministro($nombre, $id,$cantidad) {

        $sql = 'UPDATE suministros SET 
	nombre =  "' . $nombre . '",
    cantidad = "'.$cantidad.'"
	
	WHERE  suministros.idsuministros ="' . $id . '"';

        $bitacorasql = "INSERT INTO  `bitacora` (
				`idbitacora` ,
				`fecha` ,
				`accion` ,
				`usuario_idusuario`
				)
				VALUES (
				NULL , 
				CURRENT_TIMESTAMP ,  'Actualizo suministro " . $id . " nombre " . mysql_real_escape_string($nombre) . " ',  '" . $_SESSION['id'] . "')";
        $bita = mysql_query($bitacorasql, $this->oracle);

        $res = mysql_query($sql, $this->oracle);

        if ($res)
            return $res;
        else
            return false;
    }

}

?>
