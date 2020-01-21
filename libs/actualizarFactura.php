<?php  session_start();

include 'class/conexion.php';
$link = Conectar();
echo '
<table style="width:100%; border">             
<tbody >
<tr style="
    height: 100px;
"></tr><tr>
<td style="border-left: 0px;padding-left: 10px;font-size: 15px; color: brown">
Cliente: 
</td>
<td style="padding-left: 10px;font-size: 15px; color: brown">
'.strtoupper($_POST['responsable']).'
</td>
<td style="padding-left: 10px;font-size: 15px; color: brown">
RIF/CI: 
</td>
<td style="padding-left: 10px;font-size: 15px; color: brown"> 
'.strtoupper($_POST['cedula']).'
</td>   
<td style="padding-left: 10px;font-size: 15px; color: brown"> 
--
</td>
<td style="padding-left: 10px;font-size: 15px; color: brown"> 
--
</td>   
</tr>
<tr>
<td style="border-left: 0px;padding-left: 10px; font-size: 15px;color: brown">
Direccion:
</td>
<td style="padding-left: 10px; font-size: 15px;color: brown">
'.strtoupper($_POST['direccion']).'
</td>
<td style="padding-left: 10px;font-size: 15px;color: brown">
Telefono:
</td>
<td style="padding-left: 10px;font-size: 15px; color: brown"> 
'.strtoupper($_POST['telefono']).'
</td>
<td style="padding-left: 10px;font-size: 15px; color: brown"> 
Fecha:
</td>   
<td style="padding-left: 10px;font-size: 15px; color: brown"> 
'.strtoupper($_POST['telefono']).'
</td>        
</tr>
<tr><td colspan="6" style="
    border-top: solid 1px;
"></td></tr>
<tr style="
    height: 10px;
"></tr><tr>
  <td colspan=1>Cant</td>
  <td colspan=3>Descripcion</td>
  <td colspan=1>Precio</td>
  <td colspan=1>Total</td>
</tr>';
$suma = 0;
for($i=0;$i< $_POST['lineas'];$i++){
  if(isset($_POST['item'.$i])){
    echo '<tr>
  <td colspan=1>'.$_POST['num'.$i].'</td>
  <td colspan=3>'.$_POST['itemn'.$i].'</td>
  <td colspan=1>'.$_POST['unitario'.$i].'</td>
  <td colspan=1>'.$_POST['unitario'.$i]*$_POST['num'.$i].'</td>
</tr>';
$suma = $suma + $_POST['unitario'.$i]*$_POST['num'.$i];
  }
}


echo '<tr style="
    height: 88px;
"></tr>
<tr border: 1px; black>
  <td colspan=5 style="border-top: solid black 1px;border-left: solid black 1px;
  border-top: solid black 1px;text-align: right; padding-right: 30px;">SubTotal</td>
  <td colspan=1 style ="border-right: solid black 1px;border-top: solid black 1px;">'.$suma.'</td>
</tr>
<tr>
  <td colspan=5 style="border-left: solid black 1px;text-align: right;padding-right: 30px;">IVA 12%</td>
  <td colspan=1 style ="border-right: solid black 1px;">'.$suma*0.12.'</td>
</tr>
<tr>
  <td colspan=5 style="border-left: solid black 1px;border-bottom: solid black 1px;text-align: right; padding-right: 30px; ">Total</td>
  <td colspan=1 style ="border-right: solid black 1px;border-bottom: solid black 1px;">'.(($suma)+($suma*0.12)).'</td>
</tr>


</tbody>
</table>

';
//echo 'Cliente: '.$_POST['responsable'].'</br>CI/RIF: '.$_POST['cedula'].'</br>Direccion: '.$_POST['direccion'].'</br>Telefono: '.$_POST['telefono'];

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
//echo '</br>'.$sql.'</br>';
//echo $_POST['lineas'];

for($i=0;$i< $_POST['lineas'];$i++){
  if(isset($_POST['item'.$i])){

    $sql = "UPDATE  `item` SET  `precio` =  '".$_POST['unitario'.$i]."' WHERE  `item`.`serialitem` ='".$_POST['item'.$i]."'";
    $bita=mysql_query($sql,$link);

   // echo $_POST['item'.$i].' = '.$_POST['num'.$i].' x '.$_POST['unitario'.$i].'</br>';

  }

  

}
?>

