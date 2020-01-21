<?php 
define('INCLUDE_CHECK', true);
include 'class/formato.php';

include 'class/conexion.php';
include 'class/banca.php';
include 'class/vendedor.php';

$link = Conectar();
$banca = new banca($link);
$lista = $banca->listar_bancas();

$vendedor = new vendedor($link);


//----------------------Inserta-Vendedor------------------------------------//

if (isset($_POST['submit']) and $_POST['vendedor_codigo'] != '' and $_POST['vendedor_nombre'] != '' and $_POST['idbanca'] != '0') {

    $resul = $vendedor->insertar_vendedor( trim($_POST['vendedor_codigo']), $_POST['vendedor_nombre'],$_POST['idbanca']);
}
//-----------------------------------------------------------------------//




echo head();

if (isset($resul)) {
    if ($resul == 1) {

        echo '<script language="JavaScript" type="text/javascript">
				alert(\'Guardado con exito!\');
				document.location="vendedor.php";
			</script>';
    } else {

        echo '<script language="JavaScript" type="text/javascript">
				alert("' . mysql_errno($link) . ": " . mysql_error($link) . '");
				
			</script>';
    }
}
?>

<body><?php  echo menu(); ?>
    <div id='fondo'>
        <div id='wrap'>
            <div id="content">

                <h1>Agregar Nuevo Receptor</h1>

                <div class="form">

                    <form id="banca-form" method="post">
                        <p class="note">Campos con <span class="required">*</span> son obligatorios.</p>


                        <div class="row">
                            <label for="vendedor_codigo" class="required">Codigo <span class="required">*</span></label>		
                            <input size="45" maxlength="45" name="vendedor_codigo" id="banca_codigo" type="text"></div>

                        <div class="row">
                            <label for="vendedor_nombre" class="required">Nombre <span class="required">*</span></label>		
                            <input size="45" maxlength="45" name="vendedor_nombre" id="banca_nombre" type="text"></div>

                        <div class="row">
                            <label for="vendedor_codigo" class="required">Codigo Banca<span class="required">*</span></label>
                            <select style=" width:150px" name="idbanca">
                            <option name="sel" id="sel" value="0">Seleccione</option>        
                            <?php 
                            
                            while ($fila = mysql_fetch_array($lista)) {
                             ?>
                            <option value="<?php  echo $fila['idbanca']; ?>"><?php  echo $fila['idbanca'] . ' - ' . $fila['nombre']; ?></option><?php 
                                }
                            ?> 
                        </select> </div>



                        <div class="row buttons">
                            <input type="submit" name="submit" value="Agregar">	</div>

                    </form>
                </div><!-- form -->	</div>

            <div id="sidebar">
                <div class="portlet" id="yw2">
                    <div class="portlet-decoration">
                        <div class="portlet-title">Operaciones</div>
                    </div>
                    <div class="portlet-content">
                        <ul class="operations" id="yw3">
                            <li><a href="vendedor.php">Listar Receptores</a></li>
                        </ul></div>
                </div>	</div>



        </div>
    </div>


<?php 
@mysql_free_result($lista);
@mysql_close($vendedor); 
@mysql_close($banca); 
?>
</body>
</html>