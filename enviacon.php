<?php 
session_start();

include 'class/conexion.php';
$link = Conectar();
$mensaje = '';
$i=0;
$j=0;
  //Recorrer lo elementos del arreglo ---VALIDACION DE CUALES SI SE REGISTRARON
foreach ($_POST['codigo'] as $codconexion) { 

  if($_POST['operador']=='0'){
    $sql="INSERT INTO `conexion`
    VALUES (NULL,'".$_POST['numero'][$i]."','$codconexion', NULL,  '".$_POST['inputDate']."',  '".$_POST['clavedatos'][$i]."','".$_POST['clavemovil'][$i]."',CURRENT_TIMESTAMP,'2', '".$_POST['modeloconexions']."', '".$_POST['fechacorte']."', '".$_POST['servicio']."','".$_POST['monto']."')";
  }else{ 
    $sql="INSERT INTO `conexion`
    VALUES (NULL,'".$_POST['numero'][$i]."','$codconexion', '".$_POST['operador']."',  '".$_POST['inputDate']."',  '".$_POST['clavedatos'][$i]."','".$_POST['clavemovil'][$i]."',CURRENT_TIMESTAMP,'2', '".$_POST['modeloconexions']."', '".$_POST['fechacorte']."', '".$_POST['servicio']."','".$_POST['monto']."')";
  }

  $bita=mysql_query($sql,$link);

  if (mysql_errno($link)==0){

    $i++;

    $bitacorasql= "INSERT INTO  `bitacora` (
      `idbitacora` ,
      `fecha` ,
      `accion` ,
      `usuario_idusuario`
      )
VALUES (NULL , 
  CURRENT_TIMESTAMP , 
  'Inserto Equipo de conexion  ".$codconexion."','". $_SESSION['id']."');";   


    $bita=mysql_query($bitacorasql,$link); 

  }else if (mysql_errno($link)==1062){
    echo '<script language="JavaScript" type="text/javascript">
  alert("El codigo #'.$codconexion.' ya se encuentra registrado");
  </script>';

  }else{

  echo '<script language="JavaScript" type="text/javascript">
  alert("'.mysql_error($link).'")
  </script>';

  }
}
echo '<script language="JavaScript" type="text/javascript">
alert("Se Agregaron '.$i.' registros");
document.location = "conexion.php?st=y";
</script>';

?>