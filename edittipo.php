<?php 
define('INCLUDE_CHECK', true);
include 'class/formato.php';

include 'class/conexion.php';
include 'class/tipoitem.php';

$link = Conectar();
$tipo = new tipoitem($link);


//----------------------Consulta-tipo------------------------------------//

if (isset($_GET['it'])) {

    $resulreg = $tipo->consultartipoitem($_GET['it']);
    $fila = mysql_fetch_array($resulreg);
}
//----------------------Guardar-tipo------------------------------------//

if (isset($_POST['submit']) and $_POST['tipo_nombre'] != '') {

    $resul = $tipo->guardartipoitem($_POST['tipo_nombre'], $_GET['it']);

    if ($resul == 1) {
        echo '<script type="text/javascript">
        window.location="./tipoitem.php?edit=1";
        </script>';
    } else {
        echo '<script type="text/javascript">
        window.location="./tipoitem.php?edit=0";
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

                <h1>Edicion de tipo</h1>

                <div class="form">

                    <form id="tipo-form" method="post">
                        <p class="note">Campos con <span class="required">*</span> son obligatorios.</p>


                        <div class="row">
                            <label for="tipo_nombre" class="required">Nombre <span class="required">*</span></label>		
                            <input size="45" maxlength="45" name="tipo_nombre" id="tipo_nombre" value ="<?php  echo $fila['tipo']; ?>" type="text">	
                            		</div>

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
                            <li><a href="tipoitem.php">Listar tipos</a></li>
                        </ul></div>
                </div>	</div>



        </div>
    </div>



</body>
</html>