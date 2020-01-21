<?php 
define('INCLUDE_CHECK', true);
include 'class/formato.php';

include 'class/conexion.php';
include 'class/tipoitem.php';
include 'class/modelo.php';

//---------------------------Copio-Almacen--------------------------------------------------
$almacen =2;


if(isset($_GET['almacen'])){
  $almacen =$_GET['almacen'];

}else{
  echo '<script language="JavaScript" type="text/javascript">
  document.location = "home.php";
  </script>';
}
//------------------------------------------------------------------------------------------
$link = Conectar();
$tipoitem = new tipoitem($link);
$nfactura=  mysql_query("SELECT idfactura from factura where idfactura like 'SF%' order by idfactura desc limit 1",$link);
$numfac = mysql_fetch_array($nfactura);
if (!$numfac[0]) {
 $serieFactura = 'SF1';
}else{
  $serieFactura =  'SF'.(trim($numfac[0], 'SF')+1);
} 


$model = new modelo($link);
$tipos = $tipoitem->listar_tipoitems();
$tipoes=$tipoitem->listar_tipoitems();
$modelo = $model->listar_modelos(); //para php
$modelos=$model->listar_modelos(); //para js


$n = mysql_num_rows($tipos);
$m = mysql_num_rows($modelos);
$i=1;
$j=1;
echo head();

echo '<script type="text/javascript">
var z ='.$n.'
var myarray=new Array('.$n.')
myarray[0]  = "Seleccione"

var mynum=new Array('.$n.')
mynum[0]  = "Seleccione"
';
while ($tipe = mysql_fetch_array($tipos)) {
  echo 'myarray['.$i.']  = "'.$tipe['tipo'].'"
  ';
  echo 'mynum['.$i.']  = "'.$tipe['idtipoitem'].'"
  ';

  $i++;
};
echo "</script>";

echo '<script type="text/javascript">
var y ='.$m.'
var modelarray=new Array('.$m.')
modelarray[0]  = "Seleccione"

var myidmodel=new Array('.$m.')
myidmodel[0]  = "Seleccione"

idtipo=new Array('.$m.')
idtipo[0]  = "0"
';
while ($models = mysql_fetch_array($modelos)) {
  echo 'modelarray['.$j.']  = "'.$models['nombremodel'].'"
  ';
  echo 'myidmodel['.$j.']  = "'.$models['idmodelo'].'"
  ';
  echo 'idtipo['.$j.']  = "'.$models['idtipoitem'].'"
  ';

  $j++;
};
echo "</script>";



if (isset($resul)) {
  if ($resul == 1) {

    echo '<script language="JavaScript" type="text/javascript">
    alert(\'Guardado con exito!\');
    document.location="grupo.php";
    </script>';
  } else {

    echo '<script language="JavaScript" type="text/javascript">
    alert("' . mysql_errno($link) . ": " . mysql_error($link) . '");
    
    </script>';
  }
}
?>

<body style="clear:both;" onload = "document.forms[0]['scriptBox'].focus()"><?php  echo menu(); ?>
  <script type="text/javascript" src="selecttipomodel.js"></script>


  <script type="text/javascript">
  function envia(){
    var pro = document.getElementById('proveedor');
    var fac = document.getElementById('factura');
    var fec = document.getElementById('fecha');

    if (pro!=null) 
      if (pro.value.length==0) {
       alert("Tiene que escribir el proveedor")
       pro.focus()
       return 0;
     }
     if (fac!=null) 
       if (fac.value.length == 0 || /^\s+$/.test(fac.value)) {
        
         alert("Tiene que escribir el Nº Factura")
         fac.focus()
         return 0;
       }
       if (fec!=null) 
         if (fec.value.length==0) {
           alert("Tiene que escribir la Fecha")
           fec.focus()
           return 0;
         }
         

         var mod = document.getElementsByName('selectmodel[]');
         var tip = document.getElementsByName('select[]');

         if(mod.length<1)return 0;

         for (var i=0 ; i < mod.length ; i++)
         {
          
          if (mod[i].selectedIndex==0){ 
           alert("Tiene que escribir el Modelo") 
           mod[i].focus() 
           return 0; 
         } 

            //valido el interés
            if (tip[i].selectedIndex==0){
              alert("Debe seleccionar un tipo de equipo.")
              tip[i].focus()
              return 0;
            }
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
        function crear(obj) {
          if(obj.value !=''){
            
            icremento++;
            
            field = document.getElementById('field'); 
            contenedor = document.createElement('div'); 
            contenedor.id = 'div'+icremento; 
            field.insertBefore(contenedor,field.firstChild); 

            boton = document.createElement('Label');
            boton.setAttribute("for",'modelo');
            boton.innerHTML = "Codigo";
            contenedor.appendChild(boton);

            
            boton = document.createElement('input'); 
            boton.type = 'text'; 
            boton.name = 'text'+'[]'; 
            boton.value = obj.value.trim();
  // boton.disabled = 'disabled';
  contenedor.appendChild(boton); 

  var m = document.getElementById("modelo");
  var strMod = m.options[m.selectedIndex].value;

  var e = document.getElementById("tipoitem");
  var strUser = e.options[e.selectedIndex].value;

  boton = document.createElement('Label');
  boton.setAttribute("for",'tipo');
  boton.innerHTML = " Tipo * ";
  contenedor.appendChild(boton); 


  boton = document.createElement('select'); 
  boton.type = 'text'; 
  boton.style.width = '150';
  boton.onchange = m.onchange;
  boton.name = 'select'+'[]'; 
  for (i=0; i<=z; i++) {
    opt = document.createElement('option');
    opt.value = mynum[i];
    if (e.selectedIndex == i)
      opt.selected = 'selected'
    opt.innerHTML = myarray[i];
    boton.appendChild(opt);
  }
  contenedor.appendChild(boton); 

  boton = document.createElement('Label');
  boton.setAttribute("for",'modelo');
  boton.innerHTML = "Modelo * ";
  contenedor.appendChild(boton);


  boton = document.createElement('select'); 
  boton.type = 'text'; 
  boton.style.width = '150';
  boton.name = 'selectmodel'+'[]'; 
  opt = document.createElement('option');
  opt.value = 0;
  
  opt.innerHTML = "Seleccione";
  boton.appendChild(opt);

  for (i=0; i<=y; i++) {
    
    if (idtipo[i]==e.options[e.selectedIndex].value) {
      opt = document.createElement('option');
      opt.value = myidmodel[i];
      if (m.options[m.selectedIndex].value == myidmodel[i]){
        opt.selected = 'selected';

      }
      opt.innerHTML = modelarray[i];
      boton.appendChild(opt);
    };
  }
  contenedor.appendChild(boton); 

  
  
  boton = document.createElement('input'); 
  boton.type = 'button'; 
  boton.value = 'Borrar'; 
  boton.name = 'div'+icremento; 
  boton.onclick = function () {borrar(this.name)} 
  contenedor.appendChild(boton); 
  obj.value = '';
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

      <h1>Agregar Nuevos Equipos</h1>

      <div class="formQR">

        <form name="form1" method="POST" action="save.php?tipo=<?php  echo $almacen;?>">
          <?php  if ($almacen==1){ ?>
          <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tbody>
              <tr style="background-color: #C5E3FF;" >
                <td>
                  <label for="proveedor" class="required">&nbsp;&nbsp;Proveedor: <span class="required">*</span></label> 
                  <input id="proveedor" name="proveedor" type="text"  />
                </td>
                <td><label for="factura" class="required">&nbsp;&nbsp;Num. Factura: <span class="required">*</span></label> 
                  <input id="factura" name="factura" type="text" value="<?php  echo $serieFactura; ?>" /> </td>
                  <td><label for="fecha" class="required">&nbsp;&nbsp; Fecha: <span class="required">*</span></label> 
                    <input class="inputDate" id="inputDate" name="inputDate" value="<?php  echo date("Y-m-d")?>" />  </td>
                  </tr>
                  
                </tbody></table>
                <?php  }?>
                
                <label for="item_codigo" class="required">Codigo <span class="required">*</span></label> 
                <input id="scriptBox" type="text" onkeypress="return runScript(event)" /> 
                <label for="item_modelo" class="required">Tipo Equipo <span class="required">*</span></label> 
                <select style=" width:150px" name="tipoitem" id="tipoitem" onchange ="cargarModeloconexion(this.id)">
                  
                  <option name="sel" id="sel" value="0">Seleccione</option>        
                  <?php 
                  
                  while ($modelos = mysql_fetch_array($tipoes)) {
                   ?>
                   <option value="<?php  echo $modelos[0]; ?>"><?php  echo  $modelos[1]; ?></option><?php 
                 }
                 ?> 
               </select>
               <label for="item_tipo" class="required">Modelo <span class="required">*</span></label> 
               <div style="display: initial;">
                 <select style=" width:150px" name="modelo" id="modelo" disabled="disabled">
                  
                  <option name="sel" id="sel" value="0">Seleccione</option>        
                  
                </select>
              </div>

              <input type="button" value="Agregar" onclick="crear(scriptBox)">

              <fieldset id="field" style="padding-left:10px;">   </fieldset> 

              <input type="button" value="Enviar" onclick="envia()">
            </form>
          </div><!-- form -->	</div>

          
        </div>
      </div>


      <?php 
      @mysql_free_result($tipos);
      @mysql_free_result($tipoes);
      @mysql_close($tipoitem); 
      ?>
      <script type="text/javascript" src="js/jquery.js"></script>
      <script type="text/javascript" src="js/datepicker.js"></script>
      <script type="text/javascript" src="js/eye.js"></script>
      <script type="text/javascript" src="js/utils.js"></script>
      <script type="text/javascript" src="js/layout.js?ver=1.0.2"></script>
    </body>
    </html>