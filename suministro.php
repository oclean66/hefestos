<?php  
define('INCLUDE_CHECK', true);
include 'class/formato.php';
include 'class/conexion.php';
include 'class/suministro.php';
$link = Conectar();
$suministros = new suministro($link);

//-------------------Borrar-suministros-----------------------------
if (isset($_GET['del'])) {
    $eliminarsuministros = $suministros->eliminarsuministro($_GET['del']);
}
//------------------------------------------------------------

echo head();
?>

<script>

function cambiar(){
   
      var cantidad = document.getElementById('cantidad');
    
     

 $("#popUpDiv").hide();
       var resp = confirm('Esta seguro que quiere agregar '+cantidad.value+' elementos ?');
       if (resp){
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
    
    
    var url = "editsuministro.php?tipo=1&reg='"+id+"'&cant='"+cantidad.value+"'";
    var n=url.replace(/ /gi, "%20");
   
    objeto.open('GET', n, true) 
    // indicamos con el método open la url a cargar de manera asíncrona

    objeto.send(null) // Enviamos los datos con el metodo send
    alert('Guardado con exito!');
    document.location.reload(); 
    }
}

function mostrar(reg){
    id=reg;
    $("#popUpDiv").show();
    $("#cantidad").focus();
    

}
</script>
<style id="cuadro" type="text/css">
#cuadro label {
    font-weight: bold;
    display: block;
    padding: 5px;
}
</style>

<body><?php  echo menu(); ?>
    <div id='fondo'>
        <div id='wrap'>
            <div id="content">
<?php  if (isset($eliminarsuministros))
    notificacion($eliminarsuministros);
if (isset($_GET['edit']))
    notificacion($_GET['edit']);
?>
                <h1>Suministros</h1>

                <div class="form">

                    <article id="suministros"><img src="images/loading3.gif" width="120" height="120" style="margin-left: 45%;"></article>

                </div><!-- form -->	</div>


            <div id="sidebar">
                <div class="portlet" id="yw2">
                    <div class="portlet-decoration">
                        <div class="portlet-title">Operaciones</div>

                    </div>
                    <div class="portlet-content">
                        <ul class="operations" id="yw3">
                            <li><a href="aggsuministro.php">Agregar</a></li>
                            <li><a href="pdf/listasumi.php" target="_blank">Imprimir</a></li>
                            
                        </ul></div>
                </div>	</div>

        </div> 
    </div> 
 

<div id="popUpDiv" style="display: hidden;">
            <div id="cuadro" style="width: 318px;height: 250px;position: absolute;left: 35%;
            top: 35%; background-color: white; ">
                <h4 style="top: 11px; left: 47px; padding: 15px">
                Por favor, indique la cantidad a agregar al suministro
            </h4>
           <div class="row">
                <label for="agencia_banca" class="required" >
                    Cantidad<span class="required">*</span>
                </label>
            <input id="cantidad" name="cantidad" type="text" value="0" 
            style="  padding: 5px;top: 38%; position: absolute;left: 26%;"
            onkeypress="if (event.keyCode == 13) cambiar()">      

           </div>


            <input id="baseDiv" type="button" onclick="$('#popUpDiv').hide()" value="Cancelar" style="  padding: 5px;top: 80%; position: absolute;left: 60%;">      
            <input id="baseDiv" type="button" onclick="cambiar()" value="Agregar" style="  padding: 5px;top: 80%; position: absolute;left: 20%;">      

    </div>
</div>
</body>
</html>