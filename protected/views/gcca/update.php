<?php
/* @var $this GccaController */
/* @var $model Gcca */

$this->breadcrumbs=array(
	'Gccas'=>array('index'),
	$model->GCCA_Id=>array('view','id'=>$model->GCCA_Id),
	'Update',
);

$this->menu=array(
	//array('label'=>'List Gcca', 'url'=>array('index')),
	array('label'=>'Crear Gcca', 'url'=>array('create')),
	array('label'=>'Ver Gcca', 'url'=>array('view', 'id'=>$model->GCCA_Id)),
	array('label'=>'Administrar Gcca', 'url'=>array('admin')),
);
?>

<!--<h1>Update Gcca <?php echo $model->GCCA_Id; ?></h1>-->

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>