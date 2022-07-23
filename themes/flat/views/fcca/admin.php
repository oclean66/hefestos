<?php
/* @var $this FccaController */
/* @var $model Fcca */

$this->breadcrumbs = array(
	'Fccas' => array('index'),
	'Administrar',
);

$this->menu = array(
	//array('label'=>'Listar Tipos', 'url'=>array('index')),//
	array('label' => 'Crear Tipo', 'url' => array('create')),
);


?>

<h1>Administrar Tipos de Activos</h1>



<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'fcca-grid',
	'dataProvider' => $model->search(),
	'filter' => $model,
	'itemsCssClass' => 'table table-striped table-bordered table-hover',
	'pagerCssClass' => 'table-pagination',
	'pager' => array(
		'htmlOptions' => array('class' => 'pagination'),
		'selectedPageCssClass' => 'active',
	),
	'columns' =>
	array(
		'FCCA_Id',
		'FCCA_Descripcion',
		array(
			'name' => 'FCUU_Id',
			'value' => '$data->fCUU->FCUU_Descripcion',
		),
		array(
			'name' => 'FCCA_Id',
			'header' => 'Total',
			'value' => '$data->total',
			'filter' => false,
		),
		array(
			'name' => 'FCCA_StockMin',
			'header' => 'Stock Minimo',
			'value' => '$data->FCCA_StockMin',
			'filter' => false,
		),
		array(
			'name' => 'FCCA_StockMax',
			'header' => 'Stock Maximo',
			'value' => '$data->FCCA_StockMax',
			'filter' => false,
		),
		array(
			'name' => 'FCCA_Stock',
			'header' => 'Stock Disponioble',
			'value' => '$data->FCCA_Stock',
			'filter' => false,
		),
		array(
			'class' => 'CButtonColumn',
			'headerHtmlOptions' => array('class'=> 'remover', 'style' => 'width:83px'),
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
					'url' => 'Yii::app()->createUrl("fcca/".$data->FCCA_Id)',
					'label' => '<i class="fa fa-eye"></i>',
					'options' => array(
						'target' => '_blank',
						'class' => 'btn btn-sm btn-orange',
						'title' => 'Detalles'
					),
				),
				'update' => array(
					'imageUrl' => false,
					'visible' => 'Yii::app()->user->checkAccess("action_fcca_update")',
					'url' => 'Yii::app()->createUrl("fcca/update/", array("id"=>$data->FCCA_Id))',
					'label' => '<i class="fa fa-pencil"></i>  Editar',
					'options' => array(
						'target' => '_blank',
						'class' => 'btn btn-sm btn-info',
						'title' => 'Editar'
					),
				),
				'delete' => array(
					'imageUrl' => false,
					'visible' => 'Yii::app()->user->checkAccess("action_fcca_delete")',
					'url' => 'Yii::app()->createUrl("fcca/delete/", array("id"=>$data->FCCA_Id))',
					'label' => '<i class="fa fa-trash-o"></i>  Eliminar',
					'options' => array(
						'class' => 'btn btn-sm btn-danger',
						'title' => 'Eliminar'
					),
				),
			),
		),
	),
)); ?>