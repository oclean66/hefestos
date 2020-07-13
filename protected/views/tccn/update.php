<?php
/* @var $this TccnController */
/* @var $model Tccn */

$this->breadcrumbs=array(
	'Tccns'=>array('index'),
	$model->TCCN_Id=>array('view','id'=>$model->TCCN_Id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Tccn', 'url'=>array('index')),
	array('label'=>'Create Tccn', 'url'=>array('create')),
	array('label'=>'View Tccn', 'url'=>array('view', 'id'=>$model->TCCN_Id)),
	array('label'=>'Manage Tccn', 'url'=>array('admin')),
);
?>

<h1>Update Tccn <?php echo $model->TCCN_Id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>