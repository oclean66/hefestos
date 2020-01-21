<?php  
define('INCLUDE_CHECK', true);
include 'class/formato.php';
include 'class/conexion.php';
include 'class/vendedor.php';
$link = Conectar();
$vendedor = new vendedor($link);


//------------------------------------------------------------------------------
if( isset($_GET['ven']) and isset($_GET['ban']) )
echo '<script language="JavaScript" type="text/javascript">
        document.location = "computador.php?ven='. $_GET['ven'].'&ban='. $_GET['ban'].'";
      </script>';


//-------------Borra-Vendedor-----------------------------------
if ( isset($_GET['delven']) and isset($_GET['delban'])) {
    $eliminarbanca = $vendedor->eliminarvendedor($_GET['delven'],$_GET['delban']);
}
//-----------------------------------------------------------------

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
                <h1>Receptores</h1>

                <div class="form">

                    <article id="vendedores"><img src="images/loading3.gif" width="120" height="120" style="margin-left: 45%;"></article>

                </div><!-- form -->	</div>


            <div id="sidebar">
                <div class="portlet" id="yw2">
                    <div class="portlet-decoration">
                        <div class="portlet-title">Operaciones</div>
                    </div>
                    <div class="portlet-content">
                        <ul class="operations" id="yw3">
                            <li><a href="aggvendedor.php">Agregar</a></li>
                        </ul></div>
                </div>	</div>

        </div>
    </div>



</body>
</html>