<?php
/* @var $this TccnController */
/* @var $model Tccn */

$this->breadcrumbs=array(
	'Tccns'=>array('index'),
	$model->TCCN_Id,
);

$this->menu=array(
	array('label'=>'List Tccn', 'url'=>array('index')),
	array('label'=>'Create Tccn', 'url'=>array('create')),
	array('label'=>'Update Tccn', 'url'=>array('update', 'id'=>$model->TCCN_Id)),
	array('label'=>'Delete Tccn', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->TCCN_Id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Tccn', 'url'=>array('admin')),
);
?>

<h1>View Tccn #<?php echo $model->TCCN_Id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'TCCN_Id',
		'TCCN_Title',
		'TCCN_Thread',
		'TCCN_Url',
		'TCCN_Created',
		'TCCN_Read',
		'TCCN_IdUSer',
	),
)); ?>
