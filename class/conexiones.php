<?php 

class conexion {

    var $oracle;

    function conexion($link) {
        $this->oracle = $link;
    }

function count_conexionesmodelos() {

        $sql = "(SELECT COUNT( * ) , conexionnombre, modelo, 'Disponibles', conexion.idmodeloconexion
FROM conexion, tipoconexion, modeloconexion
WHERE conexion.idmodeloconexion = modeloconexion.idmodeloconexion

AND conexion.idestado = 2
AND modeloconexion.idtipoconexion = tipoconexion.idtipoconexion
GROUP BY modeloconexion.idmodeloconexion)
union
 (SELECT COUNT( * ) , conexionnombre, modelo, 'Prestados', conexion.idmodeloconexion
FROM conexion, tipoconexion, modeloconexion
WHERE conexion.idmodeloconexion = modeloconexion.idmodeloconexion

AND conexion.idestado = 5
AND modeloconexion.idtipoconexion = tipoconexion.idtipoconexion
GROUP BY modeloconexion.idmodeloconexion) ORDER BY `idmodeloconexion` ASC";
        $res = mysql_query($sql, $this->oracle);

        if ($res)
            return $res;
        else
            return false;
    }
    //-------------------------------------------------------------

function counter() {

        $sql = "(SELECT COUNT( * ) , conexionnombre,  'Disponibles'
FROM conexion, tipoconexion, modeloconexion
WHERE conexion.idmodeloconexion = modeloconexion.idmodeloconexion
AND conexion.idestado = 2
AND modeloconexion.idtipoconexion = tipoconexion.idtipoconexion
GROUP BY tipoconexion.idtipoconexion)

union

 (SELECT COUNT( * ) , conexionnombre, 'Prestados'
FROM conexion, tipoconexion, modeloconexion
WHERE conexion.idmodeloconexion = modeloconexion.idmodeloconexion
AND conexion.idestado = 5
AND modeloconexion.idtipoconexion = tipoconexion.idtipoconexion
GROUP BY tipoconexion.idtipoconexion) order by conexionnombre";
        $res = mysql_query($sql, $this->oracle);

        if ($res)
            return $res;
        else
            return false;
    }
//-------------------------------------------------------------

function counterop() {

        $sql = "(SELECT COUNT( * ) , conexionnombre, 'Disponibles', operadornombre
FROM conexion, tipoconexion, modeloconexion,operador
WHERE conexion.idmodeloconexion = modeloconexion.idmodeloconexion
and conexion.idoperador = operador.idoperador
AND conexion.idestado = 2
AND modeloconexion.idtipoconexion = tipoconexion.idtipoconexion
GROUP BY conexionnombre, operador.idoperador)

union

 (SELECT COUNT( * ) , conexionnombre, 'Prestados', operadornombre
FROM conexion, tipoconexion, modeloconexion,operador
WHERE conexion.idmodeloconexion = modeloconexion.idmodeloconexion
and conexion.idoperador = operador.idoperador
AND conexion.idestado = 5
AND modeloconexion.idtipoconexion = tipoconexion.idtipoconexion
GROUP BY conexionnombre, operador.idoperador) order by conexionnombre";

        $res = mysql_query($sql, $this->oracle);

        if ($res)
            return $res;
        else
            return false;
    }
    //------------------------------------------------------------

    function consultargrupoconexion($id) {

        $sql = 'select *  from conexion, grupo where conexion_idconexion=idconexion and idconexion="' . $id . '"';

        $res = mysql_query($sql, $this->oracle);

        if ($res)
            return $res;
        else
            return false;
    }

    function consultarconexionnombre($id) {

        $sql = 'select concat(idconexion," - ",nombre)  from conexion where idconexion="' . $id . '"';

        $res = mysql_query($sql, $this->oracle);

        if ($res)
            return $res;
        else
            return false;
    }
//-------------------------INSERTAR CONEXION-------------------------------------
    function insertar_conexion($numero, $imei,$operador,$fechaplan,$clavedatos,$clavemovil,$modelo) {
              
$sql = "INSERT INTO  `conexion` 
VALUES (NULL ,  '".$numero."', '".$imei."' ,  '".$operador."',  '".$fechaplan."', '".$clavedatos."' , '".$clavemovil."' , CURRENT_TIMESTAMP ,  '2',  '".$modelo."')";


        $res = mysql_query($sql, $this->oracle);

        $bitacorasql = "INSERT INTO  `bitacora` (
				`idbitacora` ,
				`fecha` ,
				`accion` ,
				`usuario_idusuario`
				)
				VALUES (
				NULL , 
				CURRENT_TIMESTAMP ,  'Inserto conexion numero  '".$numero."' '".$imei."'   '".$operador."' '".$fechaplan."' '".$clavedatos."'  '".$clavemovil."'  CURRENT_TIMESTAMP   2  '".$modelo."',  '" . $_SESSION['id'] . "')";
        $bita = mysql_query($bitacorasql, $this->oracle);


        
        return $res;
    }
//------------------Listar--------------------------------------------
    function listar_conexiones() {

        $sql = 'select * from conexion';
        $res = mysql_query($sql, $this->oracle);

        if ($res)
            return $res;
        else
            return false;
    }

    function listar_conexionsconlimite($limite) {

        $sql = 'select * from conexion order by idconexion desc ' . $limite;
        $res = mysql_query($sql, $this->oracle);

        if ($res)
            return $res;
        else
            return false;
    }
    //------------------------------Eliminar---------------------------
    function moverconexion($id,$lugar) {

       $sql = 'UPDATE conexion SET 
       idestado =  "'.$lugar.'"
       WHERE  conexion.idconexion ="' . $id . '"';
       
       $res = mysql_query($sql, $this->oracle);

       $bitacorasql = "INSERT INTO  `bitacora` (
        `idbitacora` ,
                `fecha` ,
                `accion` ,
                `usuario_idusuario`
                )
                VALUES (
                NULL , 
                CURRENT_TIMESTAMP ,  'Elimino conexion id " . $id . "  ',  '" . $_SESSION['id'] . "')";
        $bita = mysql_query($bitacorasql, $this->oracle); 

        if ($res)
            return $res;
        else
            return false;

        
    }
//------------------------------Eliminar---------------------------
    function eliminarconexion($id,$razon) {

         $sql = 'DELETE from conexion 
         WHERE  conexion.idconexion ="' . $id . '"';
         
        $res = mysql_query($sql, $this->oracle);

         $sql = "UPDATE conexion_baja 
        set justificacion = '".$razon."'
        WHERE  idconexion =  '".$id."'";
        $res = mysql_query($sql, $this->oracle);

        $bitacorasql = "INSERT INTO  `bitacora` (
				`idbitacora` ,
				`fecha` ,
				`accion` ,
				`usuario_idusuario`
				)
				VALUES (
				NULL , 
				CURRENT_TIMESTAMP ,  'Elimino conexion id " . $id . " razon ".$razon."  ',  '" . $_SESSION['id'] . "')";
        $bita = mysql_query($bitacorasql, $this->oracle);
        if ($res)
            return $res;
        else
            return false;
    }
//-------------------consultar-----------------------------------
    function consultarconexion($id) {

        $sql = 'select * from conexion,modeloconexion
         where idconexion="' . $id . '" 
         and modeloconexion.idmodeloconexion = conexion.idmodeloconexion
         limit 1';
        $res = mysql_query($sql, $this->oracle);

        if ($res)
            return $res;
        else
            return false;
    }
//-------------------consultar-----------------------------------
    function consultarconexionCompleta($id) {

        $res=  mysql_query("SELECT var.idbanca, var.idgrupo, var.idvendedor, fechacompra, 
    fechagregado,idcomputador, var.idconexion, var.idoperador, diacorte,monto, var.idagencia,
    idestado,servicio,IMEI,numero,conexionnombre, operador.operadornombre, clavemovilmensaje,
    clavedatos,modelo, tipoconexion.idtipoconexion 
    from (SELECT idcomputador, conexion.idconexion, conexion.idoperador, 
      fechacompra, clavedatos,clavemovilmensaje,fechagregado,idestado,diacorte,monto,servicio,
      conexion.idmodeloconexion, numero, IMEI, computador.idagencia, computador.idvendedor, 
      computador.idgrupo, computador.idbanca
      from conexion
      left join computador on conexion.idconexion=computador.idconexion) as var, operador, 
  modeloconexion, tipoconexion
  where var.idoperador = operador.idoperador
  and var.idestado != 6
  and var.idconexion = ".$id."
  and var.idmodeloconexion = modeloconexion.idmodeloconexion
  and modeloconexion.idtipoconexion = tipoconexion.idtipoconexion",$this->oracle);
        

        if ($res)
            return $res;
        else
            return false;
    }
//----------------------Guardar-Conexion------------------------
    function guardarconexion($modelo, $operador, $servicio, $fecha, $fechaplan, $numero, $imei, $clavedatos, $clavemovil,$monto,$id) {

        $sql = 'UPDATE conexion SET 
	idmodeloconexion =  "' . $modelo . '",
    idoperador =  "' . $operador . '",
    servicio =  "' . $servicio . '",
    fechacompra =  "' . $fecha . '",
    diacorte =  "' . $fechaplan . '",
    numero =  "' . $numero . '",
    IMEI =  "' . $imei . '",
    clavedatos =  "' . $clavedatos . '",
    clavemovilmensaje =  "' . $clavemovil . '",
    monto =  "' . $monto . '"
	
	WHERE  conexion.idconexion ="' . $id . '"';

echo '<script language="JavaScript" type="text/javascript">
alert('.$sql.')      </script>';

        $bitacorasql = "INSERT INTO  `bitacora` (
				`idbitacora` ,
				`fecha` ,
				`accion` ,
				`usuario_idusuario`
				)
				VALUES (
				NULL , 
				CURRENT_TIMESTAMP ,  ' Actualizo conexion " . $id . " nombre " . mysql_real_escape_string($nombre) . " ',  '" . $_SESSION['id'] . "')";
        $bita = mysql_query($bitacorasql, $this->oracle);

        $res = mysql_query($sql, $this->oracle);

        if ($res)
            return $res;
        else
            return false;
    }

}

?>
