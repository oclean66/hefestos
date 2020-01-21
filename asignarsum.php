<?php  
define('INCLUDE_CHECK', true);
include 'class/formato.php';
include 'class/datosum.php';

include 'class/conexion.php';
include 'class/tipoitem.php';
include 'class/banca.php';


//---------------------------Copio-Almacen--------------------------------------------------

//------------------------------------------------------------------------------------------
$link = Conectar(); 

$banca = new banca($link);
$lista = $banca->listar_bancas();
$tipoitem = new tipoitem($link);

$tipos = $tipoitem->listar_tipoitems();
$tipoes=$tipoitem->listar_tipoitems();
$n = mysql_num_rows($tipos);
$i=1;


echo head();


?>

<body style="clear:both;" onload = "document.forms[0]['cantidad'].focus()"><?php  echo menu(); ?>
  <script type="text/javascript" language="JavaScript">
function checkForm() {
answer = true;
if (siw && siw.selectingSomething)
  answer = false;
return answer;
}//
</script>

  <script type="text/javascript" src="selectbvga.js?ver=1.0"></script>

    <script type="text/javascript">
    function envia(){
      var banca = document.getElementById('banca');
      var vend = document.getElementById('vendedor');
      var grupo = document.getElementById('grupo');
      var agencia = document.getElementById('agencia');



      if (banca.selectedIndex==0){
        alert("Debe seleccionar una banca.")
        banca.focus()
        return 0;
      }
      if (vend.selectedIndex==0){
        alert("Debe seleccionar un Receptor.")
        vend.focus()
        return 0;
      }if (grupo.selectedIndex==0){
        alert("Debe seleccionar un Grupo.")
        grupo.focus()
        return 0;
      }if (agencia.selectedIndex==0){
        alert("Debe seleccionar una Agencia.")
        agencia.focus()
        return 0;
      }
     
      

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

function no(e){
  if (e.keyCode == 13) {
    
    var newobj = document.getElementById("scriptBox").value;

    if (newobj !=''){
      var zz = newobj.split("|");
      
    if (zz.length==2) crear(document.getElementById("scriptBox"))
      else{ alert('No se consigio ese Equipo');
    document.getElementById("scriptBox").value = ''
    document.forms[0]['cantidad'].focus();
  }
  }
   
    
    return false;
  }
}
function crear(obj) {
    if(obj.value !=''){
      var n = obj.value.split("|");
      if(n.length==2){
  
  icremento++;
  
  field = document.getElementById('field'); 
  contenedor = document.createElement('div'); 
  contenedor.id = 'div'+icremento; 
  field.insertBefore(contenedor,field.firstChild); 

  boton = document.createElement('Label');
  boton.setAttribute("for",'Codigo');
  boton.innerHTML = "Cantidad";
  contenedor.appendChild(boton);
  
  boton = document.createElement('input'); 
  boton.type = 'text'; 
  boton.name = 'cant'+'[]'; 
  boton.value =  document.forms[0]['cantidad'].value;
  // boton.disabled = 'disabled';
  contenedor.appendChild(boton);
 
  boton = document.createElement('input'); 
  boton.type = 'hidden'; 
  boton.name = 'text'+'[]'; 
  boton.value = n[0].replace(/^\s*|\s*$/g,"");
  // boton.disabled = 'disabled';
  contenedor.appendChild(boton); 

  boton = document.createElement('Label');
  boton.setAttribute("for",'tipo');
  boton.innerHTML = "Suministro";
  contenedor.appendChild(boton);

boton = document.createElement('input'); 
  boton.type = 'text'; 
  boton.name = 'nombre'+'[]'; 
  boton.value = n[1].replace(/^\s*|\s*$/g,"");;
  boton.disabled = 'disabled';
  contenedor.appendChild(boton); 

  
   
  boton = document.createElement('input'); 
  boton.type = 'button'; 
  boton.value = 'Borrar'; 
  boton.name = 'div'+icremento; 
  boton.onclick = function () {
    borrar(this.name)
  } 
  contenedor.appendChild(boton); 
  obj.value = '';
  boton = document.getElementById("Guardar");
  boton.disabled=false;
  document.forms[0]['cantidad'].focus();




}else {
  alert('No se consigio ese Equipo');
  document.getElementById("scriptBox").value = '';
  document.forms[0]['cantidad'].focus();
}
}

}
function borrar(obj) {
  field = document.getElementById('field'); 
  field.removeChild(document.getElementById(obj)); 
}
 


</script>
<div id='fondo'>
    <div id='wrap'>
        <div id="content2">

            <h1>Asignar Suministros a Cliente</h1>
            

            <div class="formQR">

                <form name="form1" method="POST" action="guardarsum.php">
                  
                 
                  <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tbody>
                      <tr style="background-color: #C5E3FF;" >
                        <td>
                          <label for="proveedor" class="required">&nbsp;&nbsp;Codigo Banca: <span class="required">*</span></label> 
                          <select style=" width:150px" name="banca" id="banca" onChange='cargarVendedor(this.id)'>
                            <option name="sel" id="sel" value="0">Seleccione</option>        
                            <?php 
                            
                            while ($fila = mysql_fetch_array($lista)) {
                             ?>
                            <option value="<?php  echo $fila['idbanca']; ?>"><?php  echo $fila['idbanca'] . ' - ' . $fila['nombre']; ?></option><?php 
                                }
                            ?> 
                        </select>
                        </td>


                        <td>
                          <label for="agencia_codigo" class="required">&nbsp;&nbsp;Codigo Receptor <span class="required">*</span></label>
                            <select disabled="disabled" style=" width:150px" name="vendedor" id="vendedor">
                            <option value="0">Seleccione</option>
                            </select> 
                        </td>
                      </tr><tr style="background-color: #C5E3FF;" >
                        <td>
                          <label for="agencia_codigo" class="required">&nbsp;&nbsp;Codigo Grupo <span class="required">*</span></label>
                            <select disabled="disabled" style=" width:150px" name="grupo" id="grupo">
                            <option value="0">Seleccione</option>
                            </select>
                        </td>

                        <td>
                           <label for="agencia_codigo" class="required">&nbsp;&nbsp;Codigo Agencia <span class="required">*</span></label>
                            <select disabled="disabled" style=" width:150px" name="agencia" id="agencia">
                            <option value="0">Seleccione</option>
                            </select>
                        </td>

                          </tr>
                          
                        </tbody></table>
                        
                   
                    <label for="item_codigo" class="required">Cantidad <span class="required">*</span></label> 
                     
                    <input id="cantidad" class="cantidad" type="text" size="2" onkeypress="if (e.keyCode == 13)document.forms[0]['scriptBox'].focus()"/>
                    <label for="item_codigo" class="required">Codigo <span class="required">*</span></label> 
                    <input id="scriptBox" class="wickEnabled" type="text" size="70" onkeypress="return no(event)"/>


                   

                    <input type="button" value="Agregar Equipo" onclick="crear(scriptBox)" ><div id="wickStatus" ></div>

                    <fieldset id="field" style="padding-left:10px;">   </fieldset> 

                    <input type="button" value="Guardar" id='Guardar' disabled='disabled' onclick="envia()">
                </form>
            </div><!-- form --> </div>

            
                </div>
            </div>



<?php 
@mysql_free_result($tipos);
@mysql_free_result($tipoes);
@mysql_close($tipoitem); 
?>

</body>
<script type="text/javascript" language="JavaScript" src="js/wick.js"></script> 
<!-- WICK STEP 3: INSERT WICK LOGIC -->
<script>
document.getElementById("wickStatus").innerHTML = 'Se han cargado <b>' + collection.length + '</b> elementos disponibles';
</script>
</html>