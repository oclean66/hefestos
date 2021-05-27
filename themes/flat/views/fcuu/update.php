<?php
/* @var $this FcuuController */
/* @var $model Fcuu */

$this->breadcrumbs=array(
	'Fcuus'=>array('index'),
	$model->FCUU_Id=>array('view','id'=>$model->FCUU_Id),
	'Update',
);

$this->menu=array(
	//array('label'=>'List Fcuu', 'url'=>array('index')),
	array('label'=>'Crear Categoria', 'url'=>array('create')),
	array('label'=>'Ver Categoria', 'url'=>array('view', 'id'=>$model->FCUU_Id)),
	array('label'=>'Administrar Categoria', 'url'=>array('admin')),
);
?>


<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>