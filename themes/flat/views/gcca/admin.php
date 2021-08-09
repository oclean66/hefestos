<?php
/* @var $this GccaController */
/* @var $model Gcca */


$this->menu = array(
    array('label' => 'Arbol de Sistema', 'url' => array('/fcco/admin')),
    array('label' => 'Crear Agencia', 'url' => array('create')),
);
?>

<!-- <div id="box" class="box"></div> -->
<div class="col-sm-12 nopadding">
    <div class="box">
        <div class="box-title">
            <h3>
                <i class="fa fa-desktop"></i>
                <?php echo CrugeTranslator::t('app', 'Administrar Agencias') ?>

            </h3>
        </div>
    </div>
    <div class="box-content nopadding">
        <?php
        $this->widget('zii.widgets.grid.CGridView', array(
            'id' => 'gcca-grid',
            'dataProvider' => $model->search(),
            'filter' => $model,
            'afterAjaxUpdate' => 'ActivarSelects',
            'itemsCssClass' => 'table table-hover table-nomargin table-condensed  table-mail',
            'pagerCssClass' => 'table-pagination',
            'htmlOptions' => array('style' => 'overflow:auto'),
            'pager' => array(
                'htmlOptions' => array('class' => 'pagination remover'),
                'selectedPageCssClass' => 'active',
            ),
            'columns' => array(
                array(
                    'name' => 'GCCA_Status',
                    'header' => 'Estado',
                    'value' => '($data->GCCA_Status==0?
                    "<i class=\"fa fa-times\"></i>":
                        ($data->GCCA_Status==1?
                        "<i class=\"fa fa-check\"></i>":
                        ($data->GCCA_Status==2?
                        "<i class=\"fa fa-eye-slash\"></i>":
                        "<i class=\"fa fa-warning\"></i>"
                        )))." ".$data->GCCA_Id',
                    'type' => 'raw',
                    'filter' => CHtml::dropDownList(
                        'Gcca[GCCA_Status]',
                        $model->GCCA_Status,
                        array(
                            '0' => " Inactivas",
                            "1" => "Activas",
                            "2" => "Ocultas"
                        ),
                        array('empty' => 'Todas')
                    ),

                ),
                array(
                    'name' => 'GCCA_Cod',
                    'value' => '$data->GCCA_Cod',
                    'type' => 'raw',
                    'headerHtmlOptions' => array('style' => 'width:83px'),
                ),
                'GCCA_Nombre',
                array(
                    'name' => 'GCCD_Id',
                    'value' => '$data->gCCD->concatened',
                    'footerHtmlOptions' => array('class' => 'select2-me'),
                    'filter' => CMap::mergeArray(array('' => 'Todos'), CHtml::listData(Gccd::model()->findAll(), "GCCD_Id", "concatened")),
                ),
                'GCCA_Responsable',
                'GCCA_Telefono',
                array(
                    'class' => 'CButtonColumn',
                    'headerHtmlOptions' => array('class' => 'remover', 'style' => 'width:83px'),
                    'template' => '{view} 
                                        <div class="btn-group">
                                            <a href="#" data-toggle="dropdown" class="btn btn-success btn-sm dropdown-toggle">
                                                <i class="fa fa-bars"></i>
                                            </a>
                                            <ul class="dropdown-menu pull-right" style="min-width:0">
                                                <li>{update}</li>
                                                <li>{delete}</li>
                                            </ul>
                                        </div>',
                    'buttons' => array(
                        'view' => array(
                            'imageUrl' => false,
                            'label' => '<i class="fa fa-eye"></i>',
                            'visible' => 'Yii::app()->user->checkAccess("action_fcco_agencia")',
                            'url' => 'Yii::app()->createUrl("fcco/agencia",array("id"=>$data->GCCA_Id,"type"=>$data->GCCA_Id))',/* 'Yii::app()->createUrl("gcca/view/",array("id"=>$data->GCCA_Id))', */
                            'options' => array('target' => '_blank', 'class' => 'not-link btn btn-sm btn-orange', 'title' => 'Detalles'),
                        ),
                        'update' => array(
                            'label' => '<i class="fa fa-pencil"></i> Editar',
                            'visible' => 'Yii::app()->user->checkAccess("action_gcca_update")',
                            'url' => 'Yii::app()->createUrl("gcca/update/",array("id"=>$data->GCCA_Id))',
                            'options' => array('target' => '_blank', 'class' => 'not-link  btn btn-sm btn-info text-left', 'title' => 'Editar'),
                            'imageUrl' => false,
                        ),
                        'delete' => array(
                            'label' => '<i class="fa fa-trash-o"></i> Ocultar',
                            'visible' => 'Yii::app()->user->checkAccess("action_gcca_delete")',
                            'url' => 'Yii::app()->createUrl("gcca/delete/", array("id"=>$data->GCCA_Id))',
                            'imageUrl' => false,
                            'options' => array('class' => 'not-link btn btn-sm btn-danger', 'title' => 'Ocultar'),
                        )
                    ),
                ),
            ),
        ));
        ?>

    </div>
</div>