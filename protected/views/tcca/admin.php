<?php
/* @var $this TccaController */
/* @var $model Tcca */

$this->breadcrumbs=array(
	'Tccas'=>array('index'),
	'Manage',
);

$this->menu=array(

	array('label'=>'Crear Tcca', 'url'=>array('create')),
);

?>


<div class="col-sm-12 nopadding">
    <div class="box">
        <div class="box-title">
            <h3>
                <i class="fa fa-home"></i>
                Administrar Tccas.
            </h3>
        </div> 
    </div>
    <div class="box-content nopadding">

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'tcca-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'itemsCssClass' => 'table table-hover table-nomargin table-condensed table-striped',
	'pagerCssClass' => 'table-pagination',
	'pager' => array(
		'htmlOptions' => array('class' => 'pagination'),
		'selectedPageCssClass' => 'active',
	),
	'columns'=>array(
		'TCCA_Id',
		'TCCA_Name',
		'TCCA_Type',
		'TCCA_BoardId',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
</div>
</div>
