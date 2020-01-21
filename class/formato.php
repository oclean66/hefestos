<?php 

session_start();

//---------------------------------------
function myErrorHandler($errno, $errstr, $errfile, $errline)
{
	if (!(error_reporting() & $errno)) {
        // This error code is not included in error_reporting
		return;
	}

	switch ($errno) {
		case E_USER_ERROR:
		echo "<b>My ERROR</b> [$errno] $errstr<br />\n";
		echo "  Fatal error on line $errline in file $errfile";
		echo ", PHP " . PHP_VERSION . " (" . PHP_OS . ")<br />\n";
		echo "Aborting...<br />\n";
		exit(1);
		break;

		case E_USER_WARNING:
		echo "<b>My WARNING</b> <br/>\n";
		break;

		case E_USER_NOTICE:
		echo "<b>My NOTICE</b><br/>\n";
		break;

		default:      
		break;
	}

	/* Don't execute PHP internal error handler */
	return true;
}
//------------------------------

// set to the user defined error handler
$old_error_handler = set_error_handler("myErrorHandler");

if (!isset($_SESSION["id"])) {
	echo "Debe iniciar sesión para poder entrar...";
	?>
	<script language="JavaScript" type="text/javascript">
	document.location='login.php';
	</script>

	<?php 

	die();
}

function head() {
	echo '<!DOCTYPE html>
	<html>
	
	<head>
	<meta http-equiv="Expires" content="0" />
	<meta http-equiv="Pragma" content="no-cache" />

	<meta http-equiv="Content-type" content="text/html; charset= iso-8859-1"/>
	<title>La Excelencia - Inventario</title>
	<link rel="stylesheet" href="css/style.css" type="text/css" />
	<link rel="shortcut icon" href="images/favicon.png">
	

	<style id="wrc-middle-css" type="text/css">

#popUpDiv{
	z-index: 100;
	position: absolute;
	background-color: rgba(123, 123,123, 0.7);
	display: none;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
}
#popupSelect{
z-index: 1000;
position: absolute;
top: 50%;
left: 36%;
}
.round{
	-webkit-border-radius: 15px;
	-moz-border-radius: 15px;
	border-radius: 15px;
	background-color: white;


	background-color: rgba(0, 0, 0, 0.48);
	position: absolute;
	width: 272px;
	height: 250px;
	border: 1px solid white;
	color: white;
	right: 2%;
	bottom: 8%;
	font-size: 16px;

}

​
</style>
<!--    JQUERY   -->
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/funciones.js"></script>
<!--    JQUERY    -->

<!--    FORMATO DE TABLAS    -->
<link type="text/css" href="css/demo_table.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery.dataTables.js"></script>
<!--    FORMATO DE TABLAS    -->


<link rel="stylesheet" href="css/datepicker.css" type="text/css" />
<!--claves-->
<script type="text/javascript" >

function clave(obj){
	obj.setAttribute("type","password");
}

function text(obj){
	obj.setAttribute("type","text");
}


</script>

<!--    Mascaras   -->
<script type="text/javascript">
var telefono = new Array(4,7)
var dia = new Array(2,0)
var precio = new Array(6,0)

function mascara(d,sep,pat,nums){

	if(d.valant != d.value){
		val = d.value
		largo = val.length
		val = val.split(sep)
		val2 = ""
		for(r=0;r<val.length;r++){
			val2 += val[r]	
		}
		if(nums){
			for(z=0;z<val2.length;z++){
				if(isNaN(val2.charAt(z))){
					letra = new RegExp(val2.charAt(z),"g")
					val2 = val2.replace(letra,"")
				}
			}
		}
		val = ""
		val3 = new Array()
		for(s=0; s<pat.length; s++){
			val3[s] = val2.substring(0,pat[s])
			val2 = val2.substr(pat[s])
		}
		for(q=0;q<val3.length; q++){
			if(q ==0){
				val = val3[q]
			}
			else{
				if(val3[q] != ""){
					val += sep + val3[q]
				}
			}
		}
		d.value = val
		d.valant = val
	}
}

</script>
<!---modelos--->
<script type="text/javascript" src="selecttipomodel.js"></script>


</head>';
}

function menu() {			
	$mysql_host = "localhost";
	$mysql_database = "excelencia_mydb";
	$mysql_user = "root";
	$mysql_password = "";
	$link=mysql_connect($mysql_host,$mysql_user,$mysql_password);

	

	echo '	
<div class="Navigation">
	<div id="NavigationInside">
		<ul>

			<li style="position: absolute;left: 200px;" ><a href="home.php">Inicio</a></li>

			<li style="position: absolute;left: 257px;" >
				<a href="#">Procesos</a>
				<div class="ultraNav">
					<div class="arrow-up"></div>

					<ul class="ultra">';


						if ($_SESSION['grupouser']==1 || $_SESSION['grupouser']==2 || $_SESSION['grupouser']==3 || $_SESSION['grupouser']==5 || $_SESSION['grupouser']==7 || $_SESSION['grupouser']==9)
							echo '
						<li><a href="bitem.php">Equipos</a>
							<div class="extended">
								<ul class="smallNav">
									<li><a href="asignar.php">Asignar Equipo</a></li>
									<li><a href="recibir.php">Recibir Equipo</a></li>
									<li><a href="bitem.php">Buscar Equipo</a></li>
	
								</ul>
							</div>
						</li>';

						if ($_SESSION['grupouser']==1 || $_SESSION['grupouser']==2 || $_SESSION['grupouser']==3 || $_SESSION['grupouser']==5 || $_SESSION['grupouser']==6 || $_SESSION['grupouser']==8)

							echo '
						<li><a href="bconexion.php">Conexiones</a>
							<div class="extended">
								<ul class="smallNav">
									<li><a href="aggconexion.php">Agregar Conexion</a></li>
									<li><a href="asignarcn.php">Asignar Conexion</a></li>
									<li><a href="bconexion.php">Buscar Conexion</a></li>
								</ul>
							</div>
						</li>';

						if($_SESSION['grupouser']==1 || $_SESSION['grupouser']==3 || $_SESSION['grupouser']==4)
							echo '
						<li><a href="suministro.php">Suministros</a>
							<div class="extended">
								<ul class="smallNav">
									<li><a href="asignarsum.php">Asignar Suministros</a></li>
									<li><a href="relacion.php">Relacion Suministros</a></li>
									<li><a href="Suministro.php">Lista Suministros</a></li>
									<li><a href="aggsuministro.php">Agregar Suministros</a></li>
									<li><a href="reporte.php">Reportes</a></li>		
								</ul>
							</div>
						</li>

						<li><a href="pendiente.php">Facturacion</a>
							<div class="extended">
								<ul class="smallNav">
									<li><a href="pendiente.php">Pendiente</a></li>
									<li><a href="libre.php">Libre</a></li>
									<!---<li><a href="precio.php">Precios</a></li>-->
								</ul>
							</div>
						</li>';

						if ($_SESSION['grupouser']==1 || $_SESSION['grupouser']==2 || $_SESSION['grupouser']==3 || $_SESSION['grupouser']==5 || $_SESSION['grupouser']==7 || $_SESSION['grupouser']==9)
							echo '
						<li><a href="#">Almacen 1</a>
							<div class="extended">
								<ul class="smallNav">
									<li><a href="item.php?st=a">Ver Equipos</a></li>
									<li><a href="aggalmauno.php?almacen=1">Agregar Equipos</a></li>
								</ul>
							</div>
						</li>

						<li><a href="#">Almacen 2</a>
							<div class="extended">
								<ul class="smallNav">
									<li><a href="item.php?st=b">Ver Equipos</a></li>
									<li><a href="aggalmauno.php?almacen=2">Agregar Equipos</a></li>
								</ul>
							</div>
						</li>
						';

					echo '
					</ul>	
				</div>
			</li>';

if ($_SESSION['grupouser']!=4){		
			echo '
			<li style="position: absolute;left: 342px;"  >
				<a href="#">Mantenimiento</a>
				<div class="ultraNav">
					<div class="arrow-up"></div>

					<ul class="ultra">
						<li><a href="banca.php">Banca</a></li>
						<li><a href="vendedor.php">Receptores</a></li>
						<li><a href="grupo.php">Grupos</a></li>
						<li><a href="agencia.php">Agencias</a></li>';

						if ($_SESSION['grupouser']==1 || $_SESSION['grupouser']==2 || $_SESSION['grupouser']==3 || $_SESSION['grupouser']==5 || $_SESSION['grupouser']==6 || $_SESSION['grupouser']==8){

							echo '
						<li><a href="bconexion.php">Conexiones</a>
							<div class="extended">
								<ul class="smallNav">
									<li><a href="conexion.php?st=y">Libres</a></li>
									<li><a href="conexion.php?st=a">De Baja</a></li>
									<li><a href="conexion.php?st=z">Prestadas</a></li>';

									mysql_select_db($mysql_database,$link);	 
									mysql_query("SET NAMES 'utf8'");
									$sql = "select * from tipoconexion";
									$tipos = mysql_query($sql,$link);
									while($registro=mysql_fetch_row($tipos))
									{
										echo '<li><a href="conexion.php?st='.$registro[0].'">'.$registro[1].'</a></li>';
									}

						echo '
								</ul>
							</div>
						</li>';

						}


					if ($_SESSION['grupouser']==1 || $_SESSION['grupouser']==2 || $_SESSION['grupouser']==3 || $_SESSION['grupouser']==5 || $_SESSION['grupouser']==7 || $_SESSION['grupouser']==9){

						echo '
						<li><a href="item.php">Equipos</a>
							<div class="extended">
								<ul class="smallNav">
									<li><a href="item.php?st=c">Por Reparar</a></li>
									<li><a href="item.php?st=d">Prestados</a></li>
									<li><a href="item.php?st=e">Garantia</a></li>
									<li><a href="item.php?st=f">De baja</a></li>';
									
									$link=mysql_connect($mysql_host,$mysql_user,$mysql_password);
									mysql_select_db($mysql_database,$link);	 
									mysql_query("SET NAMES 'utf8'");
									$sql = "select * from tipoitem";
									$tipos = mysql_query($sql,$link);
									while($registro=mysql_fetch_row($tipos))
									{
										echo '<li><a href="item.php?st='.$registro[0].'">'.$registro[1].'</a></li>';
									}

								echo '
								</ul>
							</div>
						</li>';
						}
					echo '
					</ul>
				</div>
			</li>';
		}
if ($_SESSION['grupouser']!=4)
			echo '
			<li style="position: absolute;left: 466px;"  ><a href="#">Reportes</a>
				<div class="ultraNav">
					<div class="arrow-up"></div>
					<ul class="ultra">
						<li><a href="asignaciones.php">Salidas Semanal</a>
							<div class="extended">
								<ul class="smallNav">
									<li><a href="asignaciones.php">Equipos</a></li>
									<li><a href="asignacionesConexion.php">Conexiones</a></li>
								</ul>
							</div>
						</li>

						<li><a href="detalle.php">Salidas Generales</a></li>
						<li><a href="entradas.php">Entradas de esta semana</a></li>
						<li><a href="compras.php">Compras</a></li>
						<li><a href="cuadro.php">Cuadro Resumen</a></li>
						<li><a href="bitacora.php">Bitacora de acciones</a></li>
					</ul>
				</div>
			</li>';

	if ($_SESSION['grupouser']==1 || $_SESSION['grupouser']==2 || $_SESSION['grupouser']==8 || $_SESSION['grupouser']==9 || $_SESSION['grupouser']==5){
			echo '
			<li style="position: absolute;left: 551px;"  ><a href="#">Configuracion</a>
				<div class="ultraNav">
					<div class="arrow-up"></div>
					<ul class="ultra">';
				if ($_SESSION['grupouser']==1 || $_SESSION['grupouser']==2)
					echo '<li><a href="usuario.php">Usuarios</a></li>';
				if ($_SESSION['grupouser']==1 || $_SESSION['grupouser']==2 || $_SESSION['grupouser']==5 || $_SESSION['grupouser']==9)
					echo '
						<li><a href="modelo.php">Modelos Equipos</a></li>
						<li><a href="tipoitem.php">Tipos Equipos</a></li>';
				if ($_SESSION['grupouser']==1 || $_SESSION['grupouser']==2 || $_SESSION['grupouser']==5 || $_SESSION['grupouser']==8)
					echo '
						<li><a href="modeloconexion.php">Modelos Conexiones</a></li>
						<li><a href="tipoconexion.php">Tipos Conexiones</a></li>';
				echo '
					</ul>
				</div>
			</li>';
	}


			echo '
			<li style="position: absolute;right: 150px;"><a href="#">'.$_SESSION["usr"].'</a>
				<div class="ultraNav">
					<div class="arrow-up"></div>
					<ul class="ultra">
						<li><a href="cuenta.php">Cuenta</a></li>
						<li><a href="class/cerrar.php">Cerrar Sesion</a></li>
					</ul>
				</div>
			</li>

		</ul>
	</div>
</div>';

	}

	function notificacion($edit){

		if($edit==1) echo "<p class=\"success-box\">Actualizado con exito</p>" ;
		else echo "<p class=\"error-box\">Ocurrio un error en la actualizacion</p>" ;

	}
	?>