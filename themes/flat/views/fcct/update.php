<?php
/* @var $this FcctController */
/* @var $model Fcct */

$this->breadcrumbs=array(
	'Fccts'=>array('index'),
	$model->FCCT_Id=>array('view','id'=>$model->FCCT_Id),
	'Update',
);

$this->menu=array(
	//array('label'=>'List Fcct', 'url'=>array('index')),
	array('label'=>'Crear Modelo', 'url'=>array('create')),
	array('label'=>'Ver Modelo', 'url'=>array('view', 'id'=>$model->FCCT_Id)),
	array('label'=>'Administrar Modelos', 'url'=>array('admin')),
);
?>

<!--<h1>Update Fcct <?php echo $model->FCCT_Id; ?></h1>-->

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>