<?php 

class estado {

    var $oracle;

    function estado($link) {
        $this->oracle = $link;
    }

  

    function insertar_estado($id, $nombre) {
        $sql = "INSERT INTO  `estado` (`idestado`, `nombre`) VALUES ('" . $id . "', '" . $nombre . "');";



        $bitacorasql = "INSERT INTO  `bitacora` (
				`idbitacora` ,
				`fecha` ,
				`accion` ,
				`usuario_idusuario`
				)
				VALUES (
				NULL , 
				CURRENT_TIMESTAMP ,  'Inserto estado numero " . $id . " - nombre " . $nombre . " ',  '" . $_SESSION['id'] . "')";
        $bita = mysql_query($bitacorasql, $this->oracle);


        $res = mysql_query($sql, $this->oracle);
        return $res;
    }
//---------------Listas-estados-------------------------------
    function listar_estados() {

        $sql = 'select * from estadovzla';
        $res = mysql_query($sql, $this->oracle);

        if ($res)
            return $res;
        else
            return false;
    }
//-------------------------------------------------------------
  

    function eliminarestado($id) {

        $sql = 'delete from estado where idestado="' . $id . '"';
        $res = mysql_query($sql, $this->oracle);

        $bitacorasql = "INSERT INTO  `bitacora` (
				`idbitacora` ,
				`fecha` ,
				`accion` ,
				`usuario_idusuario`
				)
				VALUES (
				NULL , 
				CURRENT_TIMESTAMP ,  'Elimino estado id " . $id . "  ',  '" . $_SESSION['id'] . "')";
        $bita = mysql_query($bitacorasql, $this->oracle);
        if ($res)
            return $res;
        else
            return false;
    }

    function consultarestado($id) {

        $sql = 'select * from estado where idestado="' . $id . '" limit 1';
        $res = mysql_query($sql, $this->oracle);

        if ($res)
            return $res;
        else
            return false;
    }

    function guardarestado($nombre, $id) {

        $sql = 'UPDATE estado SET 
	nombre =  "' . $nombre . '"
	
	WHERE  estado.idestado ="' . $id . '"';

        $bitacorasql = "INSERT INTO  `bitacora` (
				`idbitacora` ,
				`fecha` ,
				`accion` ,
				`usuario_idusuario`
				)
				VALUES (
				NULL , 
				CURRENT_TIMESTAMP ,  'Actualizo estado " . $id . " nombre " . mysql_real_escape_string($nombre) . " ',  '" . $_SESSION['id'] . "')";
        $bita = mysql_query($bitacorasql, $this->oracle);

        $res = mysql_query($sql, $this->oracle);

        if ($res)
            return $res;
        else
            return false;
    }

}

?>
