<?php 

define('INCLUDE_CHECK',true);
include 'class/formato.php';

include 'class/conexion.php';
include 'class/modeloconexion.php';
include 'class/tipoconexion.php';

$link=Conectar();
$modelo=new modeloconexion($link);
$modeloitem=new tipoconexion($link);
$listamodelos = $modeloitem->listar_tipoconexiones($link);


//----------------------Inserta-modelo------------------------------------//

if( isset($_POST['submit']) and $_POST['modelo_nombre']!='') {
   
 $resul=$modelo->insertar_modeloconexion($_POST['modelo_nombre'],$_POST['tipo']);
 
  }
//-----------------------------------------------------------------------//

@mysql_free_result($resul);
@mysql_close($vendedor);


echo head();

 if( isset($resul) ){
			if($resul==1){
			
			echo '<script language="JavaScript" type="text/javascript">
				alert(\'Guardado con exito!\');
				document.location="modeloconexion.php";
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
		
<h1>Agregar Nuevo Modelo de Conexion</h1>

<div class="form">

<form id="modelo-form" method="post">
	<p class="note">Campos con <span class="required">*</span> son obligatorios.</p>

	


	<div class="row">
		<label for="modelo_nombre" class="required">Nombre <span class="required">*</span></label>		
		<input size="45" maxlength="45" name="modelo_nombre" id="modelo_nombre" type="text">			</div>

	<div class="row">
                            <label for="vendedor_codigo" class="required">Tipo de Conexion<span class="required">*</span></label>
                            <select style=" width:150px" name="tipo" id="tipo">
                            <option name="sel" id="sel" value="0">Seleccione</option>        
                            <?php 
                            
                            while ($fila = mysql_fetch_array($listamodelos)) {
                             ?>
                            <option value="<?php  echo $fila[0]; ?>"><?php  echo $fila[1]; ?></option><?php 
                                }
                            ?> 
                        </select> </div>

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
<li><a href="modeloconexion.php">Listar modelos</a></li>
</ul></div>
</div>	</div>



</div>
	</div>



</body>
</html>