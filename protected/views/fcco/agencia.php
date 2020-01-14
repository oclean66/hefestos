<?php
/* @var $this FccoController */
/* @var $model Fcco */

$this->breadcrumbs = array(
    'Fccos' => array('index'),
    'Administrar',
);


$this->menu = array(
    array('label' => 'Ver grupo', 'url' => CController::createUrl('grupo', array('id' => $agencia->GCCD_Id, 'type' => 1))),
    array('label' => 'Asignar Activos', 'url' => array('create')),
     array('label' => 'Administrar Agencias', 'url' => CController::createUrl('gcca/admin')),
     array('label' => 'Eliminar Agencia', 'url' => CController::createUrl('gcca/delete', array('id' => $agencia->GCCA_Id))),
);

foreach ($count as $key => $value) {
    $this->widget[] = array('label' => $key, 'data' => $value[$key][0]);
}
?>

<div id="modal-1" class="modal fade" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content" >				
            <!-- /.modal-header -->
            <div class="modal-body" id="modal-body">
                 <div id="ticketVirtual" class="span3"  style="min-height: 100px; width: 96%;" ></div>
            </div>
            <!-- /.modal-body -->
           
            <!-- /.modal-footer -->
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>



<div class="box box-bordered box-color hidden-print">
    <div class="box-title">
        <a target="_blank" href="<?php echo Yii::app()->createUrl("fcco/agencia",array("id"=>$agencia->GCCA_Id,"type"=>$agencia->GCCA_Id))?>">
            <h3>
                <i class="fa fa-th-list"></i>Agencia <?php echo $agencia->concatened . " | Grupo " . $agencia->gCCD->concatened; ?>
            </h3>
        </a>
    </div>
    <div class="box-content nopadding">


        <?php
        $this->widget('zii.widgets.grid.CGridView', array(
            'id' => 'fcco-grid',
            'dataProvider' => $model->search(),
            'filter' => $model,
            'itemsCssClass' => 'table table-striped table-bordered table-hover table-invoice',
            'pagerCssClass' => 'table-pagination',
            'htmlOptions' => array('style' => 'overflow:auto'),
            'pager' => array(
                'htmlOptions' => array('class' => 'pagination'),
                'selectedPageCssClass' => 'active',
            ),
            'columns' => array(
                array('name' => 'FCCO_Timestamp', 'header' => 'Fecha de Asignacion','value'=>'date("d M Y h:i:s A" , strtotime($data->FCCO_Timestamp))'),
                 
                array('name' => 'FCCU_Serial', 'header' => 'Serial', 'value' => '$data->fCCU->FCCU_Serial'),
                //verificacion
                array('name' => 'GCCA_Id', 'header' => 'Agencia','visible'=>Yii::app()->user->isSuperAdmin),
                array('name' => 'FCCN_Id', 'header' => 'tipo','visible'=>Yii::app()->user->isSuperAdmin),
                array('name' => 'FCCO_Enabled','visible'=>Yii::app()->user->isSuperAdmin),
                  array('value'=>'$data->gCCD->GCCD_Nombre."/".$data->gCCD->GCCD_Id','header'=>'Grupo','visible'=>Yii::app()->user->isSuperAdmin),
                //campos de busqueda relacionada
                array(
                    'name' => 'FCCU_Numero', 'header' => 'Numero',
                    'filter' => CHtml::activeTextField($model, 'FCCU_Numero'),
                    'value' => '!isset($data->fCCU->FCCU_Numero)?"No aplica":$data->fCCU->FCCU_Numero',
                ),
                array(
                    'name' => 'FCUU_Descripcion', 'header' => 'Categoria',
                    'filter' => CHtml::activeTextField($model, 'FCUU_Descripcion'),
                    'value' => '$data->fCCU->fCCT->fCCA->fCUU->FCUU_Descripcion',
                ),
                array(
                    'name' => 'FCCA_Descripcion', 'header' => 'Tipo',
                    'filter' => CHtml::activeTextField($model, 'FCCA_Descripcion'),
                    'value' => '$data->fCCU->fCCT->fCCA->FCCA_Descripcion',
                ),
                array(
                    'name' => 'FCCT_Descripcion', 'header' => 'Modelo',
                    'filter' => CHtml::activeTextField($model, 'FCCT_Descripcion'),
                    'value' => '$data->fCCU->fCCT->FCCT_Descripcion',
                ),
//                array('name' => 'FCCO_Lote', 'type' => 'raw',
//                    'value' => 'CHtml::Link("Ver Ticket: ".$data->FCCO_Lote, "#modal-1",'
//                    . 'array("role"=>"button", "class"=>"btn", "data-toggle"=>"modal","href"=>"#modal-1"))',
//                ),
                array(
                    'class' => 'CButtonColumn',
                    'header' => 'Accion',
                    //'htmlOptions'=>array('class'=>'btn btn-primary'),
                    'template' => '{preview}{recibe}',                                        
//-----------------------------------------------------------------------
                    'buttons' => array(
                        'preview' =>
                        array(
                            'label'=>'Ver Ticket',
                            'url' => 'Yii::app()->createUrl("fcco/view",array("id"=>$data->FCCO_Lote,"tipo"=>1,"view"=>1))',
                            'imageUrl'=>Yii::app()->theme->baseUrl . "/img/page.png",
                            'options' => array(
                                'ajax' => array(
                                    'type' => 'GET',
                                    // ajax post will use 'url' specified above 
                                    'url' => "js:$(this).attr('href')",
                                    
                                    'update' => '#ticketVirtual',
                                    'beforeSend' => "function(){                                
                                       $('#modal-1').modal('show');
                                       $('#ticketVirtual').html('<div class=\"progress progress-striped active\"><div class=\"progress-bar\" role=\"progressbar\" aria-valuenow=\"100\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width: 100%\"><span class=\"sr-only\">45% Complete</span></div></div>');                                      
                                    }",
                                    'complete' => "function(){
                                        $('#ticketVirtual').removeClass('loading');                                 
                                    }",
                                ),
                            ),
//                            'options'=>array(
//                                'class'=>'btn',
//                                'id'=>$data->FCCO_Lote
//                            ),
                        ),
                        
                       'recibe' => array(
                    'label' => 'Recibir', // text label of the button
                    'url' => 'Yii::app()->createUrl("fcco/recibe",array("id"=>$data->FCCU_Id))', // a PHP expression for generating the URL of the button
                    'imageUrl' => Yii::app()->theme->baseUrl.'/img/computer_go.png', // image URL of the button. If not set or false, a text link is used
//                    'visible' =>'$data->FCCI_Id==5?true:false', // a PHP expression for determining whether the button is visible
                ),
                    ),
//-----------------------------------------------------------------------
                ),
            ),
        ));
        ?>

    </div>
</div>
