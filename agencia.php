<?php 
define('INCLUDE_CHECK', true);
include 'class/formato.php';
include 'class/conexion.php';
include 'class/agencia.php';
$link = Conectar();
$agencia = new agencia($link);

//-------------Borra-agencia-----------------------------------
if ( isset($_GET['delag']) and isset($_GET['delgr']) and isset($_GET['delven']) and isset($_GET['delban'])) {
    $result = $agencia->eliminaragencia($_GET['delag'],$_GET['delgr'],$_GET['delven'],$_GET['delban']);
}
//-----------------------------------------------------------------

echo head();
?>


<body><?php  echo menu(); ?>
    <div id='fondo'>
        <div id='wrap'>
            <div id="content">
<?php  if (isset($result))
    notificacion($result);
if (isset($_GET['edit']))
    notificacion($_GET['edit']);
?>
                <h1>Agencias</h1>

                <div class="form">

                    <article id="agencias"><img src="images/loading3.gif" width="120" height="120" style="margin-left: 45%;"></article>

                </div><!-- form -->	</div>


            <div id="sidebar">
                <div class="portlet" id="yw2">
                    <div class="portlet-decoration">
                        <div class="portlet-title">Operaciones</div>
                    </div>
                    <div class="portlet-content">
                        <ul class="operations" id="yw3">
                            <li><a href="aggagencia.php">Agregar</a></li>
                        </ul></div>
                </div>	</div>

        </div>
    </div>



</body>
</html>