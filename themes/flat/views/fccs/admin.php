<?php
/* @var $this FccsController */
/* @var $model Fccs */

$this->breadcrumbs=array(
	'Fccs'=>array('index'),
	'Administrar',
);

$this->menu=array(
array('label'=>'Listar Fccs', 'url'=>array('index')),
array('label'=>'Crear Fccs', 'url'=>array('create')),
);


?>

<h1>Administrar Fccs</h1>



<?php $this->widget('zii.widgets.grid.CGridView', array(
'id'=>'fccs-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'itemsCssClass' => 'table table-striped table-bordered table-hover',
'pagerCssClass' => 'table-pagination',
'pager' => array(
'htmlOptions' => array('class' => 'pagination'),
'selectedPageCssClass' => 'active',
),
'columns'=>array(
		'FCCS_Id',
		'FCCS_Fecha',
		'FCCS_Control',
array(
'class'=>'CButtonColumn','headerHtmlOptions' => array('style' => 'width:83px'),
),
),
)); ?>
