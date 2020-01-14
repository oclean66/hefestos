<?php
/* @var $this FccsController */
/* @var $model Fccs */

$this->breadcrumbs=array(
	'Fccs'=>array('index'),
	$model->FCCS_Id=>array('view','id'=>$model->FCCS_Id),
	'Update',
);

$this->menu=array(
	//array('label'=>'List Fccs', 'url'=>array('index')),
	array('label'=>'Crear Fccs', 'url'=>array('create')),
	array('label'=>'Ver Fccs', 'url'=>array('view', 'id'=>$model->FCCS_Id)),
	array('label'=>'Administrar Fccs', 'url'=>array('admin')),
);
?>

<!--<h1>Update Fccs <?php echo $model->FCCS_Id; ?></h1>-->

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>