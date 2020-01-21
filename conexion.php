<?php 
define('INCLUDE_CHECK', true);
include 'class/formato.php';
include 'class/conexion.php';
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

echo head();
?>
<script>
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
                <?php  if ( isset($_GET['st'])) {
                
                 if ( $_GET['st']=='a')
                    echo '<h1>Conexiones de Baja</h1>';
                elseif ( $_GET['st']=='y')
                    echo '<h1>Conexiones Libres</h1>';
                elseif ( $_GET['st']=='z')
                    echo '<h1>Conexiones Prestadas</h1>';
                else 
                    echo '<h1>Conexiones del sistema</h1>';
            }else echo '<h1>Conexiones del sistema</h1>'; ?>

                <div class="form">

                    <article id="conexiones"><img src="images/loading3.gif" width="120" height="120" style="margin-left: 45%;"></article>

                </div><!-- form -->	</div>


            <div id="sidebar">
                <div class="portlet" id="yw2">
                    <div class="portlet-decoration">
                        <div class="portlet-title">Operaciones</div>
                    </div>
                    <div class="portlet-content">
                        <ul class="operations" id="yw3">
                            <li><a href="aggconexion.php">Agregar</a></li>
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
</html>