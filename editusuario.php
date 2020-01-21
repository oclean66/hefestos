<?php   
define('INCLUDE_CHECK', true);
include 'class/formato.php';

include 'class/conexion.php';
include 'class/grupouser.php';
include 'class/usuario.php';

$link=Conectar();
$usuario=new usuario($link);
$grupos=new grupouser($link);
$lisgr = $grupos->listar_grupousers();

//----------------------Consulta-usuario------------------------------------//

if (isset($_GET['id'])) {

    $resulreg = $usuario->consultarusuario($_GET['id']);
    $fila = mysql_fetch_array($resulreg);
}
//----------------------Guardar-usuario------------------------------------//

if (isset($_POST['submit']) and $_POST['usuario_nombre'] != '') {

    $resul = $usuario->guardarusuario($_POST['usuario_nombre'],$_POST['usuario_usuario'],$_POST['usuario_tipo'], $_GET['id']);

    if ($resul == 1) {
        echo '<script type="text/javascript">
        window.location="./usuario.php?edit=1";
        </script>';
    } else {
        echo '<script type="text/javascript">
        window.location="./usuario.php?edit=0";
        </script>';
    }
}
//-----------------------------------------------------------------------//

@mysql_free_result($resul);
@mysql_close($usuario);


echo head();
?>

<body><?php   echo menu(); ?>
    <div id='fondo'>
        <div id='wrap'>
            <div id="content">

                <h1>Edicion de Usuarios</h1>

                <div class="form">

                    <form id="vendedor-form" method="post">
                        <p class="note">Campos con <span class="required">*</span> son obligatorios.</p>


                        <div class="row">
                            <label for="usuario_nombre" class="required">Nombre Completo <span class="required">*</span></label>		
                            <input size="45" maxlength="45" name="usuario_nombre" id="usuario_nombre"  type="text" value ="<?php   echo $fila['nombre']; ?>">			
                        </div>

                        <div class="row">
                            <label for="usuario_usuario" class="required">Usuario <span class="required">*</span></label>		
                            <input size="45" maxlength="45" name="usuario_usuario" id="usuario_usuario" disabled="disabled" value ="<?php   echo $fila['usuario']; ?>" type="text">			
                        </div>

                         <div class="row">
                            <label for="usuario_tipo" class="required">Tipo de Usuario <span class="required">*</span></label>        
                            <input size="45" maxlength="45" name="usuario_tipo" id="usuario_tipo" value ="<?php   echo $fila['descrip']; ?>" type="text">            
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
                            <li><a href="usuario.php">Listar Usuarios</a></li>
                        </ul></div>
                </div>	</div>

 

        </div>
    </div>


</body>
</html>