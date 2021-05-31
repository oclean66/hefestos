<?php
/* @var $this FcciController */
/* @var $model Fcci */

$this->breadcrumbs = array(
    'Fccis' => array('index'),
    'Administrar',
);

$this->menu = array(
    array('label' => 'Listar Fcci', 'url' => array('index')),
    array('label' => 'Crear Fcci', 'url' => array('create')),
);
?>

<h1>Administrar Estado</h1>



<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'fcci-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'itemsCssClass' => 'table table-striped table-bordered table-hover',
    'pagerCssClass' => 'table-pagination',
    'pager' => array(
        'htmlOptions' => array('class' => 'pagination'),
        'selectedPageCssClass' => 'active',
    ),
    'columns' => array(
        'FCCI_Id',
        'FCCI_Descripcion',
        array(
            'class' => 'CButtonColumn', 'headerHtmlOptions' => array('class' => 'remover', 'style' => 'width:83px'),
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
					'url' => 'Yii::app()->createUrl("fcci/".$data->FCCI_Id)',
					'label' => '<i class="fa fa-eye"></i>',
					'options' => array(
						'target' => '_blank',
						'class' => 'btn btn-sm btn-orange',
						'title' => 'Detalles'
					),
				),
				'update' => array(
					'imageUrl' => false,
					'visible' => 'Yii::app()->user->checkAccess("action_fcci_update")',
					'url' => 'Yii::app()->createUrl("fcci/update/", array("id"=>$data->FCCI_Id))',
					'label' => '<i class="fa fa-pencil"></i>  Editar',
					'options' => array(
						'target' => '_blank',
						'class' => 'btn btn-sm btn-info',
						'title' => 'Editar'
					),
				),
				'delete' => array(
					'imageUrl' => false,
					'visible' => 'Yii::app()->user->checkAccess("action_fcci_delete")',
					'url' => 'Yii::app()->createUrl("fcci/delete", array("id"=>$data->FCCI_Id))',
					'label' => '<i class="fa fa-trash-o"></i>  Eliminar',
					'options' => array(
						'class' => 'btn btn-sm btn-danger',
						'title' => 'Eliminar'
					),
				),
			),
        ),
    ),
));
?>