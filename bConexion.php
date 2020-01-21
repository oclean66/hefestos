<?php  
define('INCLUDE_CHECK', true);
include 'class/formato.php';
include 'class/conexion.php';
include 'class/datosbuscarcon.php';

include 'class/conexiones.php';
$link = Conectar();
$conexion = new conexion($link);


//-----------Captura-Tipo--------------------------------------

if(isset($_GET['st'])){
    $listn = $_GET['st']; 
    $_SESSION['lista']=$listn;
}else $_SESSION['lista']='0';

//-------------------Borrar-conexion-----------------------------
if (isset($_GET['del'])) {
    $eliminarconexion = $conexion->eliminarconexion($_GET['del']);
}
//------------------------------------------------------------
if (isset($_GET['id'])) {

    $cc = $conexion->consultarconexionCompleta($_GET['id']);
}
//------------------------------------------------------------

echo head();
?>
<script type="text/javascript" language="JavaScript">
function checkForm() {
answer = true;
if (siw && siw.selectingSomething)
  answer = false;
return answer;
}//
</script>

<script>
 function runScript(e) {
    if (e.keyCode == 13) {
        var tb = document.getElementById("scriptBox");
        crear(tb);
        document.getElementById("scriptBox").value = '';
        return false;
    }
}
function no(e){
  if (e.keyCode == 13) {
    
    var newobj = document.getElementById("scriptBox").value;

    if (newobj !=''){
      var zz = newobj.split("|");
      
    if (zz.length==5) crear(document.getElementById("scriptBox"))
      else{ alert('No se consigio esa conexion');
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
         document.location.href='bconexion.php?id='+n[0].replace(/^\s*|\s*$/g,"");;;
      
      }
  }
}
var obj;
function cambiar(lugar){
    $("#popUpDiv").hide();

    //Creamos un objeto dependiendo del navegador
    var objeto;
    if (window.XMLHttpRequest)
    {
        //Mozilla, Safari, etc
        objeto = new XMLHttpRequest();
    }
    else if (window.ActiveXObject)
    {
        //Nuestro querido IE
        try {
            objeto = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e) {
            try { //Version mas antigua
                objeto = new ActiveXObject("Microsoft.XMLHTTP");
            }
            catch (e) {

            }
        }
    }
    if (!objeto)
    {
        alert("No ha sido posible crear un objeto de XMLHttpRequest");
    }
    num = lugar;
    if(num==6) var razon=prompt("Por Favor especifique la razon de baja de "+obj,"Harry Potter");

    objeto.open('GET', "cambiar.php?tipo=1&id="+obj+"&lugar="+num+"&razon="+razon+" ", true) // indicamos con el método open la url a cargar de manera asíncrona
    
    //window.open("cambiar.php?tipo=1&id="+obj+"&lugar="+num+"&razon="+razon+" ");
    objeto.send(null) // Enviamos los datos con el metodo send
    alert("Se movio el equipo "+obj);
    document.location.reload(true);
}

function mostrar(id){
    obj = id;
    $("#popUpDiv").show();
    

}
</script>

<body><?php  echo menu(); ?>
    <div id='fondo'>
        <div id='wrap'>
            <div id="content">
                <?php  if (isset($eliminarconexion))
                notificacion($eliminarconexion);
                if (isset($_GET['edit']))
                    notificacion($_GET['edit']);
                ?>
                <?php  echo '<br><h1>Buscar Conexiones en el  sistema</h1>'; ?>
  <div class="form">
<input id="scriptBox" class="wickEnabled" type="text" size="70" onkeypress="return no(event)"/>
<input type="button" value="Buscar" onclick="crear(scriptBox)" >
          

                <table cellpadding="0" cellspacing="0" border="0" class="display" id="tabla_lista_conexiones">
                  <thead>
                    <tr style="text-align:center;">
                      <th class="sorting">id</th> 

                      <th class="sorting">Tipo</th> 
                      <th class="sorting">Modelo</th>
                      <th class="sorting">Numero</th> 
                      <th class="sorting">IMEI / SERIAL</th>

                      <th class="sorting">Operador</th>

                      <th class="sorting">Renta</th>
                      <?php  if($_SESSION['lista']!='a')
                      echo '<th class="sorting">Agencia</th>';
                      else
                         echo'<th class="sorting">Justificacion</th>';

                     ?>



                     <th class="sorting">Accion</th>
                 </tr>
             </thead>

             <tbody>
                <?php 


                while($reg=  mysql_fetch_array($cc))
                {

                  if($reg['fechagregado']){
                    $aux = new DateTime($reg['fechagregado']);
                    $fecha = $aux->format('d-m-Y');
                }
                else $fecha="";

                echo '<tr '; 
                if($reg['idestado']=='5')echo 'style="background-color: rgb(248, 200, 112)"'; 
                if($reg['idestado']=='6')echo 'style="background-color: #F87070"'; 
                if($reg['idestado']=='3')echo 'style="background-color: #6780FF"'; 
                if($reg['idestado']=='4')echo 'style="background-color: #55F123"'; 
                if($reg['idestado']=='1')echo 'style="background-color: #CFCFCF"'; 
                echo 'title="Agregado el '.$fecha.'">';
                echo '<td ><a href="#"> '.mb_convert_encoding($reg['idconexion'], "iso-8859-1").'</a></td>';           
                echo '<td ><a href="conexion.php?st='.$reg['idtipoconexion'].'"> '.mb_convert_encoding($reg['conexionnombre'], "iso-8859-1").'</a></td>';           
                echo '<td ><a href="#"> '.mb_convert_encoding($reg['modelo'], "iso-8859-1").'</a></td>';
                echo '<td ><a href="#"> '.mb_convert_encoding($reg['numero'], "iso-8859-1").'</a></td>';


                echo '<td ><a href="#" > '.mb_convert_encoding($reg['IMEI'], "iso-8859-1").'</a></td>';

                echo '<td ><a href="#"> '.mb_convert_encoding($reg['operadornombre'], "iso-8859-1").'</a></td>';

                if($reg['servicio']=='1')
                    $service='Pre-Pago';
                if($reg['servicio']=='2')
                    $service='Corporativo';
                if($reg['servicio']=='3')
                 $service='No tiene';

             if($reg['fechacompra']){
              $fecha2 = new DateTime($reg['fechacompra']);
              $fechacompra = $fecha2->format('d-m-Y');
          }
          else $fechacompra="";

          echo '<td ><a href="#"> '.mb_convert_encoding($reg['monto'], "iso-8859-1").' Bs los dias '.mb_convert_encoding($reg['diacorte'], "iso-8859-1").' ('.$service.')</a></td>';

          if($_SESSION['lista']!='a') echo '<td ><a href="computador.php?age='.$reg["idagencia"].'&gr='.$reg['idgrupo'].'&ven='.$reg['idvendedor'].'&ban='.$reg['idbanca'].' ">'.mb_convert_encoding($reg['idagencia'], "iso-8859-1").'</a></td>';
          else echo '<td >'.mb_convert_encoding($reg['justificacion'], "iso-8859-1").'</td>';
          echo '<td ><a onClick="return alert(\'Clave Movil Mensajes: '.mb_convert_encoding($reg['clavemovilmensaje'], "iso-8859-1").'\nClave de datos: '.mb_convert_encoding($reg['clavedatos'], "iso-8859-1").'\nFecha de compra: '.$fechacompra.' \nTipo de servicio: '.$service.'\');"  href="#"><span class="nowrap"><img src="./images/b_browse.png" title="Detalles" alt="Detalles" class="icon" width="16" height="16"></span></a>';

          if($reg['idestado']!='5')
            echo '<a href="./editconexion.php?bc=x&reg='.mb_convert_encoding($reg['idconexion'], "iso-8859-1").'"><span class="nowrap"><img src="./images/b_edit.png" title="Editar" alt="Editar" class="icon" width="16" height="16"></span></a>';

        if($reg['idestado']!='5') 
          echo '<a id="baseDiv" href="#" onclick=\'mostrar("'.mb_convert_encoding($reg['idconexion'], "iso-8859-1").'")\'><span class="nowrap"><img src="./images/b_drop.png" class="icon" title="Mover" alt="Mover" width="16" height="16"></span></a>';                      

      if($reg['idestado']=='5') 
          echo '<a onClick="return confirm(\'Seguro quiere recibir este registro?\');" href="computador.php?age='.$reg["idagencia"].'&gr='.$reg['idgrupo'].'&ven='.$reg['idvendedor'].'&ban='.$reg['idbanca'].'&del='.mb_convert_encoding($reg['idcomputador'], "iso-8859-1").'&b='.$reg['idconexion'].'"><span class="nowrap"><img src="./images/recibir.png" title="Recibir" alt="Recibir" class="icon" width="16" height="16"></span></a>'; 

      echo '</td>'; 
      echo '</tr>';

  }
  ?>
  <tbody>
  </table>

</div><!-- form -->	</div>


<div id="sidebar">
    <div class="portlet" id="yw2">
        <div class="portlet-decoration">
            <div class="portlet-title">Operaciones</div>
        </div>
        <div class="portlet-content">
            <ul class="operations" id="yw3">
                <li><a href="aggconexion.php">Agregar</a></li>
                <li><a href="conexion.php">Ver Todas</a></li>
            </ul></div>
        </div>	</div>

    </div>
</div>


<div id="popUpDiv" style="display: none;">
    <div id="cuadro" style="
    width: 318px;

    height: 121px;
    position: absolute;
    left: 35%;
    top: 35%;
    background-color: white;
    ">
    <h4 style="top: 36px;
    left: 47px;
    position: absolute;
    ">Seleccione el nuevo estado del equipo</h4>
    <input id="baseDiv" type="button" onclick="$('#popUpDiv').hide()" value="Cancelar" style="  top: 80%;
    position: absolute;
    left: 40%;">        
    <select id="popupSelect" onchange="cambiar(this.value)">
        <option value="0">Seleccione</option>
        <option value="2">Almacen</option>
        <option value="3">Reparacion</option>
        <option value="4">Robo</option>
        <option value="6">Baja</option>
    </select>
</div>

</div>
</body>
<script type="text/javascript" language="JavaScript" src="js/wick.js"></script> 
<!-- WICK STEP 3: INSERT WICK LOGIC -->
<script>
document.getElementById("wickStatus").innerHTML = 'Se han cargado <b>' + collection.length + '</b> elementos disponibles en almacen 2';
</script>

</html>