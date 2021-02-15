<?php
/* @var $this FcctController */
/* @var $model Fcct */

$this->breadcrumbs=array(
	'Fccts'=>array('index'),
	'Administrar',
	);

$this->menu=array(
//array('label'=>'Listar Fcct', 'url'=>array('index')),
	array('label'=>'Crear Modelo', 'url'=>array('create')),
	);


	?>

	<h1>Administrar Modelos</h1>



	<?php $this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'fcct-grid',
		'dataProvider'=>$model->search(),
		'filter'=>$model,
		'itemsCssClass' => 'table table-striped table-bordered table-hover',
		'pagerCssClass' => 'table-pagination',
		'pager' => array(
			'htmlOptions' => array('class' => 'pagination'),
			'selectedPageCssClass' => 'active',
			),
		'columns'=>array(
			// 'FCCT_Id',
			'FCCT_Descripcion',
			//'FCCA_Id',
			array(
				'name'=>'FCCA_Id',
				'value'=>'$data->fCCA->FCCA_Descripcion',
				'filter' => CHtml::listData(Fcca::model()->findAll('1 order by FCCA_Descripcion'),'FCCA_Id', 'FCCA_Descripcion'),
			),
			array(
				'name'=>'FCCA_Id',
				'header'=>'Categoria',
				'value'=>'$data->fCCA->fCUU->FCUU_Descripcion',
				'filter' => CHtml::listData(Fcuu::model()->findAll('1 order by FCUU_Descripcion'),'FCUU_Id', 'FCUU_Descripcion'),
			),
			array(
				'class'=>'CButtonColumn',
				'headerHtmlOptions' => array('style' => 'width:83px'),
				),
			),
			)); ?>
