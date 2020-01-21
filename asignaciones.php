<?php  
define('INCLUDE_CHECK', true);
setlocale(LC_ALL,"es_ES@euro","es_ES","esp");
include 'class/formato.php';

//-------------Borra-item-----------------------------------
if ( isset($_GET['del'])) {
    $eliminaritem = $item->eliminaritem($_GET['del']);
}
//-----------------------------------------------------------------

echo head();
if ( isset($_GET['d']) && isset($_GET['g']) && $_GET['d']!="" && $_GET['g']!="") {
    $fecha1 = $_SESSION['week1'] = date("Y-m-d H:i:s",strtotime ($_GET['d']));
    $fecha2 = $_SESSION['week2'] = date("Y-m-d H:i:s",strtotime ($_GET['g']));

}else{
  $fecha1 = $_SESSION['week1'] =date("Y-m-d H:i:s",strtotime ("last Monday"));
  $fecha2 = $_SESSION['week2'] =date("Y-m-d H:i:s",strtotime ("next Saturday"));  
}
?>


<body><?php  echo menu(); ?>
    <div id='fondo'>
        <div id='wrap'>
            <div id="content2">
<?php  if (isset($eliminaritem))
    notificacion($eliminaritem);
if (isset($_GET['edit']))
    notificacion($_GET['edit']);
?>
                <h1>Salidas de Equipos</h1>
                  <h2>Semana <?php  echo $numerosemana?>: Del <?php  echo strftime("%A",strtotime ($fecha1)).' '.date("d",strtotime ($fecha1))?> de <?php  echo strftime("%B",strtotime ($fecha1))?> al <?php  echo strftime("%A",strtotime ($fecha2)).' '.date("d",strtotime ($fecha2))?> de <?php  echo strftime("%B",strtotime ($fecha2))?> del <?php  echo date("Y",strtotime ($fecha2))?></h2>
                <label for="meeting">Entradas de la semana : </label>
             
                <input type="text" size="12" id="inputField" />
                <input type="text" size="12" id="inputField2" />
                <input name="submit" value="Actualizar" type="submit" onClick="document.location.href='./asignaciones.php?d='+document.getElementById('inputField').value+'&g='+document.getElementById('inputField2').value;" >


                <div class="form">

                    <article id="computador"><img src="images/loading3.gif" width="120" height="120" style="margin-left: 45%;"></article>

                </div>

                <!-- form -->	</div>


           

        </div>
    </div>


<link rel="stylesheet" type="text/css" media="all" href="css/jsDatePick_ltr.min.css" />
<script type="text/javascript" src="js/jsDatePick.min.1.3.js"></script>
<script type="text/javascript">
    window.onload = function(){
        new JsDatePick({
            useMode:2,
            target:"inputField",
            dateFormat:"%d-%m-%Y",
            
            yearsRange:[1978,2020],
            limitToToday:true,
            cellColorScheme:"beige",
           
            imgPath:"img/",
            weekStartDay:1
        }); new JsDatePick({
            useMode:2,
            target:"inputField2",
            dateFormat:"%d-%m-%Y",
            
            yearsRange:[1978,2020],
            limitToToday:true,
            cellColorScheme:"beige",
           
            imgPath:"img/",
            weekStartDay:1
        });
    };

    
</script>


</body>
</html>