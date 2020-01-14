<?php
/* @var $this FccnController */
/* @var $model Fccn */

$this->breadcrumbs=array(
	'Fccns'=>array('index'),
	$model->FCCN_Id=>array('view','id'=>$model->FCCN_Id),
	'Update',
);

$this->menu=array(
	//array('label'=>'List Fccn', 'url'=>array('index')),
	array('label'=>'Crear Operacion', 'url'=>array('create')),
	array('label'=>'Ver Operacion', 'url'=>array('view', 'id'=>$model->FCCN_Id)),
	array('label'=>'Administrar Operacion', 'url'=>array('admin')),
);
?>


<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>