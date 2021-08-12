<?php

/* @var $this GccdController */
/* @var $model Gccd */

$this->menu = array(
    array('label' => 'Arbol de Grupos', 'url' => array('/fcco/admin')),
    array('label' => 'Crear Grupo', 'url' => array('create')),
);

?>

<div class="col-sm-12 nopadding">
    <div class="box">
        <div class="box-title">
            <h3>
                <i class="fa fa-users"></i>
                Administrar Grupos
            </h3>
        </div>
        <div class="box-content nopadding">
            <?php

            $this->widget('zii.widgets.grid.CGridView', array(
                'id' => 'gccd-grid',
                'itemsCssClass' => 'table table-hover table-nomargin table-condensed table-striped table-mail',
                'dataProvider' => $model->search(),
                'filter' => $model,
                'pagerCssClass' => 'table-pagination',
                'afterAjaxUpdate' => 'ActivarSelects',
                'pager' => array(
                    'htmlOptions' => array('class' => 'pagination'),
                    'selectedPageCssClass' => 'active',
                ),
                'ajaxUpdate' => true,
                'columns' => array(
                    //array('name' => 'GCCD_Cod', 'header' => 'Codigo'),
                    array(
                        'name' => 'GCCD_Cod',
                        'value' => 'CHtml::link($data->GCCD_Cod, Yii::app()->createUrl("fcco/grupo",array("id"=>$data->GCCD_Id,"type"=>$data->GCCD_Id)))',
                        'type' => 'raw'
                    ),
                    array('name' => 'GCCD_Nombre', 'header' => 'Nombre'),
                    array(
                        'name' => 'GCCD_IdSuperior', 'header' => 'Padre',
                        'value' => '$data->GCCD_IdSuperior==null ? "" : $data->gCCDIdSuperior->concatened',
                        'filter' => CHtml::listData(Gccd::model()->findAll('1 order by GCCD_Cod'), 'GCCD_Id', 'concatened'),
                    ),
                    array(
                        'name' => 'GCCD_Estado',
                        'header' => 'Estado',
                        'value' => '$data->GCCD_Estado==1 ? "Activa" : ($data->GCCD_Estado==2 ? "Oculta" : "Inactiva") ',
                        'filter' => array(
                            '' => 'Todos',
                            '0' => 'Inactivos',
                            '1' => 'Activos',
                            '2' => 'Ocultos',
                        ),
                    ),
                    // array('name' => 'GCCD_Responsable', 'header' => 'Responsable'),
                    // array('name' => 'GCCD_Telefono', 'header' => 'Telefono'),
                    array(
                        'class' => 'CButtonColumn',
                        'header' => 'Acciones',
                        'headerHtmlOptions' => array('class' => 'remover', 'style' => 'width:100px'),
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
                                'url' => 'Yii::app()->createUrl("gccd/".$data->GCCD_Id)',
                                'options' => array(
                                    'target' => '_blank',
                                    'class' => 'btn btn-sm btn-orange', 'title' => 'Detalles'
                                ),
                            ),
                            'update' => array(
                                'imageUrl' => false,
                                'label' => '<i class="fa fa-pencil"></i>  Editar',
                                'visible' => 'Yii::app()->user->checkAccess("action_gccd_update")',
                                'url' => 'Yii::app()->createUrl("gccd/update/", array("id"=>$data->GCCD_Id))',
                                'options' => array(
                                    'target' => '_blank',
                                    'class' => 'btn btn-sm btn-info'
                                ),
                            ),
                            'delete' => array(
                                'imageUrl' => false,
                                'label' => '<i class="fa fa-trash-o"></i>  Eliminar',
                                'visible' => 'Yii::app()->user->checkAccess("action_gccd_delete")',
                                'url' => 'Yii::app()->createUrl("gccd/delete/", array("id"=>$data->GCCD_Id))',
                                'options' => array(
                                    'class' => 'btn btn-sm btn-danger'
                                ),
                            ),
                        ),
                    ),
                ),
            ));
            ?>
        </div>
    </div>
</div>