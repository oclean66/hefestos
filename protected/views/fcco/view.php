<?php
/* @var $this FccoController */
/* @var $model Fcco */


// $model = $modelo[0];
// Yii::app()->name = "Salida: " . $model->GCCA_Cod . " - " . $model->GCCA_Nombre;
$this->menu = array(
    //array('label'=>'List Fcco', 'url'=>array('index')),
    array('label' => 'Asignar Activos', 'url' => array('create')),
    // array('label' => 'Actualizar Fcco', 'url' => array('update', 'id' => $model->FCCO_Id)),
    // array('label' => 'Borrar Fcco', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->FCCO_Id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Activos en esta Agencia', 'url' => array('agencia', 'id' => $model->GCCA_Id, 'type' => 258)),
);
?>
<img class="imprimir" width="150px" src="<?php echo Yii::app()->theme->baseUrl . "/img/brand.png"; ?>" alt="" />

<!-- <div class="modal-header"> -->

    <!-- <button type="button" class="btn btn-default" data-dismiss="modal" style="float:right">Cerrar</button> -->
    <!-- <button class="btn btn-primary" onclick="window.print();" style="float:right"><i class="fa fa-print"></i>  Imprimir</button> -->
    <!-- <h4 class="modal-title" id="myModalLabel">Comercializadora La Excelencia C.A.</h4> -->
    <address style="position: absolute; top:20px;right: 55px" class="visible-print">
       
        Reporte de <?php echo $tipo == 1 ? "Salida" : "Entrada"; ?> <br> 
        Fecha: <?php //echo date("d-m-Y h:i a", strtotime($modelo->FCCO_Timestamp)); ?><br>
        Ticket:<?php echo $lote; ?>
    </address>
<!-- </div> -->
<div class="row">
    <div class="col-sm-12">
        <div class="box">
            <div class="box-title" style="margin-top:0">
                <h3>
                    <i class="fa fa-print"></i>
                    Reporte de <?php echo $tipo == 1 ? "Salida" : "Entrada"; ?>
                </h3>
                <button type="button" class="btn btn-default" data-dismiss="modal" style="float:right">Cerrar</button>
    <button class="btn btn-primary" onclick="window.print();" style="float:right"><i class="fa fa-print"></i>  Imprimir</button>
            </div>
            <div class="box-content" style="padding: 0; padding-top: 10px">
                <div class="invoice-info">



                    <div class="invoice-to">

                        <strong>Comercializadora La Excelencia</strong>
                        <address>
                            Rif: J-29401587-5 <br> 
                            Departamento Tecnico
                            <br>Calle 15, Barrio Obrero - San Cristobal
                            <br>
                            Telefono: (0276) 355-6947
                            <br>
                            Telefono Principal:  (0276) 356-7958
                        </address>
                    </div>
                    <div class="invoice-from">

                        <strong class="truncate"><?php echo $model->GCCA_Cod . " - " . $model->GCCA_Nombre; ?></strong>
                        <address style="width: 240px">
                            Rif: <?php echo $model->GCCA_Rif; ?>
                            <br><?php echo $model->GCCA_Direccion; ?>
                            <br>Telefono:  <?php echo $model->GCCA_Telefono; ?>

                        </address>
                    </div>

                </div>
                <table class="table table-striped table-invoice">
                    <thead>
                        <tr>
                            <th># Serial</th>
                            <th>Descripcion</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($modelo as $model) {
                            ?>   
                            <tr>
                                <td class='price'><?php echo $model->FCCO_Enabled ==0?'<strike>':''; echo $model->fCCU->FCCU_Serial; echo $model->FCCO_Enabled ==0?'</strike>':''; ?></td>
                                <td class='name'><?php echo $model->FCCO_Enabled ==0?'<strike>':'';echo $model->fCCU->fCCT->fCCA->FCCA_Descripcion . " " . $model->fCCU->fCCT->FCCT_Descripcion . " | " . $model->fCCU->FCCU_Numero; echo $model->FCCO_Enabled ==0?'</strike>':''; ?></td>

                            </tr>
                            <?php
                        }
                        ?>


                    </tbody>
                </table>
              
                <!--<div id="print-footer">Copyright message</div>-->

                                <div class="imprimir" style="position: initial; bottom: 80px; border: 1px solid black; height: 150px;width: 600px"> Observaciones:</div>
                                <img class="imprimir pf-footer" style=" margin-left: auto;   margin-right: auto; width: 600px;bottom: 21px; size:5px 11in;position: fixed;" src="<?php echo Yii::app()->theme->baseUrl . "/img/firma.png"; ?>" alt="" />
                <?php echo $tipo == 1 ? "Con este documento el Cliente, quien recibe, acepta la responsabilidad de cuidar los articulos aqui descritos y responder por ellos en caso de robo o perdida." : 
                                        "Con este documento el cliente transfiere sus responsabilidades a la empresa de los articulos arriba descritos" ?>

            </div>
        </div>
    </div>
</div>
<div class="modal-footer">


</div>
