<?php
/* @var $this TccaController */
/* @var $model Tcca */

$this->breadcrumbs=array(
	'Tccas'=>array('index'),
	$model->TCCA_Id=>array('view','id'=>$model->TCCA_Id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Tcca', 'url'=>array('index')),
	array('label'=>'Create Tcca', 'url'=>array('create')),
	array('label'=>'View Tcca', 'url'=>array('view', 'id'=>$model->TCCA_Id)),
	array('label'=>'Manage Tcca', 'url'=>array('admin')),
);
?>

<h1>Update Tcca <?php echo $model->TCCA_Id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>