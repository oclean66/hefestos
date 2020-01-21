<?php 
define('INCLUDE_CHECK', true);
include 'class/formato.php';
include 'class/conexion.php';
include 'class/grupo.php';
$link = Conectar();
$grupo = new grupo($link);

//------------------------------------------------------------------------------
if(isset($_GET['gr']) and isset($_GET['ven']) and isset($_GET['ban']) )
echo '<script language="JavaScript" type="text/javascript">
        document.location = "computador.php?gr='. $_GET['gr'].'&ven='. $_GET['ven'].'&ban='. $_GET['ban'].'";
      </script>';

//-------------Borra-grupo-----------------------------------
if ( isset($_GET['delgr']) and isset($_GET['delven']) and isset($_GET['delban'])) {
    $eliminarbanca = $grupo->eliminargrupo($_GET['delgr'],$_GET['delven'],$_GET['delban']);
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
                <h1>Grupos</h1>

                <div class="form">

                    <article id="grupos"><img src="images/loading3.gif" width="120" height="120" style="margin-left: 45%;"></article>

                </div><!-- form -->	</div>


            <div id="sidebar">
                <div class="portlet" id="yw2">
                    <div class="portlet-decoration">
                        <div class="portlet-title">Operaciones</div>
                    </div>
                    <div class="portlet-content">
                        <ul class="operations" id="yw3">
                            <li><a href="agggrupo.php">Agregar</a></li>
                        </ul></div>
                </div>	</div>

        </div>
    </div>



</body>
</html>