<?php 
define('INCLUDE_CHECK', true);
include 'class/formato.php';

include 'class/conexion.php';
include 'class/item.php';
include 'class/tipoitem.php';
include 'class/modelo.php';

$link = Conectar();
$item = new item($link);
$tipoitem = new tipoitem($link);
$tipositem = $tipoitem->listar_tipoitems();

$modelo = new modelo($link);


//----------------------Consulta-item------------------------------------//

if (isset($_GET['it'])) {

    $resulreg = $item->consultaritem($_GET['it']);
    $fila = mysql_fetch_array($resulreg);

}elseif (isset($_GET['itb'])) {

    $resulreg = $item->consultaritem($_GET['itb']);
    $fila = mysql_fetch_array($resulreg);
}
//----------------------Guardar-item------------------------------------//

if (isset($_POST['submit']) and $_POST['tipoitem'] != '0' and $_POST['modelo'] != '0') {

    if (isset($_GET['it']))
        $resul = $item->guardaritem($_POST['item_codigo'],$_POST['tipoitem'],$_POST['modelo'], $_GET['it']);
    else if (isset($_GET['itb']))
        $resul = $item->guardaritem($_POST['item_codigo'],$_POST['tipoitem'],$_POST['modelo'], $_GET['itb']);
  
    if ($resul == 1 && isset($_GET['it']) ) {
        echo '<script type="text/javascript">
        window.location="./item.php?edit=1";
        </script>';
    }else if($resul == 1 && isset($_GET['itb']) ){
         echo '<script type="text/javascript">
        window.location="./bitem.php?id='.$_POST['item_codigo'].'&edit=1";
        </script>';

    } else if ($resul == 0 && isset($_GET['it']) ) {
        echo '<script type="text/javascript">
        window.location="./item.php?edit=0";
        </script>';
    }
    else if($resul == 0 && isset($_GET['itb']) ){
         echo '<script type="text/javascript">
        window.location="./bitem.php?id='.$_GET['itb'].'&edit=0";
        </script>';

    }
}
//-----------------------------------------------------------------------//

@mysql_free_result($resul);
@mysql_close($vendedor);


echo head();
?>

<body><?php  echo menu(); ?>
    <div id='fondo'>
        <div id='wrap'>
            <div id="content">

                <h1>Edicion de Equipo</h1>

                <div class="form">

                    <form id="item-form" method="post">
                        <p class="note">Campos con <span class="required">*</span> son obligatorios.</p>


                        <div class="row">
                            <label for="item_codigo" class="required">Codigo de Equipo <span class="required">*</span></label>		
                            <input size="45" maxlength="45" name="item_codigo" id="item_codigo"  type="text" value ="<?php  echo $fila['serialitem']; ?>">	</div>

                        <div class="row">
                            <label for="item_nombre" class="required">Tipo de Equipo <span class="required">*</span></label>		
                            <select style=" width:150px" name="tipoitem" id="tipoitem"  onchange ="cargarModeloconexion(this.id)">
                            
                            <option name="sel" id="sel" value="0">Seleccione</option>        
                            <?php  
                            
                            while ($types = mysql_fetch_array($tipositem)) {
                             ?>
                            <option value="<?php  echo $types['idtipoitem'];?>" <?php  if($fila['idtipoitem']==$types['idtipoitem']) echo 'selected = \"selected\"';?>><?php  echo  $types['tipo']; ?></option><?php 
                                }
                            ?> 
                        </select>
 <div class="row">
                            <label for="item_nombre" class="required">Modelo <span class="required">*</span></label> 
                            <?php  $modelos = $modelo->listar_modelos_tipo($fila['idtipoitem']); ?>       
                          <div style="display: initial;">
                          <select style=" width:150px" name="modelo" id="modelo">
                            
                            <option name="sel" id="sel" value="0">Seleccione</option>        
                            <?php  
                            
                            while ($model = mysql_fetch_array($modelos)) {
                             ?>
                            <option value="<?php  echo $model['idmodelo'];?>" <?php  if($fila['idmodelo']==$model['idmodelo']) echo 'selected = \"selected\"';?>><?php  echo  $model['nombremodel']; ?></option><?php 
                                }
                            ?> 
                        </select>
                        </div>

                            <label for="item_codigo" class="required">Fecha de Registro<span class="required">*</span></label>        
                            <input size="45" maxlength="45" name="item_codigo" id="item_codigo" disabled="disabled" type="text" value ="<?php  echo $fila['fechagregado']; ?>">   </div>
                        <div class="row buttons">
                            <input type="submit" name="submit" value="Actualizar">	</div>

                    </form>
                </div><!-- form -->	</div>

            <div id="sidebar">
                <div class="portlet" id="yw2">
                    <div class="portlet-decoration">
                        <div class="portlet-title">Operaciones</div>
                    </div>
                    <div class="portlet-content">
                        <ul class="operations" id="yw3">
                            <li><a href="item.php">Listar Equipos</a></li>
                        </ul></div>
                </div>	</div>



        </div>
    </div>



</body>
</html>