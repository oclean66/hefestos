<?php
/* @var $this TccnController */
/* @var $model Tccn */

$this->breadcrumbs=array(
	'Tccns'=>array('index'),
	'Manage',
);

$this->menu=array(

	array('label'=>'Crear Tccn', 'url'=>array('create')),
);

?>


<div class="col-sm-12 nopadding">
    <div class="box">
        <div class="box-title">
            <h3>
                <i class="fa fa-home"></i>
                Administrar Tccns.
            </h3>
        </div> 
    </div>
    <div class="box-content nopadding">

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'tccn-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'itemsCssClass' => 'table table-hover table-nomargin table-condensed table-striped',
	'pagerCssClass' => 'table-pagination',
	'pager' => array(
		'htmlOptions' => array('class' => 'pagination'),
		'selectedPageCssClass' => 'active',
	),
	'columns'=>array(
		'TCCN_Id',
		'TCCN_Title',
		'TCCN_Thread',
		'TCCN_Url',
		'TCCN_Created',
		'TCCN_Read',
		/*
		'TCCN_IdUSer',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
</div>
</div>
