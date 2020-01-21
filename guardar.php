<?php  session_start();

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
      foreach ($_POST['text'] as $value) { 
        $sql = "INSERT INTO computador 
        (`idcomputador`, `fechaprestamo`, `fechadevolucion`, `idusuario`, `iditem`, `idconexion`, `idagencia`, `idgrupo`, `idvendedor`, `idbanca`, `idtransaccion`)
         VALUES (NULL, CURRENT_TIMESTAMP, NULL, '".$_SESSION['id']."', '".$value."', NULL, '".$_POST['agencia']."', '".$_POST['grupo']."', '".$_POST['vendedor']."', '".$_POST['banca']."', '".$idtrans."');";

      
     
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
     
      $i++;
     
        $sql = "UPDATE  `item` SET  `idestado` =  '5' WHERE  `item`.`serialitem` ='".$value."'";
      $bita=mysql_query($sql,$link);

      $bitacorasql= "INSERT INTO  `bitacora` (
        `idbitacora` ,
        `fecha` ,
        `accion` ,
        `usuario_idusuario`
        )
        VALUES (NULL , 
        CURRENT_TIMESTAMP , 
         'Asigno equipo ".$value." transaccion ".$_POST['trans']." para AG/GR/VN/BN ".$_POST['agencia'].", ".$_POST['grupo'].", ".$_POST['vendedor'].", ".$_POST['banca']."','". $_SESSION['id']."');";   
        
    
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
        document.location = "computador.php?age=<?php  echo $_POST['agencia']?>&gr=<?php  echo $_POST['grupo']?>&ven=<?php  echo $_POST['vendedor']?>&ban=<?php  echo $_POST['banca']?>";
</script>
