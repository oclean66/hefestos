<?php 

class item {

    var $oracle;

    function item($link) {
        $this->oracle = $link;
    }

    //---------CPU-POR-MODELOS------------------
     function count_cpumodelos() {

        $sql = "(SELECT COUNT( * ) , tipo, nombremodel, 'En Almacen 1', item.modelo_idmodelo
FROM item, tipoitem, modelo
WHERE item.modelo_idmodelo = modelo.idmodelo
AND item.idtipoitem = tipoitem.idtipoitem
AND (item.idestado = 1 )
AND modelo.idtipoitem = tipoitem.idtipoitem
GROUP BY modelo.idmodelo)
union
 (SELECT COUNT( * ) , tipo, nombremodel, 'En Almacen 2', item.modelo_idmodelo
FROM item, tipoitem, modelo
WHERE item.modelo_idmodelo = modelo.idmodelo
AND item.idtipoitem = tipoitem.idtipoitem
AND item.idestado = 2
AND modelo.idtipoitem = tipoitem.idtipoitem
GROUP BY modelo.idmodelo) 
union
 ((SELECT COUNT( * ) , tipo, nombremodel, 'En Garantia', item.modelo_idmodelo
FROM item, tipoitem, modelo
WHERE item.modelo_idmodelo = modelo.idmodelo
AND item.idtipoitem = tipoitem.idtipoitem
AND (item.idestado = 3 )
AND modelo.idtipoitem = tipoitem.idtipoitem
GROUP BY modelo.idmodelo))
union
 ((SELECT COUNT( * ) , tipo, nombremodel, 'En Reparacion', item.modelo_idmodelo
FROM item, tipoitem, modelo
WHERE item.modelo_idmodelo = modelo.idmodelo
AND item.idtipoitem = tipoitem.idtipoitem
AND (item.idestado = 4 )
AND modelo.idtipoitem = tipoitem.idtipoitem
GROUP BY modelo.idmodelo))
union
 ((SELECT COUNT( * ) , tipo, nombremodel, 'Prestados', item.modelo_idmodelo
FROM item, tipoitem, modelo
WHERE item.modelo_idmodelo = modelo.idmodelo
AND item.idtipoitem = tipoitem.idtipoitem
AND (item.idestado = 5 )
AND modelo.idtipoitem = tipoitem.idtipoitem
GROUP BY modelo.idmodelo))
union
 ((SELECT COUNT( * ) , tipo, nombremodel, 'De Baja', item.modelo_idmodelo
FROM item, tipoitem, modelo
WHERE item.modelo_idmodelo = modelo.idmodelo
AND item.idtipoitem = tipoitem.idtipoitem
AND (item.idestado = 6 )
AND modelo.idtipoitem = tipoitem.idtipoitem
GROUP BY modelo.idmodelo))

ORDER BY `modelo_idmodelo` ASC";
        $res = mysql_query($sql, $this->oracle);

        if ($res)
            return $res;
        else
            return false;
    }

   //---------CPU-POR-TIPO----------------------
     function count() {

        $sql = "(SELECT COUNT( * ) , tipo, 'En Almacen 1'
FROM item, tipoitem
WHERE item.idtipoitem = tipoitem.idtipoitem
AND (item.idestado = 1 )
GROUP BY tipoitem.idtipoitem)
union
 (SELECT COUNT( * ) , tipo, 'En Almacen 2'
FROM item, tipoitem
WHERE item.idtipoitem = tipoitem.idtipoitem
AND (item.idestado = 2 )
GROUP BY tipoitem.idtipoitem) 
union
 (SELECT COUNT( * ) , tipo, 'En Garantia'
FROM item, tipoitem
WHERE item.idtipoitem = tipoitem.idtipoitem
AND (item.idestado = 3 )
GROUP BY tipoitem.idtipoitem)
union
 (SELECT COUNT( * ) , tipo, 'En Reparacion'
FROM item, tipoitem
WHERE item.idtipoitem = tipoitem.idtipoitem
AND (item.idestado = 4 )
GROUP BY tipoitem.idtipoitem)
union
 (SELECT COUNT( * ) , tipo, 'Prestados'
FROM item, tipoitem
WHERE item.idtipoitem = tipoitem.idtipoitem
AND (item.idestado = 5 )
GROUP BY tipoitem.idtipoitem)
ORDER BY `tipo` ASC";
        $res = mysql_query($sql, $this->oracle);

        if ($res)
            return $res;
        else
            return false;
    }

//----------------------------------------------------------------------------
    function insertar_item($id, $nombre) {
        $sql = "INSERT INTO  `item` (`serialitem`, `nombre`) VALUES ('" . $id . "', '" . $nombre . "');";



        $bitacorasql = "INSERT INTO  `bitacora` (
				`idbitacora` ,
				`fecha` ,
				`accion` ,
				`usuario_idusuario`
				)
				VALUES (
				NULL , 
				CURRENT_TIMESTAMP ,  'Inserto item numero " . $id . " - nombre " . $nombre . " ',  '" . $_SESSION['id'] . "')";
        $bita = mysql_query($bitacorasql, $this->oracle);


        $res = mysql_query($sql, $this->oracle);
        return $res;
    }

    function listar_items() {

        $sql = 'select * from item';
        $res = mysql_query($sql, $this->oracle);

        if ($res)
            return $res;
        else
            return false;
    }

    function listar_itemsconlimite($limite) {

        $sql = 'select * from item order by serialitem desc ' . $limite;
        $res = mysql_query($sql, $this->oracle);

        if ($res)
            return $res;
        else
            return false;
    }
//---------------------Eliminar-item----------------------------------
    function eliminaritem($id,$razon) {

       $sql = "DELETE from  item 
        WHERE  serialitem =  '".$id."'";
        $res = mysql_query($sql, $this->oracle);

        $sql = "UPDATE item_baja 
        set justificacion = '".$razon."'
        WHERE  serialitem =  '".$id."'";
        $res = mysql_query($sql, $this->oracle);
        

        $bitacorasql = "INSERT INTO  `bitacora` (
                `idbitacora` ,
                `fecha` ,
                `accion` ,
                `usuario_idusuario`
                )
                VALUES (
                NULL , 
                CURRENT_TIMESTAMP ,  'Dio de Baja al Equipo " . $id . " razon " . mysql_real_escape_string($razon) . " ',  '" . $_SESSION['id'] . "')";
        $bita = mysql_query($bitacorasql, $this->oracle);

       

        if ($res)
            return $res;
        else
            return false;
    }
//----------------------Consultar------------------------------------------
    function consultaritem($id) {

        $sql = 'select * from item, modelo, tipoitem
         where serialitem="' . $id . '" 
         and item.idtipoitem = tipoitem.idtipoitem 
         and item.modelo_idmodelo = modelo.idmodelo
          limit 1';
        $res = mysql_query($sql, $this->oracle);

        if ($res)
            return $res;
        else
            return false;
    }
    //----------------------Consultar-Completo-----------------------------------------
    function consultaritemcompleto($id) {

        $sql = 'SELECT var.idbanca, var.idgrupo, var.idvendedor, fechagregado, 
  idcomputador, var.serialitem, var.idagencia,status,
  var.idestado,tipo, nombremodel, tipoitem.idtipoitem
  from (SELECT idcomputador, item.serialitem,
    fechagregado,idestado,
    item.modelo_idmodelo, computador.idagencia, computador.idvendedor, 
    computador.idgrupo, computador.idbanca
    from item
    left join computador on item.serialitem=computador.iditem) as var,  
modelo, tipoitem, estado
where serialitem = "'.$id.'"
and var.idestado = estado.idestado
and var.modelo_idmodelo = modelo.idmodelo
and modelo.idtipoitem = tipoitem.idtipoitem';
        $res = mysql_query($sql, $this->oracle);

        if ($res)
            return $res;
        else
            return false;
    }
//------------------------Guardar-Item----------------------------------
    function guardaritem($idn,$tipo,$model, $id) {

        $sql = "UPDATE  `item` 
        SET  
         `item`.`serialitem` =  '".$idn."',
        `idtipoitem` =  '".$tipo."',
        `modelo_idmodelo` =  '".$model."' 
        WHERE  
        `item`.`serialitem` =  '".$id."'";

        $bitacorasql = "INSERT INTO  `bitacora` (
                `idbitacora` ,
                `fecha` ,
                `accion` ,
                `usuario_idusuario`
                )
                VALUES (
                NULL , 
                CURRENT_TIMESTAMP ,  'Actualizo Equipo " . $id . " Tipo  '".$tipo."'". mysql_real_escape_string($tipo) . " ',  '" . $_SESSION['id'] . "')";
        $bita = mysql_query($bitacorasql, $this->oracle);

        $res = mysql_query($sql, $this->oracle);

        if ($res)
            return $res;
        else
            return false;
    }

    //------------------------Mover-Item----------------------------------
    function moveritem($id,$lugar) {

        $sql = "UPDATE  item 
        SET  idestado =  '".$lugar."' 
        WHERE  serialitem =  '".$id."'";


        $bitacorasql = "INSERT INTO  `bitacora` (
                `idbitacora` ,
                `fecha` ,
                `accion` ,
                `usuario_idusuario`
                )
                VALUES (
                NULL , 
                CURRENT_TIMESTAMP ,  'Movio Equipo " . $id . " Tipo   ".$lugar." ". mysql_real_escape_string($tipo) . " ',  '" . $_SESSION['id'] . "')";
        $bita = mysql_query($bitacorasql, $this->oracle);

        $res = mysql_query($sql, $this->oracle);

        if ($res)
            return $res;
        else
            return false;
    }

}

?>
