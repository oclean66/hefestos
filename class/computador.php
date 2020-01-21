<?php 

class computador {

    var $oracle;

    function computador($link) {
        $this->oracle = $link;
    }

    function consultargrupocomputador($id) {

        $sql = 'select *  from computador, grupo where computador_idcomputador=idcomputador and idcomputador="' . $id . '"';

        $res = mysql_query($sql, $this->oracle);

        if ($res)
            return $res;
        else
            return false;
    }

    function consultarcomputadornombre($id) {

        $sql = 'select concat(idcomputador," - ",nombre)  from computador where idcomputador="' . $id . '"';

        $res = mysql_query($sql, $this->oracle);

        if ($res)
            return $res;
        else
            return false;
    }

    function insertar_computador($id, $nombre) {
        $sql = "INSERT INTO  `computador` (`idcomputador`, `nombre`) VALUES ('" . $id . "', '" . $nombre . "');";



        $bitacorasql = "INSERT INTO  `bitacora` (
				`idbitacora` ,
				`fecha` ,
				`accion` ,
				`usuario_idusuario`
				)
				VALUES (
				NULL , 
				CURRENT_TIMESTAMP ,  'Inserto Asignacion numero " . $id . " - nombre " . $nombre . " ',  '" . $_SESSION['id'] . "')";
        $bita = mysql_query($bitacorasql, $this->oracle);


        $res = mysql_query($sql, $this->oracle);
        return $res;
    }

    function listar_computadors() {

        $sql = 'select * from computador';
        $res = mysql_query($sql, $this->oracle);

        if ($res)
            return $res;
        else
            return false;
    }

    function listar_computadorsconlimite($limite) {

        $sql = 'select * from computador order by idcomputador desc ' . $limite;
        $res = mysql_query($sql, $this->oracle);

        if ($res)
            return $res;
        else
            return false;
    }
//------------------------Eliminar------------------------------------------
    function eliminarcomputador($id) {

        $sql = 'delete from computador where idcomputador="' . $id . '"';
       
        $res = mysql_query($sql, $this->oracle);

        $bitacorasql = "INSERT INTO  `bitacora` (
				`idbitacora` ,
				`fecha` ,
				`accion` ,
				`usuario_idusuario`
				)
				VALUES (
				NULL , 
				CURRENT_TIMESTAMP ,  'Recibio computador id " . $id . "  ',  '" . $_SESSION['id'] . "')";
        $bita = mysql_query($bitacorasql, $this->oracle);

         $sql = 'update reciboscomputador set idusuariorecibo = "'.$_SESSION['id'].'" where idcomputador= "' . $id . '"';
       
        $ress = mysql_query($sql, $this->oracle);


        if ($res)
            return $res;
        else
            return false;
    }

//-----------------------------------Consultar-Ticket-----------------------------------------
    function consultarTicket($id) {

        $sql = 'Select iditem, tipo,nombremodel,agencia.nombre as agenombre,
agencia.idagencia as idage, grupo.nombre as grnombre, grupo.idgrupo as idgr, vendedor.idvendedor as idven,vendedor.nombre as vennombre, banca.idbanca as idban,banca.nombre as bannombre,
cedula, responsable, direccion, agencia.telefono,precio,fechaprestamo
 from 
computador,item,tipoitem,modelo, agencia, grupo,vendedor,banca 
where idtransaccion = "'.$id.'"
and iditem = serialitem
and computador.idagencia = agencia.idagencia
and computador.idgrupo = grupo.idgrupo
and computador.idvendedor = vendedor.idvendedor
and computador.idbanca = banca.idbanca
and agencia.idgrupo = grupo.idgrupo
and agencia.idvendedor = vendedor.idvendedor
and agencia.idbanca = banca.idbanca
and grupo.idvendedor = vendedor.idvendedor
and grupo.idbanca = banca.idbanca
and vendedor.idbanca = banca.idbanca
and item.idtipoitem = tipoitem.idtipoitem
and modelo_idmodelo = modelo.idmodelo
and item.precio !="1"';

        $res = mysql_query($sql, $this->oracle);

        if ($res)
            return $res;
        else
            return false;
    }
    //---------------------------------------------------------------------------
    function consultarcomputador($id) {

        $sql = 'select * from computador where idcomputador="' . $id . '" limit 1';
        $res = mysql_query($sql, $this->oracle);

        if ($res)
            return $res;
        else
            return false;
    }

    function guardarcomputador($nombre, $id) {

        $sql = 'UPDATE computador SET 
	nombre =  "' . $nombre . '"
	
	WHERE  computador.idcomputador ="' . $id . '"';

        $bitacorasql = "INSERT INTO  `bitacora` (
				`idbitacora` ,
				`fecha` ,
				`accion` ,
				`usuario_idusuario`
				)
				VALUES (
				NULL , 
				CURRENT_TIMESTAMP ,  'Actualizo computador " . $id . " nombre " . mysql_real_escape_string($nombre) . " ',  '" . $_SESSION['id'] . "')";
        $bita = mysql_query($bitacorasql, $this->oracle);

        $res = mysql_query($sql, $this->oracle);

        if ($res)
            return $res;
        else
            return false;
    }

//--------------Consultar-computadors-Todo-------------------------------------

 function todo() {

 echo '<div id="main" style="text-align: left;
    background-color: rgba(255, 255, 255, 0.66);
    padding: 13px;
    margin-left: 13px;
    margin-top: 20px;
    width: 311px;
    height: 85%;
    overflow-y: auto;">
        <ul id="browser" class="filetree treeview-famfamfam">';

        $sql = 'select * from computador';
        $res = mysql_query($sql, $this->oracle);
        while ($fila = mysql_fetch_array($res)) {
            echo '<li><span class="computador">'.$fila['nombre'].'</span>';
            $sqlv = 'select * from vendedor where idcomputador="'.$fila['idcomputador'].'"';
            $resv = mysql_query($sqlv, $this->oracle);
            echo '<ul>'; 
            while ($filav = mysql_fetch_array($resv)) {
                echo'<li class="closed"><span class="receptor">'.$filav['nombre'].'</span>';
                $sqlg = 'select * from grupo where idvendedor="'.$filav['idvendedor'].'" and idcomputador="'.$fila['idcomputador'].'"';
                $resg = mysql_query($sqlg, $this->oracle);
                echo "<ul>";
                while ($filag = mysql_fetch_array($resg)) {
                    echo '<li class="closed"><span class="group"><a href="javascript:Carga(\'pdf/lista.php\', \'car\');" title="Cargar contenido">'.$filag['nombre'].'</a></span>';
                    $sqla = 'select * from agencia where idgrupo="'.$filag['idgrupo'].'" and idvendedor="'.$filav['idvendedor'].'" and idcomputador="'.$fila['idcomputador'].'"';
                    $resa = mysql_query($sqla, $this->oracle);
                    echo ' <ul id="folder21">';
                    while ($filaa = mysql_fetch_array($resa)) {
                        echo '<li class="closed"><span class="agencia"><a href="javascript:Carga(\'asignar.html\', \'car\');" title="Cargar contenido">'.$filaa['nombre'].'</a></span></li>';
                    }
                    echo '</ul>'; 
                    echo '</li>'; 
                }
                 echo '</ul>'; 
                 echo '</li>'; 
            }
             echo '</ul>'; 
             echo '</li>'; 
        }
        echo '</ul>
            
</div>';

       
      /* echo '
        <li><span class="computador">Folder 1</span>
            <ul>
                <li class="closed"><span class="receptor">Folder 2</span>
                    <ul>
                        <li class="closed"><span class="group">Subfolder 2.1</span>
                            <ul id="folder21">
                                <li class="closed"><span class="agencia">File 2.1.1</span></li>
                                <li class="closed"><span class="agencia">File 2.1.2</span></li>
                            </ul>
                        </li>
                        <li class="closed"><span class="group">Subfolder 2.2</span>
                            <ul>
                                <li class="closed"><span class="agencia">File 2.2.1</span></li>
                                <li class="closed"><span class="agencia">File 2.2.2</span></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="closed"><span class="group">Folder 3 (closed at start)</span>
                    <ul>
                        <li><span class="agencia">File 3.1</span></li>
                    </ul>
                </li>
                <li><span class="agencia">File 4</span></li>
            </ul>
        </li>
    </ul>
            
</div>';*/


    }
//------------
}

?>
