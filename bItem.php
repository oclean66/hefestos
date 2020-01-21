<?php   
define('INCLUDE_CHECK', true);
include 'class/formato.php';
include 'class/conexion.php';
include 'class/datosBuscarItem.php';

include 'class/item.php';
$link = Conectar();
$item = new item($link);


//-----------Captura-Tipo--------------------------------------

if(isset($_GET['st'])){
  $listn = $_GET['st']; 
  $_SESSION['lista']=$listn;
}else $_SESSION['lista']='0';

//-------------------Borrar-conexion-----------------------------
if (isset($_GET['del'])) {
  $eliminarconexion = $item->eliminarconexion($_GET['del']);
}
//------------------------------------------------------------
if (isset($_GET['id'])) {

  $cc = $item->consultaritemcompleto($_GET['id']);
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
      
      if (zz.length==3) crear(document.getElementById("scriptBox"))
        else{ alert('No se consigio ese item');
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
    if(n.length==3){
     document.location.href='bitem.php?id='+n[0].replace(/^\s*|\s*$/g,"");;;

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

    objeto.open('GET', "cambiar.php?id="+obj+"&lugar="+num+"&razon="+razon+" ", true) // indicamos con el método open la url a cargar de manera asíncrona
    objeto.send(null) // Enviamos los datos con el metodo send
    alert("Se movio el equipo "+obj);
    document.location.reload(true);
  }

  function mostrar(id){
    obj = id;
    $("#popUpDiv").show();
    

  }
  </script>

  <body><?php    echo menu(); ?>
    <div id='fondo'>
      <div id='wrap'>
        <div id="content">
          <?php    if (isset($eliminarconexion))
                notificacion($eliminarconexion);
                if (isset($_GET['edit']))
                    notificacion($_GET['edit']);
                ?>

          <?php    echo '<br><h1>Buscar Equipos en el  sistema</h1>'; ?>
          <div class="form">
            <input id="scriptBox" class="wickEnabled" type="text" size="70" onkeypress="return no(event)"/>
            <input type="button" value="Buscar" onclick="crear(scriptBox)" >
            <table cellpadding="0" cellspacing="0" border="0" class="display" id="tabla_lista_conexiones">
              <thead>
                <tr style="text-align:center;">
                  <th class="sorting">Serial</th> 
                  <th class="sorting">Tipo</th>
                  <th class="sorting">Modelo</th> 
                  <th class="sorting">Estado</th>
                  <th class="sorting">Agencia</th>
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
                  echo '<td ><a href="#"> '.mb_convert_encoding($reg['serialitem'], "iso-8859-1").'</a></td>';           
                  echo '<td ><a href="#"> '.mb_convert_encoding($reg['tipo'], "iso-8859-1").'</a></td>';           
                  echo '<td ><a href="#"> '.mb_convert_encoding($reg['nombremodel'], "iso-8859-1").'</a></td>';
                  echo '<td ><a href="#"> '.mb_convert_encoding($reg['status'], "iso-8859-1").'</a></td>'; 


                  echo '<td ><a href="./computador.php?age='.$reg['idagencia'].'&gr='.$reg['idgrupo'].'&ven='.$reg['idvendedor'].'&ban='.$reg['idbanca'].'" > '.mb_convert_encoding($reg['idagencia'], "iso-8859-1").'</a></td>';
                  echo '<td>';
                  if($reg['idestado']!='5')  echo '<a href="./edititem.php?itb='.mb_convert_encoding($reg['serialitem'], "iso-8859-1").'"><span class="nowrap"><img src="./images/b_edit.png" title="Editar" alt="Editar" class="icon" width="16" height="16"></span></a>';

                  if($reg['idestado']!='5') 
                    echo '<a id="baseDiv" href="#" onclick=\'mostrar("'.mb_convert_encoding($reg['serialitem'], "iso-8859-1").'")\'><span class="nowrap"><img src="./images/b_browse.png" title="Mover" alt="Mover" class="icon" width="16" height="16"></span></a>';                      

                  if($reg['idestado']!='6' && $reg['idestado']!='5') 
                    echo '<a onClick="return eliminar(\''.mb_convert_encoding($reg['serialitem'], "iso-8859-1").'\')" href="#"><span class="nowrap"><img src="./images/b_drop.png" title="Borrar" alt="Borrar" class="icon" width="16" height="16"></span></a>';

                  if($reg['idestado']=='5') echo '

                    <a onClick="return confirm(\'Seguro quiere Recibir este registro?\');" href="computador.php?age='.$reg["idagencia"].'&gr='.$reg['idgrupo'].'&ven='.$reg['idvendedor'].'&ban='.$reg['idbanca'].'&del='.mb_convert_encoding($reg['idcomputador'], "iso-8859-1").'&bi='.$reg['serialitem'].'"><span class="nowrap"><img src="./images/recibir.png" title="Borrar" alt="Borrar" class="icon" width="16" height="16"></span></a>

                  ';
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
                      <li><a href="item.php">Ver Todas</a></li>
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
                  <option value="2">Almacen 2</option>
                  <option value="3">Reparacion</option>
                  <option value="4">Enviado a garantia</option>
                  <option value="6">De Baja</option>
                </select>
              </div>

            </div>
          </body>
          <script type="text/javascript" language="JavaScript" src="js/wick.js"></script> 
          <script>
          function eliminar(id){
            if(confirm('Seguro quiere Eliminar este registro ? '+id)){
             obj = id;
             cambiar(6);
             return true;
           }else return false;
         }
         </script>
         


         </html>