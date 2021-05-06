<?php
/* @var $this TccdController */
/* @var $model Tccd */

$this->breadcrumbs=array(
	'Tccds'=>array('index'),
	$model->TCCD_Id=>array('view','id'=>$model->TCCD_Id),
	'Update',
);

$this->menu=array(
	array('label'=>'Lista de Tareas', 'url'=>array('index')),
	array('label'=>'Crear Tarea', 'url'=>array('create')),
	array('label'=>'Ver Tarea', 'url'=>array('view', 'id'=>$model->TCCD_Id)),
	array('label'=>'Administrar Tareas', 'url'=>array('admin')),
);
?>

<h1>Actualizar Tarea <?php echo $model->TCCD_Id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>