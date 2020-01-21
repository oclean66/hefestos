<?php  

define('INCLUDE_CHECK',true);
include 'class/formato.php';

include 'class/conexion.php';
include 'class/banca.php';

$link=Conectar();
$banca=new banca($link);


//----------------------Inserta-Banca------------------------------------//

if( isset($_POST['submit']) and $_POST['banca_codigo']!='' and $_POST['banca_nombre']!='') {
   
 $resul=$banca->insertar_banca( trim($_POST['banca_codigo']),$_POST['banca_nombre']);
 
  }
//-----------------------------------------------------------------------//

@mysql_free_result($resul);
@mysql_close($vendedor);


echo head();

 if( isset($resul) ){
			if($resul==1){
			
			echo '<script language="JavaScript" type="text/javascript">
				alert(\'Guardado con exito!\');
				document.location="banca.php";
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
		
<h1>Agregar Nueva Banca</h1>

<div class="form">

<form id="banca-form" method="post">
	<p class="note">Campos con <span class="required">*</span> son obligatorios.</p>

	
	<div class="row">
		<label for="banca_codigo" class="required">Codigo <span class="required">*</span></label>		
		<input size="45" maxlength="45" name="banca_codigo" id="banca_codigo" type="text">			</div>

	<div class="row">
		<label for="banca_nombre" class="required">Nombre <span class="required">*</span></label>		
		<input size="45" maxlength="45" name="banca_nombre" id="banca_nombre" type="text">			</div>

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
<li><a href="banca.php">Listar Bancas</a></li>
</ul></div>
</div>	</div>



</div>
	</div>



</body>
</html>