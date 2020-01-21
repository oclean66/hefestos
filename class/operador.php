<?php 

class operador {

    var $oracle;

    function operador($link) {
        $this->oracle = $link;
    }

  
//--------------------INSERTAR-operador---------------------------------------
    function insertar_operador($id, $nombre) {
        $sql = "INSERT INTO  `operador` (`idoperador`, `nombremodel`) VALUES ('" . $id . "', '" . $nombre . "');";



        $bitacorasql = "INSERT INTO  `bitacora` (
				`idbitacora` ,
				`fecha` ,
				`accion` ,
				`usuario_idusuario`
				)
				VALUES (
				NULL , 
				CURRENT_TIMESTAMP ,  'Inserto operador numero " . $id . " - nombre " . $nombre . " ',  '" . $_SESSION['id'] . "')";
        $bita = mysql_query($bitacorasql, $this->oracle);


        $res = mysql_query($sql, $this->oracle);
        return $res;
    }
//---------------Listas-operadors-------------------------------
    function listar_operadores() {

        $sql = 'select * from operador';
        $res = mysql_query($sql, $this->oracle);

        if ($res)
            return $res;
        else
            return false;
    }
//--------------------Eliminar-----------------------------------------
  

    function eliminaroperador($id) {

        $sql = 'delete from operador where idoperador="' . $id . '"';
        $res = mysql_query($sql, $this->oracle);

        $bitacorasql = "INSERT INTO  `bitacora` (
				`idbitacora` ,
				`fecha` ,
				`accion` ,
				`usuario_idusuario`
				)
				VALUES (
				NULL , 
				CURRENT_TIMESTAMP ,  'Elimino operador id " . $id . "  ',  '" . $_SESSION['id'] . "')";
        $bita = mysql_query($bitacorasql, $this->oracle);
        if ($res)
            return $res;
        else
            return false;
    }
//---------------Consultar-operador-----------------------------------------
    function consultaroperador($id) {

        $sql = 'select * from operador where idoperador="' . $id . '" limit 1';
        $res = mysql_query($sql, $this->oracle);

        if ($res)
            return $res;
        else
            return false;
    }
//-------------------------------Guardar-operador------------------------------
    function guardaroperador($nombre, $id) {

        $sql = 'UPDATE operador SET 
	nombremodel =  "' . $nombre . '"
	
	WHERE  operador.idoperador ="' . $id . '"';

        $bitacorasql = "INSERT INTO  `bitacora` (
				`idbitacora` ,
				`fecha` ,
				`accion` ,
				`usuario_idusuario`
				)
				VALUES (
				NULL , 
				CURRENT_TIMESTAMP ,  'Actualizo operador " . $id . " nombre " . mysql_real_escape_string($nombre) . " ',  '" . $_SESSION['id'] . "')";
        $bita = mysql_query($bitacorasql, $this->oracle);

        $res = mysql_query($sql, $this->oracle);

        if ($res)
            return $res;
        else
            return false;
    }

}

?>
