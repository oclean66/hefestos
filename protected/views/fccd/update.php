<?php
/* @var $this FccdController */
/* @var $model Fccd */

$this->breadcrumbs=array(
	'Fccds'=>array('index'),
	$model->FCCD_Id=>array('view','id'=>$model->FCCD_Id),
	'Update',
);

$this->menu=array(
	//array('label'=>'List Fccd', 'url'=>array('index')),
	array('label'=>'Crear Fccd', 'url'=>array('create')),
	array('label'=>'Ver Fccd', 'url'=>array('view', 'id'=>$model->FCCD_Id)),
	array('label'=>'Administrar Fccd', 'url'=>array('admin')),
);
?>

<!--<h1>Update Fccd <?php echo $model->FCCD_Id; ?></h1>-->

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>