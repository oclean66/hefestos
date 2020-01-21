<?php 

define('INCLUDE_CHECK', true);
include 'class/formato.php';

include 'class/conexion.php';
include 'class/grupo.php';
include 'class/banca.php';

$link = Conectar();
$grupo = new grupo($link);


$banca = new banca($link);
$lista = $banca->listar_bancas();

//----------------------Consulta-grupo------------------------------------//

if (isset($_GET['gr']) and isset($_GET['ven']) and isset($_GET['ban'])) {

    $resulreg = $grupo->consultargrupo($_GET['gr'],$_GET['ven'],$_GET['ban']);
    $fila = mysql_fetch_array($resulreg);
}
//----------------------Guardar-grupo------------------------------------//

if (isset($_POST['submit']) and $_POST['grupo_nombre'] != '') {

    $resul = $grupo->guardargrupo($_POST['grupo_nombre'], $_GET['gr'], $_GET['ven'],$_GET['ban']);

    if ($resul == 1) {
        echo '<script type="text/javascript">
        window.location="./grupo.php?edit=1";
        </script>';
    } else {
        echo '<script type="text/javascript">
        window.location="./grupo.php?edit=0";
        </script>';
    }
}
//-----------------------------------------------------------------------//

@mysql_free_result($resul);
@mysql_close($grupo);


echo head();
?>
<script>

function cambiar(){
   

      var banca = document.getElementById('banca');
      var vendedor = document.getElementById('vendedor');
     

      var grupo = document.getElementById('grupo_codigo');
      var aggrupo = document.getElementById('grupo_nombre');

      var vendedorid = document.getElementById('vendedor_codigo');
      var bancaid = document.getElementById('banca_codigo');

      if (banca.selectedIndex==0){
        alert("Debe seleccionar una banca.")
        banca.focus()
        return 0;
      }
      if (vendedor.selectedIndex==0){
        alert("Debe seleccionar un Receptor.")
        vend.focus()
        return 0;
      }

 $("#popUpDiv").hide();
       var resp = confirm('Esta seguro que quiere mover: \nGrupo: '+grupo.value+' - '+aggrupo.value+' \n->hasta -> \nVendedor: '+vendedor.options[vendedor.selectedIndex].text+'\nBanca: '+banca.options[banca.selectedIndex].text+' ?');
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
    
    viejo = vendedorid.value+','+bancaid.value;
    nuevo = vendedor.value+','+banca.value;
    var url = "mover.php?idgrupo="+grupo.value+"&old="+viejo+"&new="+nuevo;
    var n=url.replace(/ /gi, "%20");
    //alert(n);
    //window.open(url);
    objeto.open('GET', n, true) 
    // indicamos con el método open la url a cargar de manera asíncrona

    objeto.send(null) // Enviamos los datos con el metodo send
    alert('Guardado con exito!');
    document.location.href='editgrupo.php?gr='+grupo.value+'&ven='+vendedor.value+'&ban='+banca.value; 
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
<body><?php  echo menu(); ?>
    <div id='fondo'>
        <div id='wrap'>
            <div id="content">

                <h1>Edicion de grupo</h1>

                <div class="form">

                    <form id="grupo-form" method="post">
                        <p class="note">Campos con <span class="required">*</span> son obligatorios.</p>


                        <div class="row">
                            <label for="grupo_codigo" class="required">Codigo <span class="required">*</span></label>		
                            <input size="45" maxlength="45" name="grupo_codigo" id="grupo_codigo" disabled="disabled" type="text" value ="<?php  echo $fila['idgrupo']; ?>">			</div>

                        <div class="row">
                            <label for="grupo_nombre" class="required">Nombre <span class="required">*</span></label>		
                            <input size="45" maxlength="45" name="grupo_nombre" id="grupo_nombre" value ="<?php  echo $fila['nombregr']; ?>" type="text">			</div>

                         <div class="row">
                            <label for="vendedor" class="required">Receptor <span class="required">*</span></label>        
                            <input size="10" maxlength="10" name="vendedor_codigo" id="vendedor_codigo" disabled="disabled"  value ="<?php  echo $fila['idvendedor']; ?>" type="text">  <?php  echo $fila['nombreven']; ?>
                            <input type="button" size="4"  name="cambiogr" value="Cambiar" onclick='mostrar()'>
                        </div>

                        <div class="row">
                            <label for="banca" class="required">Banca <span class="required">*</span></label>        
                            <input size="10" maxlength="45" name="banca_codigo" id="banca_codigo" disabled="disabled"  value ="<?php  echo $fila['idbanca']; ?>" type="text"><?php  echo $fila['nombreban']; ?>  
                        </div>


                        <div class="row buttons">
                            <input type="submit" name="submit" value="Actualizar">	</div>

                    </form>
                </div><!-- form -->	</div>

            <div id="sidebar">
                <div class="portlet" id="yw2">
                    <div class="portlet-decoration">
                        <div class="portlet-title">Operaciones</div>
                    </div>
                    <div class="portlet-content">
                        <ul class="operations" id="yw3">
                            <li><a href="grupo.php">Listar grupos</a></li>
                        </ul></div>
                </div>	</div>



        </div>
    </div>


        <div id="popUpDiv" style="display: hidden;">
            <div id="cuadro" style="width: 318px;height: 250px;position: absolute;left: 35%;top: 35%; background-color: white; ">
                <h4 style="top: 11px; left: 47px; padding: 15px">
                Seleccione el nuevo destino del grupo
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
                       <option value="<?php  echo $fila['idbanca']; ?>"><?php  echo $fila['idbanca'] . ' - ' . $fila['nombre']; ?></option><?php  
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

            <input id="baseDiv" type="button" onclick="$('#popUpDiv').hide()" value="Cancelar" style="  padding: 5px;top: 80%; position: absolute;left: 60%;">      
            <input id="baseDiv" type="button" onclick="cambiar()" value="Mover" style="  padding: 5px;top: 80%; position: absolute;left: 20%;">      

    </div>
</div>
</body>
</html>