<?php
/* @var $this TccdController */
/* @var $model Tccd */

$this->breadcrumbs=array(
	'Tccds'=>array('index'),
	'Manage',
);

$this->menu=array(

	array('label'=>'Crear Tccd', 'url'=>array('create')),
);

?>


<div class="col-sm-12 nopadding">
    <div class="box">
        <div class="box-title">
            <h3>
                <i class="fa fa-home"></i>
                Administrar Tccds.
            </h3>
        </div> 
    </div>
    <div class="box-content nopadding">

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'tccd-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'itemsCssClass' => 'table table-hover table-nomargin table-condensed table-striped',
	'pagerCssClass' => 'table-pagination',
	'pager' => array(
		'htmlOptions' => array('class' => 'pagination'),
		'selectedPageCssClass' => 'active',
	),
	'columns'=>array(
		'TCCD_Id',
		'TCCD_Title',
		'TCCD_Description',
		'TCCD_Created',
		'TCCD_Expired',
		'TCCD_Order',
		/*
		'TCCA_Id',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
</div>
</div>
