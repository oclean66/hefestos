<?php
/* @var $this FccnController */
/* @var $model Fccn */

$this->breadcrumbs=array(
	'Fccns'=>array('index'),
	'Administrar',
);

$this->menu=array(
//array('label'=>'Listar Fccn', 'url'=>array('index')),
array('label'=>'Crear Operacion', 'url'=>array('create')),
);


?>

<h1>Administrar Operacion</h1>



<?php $this->widget('zii.widgets.grid.CGridView', array(
'id'=>'fccn-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'itemsCssClass' => 'table table-striped table-bordered table-hover',
'pagerCssClass' => 'table-pagination',
'pager' => array(
'htmlOptions' => array('class' => 'pagination'),
'selectedPageCssClass' => 'active',
),
'columns'=>array(
		'FCCN_Id',
		'FCCN_Operacion',
array(
'class'=>'CButtonColumn','headerHtmlOptions' => array('style' => 'width:83px'),
),
),
)); ?>
