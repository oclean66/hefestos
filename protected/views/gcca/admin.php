<?php
/* @var $this GccaController */
/* @var $model Gcca */

$this->breadcrumbs = array(
    'Gccas' => array('index'),
    'Administrar',
);

$this->menu = array(
//array('label'=>'Listar Agencias', 'url'=>array('index')),
    array('label' => 'Crear Agencia', 'url' => array('create')),
);
?>

<h1>Administrar Agencias</h1>



<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'gcca-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'itemsCssClass' => 'table table-striped table-bordered table-hover',
    'pagerCssClass' => 'table-pagination',
    'htmlOptions' => array('style' => 'overflow:auto'),
    'pager' => array(
        'htmlOptions' => array('class' => 'pagination'),
        'selectedPageCssClass' => 'active',
    ),
    'columns' => array(
        array('name' => 'GCCA_Id',
            'visible'=>'true'),
        array('name' => 'GCCA_Cod',
            'value' => 'CHtml::link(
                $data->GCCA_Cod, 
                Yii::app()->createUrl("fcco/agencia",array("id"=>$data->GCCA_Id,"type"=>$data->GCCA_Id)),
                array("target"=>"_blank"))',
            'type' => 'raw'),
        'GCCA_Nombre',
        array('name' => 'GCCD_Id',
            'value' => 'CHtml::link($data->gCCD->concatened, Yii::app()->createUrl("fcco/grupo",array("id"=>$data->GCCD_Id,"type"=>$data->GCCA_Id)))',
            'type' => 'raw'),
        array('name' => 'GCCA_Direccion',
            'value' => 'CHtml::link(substr($data->GCCA_Direccion, 0, 15)."...","#",array("rel"=>"popover", "data-trigger"=>"hover", "title"=>"Direccion", "data-placement"=>"top", "data-content"=>$data->GCCA_Direccion))',
            'type' => 'raw'
        ),
        'GCCA_Responsable',
        'GCCA_Telefono',
        array(
            'class' => 'CButtonColumn', 
            'headerHtmlOptions' => array('style' => 'width:83px'),
            'template' => '{view} {update} {delete}',
            'buttons' => array(
                'view' => array( 
                    'label' => "Detalles",
                    'url' => 'Yii::app()->createUrl("gcca/view/",array("id"=>$data->GCCA_Id))',
                    'options' => array('target' => '_blank'),
                ),
                'update' => array( 
                    'label' => "Detalles", 
                    'url' => 'Yii::app()->createUrl("gcca/update/",array("id"=>$data->GCCA_Id))',
                    'options' => array('target' => '_blank'),
                ),
                ),
        ),
    ),
));
?>
