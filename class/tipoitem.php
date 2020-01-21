<?php 

class tipoitem {

    var $oracle;

    function tipoitem($link) {
        $this->oracle = $link;
    }

    
//---------------------insertar----------------------------------
    function insertar_tipoitem( $nombre) {
        $sql = "INSERT INTO  `tipoitem` (`idtipoitem`, `tipo`) VALUES (NULL, '" . $nombre . "');";

        $res = mysql_query($sql, $this->oracle);
        return $res;
    }
//-------------------Listar---------------------------------
    function listar_tipoitems() {

        $sql = 'select * from tipoitem';
        $res = mysql_query($sql, $this->oracle);

        if ($res)
            return $res;
        else
            return false;
    }

    
    function eliminartipoitem($id) {

        $sql = 'delete from tipoitem where idtipoitem="' . $id . '"';
        $res = mysql_query($sql, $this->oracle);

         if ($res)
            return $res;
        else
            return false;
    }
//---------------------Consultar-------------------------------------
    function consultartipoitem($id) {

        $sql = 'select * from tipoitem where idtipoitem="' . $id . '" limit 1';
        $res = mysql_query($sql, $this->oracle);

        if ($res)
            return $res;
        else
            return false;
    }
//---------------------------Guardar---------------------------------
    function guardartipoitem($nombre, $id) {

        $sql = 'UPDATE tipoitem SET 
	tipo =  "' . $nombre . '"
	
	WHERE  tipoitem.idtipoitem ="' . $id . '"';

        $res = mysql_query($sql, $this->oracle);

        if ($res)
            return $res;
        else
            return false;
    }

}

?>
