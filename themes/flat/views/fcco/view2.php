<?php
/* @var $this FccoController */
/* @var $model Fcco */
$modell = isset($modelo[0]) ? $modelo[0] : null;
 
$this->menu = array(
    array('label' => 'Asignar Activos', 'url' => array('create')),
    array('label' => 'Activos en el grupo', 'url' => array('grupo', 'id' => $model->GCCD_Id, 'type' => 'grupo')),
);

?>
<!-- <img class="imprimir" width="100px" src="<?php echo Yii::app()->theme->baseUrl . "/img/brand.png"; ?>" alt="" /> -->

<!-- <div class="modal-header"> -->

    <!-- <button type="button" class="btn btn-default" data-dismiss="modal" style="float:right">Cerrar</button> -->
    <!-- <button class="btn btn-primary" onclick="window.print();" style="float:right"><i class="fa fa-print"></i>  Imprimir</button> -->
    <!-- <h4 class="modal-title" id="myModalLabel">Comercializadora La Excelencia C.A.</h4> -->
    <address style="position: absolute; top:20px;left: 130px" class="visible-print">
       
        Reporte de <?php echo $tipo == 1 ? "Salida" : "Entrada"; ?> <br> 
        <?php echo isset($fecha) ? "Fecha: ".$fecha."<br/>" :""; ?>
        <?php echo isset($lote) ? "Ticket: ".$lote : ""; ?>
    </address>
<!-- </div> -->
<!-- <div class="row"> -->
    <!-- <div class="col-sm-12"> -->
        <div class="box" style="width:525px">
            <div class="box-title" style="margin-top:0">
                <h3>
                    <i class="fa fa-print"></i>
                    Reporte de <?php echo $tipo == 1 ? "Salida" : "Entrada"; ?>
                    <?php echo isset($resumen) ? "<br/><small><b>Resumen de operaciones</b></small>":""; ?>
                </h3> 
             
                <button type="button" class="btn btn-default" data-dismiss="modal" style="float:right">Cerrar</button>
                <!-- <button class="btn btn-primary" onclick="window.print();" style="float:right"><i class="fa fa-print"></i>  Imprimir</button> -->
                <?php echo isset($lote) ? 
                    CHtml::link('<i class="fa fa-print"></i>  Imprimir', array('print', 'id'=> $lote, 'tipo'=>$tipo, 'grupo'=>$model->GCCD_Id), array('style'=>'float:right;', 'class'=>'btn btn-primary', 'target'=>'_blank')):                    
                    CHtml::link('<i class="fa fa-print"></i>  Imprimir', 
                    // array('print', 'id'=> false, 'tipo'=>$tipo, 'agencia'=>$model->GCCA_Id), 
                    array(
                        'viewSalidaDia',
                        "tipo"=>$tipo, 
                        "agencia"=>$model->GCCD_Id,
                        "view"=>1,
                        "desde" => $desde,
                        "hasta" => $hasta,
                        "print" => true
                    ),
                    array('style'=>'float:right;', 'class'=>'btn btn-primary', 'target'=>'_blank'));                     
                     ?>
                

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
                            <br>
                            Realizado por: <b><?php echo $modell->username;?></b>
                        </address>
                    </div>
                    <div class="invoice-from" style="white-space: normal; width:265px;margin-left:20px">

                        <strong class="truncate"><?php echo $model->GCCD_Cod . " - " . $model->GCCD_Nombre; ?></strong>
                        <address style="width: 240px"> 
                            <br>Responsable: <?php echo $model->GCCD_Responsable; ?>
                            <br>Telefono:  <?php echo $model->GCCD_Telefono; ?>
                            <br><b><?php echo count($modelo)." activos";?></b>

                        </address>
                    </div>

                </div>
                <table class="table table-striped table-condensed table-bordered table-sm table-colored-header">
                    <thead>
                        <tr>
                            <?php echo isset($resumen) ? "<th># Serial</th>":"";?>
                            <th>Id</th>
                            <th># Serial</th>
                            <th>Descripcion</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $id = 1;
                        foreach ($modelo as $model) {
                            ?>   
                            <tr>
                                <td><?php echo $id; ?></td>
                                <td class='time <?php echo isset($resumen) ?"":"hide"?>'><?php echo $model->FCCO_Enabled ==0?'<strike>':''; echo date("d M, h:iA", strtotime($model->FCCO_Timestamp)); echo $model->FCCO_Enabled ==0?'</strike>':''; ?></td>
                                <td class='price'><?php echo $model->FCCO_Enabled ==0?'<strike>':''; echo $model->fCCU->FCCU_Serial; echo $model->FCCO_Enabled ==0?'</strike>':''; ?></td>
                                <td class='name'><?php echo $model->FCCO_Enabled ==0?'<strike>':'';echo $model->fCCU->fCCT->fCCA->FCCA_Descripcion . " " . $model->fCCU->fCCT->FCCT_Descripcion . " | " . $model->fCCU->FCCU_Numero; echo $model->FCCO_Enabled ==0?'</strike>':''; ?></td>

                            </tr>
                            <?php  
                            $id+=1;                          
                        }
                        ?>


                    </tbody>
                </table>
              
                <!--<div id="print-footer">Copyright message</div>-->

                                <!-- <div class="imprimir" style="position: initial; bottom: 80px; border: 1px solid black; height: 150px;width: 600px"> Observaciones:</div> -->
                                <!-- <img class="imprimir pf-footer" style=" margin-left: auto;   margin-right: auto; width: 600px;bottom: 21px; size:5px 11in;position: fixed;" src="<?php echo Yii::app()->theme->baseUrl . "/img/firma.png"; ?>" alt="" /> -->
                <?php echo $tipo == 1 ? "Con este documento el Cliente, quien recibe, acepta la responsabilidad de cuidar los articulos aqui descritos y responder por ellos en caso de robo o perdida." : 
                                        "Con este documento el cliente transfiere sus responsabilidades a la empresa de los articulos arriba descritos" ?>

            </div>
        </div>
    <!-- </div> -->
<!-- </div> -->

