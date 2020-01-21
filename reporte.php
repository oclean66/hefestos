<?php  
define('INCLUDE_CHECK', true);
include 'class/formato.php';
include 'class/conexion.php';
include 'class/banca.php';
$link = Conectar();
$banca = new banca($link);

 $sql = 'SELECT idrelacion, fecha, suministros.nombre,relacion.cantidad, banca.idbanca,
        vendedor.idvendedor, grupo.idgrupo,agencia.idagencia,agencia.nombre as nombreag, grupo.nombre as nombregr, 
       vendedor.nombre as nombreven, banca.nombre as nombreban
        from agencia,grupo,vendedor,banca, relacion, suministros
       where relacion.idsuministros = suministros.idsuministros
       and relacion.idagencia = agencia.idagencia
       and relacion.idgrupo = grupo.idgrupo
       and relacion.idvendedor = vendedor.idvendedor
       and relacion.idbanca = banca.idbanca
      
       and agencia.idgrupo = grupo.idgrupo
       and agencia.idvendedor = vendedor.idvendedor
       and agencia.idbanca = banca.idbanca
       and grupo.idvendedor = vendedor.idvendedor
       and grupo.idbanca = banca.idbanca
       and vendedor.idbanca = banca.idbanca 
       '.$_SESSION['sql'].'
       order by fecha desc';
  

$listado=  mysql_query($sql,$link);
echo head();
?>


<body><?php  echo menu(); ?>
    <div id='fondo'>
        <div id='wrap'>
            <div id="content">

                <h1>Reporte del Mes</h1>

                <div class="form">

                    <article id="bancas"><img src="images/loading3.gif" width="120" height="120" style="margin-left: 45%;"></article>

                </div><!-- form -->	</div>


            <div id="sidebar">
                <div class="portlet" id="yw2">
                    <div class="portlet-decoration">
                        <div class="portlet-title">Operaciones</div>
                    </div>
                    <div class="portlet-content">
                        <ul class="operations" id="yw3">
                            <li><a href="aggbanca.php">Imprimir</a></li>
                        </ul></div>
                </div>	</div>

        </div>
    </div>



</body>
</html>