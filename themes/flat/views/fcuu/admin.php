<?php
/* @var $this FcuuController */
/* @var $model Fcuu */

$this->breadcrumbs=array(
	'Fcuus'=>array('index'),
	'Administrar',
);

$this->menu=array(
//array('label'=>'Listar Fcuu', 'url'=>array('index')),
array('label'=>'Crear Categoria', 'url'=>array('create')),
);


?>

<h1>Administrar Categorias</h1>



<?php $this->widget('zii.widgets.grid.CGridView', array(
'id'=>'fcuu-grid',
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
		'FCUU_Id',
		'FCUU_Descripcion',
		array(
			'name' => 'FCUU_Id',
			'header' => 'Total',
			'value' => '$data->estadisticas',
			'filter' => false,
		),
array(
'class'=>'CButtonColumn','headerHtmlOptions' => array('style' => 'width:83px'),
),
),
)); ?>
