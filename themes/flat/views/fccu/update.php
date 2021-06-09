<?php
/* @var $this FccuController */
/* @var $model Fccu */

$this->breadcrumbs=array(
	'Fccus'=>array('index'),
	$model->FCCU_Id=>array('view','id'=>$model->FCCU_Id),
	'Update',
);

$this->menu=array(
	//array('label'=>'List Fccu', 'url'=>array('index')),
	// array('label'=>'Crear Fccu', 'url'=>array('create')),
	array('label'=>'Ver Activo', 'url'=>array('view', 'id'=>$model->FCCU_Id)),
	array('label'=>'Administrar Activos', 'url'=>array('admin')),
);
?>

<!--<h1>Update Fccu <?php echo $model->FCCU_Id; ?></h1>-->

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>