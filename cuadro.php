<?php 
define('INCLUDE_CHECK', true);
include 'class/formato.php';
include 'class/conexion.php';
include 'class/item.php';
include 'class/conexiones.php';
$link = Conectar();

$item = new item($link);
$listado = $item->count_cpumodelos();
$listador = $item->count();

$conexiones = new conexion($link);
$listados = $conexiones->count_conexionesmodelos();
$listadot = $conexiones->counter();
$listadop = $conexiones->counterop();

echo head();
?>


<body><?php  echo menu(); ?>
    <div id='fondo'>
        <div id='wrap'>
            <div id="content">

                <h1>Cuadro Resumen</h1>
            </br></br>
            <div class="form">
                <table cellpadding="0" cellspacing="0"  style="width: 50%;" border="0" class="display" id="tabla_lista_agencias">
                    <thead  style="background-color: black; ">
                        <tr>
                            <th>Datos</th>
                            <th>Disponibles</th>    


                        </tr>
                    </thead>

                    <tbody>
                    <?php    
                    echo '<th><h2></br>Detalle por Modelos</br></h2></th></br>';
                     $total =0;
                    while($reg=  mysql_fetch_array($listado))
                    { 
                        echo '<tr>';
                        echo '<th>'.$reg[1].' '.$reg[2].' '.$reg[3].'</th>';
                        echo '<th>'.$reg[0].'</th>';
                        echo '</tr>';

                        $total = $total + $reg[0];
                    }

                    ?>

                    <?php 
                    echo '<th><h2></br>Detalle por Modelos - Conexiones</br></h2></th></br>';
                     $totales =0;
                    while($reg=  mysql_fetch_array($listados))
                    { 
                        echo '<tr>';
                        echo '<th>'.$reg[1].' '.$reg[2].' '.$reg[3].'</th>';
                        echo '<th>'.$reg[0].'</th>';
                        echo '</tr>';
                        $totales = $totales + $reg[0];
                    }
                    ?>
                    <?php 
                     echo '<th><h2></br>Detalle por Tipos</br></h2></th></br>';
                    while($reg=  mysql_fetch_array($listador))
                    { 
                        echo '<tr>';
                        echo '<th>'.$reg[1].' '.$reg[2].'</th>';
                        echo '<th>'.$reg[0].'</th>';
                        echo '</tr>';
                       
                    }
                    ?>
                    <?php 
                     echo '<th><h2></br>Detalle por Tipos - Conexiones</br></h2></th></br>';
                    while($reg=  mysql_fetch_array($listadot))
                    { 
                        echo '<tr>';
                        echo '<th>'.$reg[1].' '.$reg[2].'</th>';
                        echo '<th>'.$reg[0].'</th>';
                        echo '</tr>';
                       
                    }
                    ?>
                     <?php 
                     echo '<th><h2></br>Detalle por Operador - Conexiones</br></h2></th></br>';
                    while($reg=  mysql_fetch_array($listadop))
                    { 
                        echo '<tr>';
                        echo '<th>'.$reg[1].' '.$reg[2].' '.$reg[3].'</th>';
                        echo '<th>'.$reg[0].'</th>';
                        echo '</tr>';
                       
                    }
                    ?>

                    <tbody>
                        </table><?php 
                        echo '</br><h2>Total de Equipos '.$total.'</h2>'; 
                        echo '<h2>Total de Conexiones '.$totales.'</h2>'; 
                        ?>

                    </div>

                </div>         
            </div>
        </div>



    </body>
    </html>