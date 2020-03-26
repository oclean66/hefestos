<?php
/* @var $this FcucController */
/* @var $model Fcuc */

$this->breadcrumbs=array(
	'Fcucs'=>array('index'),
	$model->FCUC_Id=>array('view','id'=>$model->FCUC_Id),
	'Update',
);

$this->menu=array(
	//array('label'=>'List Fcuc', 'url'=>array('index')),
	array('label'=>'Crear Fcuc', 'url'=>array('create')),
	array('label'=>'Ver Fcuc', 'url'=>array('view', 'id'=>$model->FCUC_Id)),
	array('label'=>'Administrar Fcuc', 'url'=>array('admin')),
);
?>

<!--<h1>Update Fcuc <?php echo $model->FCUC_Id; ?></h1>-->

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>