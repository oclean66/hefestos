<?php
/* @var $this TccdController */
/* @var $model Tccd */

$this->breadcrumbs=array(
	'Tccds'=>array('index'),
	$model->TCCD_Id=>array('view','id'=>$model->TCCD_Id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Tccd', 'url'=>array('index')),
	array('label'=>'Create Tccd', 'url'=>array('create')),
	array('label'=>'View Tccd', 'url'=>array('view', 'id'=>$model->TCCD_Id)),
	array('label'=>'Manage Tccd', 'url'=>array('admin')),
);
?>

<h1>Update Tccd <?php echo $model->TCCD_Id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>