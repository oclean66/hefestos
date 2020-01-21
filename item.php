<?php  
define('INCLUDE_CHECK', true);
include 'class/formato.php';
include 'class/conexion.php';
include 'class/item.php';
$link = Conectar();
$item = new item($link);

//-----------Captura-Tipo--------------------------------------

if(isset($_GET['st'])){
    $listn = $_GET['st']; 
    $_SESSION['lista']=$listn;
}else $_SESSION['lista']='0';

//-------------Borra-item-----------------------------------
if ( isset($_GET['del'])) {
    $eliminaritem = $item->eliminaritem($_GET['del']);

}
//-----------------------------------------------------------------

echo head();

?>


<body><?php  echo menu(); ?>
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

<div id='fondo'>
    <div id='wrap'>
        <div id="content2">
            <?php  if (isset($eliminaritem))
            notificacion($eliminaritem);
            if (isset($_GET['edit']))
                notificacion($_GET['edit']);
            ?>
            <?php 
            if ( isset($_GET['st'])) {
                 if ( $_GET['st']=='d')
                    echo '<h1>Equipos Prestados</h1>';
                else if ( $_GET['st']=='c')
                    echo '<h1>Equipos Por Reparacion</h1>';
                else if ( $_GET['st']=='e')
                    echo '<h1>Equipos Por Garantia</h1>';
                else if ( $_GET['st']=='f')
                    echo '<h1>Equipos de Baja</h1>';
                else echo '<h1>Equipos del sistema</h1>';
            }else echo '<h1>Equipos del sistema</h1>';

            ?>
            

            <div class="form">

                <article id="items">
                    <img src="images/loading3.gif" width="120" height="120" style="margin-left: 45%;">
                </article>

            </div><!--                      -->	</div>




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

</div></body>
</html>