<?php 

class banca {

    var $oracle;

    function banca($link) {
        $this->oracle = $link;
    }

    function consultargrupobanca($id) {

        $sql = 'select *  from banca, grupo where banca_idbanca=idbanca and idbanca="' . $id . '"';

        $res = mysql_query($sql, $this->oracle);

        if ($res)
            return $res;
        else
            return false;
    }

    function consultarbancanombre($id) {

        $sql = 'select concat(idbanca," - ",nombre)  from banca where idbanca="' . $id . '"';

        $res = mysql_query($sql, $this->oracle);

        if ($res)
            return $res;
        else
            return false;
    }
//---------------------------------
    function insertar_banca($id, $nombre) {
       
        $sql = "INSERT INTO  `banca` (`idbanca`, `nombre`) VALUES 
        ('" .strtoupper(str_replace(' ', '', $id)). "', '" . strtoupper($nombre) . "');";



        $bitacorasql = "INSERT INTO  `bitacora` (
				`idbitacora` ,
				`fecha` ,
				`accion` ,
				`usuario_idusuario`
				)
				VALUES (
				NULL , 
				CURRENT_TIMESTAMP ,  'Inserto banca numero " . $id . " - nombre " . $nombre . " ',  '" . $_SESSION['id'] . "')";
        $bita = mysql_query($bitacorasql, $this->oracle);


        $res = mysql_query($sql, $this->oracle);
        return $res;
    }

    function listar_bancas() {

        $sql = 'select * from banca';
        $res = mysql_query($sql, $this->oracle);

        if ($res)
            return $res;
        else
            return false;
    }

    function listar_bancasconlimite($limite) {

        $sql = 'select * from banca order by idbanca desc ' . $limite;
        $res = mysql_query($sql, $this->oracle);

        if ($res)
            return $res;
        else
            return false;
    }

    function eliminarbanca($id) {

        $sql = 'delete from banca where idbanca="' . $id . '"';
        $res = mysql_query($sql, $this->oracle);

        $bitacorasql = "INSERT INTO  `bitacora` (
				`idbitacora` ,
				`fecha` ,
				`accion` ,
				`usuario_idusuario`
				)
				VALUES (
				NULL , 
				CURRENT_TIMESTAMP ,  'Elimino banca id " . $id . "  ',  '" . $_SESSION['id'] . "')";
        $bita = mysql_query($bitacorasql, $this->oracle);
        if ($res)
            return $res;
        else
            return false;
    }

    function consultarbanca($id) {

        $sql = 'select * from banca where idbanca="' . $id . '" limit 1';
        $res = mysql_query($sql, $this->oracle);

        if ($res)
            return $res;
        else
            return false;
    }

    function guardarbanca($nombre, $id) {

        $sql = 'UPDATE banca SET 
	nombre =  "' . $nombre . '"
	
	WHERE  banca.idbanca ="' . $id . '"';

        $bitacorasql = "INSERT INTO  `bitacora` (
				`idbitacora` ,
				`fecha` ,
				`accion` ,
				`usuario_idusuario`
				)
				VALUES (
				NULL , 
				CURRENT_TIMESTAMP ,  'Actualizo banca " . $id . " nombre " . mysql_real_escape_string($nombre) . " ',  '" . $_SESSION['id'] . "')";
        $bita = mysql_query($bitacorasql, $this->oracle);

        $res = mysql_query($sql, $this->oracle);

        if ($res)
            return $res;
        else
            return false;
    }

//--------------Consultar-Bancas-Todo-------------------------------------

 function todo() {

 echo '<div id="main" style="text-align: left;
    background-color: rgba(255, 255, 255, 0.66);
    padding: 13px;
    font-size: 9px;
    margin-left: 13px;
    margin-top: 20px;
    width: 270px;
    height: 85%;
    overflow-y: auto;">
        <ul id="browser" class="filetree treeview-famfamfam">';

        $sql = 'select * from banca order by idbanca';
        $res = mysql_query($sql, $this->oracle);
        while ($fila = mysql_fetch_array($res)) {
            echo '<li><span class="banca"><a href="#" style="text-decoration: none;">'.$fila['idbanca'].' | '.$fila['nombre'].'</a></span>';
            $sqlv = 'select * from vendedor where idbanca="'.$fila['idbanca'].'" order by idvendedor';
            $resv = mysql_query($sqlv, $this->oracle);
            echo '<ul>'; 
            while ($filav = mysql_fetch_array($resv)) {
                echo'<li class="closed"><span class="receptor"><a href="#" title="Cargar contenido" style="
    text-decoration: none;
">'.$filav['idvendedor'].' | '.$filav['nombre'].'</a></span>';
                $sqlg = 'select * from grupo where idvendedor="'.$filav['idvendedor'].'" and idbanca="'.$fila['idbanca'].'" order by idgrupo';
                $resg = mysql_query($sqlg, $this->oracle);
                echo "<ul>";
                while ($filag = mysql_fetch_array($resg)) {
                    echo '<li class="closed"><span class="group"><a href="javascript:Carga(\'computadordetalle.php?gr='.$filag['idgrupo'].'&ven='.$filav['idvendedor'].'&ban='.$fila['idbanca'].'\', \'car\');" title="Cargar contenido"  style="
    text-decoration: none;
">'.$filag['idgrupo'].' | '.$filag['nombre'].'</a></span>';
                    $sqla = 'select * from agencia where idgrupo="'.$filag['idgrupo'].'" and idvendedor="'.$filav['idvendedor'].'" and idbanca="'.$fila['idbanca'].'" order by idagencia';
                    $resa = mysql_query($sqla, $this->oracle);
                    echo ' <ul id="folder21">';
                    while ($filaa = mysql_fetch_array($resa)) {
                        $styles='';
                        if($filaa['Estado']=='0'){
                            $styles = "color: black;font-style: italic;";
                        }
                        echo '<li class="closed"><span class="agencia"><a href="javascript:Carga(\'computadordetalle.php?age='.$filaa['idagencia'].'&gr='.$filag['idgrupo'].'&ven='.$filav['idvendedor'].'&ban='.$fila['idbanca'].'\', \'car\');" title="Cargar contenido" style="
    text-decoration: none;'.$styles.'
">'.$filaa['idagencia'].' - '.$filaa['nombre'].'</a></span></li>';
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
        <li><span class="banca">Folder 1</span>
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
