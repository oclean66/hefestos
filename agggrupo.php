<?php  
define('INCLUDE_CHECK', true);
include 'class/formato.php';

include 'class/conexion.php';
include 'class/banca.php';
include 'class/grupo.php';

$link = Conectar();
$banca = new banca($link);
$lista = $banca->listar_bancas();

$grupo = new grupo($link);


//----------------------Inserta-grupo------------------------------------//

if (isset($_POST['submit']) and $_POST['grupo_codigo'] != '' and $_POST['grupo_nombre'] != '' and $_POST['banca'] != '0' and $_POST['vendedor'] != '0') {

    $resul = $grupo->insertar_grupo( trim($_POST['grupo_codigo']), $_POST['grupo_nombre'],$_POST['vendedor'],$_POST['banca']);
}
//-----------------------------------------------------------------------//




echo head();

if (isset($resul)) {
    if ($resul == 1) {

        echo '<script language="JavaScript" type="text/javascript">
				alert(\'Guardado con exito!\');
				document.location="grupo.php";
			</script>';
    } else {

        echo '<script language="JavaScript" type="text/javascript">
				alert("' . mysql_errno($link) . ": " . mysql_error($link) . '");
				
			</script>';
    }
}
?>

<body><?php  echo menu(); ?>
    <script type="text/javascript" src="selectbvga.js"></script>
    <div id='fondo'>
        <div id='wrap'>
            <div id="content">

                <h1>Agregar Nuevo Grupo</h1>

                <div class="form">

                    <form id="banca-form" method="post">
                        <p class="note">Campos con <span class="required">*</span> son obligatorios.</p>


                        <div class="row">
                            <label for="grupo_codigo" class="required">Codigo <span class="required">*</span></label>		
                            <input size="45" maxlength="45" name="grupo_codigo" id="banca_codigo" type="text"></div>

                        <div class="row">
                            <label for="grupo_nombre" class="required">Nombre <span class="required">*</span></label>		
                            <input size="45" maxlength="45" name="grupo_nombre" id="banca_nombre" type="text"></div>

                        <div class="row">
                            <label for="grupo_codigo" class="required">&nbsp;Codigo Banca <span class="required" >*</span></label>

                            <select style=" width:150px" name="banca" id="banca" onChange='cargarVendedor(this.id)'>
                            <option name="sel" id="sel" value="0">Seleccione</option>        
                            <?php 
                            
                            while ($fila = mysql_fetch_array($lista)) {
                             ?>
                            <option value="<?php  echo $fila['idbanca']; ?>"><?php  echo $fila['idbanca'] . ' - ' . $fila['nombre']; ?></option><?php 
                                }
                            ?> 
                        </select> </div>

                        <div class="row">
                            <label for="grupo_codigo" class="required">&nbsp;&nbsp;Codigo Receptor <span class="required">*</span></label>
                            <select disabled="disabled" style=" width:150px" name="vendedor" id="vendedor">
                            <option value="0">Elige</option>
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
                            <li><a href="grupo.php">Listar grupos</a></li>
                        </ul></div>
                </div>	</div>



        </div>
    </div>


<?php 
@mysql_free_result($lista);
@mysql_close($grupo); 
@mysql_close($banca); 
?>
</body>
</html>