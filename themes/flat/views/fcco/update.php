<?php
/* @var $this FccoController */
/* @var $model Fcco */

$this->breadcrumbs=array(
	'Fccos'=>array('index'),
	$model->FCCO_Id=>array('view','id'=>$model->FCCO_Id),
	'Update',
);

$this->menu=array(
	//array('label'=>'List Fcco', 'url'=>array('index')),
	array('label'=>'Crear Fcco', 'url'=>array('create')),
	array('label'=>'Ver Fcco', 'url'=>array('view', 'id'=>$model->FCCO_Id)),
	array('label'=>'Administrar Fcco', 'url'=>array('admin')),
);
?>

<!--<h1>Update Fcco <?php echo $model->FCCO_Id; ?></h1>-->

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>