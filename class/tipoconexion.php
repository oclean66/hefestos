<?php 

class tipoconexion {

    var $oracle;

    function tipoconexion($link) {
        $this->oracle = $link;
    }

  
//--------------------INSERTAR-tipoconexion---------------------------------------
    function insertar_tipoconexion($nombre) {
        $sql = "INSERT INTO  `tipoconexion` (`idtipoconexion`, `conexionnombre`) VALUES (NULL, '" . $nombre . "');";



        $bitacorasql = "INSERT INTO  `bitacora` (
				`idbitacora` ,
				`fecha` ,
				`accion` ,
				`usuario_idusuario`
				)
				VALUES (
				NULL , 
				CURRENT_TIMESTAMP ,  'Inserto tipoconexion numero " . $id . " - nombre " . $nombre . " ',  '" . $_SESSION['id'] . "')";
        $bita = mysql_query($bitacorasql, $this->oracle);


        $res = mysql_query($sql, $this->oracle);
        return $res;
    }
//---------------Listas-tipoconexions-------------------------------
    function listar_tipoconexiones() {

        $sql = 'select * from tipoconexion';
        $res = mysql_query($sql, $this->oracle);

        if ($res)
            return $res;
        else
            return false;
    }
//--------------------Eliminar-----------------------------------------
  

    function eliminartipoconexion($id) {

        $sql = 'delete from tipoconexion where idtipoconexion="' . $id . '"';
        $res = mysql_query($sql, $this->oracle);

        $bitacorasql = "INSERT INTO  `bitacora` (
				`idbitacora` ,
				`fecha` ,
				`accion` ,
				`usuario_idusuario`
				)
				VALUES (
				NULL , 
				CURRENT_TIMESTAMP ,  'Elimino tipoconexion id " . $id . "  ',  '" . $_SESSION['id'] . "')";
        $bita = mysql_query($bitacorasql, $this->oracle);
        if ($res)
            return $res;
        else
            return false;
    }
//---------------Consultar-tipoconexion-----------------------------------------
    function consultartipoconexion($id) {

        $sql = 'select * from tipoconexion where idtipoconexion="' . $id . '" limit 1';
        $res = mysql_query($sql, $this->oracle);

        if ($res)
            return $res;
        else
            return false;
    }
//-------------------------------Guardar-tipoconexion------------------------------
    function guardartipoconexion($nombre, $id) {

        $sql = 'UPDATE tipoconexion SET 
	nombremodel =  "' . $nombre . '"
	
	WHERE  tipoconexion.idtipoconexion ="' . $id . '"';

        $bitacorasql = "INSERT INTO  `bitacora` (
				`idbitacora` ,
				`fecha` ,
				`accion` ,
				`usuario_idusuario`
				)
				VALUES (
				NULL , 
				CURRENT_TIMESTAMP ,  'Actualizo tipoconexion " . $id . " nombre " . mysql_real_escape_string($nombre) . " ',  '" . $_SESSION['id'] . "')";
        $bita = mysql_query($bitacorasql, $this->oracle);

        $res = mysql_query($sql, $this->oracle);

        if ($res)
            return $res;
        else
            return false;
    }

}

?>
