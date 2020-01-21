<script type="text/javascript">

function enviar(){  
  document.form1.submit();
}

function borrar(obj) {
  field = document.getElementById('srtabla'); 
  field.removeChild(document.getElementById(obj)); 
  Sumar();

}
function Sumar() {
  i = document.getElementById('lineas').value;   
  sb = document.getElementById('sb'); 
  sb.innerHTML = 0;
  for(x=0;x<i;x++){

   field = document.getElementById('precio'+x); 
   if(field!=null){
     field.value =parseFloat(document.getElementById('unitario'+x).value) *   parseFloat(document.getElementById('cant'+x).value);


     sb.innerHTML=   parseFloat(sb.innerHTML) + parseFloat(document.getElementById('precio'+x).value);
   }

 }
 iva = document.getElementById('iva'); 
 iva.innerHTML=(sb.innerHTML*0.12).toFixed(2);

 t = document.getElementById('t'); 
 t.innerHTML=(parseFloat(sb.innerHTML)+parseFloat(iva.innerHTML)).toFixed(2);

}  

</script>
<?php  
define('INCLUDE_CHECK', true);
include 'class/formato.php';
include 'class/conexion.php';
include 'class/computador.php';

$link = Conectar();
$computador = new computador($link);


//----------------------Consulta-Ticket------------------------------------//

if (isset($_GET['reg']) ) {

  $resulreg = $computador->consultarTicket($_GET['reg']);
  $nombres = $computador->consultarTicket($_GET['reg']);
  $nm=  mysql_fetch_array($nombres);

}

//-----------------------------------------------------------------------//

@mysql_free_result($resul);
@mysql_close($computador);


echo head();
?>

<script type="text/javascript" src="selectbvga.js"></script>

<body onload="Sumar()" ><?php  echo menu(); ?>
  <div id='fondo'>
    <div id='wrap'>
      <div id="content">

        <h1>Edicion de Factura</h1>
        <?php  echo $nm['agenombre'].' > '.$nm['grnombre'].' > '.$nm['vennombre'].' > '.$nm['bannombre'].' > Fecha Prestamo: '.$nm['fechaprestamo'];?>
        <div class="form">
          <form name="form1" method="POST" action="testactualizarFactura.php" >

            <input type="hidden" id="idagencia" name = "idagencia" value="<?php  echo $nm['idage']?>"></input>
            <input type="hidden" id="idgrupo" name = "idgrupo" value="<?php  echo $nm['idgr']?>"></input>
            <input type="hidden" id="idvendedor" name = "idvendedor" value="<?php  echo $nm['idven']?>"></input>
            <input type="hidden" id="idbanca" name = "idbanca" value="<?php  echo $nm['idban']?>"></input>


            <table style="width:100%; background-color:#C5E3FF; border">             
              <tbody >
               <tr>

                <td style="border-left: 0px;padding-left: 10px;font-size: 15px; color: brown">
                 Fecha: 
               </td>
               <td style="padding-left: 10px;font-size: 15px; color: brown">
                <input class="" id="date" name="date" style="width: 435px;" value="<?php  echo date("d / m / Y");?>">

              </td><td style="border-left: 0px;padding-left: 10px;font-size: 15px; color: brown">
              Numero de Control: 
            </td>
            <td style="border-left: 0px;padding-left: 10px;font-size: 15px; color: brown">               
              <input class="" id="factura" name="factura" style="width: 100px;" value="">
            </td>


          </tr>

          <tr>

            <td style="border-left: 0px;padding-left: 10px;font-size: 15px; color: brown">
             Cliente: 
           </td>
           <td style="padding-left: 10px;font-size: 15px; color: brown">
            <input class="" id="" name="responsable" style="width: 435px;" value="<?php  echo $nm['responsable'];?>">
          </td>
          <td style="padding-left: 10px;font-size: 15px; color: brown">
            RIF/CI: 
          </td>
          <td style="padding-left: 10px;font-size: 15px; color: brown"> 
            <input class="" id="" name="cedula" value="<?php  echo $nm['cedula'];?>">

          </td>      

        </tr>

        <tr>

          <td style="border-left: 0px;padding-left: 10px; font-size: 15px;color: brown">
           Direccion:
         </td>
         <td style="padding-left: 10px; font-size: 15px;color: brown">
          <input class="" id="" name="direccion" style="width: 435px;" value="<?php  echo $nm['direccion'];?>">

        </td>
        <td style="padding-left: 10px;font-size: 15px;color: brown">
         Telefono:
       </td>
       <td style="padding-left: 10px;font-size: 15px; color: brown"> 
        <input class="" id="" name="telefono"  value="<?php  echo $nm['telefono'];?>">
      </td>           
    </tr>


    <tr></tr>
  </tbody>
</table>
</br>
<table style="width:100%; background-color:#C5E3FF";>             
  <tbody id="srtabla">


    <!---//------------------------>

    <tr>

      <td style="border-left: 0px;padding-left: 10px; background-color: rgb(68, 68, 68); color: white">
        Cant.
      </td>
      <td style="padding-left: 10px;background-color: rgb(68, 68, 68); color: white">
       Descripcion
     </td>
     <td style="padding-left: 10px;background-color: rgb(68, 68, 68); color: white">
       Precio Unitario
     </td>
     <td style="padding-left: 10px;background-color: rgb(68, 68, 68); color: white"> 
      Precio Total   
    </td>          
    <td style="padding-left: 10px;background-color: rgb(68, 68, 68); color: white"> 

    </td>    
  </tr>
  <?php  
  $i=0;
  while($reg=  mysql_fetch_array($resulreg))
  {
    ?>

    <tr id ="<?php  echo $reg[0]?>" >
      <input type="hidden" id="item<?php  echo $i?>" name = "item<?php  echo $i?>" value="<?php  echo $reg[0]; ?>"></input>
      <td style="border-left: 0px;padding-left: 10px;">
        <input type="number" id = "cant<?php  echo $i?>" name="num<?php  echo $i?>" min="0" max="99" value= "1" onclick = "Sumar()">
      </td>
      <input type="hidden" id="itemn<?php  echo $i?>" name = "itemn<?php  echo $i?>" value="<?php  echo $reg[1]." ".$reg[2].' (Cod. '.$reg[0].')'; ?>"></input>
      <td style="padding-left: 10px;"><?php  echo $reg[1]." ".$reg[2].' (Cod. '.$reg[0].')'; ?></td>
      <td style="padding-left: 10px;">
        <input class="" id="unitario<?php  echo $i?>" name="unitario<?php  echo $i?>" value="<?php  echo $reg['precio']?>"  onkeyup="Sumar();" onBlur="Sumar();"> Bs.</td>
        <td style="padding-left: 10px;">
          <input disabled class="" id="precio<?php  echo $i?>" name="precio<?php  echo $i?>" value="0" > Bs.</td>  

          <td style="padding-left: 10px;">
            <button><img src="images/b_drop.png" alt="" onclick="borrar('<?php  echo $reg[0]?>')"></button>
          </td>  


        </tr> 
        <?php  
        $i++;
      }
      ?>

      <tr>

        <td colspan="2" style="text-align: right;border-left: 0px;padding-right: 10px; background-color: rgb(68, 68, 68);color:white; ">OBSERVACIONES</td>
        <td colspan="1" style="text-align: right;border-left: 0px;padding-right: 10px; background-color: rgb(68, 68, 68);color:white; "> Sub-Total </td>
        <td colspan="2" style="padding-left: 10px; background-color: rgb(68, 68, 68);color:white;">
         <span id="sb">0</span>
       </tr> 
       <tr>

        <td colspan="2" rowspan="2" style="text-align: right;border-left: 0px;padding-right: 10px; background-color: rgb(68, 68, 68);color:white; ">
          <input autocomplete="off" type="text" id="obs" name="obs" value="" style="padding: 0;margin: 0;width: 427px; height: 32px;">
        </td>
        <td colspan="1" style="text-align: right;border-left: 0px;padding-right: 10px; background-color: rgb(68, 68, 68);color:white; "> IVA 12% </td>
        <td colspan="2" style="padding-left: 10px; background-color: rgb(68, 68, 68);color:white;">
         <span id="iva">0</span>
       </tr> 
       <tr>
        <td colspan="1" style="text-align: right;border-left: 0px;padding-right: 10px; background-color: rgb(68, 68, 68);color:white; ">TOTAL </td>
        <td colspan="2" style="padding-left: 10px; background-color: rgb(68, 68, 68);color:white;">
          <span id="t">0</span>

        </tr> 
      </tbody>
    </table><input type="hidden" id="lineas" name = "lineas" value="<?php  echo $i?>"></input>
  </form>


  <input type="button" id = "save" name="save" value="Guardar" onclick="enviar()">
</div><!-- form -->	
</div>
</div>
</div>
</body>
</html>