<?php 
session_start();

include 'class/conexion.php';
$link = Conectar();
if (isset($_GET['tipo'])) {
	$tipo = $_GET['tipo'];
}
if ($tipo==1){
$sqlf= "INSERT INTO `factura` (`idfactura`, `fecha`, `proveedor`)
 VALUES ('".$_POST['factura']."', '".$_POST['inputDate']."', '".$_POST['proveedor']."');";

$res=mysql_query($sqlf,$link); 

$bitacorasql= "INSERT INTO  `bitacora` (
				`idbitacora` ,
				`fecha` ,
				`accion` ,
				`usuario_idusuario`
				)
				VALUES (NULL , 
				CURRENT_TIMESTAMP , 
				 'Inserto factura Cod. ".$_POST['factura']." con fecha ".$_POST['inputDate']." del proveedor ".$_POST['proveedor']."','". $_SESSION['id']."');";   
				
		
		$bita=mysql_query($bitacorasql,$link); 

$i=0;
  //Recorrer lo elementos del arreglo ---VALIDACION DE CUALES SI SE REGISTRARON
      foreach ($_POST['text'] as $value) { 
      $sql="INSERT INTO `item` (`serialitem`, `idestado`, `idtipoitem`, `idfactura`, `modelo_idmodelo`, `precio`)
       VALUES ('$value', '$tipo',  '".$_POST['select'][$i]."',  '".$_POST['factura']."',  '".$_POST['selectmodel'][$i]."','0')";
     
      $bita=mysql_query($sql,$link);

      $bitacorasql= "INSERT INTO  `bitacora` (
        `idbitacora` ,
        `fecha` ,
        `accion` ,
        `usuario_idusuario`
        )
        VALUES (NULL , 
        CURRENT_TIMESTAMP , 
         'Inserto item con serial ".$value." modelo ".$_POST['selectmodel'][$i]." de estado ".$tipo." con tipo ".$_POST['select'][$i]." ".mysql_errno($link) . ": " . mysql_error($link)."','". $_SESSION['id']."');";   
        
    
    $bita=mysql_query($bitacorasql,$link); 

     
      
     
      $i++;
      }
}else {
		

$i=0;
  //Recorrer lo elementos del arreglo ---VALIDACION DE CUALES SI SE REGISTRARON
      foreach ($_POST['text'] as $value) { 
      $sql="INSERT INTO `item` (`serialitem`, `idestado`, `idtipoitem`, `idfactura`, `modelo_idmodelo`)
       VALUES ('$value', '$tipo',  '".$_POST['select'][$i]."',  NULL,  '".$_POST['selectmodel'][$i]."')";
     
      $bita=mysql_query($sql,$link);

      $bitacorasql= "INSERT INTO  `bitacora` (
        `idbitacora` ,
        `fecha` ,
        `accion` ,
        `usuario_idusuario`
        )
        VALUES (NULL , 
        CURRENT_TIMESTAMP , 
         'Inserto item con serial ".$value." modelo ".$_POST['selectmodel'][$i]." de estado ".$tipo." con tipo ".$_POST['select'][$i]." ".mysql_errno($link) . ": " . mysql_error($link)."','". $_SESSION['id']."');";   
        
    
    $bita=mysql_query($bitacorasql,$link); 

     
      
     
      $i++;
      }
    }
      echo '<script language="JavaScript" type="text/javascript">
        alert("Se inserto exitosamente '.$i.' registros");
      </script>';
 
//echo $sql;
    ?>

    <script language="JavaScript" type="text/javascript">
        document.location = "item.php";
    </script>
