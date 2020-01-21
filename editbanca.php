<?php  
define('INCLUDE_CHECK', true);
include 'class/formato.php';

include 'class/conexion.php';
include 'class/banca.php';

$link = Conectar();
$banca = new banca($link);


//----------------------Consulta-Banca------------------------------------//

if (isset($_GET['reg'])) {

    $resulreg = $banca->consultarbanca($_GET['reg']);
    $fila = mysql_fetch_array($resulreg);
}
//----------------------Guardar-Banca------------------------------------//

if (isset($_POST['submit']) and $_POST['banca_nombre'] != '') {

    $resul = $banca->guardarbanca($_POST['banca_nombre'], $_GET['reg']);

    if ($resul == 1) {
        echo '<script type="text/javascript">
        window.location="./banca.php?edit=1";
        </script>';
    } else {
        echo '<script type="text/javascript">
        window.location="./banca.php?edit=0";
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

                <h1>Edicion de Banca</h1>

                <div class="form">

                    <form id="banca-form" method="post">
                        <p class="note">Campos con <span class="required">*</span> son obligatorios.</p>


                        <div class="row">
                            <label for="banca_codigo" class="required">Codigo <span class="required">*</span></label>		
                            <input size="45" maxlength="45" name="banca_codigo" id="banca_codigo" disabled="disabled" type="text" value ="<?php  echo $fila['idbanca']; ?>">			</div>

                        <div class="row">
                            <label for="banca_nombre" class="required">Nombre <span class="required">*</span></label>		
                            <input size="45" maxlength="45" name="banca_nombre" id="banca_nombre" value ="<?php  echo $fila['nombre']; ?>" type="text">			</div>

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
                            <li><a href="banca.php">Listar Bancas</a></li>
                        </ul></div>
                </div>	</div>



        </div>
    </div>



</body>
</html>