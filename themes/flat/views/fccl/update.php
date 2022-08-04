<?php
/* @var $this FccaController */
/* @var $model Fcca */

$this->breadcrumbs=array(
	'Fccl'=>array('index'),
	$model->FCCL_Id=>array('view','id'=>$model->FCCL_Id),
	'Update',
);

$this->menu=array(
	//array('label'=>'List Fcca', 'url'=>array('index')),
	array('label'=>'Crear Etiqueta', 'url'=>array('create')),
	array('label'=>'Ver Etiqueta', 'url'=>array('view', 'id'=>$model->FCCL_Id)),
	array('label'=>'Administrar Etiquetas', 'url'=>array('admin')),
);
?>

<!--<h1>Update Fcca <?php echo $model->FCCL_Id; ?></h1>-->

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>