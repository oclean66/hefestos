<?php 
define('INCLUDE_CHECK', true);
include 'class/formato.php';
include 'class/conexion.php';
include 'class/modelo.php';
$link = Conectar();
$modelo = new modelo($link);

//-----------Captura-Tipo--------------------------------------

if(isset($_GET['st'])){
    $listn = $_GET['st']; 
    $_SESSION['lista']=$listn;
}else $_SESSION['lista']='0';

//-------------Borra-modelo-----------------------------------
if ( isset($_GET['del'])) {
    $eliminarmodelo = $modelo->eliminarmodelo($_GET['del']);
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
                <h1>Modelos</h1>

                <div class="form">

                    <article id="modelos"><img src="images/loading3.gif" width="120" height="120" style="margin-left: 45%;"></article>

                </div><!-- form -->	</div>

                <div id="sidebar">
                <div class="portlet" id="yw2">
                    <div class="portlet-decoration">
                        <div class="portlet-title">Operaciones</div>
                    </div>
                    <div class="portlet-content">
                        <ul class="operations" id="yw3">
                            <li><a href="aggmodel.php">Agregar</a></li>
                        </ul></div>
                </div>  </div>


           

        </div>
    </div>


<?php  $link = desconectar();?>
</body>
</html>