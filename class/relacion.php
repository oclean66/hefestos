<?php 

class relacion {

    var $oracle;

    function relacion($link) {
        $this->oracle = $link;
    }

    function consultargruporelacion($id) {

        $sql = 'select *  from relacion, grupo where relacion_idrelacion=idrelacion and idrelacion="' . $id . '"';

        $res = mysql_query($sql, $this->oracle);

        if ($res)
            return $res;
        else
            return false;
    }

    function consultarrelacionnombre($id) {

        $sql = 'select concat(idrelacion," - ",nombre)  from relacion where idrelacion="' . $id . '"';

        $res = mysql_query($sql, $this->oracle);

        if ($res)
            return $res;
        else
            return false;
    }

    function insertar_relacion($id, $nombre) {
        $sql = "INSERT INTO  `relacion` (`idrelacion`, `nombre`) VALUES ('" . $id . "', '" . $nombre . "');";



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

    function listar_relacions() {

        $sql = 'select * from relacion';
        $res = mysql_query($sql, $this->oracle);

        if ($res)
            return $res;
        else
            return false;
    }

    function listar_relacionsconlimite($limite) {

        $sql = 'select * from relacion order by idrelacion desc ' . $limite;
        $res = mysql_query($sql, $this->oracle);

        if ($res)
            return $res;
        else
            return false;
    }
//------------------------Eliminar------------------------------------------
    function eliminarrelacion($id) {

        $sql = 'delete from relacion where idrelacion="' . $id . '"';
       
        $res = mysql_query($sql, $this->oracle);

        $bitacorasql = "INSERT INTO  `bitacora` (
				`idbitacora` ,
				`fecha` ,
				`accion` ,
				`usuario_idusuario`
				)
				VALUES (
				NULL , 
				CURRENT_TIMESTAMP ,  'Recibio relacion id " . $id . "  ',  '" . $_SESSION['id'] . "')";
        $bita = mysql_query($bitacorasql, $this->oracle);
        if ($res)
            return $res;
        else
            return false;
    }

//-----------------------------------------------------------------------------
    function consultarrelacion($id) {

        $sql = 'select * from relacion where idrelacion="' . $id . '" limit 1';
        $res = mysql_query($sql, $this->oracle);

        if ($res)
            return $res;
        else
            return false;
    }

    function guardarrelacion($nombre, $id) {

        $sql = 'UPDATE relacion SET 
	nombre =  "' . $nombre . '"
	
	WHERE  relacion.idrelacion ="' . $id . '"';

        $bitacorasql = "INSERT INTO  `bitacora` (
				`idbitacora` ,
				`fecha` ,
				`accion` ,
				`usuario_idusuario`
				)
				VALUES (
				NULL , 
				CURRENT_TIMESTAMP ,  'Actualizo relacion " . $id . " nombre " . mysql_real_escape_string($nombre) . " ',  '" . $_SESSION['id'] . "')";
        $bita = mysql_query($bitacorasql, $this->oracle);

        $res = mysql_query($sql, $this->oracle);

        if ($res)
            return $res;
        else
            return false;
    }

//--------------Consultar-relacions-Todo-------------------------------------

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

        $sql = 'select * from relacion';
        $res = mysql_query($sql, $this->oracle);
        while ($fila = mysql_fetch_array($res)) {
            echo '<li><span class="relacion">'.$fila['nombre'].'</span>';
            $sqlv = 'select * from vendedor where idrelacion="'.$fila['idrelacion'].'"';
            $resv = mysql_query($sqlv, $this->oracle);
            echo '<ul>'; 
            while ($filav = mysql_fetch_array($resv)) {
                echo'<li class="closed"><span class="receptor">'.$filav['nombre'].'</span>';
                $sqlg = 'select * from grupo where idvendedor="'.$filav['idvendedor'].'" and idrelacion="'.$fila['idrelacion'].'"';
                $resg = mysql_query($sqlg, $this->oracle);
                echo "<ul>";
                while ($filag = mysql_fetch_array($resg)) {
                    echo '<li class="closed"><span class="group"><a href="javascript:Carga(\'pdf/lista.php\', \'car\');" title="Cargar contenido">'.$filag['nombre'].'</a></span>';
                    $sqla = 'select * from agencia where idgrupo="'.$filag['idgrupo'].'" and idvendedor="'.$filav['idvendedor'].'" and idrelacion="'.$fila['idrelacion'].'"';
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
        <li><span class="relacion">Folder 1</span>
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
