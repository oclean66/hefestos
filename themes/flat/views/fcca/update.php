<?php
/* @var $this FccaController */
/* @var $model Fcca */

$this->breadcrumbs=array(
	'Fccas'=>array('index'),
	$model->FCCA_Id=>array('view','id'=>$model->FCCA_Id),
	'Update',
);

$this->menu=array(
	//array('label'=>'List Fcca', 'url'=>array('index')),
	array('label'=>'Crear Tipo', 'url'=>array('create')),
	array('label'=>'Ver Tipo', 'url'=>array('view', 'id'=>$model->FCCA_Id)),
	array('label'=>'Administrar Tipo', 'url'=>array('admin')),
);
?>

<!--<h1>Update Fcca <?php echo $model->FCCA_Id; ?></h1>-->

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>