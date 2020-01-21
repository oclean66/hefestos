<?php 

define('INCLUDE_CHECK',true);
include 'class/formato.php';

include 'class/conexion.php';
include 'class/grupouser.php';
include 'class/usuario.php';

$link=Conectar();
$usuario=new usuario($link);
$grupos=new grupouser($link);
$lisgr = $grupos->listar_grupousers();


//----------------------Inserta-usuario------------------------------------//

if( isset($_POST['submit']) and $_POST['usuario_usuario']!='' and $_POST['usuario_nombre']!='') {

	$resul=$usuario->insertar_usuario($_POST['usuario_nombre'],trim($_POST['usuario_usuario']),$_POST['grupo']);

}
//-----------------------------------------------------------------------//

@mysql_free_result($resul);
@mysql_close($vendedor);


echo head();

if( isset($resul) ){
	if($resul==1){

		echo '<script language="JavaScript" type="text/javascript">
		alert(\'Guardado con exito!\');
		document.location="usuario.php";
		</script>';
	}else  {

		echo '<script language="JavaScript" type="text/javascript">
		alert("'.mysql_errno($link) . ": " . mysql_error($link).'");

		</script>';
	}
}	
?>

<body><?php  echo menu();  ?>
	<div id='fondo'>
		<div id='wrap'>
			<div id="content">

				<h1>Agregar Nuevo Usuario</h1>

				<div class="form">

					<form id="usuario-form" method="post">
						<p class="note">Campos con <span class="required">*</span> son obligatorios.</p>


						<div class="row">
							<label for="usuario_nombre" class="required">Nombre Completo <span class="required">*</span></label>		
							<input size="45" maxlength="45" name="usuario_nombre" id="usuario_nombre" type="text">			
						</div>

						<div class="row">
							<label for="usuario_usuario" class="required">Usuario <span class="required">*</span></label>		
							<input size="45" maxlength="45" name="usuario_usuario" id="usuario_usuario" type="text">			
						</div>

						<select style=" width:150px" name="grupo">
							<option name="sel" id="sel" value="0">Seleccione</option>   
							<?php  while($res=mysql_fetch_array($lisgr)){?>     
							<option value="<?php  echo $res[0];?>"><?php  echo $res[0].' - '.$res[1];?></option>
							<?php  }?>
						</select>



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
									<li><a href="usuario.php">Listar usuarios</a></li>
								</ul></div>
							</div>	</div>



						</div>
					</div>



				</body>
				</html>