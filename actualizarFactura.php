<?php  session_start();

include 'class/conexion.php';
$link = Conectar();

$suma = 0;
$vector = array("\n\n----------------------------------------------------------------------------------\n\nCant   Descripcion                                              Precio unitario   Total\n\n");
for($i=0;$i< $_POST['lineas'];$i++){
  
  
  if(isset($_POST['itemn'.$i])){
    $vector[]=str_pad(strtoupper(substr($_POST['num'.$i],0,4)),4," ",STR_PAD_RIGHT)."  (G) ".str_pad(strtoupper(substr($_POST['itemn'.$i],0,54)),54," ",STR_PAD_RIGHT)."   ".str_pad(strtoupper(substr($_POST['unitario'.$i],0,8)),8," ",STR_PAD_LEFT)."   ".str_pad(strtoupper(substr($_POST['unitario'.$i]*$_POST['num'.$i],0,8)),8," ",STR_PAD_LEFT)."\n";
    $suma = $suma + $_POST['unitario'.$i]*$_POST['num'.$i];
  }
}
for($i=0;$i< 20-$_POST['lineas'];$i++)
   $vector[]="\n";


 
$contenido = "\n\n\n\n\n\n\n\n\n
              Factura de Compra
Fecha:     ".str_pad(strtoupper(substr($_POST['date'],0,35)),35," ",STR_PAD_RIGHT)."  Factura N:  ".$_POST['factura']."
Cliente:   ".str_pad(strtoupper(substr($_POST['responsable'],0,35)),35," ",STR_PAD_RIGHT)."  RIF/CI:     ".strtoupper($_POST['cedula'])."
Telefono:   ".strtoupper($_POST['telefono'])."
Direccion: ".str_pad(strtoupper(substr($_POST['direccion'],0,71)),71," ",STR_PAD_RIGHT)."
".str_pad(strtoupper(substr($_POST['direccion'],72,82)),71," ",STR_PAD_RIGHT)."";

if (isset($_POST['idagencia']) && isset($_POST['idgrupo']) && isset($_POST['idvendedor']) && isset($_POST['idbanca'])){
$sql = "UPDATE  `agencia` 
SET  `responsable` = '".$_POST['responsable']."',
cedula = '".$_POST['cedula']."',
telefono = '".$_POST['telefono']."',
direccion = '".$_POST['direccion']."'
WHERE  `agencia`.`idagencia` ='".$_POST['idagencia']."'
and idgrupo = '".$_POST['idgrupo']."'
and idvendedor = '".$_POST['idvendedor']."'
and idbanca = '".$_POST['idbanca']."'";

$bita=mysql_query($sql,$link);

for($i=0;$i< $_POST['lineas'];$i++){
  if(isset($_POST['item'.$i])){

    $sql = "UPDATE  `item` SET  `precio` =  '".$_POST['unitario'.$i]."' WHERE  `item`.`serialitem` ='".$_POST['item'.$i]."'";
    $bita=mysql_query($sql,$link);
  }
}
}

$archivo= "factura.txt"; // el nombre de tu archivo

$fch= fopen($archivo, "w"); // Abres el archivo para escribir en él

foreach ($vector as $key ) {
  $contenido = $contenido.$key;
  //fwrite($fch, $key);
  
}
//$contenido = str_pad($contenido,2543," ",STR_PAD_RIGHT);
$contenido = $contenido."
----------------------------------------------------------------------------------
Observaciones:                                                    Sub Total: ".str_pad(number_format(($suma), 2, '.', ''),9," ",STR_PAD_LEFT)."
  ".str_pad(substr($_POST['obs'],0,38),38," ",STR_PAD_RIGHT)."                     Base Imponible: ".str_pad(number_format(($suma), 2, '.', ''),9," ",STR_PAD_LEFT)."
  ".str_pad(substr($_POST['obs'],38,74),38," ",STR_PAD_RIGHT)."                            Iva 12%: ".str_pad(number_format(($suma*0.12), 2, '.', ''),9," ",STR_PAD_LEFT)."
                                                                      Total: ".str_pad(number_format(($suma + ($suma*0.12)), 2, '.', ''),9," ",STR_PAD_LEFT);
fwrite($fch,$contenido ); // Grabas
fclose($fch); // Cierras el archivo.
header('Content-disposition: attachment; filename='.$archivo);
header('Content-type:  text/plain');
readfile($archivo);
?>

