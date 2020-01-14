<?php
/* @var $this FcciController */
/* @var $model Fcci */

$this->breadcrumbs=array(
	'Fccis'=>array('index'),
	$model->FCCI_Id=>array('view','id'=>$model->FCCI_Id),
	'Update',
);

$this->menu=array(
	//array('label'=>'List Fcci', 'url'=>array('index')),
	array('label'=>'Crear Fcci', 'url'=>array('create')),
	array('label'=>'Ver Fcci', 'url'=>array('view', 'id'=>$model->FCCI_Id)),
	array('label'=>'Administrar Fcci', 'url'=>array('admin')),
);
?>

<!--<h1>Update Fcci <?php echo $model->FCCI_Id; ?></h1>-->

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>