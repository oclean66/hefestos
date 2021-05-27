<?php
/* @var $this FccdController */
/* @var $model Fccd */

$this->breadcrumbs=array(
	'Fccds'=>array('index'),
	'Administrar',
);

$this->menu=array(
array('label'=>'Listar Fccd', 'url'=>array('index')),
array('label'=>'Crear Fccd', 'url'=>array('create')),
);


?>

<h1>Administrar Fccds</h1>



<?php $this->widget('zii.widgets.grid.CGridView', array(
'id'=>'fccd-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'itemsCssClass' => 'table table-striped table-bordered table-hover',
'pagerCssClass' => 'table-pagination',
'pager' => array(
'htmlOptions' => array('class' => 'pagination'),
'selectedPageCssClass' => 'active',
),
'columns'=>array(
		'FCCD_Id',
		'FCCD_Descripcion',
array(
'class'=>'CButtonColumn','headerHtmlOptions' => array('style' => 'width:83px'),
),
),
)); ?>
