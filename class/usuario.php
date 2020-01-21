<?php 

class usuario {

    var $oracle;

    function usuario($link) {
        $this->oracle = $link;
    }

 //----------------------------------------------------------------   
    function insertar_usuario($nombre, $user,$grupo) {
        $sql = "INSERT INTO  usuario VALUES (NULL, '" . $nombre . "', '81dc9bdb52d04dc20036dbd8313ed055','".$user."','".$grupo."');";



        $bitacorasql = "INSERT INTO  `bitacora` (
            `idbitacora` ,
            `fecha` ,
            `accion` ,
            `usuario_idusuario`
            )
VALUES (
    NULL , 
    CURRENT_TIMESTAMP ,  'Inserto usuario " . $user . " - nombre " . $nombre . " ',  '" . $_SESSION['id'] . "')";
$bita = mysql_query($bitacorasql, $this->oracle);


$res = mysql_query($sql, $this->oracle);
return $res;
}
//----------------------------------------------------------
function listar_usuarios() {

    $sql = 'select * from usuario order by clave';
    $res = mysql_query($sql, $this->oracle);

    if ($res)
        return $res;
    else
        return false;
}


//---------------------------------------------------------------------
function eliminarusuario($id) {

    $sql = 'update usuario set clave="BLOQUEADO" where idusuario="' . $id . '"';
    $res = mysql_query($sql, $this->oracle);

    $bitacorasql = "INSERT INTO  `bitacora` (
        `idbitacora` ,
        `fecha` ,
        `accion` ,
        `usuario_idusuario`
        )
VALUES (
    NULL , 
    CURRENT_TIMESTAMP ,  'Bloqueo usuario id " . $id . "  ',  '" . $_SESSION['id'] . "')";
$bita = mysql_query($bitacorasql, $this->oracle);
if ($res)
    return $res;
else
    return false;
}
//--------------------------------------------------------------------------
function consultarusuario($id) {

    $sql = 'select * from usuario,grupousr where idusuario="' . $id . '" and idgrupousr = grupousr_idgrupousr limit 1';
    $res = mysql_query($sql, $this->oracle);

    if ($res)
        return $res;
    else
        return false;
}
//----------------------------------------------------------
function reiniciar($id) {

    $sql = "UPDATE  usuario SET 
    clave =  '81dc9bdb52d04dc20036dbd8313ed055',
    WHERE  idusuario ='".$id."'";

    $bitacorasql = "INSERT INTO  `bitacora` (
        `idbitacora` ,
        `fecha` ,
        `accion` ,
        `usuario_idusuario`
        )
VALUES (
    NULL , 
    CURRENT_TIMESTAMP ,  'Reinicio usuario " . $id . " nombre " . mysql_real_escape_string($nombre) . " ',  '" . $_SESSION['id'] . "')";
$bita = mysql_query($bitacorasql, $this->oracle);

$res = mysql_query($sql, $this->oracle);

if ($res)
    return $res;
else
    return false;
}
//----
//----------------------------------------------------------
function guardarusuario($nombre, $user,$clave,$id) {

    $sql = "UPDATE  usuario SET 
    clave =  '".$clave."',
    WHERE  idusuario ='".$id."'";

    $bitacorasql = "INSERT INTO  `bitacora` (
        `idbitacora` ,
        `fecha` ,
        `accion` ,
        `usuario_idusuario`
        )
VALUES (
    NULL , 
    CURRENT_TIMESTAMP ,  'Reinicio usuario " . $id . " nombre " . mysql_real_escape_string($nombre) . " ',  '" . $_SESSION['id'] . "')";
$bita = mysql_query($bitacorasql, $this->oracle);

$res = mysql_query($sql, $this->oracle);

if ($res)
    return $res;
else
    return false;
}

//---
}

?>
