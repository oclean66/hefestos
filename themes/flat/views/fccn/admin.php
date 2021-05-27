<?php
/* @var $this FccnController */
/* @var $model Fccn */

$this->breadcrumbs = array(
	'Fccns' => array('index'),
	'Administrar',
);

$this->menu = array(
	//array('label'=>'Listar Fccn', 'url'=>array('index')),
	array('label' => 'Crear Operacion', 'url' => array('create')),
);


?>

<h1>Administrar Operacion</h1>



<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'fccn-grid',
	'dataProvider' => $model->search(),
	'filter' => $model,
	'itemsCssClass' => 'table table-striped table-bordered table-hover',
	'pagerCssClass' => 'table-pagination',
	'pager' => array(
		'htmlOptions' => array('class' => 'pagination'),
		'selectedPageCssClass' => 'active',
	),
	'columns' => array(
		'FCCN_Id',
		'FCCN_Operacion',
		array(
			'class' => 'CButtonColumn', 
			'headerHtmlOptions' => array('class' => 'remover', 'style' => 'width:83px'),
			'template' => '{view}
								<div class="btn-group">
									<a href="#" data-toggle="dropdown" class="btn btn-sm btn-success dropdown-toggle">
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
					'url' => 'Yii::app()->createUrl("fccn/".$data->FCCN_Id)',
					'label' => '<i class="fa fa-eye"></i>',
					'options' => array(
						'target' => '_blank',
						'class' => 'btn btn-sm btn-orange',
						'title' => 'Detalles'
					),
				),
				'update' => array(
					'imageUrl' => false,
					'visble' => 'Yii::app()->user->checkAccess("action_fccn_update")',
					'url' => 'Yii::app()->createUrl("fccn/update/", array("id"=>$data->FCCN_Id))',
					'label' => '<i class="fa fa-pencil"></i>  Editar',
					'options' => array(
						'target' => '_blank',
						'class' => 'btn btn-sm btn-info',
						'title' => 'Editar'
					),
				),
				'delete' => array(
					'imageUrl' => false,
					'visible' => 'Yii::app()->user->checkAccess("action_fccn_delete")',
					'url' => 'Yii::app()->createUrl("fccn/delete", array("id"=>$data->FCCN_Id))',
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