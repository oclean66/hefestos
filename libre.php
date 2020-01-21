<script type="text/javascript">

function runScript(e) {
  if (e.keyCode == 13) {
    var tb = document.getElementById("cantidad");
    crear(document.getElementById("cantidad"),document.getElementById("descripcion"),document.getElementById("precio"));
    document.getElementById("cantidad").value = '';
    document.getElementById("descripcion").value = '';
    document.getElementById("precio").value = '';
    document.forms[0]['cantidad'].focus();
   
    return false;
  }
}

icremento =0;
function crear(obj,obj1,obj2) {
  if(obj.value !=''){



    field = document.getElementById('field'); 
    contenedor = document.createElement('div'); 
    contenedor.id = 'div'+icremento; 
    field.insertBefore(contenedor,field.firstChild); 

    boton = document.createElement('Label');
    boton.setAttribute("for",'Cantidad');
    boton.innerHTML = "Cantidad";
    contenedor.appendChild(boton);


    boton = document.createElement('input'); 
    boton.type = 'text'; 
    boton.id = 'cant'+icremento; 
    boton.name = 'num'+icremento; 
    boton.onkeyup = function(){Sumar();};
    boton.value = obj.value.trim();
  // boton.disabled = 'disabled';
  contenedor.appendChild(boton); 

  

  boton = document.createElement('Label');
  boton.setAttribute("for",'Descripcion');
  boton.innerHTML = " Descripcion ";
  contenedor.appendChild(boton); 

  boton = document.createElement('input'); 
  boton.type = 'text'; 
  boton.name = 'itemn'+icremento; 
  boton.id = 'itemn'+icremento;
  boton.value = obj1.value.trim();
  // boton.disabled = 'disabled';
  contenedor.appendChild(boton); 



  boton = document.createElement('Label');
  boton.setAttribute("for",'Precio Unitario');
  boton.innerHTML = "Precio Unitario";
  contenedor.appendChild(boton);

  boton = document.createElement('input'); 
  boton.type = 'text'; 
  boton.id = 'unitario'+icremento; 
  boton.name = 'unitario'+icremento; 
  boton.value = obj2.value.trim();
  boton.onkeyup = function(){Sumar();};
  // boton.disabled = 'disabled';
  contenedor.appendChild(boton); 

  boton = document.createElement('Label');
  boton.setAttribute("for",'Precio Total');
  boton.innerHTML = "Precio Total";
  contenedor.appendChild(boton);

  boton = document.createElement('input'); 
  boton.type = 'text'; 
  boton.id = 'precio'+icremento; 
  boton.name = 'precio'+icremento; 

  boton.value = (obj2.value.trim()) *  parseFloat(obj.value.trim());
  // boton.disabled = 'disabled';
  contenedor.appendChild(boton);




  

  boton = document.createElement('button'); 
  boton.type = 'button';
  var iner= '<img src="images/b_drop.png" alt="" onclick="borrar(\'div'+icremento+'\')">'
  boton.innerHTML = iner;

  contenedor.appendChild(boton); 

  obj.value = '';obj1.value = '';obj2.value = '';
  document.forms[0]['cantidad'].focus();
  icremento++;
  
}
 Sumar();
}
function borrar(obj) {
  field = document.getElementById('field'); 
  field.removeChild(document.getElementById(obj));
  Sumar(); 

}
function enviar(){  
  document.form1.submit();
}


function Sumar() {
 document.getElementById("lineas").value = parseInt(document.getElementById("lineas").value)+ parseInt(1);


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

<body ><?php  echo menu(); ?>
  <div id='fondo'>
    <div id='wrap'>
      <div id="content">

        <h1>Edicion de Factura</h1>
        <div class="formQR">
          <form name="form1" method="POST" action="actualizarFactura.php" >



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
    </tr><tr></tr>
  </tbody>
</table>
</br>
<table style="width:100%; background-color:#C5E3FF";>             
  <tbody id="srtabla">


    <!---//------------------------>

  <label for="item_codigo" class="required">Cantidad <span class="required">*</span></label> 
  <input id="cantidad" type="text"  /> 
  <label for="item_modelo" class="required">Descripcion (Cod) <span class="required">*</span></label> 
  <input id="descripcion" type="text"  />
  <label for="item_tipo" class="required">Precio Unitario <span class="required">*</span></label> 
  <input id="precio" type="text" onkeypress="return runScript(event)" />
  <div style="display: initial;">

  </div>
  <input type="button" value="Agregar" onclick="crear(cantidad,descripcion,precio)">
  <fieldset id="field" style="padding-left:10px;">   </fieldset> 
  <tr><td colspan = "4"> </td></tr>

  



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
</table>
<input type="hidden" id="lineas" name = "lineas" value="0"></input>
</form>


<input type="button" id = "save" name="save" value="Guardar" onclick="enviar()">
</div><!-- form -->	
</div>
</div>
</div>
</body>
</html>