<?php 

class modeloconexion {

    var $oracle;

    function modeloconexion($link) {
        $this->oracle = $link;
    }

  
//--------------------INSERTAR-modeloconexion---------------------------------------
    function insertar_modeloconexion($nombre,$tipo) {
        $sql = "INSERT INTO  `modeloconexion` (`idmodeloconexion`, `modelo`, `idtipoconexion`) VALUES (NULL, '" . $nombre . "', '" . $tipo . "');";



        $bitacorasql = "INSERT INTO  `bitacora` (
				`idbitacora` ,
				`fecha` ,
				`accion` ,
				`usuario_idusuario`
				)
				VALUES (
				NULL , 
				CURRENT_TIMESTAMP ,  'Inserto modeloconexion numero " . $id . " - nombre " . $nombre . " ',  '" . $_SESSION['id'] . "')";
        $bita = mysql_query($bitacorasql, $this->oracle);


        $res = mysql_query($sql, $this->oracle);
        return $res;
    }
//---------------Listas-modeloconexions-------------------------------
    function listar_modeloconexiones() {

        $sql = 'select * from modeloconexion';
        $res = mysql_query($sql, $this->oracle);

        if ($res)
            return $res;
        else
            return false;
    }
//--------------------Eliminar-----------------------------------------
  

    function eliminarmodeloconexion($id) {

        $sql = 'delete from modeloconexion where idmodeloconexion="' . $id . '"';
        $res = mysql_query($sql, $this->oracle);

        $bitacorasql = "INSERT INTO  `bitacora` (
				`idbitacora` ,
				`fecha` ,
				`accion` ,
				`usuario_idusuario`
				)
				VALUES (
				NULL , 
				CURRENT_TIMESTAMP ,  'Elimino modeloconexion id " . $id . "  ',  '" . $_SESSION['id'] . "')";
        $bita = mysql_query($bitacorasql, $this->oracle);
        if ($res)
            return $res;
        else
            return false;
    }
//---------------Consultar-modeloconexion-----------------------------------------
    function consultarmodeloconexion($id) {

        $sql = 'select * from modeloconexion where idmodeloconexion="' . $id . '" limit 1';
        $res = mysql_query($sql, $this->oracle);

        if ($res)
            return $res;
        else
            return false;
    }
//-------------------------------Guardar-modeloconexion------------------------------
    function guardarmodeloconexion($nombre, $id) {

        $sql = 'UPDATE modeloconexion SET 
	nombremodel =  "' . $nombre . '"
	
	WHERE  modeloconexion.idmodeloconexion ="' . $id . '"';

        $bitacorasql = "INSERT INTO  `bitacora` (
				`idbitacora` ,
				`fecha` ,
				`accion` ,
				`usuario_idusuario`
				)
				VALUES (
				NULL , 
				CURRENT_TIMESTAMP ,  'Actualizo modeloconexion " . $id . " nombre " . mysql_real_escape_string($nombre) . " ',  '" . $_SESSION['id'] . "')";
        $bita = mysql_query($bitacorasql, $this->oracle);

        $res = mysql_query($sql, $this->oracle);

        if ($res)
            return $res;
        else
            return false;
    }

}

?>
