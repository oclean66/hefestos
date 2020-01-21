<?php 

define('INCLUDE_CHECK',true);
include 'class/formato.php';

include 'class/conexion.php';
include 'class/tipoitem.php';

$link=Conectar();
$tipoitem=new tipoitem($link);


//----------------------Inserta-tipoitem------------------------------------//

if( isset($_POST['submit']) and  $_POST['tipoitem_nombre']!='') {
   
 $resul=$tipoitem->insertar_tipoitem($_POST['tipoitem_nombre']);
 
  }
//-----------------------------------------------------------------------//

@mysql_free_result($resul);
@mysql_close($vendedor);


echo head();

 if( isset($resul) ){
			if($resul==1){
			
			echo '<script language="JavaScript" type="text/javascript">
				alert(\'Guardado con exito!\');
				document.location="tipoitem.php";
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
		
<h1>Agregar Nuevo Tipo de Equipo</h1>

<div class="form">

<form id="tipoitem-form" method="post">
	<p class="note">Campos con <span class="required">*</span> son obligatorios.</p>

	


	<div class="row">
		<label for="tipoitem_nombre" class="required">Nombre <span class="required">*</span></label>		
		<input size="45" maxlength="45" name="tipoitem_nombre" id="tipoitem_nombre" type="text">
	</div>

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
<li><a href="tipoitem.php">Listar Tipos de Equipo</a></li>
</ul></div>
</div>	</div>



</div>
	</div>



</body>
</html>