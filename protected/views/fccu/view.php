<?php
/* @var $this FccuController */
/* @var $model Fccu */

$this->breadcrumbs = array(
    'Fccus' => array('index'),
    $model->FCCU_Id,
);

$this->menu = array(
    //array('label'=>'List Fccu', 'url'=>array('index')),
    array('label' => 'Crear Activo', 'url' => array('add')),
    array('label' => 'Actualizar Activo', 'url' => array('update', 'id' => $model->FCCU_Id)),
    array('label' => 'Recibir Activo', 'visible' => $model->FCCI_Id == 5 ? true : false, 'url' => '#', 'linkOptions' => array('submit' => array('recibe', 'id' => $model->FCCU_Id),
        'params' => array('returnUrl' => Yii::app()->createUrl('fccu/view', array('id' => $model->FCCU_Id))), 'confirm' => 'Seguro quiere recibir este activo?')),
    array('label' => 'Administrar Activos', 'url' => array('admin')),
);
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


<div class="box box-bordered box-color" >
    <div class="box-title" style="width:50%">
        <h3>
            <i class="fa fa-search"></i>

            Activo #<?php echo $model->FCCU_Id; ?>        </h3>
    </div>
    <?php
$this->widget('ext.widgets.DetailView4Col', array(
    'data' => $model,
    'id' => 'view',
    'htmlOptions' => array(
        'class' => 'table table-hover table-nomargin table-condensed ', 
        'style' => 'width:50%'),
    'attributes' => array(
        array(
            'header' => "Datos de " . $model->fCCT->fCCA->fCUU->FCUU_Descripcion,
        ),
        array(
            'name' => 'FCCU_Serial',
            'oneRow' => $model->fCCT->fCCA->FCUU_Id == 1 ? true : false,
        ),
        array('name' => 'FCCU_Numero',
            'value' => $model->FCCU_Numero,
            'visible' => $model->fCCT->fCCA->FCUU_Id == 1 ? false : true,
        ),
        array('name' => 'FCCU_Timestamp',
            'value' => date("d M Y h:i:s A", strtotime($model->FCCU_Timestamp))),
        array('name' => 'FCCI_Id',
            'value' => $model->fCCI->FCCI_Descripcion),
        array('name' => 'FCCU_Facturado',
            'value' => $model->FCCU_Facturado == 0 ? "Sin Facturar" : "Facturado"),
        'FCCU_Cantidad',
        array('name' => 'FCCT_Id',
            'value' => $model->fCCT->fCCA->FCCA_Descripcion . " " . $model->fCCT->FCCT_Descripcion,
            'oneRow' => true),
        ///-------------------------------
        array('header' => 'Datos de la linea',
            'visible' => $model->fCCT->fCCA->FCUU_Id == 2 ? true : false),
        array('name' => 'FCCU_Titular',
            'value' => $model->FCCU_Titular, 'oneRow' => true,
            'visible' => $model->fCCT->fCCA->FCUU_Id == 2 ? true : false),
        array('name' => 'FCCU_Cedula',
            'value' => $model->FCCU_Cedula,
            'visible' => $model->fCCT->fCCA->FCUU_Id == 2 ? true : false),
        array('name' => 'FCCU_FechaNacimiento',
            'value' => $model->FCCU_FechaNacimiento,
            'visible' => $model->fCCT->fCCA->FCUU_Id == 2 ? true : false),
        array('name' => 'FCCU_DiaCorte',
            'value' => $model->FCCU_DiaCorte . " de cada mes",
            'visible' => $model->fCCT->fCCA->FCUU_Id == 2 ? true : false),
        array('name' => 'FCCU_MontoMin',
            'value' => $model->FCCU_MontoMin . " Bs",
            'visible' => $model->fCCT->fCCA->FCUU_Id == 2 ? true : false),
        array('name' => 'FCCU_TipoServicio',
            'value' => $model->FCCU_TipoServicio == 0 ? "No posee" : ($model->FCCU_TipoServicio == 1 ? "Prepago" : "Coorporativa"),
            'visible' => $model->fCCT->fCCA->FCUU_Id == 2 ? true : false),
        array('name' => 'FCCU_ClaveWeb',
            'value' => $model->FCCU_ClaveWeb,
            'visible' => $model->fCCT->fCCA->FCUU_Id == 2 ? true : false),
        array('name' => 'FCCU_ClaveMovil',
            'value' => $model->FCCU_ClaveMovil,
            'visible' => $model->fCCT->fCCA->FCUU_Id == 2 ? true : false),
        array('name' => 'FCCU_ClaveDatos',
            'value' => $model->FCCU_ClaveDatos,
            'visible' => $model->fCCT->fCCA->FCUU_Id == 2 ? true : false),
        //-------------------------------------
        array('name' => 'FCCU_Descripcion',
            'value' => $model->FCCU_Descripcion, 'oneRow' => true),
    ),
));
?>
</div>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'fcco-grid',
    'dataProvider' => $modelo->search(),
    'summaryText' => false,
    'filter' => null,
    'enableSorting' => false,
    'itemsCssClass' => 'table table-striped table-bordered table-hover table-invoice table-colored-header',
    'pagerCssClass' => 'table-pagination',
    'htmlOptions' => array('style' => 'overflow:auto'),
    'pager' => array(
        'htmlOptions' => array('class' => 'pagination'),
        'selectedPageCssClass' => 'active',
    ),
    'columns' => array(
        'FCCU_Id',
        'FCCO_Id',
        array('name' => 'FCCO_Timestamp',
            'value' => 'date("d M Y h:i:s A", strtotime($data->FCCO_Timestamp))',
            'header' => 'Fecha de Asignacion'),
        array(
//        'value' => '$data->lugar',
            'value' => 'CHtml::link($data->lugar,Yii::app()->createUrl(\'fcco/agencia\',array(\'id\'=>$data->GCCA_Id,\'type\'=>1)))',
            'type' => 'raw',
            'header' => 'Grupo/Agencia'),

        array('name' => 'FCCN_Id',
            'header' => 'Operacion',
            'value' => '$data->fCCN->FCCN_Operacion'),

        array('name' => 'FCCN_Id',
            'header' => 'Usuario',
            'value' => 'Pcue::model()->find("PCUE_IdModel=:idmodel",array(":idmodel"=>$data->FCCO_Id))->PCUE_UserId',
        ),
//        array('name' => 'FCCO_Lote', 'type' => 'raw', 'header' => 'Ticket',
        //            'value' => 'CHtml::link("#".$data->FCCO_Lote)',
        //        ),
        array(
            'class' => 'CButtonColumn',
            'header' => 'Accion',
            //'htmlOptions'=>array('class'=>'btn btn-primary'),
            'template' => '{preview}',
//-----------------------------------------------------------------------
            'buttons' => array(
                'preview' => array(
                    'label' => 'Ver Ticket',
                    'url' => 'Yii::app()->createUrl("fcco/view",array("id"=>$data->FCCO_Lote,"tipo"=>$data->FCCN_Id,"view"=>1))',
                    'imageUrl' => Yii::app()->theme->baseUrl . "/img/file.png",
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
            ),
//-----------------------------------------------------------------------
        ),
    ),
));
?>