<?php
/* @var $this TccdController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tccds',
);

$this->menu=array(
	array('label'=>'Crear Tarea', 'url'=>array('create')),
	array('label'=>'Administrar Tareas', 'url'=>array('admin')),
);
?>

<h1>Tareas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
