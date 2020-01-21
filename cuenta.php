<?php 

define('INCLUDE_CHECK', true);
include 'class/formato.php';
include 'class/conexion.php';
include 'class/usuario.php';
$link = conectar();
$user = new usuario($link);
$data = $user->consultarusuario($_SESSION['id']);
$usuario =  mysql_fetch_array($data);


//----------------------Guardar-Banca------------------------------------//

if (isset($_POST['submit']) and $_POST['nombre'] != '' and $_POST['usuario'] != '' and $_POST['clave'] != '' and $_POST['claverep'] != '' ) {

    $resul = $user->guardarusuario($_POST['nombre'], $_POST['usuario'], $_POST['clave'], $_SESSION['id']);

    if ($resul == 1) {
        echo '<script type="text/javascript">
        alert("Cambio guardado con exito, debe volver a iniciar sesion")
        window.location="./login.php";
        </script>';
    } else {
        echo '<script type="text/javascript">
        window.location="./home.php";
        </script>';
    }
}
//-----------------------------------------------------------------------//

echo head();
?>


<body><?php  echo menu(); ?>
	<div id='fondo'>
		<div id='wrap'>
			<div id="content">

				<h1>Cuenta</h1>

				<div class="form">
					<form id="banca-form" method="post">
						<p class="note">Campos con <span class="required">*</span> son obligatorios.</p>

						<div class="row">
							<label for="nombre" class="required">Nombre <span class="required">*</span></label>		
							<input size="45" maxlength="45" name="nombre" id="nombre" value ="<?php  echo $usuario[1];?>" type="text">			
						</div>
						<div class="row">
							<label for="usuario" class="required">Usuario <span class="required">*</span></label>		
							<input size="45" maxlength="45" name="usuario" id="usuario" value ="<?php  echo $usuario[3];?>" type="text">			
						</div>
						<div class="row">
							<label for="clave" class="required">Clave <span class="required">*</span></label>		
							<input size="45" maxlength="45" name="clave" id="clave" value ="" type="password">			
						</div>
						<div class="row">
							<label for="clave" class="required">Repetir Clave <span class="required">*</span></label>		
							<input size="45" maxlength="45" name="claverep" id="claverep" value ="" type="password">			
						</div>

						<div class="row buttons">
							<input type="submit" name="submit" value="Actualizar">	
						</div>

					</form>
				</div>
				<!-- form -->	
			</div>




		</div>
	</div>

</body>
</html>