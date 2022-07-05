<?php
/* @var $this FccaController */
/* @var $model Fcca */

$this->breadcrumbs = array(
	'Fccm' => array('index'),
	'Administrar',
);

$this->menu = array(
	//array('label'=>'Listar Tipos', 'url'=>array('index')),//
	array('label' => 'Crear Marca', 'url' => array('create')),
);


?>

<h1>Administrar Marcas de Activos</h1>



<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'fccm-grid',
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
		'FCCM_Id',
		'FCCM_Descripcion',
		array(
			'name' => 'FCCM_Id',
			'header' => 'Total',
			'value' => '$data->total',
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
					'url' => 'Yii::app()->createUrl("fccm/".$data->FCCM_Id)',
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
					'url' => 'Yii::app()->createUrl("fccm/update/", array("id"=>$data->FCCM_Id))',
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
					'url' => 'Yii::app()->createUrl("fccm/delete/", array("id"=>$data->FCCM_Id))',
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