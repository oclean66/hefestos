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
				'name'=>'FCCA_Id',
				'header'=>'Total',
				'value'=>'$data->total',
				'filter' => false,
			),
			array(
				'name'=>'FCCT_Costo',
				'header'=>'Costo',
				'value'=>'$data->FCCT_Costo',
				'filter' => false,
			),
			array(
				'name'=>'FCCT_Venta',
				'header'=>'Venta',
				'value'=>'$data->FCCT_Venta',
				'filter' => false,
			),
			array(
				'class'=>'CButtonColumn',
				'headerHtmlOptions' => array('class' => 'remover', 'style' => 'width:83px'),
				'template' => '{view}
									<div class="btn-group">
										<a href="#" data-toggle="dropdown" class="btn btn-success btn-sm dropdown-toggle">
											<i class="fa fa-bars"></i>
										</a>
										<ul class="dropdown-menu pull-right" style="min-width:0">
											<li>{update}</li>
											<li>{delete}</li>
										</ul>
									</div',
				'buttons' => array(
					'view' => array(
						'imageUrl' => false,
						'url' => 'Yii::app()->createUrl("fcct/".$data->FCCT_Id)',
						'label' => '<i class="fa fa-eye"></i>',
						'options' => array(
							'target' => '_blank',
							'class' => 'btn btn-sm btn-orange',
							'title' => 'Detalles'
						),
					),
					'update' => array(
						'imageUrl' => false,
						'visible' => 'Yii::app()->user->checkAccess("action_fcct_update")',
						'url' => 'Yii::app()->createUrl("fcct/update/", array("id"=>$data->FCCT_Id))',
						'label' => '<i class="fa fa-pencil"></i>  Editar',
						'options' => array(
							'target' => '_blank',
							'class' => 'btn btn-sm btn-info',
							'title' => 'Editar'
						),
					),
					'delete' => array(
						'imageUrl' => false,
						'visible' => 'Yii::app()->user->checkAccess("action_fcct_delete")',
						'url' => 'Yii::app()->createUrl("fcct/delete", array("id"=>$data->FCCT_Id))',
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
