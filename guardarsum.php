<?php 
session_start();

include 'class/conexion.php';
$link = Conectar();

$i=0;
$success = 0;
  //Recorrer lo elementos del arreglo
foreach ($_POST['text'] as $value) { 

 $sql = "INSERT INTO `relacion` (`idrelacion`, `fecha`, `cantidad`, `idagencia`, `idgrupo`, `idvendedor`, `idbanca`, `idsuministros`) 
 VALUES (NULL, CURRENT_TIMESTAMP, '".$_POST['cant'][$i]."', '".$_POST['agencia']."', '".$_POST['grupo']."', '".$_POST['vendedor']."', '".$_POST['banca']."', '".$value."')";

 echo $sql;
 $bita=mysql_query($sql,$link);

 if($bita == 1) $success++;

 else
   if(mysql_errno($link)==1062)
     echo '<script language="JavaScript" type="text/javascript">
   alert("Has seleccionado el mismo equipo varias veces, solo se insertara una vez.");   
   </script>';
   else
     echo '<script language="JavaScript" type="text/javascript">
   alert("' . mysql_errno($link) . ": " . mysql_error($link) . '");
   </script>';

   

   $sql = "UPDATE  `suministros` SET  `cantidad` =  `cantidad`-".$_POST['cant'][$i]." WHERE  `suministros`.`idsuministros` ='".$value."'";
   $bita=mysql_query($sql,$link);

   $bitacorasql= "INSERT INTO  `bitacora` (
     `idbitacora` ,
     `fecha` ,
     `accion` ,
     `usuario_idusuario`)
VALUES (NULL , 
 CURRENT_TIMESTAMP , 
 'Asigno suministro ".$value." transaccion ".$_POST['cant'][$i]." para AG/GR/VN/BN ".$_POST['agencia'].", ".$_POST['grupo'].", ".$_POST['vendedor'].", ".$_POST['banca']."','". $_SESSION['id']."');";   


$bita=mysql_query($bitacorasql,$link); 

$i++;
}



?>
<script language="JavaScript" type="text/javascript">
       document.location = "relacion.php?age=<?php  echo $_POST['agencia']?>&gr=<?php  echo $_POST['grupo']?>&ven=<?php  echo $_POST['vendedor']?>&ban=<?php  echo $_POST['banca']?>";
       </script>
