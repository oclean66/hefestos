<?php 
define('INCLUDE_CHECK', true);
include 'class/formato.php';
include 'class/conexion.php';
include 'class/tipoconexion.php';
$link = Conectar();
$tipoconexion = new tipoconexion($link);

//-----------Captura-Tipo--------------------------------------

if(isset($_GET['st'])){
    $listn = $_GET['st']; 
    $_SESSION['lista']=$listn;
}else $_SESSION['lista']='0';

//-------------Borra-tipoitem-----------------------------------
if ( isset($_GET['del'])) {
    $eliminartipoitem = $tipoconexion->eliminartipoconexion($_GET['del']);
}
//-----------------------------------------------------------------

echo head();

?>


<body><?php  echo menu(); ?>
    <div id='fondo'>
        <div id='wrap'>
            <div id="content2">
<?php  if (isset($eliminartipoitem))
    notificacion($eliminartipoitem);
if (isset($_GET['edit']))
    notificacion($_GET['edit']);
?>
                <h1>Tipos De Conexiones</h1>

                <div class="form">

                    <article id="tipoconexion"><img src="images/loading3.gif" width="120" height="120" style="margin-left: 45%;"></article>

                </div><!-- form -->	</div>

                <div id="sidebar">
                <div class="portlet" id="yw2">
                    <div class="portlet-decoration">
                        <div class="portlet-title">Operaciones</div>
                    </div>
                    <div class="portlet-content">
                        <ul class="operations" id="yw3">
                            <li><a href="aggtipocn.php">Agregar</a></li>
                        </ul></div>
                </div>  </div>


           

        </div>
    </div>



</body>
</html>