<?php 

class vendedor {

    var $oracle;

    function vendedor($link) {
        $this->oracle = $link;
    }
//------------------------------------------------------
    function consultargrupovendedor($id,$idbanca) {

        $sql = 'select *  from grupo 
        where idvendedor ="' . $id . '"
        and idbanca = "'.$idbanca.'"';

        $res = mysql_query($sql, $this->oracle);

        if ($res)
            return $res;
        else
            return false;
    }

    function consultarvendedornombre($id) {

        $sql = 'select concat(idvendedor," - ",nombre)  from vendedor where idvendedor="' . $id . '"';

        $res = mysql_query($sql, $this->oracle);

        if ($res)
            return $res;
        else
            return false;
    }

    //------------------------------- INSERTAR-----------------------
    function insertar_vendedor($id, $nombre, $banca) {
        $sql = "INSERT INTO  `vendedor` (
        `idvendedor` ,
        `nombre` ,
        `idbanca`)
VALUES ('".strtoupper(str_replace(' ', '', $id))."',  '".strtoupper($nombre)."',  '".$banca."');";


        $bitacorasql = "INSERT INTO  `bitacora` (
				`idbitacora` ,
				`fecha` ,
				`accion` ,
				`usuario_idusuario`
				)
				VALUES (
				NULL , 
				CURRENT_TIMESTAMP ,  'Inserto Receptor numero " . $id . " - nombre " . $nombre . " ',  '" . $_SESSION['id'] . "')";
        $bita = mysql_query($bitacorasql, $this->oracle);


        $res = mysql_query($sql, $this->oracle);

        return $res;
    }

    function listar_vendedors() {

        $sql = 'select * from vendedor';
        $res = mysql_query($sql, $this->oracle);

        if ($res)
            return $res;
        else
            return false;
    }

    function listar_vendedorsconlimite($limite) {

        $sql = 'select * from vendedor order by idvendedor desc ' . $limite;
        $res = mysql_query($sql, $this->oracle);

        if ($res)
            return $res;
        else
            return false;
    }

    function eliminarvendedor($id, $banca) {

        $sql = 'delete from vendedor where idvendedor="' . $id . '" and idbanca = "' . $banca . '"';
        $res = mysql_query($sql, $this->oracle);

        $bitacorasql = "INSERT INTO  `bitacora` (
				`idbitacora` ,
				`fecha` ,
				`accion` ,
				`usuario_idusuario`
				)
				VALUES (
				NULL , 
				CURRENT_TIMESTAMP ,  'Elimino Receptor id " . $id . "  ',  '" . $_SESSION['id'] . "')";
        $bita = mysql_query($bitacorasql, $this->oracle);
        if ($res)
            return $res;
        else
            return false;
    }

    function consultarvendedor($id,$idbanca) {

        $sql = 'select vendedor.nombre as nombreven,
                        banca.nombre as nombreban,
                        banca.idbanca, vendedor.idvendedor
                from vendedor,banca 
                where idvendedor="' . $id . '" 
                and banca.idbanca = vendedor.idbanca 
                and vendedor.idbanca = "'.$idbanca.'"
                limit 1';
        $res = mysql_query($sql, $this->oracle);

        if ($res)
            return $res;
        else
            return false;
    }

    function guardarvendedor($nombre, $id, $idbanca) {

        $sql = 'UPDATE vendedor SET 
	nombre =  "' . $nombre . '"
	
	WHERE  vendedor.idvendedor ="' . $id . '" and idbanca = "' . $idbanca . '"';

        $bitacorasql = "INSERT INTO  `bitacora` (
				`idbitacora` ,
				`fecha` ,
				`accion` ,
				`usuario_idusuario`
				)
				VALUES (
				NULL , 
				CURRENT_TIMESTAMP ,  'Actualizo Receptor " . $id . " nombre " . mysql_real_escape_string($nombre) . " ',  '" . $_SESSION['id'] . "')";
        $bita = mysql_query($bitacorasql, $this->oracle);

        $res = mysql_query($sql, $this->oracle);

        if ($res)
            return $res;
        else
            return false;
    }

}

?>
