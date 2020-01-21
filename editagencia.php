<?php   
define('INCLUDE_CHECK', true);
include 'class/formato.php';

include 'class/conexion.php';
include 'class/agencia.php';
include 'class/banca.php';


$link = Conectar();
$agencia = new agencia($link);

$banca = new banca($link);
$lista = $banca->listar_bancas();

//----------------------Consulta-agencia------------------------------------//

if (isset($_GET['ag']) and isset($_GET['gr']) and isset($_GET['ven']) and isset($_GET['ban'])) {

    $resulreg = $agencia->consultaragencia($_GET['ag'],$_GET['gr'],$_GET['ven'],$_GET['ban']);
    $fila = mysql_fetch_array($resulreg);
}
//----------------------Guardar-agencia------------------------------------//

if (isset($_POST['submit']) and $_POST['agencia_nombre'] != '') {

    $resul = $agencia->guardaragencia($_GET['ag'],$_POST['agencia_nombre'],$_POST['responsable'],$_POST['cedula'],$_POST['telefono'],$_POST['email'],$_POST['direccion'], $_GET['gr'],$_GET['ven'],$_GET['ban']);

    if ($resul == 1) {
        echo '<script type="text/javascript">
        window.location="./agencia.php?edit=1";
    </script>';
} else {
    echo '<script type="text/javascript">
    window.location="./agencia.php?edit=0";
</script>';
}
}
//-----------------------------------------------------------------------//

@mysql_free_result($resul);
@mysql_close($agencia);


echo head();
?>
<script>

    function cambiarid(){

      var agencia = document.getElementById('agencia_codigo');
      var agnombre = document.getElementById('agencia_nombre');

      var grupoid = document.getElementById('grupoid');
      var vendedorid = document.getElementById('vendedorid');
      var bancaid = document.getElementById('bancaid');


      var resp = prompt("Introduzca el nuevo Codigo","");
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
            
            viejo = grupoid.value+','+vendedorid.value+','+bancaid.value;

            var url = "moverid.php?old="+agencia.value+"&data="+viejo+"&new="+resp;
            var n=url.replace(/ /gi, "%20");
            //alert(n);
            //window.open(url);
           objeto.open('GET', n, true) 
            // indicamos con el método open la url a cargar de manera asíncrona

            objeto.send(null) // Enviamos los datos con el metodo send
            alert('Guardado con exito!');
            document.location.href='editagencia.php?ag='+resp+'&gr='+grupoid.value+'&ven='+vendedorid.value+'&ban='+bancaid.value; 
        }
}

function cambiar(){


  var banca = document.getElementById('banca');
  var vendedor = document.getElementById('vendedor');
  var grupo = document.getElementById('grupo');

  var agencia = document.getElementById('agencia_codigo');
  var agnombre = document.getElementById('agencia_nombre');

  var grupoid = document.getElementById('grupoid');
  var vendedorid = document.getElementById('vendedorid');
  var bancaid = document.getElementById('bancaid');

  if (banca.selectedIndex==0){
    alert("Debe seleccionar una banca.")
    banca.focus()
    return 0;
}
if (vendedor.selectedIndex==0){
    alert("Debe seleccionar un Receptor.")
    vend.focus()
    return 0;
}if (grupo.selectedIndex==0){
    alert("Debe seleccionar un Grupo.")
    grupo.focus()
    return 0;
}

$("#popUpDiv").hide();
var resp = confirm('Esta seguro que quiere mover: \nAgencia: '+agencia.value+' - '+agnombre.value+' \n->hasta -> \nGrupo: '+grupo.options[grupo.selectedIndex].text+'\nVendedor: '+vendedor.options[vendedor.selectedIndex].text+'\nBanca: '+banca.options[banca.selectedIndex].text+' ?');
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
    
    viejo = grupoid.value+','+vendedorid.value+','+bancaid.value;
    nuevo = grupo.value+','+vendedor.value+','+banca.value;
    var url = "mover.php?idagencia="+agencia.value+"&old="+viejo+"&new="+nuevo;
    var n=url.replace(/ /gi, "%20");
    //alert(n);
   // window.open(url);
   objeto.open('GET', n, true) 
    // indicamos con el método open la url a cargar de manera asíncrona

    objeto.send(null) // Enviamos los datos con el metodo send
    alert('Guardado con exito!');
    document.location.href='editagencia.php?ag='+agencia.value+'&gr='+grupo.value+'&ven='+vendedor.value+'&ban='+banca.value; 
}
}

function mostrar(){

    $("#popUpDiv").show();
    

}
</script>
<script type="text/javascript" src="selectbvga.js"></script>
<style id="cuadro" type="text/css">
    #cuadro label {
        font-weight: bold;
        display: block;
        padding: 5px;
    }
</style>
<body><?php   echo menu(); ?>
    <div id='fondo'>
        <div id='wrap'>
            <div id="content">

                <h1>Edicion de agencia</h1>

                <div class="form">

                    <form id="agencia-form" method="post">
                        <p class="note">Campos con <span class="required">*</span> son obligatorios.</p>


                        <div class="row">
                            <label for="agencia_codigo" class="required">Codigo <span class="required">*</span></label>		
                            <input size="45" maxlength="45" name="agencia_codigo" id="agencia_codigo" disabled="disabled" type="text" value ="<?php   echo $fila['idagencia']; ?>">			

                            <input id="baseDiv" type="button" onclick="cambiarid()" value="Cambiar Codigo" style=" ">      
                        </div>

                        <div class="row">
                            <label for="agencia_nombre" class="required">Nombre <span class="required">*</span></label>     
                            <input size="45" maxlength="45" name="agencia_nombre" id="agencia_nombre" value ="<?php   echo $fila['nombre']; ?>" type="text">        
                        </div>
                        <div class="row">
                            <label for="responsable" class="required">Responsable <span class="required">*</span>
                            </label>     
                            <input size="45" maxlength="45" name="responsable" id="responsable" value ="<?php   echo $fila['responsable']; ?>" type="text">         
                        </div>
                        <div class="row">
                            <label for="cedula" class="required">Cedula <span class="required">*</span>
                            </label>     
                            <input size="45" maxlength="45" name="cedula" id="cedula" value ="<?php   echo $fila['cedula']; ?>" type="text">         
                        </div>
                        <div class="row">
                            <label for="telefono" class="required">Telefono <span class="required">*</span>
                            </label>     
                            <input size="45" maxlength="45" name="telefono" id="telefono" value ="<?php   echo $fila['telefono']; ?>" type="text">         
                        </div>
                        <div class="row">
                            <label for="email" class="required">Email <span class="required">*</span>
                            </label>     
                            <input size="45" maxlength="45" name="email" id="email" value ="<?php   echo $fila['email']; ?>" type="text">         
                        </div>
                        <div class="row">
                            <label for="direccion" class="required">Direccion <span class="required">*</span></label>     
                            <input size="60" maxlength="160" name="direccion" id="direccion" value ="<?php   echo $fila['direccion']; ?>" type="text">         
                        </div>

                        <div class="row">
                            <label for="grupo" class="required">Grupo <span class="required">*</span></label>        
                            <input size="10" maxlength="45" name="grupoid" id="grupoid" disabled="disabled"  value ="<?php   echo $fila['idgrupo']; ?>" type="text"> <?php   echo $fila['nombregr']; ?>  
                            <input type="button" size="4"  name="cambiogr" value="Cambiar" onclick='mostrar()'>
                        </div>

                        <div class="row">
                            <label for="vendedor" class="required">Receptor <span class="required">*</span></label>        
                            <input size="10" maxlength="10" name="vendedorid" id="vendedorid" disabled="disabled"  value ="<?php   echo $fila['idvendedor']; ?>" type="text">  <?php   echo $fila['nombreven']; ?>
                        </div>

                        <div class="row">
                            <label for="banca" class="required">Banca <span class="required">*</span></label>        
                            <input size="10" maxlength="45" name="bancaid" id="bancaid" disabled="disabled"  value ="<?php   echo $fila['idbanca']; ?>" type="text"><?php   echo $fila['nombreban']; ?>  
                        </div>



                        <div class="row buttons">
                            <input type="submit" name="submit" value="Actualizar">	
                        </div>

                    </form>
                </div><!-- form -->	
            </div>

            <div id="sidebar">
                <div class="portlet" id="yw2">
                    <div class="portlet-decoration">
                        <div class="portlet-title">Operaciones</div>
                    </div>
                    <div class="portlet-content">
                        <ul class="operations" id="yw3">
                            <li><a href="agencia.php">Listar agencias</a></li>
                        </ul>
                    </div>
                </div>	
            </div>



        </div>
    </div>



    <div id="popUpDiv" style="display: hidden;">
        <div id="cuadro" style="width: 318px;height: 250px;position: absolute;left: 35%;
        top: 35%; background-color: white; ">
        <h4 style="top: 11px; left: 47px; padding: 15px">
            Seleccione el nuevo destino de la agencia
        </h4>
        <div class="row">
            <label for="agencia_banca" class="required" >
                Codigo Banca <span class="required">*</span>
            </label>
            <select style=" width:150px" name="banca" id="banca" onChange='cargarVendedor(this.id)'>
                <option name="sel" id="sel" value="0">Seleccione</option>        
                <?php 

                while ($fila = mysql_fetch_array($lista)) {
                 ?>
                 <option value="<?php   echo $fila['idbanca']; ?>"><?php   echo $fila['idbanca'] . ' - ' . $fila['nombre']; ?></option><?php 
             }
             ?> 
         </select> 
     </div>

     <div class="row">
        <label for="agencia_vendedor" class="required">&nbsp;&nbsp;Codigo Receptor <span class="required">*</span></label>
        <select disabled="disabled" style=" width:150px" name="vendedor" id="vendedor">
            <option value="0">Elige</option>
        </select> 
    </div>

    <div class="row">
        <label for="agencia_grupo" class="required">&nbsp;&nbsp;Codigo Grupo <span class="required">*</span></label>
        <select disabled="disabled" style=" width:150px" name="grupo" id="grupo">
            <option value="0">Elige</option>
        </select> 
    </div>
    <input id="baseDiv" type="button" onclick="$('#popUpDiv').hide()" value="Cancelar" style="  padding: 5px;top: 80%; position: absolute;left: 60%;">      
    <input id="baseDiv" type="button" onclick="cambiar()" value="Mover" style="  padding: 5px;top: 80%; position: absolute;left: 20%;">      

</div>
</div>
</body>
</html>