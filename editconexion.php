<?php 
define('INCLUDE_CHECK', true);
include 'class/formato.php';

include 'class/conexion.php';
include 'class/conexiones.php';
include 'class/tipoconexion.php';
include 'class/modeloconexion.php';
include 'class/banca.php';
include 'class/operador.php';

$link = Conectar();

$operador=new operador($link);
$listaoperador = $operador->listar_operadores();


$conexiones = new conexion($link);

$tipoconexion=new tipoconexion($link);
$lista = $tipoconexion->listar_tipoconexiones();


$modeloconexion=new modeloconexion($link);
$listamodelo = $modeloconexion->listar_modeloconexiones();


//----------------------Consulta-conexiones------------------------------------//

if ( isset($_GET['reg'])) {

    $resulreg = $conexiones->consultarconexion($_GET['reg']);
    $fila = mysql_fetch_array($resulreg);
}
//----------------------mover-conexiones------------------------------------//
 if ( isset($_GET['mov'])){
    $resul = $conexiones->moverconexion($_GET['reg']); //--Voy aqui

     if ($resul == 1) {
        echo '<script type="text/javascript">
        window.location="./conexion.php?st=z&edit=1";
        </script>';
    } else {
        echo '<script type="text/javascript">
        window.location="./conexion.php?st=z&edit=0";
        </script>';
    }
  }
  //---------------------Guardar conexion----------------------------------------------
if (isset($_POST['submit']) and $_POST['imei'] != '') {




    $resul = $conexiones->guardarconexion($_POST['modeloconexions'], $_POST['operador'], $_POST['servicio'],$_POST['inputDate'], $_POST['fechacorte'], $_POST['numero'], $_POST['imei'], $_POST['claved'], $_POST['clavem'], $_POST['monto'],$_GET['reg']); //--Voy aqui

    if ($resul == 1 && isset($_GET['bc']) ) {
        echo '<script type="text/javascript">
        window.location="./bconexion.php?id='.$_GET['reg'].'&edit=1";
        </script>';
    } else if($resul == 1 && !isset($_GET['bc']) ){
        echo '<script type="text/javascript">
        window.location="./conexion.php?edit=1";
        </script>';
    } else {
        echo '<script type="text/javascript">
        window.location="./conexion.php?edit=0";
        </script>';
    }
}
//-----------------------------------------------------------------------//

@mysql_free_result($resul);
@mysql_close($conexiones);


echo head();
?>

<body><?php  echo menu(); ?>
    <div id='fondo'>
        <div id='wrap'>
            <div id="content">

                <h1>Edicion de conexiones</h1>

                <div class="form">

                    <form id="conexiones-form" method="post">
                        <p class="note">Campos con <span class="required">*</span> son obligatorios.</p>
 <table style="width:100%; background-color:#C5E3FF";>             
                        <tbody>

                            <tr>

                                <td style="border-left: 0px;padding-left: 10px;"> Tipo de Conexion *</td>
                                <td style="padding-left: 10px;"> 
                                   <select style=" width:150px" name="tipoconexions" id="tipoconexions" onChange='cargarModeloconexion(this.id)'>
                                    <option name="sel" id="sel" value="0">Seleccione</option>        
                                    <?php 

                                    while ($filatipo = mysql_fetch_array($lista)) {
                                       ?>
                                       <option <?php  if($fila['idtipoconexion']==$filatipo[0]) echo 'Selected'; ?> value="<?php  echo $filatipo[0]; ?>">
                                        <?php  echo $filatipo[1]; ?>
                                    </option>
                                        <?php 
                                   }
                                   ?> 
                               </select>
                           </td>
                           <td style="padding-left: 10px;">  Modelo *   </td>
                           <td style="padding-left: 10px;"> 
                            <select style=" width:150px" name="modeloconexions" id="modeloconexions" >
                                <option name="sel" id="sel" value="0">Seleccione</option>
                                 <?php 

                                    while ($filamodelo = mysql_fetch_array($listamodelo)) {
                                       ?>
                                       <option <?php  if($fila['idmodeloconexion']==$filamodelo[0]) echo 'Selected';?> value="<?php  echo $filamodelo[0]; ?>">
                                        <?php  echo $filamodelo[1]; ?>
                                    </option>
                                        <?php 
                                   }
                                   ?>         
                                
                           </select>
                       </td>           
                   </tr> 
                   <tr>

                    <td style="border-left: 0px;padding-left: 10px;"> Operador * </td>
                    <td style="padding-left: 10px;"> 
                        <select style=" width:150px" name="operador" id="operador">
                            <option name="sel" id="sel" value="0">Seleccione</option>        
                            <?php 
                            
                            while ($lsitas = mysql_fetch_array($listaoperador)) {
                               ?>
                            <option <?php  if($fila['idoperador']==$lsitas[0]) echo 'Selected';?> value="<?php  echo $lsitas[0]; ?>"><?php  echo $lsitas[1]; ?></option><?php  
                           }
                           ?> 
                       </select>
                   </td>
                   <td style="padding-left: 10px;"> Tipo de Servicio </td>
                   <td style="padding-left: 10px;"> 
                       <select style=" width:150px" name="servicio" id="servicio">
                        <option name="sel" id="sel" <?php  if($fila['servicio']==0) echo 'Selected';?>  value="0">Seleccione</option>   
                        <option name="sel" id="sel" <?php  if($fila['servicio']==1) echo 'Selected';?> value="1">Pre-Pago</option>   
                        <option name="sel" id="sel" <?php  if($fila['servicio']==2) echo 'Selected';?> value="2">Post-Pago</option>      
                        <option name="sel" id="sel" <?php  if($fila['servicio']==3) echo 'Selected';?> value="3">No Tiene</option>   

                    </select>
                </td>                               
            </tr> 
            <tr>



            </tr>  
            <tr>

                <td style="border-left: 0px;padding-left: 10px;">Fecha de Compra  </td>
                <td style="padding-left: 10px;"> 
                   <input class="inputDate" id="inputDate" name="inputDate" value="<?php  echo $fila['fechacompra']; ?>" /> 
               </td>
                <td style="padding-left: 10px;">Monto de renta 
                   <input class="fechacorte" id="monto" name="monto" style ="width:21px;"  value="" type="text" maxlength = "3"/> Bs
               </td>  
               <td style="padding-left: 10px;">Fecha de corte  
                   <input class="fechacorte" id="fechacorte" name="fechacorte" style ="width:16px;" onkeyup="mascara(this,'-',dia,true)" value ="<?php  echo $fila['diacorte']; ?>" /> de cada mes
               </td>         


           </tr> 

           <tr>

                <td style="border-left: 0px;padding-left: 10px;">Numero de Telefono </td>
                <td style="padding-left: 10px;"> 
                            <input name="numero" id="numero" type="text" value ="<?php  echo $fila['numero']; ?>" onkeyup="mascara(this,'-',telefono,true)" >

               </td>
               <td style="padding-left: 10px;">IMEI/ESN </td>
               <td style="padding-left: 10px;"> 
                    <input size="45" maxlength="45" name="imei" id="imei" value ="<?php  echo $fila['IMEI']; ?>" type="text">  
               </td>         


           </tr> 

           <tr>

                <td style="border-left: 0px;padding-left: 10px;">Clave de Datos</td>
                <td style="padding-left: 10px;"> 
                   <input size="45" maxlength="45" name="claved" id="claved"   value ="<?php  echo $fila['clavedatos']; ?>" type="text"> 
               </td>
               <td style="padding-left: 10px;">Clave de MovilMensaje </td>
               <td style="padding-left: 10px;"> 
                   <input size="45" maxlength="45" name="clavem" id="clavem"  value ="<?php  echo $fila['clavemovilmensaje']; ?>" type="text"> 
               </td>         


           </tr> 
       </tbody>
   </table>
                       
                        

                                 
                            


                        <div class="row buttons">
                            <input type="submit" name="submit" value="Actualizar">	</div>

                    </form>
                </div><!-- form -->	</div>

            <div id="sidebar">
                <div class="portlet" id="yw2">
                    <div class="portlet-decoration">
                        <div class="portlet-title">Operaciones</div>
                    </div>
                    <div class="portlet-content">
                        <ul class="operations" id="yw3">
                            <li><a href="conexion.php">Listar conexioness</a></li>
                        </ul></div>
                </div>	</div>



        </div>
    </div>



<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/datepicker.js"></script>
<script type="text/javascript" src="js/eye.js"></script>
<script type="text/javascript" src="js/utils.js"></script>
<script type="text/javascript" src="js/layout.js?ver=1.0.2"></script>
</body>
</html>