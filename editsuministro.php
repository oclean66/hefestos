<?php 
define('INCLUDE_CHECK', true);
include 'class/formato.php';

include 'class/conexion.php';
include 'class/suministro.php';

$link = Conectar();
$suministro = new suministro($link);

if (isset($_GET['reg']) && isset($_GET['tipo']) && isset($_GET['cant'])) {
    echo "aq";
    
    $resul = $suministro->cargarsuministro($_GET['reg'],$_GET['cant']);
    if ($resul == 1) {
        echo 'ya';
    } else {
        echo 'todavia';
    }

}
//----------------------Consulta-suministro------------------------------------//

if (isset($_GET['reg'])) {

    $resulreg = $suministro->consultarsuministro($_GET['reg']);
    $fila = mysql_fetch_array($resulreg);
}
//----------------------Guardar-suministro------------------------------------//

if (isset($_POST['submit']) and $_POST['suministro_nombre'] != '') {

    $resul = $suministro->guardarsuministro($_POST['suministro_nombre'], $_GET['reg'],$_POST['cantidad']);

    if ($resul == 1) {
        echo '<script type="text/javascript">
        window.location="./suministro.php?edit=1";
        </script>';
    } else {
        echo '<script type="text/javascript">
        window.location="./suministro.php?edit=0";
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

                <h1>Edicion de suministro</h1>

                <div class="form">

                    <form id="suministro-form" method="post">
                        <p class="note">Campos con <span class="required">*</span> son obligatorios.</p>


                        <div class="row">
                            <label for="suministro_codigo" class="required">Codigo <span class="required">*</span></label>		
                            <input size="45" maxlength="45" name="suministro_codigo" id="suministro_codigo" disabled="disabled" type="text" value ="<?php  echo $fila['idsuministros']; ?>">			
                        </div>

                        <div class="row">
                            <label for="suministro_nombre" class="required">Nombre <span class="required">*</span></label>		
                            <input size="45" maxlength="45" name="suministro_nombre" id="suministro_nombre" value ="<?php  echo $fila['nombre']; ?>" type="text">			
                        </div>

                        <div class="row">
                            <label for="suministro_codigo" class="required">Cantidad Disponible <span class="required">*</span></label>      
                            <input size="45" maxlength="45" name="cantidad" id="cantidad" type="text" value ="<?php  echo $fila['cantidad']; ?>">            
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
                            <li><a href="suministro.php">Listar suministros</a></li>
                        </ul></div>
                </div>	</div>



        </div>
    </div>



</body>
</html>