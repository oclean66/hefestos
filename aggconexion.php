<?php 

define('INCLUDE_CHECK',true);
include 'class/formato.php';

include 'class/conexion.php';
include 'class/conexiones.php';
include 'class/tipoconexion.php';
include 'class/modeloconexion.php';
include 'class/operador.php';

$link=Conectar();
$conexion=new conexion($link);

$tipoconexion=new tipoconexion($link);
$lista = $tipoconexion->listar_tipoconexiones();

$modeloconexion=new modeloconexion($link);
$listamodelo = $modeloconexion->listar_modeloconexiones();

$operador=new operador($link);
$listaoperador = $operador->listar_operadores();

//------------------------------------------------

@mysql_free_result($resul);
@mysql_close($vendedor);


echo head();

if( isset($resul) ){
 if($resul==1){

     echo '<script language="JavaScript" type="text/javascript">
     alert(\'Guardado con exito!\');
     document.location="bconexion.php";
     </script>';
 }else  {

     echo '<script language="JavaScript" type="text/javascript">
     alert("'.mysql_errno($link) . ": " . mysql_error($link).'");

     </script>';
 }
}	
?>
<script type="text/javascript">
function envia(){
  var tipocn = document.getElementById('tipoconexions');
  var model = document.getElementById('modeloconexions');
  var opera = document.getElementById('operador');
  var serv = document.getElementById('servicio');
  var fechacom = document.getElementById('inputDate');
  var fechacor = document.getElementById('fechacorte');

  if (tipocn!=null) 
    if (tipocn.value==0) {
      alert("Tiene que seleccionar el tipo de conexion")
      tipocn.focus()
      return 0;
    }
    if (model!=null) 
      if (model.value==0) {
        alert("Tiene que seleccionar el modelo")
        model.focus()
        return 0;
      }
      if (opera!=null) 
        if (opera.value==0) {
          alert("Tiene que seleccionar el operador")
          opera.focus()
          return 0;
        }
        if (serv!=null) 
        if (serv.value==0) {
          alert("Tiene que seleccionar el tipo de servicio")
          serv.focus()
          return 0;
        }
        if (fechacom!=null) 
        if (fechacom.value.length==0) {
          alert("Tiene que seleccionar la fecha de compra")
          fechacom.focus()
          return 0;
        }
        // if (fechacor!=null) 
        // if (fechacor.value==0) {
        //   alert("Tiene que seleccionar el dia de corte de plan")
        //   fechacor.focus()
        //   return 0;
        // }


             // var numeroT = document.getElementsByName('numero[]');
            

             // if(numeroT.length<1)return 0;

             // for (var i=0 ; i < numeroT.length ; i++)
             // {

             //    if (numeroT[i].value.length==0 ){ 
             //     alert("Tiene que escribir el numero de Tlf") 
             //     numeroT[i].focus() 
             //     return 0; 
             //     } 

             // }
      
if (true) {};
      document.form1.submit();
  }



  function runScript(e) {
    if (e.keyCode == 13) {
        var tb = document.getElementById("scriptBox");
        crear(tb);
        document.getElementById("scriptBox").value = '';
        return false;
    }
}

icremento =0;
function crear(obj) {
    if(obj.value !=''){

      icremento++;

      field = document.getElementById('field'); 
      contenedor = document.createElement('div'); 
      contenedor.id = 'div'+icremento; 
      field.insertBefore(contenedor,field.firstChild); 

      boton = document.createElement('Label');
      boton.setAttribute("for",'codigo');
      boton.innerHTML = "ESN/IMEI";
      contenedor.appendChild(boton);


      boton = document.createElement('input'); 
      boton.type = 'text'; 
      boton.name = 'codigo'+'[]'; 
      boton.value = obj.value.trim();
      contenedor.appendChild(boton); 

      boton = document.createElement('Label');
      boton.setAttribute("for",'numero');
      boton.innerHTML = "Numero Tlf";
      contenedor.appendChild(boton);


      boton = document.createElement('input'); 
      boton.type = 'text'; 
      boton.name = 'numero'+'[]'; 
      boton.onkeyup =document.getElementById("numero").onkeyup;
      boton.value = document.getElementById("numero").value.trim();
      contenedor.appendChild(boton); 

       boton = document.createElement('input'); 
      boton.type = 'hidden'; 
      boton.name = 'clavedatos'+'[]'; 
      boton.onkeyup =document.getElementById("clavedatos").onkeyup;
      boton.value = document.getElementById("clavedatos").value.trim();
      contenedor.appendChild(boton); 

       boton = document.createElement('input'); 
      boton.type = 'hidden'; 
      boton.name = 'clavemovil'+'[]'; 
      boton.onkeyup =document.getElementById("clavemovil").onkeyup;
      boton.value = document.getElementById("clavemovil").value.trim();
      contenedor.appendChild(boton); 


boton = document.createElement('input'); 
boton.type = 'button'; 
boton.value = 'Borrar'; 
boton.name = 'div'+icremento; 
boton.onclick = function () {borrar(this.name)} 
contenedor.appendChild(boton); 

obj.value = '';
document.getElementById("clavedatos").value="";
document.getElementById("clavemovil").value="";
document.getElementById("numero").value="";
}

}
function borrar(obj) {
  field = document.getElementById('field'); 
  field.removeChild(document.getElementById(obj)); 
}



</script>

<body><?php  echo menu();  ?>

    <script type="text/javascript" src="selecttipomodel.js"></script>
	<div id='fondo'>
		<div id='wrap'>
			<div id="content">

                <h1>Agregar Nueva Conexion</h1>

                <div class="formQR">

                     <form name="form1" method="POST" action="enviacon.php">
                       <table style="width:100%; background-color:#C5E3FF";>             
                        <tbody>

                            <tr>

                                <td style="border-left: 0px;padding-left: 10px;"> Tipo de Conexion *</td>
                                <td style="padding-left: 10px;"> 
                                   <select style=" width:150px" name="tipoconexions" id="tipoconexions" onChange='cargarModeloconexion(this.id)'>
                                    <option name="sel" id="sel" value="0">Seleccione</option>        
                                    <?php 

                                    while ($fila = mysql_fetch_array($lista)) {
                                       ?>
                                       <option value="<?php  echo $fila[0]; ?>"><?php  echo $fila[1]; ?></option><?php 
                                   }
                                   ?> 
                               </select>
                           </td>
                           <td  style="padding-left: 10px;">  Modelo *   </td>
                           <td  style="padding-left: 10px;"> 
                            <select style=" width:150px" name="modeloconexions" id="modeloconexions" disabled = "disabled">
                                <option name="sel" id="sel" value="0">Seleccione</option>        
                                
                           </select>
                       </td>           
                   </tr> 
                   <tr>

                    <td style="border-left: 0px;padding-left: 10px;"> Operador * </td>
                    <td style="padding-left: 10px;"> 
                        <select style=" width:150px" name="operador" id="operador">
                            <option name="sel" id="sel" value="0">Seleccione</option>        
                            <?php 
                            
                            while ($fila = mysql_fetch_array($listaoperador)) {
                               ?>
                               <option value="<?php  echo $fila[0]; ?>"><?php  echo $fila[1]; ?></option><?php 
                           }
                           ?> 
                       </select>
                   </td>
                   <td  style="padding-left: 10px;"> Tipo de Servicio </td>
                   <td  style="padding-left: 10px;"> 
                       <select style=" width:150px" name="servicio" id="servicio">
                        <option name="sel" id="sel" value="0">Seleccione</option>   
                        <option name="sel" id="sel" value="1">Pre-Pago</option>   
                        <option name="sel" id="sel" value="2">Corporativo</option>      
                        <option name="sel" id="sel" value="3">No Tiene</option>   

                    </select>
                </td>                               
            </tr> 
            <tr>



            </tr>  
            <tr>

                <td style="border-left: 0px;padding-left: 10px;">Fecha de Compra  </td>
                <td style="padding-left: 10px;"> 
                   <input class="inputDate" id="inputDate" name="inputDate" value="<?php  echo date("Y-m-d")?>" /> 
               </td>
               <td style="padding-left: 10px;">Monto de renta 
                   <input class="fechacorte" id="monto" name="monto" style ="width:21px;"  value="" type="text" maxlength = "3"/> Bs
               </td>   
               <td style="padding-left: 10px;">Fecha de corte 
                   <input class="fechacorte" id="fechacorte" name="fechacorte" style ="width:16px;" onkeyup="mascara(this,'-',dia,true)" value="" /> de c/m
               </td>         


           </tr> 
       </tbody>
   </table>
   <div class="row buttons" style="background-color: #A0EEA9; padding-left:10px">


 <td style="border-left: 0px;padding-left: 10px;"> Numero Tlf. </td>
    <td style="border-left: 0px;padding-left: 10px;"> 
        <input name="numero" id="numero" type="text" value="" onkeyup="mascara(this,'-',telefono,true)" >
    </td>
    <td style="border-left: 0px;padding-left: 10px;">Clave Datos  </td>
    <td style="border-left: 0px;padding-left: 10px;"> 
        <input name="clavedatos" id="clavedatos" type="password" class = "clave" value="" style ="width:45px;" 
        onblur="clave(this)" onmouseover="text(this)" onkeypress="text(this)" onmouseout="clave(this)">
    </td>

    <td style="border-left: 0px;padding-left: 10px;">Clave Movilmensaje </td>
    <td style="border-left: 0px;padding-left: 10px;"> 
        <input name="clavemovil" id="clavemovil" type="password" value="" style ="width:45px;" onblur="clave(this)" onkeypress="text(this)" onmouseover="text(this)" onmouseout="clave(this)">
    </td>

    <td style="border-left: 0px;padding-left: 10px;">ESN/IMEI  </td>
    <input id="scriptBox" type="text" onkeypress="return runScript(event)" /> 

     <input type="button" value="Agregar Conexion" onclick="crear(scriptBox)">
     	</div>

     <fieldset id="field" style="padding-left:10px;">   </fieldset> 
     <input type="button" value="Guardar" onclick="envia()">
</form>
</div><!-- form -->	</div>

<div id="sidebar">
	<div class="portlet" id="yw2">
        <div class="portlet-decoration">
            <div class="portlet-title">Operaciones</div>
        </div>
        <div class="portlet-content">
            <ul class="operations" id="yw3">
                <li><a href="conexion.php">Listar Conexiones</a></li>
            </ul></div>
        </div>	</div>



    </div>
</div>


<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/datepicker.js"></script>
<script type="text/javascript" src="js/eye.js"></script>
<script type="text/javascript" src="js/utils.js"></script>
<script type="text/javascript" src="js/layout.js?ver=1.0.2"></script>

</body>
</html>