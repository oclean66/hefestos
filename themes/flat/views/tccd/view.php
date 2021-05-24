<?php
/* @var $this TccdController */
/* @var $model Tccd */

$this->breadcrumbs=array(
	'Tccds'=>array('index'),
	$model->TCCD_Id,
);

$this->menu=array(
	array('label'=>'Lista de Tareas', 'url'=>array('index')),
	array('label'=>'Crear Tarea', 'url'=>array('create')),
	array('label'=>'Actualizar Tarea', 'url'=>array('update', 'id'=>$model->TCCD_Id)),
	array('label'=>'Eliminar Tarea', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->TCCD_Id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Administrar Tareas', 'url'=>array('admin')),
);
?>

<h1>Tarea #<?php echo $model->TCCD_Id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'TCCD_Id',
		'TCCD_Title',
		'TCCD_Description',
		'TCCD_Created',
		'TCCD_Expired',
		'TCCD_Order',
		'TCCA_Id',
	),
)); ?>
