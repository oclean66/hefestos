<?php 
define('INCLUDE_CHECK', true);
include 'class/formato.php';
include 'class/conexion.php';
include 'class/usuario.php';
$link = Conectar();
$usuario = new usuario($link);

//-------------------Borrar-usuario-----------------------------
if (isset($_GET['del'])) {
    $eliminarusuario = $usuario->eliminarusuario($_GET['del']);
}
if (isset($_GET['id'])) {
    $eliminarusuario = $usuario->reiniciar($_GET['id']);
}
//------------------------------------------------------------

echo head();
?>


<body><?php  echo menu(); ?>
    <div id='fondo'>
        <div id='wrap'>
            <div id="content">
<?php  if (isset($eliminarusuario))
    notificacion($eliminarusuario);
if (isset($_GET['edit']))
    notificacion($_GET['edit']);
?>
                <h1>Usuarios del Sistema</h1>

                <div class="form">

                    <article id="usuarios"><img src="images/loading3.gif" width="120" height="120" style="margin-left: 45%;"></article>

                </div><!-- form -->	</div>


            <div id="sidebar">
                <div class="portlet" id="yw2">
                    <div class="portlet-decoration">
                        <div class="portlet-title">Operaciones</div>
                    </div>
                    <div class="portlet-content">
                        <ul class="operations" id="yw3">
                            <li><a href="aggusuario.php">Agregar</a></li>
                        </ul></div>
                </div>	</div>

        </div>
    </div>



</body>
</html>