<?php
/* @var $this FccaController */
/* @var $model Fcca */

$this->breadcrumbs=array(
	'Fccas'=>array('index'),
	'Administrar',
);

$this->menu=array(
//array('label'=>'Listar Tipos', 'url'=>array('index')),//
array('label'=>'Crear Tipo', 'url'=>array('create')),
);


?>

<h1>Administrar Tipos de Activos</h1>



<?php $this->widget('zii.widgets.grid.CGridView', array(
'id'=>'fcca-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'itemsCssClass' => 'table table-striped table-bordered table-hover',
'pagerCssClass' => 'table-pagination',
'pager' => array(
'htmlOptions' => array('class' => 'pagination'),
'selectedPageCssClass' => 'active',
),
'columns'=>
	array(
		'FCCA_Id',
		'FCCA_Descripcion',
		array(
			'name'=> 'FCUU_Id',
			'value'=>'$data->fCUU->FCUU_Descripcion'
		),
		array(
		'class'=>'CButtonColumn',
		'headerHtmlOptions' => array('style' => 'width:83px'),
		),
	),
)); ?>
