<?php 
session_start();

include 'class/conexion.php';
$link = Conectar();

$i=0;
$success = 0;

$res=mysql_query('SELECT idtransaccion FROM `computador` order by idtransaccion desc limit 1',$link);
$trans = mysql_fetch_array($res);

$recv=mysql_query('SELECT idtransaccion FROM `reciboscomputador` order by idtransaccion desc limit 1',$link);
$transs = mysql_fetch_array($recv);
 
if ($trans[0]>= $transs[0]){
 $idtrans = $trans[0];
 $idtrans++;
 
}
else{
 $idtrans = $transs[0];
 $idtrans++;
 
}
  //Recorrer lo elementos del arreglo
      foreach ($_POST['codigo'] as $value) { 
        $sql = "INSERT INTO computador 
        (`idcomputador`, `fechaprestamo`, `fechadevolucion`, `idusuario`, `iditem`, `idconexion`, `idagencia`, `idgrupo`, `idvendedor`, `idbanca`, `idtransaccion`)
         VALUES (NULL, CURRENT_TIMESTAMP, NULL, '".$_SESSION['id']."', NULL, '".$value."', '".$_POST['agencia']."', '".$_POST['grupo']."', '".$_POST['vendedor']."', '".$_POST['banca']."', '".$idtrans."');";

      
     
      $bita=mysql_query($sql,$link);

     if($bita == 1) $success++;
      
      else
        if(mysql_errno($link)==1062)
          echo '<script language="JavaScript" type="text/javascript">
        alert("Has seleccionado la misma conexion varias veces, solo se insertara una vez.");
        
      </script>';
      else
        echo '<script language="JavaScript" type="text/javascript">
        alert("' . mysql_errno($link) . ": " . mysql_error($link) . '");
        
      </script>';
     
      $i++;
     
        $sql = "UPDATE  `conexion` SET  `idestado` =  '5' WHERE  `idconexion` ='".$value."'";
      $bita=mysql_query($sql,$link);

        $bitacorasql= "INSERT INTO  `bitacora` (
        `idbitacora` ,
        `fecha` ,
        `accion` ,
        `usuario_idusuario`
        )
        VALUES (NULL , 
        CURRENT_TIMESTAMP , 
         'Asigno conexion ".$value." transaccion ".$_POST['trans']." para AG/GR/VN/BN ".$_POST['agencia'].", ".$_POST['grupo'].", ".$_POST['vendedor'].", ".$_POST['banca']."','". $_SESSION['id']."');";   
        
    
    $bita=mysql_query($bitacorasql,$link); 
      }

       if($success >= 1)
      echo '<script language="JavaScript" type="text/javascript">
        alert("Se inserto '.$success.' registros");
        if(confirm("Desea imprimir formato de Salida?"))
         window.open("pdf/ticket.php?id='.$idtrans.'");
      </script>';
 

    ?>
    <script language="JavaScript" type="text/javascript">
    
   
        document.location = "conexion.php";
    </script>
