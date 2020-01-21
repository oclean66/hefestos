<?php 
session_start();

include 'class/conexion.php';
$link = Conectar();

$i=0;
$success = 0;
  //Recorrer lo elementos del arreglo
       foreach ($_POST['id'] as $value) { 
        $sql = 'DELETE FROM computador
        WHERE computador.idcomputador = '.$value;

        $res=mysql_query($sql,$link); if($res == 1)$success++;
       
        
         $sql = 'UPDATE `reciboscomputador` SET  `idusuariorecibo` =  '.$_SESSION["id"].' 
         WHERE  `reciboscomputador`.`idcomputador` ='.$value;

        $res=mysql_query($sql,$link);  if($res == 1)$success++;

        $sql = "UPDATE `item` SET  `idestado` =  ".$_POST['selectstatus'][$i]." 
         WHERE  `item`.`serialitem` ='".$_POST['iditem'][$i]."'"; 

        $res=mysql_query($sql,$link);  if($res == 1)$success++;

        $i++;
       } 
        
          echo '<script language="JavaScript" type="text/javascript">
                alert(" Se Actualizo la informacion, se recibio '. $success/3 . ' equipos de '.$i.' en total");
                
              </script>';
         ?>
     <script language="JavaScript" type="text/javascript">
        document.location = "entradas.php";
    </script>
        

