<?php 
define('INCLUDE_CHECK', true);
include 'class/formato.php';
include 'class/conexion.php';
include 'class/banca.php';
$link = Conectar();
$banca = new banca($link);

//-------------------Borrar-Banca-----------------------------
if (isset($_GET['del'])) {
    $eliminarbanca = $banca->eliminarbanca($_GET['del']);
}
//------------------------------------------------------------

echo head();
?>


<body><?php  echo menu(); ?>
    <div id='fondo'>
        <div id='wrap'>
            <div id="content">
<?php  if (isset($eliminarbanca))
    notificacion($eliminarbanca);
if (isset($_GET['edit']))
    notificacion($_GET['edit']);
?>
                <h1>Facturacion Pendiente</h1>

                <div class="form">

                    <article id="pendientes"><img src="images/loading3.gif" width="120" height="120" style="margin-left: 45%;"></article>

                </div><!-- form -->	</div>


            <!--<div id="sidebar">
                <div class="portlet" id="yw2">
                    <div class="portlet-decoration">
                        <div class="portlet-title">Operaciones</div>
                    </div>
                    <div class="portlet-content">
                        <ul class="operations" id="yw3">
                            <li><a href="#">Imprimir</a></li>
                        </ul></div>
                </div>	
            </div>-->

        </div>
    </div>



</body>
</html>