<?php

/* @var $this GccdController */
/* @var $model Gccd */

$this->menu = array(
    array('label' => 'Arbol de Grupos', 'url' => array('/gccd/index')),
    array('label' => 'Crear Grupo', 'url' => array('create')),
);

$this->breadcrumbs = array(
    'Gccds' => array('index'),
    'Manage',
);


$this->beginWidget('zii.widgets.CPortlet', array(
    'title' => "
<h2>Administrar Grupos</h2>",
));

$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'gccd-grid',
    'itemsCssClass' => 'table table-striped table-bordered table-hover',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'itemsCssClass' => 'table table-hover table-nomargin table-bordered',
    'pagerCssClass' => 'table-pagination',
    'afterAjaxUpdate' => 'ActivarSelects',
    'pager' => array(
        'htmlOptions' => array('class' => 'pagination'),
        'selectedPageCssClass' => 'active',
    ),
    'ajaxUpdate' => true,
    'columns' => array(
        //array('name' => 'GCCD_Cod', 'header' => 'Codigo'),
         array('name' => 'GCCD_Cod',
            'value' => 'CHtml::link($data->GCCD_Cod, Yii::app()->createUrl("fcco/grupo",array("id"=>$data->GCCD_Id,"type"=>$data->GCCD_Id)))',
            'type' => 'raw'),
        array('name' => 'GCCD_Nombre', 'header' => 'Nombre'),
        array(
            'name' => 'GCCD_IdSuperior','header'=>'Padre',
            'value' => '$data->GCCD_IdSuperior==null ? "" : $data->gCCDIdSuperior->concatened',
            'filter' => CHtml::listData(Gccd::model()->findAll('1 order by GCCD_Cod'), 'GCCD_Id', 'concatened'),
        ),
         array('name' => 'GCCD_Estado', 'header' => 'Estado',  'value' => '$data->GCCD_Estado==1 ? "Activa" : "Inactiva"',),
        array('name' => 'GCCD_Responsable', 'header' => 'Responsable'),
        array('name' => 'GCCD_Telefono', 'header' => 'Telefono'),
        array(
            'class' => 'CButtonColumn',
            'header' => 'Acciones',
            'headerHtmlOptions'=>array('style'=>'width:100px')
        ),
    ),
));
$this->endWidget();
