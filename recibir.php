<?php 
define('INCLUDE_CHECK', true);
include 'class/formato.php';
include 'class/datosEntrada.php';

include 'class/conexion.php';
include 'class/tipoitem.php';
include 'class/banca.php';


//---------------------------Copio-Almacen--------------------------------------------------

//------------------------------------------------------------------------------------------
$link = Conectar();

echo head();


?>

<body style="clear:both;" onload = "document.forms[0]['scriptBox'].focus()"><?php  echo menu(); ?>
  <script type="text/javascript" language="JavaScript">
  function checkForm() {
    answer = true;
    if (siw && siw.selectingSomething)
      answer = false;
    return answer;
}//
</script>

<script type="text/javascript" src="selectbvga.js"></script>

<script type="text/javascript">
function envia(){   


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
      
      if (zz.length==5) crear(document.getElementById("scriptBox"))
        else{ alert('No se consigio ese Equipo');
      document.getElementById("scriptBox").value = ''
      document.forms[0]['scriptBox'].focus();
    }
  }


  return false;
}
}
function crear(obj) {
  if(obj.value !=''){
    var n = obj.value.split("|");
    if(n.length==5){

      icremento++;

      field = document.getElementById('field'); 
      contenedor = document.createElement('div'); 
      contenedor.id = 'div'+icremento; 
      field.insertBefore(contenedor,field.firstChild); 

      boton = document.createElement('Label');
      boton.setAttribute("for",'Codigo');
      boton.innerHTML = "Codigo";
      contenedor.appendChild(boton);


      boton = document.createElement('input'); 
      boton.type = 'text'; 
      boton.name = 'text'+'[]'; 
      boton.value = n[0].replace(/^\s*|\s*$/g,"");;
      boton.disabled = 'disabled';
      contenedor.appendChild(boton); 

      boton = document.createElement('input'); 
      boton.type = 'hidden'; 
      boton.name = 'iditem'+'[]'; 
      boton.value = n[0].replace(/^\s*|\s*$/g,"");;
      contenedor.appendChild(boton);


      boton = document.createElement('Label');
      boton.setAttribute("for",'tipo');
      boton.innerHTML = "Tipo";
      contenedor.appendChild(boton);

      boton = document.createElement('input'); 
      boton.type = 'text'; 
      boton.name = 'nombre'+'[]'; 
      boton.value = n[1].replace(/^\s*|\s*$/g,"");;
      boton.disabled = 'disabled';
      contenedor.appendChild(boton); 

      boton = document.createElement('Label');
      boton.setAttribute("for",'tipo');
      boton.innerHTML = "Agencia";
      contenedor.appendChild(boton);

      boton = document.createElement('input'); 
      boton.type = 'text'; 
      boton.name = 'Agencia'+'[]'; 
      boton.value = n[3].replace(/^\s*|\s*$/g,"");;
      boton.disabled = 'disabled';
      contenedor.appendChild(boton); 

      boton = document.createElement('input'); 
      boton.type = 'hidden'; 
      boton.name = 'id'+'[]'; 
      boton.value = n[4].replace(/^\s*|\s*$/g,"");
      contenedor.appendChild(boton); 

      

  var e = document.getElementById("statusitem");
  var strUser = e.options[e.selectedIndex].text;

  boton = document.createElement('Label');
  boton.setAttribute("for",'estado');
  boton.id = 'labelst'; 
  if(e.selectedIndex ==1)boton.setAttribute("style",'color:red');
  else boton.setAttribute("style",'color:blue');
  boton.innerHTML = 'Estado';
  contenedor.appendChild(boton); 

     
  boton = document.createElement('select'); 
  boton.type = 'text'; 
  boton.style.width = '150';
  boton.name = 'selectstatus'+'[]'; 
      opt = document.createElement('option');
      opt.value = "2";
      if(e.options[e.selectedIndex].value == 2)
      opt.selected = 'selected'
      opt.innerHTML ="Buen estado";
  boton.appendChild(opt);
  opt = document.createElement('option');
      opt.value = "3";
       if(e.options[e.selectedIndex].value == 3)
      opt.selected = 'selected'
      opt.innerHTML ="Por Reparar";
  boton.appendChild(opt);
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
      document.forms[0]['scriptBox'].focus();


    }else {
      alert('No se consigio ese Equipo');
      document.getElementById("scriptBox").value = '';
      document.forms[0]['scriptBox'].focus();
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

      <h1>Recibir Equipos a Cliente</h1>


      <div class="formQR">

        <form name="form1" method="POST" action="recibe.php">





          <label for="item_codigo" class="required">Codigo <span class="required">*</span></label> 


          <input id="scriptBox" class="wickEnabled" type="text" size="70" onkeypress="return no(event)"/>
 <label for="item_codigo" class="required">Estado del Equipo <span class="required">*</span></label> 
         
          <select style=" width:150px" name="statusitem" id="statusitem" onChange="document.forms[0]['scriptBox'].focus()">
            <option name="sel" id="sel" value="2">Buen estado</option>
            <option name="sel" id="sel" value="3">Por Reparar</option>  
                    

          </select>


          <input type="button" value="Agregar Equipo" onclick="crear(scriptBox)" ><div id="wickStatus" ></div>

          <fieldset id="field" style="padding-left:10px;">   </fieldset> 

          <input type="button" value="Recibir" onclick="envia()">
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
document.getElementById("wickStatus").innerHTML = 'Se han cargado <b>' + collection.length + '</b> elementos pendientes por recibir';
</script>
</html>