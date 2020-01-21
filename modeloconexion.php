<?php 
define('INCLUDE_CHECK', true);
include 'class/formato.php';
include 'class/conexion.php';
include 'class/modeloconexion.php';
$link = Conectar();
$modeloconexion = new modeloconexion($link);

//-----------Captura-Tipo--------------------------------------

if(isset($_GET['st'])){
    $listn = $_GET['st']; 
    $_SESSION['lista']=$listn;
}else $_SESSION['lista']='0';

//-------------Borra-modelo-----------------------------------
if ( isset($_GET['del'])) {
    $eliminarmodelo = $modeloconexion->eliminarmodeloconexion($_GET['del']);
}
//-----------------------------------------------------------------

echo head();

?>


<body><?php  echo menu(); ?>
    <div id='fondo'>
        <div id='wrap'>
            <div id="content2">
<?php  if (isset($eliminarmodelo))
    notificacion($eliminarmodelo);
if (isset($_GET['edit']))
    notificacion($_GET['edit']);
?>
                <h1>Modelos de Conexiones</h1>

                <div class="form">

                    <article id="modeloconexion"><img src="images/loading3.gif" width="120" height="120" style="margin-left: 45%;"></article>

                </div><!-- form -->	</div>

                <div id="sidebar">
                <div class="portlet" id="yw2">
                    <div class="portlet-decoration">
                        <div class="portlet-title">Operaciones</div>
                    </div>
                    <div class="portlet-content">
                        <ul class="operations" id="yw3">
                            <li><a href="aggmodelcn.php">Agregar</a></li>
                        </ul></div>
                </div>  </div>


           

        </div>
    </div>



</body>
</html>