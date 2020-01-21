<?php 
define('INCLUDE_CHECK', true);
include 'class/formato.php';

include 'class/conexion.php';
include 'class/modelo.php';

$link = Conectar();
$modelo = new modelo($link);


//----------------------Consulta-modelo------------------------------------//

if (isset($_GET['it'])) {

    $resulreg = $modelo->consultarmodelo($_GET['it']);
    $fila = mysql_fetch_array($resulreg);
}
//----------------------Guardar-modelo------------------------------------//

if (isset($_POST['submit']) and $_POST['modelo_nombre'] != '') {

    $resul = $modelo->guardarmodelo($_POST['modelo_nombre'], $_GET['it']);

    if ($resul == 1) {
        echo '<script type="text/javascript">
        window.location="./modelo.php?edit=1";
        </script>';
    } else {
        echo '<script type="text/javascript">
        window.location="./modelo.php?edit=0";
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

                <h1>Edicion de modelo</h1>

                <div class="form">

                    <form id="modelo-form" method="post">
                        <p class="note">Campos con <span class="required">*</span> son obligatorios.</p>


                      
                        <div class="row">
                            <label for="modelo_nombre" class="required">Nombre <span class="required">*</span></label>		
                            <input size="45" maxlength="45" name="modelo_nombre" id="modelo_nombre" value ="<?php  echo $fila['nombremodel']; ?>" type="text">			</div>

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
                            <li><a href="modelo.php">Listar modelos</a></li>
                        </ul></div>
                </div>	</div>



        </div>
    </div>



</body>
</html>