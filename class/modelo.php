<?php 

class modelo {

    var $oracle;

    function modelo($link) {
        $this->oracle = $link;
    }

  
//--------------------INSERTAR-MODELO---------------------------------------
    function insertar_modelo($nombre,$tipo) {
        $sql = "INSERT INTO  `modelo` (`idmodelo`, `nombremodel`,`idtipoitem`) 
        VALUES (NULL, '" .str_replace("-", " ", "$nombre"). "','".$tipo."')";

        ;


        $bitacorasql = "INSERT INTO  `bitacora` (
				`idbitacora` ,
				`fecha` ,
				`accion` ,
				`usuario_idusuario`
				)
				VALUES (
				NULL , 
				CURRENT_TIMESTAMP ,  'Inserto modelo nombre " . $nombre . " de tipo ". $tipo."',  '" . $_SESSION['id'] . "')";
        $bita = mysql_query($bitacorasql, $this->oracle);


        $res = mysql_query($sql, $this->oracle);
        return $res;
    }
//---------------Listas-modelos-------------------------------
    function listar_modelos() {

        $sql = 'select * from modelo';
        $res = mysql_query($sql, $this->oracle);

        if ($res)
            return $res;
        else
            return false;
    }
    //---------------Listas-modelos-por tipo------------------------------
    function listar_modelos_tipo($id) {

        $sql = 'select * from modelo where idtipoitem="'.$id.'"';
        $res = mysql_query($sql, $this->oracle);

        if ($res)
            return $res;
        else
            return false;
    }
//--------------------Eliminar-----------------------------------------
  

    function eliminarmodelo($id) {

        $sql = 'delete from modelo where idmodelo="' . $id . '"';
        $res = mysql_query($sql, $this->oracle);

        $bitacorasql = "INSERT INTO  `bitacora` (
				`idbitacora` ,
				`fecha` ,
				`accion` ,
				`usuario_idusuario`
				)
				VALUES (
				NULL , 
				CURRENT_TIMESTAMP ,  'Elimino modelo id " . $id . "  ',  '" . $_SESSION['id'] . "')";
        $bita = mysql_query($bitacorasql, $this->oracle);
        if ($res)
            return $res;
        else
            return false;
    }
//---------------Consultar-Modelo-----------------------------------------
    function consultarmodelo($id) {

        $sql = 'select * from modelo where idmodelo="' . $id . '" limit 1';
        $res = mysql_query($sql, $this->oracle);

        if ($res)
            return $res;
        else
            return false;
    }
//-------------------------------Guardar-Modelo------------------------------
    function guardarmodelo($nombre, $id) {

        $sql = 'UPDATE modelo SET 
	nombremodel =  "' . $nombre . '"
	
	WHERE  modelo.idmodelo ="' . $id . '"';

        $bitacorasql = "INSERT INTO  `bitacora` (
				`idbitacora` ,
				`fecha` ,
				`accion` ,
				`usuario_idusuario`
				)
				VALUES (
				NULL , 
				CURRENT_TIMESTAMP ,  'Actualizo modelo " . $id . " nombre " . mysql_real_escape_string($nombre) . " ',  '" . $_SESSION['id'] . "')";
        $bita = mysql_query($bitacorasql, $this->oracle);

        $res = mysql_query($sql, $this->oracle);

        if ($res)
            return $res;
        else
            return false;
    }

}

?>
